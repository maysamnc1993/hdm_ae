# JTheme Theme Translation

This directory contains the internationalization (i18n) files for the JTheme WordPress theme.

## File Structure

- `jthem.pot`: Translation template containing all translatable strings from the theme
- `fa_IR.po`: Persian translation source file
- `fa_IR.mo`: Compiled Persian translation file (binary)

## Working with Translations

### Adding New Strings to the Theme

When adding new text to the theme that should be translatable:

1. Use the appropriate WordPress i18n functions:
   - `esc_html__('Text', 'JTheme')` - For plain text that will be escaped
   - `esc_html_e('Text', 'JTheme')` - Same as above but echoes
   - `esc_attr__('Text', 'JTheme')` - For attributes
   - `esc_attr_e('Text', 'JTheme')` - Same as above but echoes
   - `_x('Text', 'context', 'JTheme')` - For text with context
   - `_n('Singular', 'Plural', $count, 'JTheme')` - For plurals

2. Update the POT file using Poedit or WP-CLI:
   ```
   wp i18n make-pot wp-content/themes/JTheme wp-content/themes/JTheme/languages/jthem.pot
   ```

### Adding New Translations

1. Open the POT file in Poedit
2. Create a new translation and set the language
3. Translate all strings
4. Save as `{locale}.po` (e.g., `es_ES.po` for Spanish)
5. Poedit will automatically generate the corresponding `.mo` file

### Updating Translations

1. Open the existing `.po` file in Poedit
2. Click on "Update from POT file" and select the updated POT file
3. Translate any new or updated strings
4. Save the file to regenerate the `.mo` file

## RTL Support

For right-to-left (RTL) languages like Persian, Arabic, or Hebrew:

1. The theme automatically loads RTL stylesheets when a RTL language is active
2. Use `is_rtl()` function in templates to conditionally apply RTL-specific styling
3. Example: `<div class="<?php echo is_rtl() ? 'rtl-class' : 'ltr-class'; ?>">...</div>`

## Language Switching

The theme includes a language switcher that allows users to change languages by adding a `?lang=` parameter to the URL.

To add the language switcher widget to your site:
1. Go to Appearance > Widgets
2. Add the "Language Switcher" widget to the "Language Switcher Area" sidebar 