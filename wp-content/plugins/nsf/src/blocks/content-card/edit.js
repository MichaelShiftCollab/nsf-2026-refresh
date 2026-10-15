import { __ } from '@wordpress/i18n';
import {
	InspectorControls,
	MediaUpload,
	MediaUploadCheck,
	useBlockProps,
} from '@wordpress/block-editor';
import {
	Button,
	PanelBody,
	SelectControl,
	TextControl,
	TextareaControl,
	ToggleControl,
} from '@wordpress/components';
import { useSelect } from '@wordpress/data';
import { store as coreStore } from '@wordpress/core-data';
import ServerSideRender from '@wordpress/server-side-render';

import PostPicker from '../../components/post-picker';

const VARIANTS = [
	{ value: 'featured-image', label: __( 'Featured image', 'nsf' ) },
	{ value: 'navy', label: __( 'Navy fill', 'nsf' ) },
	{ value: 'outline-icon', label: __( 'Outline and icon', 'nsf' ) },
];

export default function Edit( { attributes, setAttributes, context } ) {
	const {
		variant,
		postId,
		postType,
		eyebrow,
		title,
		excerpt,
		url,
		linkText,
		mediaId,
		showExcerpt,
		showMeta,
		showDate,
		eyebrowSource,
		headingLevel,
	} = attributes;
	const inQueryLoop = !! context.postId && ! postId;

	const media = useSelect(
		( select ) =>
			mediaId ? select( coreStore ).getMedia( mediaId ) : null,
		[ mediaId ]
	);

	const blockProps = useBlockProps();
	const isImageVariant = variant === 'featured-image';

	return (
		<>
			<InspectorControls>
				<PanelBody title={ __( 'Card', 'nsf' ) }>
					<SelectControl
						__nextHasNoMarginBottom
						__next40pxDefaultSize
						label={ __( 'Style', 'nsf' ) }
						value={ variant }
						options={ VARIANTS }
						onChange={ ( value ) =>
							setAttributes( { variant: value } )
						}
					/>
					{ inQueryLoop ? (
						<p>
							{ __(
								'Showing the current item of the Query Loop. Pick a post to override it.',
								'nsf'
							) }
						</p>
					) : null }
					<PostPicker
						help={ __(
							'Fills the title, excerpt, link and image. Fields below override it.',
							'nsf'
						) }
						postId={ postId }
						postType={ postType }
						onChange={ setAttributes }
					/>
				</PanelBody>
				<PanelBody
					title={ __( 'Overrides', 'nsf' ) }
					initialOpen={ false }
				>
					<TextControl
						__nextHasNoMarginBottom
						__next40pxDefaultSize
						label={ __( 'Eyebrow', 'nsf' ) }
						help={ __(
							'Defaults to the resource type or topic.',
							'nsf'
						) }
						value={ eyebrow }
						onChange={ ( value ) =>
							setAttributes( { eyebrow: value } )
						}
					/>
					<TextControl
						__nextHasNoMarginBottom
						__next40pxDefaultSize
						label={ __( 'Title', 'nsf' ) }
						value={ title }
						onChange={ ( value ) =>
							setAttributes( { title: value } )
						}
					/>
					<TextareaControl
						__nextHasNoMarginBottom
						label={ __( 'Excerpt', 'nsf' ) }
						value={ excerpt }
						onChange={ ( value ) =>
							setAttributes( { excerpt: value } )
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
					<TextControl
						__nextHasNoMarginBottom
						__next40pxDefaultSize
						label={ __( 'Link text', 'nsf' ) }
						help={ __(
							'Navy and outline cards default to "Learn more".',
							'nsf'
						) }
						value={ linkText }
						onChange={ ( value ) =>
							setAttributes( { linkText: value } )
						}
					/>
					<MediaUploadCheck>
						<MediaUpload
							allowedTypes={ [ 'image' ] }
							value={ mediaId }
							onSelect={ ( item ) =>
								setAttributes( { mediaId: item.id } )
							}
							render={ ( { open } ) => (
								<div>
									<p>
										{ isImageVariant
											? __( 'Image', 'nsf' )
											: __( 'Icon', 'nsf' ) }
										{ media
											? `: ${ media.source_url.split( '/' ).pop() }`
											: '' }
									</p>
									<Button
										variant="secondary"
										onClick={ open }
									>
										{ mediaId
											? __( 'Replace', 'nsf' )
											: __( 'Choose', 'nsf' ) }
									</Button>{ ' ' }
									{ mediaId ? (
										<Button
											variant="tertiary"
											isDestructive
											onClick={ () =>
												setAttributes( {
													mediaId: undefined,
												} )
											}
										>
											{ __( 'Remove', 'nsf' ) }
										</Button>
									) : null }
								</div>
							) }
						/>
					</MediaUploadCheck>
				</PanelBody>
				<PanelBody
					title={ __( 'Display', 'nsf' ) }
					initialOpen={ false }
				>
					<ToggleControl
						__nextHasNoMarginBottom
						label={ __( 'Show excerpt', 'nsf' ) }
						checked={ showExcerpt }
						onChange={ ( value ) =>
							setAttributes( { showExcerpt: value } )
						}
					/>
					<ToggleControl
						__nextHasNoMarginBottom
						label={ __(
							'Show meta line (Topic · Audience · Date)',
							'nsf'
						) }
						checked={ showMeta }
						onChange={ ( value ) =>
							setAttributes( { showMeta: value } )
						}
					/>
					{ ! showMeta && (
						<ToggleControl
							__nextHasNoMarginBottom
							label={ __( 'Show date', 'nsf' ) }
							checked={ showDate }
							onChange={ ( value ) =>
								setAttributes( { showDate: value } )
							}
						/>
					) }
					<SelectControl
						__nextHasNoMarginBottom
						__next40pxDefaultSize
						label={ __( 'Eyebrow from', 'nsf' ) }
						help={ __(
							'Used when the eyebrow field is empty.',
							'nsf'
						) }
						value={ eyebrowSource }
						options={ [
							{
								value: 'auto',
								label: __( 'Type, topic or category', 'nsf' ),
							},
							{
								value: 'category',
								label: __( 'Category', 'nsf' ),
							},
							{ value: 'none', label: __( 'No eyebrow', 'nsf' ) },
						] }
						onChange={ ( value ) =>
							setAttributes( { eyebrowSource: value } )
						}
					/>
					<SelectControl
						__nextHasNoMarginBottom
						__next40pxDefaultSize
						label={ __( 'Title heading level', 'nsf' ) }
						value={ headingLevel }
						options={ [ 2, 3, 4 ].map( ( level ) => ( {
							value: level,
							label: `H${ level }`,
						} ) ) }
						onChange={ ( value ) =>
							setAttributes( { headingLevel: Number( value ) } )
						}
					/>
				</PanelBody>
			</InspectorControls>
			<div { ...blockProps }>
				<ServerSideRender
					block="nsf/content-card"
					attributes={ {
						...attributes,
						postId: postId || context.postId,
						postType: postType || context.postType,
					} }
					skipBlockSupportAttributes
				/>
			</div>
		</>
	);
}
