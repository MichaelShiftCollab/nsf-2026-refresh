/**
 * Gated Download Success: cover, confirmation and the download button.
 */
import { registerBlockType } from '@wordpress/blocks';
import { __ } from '@wordpress/i18n';
import {
	InnerBlocks,
	RichText,
	useBlockProps,
	useInnerBlocksProps,
} from '@wordpress/block-editor';

import metadata from './block.json';

const TEMPLATE = [
	[
		'core/paragraph',
		{
			content: __(
				'Thank you. Your copy is ready to download below.',
				'nsf'
			),
		},
	],
];

function Edit( { attributes, setAttributes } ) {
	const blockProps = useBlockProps( { className: 'nsf-gated-success' } );
	const innerBlocksProps = useInnerBlocksProps(
		{ className: 'nsf-gated-success__text' },
		{ template: TEMPLATE, allowedBlocks: [ 'core/paragraph' ] }
	);
	return (
		<div { ...blockProps }>
			<div className="nsf-gated-success__cover">
				<span className="nsf-gated-success__cover__placeholder" />
			</div>
			<div className="nsf-gated-success__body">
				<div { ...innerBlocksProps } />
				<div className="wp-block-button">
					<RichText
						tagName="span"
						className="wp-block-button__link wp-element-button nsf-download-button"
						value={ attributes.buttonText }
						allowedFormats={ [] }
						onChange={ ( buttonText ) =>
							setAttributes( { buttonText } )
						}
					/>
				</div>
				<p className="nsf-file-details">
					{ __(
						'The cover, file type and size come from the visitor’s download.',
						'nsf'
					) }
				</p>
			</div>
		</div>
	);
}

registerBlockType( metadata.name, {
	edit: Edit,
	save: () => <InnerBlocks.Content />,
} );
