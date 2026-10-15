<?php
/**
 * FAQPage JSON-LD for FAQ sections.
 *
 * An FAQ section is a Group block with the "FAQ" block style (is-style-faq).
 * Each Details block directly inside it is one question: the summary is the
 * question and the blocks inside are the answer. The schema is collected as
 * the blocks render, so it always matches what is on the page, whether the
 * FAQ is in post content, a synced pattern or a template.
 *
 * @package NSF
 */

defined( 'ABSPATH' ) || exit;

/**
 * Questions collected on this request, keyed by question text.
 *
 * @param array|null $add Question and answer to add, or null to read.
 * @return array<string, string> Question => answer HTML.
 */
function nsf_faq_items( $add = null ) {
	static $items = array();
	if ( is_array( $add ) && ! isset( $items[ $add[0] ] ) ) {
		$items[ $add[0] ] = $add[1];
	}
	return $items;
}

/**
 * Collects the questions of an FAQ group as it renders.
 *
 * @param string $content Rendered group.
 * @param array  $block   Parsed group block.
 * @return string Unchanged content.
 */
function nsf_faq_collect( $content, $block ) {
	$class = $block['attrs']['className'] ?? '';
	if ( ! preg_match( '/(^|\s)is-style-faq(\s|$)/', $class ) ) {
		return $content;
	}

	foreach ( $block['innerBlocks'] as $inner ) {
		if ( 'core/details' !== $inner['blockName'] ) {
			continue;
		}

		// The summary is sourced from the block's HTML, not its comment attributes.
		if ( ! preg_match( '#<summary[^>]*>(.*?)</summary>#s', $inner['innerHTML'], $match ) ) {
			continue;
		}
		$question = trim( html_entity_decode( wp_strip_all_tags( $match[1] ), ENT_QUOTES | ENT_HTML5, 'UTF-8' ) );

		$answer = '';
		foreach ( $inner['innerBlocks'] as $answer_block ) {
			$answer .= render_block( $answer_block );
		}
		$answer = nsf_faq_clean_answer( $answer );

		if ( '' !== $question && '' !== $answer ) {
			nsf_faq_items( array( $question, $answer ) );
		}
	}

	return $content;
}
add_filter( 'render_block_core/group', 'nsf_faq_collect', 10, 2 );

/**
 * Reduces an answer to the HTML Google accepts in Answer.text.
 *
 * @param string $html Rendered answer blocks.
 * @return string Cleaned HTML.
 */
function nsf_faq_clean_answer( $html ) {
	$allowed = array(
		'a'      => array( 'href' => true ),
		'br'     => array(),
		'p'      => array(),
		'ul'     => array(),
		'ol'     => array(),
		'li'     => array(),
		'b'      => array(),
		'strong' => array(),
		'i'      => array(),
		'em'     => array(),
		'h2'     => array(),
		'h3'     => array(),
		'h4'     => array(),
		'h5'     => array(),
		'h6'     => array(),
	);
	$html = wp_kses( $html, $allowed );
	$html = preg_replace( '/\s+/', ' ', $html );
	$html = preg_replace( '/>\s+</', '><', $html );
	return trim( $html );
}

/**
 * Builds the FAQPage object from the collected questions.
 *
 * @return array|null Schema, or null when the page has no FAQ.
 */
function nsf_faq_schema() {
	$items = nsf_faq_items();
	if ( ! $items ) {
		return null;
	}

	$questions = array();
	foreach ( $items as $question => $answer ) {
		$questions[] = array(
			'@type'          => 'Question',
			'name'           => $question,
			'acceptedAnswer' => array(
				'@type' => 'Answer',
				'text'  => $answer,
			),
		);
	}

	return array(
		'@context'   => 'https://schema.org',
		'@type'      => 'FAQPage',
		'mainEntity' => $questions,
	);
}

/**
 * Prints the FAQPage JSON-LD once.
 *
 * Block themes render the template before wp_head, so the questions are
 * known by then. wp_footer is the fallback for anything rendered later.
 */
function nsf_faq_print_schema() {
	static $printed = false;
	$schema         = nsf_faq_schema();
	if ( $printed || ! $schema ) {
		return;
	}
	$printed = true;

	printf(
		"<script type=\"application/ld+json\" id=\"nsf-faq-schema\">%s</script>\n",
		wp_json_encode( $schema, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_HEX_TAG )
	);
}
add_action( 'wp_head', 'nsf_faq_print_schema', 20 );
add_action( 'wp_footer', 'nsf_faq_print_schema', 20 );
