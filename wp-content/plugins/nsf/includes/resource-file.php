<?php
/**
 * File details for a Resource's attached file: type, size and PDF page count.
 *
 * @package NSF
 */

defined( 'ABSPATH' ) || exit;

/**
 * Returns details of a Resource's attached file, or null when it has none.
 *
 * @param int|WP_Post|null $post Resource post or ID. Defaults to the current post.
 * @return array{id:int,url:string,type:string,size:int,size_label:string,pages:int|null,label:string}|null
 *         `label` reads like "PDF · 2.4 MB · 28 pages".
 */
function nsf_get_resource_file( $post = null ) {
	$post = get_post( $post );
	return $post ? nsf_get_file_details( (int) get_post_meta( $post->ID, 'nsf_file_id', true ) ) : null;
}

/**
 * Returns details of an attachment file, or null when it is missing. Used for
 * Resources and the Gated Download block.
 *
 * @param int $file_id Attachment ID.
 * @return array{id:int,url:string,path:string,type:string,size:int,size_label:string,pages:int|null,label:string}|null
 */
function nsf_get_file_details( $file_id ) {
	$path = $file_id ? get_attached_file( $file_id ) : false;

	if ( ! $path || ! file_exists( $path ) ) {
		return null;
	}

	$extension = strtolower( pathinfo( $path, PATHINFO_EXTENSION ) );
	$size      = (int) filesize( $path );
	$pages     = 'pdf' === $extension ? nsf_get_pdf_page_count( $file_id, $path ) : null;

	$parts = array( strtoupper( $extension ), size_format( $size, $size >= MB_IN_BYTES ? 1 : 0 ) );
	if ( $pages ) {
		/* translators: %d: number of pages. */
		$parts[] = sprintf( _n( '%d page', '%d pages', $pages, 'nsf' ), $pages );
	}

	return array(
		'id'         => (int) $file_id,
		'url'        => (string) wp_get_attachment_url( $file_id ),
		'path'       => $path,
		'type'       => strtoupper( $extension ),
		'size'       => $size,
		'size_label' => size_format( $size, $size >= MB_IN_BYTES ? 1 : 0 ),
		'pages'      => $pages,
		'label'      => implode( ' · ', $parts ),
	);
}

/**
 * Counts the pages of a PDF and caches the result on the attachment, keyed to the file's
 * modification time so a replaced file is counted again.
 *
 * @param int    $attachment_id Attachment ID.
 * @param string $path          Absolute path to the PDF.
 * @return int|null Page count, or null when it cannot be read.
 */
function nsf_get_pdf_page_count( $attachment_id, $path ) {
	$mtime  = (int) filemtime( $path );
	$cached = get_post_meta( $attachment_id, '_nsf_pdf_pages', true );
	if ( is_array( $cached ) && ( $cached['mtime'] ?? 0 ) === $mtime ) {
		return $cached['pages'];
	}

	$pages    = null;
	$contents = file_get_contents( $path ); // phpcs:ignore WordPress.WP.AlternativeFunctions.file_get_contents_file_get_contents -- local file.
	if ( false !== $contents ) {
		// The page tree root carries the total in /Count; take the largest in case of nested trees.
		if ( preg_match_all( '#/Type\s*/Pages\b[^>]*?/Count\s+(\d+)#s', $contents, $matches ) ) {
			$pages = max( array_map( 'intval', $matches[1] ) );
		} elseif ( preg_match_all( '#/Type\s*/Page\b#', $contents, $matches ) ) {
			$pages = count( $matches[0] );
		}
	}

	update_post_meta(
		$attachment_id,
		'_nsf_pdf_pages',
		array(
			'mtime' => $mtime,
			'pages' => $pages ? $pages : null,
		)
	);

	return $pages ? $pages : null;
}
