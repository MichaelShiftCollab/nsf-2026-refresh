/**
 * Content Card: a linked card in three variations (Featured image, Navy fill,
 * Outline and icon). Rendered on the server so it works the same for a picked
 * post and inside a Query Loop post template.
 */
import { registerBlockType } from '@wordpress/blocks';

import metadata from './block.json';
import Edit from './edit';
import variations from './variations';
import './style.scss';
import './editor.scss';

registerBlockType( metadata.name, {
	edit: Edit,
	save: () => null,
	variations,
} );
