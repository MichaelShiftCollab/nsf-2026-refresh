/**
 * NSF Form: a Gravity Form picked by its key from the NSF plugin's forms/.
 */
import { registerBlockType } from '@wordpress/blocks';
import { __ } from '@wordpress/i18n';
import { InspectorControls, useBlockProps } from '@wordpress/block-editor';
import { PanelBody, SelectControl, TextControl } from '@wordpress/components';
import ServerSideRender from '@wordpress/server-side-render';

import metadata from './block.json';

function Edit( { attributes, setAttributes } ) {
	const forms = window.nsfForms || [];
	return (
		<>
			<InspectorControls>
				<PanelBody title={ __( 'Form', 'nsf' ) }>
					<SelectControl
						__nextHasNoMarginBottom
						__next40pxDefaultSize
						label={ __( 'Form', 'nsf' ) }
						value={ attributes.formKey }
						options={ [
							{ value: '', label: __( 'Choose a form', 'nsf' ) },
							...forms,
						] }
						onChange={ ( value ) =>
							setAttributes( { formKey: value } )
						}
					/>
					<SelectControl
						__nextHasNoMarginBottom
						__next40pxDefaultSize
						label={ __( 'Layout', 'nsf' ) }
						value={ attributes.layout }
						options={ [
							{ value: '', label: __( 'Stacked', 'nsf' ) },
							{
								value: 'inline',
								label: __( 'One row (sign-up)', 'nsf' ),
							},
						] }
						onChange={ ( value ) =>
							setAttributes( { layout: value } )
						}
					/>
					<TextControl
						__nextHasNoMarginBottom
						__next40pxDefaultSize
						label={ __( 'Link beside the button', 'nsf' ) }
						value={ attributes.linkText }
						onChange={ ( value ) =>
							setAttributes( { linkText: value } )
						}
					/>
					<TextControl
						__nextHasNoMarginBottom
						__next40pxDefaultSize
						label={ __( 'Link URL', 'nsf' ) }
						type="url"
						value={ attributes.url }
						onChange={ ( value ) =>
							setAttributes( { url: value } )
						}
					/>
				</PanelBody>
			</InspectorControls>
			<div { ...useBlockProps() }>
				{ attributes.formKey ? (
					<ServerSideRender
						block={ metadata.name }
						attributes={ attributes }
						skipBlockSupportAttributes
					/>
				) : (
					<p>
						{ __( 'Choose a form in the block settings.', 'nsf' ) }
					</p>
				) }
			</div>
		</>
	);
}

registerBlockType( metadata.name, {
	edit: Edit,
	save: () => null,
} );
