<?php
/**
 * @package real-woocommerce-author
 * @version 1.0.0
 */

/*
Plugin Name: Real WooCommerce Author
Plugin URI:
Description: Displays the author taxonomy into products
Author: RealCodeLab
Version: 1.0.0
Author URI: http://realcodelab.com/
*/

if (! defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

add_action('woocommerce_single_product_summary', 'show_product_author_after_title_on_single_product', 6);

/**
 * Show the taxonomy product_author after the title of single products.
 */
function show_product_author_after_title_on_single_product()
{
    global $product;

    $product_id = $product->get_id();

    // Get the terms
    $product_authors = wp_get_post_terms($product_id, 'product_author');

    if (! empty($product_authors)) {
        $output = array();

        // Add a link to each term
        foreach ($product_authors as $term) {
            $link = get_term_link($term, 'product_author');

            $output[] = sprintf('<a href="%s" rel="author">%s</a>', $link, $term->name);
        }

        $output = implode(', ', $output);

        // Echo the list of term links (authors)
        echo '<div class="product-author">por ' . $output . '</div>';
    }
}
