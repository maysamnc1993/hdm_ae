# FAQ Component

A professional, flexible FAQ (Frequently Asked Questions) component for WordPress sites, implemented as a custom post type with shortcode support.

## Features

- Custom post type for easy management of FAQ items
- Custom taxonomy for categorizing FAQ items
- Responsive accordion-style display
- Shortcode support for embedding in posts/pages
- Legacy support for existing FAQ items
- Migration tool for converting old FAQ data to custom post type
- Customizable appearance and behavior
- Support for different icon types (plus/minus, chevron)
- FAQ categories integrated with WordPress menus

## Usage

### Adding FAQ Items

1. Navigate to "FAQ Items" in your WordPress admin menu
2. Click "Add New" to create a new FAQ item
3. Enter the question in the title field
4. Enter the answer in the content editor
5. Set the FAQ Category (optional)
6. Configure display settings in the "FAQ Settings" meta box
7. Publish the FAQ item

### Managing FAQ Categories

1. Navigate to "FAQ Items > Categories" in your WordPress admin menu
2. Create, edit, or delete FAQ categories
3. Each FAQ item can be assigned to one or more categories
4. Default categories are automatically created for General, Products, Shipping, Returns, and Accounts

### Adding FAQ Categories to Menus

1. Navigate to "Appearance > Menus" in your WordPress admin menu
2. Look for the "FAQ Categories" box in the left sidebar
3. Check the categories you want to add to your menu
4. Click "Add to Menu"
5. Arrange the menu items as desired
6. Save the menu

### Displaying FAQs

Use the shortcode `[jthem_faq]` to display FAQs on your site.

**Basic usage:**
```
[jthem_faq]
```
This will display all FAQ items.

**Display specific categories:**
```
[jthem_faq category="general,support"]
```

**Display specific FAQ items by ID:**
```
[jthem_faq ids="123,456,789"]
```

**Customize appearance:**
```
[jthem_faq title="Common Questions" subtitle="Find answers to frequently asked questions" accordion_type="multiple"]
```

**Display all FAQs grouped by category:**
```
[jthem_faq show_category_title="true"]
```

**Display specific categories and exclude others:**
```
[jthem_faq category="general,products" exclude_category="returns,shipping"]
```

## Shortcode Parameters

| Parameter       | Description                                    | Default            |
|-----------------|------------------------------------------------|--------------------|
| `category`      | Comma-separated list of category slugs        | Empty (all)        |
| `exclude_category` | Comma-separated list of category slugs to exclude | Empty (none) |
| `ids`           | Comma-separated list of FAQ item IDs          | Empty (all)        |
| `limit`         | Number of FAQs to display                     | -1 (all)           |
| `orderby`       | Sort by field (date, title, menu_order)       | "date"             |
| `order`         | Sort order (ASC or DESC)                      | "DESC"             |
| `title`         | Title for the FAQ section                      | "سوالات متداول"    |
| `subtitle`      | Subtitle for the FAQ section                   | Empty              |
| `accordion_type`| Whether multiple items can be open (single/multiple) | "single"     |
| `icon_open`     | Icon type for closed state (plus, chevron-down) | "plus"          |
| `icon_close`    | Icon type for open state (minus, chevron-up)   | "minus"          |
| `show_category_title` | Display FAQs grouped by category with headings | false        |

## Migrating from Old Format

If you have existing FAQ items saved in the old format (using WordPress options), you can migrate them to the new custom post type format:

1. Navigate to "FAQ Items > Settings" in your WordPress admin menu
2. If you have FAQ items in the old format, you'll see a migration tool
3. Click "Migrate FAQ Items" to convert your old items to the new format

## Theme Integration

The FAQ component is designed to integrate with any WordPress theme. The default styling uses minimal classes that work well with most themes.

## Developer Information

### Structure

- Custom Post Type: `jthem_faq`
- Custom Taxonomy: `jthem_faq_category`
- Meta Fields:
  - `_jthem_faq_is_open`: Whether the FAQ is open by default
  - `_jthem_faq_icon_type`: Icon type for the FAQ item (plus, chevron)

### Default Categories

The following default categories are created automatically:
- General
- Products
- Shipping & Delivery
- Returns & Refunds
- Account & Orders

### Filters

The component provides several filters for customization:

- `jthem_faq_post_type_args`: Modify the custom post type arguments
- `jthem_faq_taxonomy_args`: Modify the taxonomy arguments
- `jthem_faq_shortcode_atts`: Modify shortcode attributes
- `jthem_faq_item_data`: Modify FAQ item data before display

### CSS Classes

The FAQ component uses the following CSS classes:

- `.faq-container`: Main container
- `.faq-header`: Header section with title and subtitle
- `.faq-items`: Container for FAQ items
- `.faq-item`: Individual FAQ item
- `.faq-question`: FAQ question button
- `.faq-answer`: FAQ answer container
- `.faq-icon`: Container for the toggle icon

## Requirements

- WordPress 5.0 or higher
- PHP 7.0 or higher

## License

This component is part of the JTheme theme and is licensed under the same terms as the theme. 