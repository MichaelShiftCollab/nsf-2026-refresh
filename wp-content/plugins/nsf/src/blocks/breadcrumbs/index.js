/**
 * Breadcrumbs: server-rendered trail to the current page.
 */
import { registerBlockType } from '@wordpress/blocks';
import { __ } from '@wordpress/i18n';
import { InspectorControls, useBlockProps } from '@wordpress/block-editor';
import { PanelBody, ToggleControl } from '@wordpress/components';

import metadata from './block.json';
import './style.scss';

function Edit( { attributes, setAttributes } ) {
	return (
		<>
			<InspectorControls>
				<PanelBody title={ __( 'Breadcrumbs', 'nsf' ) }>
					<ToggleControl
						__nextHasNoMarginBottom
						label={ __( 'Show the current page', 'nsf' ) }
						checked={ attributes.showCurrent }
						onChange={ ( value ) =>
							setAttributes( { showCurrent: value } )
						}
					/>
				</PanelBody>
			</InspectorControls>
			<nav { ...useBlockProps( { className: 'nsf-breadcrumbs' } ) }>
				<ol className="nsf-breadcrumbs__list">
					<li className="nsf-breadcrumbs__item">
						{ __( 'Parent page', 'nsf' ) }
					</li>
					{ attributes.showCurrent ? (
						<li className="nsf-breadcrumbs__item">
							{ __( 'Current page', 'nsf' ) }
						</li>
					) : null }
				</ol>
			</nav>
		</>
	);
}

registerBlockType( metadata.name, {
	edit: Edit,
	save: () => null,
} );
