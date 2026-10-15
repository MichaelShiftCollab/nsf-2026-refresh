<?php
/**
 * Title: Statistics row, 4 across
 * Slug: nsf/statistics-4
 * Categories: nsf-ctas
 * Keywords: statistics, numbers, key findings, key facts
 * Description: Heading and four big numbers in one row. Media Center Key facts.
 *
 * @package NSF
 */

$nsf_stats = array_fill( 0, 4, array( '00%', __( 'One or two lines on what this number measures. Replace with the finding and its source.', 'nsf' ) ) );
$nsf_heading = __( 'Key facts', 'nsf' );
$nsf_columns = 4;
require __DIR__ . '/../inc/statistics-row.php';
