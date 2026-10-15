/**
 * Alert Banner: announcement above the header with an on/off control.
 */
import { registerBlockType } from '@wordpress/blocks';
import { __ } from '@wordpress/i18n';
import {
	InspectorControls,
	RichText,
	useBlockProps,
} from '@wordpress/block-editor';
import {
	Notice,
	PanelBody,
	TextControl,
	ToggleControl,
} from '@wordpress/components';

import metadata from './block.json';
import './style.scss';

function Edit( { attributes, setAttributes } ) {
	const { enabled, text, linkText, url } = attributes;
	const blockProps = useBlockProps( {
		className: 'nsf-alert',
		style: enabled ? undefined : { opacity: 0.5 },
	} );

	return (
		<>
			<InspectorControls>
				<PanelBody title={ __( 'Alert Banner', 'nsf' ) }>
					<ToggleControl
						__nextHasNoMarginBottom
						label={ __( 'Show the banner', 'nsf' ) }
						help={ __(
							'When off, the banner is removed from every page.',
							'nsf'
						) }
						checked={ enabled }
						onChange={ ( value ) =>
							setAttributes( { enabled: value } )
						}
					/>
					<TextControl
						__nextHasNoMarginBottom
						__next40pxDefaultSize
						label={ __( 'Link URL', 'nsf' ) }
						type="url"
						value={ url }
						onChange={ ( value ) =>
							setAttributes( { url: value } )
						}
					/>
				</PanelBody>
			</InspectorControls>
			<div { ...blockProps }>
				{ ! enabled ? (
					<Notice status="warning" isDismissible={ false }>
						{ __(
							'The Alert Banner is off and hidden on the site.',
							'nsf'
						) }
					</Notice>
				) : null }
				<p className="nsf-alert__text">
					<RichText
						tagName="span"
						value={ text }
						allowedFormats={ [ 'core/bold' ] }
						placeholder={ __( 'Announcement text', 'nsf' ) }
						onChange={ ( value ) =>
							setAttributes( { text: value } )
						}
					/>{ ' ' }
					<RichText
						tagName="span"
						className="nsf-alert__link"
						value={ linkText }
						allowedFormats={ [] }
						placeholder={ __( 'Link text', 'nsf' ) }
						onChange={ ( value ) =>
							setAttributes( { linkText: value } )
						}
					/>
				</p>
			</div>
		</>
	);
}

registerBlockType( metadata.name, {
	edit: Edit,
	save: () => null,
} );
