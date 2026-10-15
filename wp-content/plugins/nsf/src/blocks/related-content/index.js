/**
 * Related Content: three picked items shown as featured image cards.
 */
import { registerBlockType } from '@wordpress/blocks';
import { __, sprintf } from '@wordpress/i18n';
import { InspectorControls, useBlockProps } from '@wordpress/block-editor';
import { PanelBody } from '@wordpress/components';
import ServerSideRender from '@wordpress/server-side-render';

import metadata from './block.json';
import PostPicker from '../../components/post-picker';

function Edit( { attributes, setAttributes, context } ) {
	const items = [ 0, 1, 2 ].map( ( i ) => attributes.items[ i ] || {} );
	const setItem = ( index, value ) => {
		const next = items.map( ( item, i ) =>
			i === index ? { id: value.postId, type: value.postType } : item
		);
		setAttributes( { items: next.filter( ( item ) => item.id ) } );
	};

	return (
		<>
			<InspectorControls>
				<PanelBody title={ __( 'Related items', 'nsf' ) }>
					{ items.map( ( item, i ) => (
						<PostPicker
							key={ i }
							label={ sprintf(
								/* translators: %d: card number. */
								__( 'Card %d', 'nsf' ),
								i + 1
							) }
							postId={ item.id }
							postType={ item.type }
							onChange={ ( value ) => setItem( i, value ) }
						/>
					) ) }
					<p>
						{ __(
							'Empty cards show resources on the same topic.',
							'nsf'
						) }
					</p>
				</PanelBody>
			</InspectorControls>
			<div { ...useBlockProps() }>
				<ServerSideRender
					block={ metadata.name }
					attributes={ attributes }
					urlQueryArgs={
						context.postId ? { post_id: context.postId } : {}
					}
					skipBlockSupportAttributes
				/>
			</div>
		</>
	);
}

registerBlockType( metadata.name, {
	edit: Edit,
	save: () => null,
} );
