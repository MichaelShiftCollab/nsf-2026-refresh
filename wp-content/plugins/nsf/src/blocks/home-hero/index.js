/**
 * Home Hero: H1 over up to six rotating images.
 */
import { registerBlockType } from '@wordpress/blocks';
import { __ } from '@wordpress/i18n';
import {
	InspectorControls,
	MediaUpload,
	MediaUploadCheck,
	RichText,
	useBlockProps,
} from '@wordpress/block-editor';
import { Button, PanelBody, RangeControl } from '@wordpress/components';

import metadata from './block.json';
import './style.scss';
import './editor.scss';

const MAX_IMAGES = 6;

function Edit( { attributes, setAttributes } ) {
	const { heading, images, interval } = attributes;
	const blockProps = useBlockProps( { className: 'nsf-hero' } );

	return (
		<>
			<InspectorControls>
				<PanelBody title={ __( 'Images', 'nsf' ) }>
					<div className="nsf-hero__editor-images">
						{ images.map( ( image, i ) => (
							<img key={ i } src={ image.url } alt="" />
						) ) }
					</div>
					<MediaUploadCheck>
						<MediaUpload
							multiple
							gallery
							allowedTypes={ [ 'image' ] }
							value={ images
								.map( ( image ) => image.id )
								.filter( Boolean ) }
							onSelect={ ( items ) =>
								setAttributes( {
									images: items
										.slice( 0, MAX_IMAGES )
										.map( ( item ) => ( {
											id: item.id,
											url: item.url,
											alt: item.alt,
										} ) ),
								} )
							}
							render={ ( { open } ) => (
								<Button variant="secondary" onClick={ open }>
									{ images.length
										? __( 'Change images', 'nsf' )
										: __(
												'Choose up to six images',
												'nsf'
											) }
								</Button>
							) }
						/>
					</MediaUploadCheck>
					<RangeControl
						__nextHasNoMarginBottom
						__next40pxDefaultSize
						label={ __( 'Seconds per image', 'nsf' ) }
						value={ interval }
						min={ 3 }
						max={ 15 }
						onChange={ ( value ) =>
							setAttributes( { interval: value } )
						}
					/>
				</PanelBody>
			</InspectorControls>
			<section { ...blockProps }>
				<div className="nsf-hero__inner">
					<RichText
						tagName="h1"
						className="nsf-hero__heading"
						value={ heading }
						allowedFormats={ [] }
						placeholder={ __( 'Hero heading', 'nsf' ) }
						onChange={ ( value ) =>
							setAttributes( { heading: value } )
						}
					/>
					{ images[ 0 ] ? (
						<div className="nsf-hero__slides">
							<img
								className="nsf-hero__image is-active"
								src={ images[ 0 ].url }
								alt=""
							/>
						</div>
					) : null }
				</div>
			</section>
		</>
	);
}

registerBlockType( metadata.name, {
	edit: Edit,
	save: () => null,
} );
