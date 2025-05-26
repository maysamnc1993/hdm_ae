# FAQ Post Type Troubleshooting

If you're having trouble seeing the FAQ post type in your WordPress admin, follow these steps to fix the issue:

## Quick Fix

1. Go to your WordPress admin dashboard
2. Add `?debug_faq=1` to the URL (e.g., `https://your-site.com/wp-admin/index.php?debug_faq=1`)
3. You should see a debug message showing if the FAQ post type is registered
4. If it's not registered, continue with the steps below

## Manual Activation

1. Visit your site's WordPress admin
2. Go to Settings > Permalinks
3. Simply click "Save Changes" without making any changes
4. This will flush the rewrite rules and often fixes the issue with missing post types

## Check File Loading

Make sure all the necessary files are being loaded properly:

1. Verify that `components/faq/faq-loader.php` is being included in your theme's `functions.php`
2. If not, add the following code to your theme's `functions.php`:

```php
// Load FAQ Component
require_once get_template_directory() . '/components/faq/faq-loader.php';
```

## Force Post Type Registration

If the post type still doesn't appear, you can force registration by adding this code to your theme's `functions.php`:

```php
// Force register FAQ post type
function force_register_faq_post_type() {
    register_post_type('jthem_faq', [
        'labels' => [
            'name' => 'FAQ Items',
            'singular_name' => 'FAQ Item'
        ],
        'public' => true,
        'has_archive' => true,
        'menu_icon' => 'dashicons-format-chat',
        'supports' => ['title', 'editor'],
        'rewrite' => ['slug' => 'faqs']
    ]);
    
    register_taxonomy('jthem_faq_category', 'jthem_faq', [
        'labels' => [
            'name' => 'FAQ Categories',
            'singular_name' => 'FAQ Category'
        ],
        'hierarchical' => true,
        'show_admin_column' => true,
        'rewrite' => ['slug' => 'faq-categories']
    ]);
    
    // Flush rewrite rules
    flush_rewrite_rules();
}
add_action('init', 'force_register_faq_post_type');
```

## Namespace Issues

If you're seeing PHP errors related to namespaces:

1. Make sure the `JTheme\CustomPostTypes` namespace is properly defined in your theme
2. Check that the builder classes (`class-cpt-creator.php` and `class-tx-create.php`) exist and are being loaded
3. If there are namespace issues, the code will automatically fall back to direct registration

## After Fixing the Issue

Once the post type is visible:

1. Go to "FAQ Items" in your WordPress admin menu
2. You should see options to add new FAQ items and manage FAQ categories
3. Try adding a new FAQ item to confirm everything is working
4. Use the shortcode `[jthem_faq]` on a page to display your FAQs

## Still Having Issues?

If you're still having trouble, try manually activating the post type:

1. Go to the WordPress admin
2. Add `?force_faq_activation=1` to the URL (e.g., `https://your-site.com/wp-admin/index.php?force_faq_activation=1`)
3. This will force the FAQ post type to be registered and flush the rewrite rules 