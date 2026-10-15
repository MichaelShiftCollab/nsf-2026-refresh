/**
 * General CTA Row: heading, one line of copy and one button.
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

const template = ( buttonText, url ) => [
	[
		'core/group',
		{ className: 'nsf-cta-row__copy', layout: { type: 'default' } },
		[
			[
				'core/heading',
				{
					content: __( 'Call to action heading', 'nsf' ),
					className: 'is-style-card-heading',
				},
			],
			[
				'core/paragraph',
				{ content: __( 'One line of supporting copy.', 'nsf' ) },
			],
		],
	],
	[ 'core/buttons', {}, [ [ 'core/button', { text: buttonText, url } ] ] ],
];

function Edit() {
	const blockProps = useBlockProps( { className: 'nsf-cta-row' } );
	const innerBlocksProps = useInnerBlocksProps( blockProps, {
		template: template( __( 'Go to the form →', 'nsf' ), '' ),
		templateLock: 'insert',
	} );
	return <div { ...innerBlocksProps } />;
}

registerBlockType( metadata.name, {
	edit: Edit,
	save: () => <InnerBlocks.Content />,
	variations: [
		{
			name: 'form',
			title: __( 'General CTA Row — form page', 'nsf' ),
			description: __( 'The button goes to a form page.', 'nsf' ),
			isDefault: true,
			innerBlocks: template( __( 'Go to the form →', 'nsf' ), '' ),
			scope: [ 'inserter' ],
		},
		{
			name: 'email',
			title: __( 'General CTA Row — email', 'nsf' ),
			description: __(
				'The button sends an email. Link it to mailto: and the address.',
				'nsf'
			),
			innerBlocks: template( __( 'Email us', 'nsf' ), 'mailto:' ),
			scope: [ 'inserter' ],
		},
	],
} );
