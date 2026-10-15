<?php
/**
 * Title: Poll entry
 * Slug: nsf/poll-entry
 * Categories: nsf-sections
 * Keywords: poll, sleep in america, report, cover, download
 * Description: One Sleep in America® Poll: the report cover on the left, then the year, title, summary, a download button and a news release link. Delete the cover and the copy takes the full width. Replace the drawn cover with an Image block to use the real cover. Stack entries in a Lightest Blue section; a rule separates them.
 *
 * @package NSF
 */

/*
 * Page patterns can require this file after setting $nsf_poll to change the
 * placeholder copy:
 * - year, title, summary, button, url, link, link_url
 * - cover (string): 'navy', 'sunrise', 'blue' or '' for no cover
 */
$nsf_poll = array_merge(
	array(
		'year'     => '2026',
		'title'    => __( 'Poll title', 'nsf' ),
		'summary'  => __( 'One or two sentences on what the poll focused on and what it found.', 'nsf' ),
		'button'   => __( 'Download the Poll Results (PDF)', 'nsf' ),
		'url'      => '#',
		'link'     => __( 'Read the news release', 'nsf' ),
		'link_url' => '#',
		'cover'    => 'navy',
	),
	isset( $nsf_poll ) && is_array( $nsf_poll ) ? $nsf_poll : array()
);
?>
<!-- wp:group {"metadata":{"name":"Poll entry"},"tagName":"article","className":"nsf-poll","layout":{"type":"default"}} -->
<article class="wp-block-group nsf-poll"><?php if ( $nsf_poll['cover'] ) : ?><!-- wp:group {"metadata":{"name":"Cover"},"className":"nsf-poll__cover is-<?php echo esc_attr( $nsf_poll['cover'] ); ?>","layout":{"type":"default"}} -->
<div class="wp-block-group nsf-poll__cover is-<?php echo esc_attr( $nsf_poll['cover'] ); ?>"><!-- wp:image {"sizeSlug":"full","linkDestination":"none","className":"nsf-poll__logo"} -->
<figure class="wp-block-image size-full nsf-poll__logo"><img src="<?php echo esc_url( get_theme_file_uri( 'assets/images/brand/logo-nsf-white.png' ) ); ?>" alt=""/></figure>
<!-- /wp:image -->

<!-- wp:group {"className":"nsf-poll__cover-text","layout":{"type":"default"}} -->
<div class="wp-block-group nsf-poll__cover-text"><!-- wp:paragraph {"className":"nsf-poll__kicker"} -->
<p class="nsf-poll__kicker"><?php echo esc_html( sprintf( /* translators: %s: poll year. */ __( 'Sleep in America® Poll %s', 'nsf' ), $nsf_poll['year'] ) ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"className":"nsf-poll__cover-title"} -->
<p class="nsf-poll__cover-title"><?php echo esc_html( $nsf_poll['title'] ); ?></p>
<!-- /wp:paragraph --></div>
<!-- /wp:group --></div>
<!-- /wp:group -->

<?php endif; ?><!-- wp:group {"metadata":{"name":"Copy"},"className":"nsf-poll__copy","layout":{"type":"default"}} -->
<div class="wp-block-group nsf-poll__copy"><!-- wp:paragraph {"className":"is-style-eyebrow-small"} -->
<p class="is-style-eyebrow-small"><?php echo esc_html( $nsf_poll['year'] ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:heading {"level":3} -->
<h3 class="wp-block-heading"><?php echo esc_html( $nsf_poll['title'] ); ?></h3>
<!-- /wp:heading -->

<!-- wp:paragraph {"className":"nsf-poll__summary"} -->
<p class="nsf-poll__summary"><?php echo esc_html( $nsf_poll['summary'] ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:group {"className":"nsf-poll__links","layout":{"type":"flex","flexWrap":"wrap","verticalAlignment":"center"}} -->
<div class="wp-block-group nsf-poll__links"><!-- wp:buttons -->
<div class="wp-block-buttons"><!-- wp:button {"className":"nsf-download"} -->
<div class="wp-block-button nsf-download"><a class="wp-block-button__link wp-element-button" href="<?php echo esc_url( $nsf_poll['url'] ); ?>"><?php echo esc_html( $nsf_poll['button'] ); ?></a></div>
<!-- /wp:button --></div>
<!-- /wp:buttons -->

<!-- wp:paragraph {"className":"is-style-link"} -->
<p class="is-style-link"><a href="<?php echo esc_url( $nsf_poll['link_url'] ); ?>"><?php echo esc_html( $nsf_poll['link'] ); ?></a></p>
<!-- /wp:paragraph --></div>
<!-- /wp:group --></div>
<!-- /wp:group --></article>
<!-- /wp:group -->
<?php
unset( $nsf_poll );
