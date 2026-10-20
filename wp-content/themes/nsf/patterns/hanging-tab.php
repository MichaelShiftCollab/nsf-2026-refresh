<?php
/**
 * Title: Hanging tab (Header Flag)
 * Slug: nsf/hanging-tab
 * Categories: nsf-sections
 * Keywords: header flag, hanging tab, tab, anchor, jump link
 * Description: Orange tab that hangs from the bottom of the site header at the right content edge, with a download icon and a label linking to a section on the page. Place it first on the page; change the label and the link (for example #forum) in the paragraph. Used on the Drowsy Driving Prevention Week® page.
 *
 * @package NSF
 */

?>
<!-- wp:group {"metadata":{"name":"Hanging tab"},"align":"full","className":"nsf-hanging-tab","layout":{"type":"constrained"}} -->
<div class="wp-block-group alignfull nsf-hanging-tab"><!-- wp:paragraph {"className":"nsf-hanging-tab__inner"} -->
<p class="nsf-hanging-tab__inner"><a class="nsf-hanging-tab__link" href="#forum"><?php esc_html_e( 'Drowsy Driving Forum', 'nsf' ); ?></a></p>
<!-- /wp:paragraph --></div>
<!-- /wp:group -->
