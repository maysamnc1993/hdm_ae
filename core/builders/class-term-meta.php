<?php

namespace JTheme\Builders;

use JTheme\Core\WP_Functions;

/**
 * Term Meta Creator
 *
 * A class to add meta fields (including icons) to taxonomy terms
 */
class Term_Meta
{
    use WP_Functions;  // Make sure this trait is properly included

    private $taxonomy;
    private $fields = [];

    /**
     * Constructor
     *
     * @param string|array $taxonomy The taxonomy or taxonomies to add fields to
     */
    public function __construct($taxonomy)
    {
        $this->check_wp_functions();  // Make sure we call this method from the trait
        $this->taxonomy = is_array($taxonomy) ? $taxonomy : [$taxonomy];

        // Add form fields to category edit page
        add_action("{$this->taxonomy[0]}_add_form_fields", [$this, 'render_add_form_fields']);
        add_action("{$this->taxonomy[0]}_edit_form_fields", [$this, 'render_edit_form_fields'], 10, 2);

        // Save the form fields
        add_action("created_{$this->taxonomy[0]}", [$this, 'save_fields']);
        add_action("edited_{$this->taxonomy[0]}", [$this, 'save_fields']);

        // Add admin scripts for media uploader
        add_action('admin_enqueue_scripts', [$this, 'enqueue_scripts']);

        // Add column to taxonomy admin
        add_filter("manage_edit-{$this->taxonomy[0]}_columns", [$this, 'add_columns']);
        add_filter("manage_{$this->taxonomy[0]}_custom_column", [$this, 'add_column_content'], 10, 3);
    }

    /**
     * Add an image field
     *
     * @param string $id Field ID
     * @param string $label Field label
     * @param array $args Optional arguments
     * @return $this
     */
    public function add_image($id, $label, $args = [])
    {
        $this->fields[$id] = array_merge([
            'type' => 'image',
            'label' => $label,
            'default' => '',
            'description' => '',
            'button_text' => 'Choose Image',
            'placeholder' => 'No image selected',
        ], $args);

        return $this;
    }

    /**
     * Enqueue necessary scripts
     */
    public function enqueue_scripts($hook)
    {
        if ('edit-tags.php' == $hook || 'term.php' == $hook) {
            wp_enqueue_media();
            wp_enqueue_script('jquery');

            // Add inline JS for handling the media uploader
            wp_add_inline_script('jquery', $this->get_media_script());

            // Add inline CSS
            wp_add_inline_style('wp-admin', $this->get_admin_css());
        }
    }

    /**
     * Get media uploader scripts
     */
    private function get_media_script()
    {
        return "
            jQuery(document).ready(function($) {
                // Handle image upload button click
                $(document).on('click', '.term-image-upload-button', function(e) {
                    e.preventDefault();
                    
                    var button = $(this);
                    var fieldId = button.data('field');
                    var fieldContainer = button.closest('.term-image-field-container');
                    var imagePreview = fieldContainer.find('.term-image-preview');
                    var imageIdInput = fieldContainer.find('.term-image-id');
                    var removeButton = fieldContainer.find('.term-image-remove-button');
                    
                    var frame = wp.media({
                        title: 'Select or Upload Image',
                        button: { text: 'Use this image' },
                        multiple: false
                    });
                    
                    frame.on('select', function() {
                        var attachment = frame.state().get('selection').first().toJSON();
                        imageIdInput.val(attachment.id);
                        imagePreview.html('<img src=\"' + attachment.url + '\" style=\"max-width: 100%; height: auto;\">');
                        removeButton.show();
                    });
                    
                    frame.open();
                });
                
                // Handle image remove button click
                $(document).on('click', '.term-image-remove-button', function(e) {
                    e.preventDefault();
                    
                    var button = $(this);
                    var fieldContainer = button.closest('.term-image-field-container');
                    var imagePreview = fieldContainer.find('.term-image-preview');
                    var imageIdInput = fieldContainer.find('.term-image-id');
                    
                    imageIdInput.val('');
                    imagePreview.html('');
                    button.hide();
                });
            });
        ";
    }

    /**
     * Get admin CSS
     */
    private function get_admin_css()
    {
        return "
            .term-meta-field { margin: 15px 0; }
            .term-meta-field label { display: block; font-weight: bold; margin-bottom: 5px; }
            .term-meta-field .description { font-style: italic; color: #777; }
            .term-image-field-container { margin-top: 5px; }
            .term-image-preview { margin: 10px 0; min-height: 30px; }
            .term-image-preview img { max-width: 100px; height: auto; border: 1px solid #ddd; border-radius: 4px; padding: 3px; }
            .term-image-remove-button { margin-left: 5px; }
            .column-icon img { max-width: 40px; height: auto; }
        ";
    }

    /**
     * Render fields on add form
     */
    public function render_add_form_fields()
    {
        foreach ($this->fields as $field_id => $field) {
            ?>
            <div class="form-field term-meta-field">
                <label for="<?php echo esc_attr($field_id); ?>"><?php echo esc_html($field['label']); ?></label>
                <?php $this->render_field($field_id, $field); ?>
                <?php if (!empty($field['description'])): ?>
                    <p class="description"><?php echo esc_html($field['description']); ?></p>
                <?php endif; ?>
            </div>
            <?php
        }
    }

    /**
     * Render fields on edit form
     */
    public function render_edit_form_fields($term, $taxonomy)
    {
        foreach ($this->fields as $field_id => $field) {
            $meta_value = get_term_meta($term->term_id, $field_id, true);
            if ($meta_value === '' && isset($field['default'])) {
                $meta_value = $field['default'];
            }
            ?>
            <tr class="form-field term-meta-field">
                <th scope="row">
                    <label for="<?php echo esc_attr($field_id); ?>"><?php echo esc_html($field['label']); ?></label>
                </th>
                <td>
                    <?php $this->render_field($field_id, $field, $meta_value); ?>
                    <?php if (!empty($field['description'])): ?>
                        <p class="description"><?php echo esc_html($field['description']); ?></p>
                    <?php endif; ?>
                </td>
            </tr>
            <?php
        }
    }

    /**
     * Render a field
     */
    private function render_field($field_id, $field, $value = '')
    {
        switch ($field['type']) {
            case 'image':
                ?>
                <div class="term-image-field-container">
                    <input type="hidden" id="<?php echo esc_attr($field_id); ?>" name="<?php echo esc_attr($field_id); ?>" value="<?php echo esc_attr($value); ?>" class="term-image-id">
                    <div class="term-image-preview">
                        <?php if (!empty($value)): ?>
                            <img src="<?php echo esc_url(wp_get_attachment_url($value)); ?>" style="max-width: 100%; height: auto;">
                        <?php endif; ?>
                    </div>
                    <button type="button" class="button term-image-upload-button" data-field="<?php echo esc_attr($field_id); ?>"><?php echo esc_html($field['button_text']); ?></button>
                    <button type="button" class="button term-image-remove-button" data-field="<?php echo esc_attr($field_id); ?>"<?php echo empty($value) ? ' style="display:none;"' : ''; ?>><?php _e('Remove Image'); ?></button>
                </div>
                <?php
                break;
        }
    }

    /**
     * Save fields
     */
    public function save_fields($term_id)
    {
        foreach ($this->fields as $field_id => $field) {
            if (isset($_POST[$field_id])) {
                $value = $this->sanitize_field($field['type'], $_POST[$field_id]);
                update_term_meta($term_id, $field_id, $value);
            }
        }
    }

    /**
     * Sanitize field value
     */
    private function sanitize_field($type, $value)
    {
        switch ($type) {
            case 'image':
                return absint($value);
            default:
                return sanitize_text_field($value);
        }
    }

    /**
     * Add columns to the taxonomy admin table
     */
    public function add_columns($columns)
    {
        $new_columns = [];

        foreach ($columns as $key => $value) {
            if ($key == 'name') {
                $new_columns[$key] = $value;
                foreach ($this->fields as $field_id => $field) {
                    if ($field['type'] == 'image') {
                        $new_columns['icon'] = __('Icon');
                    }
                }
            } else {
                $new_columns[$key] = $value;
            }
        }

        return $new_columns;
    }

    /**
     * Add content to custom columns
     */
    public function add_column_content($content, $column_name, $term_id)
    {
        if ($column_name == 'icon') {
            foreach ($this->fields as $field_id => $field) {
                if ($field['type'] == 'image') {
                    $image_id = get_term_meta($term_id, $field_id, true);
                    if ($image_id) {
                        $image_url = wp_get_attachment_thumb_url($image_id);
                        $term = get_term($term_id);
                        $content = '<img src="' . esc_url($image_url) . '" alt="' . esc_attr($term->name) . ' icon" class="term-icon-thumbnail">';
                    }
                }
            }
        }

        return $content;
    }
}

/**
 * Helper function to get a category icon URL
 *
 * @param int $term_id Category/term ID (optional, uses current term if not provided)
 * @param string $size Image size (default: thumbnail)
 * @param string $field_id The meta field ID (default: category_icon)
 * @return string Icon URL or empty string if no icon
 */
function get_category_icon($term_id = 0, $size = 'thumbnail', $field_id = 'category_icon')
{
    if (!$term_id) {
        if (is_category() || is_tax()) {
            $term_id = get_queried_object_id();
        }
    }

    if (!$term_id) {
        return '';
    }

    $icon_id = get_term_meta($term_id, $field_id, true);
    if (!$icon_id) {
        return '';
    }

    return wp_get_attachment_image_url($icon_id, $size);
}

/**
 * Helper function to display a category icon
 *
 * @param int $term_id Category/term ID (optional, uses current term if not provided)
 * @param string $size Image size (default: thumbnail)
 * @param string $field_id The meta field ID (default: category_icon)
 * @param array $attr Image attributes
 * @return string HTML img tag or empty string
 */
function display_category_icon($term_id = 0, $size = 'thumbnail', $field_id = 'category_icon', $attr = [])
{
    if (!$term_id) {
        if (is_category() || is_tax()) {
            $term_id = get_queried_object_id();
        }
    }

    if (!$term_id) {
        return '';
    }

    $icon_id = get_term_meta($term_id, $field_id, true);
    if (!$icon_id) {
        return '';
    }

    $attr = array_merge([
        'class' => 'category-icon',
        'alt' => get_term($term_id)->name . ' icon'
    ], $attr);

    return wp_get_attachment_image($icon_id, $size, false, $attr);
}