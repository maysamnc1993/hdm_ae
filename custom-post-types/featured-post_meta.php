<?php



namespace JTheme\Modules;

use JTheme\Admin\Metabox;
use JTheme\CustomPostTypes\CPT_Creator;
use JTheme\CustomPostTypes\Taxonomy_Creator;

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}
// Instantiate the Metabox class for the 'is_featured' checkbox
$featured_metabox = new Metabox(
    'featured_post_metabox', // Unique ID for the metabox
    'Featured Post',         // Metabox title
    'post'                  // Post type (can be array for multiple post types)
);

// Add a checkbox field to mark the post as featured
$featured_metabox->add_checkbox(
    'is_featured', // Field ID
    'Mark as Featured', // Field label
    [
        'description' => 'Check this box to display this post as the featured post on the blog page.',
    ]
);

// Explicitly set the metabox to appear in the sidebar with high priority
$featured_metabox
    ->context('side')    // Place in the sidebar
    ->priority('high');  // Position near the top of the sidebar
