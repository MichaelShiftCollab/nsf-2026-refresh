/**
 * Resource Hub front end: filters, search, sort and pagination update the
 * results in place through the nsf/v1/resources endpoint, and the URL keeps
 * the filter state. Without JavaScript the same controls work as links and a
 * GET form.
 */

const FACETS = [ 'topics', 'audiences', 'types' ];
const VIEW_COOKIE = 'nsf_resource_view';

function readState( search ) {
	const query = new URLSearchParams( search );
	const state = {
		q: query.get( 'q' ) || '',
		sort: query.get( 'sort' ) || 'date-desc',
		pg: Number( query.get( 'pg' ) ) || 1,
	};
	FACETS.forEach( ( facet ) => {
		state[ facet ] = ( query.get( facet ) || '' )
			.split( ',' )
			.filter( Boolean );
	} );
	return state;
}

function toQuery( state ) {
	const query = new URLSearchParams();
	if ( state.q ) {
		query.set( 'q', state.q );
	}
	FACETS.forEach( ( facet ) => {
		if ( state[ facet ].length ) {
			query.set( facet, state[ facet ].join( ',' ) );
		}
	} );
	if ( state.sort !== 'date-desc' ) {
		query.set( 'sort', state.sort );
	}
	if ( state.pg > 1 ) {
		query.set( 'pg', String( state.pg ) );
	}
	return query;
}

function setView( results, view ) {
	results.classList.toggle( 'is-view-table', view === 'table' );
	results.classList.toggle( 'is-view-cards', view !== 'table' );
	results.querySelectorAll( '[data-view]' ).forEach( ( button ) => {
		button.setAttribute(
			'aria-pressed',
			String( button.dataset.view === view )
		);
	} );
}

// Hides facet options past the sixth behind "Show N more".
function collapseFacets( root ) {
	root.querySelectorAll( '.nsf-hub-facet' ).forEach( ( facet ) => {
		const more = facet.querySelector( '.nsf-hub-facet__more' );
		if ( ! more ) {
			return;
		}
		const extras = facet.querySelectorAll( '.is-extra' );
		const expanded = more.getAttribute( 'aria-expanded' ) === 'true';
		extras.forEach( ( option ) => ( option.hidden = ! expanded ) );
		more.textContent = expanded ? more.dataset.less : more.dataset.more;
	} );
}

function init( results ) {
	const filters = document.querySelector( '[data-nsf-hub-filters]' );
	const form = document.getElementById( 'nsf-hub-form' );
	const parts = {};
	document.querySelectorAll( '[data-hub-part]' ).forEach( ( el ) => {
		parts[ el.dataset.hubPart ] = el;
	} );
	const openButton = results.querySelector( '[data-hub-open]' );
	let state = readState( window.location.search );
	let controller;
	const expandedFacets = new Set();

	document.documentElement.classList.add( 'nsf-hub-js' );
	setView(
		results,
		results.classList.contains( 'is-view-table' ) ? 'table' : 'cards'
	);
	if ( filters ) {
		collapseFacets( filters );
	}
	form?.querySelector( '[data-hub-sort-fallback]' )?.remove();

	async function update( next, { push = true, scroll = false } = {} ) {
		state = next;
		const query = toQuery( state );
		query.set( 'base', results.dataset.base );
		controller?.abort();
		controller = new AbortController();
		results.setAttribute( 'aria-busy', 'true' );

		let data;
		try {
			const response = await window.fetch(
				`${ results.dataset.rest }?${ query }`,
				{
					signal: controller.signal,
					headers: { Accept: 'application/json' },
				}
			);
			if ( ! response.ok ) {
				throw new Error( response.statusText );
			}
			data = await response.json();
		} catch ( error ) {
			if ( error.name !== 'AbortError' ) {
				// Fall back to a normal page load.
				window.location.search = toQuery( state ).toString();
			}
			return;
		}

		// Keep focus on the control that changed while its markup is replaced.
		const focusedId = results.ownerDocument.activeElement?.id;
		parts.count.textContent = data.count;
		parts.chips.innerHTML = data.chips;
		parts.results.innerHTML = data.results;
		parts.active.textContent = data.active ? `(${ data.active })` : '';
		if ( parts.facets ) {
			parts.facets
				.querySelectorAll( '.nsf-hub-facet' )
				.forEach( ( facet ) => {
					const more = facet.querySelector( '.nsf-hub-facet__more' );
					if ( more?.getAttribute( 'aria-expanded' ) === 'true' ) {
						expandedFacets.add( facet.dataset.facet );
					}
				} );
			const openFacets = [
				...parts.facets.querySelectorAll( '.nsf-hub-facet[open]' ),
			].map( ( facet ) => facet.dataset.facet );
			parts.facets.innerHTML = data.facets;
			parts.facets
				.querySelectorAll( '.nsf-hub-facet' )
				.forEach( ( facet ) => {
					facet.open = openFacets.includes( facet.dataset.facet );
					if ( expandedFacets.has( facet.dataset.facet ) ) {
						facet
							.querySelector( '.nsf-hub-facet__more' )
							?.setAttribute( 'aria-expanded', 'true' );
					}
				} );
			collapseFacets( filters );
		}
		if ( focusedId && document.getElementById( focusedId ) ) {
			document.getElementById( focusedId ).focus();
		}
		const sort = document.getElementById( 'nsf-hub-sort' );
		if ( sort ) {
			if ( ! sort.querySelector( `option[value="${ data.sort }"]` ) ) {
				sort.add( new window.Option( data.sortLabel, data.sort ) );
			}
			sort.value = data.sort;
		}
		results.removeAttribute( 'aria-busy' );

		const url = `${ window.location.pathname }${
			toQuery( state ).toString() ? `?${ toQuery( state ) }` : ''
		}`;
		if ( push ) {
			window.history.pushState( state, '', url );
		} else {
			window.history.replaceState( state, '', url );
		}
		if ( scroll ) {
			results.scrollIntoView( { behavior: 'smooth', block: 'start' } );
		}
	}

	// Facet checkboxes and the search box.
	let searchTimer;
	form?.addEventListener( 'change', ( event ) => {
		const input = event.target;
		if ( ! input.matches( 'input[type="checkbox"]' ) ) {
			return;
		}
		const facet = input.name.replace( '[]', '' );
		const values = new Set( state[ facet ] );
		if ( input.checked ) {
			values.add( input.value );
		} else {
			values.delete( input.value );
		}
		update( { ...state, [ facet ]: [ ...values ], pg: 1 } );
	} );
	form?.addEventListener( 'input', ( event ) => {
		if ( event.target.name !== 'q' ) {
			return;
		}
		window.clearTimeout( searchTimer );
		searchTimer = window.setTimeout( () => {
			update(
				{ ...state, q: event.target.value.trim(), pg: 1 },
				{ push: false }
			);
		}, 400 );
	} );
	form?.addEventListener( 'submit', ( event ) => {
		event.preventDefault();
		window.clearTimeout( searchTimer );
		update( { ...state, q: form.elements.q.value.trim(), pg: 1 } );
	} );

	// Sort dropdown.
	document
		.getElementById( 'nsf-hub-sort' )
		?.addEventListener( 'change', ( event ) => {
			update( { ...state, sort: event.target.value, pg: 1 } );
		} );

	// Links inside the hub: chips, Clear all, table sorts, pagination.
	document.addEventListener( 'click', ( event ) => {
		const link = event.target.closest(
			'.nsf-hub-chip, [data-clear], [data-sort], [data-page]'
		);
		if (
			! link ||
			event.metaKey ||
			event.ctrlKey ||
			event.shiftKey ||
			event.button !== 0
		) {
			return;
		}
		event.preventDefault();
		if ( link.matches( '[data-clear]' ) ) {
			if ( form ) {
				form.elements.q.value = '';
			}
			const cleared = { ...state, q: '', pg: 1 };
			FACETS.forEach( ( facet ) => ( cleared[ facet ] = [] ) );
			update( cleared );
		} else if ( link.matches( '.nsf-hub-chip' ) ) {
			const { facet, value } = link.dataset;
			if ( facet === 'q' ) {
				if ( form ) {
					form.elements.q.value = '';
				}
				update( { ...state, q: '', pg: 1 } );
			} else {
				update( {
					...state,
					[ facet ]: state[ facet ].filter( ( v ) => v !== value ),
					pg: 1,
				} );
			}
		} else if ( link.dataset.sort ) {
			update( { ...state, sort: link.dataset.sort, pg: 1 } );
		} else {
			update(
				{ ...state, pg: Number( link.dataset.page ) },
				{ scroll: true }
			);
		}
	} );

	// Show more / fewer facet options.
	filters?.addEventListener( 'click', ( event ) => {
		const more = event.target.closest( '.nsf-hub-facet__more' );
		if ( ! more ) {
			return;
		}
		const expanded = more.getAttribute( 'aria-expanded' ) !== 'true';
		more.setAttribute( 'aria-expanded', String( expanded ) );
		const facet = more.closest( '.nsf-hub-facet' ).dataset.facet;
		if ( expanded ) {
			expandedFacets.add( facet );
		} else {
			expandedFacets.delete( facet );
		}
		collapseFacets( filters );
	} );

	// Cards / Table toggle, kept for a year.
	results.addEventListener( 'click', ( event ) => {
		const button = event.target.closest( '[data-view]' );
		if ( ! button ) {
			return;
		}
		setView( results, button.dataset.view );
		document.cookie = `${ VIEW_COOKIE }=${
			button.dataset.view
		}; path=/; max-age=31536000; SameSite=Lax`;
	} );

	// Filters drawer on narrow screens.
	function setDrawer( open ) {
		if ( ! filters ) {
			return;
		}
		filters.classList.toggle( 'is-open', open );
		document.documentElement.classList.toggle(
			'nsf-hub-drawer-open',
			open
		);
		openButton?.setAttribute( 'aria-expanded', String( open ) );
		if ( open ) {
			filters.querySelector( 'input, button, summary' )?.focus();
		} else {
			openButton?.focus();
		}
	}
	openButton?.addEventListener( 'click', () => setDrawer( true ) );
	filters?.addEventListener( 'click', ( event ) => {
		if ( event.target.closest( '[data-hub-close]' ) ) {
			setDrawer( false );
		}
	} );
	document.addEventListener( 'keydown', ( event ) => {
		if (
			event.key === 'Escape' &&
			filters?.classList.contains( 'is-open' )
		) {
			setDrawer( false );
		}
	} );

	// Back and forward restore the filters.
	window.addEventListener( 'popstate', () => {
		const next = readState( window.location.search );
		if ( form ) {
			form.elements.q.value = next.q;
		}
		update( next, { push: false } );
	} );
}

document.querySelectorAll( '[data-nsf-hub-results]' ).forEach( init );
