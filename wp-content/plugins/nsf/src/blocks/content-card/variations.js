import { __ } from '@wordpress/i18n';

const isActive = ( attributes, variationAttributes ) =>
	attributes.variant === variationAttributes.variant;

export default [
	{
		name: 'featured-image',
		title: __( 'Content Card: Featured image', 'nsf' ),
		description: __(
			'Image on top, eyebrow, title and excerpt. For posts and resources.',
			'nsf'
		),
		attributes: { variant: 'featured-image' },
		isDefault: true,
		isActive,
		scope: [ 'inserter', 'block', 'transform' ],
	},
	{
		name: 'navy',
		title: __( 'Content Card: Navy fill', 'nsf' ),
		description: __(
			'Dark blue card with eyebrow, title, text and a link. For related child pages.',
			'nsf'
		),
		attributes: { variant: 'navy' },
		isActive,
		scope: [ 'inserter', 'block', 'transform' ],
	},
	{
		name: 'outline-icon',
		title: __( 'Content Card: Outline and icon', 'nsf' ),
		description: __(
			'Outlined card with an icon, title, text and a link. For main parent pages.',
			'nsf'
		),
		attributes: { variant: 'outline-icon' },
		isActive,
		scope: [ 'inserter', 'block', 'transform' ],
	},
];
