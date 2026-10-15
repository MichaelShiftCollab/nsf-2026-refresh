/**
 * Page details panel in the page editor sidebar: the subtitle shown in the
 * title band (nsf_subtitle meta, build plan step 15).
 *
 * Plain script on the wp globals, so it needs no build step.
 */
( function ( wp ) {
	const { createElement: el } = wp.element;
	const { __ } = wp.i18n;
	const { registerPlugin } = wp.plugins;
	const { PluginDocumentSettingPanel } = wp.editor;
	const { TextControl } = wp.components;
	const { useSelect, useDispatch } = wp.data;

	function PageDetails() {
		const subtitle = useSelect(
			( select ) =>
				( select( 'core/editor' ).getEditedPostAttribute( 'meta' ) || {} )
					.nsf_subtitle || '',
			[]
		);
		const { editPost } = useDispatch( 'core/editor' );

		return el(
			PluginDocumentSettingPanel,
			{
				name: 'nsf-page-details',
				title: __( 'Title band', 'nsf' ),
			},
			el( TextControl, {
				__nextHasNoMarginBottom: true,
				__next40pxDefaultSize: true,
				label: __( 'Subtitle', 'nsf' ),
				help: __( 'One or two lines under the page title.', 'nsf' ),
				value: subtitle,
				onChange: ( value ) =>
					editPost( { meta: { nsf_subtitle: value } } ),
			} )
		);
	}

	registerPlugin( 'nsf-page-details', { render: PageDetails } );
} )( window.wp );
