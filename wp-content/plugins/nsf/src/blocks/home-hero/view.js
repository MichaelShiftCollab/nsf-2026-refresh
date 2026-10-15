/**
 * Home Hero: fades to the next image every few seconds. No indicators, and
 * no rotation when the visitor prefers reduced motion or the tab is hidden.
 */

const reducedMotion = window.matchMedia( '(prefers-reduced-motion: reduce)' );

function init( slides ) {
	const images = [ ...slides.querySelectorAll( '.nsf-hero__image' ) ];
	if ( images.length < 2 ) {
		return;
	}
	const delay = ( Number( slides.dataset.interval ) || 6 ) * 1000;
	let index = 0;
	let timer;

	const show = ( next ) => {
		images[ index ].classList.remove( 'is-active' );
		index = next % images.length;
		const image = images[ index ];
		// Lazy images load before they fade in.
		image.loading = 'eager';
		image.classList.add( 'is-active' );
	};

	const stop = () => {
		window.clearInterval( timer );
		timer = undefined;
	};

	const start = () => {
		stop();
		if ( reducedMotion.matches || document.hidden ) {
			return;
		}
		// Fetch the next image early so the first fade is not blank.
		images[ ( index + 1 ) % images.length ].loading = 'eager';
		timer = window.setInterval( () => show( index + 1 ), delay );
	};

	reducedMotion.addEventListener( 'change', () => {
		if ( reducedMotion.matches ) {
			stop();
			show( 0 );
		} else {
			start();
		}
	} );
	document.addEventListener( 'visibilitychange', start );
	start();
}

document.querySelectorAll( '[data-nsf-hero]' ).forEach( init );
