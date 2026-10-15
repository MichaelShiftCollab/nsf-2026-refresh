/**
 * Resource details panel in the Resource editor sidebar: subtitle, byline,
 * attached file and the gated switch (Resource meta from the NSF plugin).
 *
 * Plain script on the wp globals, so it needs no build step.
 */
( function ( wp ) {
	const { createElement: el, Fragment } = wp.element;
	const { __ } = wp.i18n;
	const { registerPlugin } = wp.plugins;
	const { PluginDocumentSettingPanel } = wp.editor;
	const { MediaUpload, MediaUploadCheck } = wp.blockEditor;
	const { Button, TextControl, ToggleControl } = wp.components;
	const { useSelect, useDispatch } = wp.data;

	function ResourceDetails() {
		const meta = useSelect(
			( select ) =>
				select( 'core/editor' ).getEditedPostAttribute( 'meta' ) || {},
			[]
		);
		const fileId = meta.nsf_file_id || 0;
		const file = useSelect(
			( select ) =>
				fileId ? select( 'core' ).getMedia( fileId ) : null,
			[ fileId ]
		);
		const { editPost } = useDispatch( 'core/editor' );
		const setMeta = ( key, value ) =>
			editPost( { meta: { [ key ]: value } } );

		const fileName = file
			? file.title?.rendered || file.source_url.split( '/' ).pop()
			: '';

		return el(
			PluginDocumentSettingPanel,
			{
				name: 'nsf-resource-details',
				title: __( 'Resource details', 'nsf' ),
			},
			el( TextControl, {
				__nextHasNoMarginBottom: true,
				__next40pxDefaultSize: true,
				label: __( 'Subtitle', 'nsf' ),
				value: meta.nsf_subtitle || '',
				onChange: ( value ) => setMeta( 'nsf_subtitle', value ),
			} ),
			el( 'div', { style: { height: 16 } } ),
			el( TextControl, {
				__nextHasNoMarginBottom: true,
				__next40pxDefaultSize: true,
				label: __( 'Byline', 'nsf' ),
				help: __(
					'Shown before the publish date, e.g. "A report from the National Sleep Foundation".',
					'nsf'
				),
				value: meta.nsf_byline || '',
				onChange: ( value ) => setMeta( 'nsf_byline', value ),
			} ),
			el( 'p', { style: { margin: '16px 0 8px' } }, __( 'File', 'nsf' ) ),
			el(
				MediaUploadCheck,
				null,
				el( MediaUpload, {
					value: fileId,
					onSelect: ( media ) => setMeta( 'nsf_file_id', media.id ),
					render: ( { open } ) =>
						el(
							Fragment,
							null,
							fileName && el( 'p', null, fileName ),
							el(
								Button,
								{ variant: 'secondary', onClick: open },
								fileId
									? __( 'Replace file', 'nsf' )
									: __( 'Choose file', 'nsf' )
							),
							fileId > 0 &&
								el(
									Button,
									{
										variant: 'link',
										isDestructive: true,
										style: { marginLeft: 12 },
										onClick: () =>
											setMeta( 'nsf_file_id', 0 ),
									},
									__( 'Remove', 'nsf' )
								)
						),
				} )
			),
			el( 'div', { style: { height: 16 } } ),
			el( ToggleControl, {
				__nextHasNoMarginBottom: true,
				label: __( 'Gated download', 'nsf' ),
				help: __(
					'Visitors fill in a form to get the file. The download button is hidden until the Gated Download form is built.',
					'nsf'
				),
				checked: !! meta.nsf_gated,
				onChange: ( value ) => setMeta( 'nsf_gated', value ),
			} )
		);
	}

	registerPlugin( 'nsf-resource-details', { render: ResourceDetails } );
} )( window.wp );
