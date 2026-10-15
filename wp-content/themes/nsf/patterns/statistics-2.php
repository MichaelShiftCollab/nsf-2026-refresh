<?php
/**
 * Title: Statistics row, 2 across
 * Slug: nsf/statistics-2
 * Categories: nsf-ctas
 * Keywords: statistics, numbers, key findings, key facts
 * Description: Heading and four big numbers, two across. Resource Key findings (wireframe 229:134).
 *
 * @package NSF
 */

$nsf_stats = array_fill( 0, 4, array( '00%', __( 'One or two lines on what this number measures. Replace with the finding and its source.', 'nsf' ) ) );
$nsf_heading = __( 'Key findings', 'nsf' );
$nsf_columns = 2;
require __DIR__ . '/../inc/statistics-row.php';
