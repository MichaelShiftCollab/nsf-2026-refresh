<?php
/**
 * WP-CLI commands: `wp nsf terms import` and `wp nsf seed`.
 *
 * @package NSF
 */

defined( 'ABSPATH' ) || exit;

/**
 * NSF site commands.
 */
class NSF_CLI {

	/**
	 * Meta key that marks content created by `wp nsf seed`.
	 */
	const SEED_KEY = '_nsf_seed';

	/**
	 * Imports Topic, Audience, Resource Type and post category terms from content/taxonomy-terms.json.
	 *
	 * Existing terms are kept; running it twice creates nothing new.
	 *
	 * ## EXAMPLES
	 *
	 *     wp nsf terms import
	 *
	 * @subcommand terms
	 * @param array $args Positional arguments; the first must be "import".
	 */
	public function terms( $args ) {
		if ( 'import' !== ( $args[0] ?? '' ) ) {
			WP_CLI::error( 'Usage: wp nsf terms import' );
		}
		$created = $this->import_terms();
		WP_CLI::success( sprintf( 'Terms imported (%d new).', $created ) );
	}

	/**
	 * Creates test content: 30 Resources and 20 posts with featured images and files.
	 *
	 * Seeded items are marked so `--delete` removes exactly them.
	 *
	 * ## OPTIONS
	 *
	 * [--delete]
	 * : Remove all seeded posts, Resources, images, files and seed categories.
	 *
	 * ## EXAMPLES
	 *
	 *     wp nsf seed
	 *     wp nsf seed --delete
	 *
	 * @param array $args       Positional arguments (unused).
	 * @param array $assoc_args Associative arguments.
	 */
	public function seed( $args, $assoc_args ) {
		if ( ! empty( $assoc_args['delete'] ) ) {
			$this->delete_seed();
			return;
		}

		if ( $this->seeded_ids( array( 'post', 'resource' ) ) ) {
			WP_CLI::error( 'Seed content already exists. Run `wp nsf seed --delete` first.' );
		}

		$this->import_terms();
		$images = $this->seed_images();
		$this->seed_resources( $images );
		$this->seed_posts( $images );
		$this->seed_press_releases();
		WP_CLI::success( 'Seeded 30 Resources, 20 posts and 8 press releases.' );
	}

	/**
	 * Rebuilds the Resource Hub table sort keys (Type, Topic, Audience) for every post and Resource.
	 *
	 * They are kept up to date on save; run this after an import that skipped hooks.
	 *
	 * ## EXAMPLES
	 *
	 *     wp nsf reindex
	 *
	 * @subcommand reindex
	 */
	public function reindex() {
		$ids = get_posts(
			array(
				'post_type'      => array( 'post', 'resource' ),
				'post_status'    => 'any',
				'posts_per_page' => -1,
				'fields'         => 'ids',
			)
		);
		foreach ( $ids as $id ) {
			nsf_hub_update_sort_keys( $id );
		}
		WP_CLI::success( sprintf( 'Updated sort keys for %d items.', count( $ids ) ) );
	}

	/**
	 * Creates missing terms from content/taxonomy-terms.json.
	 *
	 * @return int Number of terms created.
	 */
	private function import_terms() {
		// The repo keeps the list in content/; deploys copy it into the plugin.
		$file = dirname( NSF_PATH, 3 ) . '/content/taxonomy-terms.json';
		if ( ! file_exists( $file ) ) {
			$file = NSF_PATH . 'data/taxonomy-terms.json';
		}
		if ( ! file_exists( $file ) ) {
			WP_CLI::error( "Missing $file" );
		}
		$terms   = json_decode( (string) file_get_contents( $file ), true ); // phpcs:ignore WordPress.WP.AlternativeFunctions.file_get_contents_file_get_contents
		$created = 0;
		foreach ( array( 'topic', 'audience', 'resource_type', 'category' ) as $taxonomy ) {
			foreach ( $terms[ $taxonomy ] ?? array() as $name ) {
				if ( ! term_exists( $name, $taxonomy ) ) {
					wp_insert_term( $name, $taxonomy );
					++$created;
				}
			}
		}
		return $created;
	}

	/**
	 * Generates six placeholder images in brand colors and adds them to the media library.
	 *
	 * @return int[] Attachment IDs.
	 */
	private function seed_images() {
		$colors = array(
			array( '00549E', '002140' ),
			array( 'D4E5F3', 'FEF3E7' ),
			array( '5A99D2', '00549E' ),
			array( 'F28411', 'F8C188' ),
			array( 'F1F8FE', 'D4E5F3' ),
			array( '002140', '5A99D2' ),
		);
		$ids    = array();
		foreach ( $colors as $i => $pair ) {
			$ids[] = $this->insert_attachment(
				sprintf( 'nsf-placeholder-%d.png', $i + 1 ),
				$this->placeholder_png( 1200, 675, $pair[0], $pair[1] ),
				sprintf( 'Placeholder image %d', $i + 1 )
			);
		}
		return $ids;
	}

	/**
	 * Creates 30 Resources across types, topics, audiences and tags.
	 *
	 * @param int[] $images Placeholder image IDs.
	 */
	private function seed_resources( $images ) {
		$titles = array(
			'Sleep in America® Poll 2026: A Look at Children’s Sleep Health and Family Sleep Habits',
			'Living with 24-Hour Sleep Disorders: Understanding Narcolepsy and Idiopathic Hypersomnia',
			'Drowsy Driving by the Numbers',
			'How Much Sleep Do Teens Need?',
			'Sleep Health Index® Quarterly Report',
			'Bedroom Environment Checklist',
			'Shift Work and Sleep: A Guide for Employers',
			'Sleep Apnea Screening Questionnaire',
			'Foundations of Sleep Health™ Overview',
			'Sleep and Aging: What Changes After 65',
			'Workplace Fatigue Survey Results',
			'Best Slept Self® Quiz',
			'Daylight Saving Time and Your Sleep',
			'Sleep Health Journal Highlights',
			'Insomnia Treatment Options Infographic',
			'Napping: Benefits and Best Practices',
			'Sleep Awareness Week® Toolkit Summary',
			'Children’s Bedtime Routines That Work',
			'Restless Legs Syndrome Fact Sheet',
			'Caffeine, Alcohol and Sleep',
			'Sleep Technology Consumer Survey',
			'Position Statement on School Start Times',
			'Guidelines for Healthy Sleep Duration',
			'Light Exposure and the Body Clock',
			'Drowsy Driving Prevention Week® Report',
			'Sleep Health During a Presidential Election',
			'Sleep Health and the COVID-19 Pandemic',
			'Understanding Sleep Apnea',
			'Temperature, Noise and Sleep Quality',
			'Sleep Myths Quiz',
		);
		$types     = array( 'Report', 'Infographic', 'Quiz', 'Poll', 'Survey', 'Publication' );
		$topics    = $this->term_ids( 'topic' );
		$audiences = $this->term_ids( 'audience' );
		$tags      = array( 'Insomnia', 'Sleep Apnea', 'Teens', 'Driving', 'Workplace', 'Circadian Rhythm', 'Sleep Tech' );
		$pdf_types = array( 'Report', 'Publication', 'Poll', 'Survey' );

		foreach ( $titles as $i => $title ) {
			$type = $types[ $i % count( $types ) ];
			$id   = wp_insert_post(
				array(
					'post_type'    => 'resource',
					'post_status'  => 'publish',
					'post_title'   => $title,
					'post_excerpt' => 'A short summary of this resource, written for the card and search results.',
					'post_content' => wp_slash( $this->resource_blocks() ),
					'post_date'    => gmdate( 'Y-m-d H:i:s', strtotime( '2026-10-01 -' . ( $i * 17 ) . ' days' ) ),
					'meta_input'   => array(
						self::SEED_KEY => 1,
						'nsf_subtitle' => 'Subtitle for this resource, one line',
						'nsf_byline'   => 'A report from the National Sleep Foundation',
						'nsf_gated'    => 0 === $i % 7,
					),
				),
				true
			);
			if ( is_wp_error( $id ) ) {
				WP_CLI::error( $id );
			}

			wp_set_object_terms( $id, $type, 'resource_type' );
			wp_set_object_terms( $id, array( $topics[ $i % count( $topics ) ], $topics[ ( $i * 3 + 1 ) % count( $topics ) ] ), 'topic' );
			wp_set_object_terms( $id, $audiences[ $i % count( $audiences ) ], 'audience' );
			wp_set_object_terms( $id, array( $tags[ $i % count( $tags ) ], $tags[ ( $i + 2 ) % count( $tags ) ] ), 'resource_tag' );
			set_post_thumbnail( $id, $images[ $i % count( $images ) ] );

			if ( in_array( $type, $pdf_types, true ) ) {
				$file = $this->insert_attachment(
					sanitize_title( $title ) . '.pdf',
					$this->placeholder_pdf( $title, 2 + ( $i % 5 ) * 6 ),
					$title,
					$id
				);
				update_post_meta( $id, 'nsf_file_id', $file );
			}
		}
	}

	/**
	 * Resource body: the theme's Resource layout pattern, or lorem paragraphs without it.
	 *
	 * @return string
	 */
	private function resource_blocks() {
		$pattern = WP_Block_Patterns_Registry::get_instance()->get_registered( 'nsf/resource-layout' );
		return $pattern ? $pattern['content'] : $this->lorem_blocks( 3 );
	}

	/**
	 * Creates 20 Sleep Learning Zone posts across categories, topics and audiences.
	 *
	 * @param int[] $images Placeholder image IDs.
	 */
	private function seed_posts( $images ) {
		$categories = array();
		foreach ( array( 'Sleep Disorders', 'Healthy Sleep Habits', 'Sleep and You', 'Drowsy Driving', 'Sleep Tech' ) as $name ) {
			$term = term_exists( $name, 'category' );
			if ( ! $term ) {
				$term = wp_insert_term( $name, 'category' );
				add_term_meta( $term['term_id'], self::SEED_KEY, 1 );
			}
			$categories[] = (int) $term['term_id'];
		}
		$topics    = $this->term_ids( 'topic' );
		$audiences = $this->term_ids( 'audience' );

		$titles = array(
			'Here’s Something Your Kid’s Mood, Grades, and Immunity Have in Common',
			'What Happens to Your Body When You Sleep',
			'Five Signs You Might Have Sleep Apnea',
			'How to Build a Better Bedtime Routine',
			'Why Teens Fall Asleep So Late',
			'The Link Between Sleep and Heart Health',
			'Is Your Bedroom Too Warm for Good Sleep?',
			'Sleep Tips for Shift Workers',
			'What to Know About Melatonin',
			'How Screens Affect Sleep',
			'Drowsy Driving: Who Is Most at Risk',
			'Can You Catch Up on Lost Sleep?',
			'Sleep and Mental Health',
			'The Science of Dreams',
			'How Sleep Changes as We Age',
			'Choosing a Sleep Tracker',
			'Snoring: When to See a Doctor',
			'Exercise and Sleep',
			'Jet Lag and Your Body Clock',
			'What Is Sleep Hygiene?',
		);
		foreach ( $titles as $i => $title ) {
			$id = wp_insert_post(
				array(
					'post_type'     => 'post',
					'post_status'   => 'publish',
					'post_title'    => $title,
					'post_excerpt'  => 'A one-sentence summary of this article for cards and search.',
					'post_content'  => $this->lorem_blocks( 5 ),
					'post_date'     => gmdate( 'Y-m-d H:i:s', strtotime( '2026-10-05 -' . ( $i * 11 ) . ' days' ) ),
					'post_category' => array( $categories[ $i % count( $categories ) ] ),
					'meta_input'    => array( self::SEED_KEY => 1 ),
				),
				true
			);
			if ( is_wp_error( $id ) ) {
				WP_CLI::error( $id );
			}
			wp_set_object_terms( $id, $topics[ ( $i * 2 ) % count( $topics ) ], 'topic' );
			wp_set_object_terms( $id, $audiences[ $i % count( $audiences ) ], 'audience' );
			set_post_thumbnail( $id, $images[ ( $i + 3 ) % count( $images ) ] );
		}
	}

	/**
	 * Creates eight press releases in the Press release category for the
	 * Media Center list.
	 */
	private function seed_press_releases() {
		$term = term_exists( NSF_PRESS_RELEASE_CATEGORY, 'category' );
		if ( ! $term ) {
			$term = wp_insert_term( 'Press release', 'category', array( 'slug' => NSF_PRESS_RELEASE_CATEGORY ) );
		}
		$titles = array(
			'National Sleep Foundation Assembles Leading Experts to Shape the Future of Drowsy Driving Prevention',
			'National Sleep Foundation Will Convene National Roadway Safety Leaders To Advance Sleep Health and Transportation Safety',
			'National Sleep Foundation Expands Drowsy Driving Programs to Enhance Sleep Health and Safety',
			'National Sleep Foundation Announces 9th Annual SleepTech® Award',
			'National Sleep Foundation Names Mark R. Rosekind, PhD, To Chair Board of Directors',
			'National Sleep Foundation and Tempur-Pedic Compare Notes on What’s Keeping the Nation Awake',
			'National Sleep Foundation Releases 2026 Sleep in America® Poll',
			'National Sleep Foundation Marks Sleep Awareness Week® 2026',
		);
		foreach ( $titles as $i => $title ) {
			$id = wp_insert_post(
				array(
					'post_type'     => 'post',
					'post_status'   => 'publish',
					'post_title'    => $title,
					'post_excerpt'  => 'A one-sentence summary of this press release.',
					'post_content'  => $this->lorem_blocks( 4 ),
					'post_date'     => gmdate( 'Y-m-d H:i:s', strtotime( '2026-10-08 -' . ( $i * 17 ) . ' days' ) ),
					'post_category' => array( (int) $term['term_id'] ),
					'meta_input'    => array( self::SEED_KEY => 1 ),
				),
				true
			);
			if ( is_wp_error( $id ) ) {
				WP_CLI::error( $id );
			}
		}
	}

	/**
	 * Deletes everything marked as seed content.
	 */
	private function delete_seed() {
		$ids = $this->seeded_ids( array( 'post', 'resource', 'attachment' ) );
		foreach ( $ids as $id ) {
			'attachment' === get_post_type( $id ) ? wp_delete_attachment( $id, true ) : wp_delete_post( $id, true );
		}
		$terms = get_terms(
			array(
				'taxonomy'   => 'category',
				'hide_empty' => false,
				'meta_key'   => self::SEED_KEY, // phpcs:ignore WordPress.DB.SlowDBQuery.slow_db_query_meta_key
				'fields'     => 'ids',
			)
		);
		foreach ( $terms as $term_id ) {
			wp_delete_term( $term_id, 'category' );
		}
		WP_CLI::success( sprintf( 'Deleted %d seeded items and %d seed categories.', count( $ids ), count( $terms ) ) );
	}

	/**
	 * Returns IDs of seeded items of the given post types.
	 *
	 * @param string[] $post_types Post types.
	 * @return int[]
	 */
	private function seeded_ids( $post_types ) {
		return get_posts(
			array(
				'post_type'      => $post_types,
				'post_status'    => 'any',
				'posts_per_page' => -1,
				'fields'         => 'ids',
				'meta_key'       => self::SEED_KEY, // phpcs:ignore WordPress.DB.SlowDBQuery.slow_db_query_meta_key
			)
		);
	}

	/**
	 * Returns all term IDs of a taxonomy, by name.
	 *
	 * @param string $taxonomy Taxonomy.
	 * @return int[]
	 */
	private function term_ids( $taxonomy ) {
		return get_terms(
			array(
				'taxonomy'   => $taxonomy,
				'hide_empty' => false,
				'orderby'    => 'name',
				'fields'     => 'ids',
			)
		);
	}

	/**
	 * Writes bytes to the uploads folder and registers them as a seed attachment.
	 *
	 * @param string $filename File name.
	 * @param string $bytes    File contents.
	 * @param string $title    Attachment title.
	 * @param int    $parent   Parent post ID.
	 * @return int Attachment ID.
	 */
	private function insert_attachment( $filename, $bytes, $title, $parent = 0 ) {
		$upload = wp_upload_bits( $filename, null, $bytes );
		if ( ! empty( $upload['error'] ) ) {
			WP_CLI::error( $upload['error'] );
		}
		$type = wp_check_filetype( $upload['file'] );
		$id   = wp_insert_attachment(
			array(
				'post_title'     => $title,
				'post_mime_type' => $type['type'],
				'post_status'    => 'inherit',
				'meta_input'     => array( self::SEED_KEY => 1 ),
			),
			$upload['file'],
			$parent
		);
		require_once ABSPATH . 'wp-admin/includes/image.php';
		wp_update_attachment_metadata( $id, wp_generate_attachment_metadata( $id, $upload['file'] ) );
		return $id;
	}

	/**
	 * Draws a vertical two-color gradient PNG.
	 *
	 * @param int    $width  Width in px.
	 * @param int    $height Height in px.
	 * @param string $from   Top color, hex without #.
	 * @param string $to     Bottom color, hex without #.
	 * @return string PNG bytes.
	 */
	private function placeholder_png( $width, $height, $from, $to ) {
		$image = imagecreatetruecolor( $width, $height );
		$a     = array_map( 'hexdec', str_split( $from, 2 ) );
		$b     = array_map( 'hexdec', str_split( $to, 2 ) );
		for ( $y = 0; $y < $height; $y++ ) {
			$t     = $y / ( $height - 1 );
			$color = imagecolorallocate(
				$image,
				(int) round( $a[0] + ( $b[0] - $a[0] ) * $t ),
				(int) round( $a[1] + ( $b[1] - $a[1] ) * $t ),
				(int) round( $a[2] + ( $b[2] - $a[2] ) * $t )
			);
			imageline( $image, 0, $y, $width, $y, $color );
		}
		ob_start();
		imagepng( $image );
		imagedestroy( $image );
		return (string) ob_get_clean();
	}

	/**
	 * Builds a minimal valid PDF with one line of text per page.
	 *
	 * @param string $title Text for each page.
	 * @param int    $pages Page count.
	 * @return string PDF bytes.
	 */
	private function placeholder_pdf( $title, $pages ) {
		$text    = preg_replace( '/[^\x20-\x7E]/', '', $title );
		$text    = str_replace( array( '\\', '(', ')' ), array( '\\\\', '\\(', '\\)' ), $text );
		$objects = array(
			1 => '<< /Type /Catalog /Pages 2 0 R >>',
			3 => '<< /Type /Font /Subtype /Type1 /BaseFont /Helvetica >>',
		);
		$kids    = array();
		for ( $p = 0; $p < $pages; $p++ ) {
			$page_id             = 4 + $p * 2;
			$stream              = sprintf( "BT /F1 18 Tf 72 720 Td (%s - page %d) Tj ET", $text, $p + 1 );
			$objects[ $page_id ] = sprintf( '<< /Type /Page /Parent 2 0 R /MediaBox [0 0 612 792] /Resources << /Font << /F1 3 0 R >> >> /Contents %d 0 R >>', $page_id + 1 );
			$objects[ $page_id + 1 ] = sprintf( "<< /Length %d >>\nstream\n%s\nendstream", strlen( $stream ), $stream );
			$kids[]              = "$page_id 0 R";
		}
		$objects[2] = sprintf( '<< /Type /Pages /Kids [%s] /Count %d >>', implode( ' ', $kids ), $pages );
		ksort( $objects );

		$pdf     = "%PDF-1.4\n";
		$offsets = array();
		foreach ( $objects as $n => $body ) {
			$offsets[ $n ] = strlen( $pdf );
			$pdf          .= "$n 0 obj\n$body\nendobj\n";
		}
		$xref = strlen( $pdf );
		$pdf .= sprintf( "xref\n0 %d\n0000000000 65535 f \n", count( $objects ) + 1 );
		foreach ( $offsets as $offset ) {
			$pdf .= sprintf( "%010d 00000 n \n", $offset );
		}
		$pdf .= sprintf( "trailer\n<< /Size %d /Root 1 0 R >>\nstartxref\n%d\n%%%%EOF\n", count( $objects ) + 1, $xref );
		return $pdf;
	}

	/**
	 * Returns paragraph blocks of placeholder copy.
	 *
	 * @param int $count Number of paragraphs.
	 * @return string Block markup.
	 */
	private function lorem_blocks( $count ) {
		$text = 'Placeholder copy for testing layouts. Sleep is essential to health, safety and quality of life, and this paragraph stands in for the real article or report summary until content is migrated.';
		return implode( "\n\n", array_fill( 0, $count, "<!-- wp:paragraph -->\n<p>$text</p>\n<!-- /wp:paragraph -->" ) );
	}
}

WP_CLI::add_command( 'nsf', 'NSF_CLI' );
