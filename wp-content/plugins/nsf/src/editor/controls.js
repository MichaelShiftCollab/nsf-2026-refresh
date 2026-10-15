/**
 * Inspector controls shared by the CTA and Gated Download blocks.
 */
import { __ } from '@wordpress/i18n';
import { MediaUpload, MediaUploadCheck } from '@wordpress/block-editor';
import { Button, SelectControl } from '@wordpress/components';
import { useSelect } from '@wordpress/data';
import { store as coreStore } from '@wordpress/core-data';

/**
 * Picks one of the forms in the NSF plugin's forms/ folder by its key.
 *
 * @param {Object}                  props
 * @param {string}                  props.value
 * @param {(value: string) => void} props.onChange
 */
export function FormPicker( { value, onChange } ) {
	return (
		<SelectControl
			__nextHasNoMarginBottom
			__next40pxDefaultSize
			label={ __( 'Form', 'nsf' ) }
			value={ value }
			options={ [
				{ value: '', label: __( 'Choose a form', 'nsf' ) },
				...( window.nsfForms || [] ),
			] }
			onChange={ onChange }
		/>
	);
}

/**
 * Picks a published page.
 *
 * @param {Object}               props
 * @param {string}               props.label
 * @param {string}               props.help
 * @param {number}               props.value
 * @param {(id: number) => void} props.onChange
 */
export function PagePicker( { label, help, value, onChange } ) {
	const pages = useSelect(
		( select ) =>
			select( coreStore ).getEntityRecords( 'postType', 'page', {
				per_page: 100,
				status: 'publish',
				orderby: 'title',
				order: 'asc',
				_fields: 'id,title',
			} ),
		[]
	);
	return (
		<SelectControl
			__nextHasNoMarginBottom
			__next40pxDefaultSize
			label={ label }
			help={ help }
			value={ value || 0 }
			options={ [
				{ value: 0, label: __( 'This page', 'nsf' ) },
				...( pages || [] ).map( ( page ) => ( {
					value: page.id,
					label: page.title.rendered || `#${ page.id }`,
				} ) ),
			] }
			onChange={ ( id ) => onChange( Number( id ) ) }
		/>
	);
}

/**
 * Chooses or removes one media item.
 *
 * @param {Object}                   props
 * @param {string}                   props.label        Button label when nothing is chosen.
 * @param {number}                   props.value        Attachment ID.
 * @param {string}                   props.name         What is chosen, shown when set.
 * @param {string[]}                 props.allowedTypes
 * @param {(media: ?Object) => void} props.onSelect     Receives the media item, or null.
 */
export function MediaPicker( { label, value, name, allowedTypes, onSelect } ) {
	return (
		<MediaUploadCheck>
			<MediaUpload
				allowedTypes={ allowedTypes }
				value={ value }
				onSelect={ onSelect }
				render={ ( { open } ) => (
					<div className="nsf-media-picker">
						{ value ? <p>{ name }</p> : null }
						<Button variant="secondary" onClick={ open }>
							{ value ? __( 'Replace', 'nsf' ) : label }
						</Button>
						{ value ? (
							<Button
								variant="link"
								isDestructive
								onClick={ () => onSelect( null ) }
							>
								{ __( 'Remove', 'nsf' ) }
							</Button>
						) : null }
					</div>
				) }
			/>
		</MediaUploadCheck>
	);
}
