/**
 * Flexible CTA with Form: copy on the left, a picked form on the right.
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
import ServerSideRender from '@wordpress/server-side-render';

import { FormPicker } from '../../editor/controls';
import metadata from './block.json';

const TEMPLATE = [
	[
		'core/heading',
		{ content: __( 'Let’s connect about advancing sleep health', 'nsf' ) },
	],
	[
		'core/paragraph',
		{
			content: __(
				'A sentence or two about what the form is for.',
				'nsf'
			),
		},
	],
];

function Edit( { attributes, setAttributes } ) {
	const blockProps = useBlockProps( { className: 'nsf-split' } );
	const innerBlocksProps = useInnerBlocksProps(
		{ className: 'nsf-split__copy' },
		{
			template: TEMPLATE,
			allowedBlocks: [ 'core/paragraph', 'core/heading', 'core/list' ],
		}
	);
	return (
		<>
			<InspectorControls>
				<PanelBody title={ __( 'Form', 'nsf' ) }>
					<FormPicker
						value={ attributes.formKey }
						onChange={ ( formKey ) => setAttributes( { formKey } ) }
					/>
				</PanelBody>
			</InspectorControls>
			<div { ...blockProps }>
				<div { ...innerBlocksProps } />
				<div className="nsf-split__panel">
					{ attributes.formKey ? (
						<ServerSideRender
							block="nsf/form"
							attributes={ { formKey: attributes.formKey } }
						/>
					) : (
						<p>
							{ __(
								'Choose a form in the block settings.',
								'nsf'
							) }
						</p>
					) }
				</div>
			</div>
		</>
	);
}

registerBlockType( metadata.name, {
	edit: Edit,
	save: () => <InnerBlocks.Content />,
} );
