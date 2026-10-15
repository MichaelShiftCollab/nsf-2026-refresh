<?php
/**
 * Forms: the NSF Form block and the [nsf_form] shortcode place a Gravity
 * Form by its stable key (the nsfKey in forms/<key>.json), so patterns do not
 * depend on form IDs, which differ between local and staging. Patterns and
 * template parts use the block; shortcodes are not run in template parts.
 *
 * Until Gravity Forms is installed (build plan step 4) the shortcode shows a
 * disabled preview of the form's fields, so pages that use it can be built
 * and compared to their mockups.
 *
 * Usage: [nsf_form key="sleepmark-lead" link="/sleepmark/" link_text="See the application process"]
 * The optional link sits beside the submit button, as in the Home mockup.
 * layout="inline" puts the fields and the button on one row (newsletter).
 *
 * @package NSF
 */

defined( 'ABSPATH' ) || exit;

/**
 * Form definition from forms/<key>.json.
 *
 * @param string $key Form key.
 * @return array|null
 */
function nsf_form_definition( $key ) {
	$file = NSF_PATH . 'forms/' . sanitize_key( $key ) . '.json';
	if ( ! is_readable( $file ) ) {
		return null;
	}
	$form = json_decode( (string) file_get_contents( $file ), true ); // phpcs:ignore WordPress.WP.AlternativeFunctions.file_get_contents_file_get_contents
	return is_array( $form ) ? $form : null;
}

/**
 * Gravity Forms ID for a form key, or 0.
 *
 * @param string $key Form key.
 * @return int
 */
function nsf_form_id( $key ) {
	if ( ! class_exists( 'GFAPI' ) ) {
		return 0;
	}
	foreach ( GFAPI::get_forms() as $form ) {
		if ( ( $form['nsfKey'] ?? '' ) === $key ) {
			return (int) $form['id'];
		}
	}
	return 0;
}

/**
 * The link shown beside the submit button.
 *
 * @param array $atts Shortcode attributes.
 * @return string
 */
function nsf_form_link_html( $atts ) {
	if ( '' === $atts['link'] || '' === $atts['link_text'] ) {
		return '';
	}
	return sprintf(
		'<a class="nsf-form__link" href="%1$s">%2$s</a>',
		esc_url( $atts['link'] ),
		esc_html( $atts['link_text'] )
	);
}

/**
 * Disabled preview of a form, styled like the real one.
 *
 * @param array $form Form definition.
 * @param array $atts Shortcode attributes.
 * @return string
 */
function nsf_form_preview_html( $form, $atts ) {
	$html = '';
	foreach ( (array) ( $form['fields'] ?? array() ) as $field ) {
		$id    = 'nsf-form-' . sanitize_key( $form['nsfKey'] ) . '-' . (int) $field['id'];
		$type  = in_array( $field['type'] ?? '', array( 'email', 'phone', 'textarea' ), true ) ? $field['type'] : 'text';
		$label = $field['label'] ?? '';
		$input = 'textarea' === $type
			? sprintf( '<textarea id="%1$s" placeholder="%2$s" disabled></textarea>', esc_attr( $id ), esc_attr( $field['placeholder'] ?? $label ) )
			: sprintf( '<input id="%1$s" type="%2$s" placeholder="%3$s" disabled />', esc_attr( $id ), esc_attr( 'phone' === $type ? 'tel' : $type ), esc_attr( $field['placeholder'] ?? $label ) );
		$html .= sprintf(
			'<div class="nsf-form__field"><label class="screen-reader-text" for="%1$s">%2$s</label>%3$s</div>',
			esc_attr( $id ),
			esc_html( $label ),
			$input
		);
	}
	return sprintf(
		'<form class="%5$s" aria-label="%1$s" onsubmit="return false">%2$s<div class="nsf-form__footer"><button type="submit" class="wp-element-button" disabled>%3$s</button>%4$s</div></form>',
		esc_attr( $form['title'] ?? '' ),
		$html,
		esc_html( $form['button']['text'] ?? __( 'Submit', 'nsf' ) ),
		nsf_form_link_html( $atts ),
		esc_attr( nsf_form_classes( $atts ) . ' is-preview' )
	);
}

/**
 * Wrapper classes for a form.
 *
 * @param array $atts Shortcode attributes.
 * @return string
 */
function nsf_form_classes( $atts ) {
	return 'nsf-form' . ( 'inline' === $atts['layout'] ? ' nsf-form--inline' : '' );
}

/**
 * [nsf_form] shortcode.
 *
 * @param array|string $atts Shortcode attributes.
 * @return string
 */
function nsf_form_shortcode( $atts ) {
	$atts = shortcode_atts(
		array(
			'key'       => '',
			'link'      => '',
			'link_text' => '',
			'layout'    => '',
		),
		$atts,
		'nsf_form'
	);
	$form = nsf_form_definition( $atts['key'] );
	if ( ! $form ) {
		return '';
	}

	$id = nsf_form_id( $atts['key'] );
	if ( $id && function_exists( 'gravity_form' ) ) {
		$link   = nsf_form_link_html( $atts );
		$filter = function ( $button ) use ( $link ) {
			return $button . $link;
		};
		add_filter( "gform_submit_button_{$id}", $filter );
		$html = gravity_form( $id, false, false, false, null, true, 0, false );
		remove_filter( "gform_submit_button_{$id}", $filter );
		return '<div class="' . esc_attr( nsf_form_classes( $atts ) ) . '">' . $html . '</div>';
	}

	return nsf_form_preview_html( $form, $atts );
}
add_shortcode( 'nsf_form', 'nsf_form_shortcode' );

/**
 * Lists the forms for the NSF Form block's picker.
 */
function nsf_form_editor_data() {
	$forms = array();
	foreach ( glob( NSF_PATH . 'forms/*.json' ) ?: array() as $file ) {
		$form = nsf_form_definition( basename( $file, '.json' ) );
		if ( $form ) {
			$forms[] = array(
				'value' => $form['nsfKey'],
				'label' => $form['title'],
			);
		}
	}
	wp_add_inline_script( 'nsf-form-editor-script', 'window.nsfForms = ' . wp_json_encode( $forms ) . ';', 'before' );
}
add_action( 'enqueue_block_editor_assets', 'nsf_form_editor_data' );
