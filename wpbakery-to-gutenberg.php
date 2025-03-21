<?php
/**
 * Plugin Name: WPBakery to Gutenberg Migration
 * Description: Automatically converts WPBakery shortcodes into Gutenberg blocks.
 * Version: 1.0
 * Author: Milla Wynn
 */

if (!defined('ABSPATH')) {
    exit; // Prevent direct access
}

// Add an admin menu item to run the migration
add_action('admin_menu', function () {
    add_submenu_page(
        'tools.php',
        'WPBakery to Gutenberg Migration',
        'WPBakery to Gutenberg',
        'manage_options',
        'wpbakery-to-gutenberg',
        'wpbakery_to_gutenberg_page'
    );
});

function wpbakery_to_gutenberg_page() {
    echo '<div class="wrap">';
    echo '<h2>WPBakery to Gutenberg Migration</h2>';
    if (isset($_POST['migrate_content'])) {
        wpbakery_to_gutenberg_convert();
    }
    echo '<form method="post">';
    echo '<input type="submit" name="migrate_content" value="Start Migration" class="button button-primary">';
    echo '</form>';
    echo '</div>';
}

// Function to convert WPBakery shortcodes to Gutenberg blocks
function wpbakery_to_gutenberg_convert() {
    global $wpdb;

    $posts = $wpdb->get_results("SELECT ID, post_content FROM {$wpdb->posts} WHERE post_type = 'page' OR post_type = 'post'", ARRAY_A);

    foreach ($posts as $post) {
        $content = $post['post_content'];

        // Convert WPBakery Shortcodes to Gutenberg Blocks
        $content = str_replace(['[vc_row]', '[/vc_row]', '[vc_column]', '[/vc_column]'], '', $content);
        
        // Convert Headings
        $content = preg_replace('/\[vc_column_text\](.*?)\[\/vc_column_text\]/s', '<!-- wp:paragraph -->\1<!-- /wp:paragraph -->', $content);

        // Convert Images
        $content = preg_replace('/\[vc_single_image image="(\d+)"[^\]]*\]/', '<!-- wp:image {"id":\1} --><img src="' . wp_get_attachment_url('\1') . '" /><!-- /wp:image -->', $content);

        // Convert Buttons
        $content = preg_replace('/\[vc_btn title="(.*?)" link="(.*?)"[^\]]*\]/', '<!-- wp:button --><a href="\2">\1</a><!-- /wp:button -->', $content);

        // Update the post content
        $wpdb->update(
            $wpdb->posts,
            ['post_content' => $content],
            ['ID' => $post['ID']],
            ['%s'],
            ['%d']
        );

        // Clear cache for updated pages
        clean_post_cache($post['ID']);
    }

    echo '<div class="updated"><p>Migration Completed. WPBakery shortcodes have been converted.</p></div>';
}
