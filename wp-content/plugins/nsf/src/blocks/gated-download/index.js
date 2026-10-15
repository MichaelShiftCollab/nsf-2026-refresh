/**
 * Gated Download: cover, title and file details beside a form.
 */
import { registerBlockType } from '@wordpress/blocks';
import { __ } from '@wordpress/i18n';
import {
	InnerBlocks,
	InspectorControls,
	useBlockProps,
	useInnerBlocksProps,
} from '@wordpress/block-editor';
import { PanelBody } from '@wordpress/components';
import { useSelect } from '@wordpress/data';
import { store as coreStore } from '@wordpress/core-data';
import ServerSideRender from '@wordpress/server-side-render';

import { FormPicker, MediaPicker, PagePicker } from '../../editor/controls';
import metadata from './block.json';
import './style.scss';

const TEMPLATE = [
	[
		'core/paragraph',
		{
			className: 'is-style-eyebrow-small',
			content: __( 'Sponsorship Prospectus', 'nsf' ),
		},
	],
	[
		'core/heading',
		{
			className: 'is-style-card-heading',
			content: __(
				'Please fill out the form below to receive a copy of our 2025–2026 prospectus.',
				'nsf'
			),
		},
	],
];

function Edit( { attributes, setAttributes } ) {
	const { coverId, fileId, formKey, successPageId } = attributes;
	const { cover, file } = useSelect(
		( select ) => ( {
			cover: coverId ? select( coreStore ).getMedia( coverId ) : null,
			file: fileId ? select( coreStore ).getMedia( fileId ) : null,
		} ),
		[ coverId, fileId ]
	);
	const blockProps = useBlockProps( { className: 'nsf-split' } );
	const innerBlocksProps = useInnerBlocksProps(
		{ className: 'nsf-gated__text' },
		{
			template: TEMPLATE,
			allowedBlocks: [ 'core/paragraph', 'core/heading' ],
		}
	);

	return (
		<>
			<InspectorControls>
				<PanelBody title={ __( 'Download', 'nsf' ) }>
					<p>{ __( 'File', 'nsf' ) }</p>
					<MediaPicker
						label={ __( 'Choose the file', 'nsf' ) }
						value={ fileId }
						name={ file?.title?.rendered || file?.source_url }
						onSelect={ ( media ) =>
							setAttributes( { fileId: media?.id || 0 } )
						}
					/>
					<p>{ __( 'Cover', 'nsf' ) }</p>
					<MediaPicker
						label={ __( 'Choose a cover image', 'nsf' ) }
						allowedTypes={ [ 'image' ] }
						value={ coverId }
						name={ cover?.title?.rendered }
						onSelect={ ( media ) =>
							setAttributes( { coverId: media?.id || 0 } )
						}
					/>
					<FormPicker
						value={ formKey }
						onChange={ ( value ) =>
							setAttributes( { formKey: value } )
						}
					/>
					<PagePicker
						label={ __( 'Success page', 'nsf' ) }
						help={ __(
							'The page with the Gated Download Success block. Visitors land there after they submit the form.',
							'nsf'
						) }
						value={ successPageId }
						onChange={ ( id ) =>
							setAttributes( { successPageId: id } )
						}
					/>
				</PanelBody>
			</InspectorControls>
			<div { ...blockProps }>
				<div className="nsf-split__copy nsf-gated">
					<div className="nsf-gated__cover">
						{ cover?.source_url ? (
							<img
								className="nsf-gated__cover__img"
								src={ cover.source_url }
								alt=""
							/>
						) : (
							<span className="nsf-gated__cover__placeholder" />
						) }
					</div>
					<div { ...innerBlocksProps } />
					<p className="nsf-file-details">
						{ file
							? file.mime_type?.split( '/' ).pop().toUpperCase()
							: __(
									'Choose the file in the block settings',
									'nsf'
								) }
					</p>
				</div>
				<div className="nsf-split__panel">
					{ formKey ? (
						<ServerSideRender
							block="nsf/form"
							attributes={ { formKey } }
						/>
					) : null }
				</div>
			</div>
		</>
	);
}

registerBlockType( metadata.name, {
	edit: Edit,
	save: () => <InnerBlocks.Content />,
} );
