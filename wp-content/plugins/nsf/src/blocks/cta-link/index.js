/**
 * Flexible CTA with Link: eyebrow, heading, copy and a button link.
 */
import { registerBlockType } from '@wordpress/blocks';
import { __ } from '@wordpress/i18n';
import {
	InnerBlocks,
	useBlockProps,
	useInnerBlocksProps,
} from '@wordpress/block-editor';

import metadata from './block.json';
import './style.scss';

const TEMPLATE = [
	[
		'core/paragraph',
		{
			className: 'is-style-eyebrow-small',
			content: __( 'Support NSF', 'nsf' ),
		},
	],
	[
		'core/heading',
		{ content: __( 'Help everyone be their Best Slept Self®', 'nsf' ) },
	],
	[
		'core/paragraph',
		{
			content: __(
				'Your gift funds sleep research and public education.',
				'nsf'
			),
		},
	],
	[
		'core/buttons',
		{ layout: { type: 'flex', justifyContent: 'center' } },
		[ [ 'core/button', { text: __( 'Donate', 'nsf' ) } ] ],
	],
];

function Edit() {
	const blockProps = useBlockProps( { className: 'nsf-cta-link' } );
	const innerBlocksProps = useInnerBlocksProps( blockProps, {
		template: TEMPLATE,
		allowedBlocks: [ 'core/paragraph', 'core/heading', 'core/buttons' ],
	} );
	return <div { ...innerBlocksProps } />;
}

registerBlockType( metadata.name, {
	edit: Edit,
	save: () => <InnerBlocks.Content />,
} );
