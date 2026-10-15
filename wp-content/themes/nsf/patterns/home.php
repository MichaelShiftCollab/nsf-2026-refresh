<?php
/**
 * Title: Home page
 * Slug: nsf/home
 * Categories: nsf-pages
 * Keywords: home, front page
 * Description: The whole Home page (Home mockup 464:67): Home Hero, What we do, the Best Slept Self® campaign band, featured resources, Research, For business and featured collaboration.
 *
 * @package NSF
 */

$nsf_hero = array(
	'heading' => __( 'Improving health and well being by advancing sleep health', 'nsf' ),
	'images'  => array_map(
		fn( $file ) => array(
			'url' => get_theme_file_uri( 'assets/images/home/' . $file ),
			'alt' => '',
		),
		array( 'hero-1.jpg', 'campaign-large.jpg', 'research.jpg', 'card-1.jpg', 'campaign-small-left.jpg', 'campaign-small-right.jpg' )
	),
);
?>
<!-- wp:nsf/home-hero <?php echo wp_json_encode( array_merge( $nsf_hero, array( 'align' => 'full' ) ), JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE ); ?> /-->

<?php
require __DIR__ . '/home-what-we-do.php';
require __DIR__ . '/campaign-best-slept-self.php';
require __DIR__ . '/home-featured-resources.php';
require __DIR__ . '/home-research.php';
require __DIR__ . '/home-for-business.php';
require __DIR__ . '/home-collaboration.php';
