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
 * Preview markup for one field.
 *
 * @param array  $field Field definition.
 * @param string $base  ID prefix for this form.
 * @param bool   $live  Whether the field can be filled in (local Gated Download fallback).
 * @return string
 */
function nsf_form_preview_field_html( $field, $base, $live ) {
	$type     = $field['type'] ?? 'text';
	$id       = $base . '-' . (int) $field['id'];
	$name     = 'input_' . (int) $field['id'];
	$label    = $field['label'] ?? '';
	$required = ! empty( $field['isRequired'] );
	$state    = $live ? ( $required ? ' required' : '' ) : ' disabled';
	$classes  = 'nsf-form__field' . ( 6 === (int) ( $field['layoutGridColumnSpan'] ?? 12 ) ? ' is-half' : '' );
	$note     = empty( $field['description'] ) ? '' : '<p class="nsf-form__description">' . esc_html( $field['description'] ) . '</p>';

	if ( 'section' === $type ) {
		return '<p class="nsf-form__section">' . esc_html( $label ) . '</p>';
	}

	if ( in_array( $type, array( 'radio', 'checkbox' ), true ) ) {
		$options = '';
		foreach ( (array) ( $field['choices'] ?? array() ) as $i => $choice ) {
			$options .= sprintf(
				'<label class="nsf-form__choice"><input type="%1$s" name="%2$s" value="%3$s"%4$s /><span>%5$s</span></label>',
				esc_attr( $type ),
				esc_attr( 'checkbox' === $type ? $name . '_' . ( $i + 1 ) : $name ),
				esc_attr( $choice['value'] ?? $choice['text'] ),
				$live ? ( $required && 'radio' === $type ? ' required' : '' ) : ' disabled',
				esc_html( $choice['text'] )
			);
		}
		return sprintf(
			'<fieldset class="%1$s nsf-form__choices"><legend%6$s>%2$s%3$s</legend>%4$s%5$s</fieldset>',
			esc_attr( $classes ),
			esc_html( $label ),
			$required ? '<span class="nsf-form__required"> *</span>' : '',
			$options,
			$note,
			'hidden_label' === ( $field['labelPlacement'] ?? '' ) ? ' class="screen-reader-text"' : ''
		);
	}

	if ( 'select' === $type ) {
		$options = sprintf( '<option value="">%s</option>', esc_html( ( $field['placeholder'] ?? $label ) . ( $required ? '*' : '' ) ) );
		foreach ( (array) ( $field['choices'] ?? array() ) as $choice ) {
			$options .= sprintf( '<option value="%1$s">%2$s</option>', esc_attr( $choice['value'] ?? $choice['text'] ), esc_html( $choice['text'] ) );
		}
		return sprintf(
			'<div class="%1$s"><label class="screen-reader-text" for="%2$s">%3$s</label><select id="%2$s" name="%4$s"%5$s>%6$s</select>%7$s</div>',
			esc_attr( $classes . ' nsf-form__select' ),
			esc_attr( $id ),
			esc_html( $label . ( $required ? ' *' : '' ) ),
			esc_attr( $name ),
			$state,
			$options,
			$note
		);
	}

	$types = array(
		'email'   => 'email',
		'phone'   => 'tel',
		'website' => 'url',
	);
	$input = 'textarea' === $type
		? sprintf( '<textarea id="%1$s" name="%2$s" placeholder="%3$s"%4$s></textarea>', esc_attr( $id ), esc_attr( $name ), esc_attr( $field['placeholder'] ?? $label ), $state )
		: sprintf(
			'<input id="%1$s" name="%2$s" type="%3$s" placeholder="%4$s" autocomplete="%5$s"%6$s />',
			esc_attr( $id ),
			esc_attr( $name ),
			esc_attr( $types[ $type ] ?? 'text' ),
			esc_attr( $field['placeholder'] ?? $label ),
			esc_attr( $field['autocompleteAttribute'] ?? 'on' ),
			$state
		);
	return sprintf(
		'<div class="%1$s"><label class="screen-reader-text" for="%2$s">%3$s</label>%4$s%5$s</div>',
		esc_attr( $classes ),
		esc_attr( $id ),
		esc_html( $label . ( $required ? ' *' : '' ) ),
		$input,
		$note
	);
}

/**
 * Preview of a form, styled like the real one. Disabled, unless $atts['action']
 * is set: then it posts there (the local Gated Download fallback).
 *
 * @param array $form Form definition.
 * @param array $atts Shortcode attributes.
 * @return string
 */
function nsf_form_preview_html( $form, $atts ) {
	$live = '' !== ( $atts['action'] ?? '' );
	$html = '';
	foreach ( (array) ( $form['fields'] ?? array() ) as $field ) {
		$html .= nsf_form_preview_field_html( $field, 'nsf-form-' . sanitize_key( $form['nsfKey'] ), $live );
	}
	foreach ( (array) ( $atts['hidden'] ?? array() ) as $name => $value ) {
		$html .= sprintf( '<input type="hidden" name="%1$s" value="%2$s" />', esc_attr( $name ), esc_attr( $value ) );
	}
	return sprintf(
		'<form class="%5$s" aria-label="%1$s" %6$s>%2$s<div class="nsf-form__footer"><button type="submit" class="wp-element-button"%7$s>%3$s</button>%4$s</div></form>',
		esc_attr( $form['title'] ?? '' ),
		$html,
		esc_html( $form['button']['text'] ?? __( 'Submit', 'nsf' ) ),
		nsf_form_link_html( $atts ),
		esc_attr( nsf_form_classes( $atts ) . ' is-preview' . ( $live ? ' is-live' : '' ) ),
		$live ? 'method="post" action="' . esc_url( $atts['action'] ) . '"' : 'onsubmit="return false"',
		$live ? '' : ' disabled'
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
	// Gated Download passes hidden fields and, locally, a fallback action; the shortcode itself does not.
	$extra = array(
		'hidden' => (array) ( $atts['hidden'] ?? array() ),
		'action' => (string) ( $atts['action'] ?? '' ),
	);
	$atts  = shortcode_atts(
		array(
			'key'       => '',
			'link'      => '',
			'link_text' => '',
			'layout'    => '',
		),
		$atts,
		'nsf_form'
	) + $extra;
	$form  = nsf_form_definition( $atts['key'] );
	if ( ! $form ) {
		return '';
	}

	$id = nsf_form_id( $atts['key'] );
	if ( $id && function_exists( 'gravity_form' ) ) {
		$link   = nsf_form_link_html( $atts );
		$filter = function ( $button ) use ( $link ) {
			return $button . $link;
		};
		$hidden = '';
		foreach ( $atts['hidden'] as $name => $value ) {
			$hidden .= sprintf( '<input type="hidden" name="%1$s" value="%2$s" />', esc_attr( $name ), esc_attr( $value ) );
		}
		$tag = function ( $form_tag ) use ( $hidden ) {
			return $form_tag . $hidden;
		};
		add_filter( "gform_submit_button_{$id}", $filter );
		add_filter( "gform_form_tag_{$id}", $tag );
		$html = gravity_form( $id, false, false, false, null, true, 0, false );
		remove_filter( "gform_submit_button_{$id}", $filter );
		remove_filter( "gform_form_tag_{$id}", $tag );
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
	wp_add_inline_script( 'wp-blocks', 'window.nsfForms = ' . wp_json_encode( $forms ) . ';', 'after' );
}
add_action( 'enqueue_block_editor_assets', 'nsf_form_editor_data' );
