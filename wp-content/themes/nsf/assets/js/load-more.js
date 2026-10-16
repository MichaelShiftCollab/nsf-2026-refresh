/**
 * Load more for Query Loops with the nsf-load-more class: the next-page link
 * fetches that page and appends its items in place. Without JavaScript the
 * link is ordinary pagination.
 */
document.addEventListener( 'click', async ( event ) => {
	const link = event.target.closest(
		'.nsf-load-more .wp-block-query-pagination-next'
	);
	if ( ! link ) {
		return;
	}
	event.preventDefault();
	const query = link.closest( '.nsf-load-more' );
	const list = query.querySelector( '.wp-block-post-template' );
	link.setAttribute( 'aria-busy', 'true' );
	try {
		const response = await fetch( link.href );
		const doc = new window.DOMParser().parseFromString(
			await response.text(),
			'text/html'
		);
		const next = doc.querySelector(
			'.nsf-load-more .wp-block-query-pagination-next'
		);
		const items = doc.querySelectorAll(
			'.nsf-load-more .wp-block-post-template > li'
		);
		const first = items[ 0 ] && document.importNode( items[ 0 ], true );
		items.forEach( ( item, i ) =>
			list.append( i ? document.importNode( item, true ) : first )
		);
		// Move focus to the first new item's link so keyboard users continue there.
		first?.querySelector( 'a' )?.focus();
		if ( next ) {
			link.href = next.href;
			link.removeAttribute( 'aria-busy' );
		} else {
			link.closest( '.wp-block-query-pagination' ).remove();
		}
	} catch {
		window.location.href = link.href;
	}
} );
