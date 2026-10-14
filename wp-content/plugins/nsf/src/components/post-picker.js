/**
 * A combobox that searches posts, pages and resources by title.
 * The value is "type:id" so the block can load the picked item.
 */
import { __ } from '@wordpress/i18n';
import { ComboboxControl } from '@wordpress/components';
import { useSelect } from '@wordpress/data';
import { store as coreStore } from '@wordpress/core-data';
import { useEffect, useState } from '@wordpress/element';
import { useDebounce } from '@wordpress/compose';
import apiFetch from '@wordpress/api-fetch';
import { addQueryArgs } from '@wordpress/url';

function usePostSearch( search ) {
	const [ results, setResults ] = useState( [] );
	useEffect( () => {
		if ( ! search ) {
			setResults( [] );
			return;
		}
		let cancelled = false;
		apiFetch( {
			path: addQueryArgs( '/wp/v2/search', {
				search,
				type: 'post',
				subtype: 'any',
				per_page: 20,
			} ),
		} ).then( ( items ) => {
			if ( ! cancelled ) {
				setResults( items );
			}
		} );
		return () => {
			cancelled = true;
		};
	}, [ search ] );
	return results;
}

export default function PostPicker( {
	label = __( 'Post, page or resource', 'nsf' ),
	help,
	postId,
	postType,
	onChange,
} ) {
	const [ search, setSearch ] = useState( '' );
	const setSearchDebounced = useDebounce( setSearch, 300 );
	const results = usePostSearch( search );

	const picked = useSelect(
		( select ) =>
			postId && postType
				? select( coreStore ).getEntityRecord(
						'postType',
						postType,
						postId
					)
				: null,
		[ postId, postType ]
	);

	const options = results.map( ( item ) => ( {
		value: `${ item.subtype }:${ item.id }`,
		label: `${ item.title } (${ item.subtype })`,
	} ) );
	if ( picked ) {
		options.unshift( {
			value: `${ postType }:${ postId }`,
			label: `${ picked.title?.rendered || picked.title?.raw } (${ postType })`,
		} );
	}

	return (
		<ComboboxControl
			__nextHasNoMarginBottom
			__next40pxDefaultSize
			label={ label }
			help={ help }
			value={ postId ? `${ postType }:${ postId }` : null }
			options={ options }
			onFilterValueChange={ setSearchDebounced }
			onChange={ ( value ) => {
				if ( ! value ) {
					onChange( { postId: undefined, postType: undefined } );
					return;
				}
				const [ type, id ] = value.split( ':' );
				onChange( { postId: Number( id ), postType: type } );
			} }
		/>
	);
}
