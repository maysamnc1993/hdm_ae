<?php
/**
 * Metabox Creator
 *
 * A simple class to easily create custom meta boxes for WordPress post types
 */

namespace JTheme\Admin;

use JTheme\Core\WP_Functions;

class Metabox
{
    use WP_Functions;

    private $id;
    private $title;
    private $callback;
    private $screen = [];
    private $context = 'advanced';
    private $priority = 'default';
    private $callback_args = [];
    private $fields = [];

    public function __construct($id, $title, $screen = [])
    {
        $this->check_wp_functions();
        $this->id = $id;
        $this->title = $title;
        $this->screen = is_array($screen) ? $screen : [$screen];
        $this->callback = [$this, 'render'];
        $this->add_action('add_meta_boxes', [$this, 'register']);
        $this->add_action('save_post', [$this, 'save'], 10, 1);
    }

    public function context($context)
    {
        $this->context = $context;
        return $this;
    }

    public function priority($priority)
    {
        $this->priority = $priority;
        return $this;
    }

    public function callback($callback)
    {
        $this->callback = $callback;
        return $this;
    }

    public function add_text($id, $label, $args = [])
    {
        $this->fields[$id] = array_merge([
            'type' => 'text',
            'label' => $label,
            'default' => '',
            'placeholder' => '',
            'description' => '',
            'class' => 'widefat',
        ], $args);
        return $this;
    }

    public function add_textarea($id, $label, $args = [])
    {
        $this->fields[$id] = array_merge([
            'type' => 'textarea',
            'label' => $label,
            'default' => '',
            'placeholder' => '',
            'description' => '',
            'rows' => 5,
            'class' => 'widefat',
        ], $args);
        return $this;
    }

    public function add_select($id, $label, $options = [], $args = [])
    {
        $this->fields[$id] = array_merge([
            'type' => 'select',
            'label' => $label,
            'default' => '',
            'options' => $options,
            'description' => '',
            'class' => 'widefat',
        ], $args);
        return $this;
    }

    public function add_checkbox($id, $label, $args = [])
    {
        $this->fields[$id] = array_merge([
            'type' => 'checkbox',
            'label' => $label,
            'default' => '',
            'description' => '',
        ], $args);
        return $this;
    }

    public function add_radio($id, $label, $options = [], $args = [])
    {
        $this->fields[$id] = array_merge([
            'type' => 'radio',
            'label' => $label,
            'default' => '',
            'options' => $options,
            'description' => '',
        ], $args);
        return $this;
    }

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
        \add_action('admin_enqueue_scripts', function () {
            \wp_enqueue_media();
            \wp_enqueue_script('jquery');
        });
        return $this;
    }

    public function add_file($id, $label, $args = [])
    {
        $this->fields[$id] = array_merge([
            'type' => 'file',
            'label' => $label,
            'default' => '',
            'description' => '',
            'button_text' => 'Choose File',
            'placeholder' => 'No file selected',
        ], $args);
        \add_action('admin_enqueue_scripts', function () {
            \wp_enqueue_media();
            \wp_enqueue_script('jquery');
        });
        return $this;
    }

    public function add_date($id, $label, $args = [])
    {
        $this->fields[$id] = array_merge([
            'type' => 'date',
            'label' => $label,
            'default' => '',
            'placeholder' => '',
            'description' => '',
            'class' => 'widefat date-picker',
        ], $args);
        return $this;
    }

    public function register()
    {
        foreach ($this->screen as $screen) {
            \add_meta_box(
                $this->id,
                $this->title,
                $this->callback,
                $screen,
                $this->context,
                $this->priority,
                $this->callback_args
            );
        }
    }

    public function render($post, $args = [])
    {
        // Ensure nonce is included in the form
        $nonce_name = $this->id . '_nonce';
        echo '<input type="hidden" name="' . esc_attr($nonce_name) . '" value="' . wp_create_nonce($this->id . '_nonce_action') . '">';

        echo '<div class="jtheme-metabox">';
        foreach ($this->fields as $field_id => $field) {
            $meta_value = \get_post_meta($post->ID, '_' . $field_id, true);
            if ($meta_value === '' && isset($field['default'])) {
                $meta_value = $field['default'];
            }

            echo '<div class="jtheme-metabox-field">';
            echo '<label for="' . esc_attr($field_id) . '">' . esc_html($field['label']) . '</label>';

            switch ($field['type']) {
                case 'text':
                    echo '<input type="text" id="' . esc_attr($field_id) . '" name="' . esc_attr($field_id) . '" value="' . esc_attr($meta_value) . '" class="' . esc_attr($field['class']) . '" placeholder="' . esc_attr($field['placeholder']) . '">';
                    break;

                case 'textarea':
                    echo '<textarea id="' . esc_attr($field_id) . '" name="' . esc_attr($field_id) . '" class="' . esc_attr($field['class']) . '" rows="' . esc_attr($field['rows']) . '" placeholder="' . esc_attr($field['placeholder']) . '">' . esc_textarea($meta_value) . '</textarea>';
                    break;

                case 'select':
                    echo '<select id="' . esc_attr($field_id) . '" name="' . esc_attr($field_id) . '" class="' . esc_attr($field['class']) . '">';
                    foreach ($field['options'] as $value => $label) {
                        echo '<option value="' . esc_attr($value) . '" ' . selected($meta_value, $value, false) . '>' . esc_html($label) . '</option>';
                    }
                    echo '</select>';
                    break;

                case 'checkbox':
                    echo '<input type="checkbox" id="' . esc_attr($field_id) . '" name="' . esc_attr($field_id) . '" value="1" ' . checked($meta_value, '1', false) . '>';
                    break;

                case 'radio':
                    foreach ($field['options'] as $value => $label) {
                        echo '<label class="radio-label">';
                        echo '<input type="radio" name="' . esc_attr($field_id) . '" value="' . esc_attr($value) . '" ' . checked($meta_value, $value, false) . '>';
                        echo esc_html($label);
                        echo '</label>';
                    }
                    break;

                case 'image':
                    echo '<div class="image-field-container">';
                    echo '<input type="hidden" id="' . esc_attr($field_id) . '" name="' . esc_attr($field_id) . '" value="' . esc_attr($meta_value) . '">';
                    echo '<div class="image-preview">';
                    if (!empty($meta_value)) {
                        echo '<img src="' . esc_url(wp_get_attachment_url($meta_value)) . '" style="max-width: 100%; height: auto;">';
                    }
                    echo '</div>';
                    echo '<button type="button" class="button image-upload-button" data-field="' . esc_attr($field_id) . '">' . esc_html($field['button_text']) . '</button>';
                    echo '<button type="button" class="button image-remove-button" data-field="' . esc_attr($field_id) . '"' . (empty($meta_value) ? ' style="display:none;"' : '') . '>Remove Image</button>';
                    echo '</div>';

                    echo '<script>
                        jQuery(document).ready(function($) {
                            $(".image-upload-button[data-field=\'' . esc_attr($field_id) . '\']").click(function(e) {
                                e.preventDefault();
                                var button = $(this), field_id = button.data("field");
                                var frame = wp.media({
                                    title: "Select or Upload Image",
                                    button: { text: "Use this image" },
                                    multiple: false
                                });
                                frame.on("select", function() {
                                    var attachment = frame.state().get("selection").first().toJSON();
                                    $("#" + field_id).val(attachment.id);
                                    button.siblings(".image-preview").html("<img src=\'" + attachment.url + "\' style=\'max-width: 100%; height: auto;\'>");
                                    button.siblings(".image-remove-button").show();
                                });
                                frame.open();
                            });
                            $(".image-remove-button[data-field=\'' . esc_attr($field_id) . '\']").click(function(e) {
                                e.preventDefault();
                                var button = $(this), field_id = button.data("field");
                                $("#" + field_id).val("");
                                button.siblings(".image-preview").html("");
                                button.hide();
                            });
                        });
                    </script>';
                    break;

                case 'file':
                    echo '<div class="file-field-container">';
                    echo '<input type="hidden" id="' . esc_attr($field_id) . '" name="' . esc_attr($field_id) . '" value="' . esc_attr($meta_value) . '">';
                    echo '<div class="file-preview">';
                    if (!empty($meta_value)) {
                        $file_url = wp_get_attachment_url($meta_value);
                        $file_name = $file_url ? basename($file_url) : '';
                        echo '<span class="file-name">' . esc_html($file_name) . '</span>';
                    }
                    echo '</div>';
                    echo '<button type="button" class="button file-upload-button" data-field="' . esc_attr($field_id) . '">' . esc_html($field['button_text']) . '</button>';
                    echo '<button type="button" class="button file-remove-button" data-field="' . esc_attr($field_id) . '"' . (empty($meta_value) ? ' style="display:none;"' : '') . '>Remove File</button>';
                    echo '</div>';

                    echo '<script>
                        jQuery(document).ready(function($) {
                            $(".file-upload-button[data-field=\'' . esc_attr($field_id) . '\']").click(function(e) {
                                e.preventDefault();
                                var button = $(this), field_id = button.data("field");
                                var frame = wp.media({
                                    title: "Select or Upload File",
                                    button: { text: "Use this file" },
                                    multiple: false
                                });
                                frame.on("select", function() {
                                    var attachment = frame.state().get("selection").first().toJSON();
                                    $("#" + field_id).val(attachment.id);
                                    button.siblings(".file-preview").html("<span class=\'file-name\'>" + (attachment.filename || attachment.name) + "</span>");
                                    button.siblings(".file-remove-button").show();
                                });
                                frame.open();
                            });
                            $(".file-remove-button[data-field=\'' . esc_attr($field_id) . '\']").click(function(e) {
                                e.preventDefault();
                                var button = $(this), field_id = button.data("field");
                                $("#" + field_id).val("");
                                button.siblings(".file-preview").html("");
                                button.hide();
                            });
                        });
                    </script>';
                    break;

                case 'date':
                    echo '<input type="text" id="' . esc_attr($field_id) . '" name="' . esc_attr($field_id) . '" value="' . esc_attr($meta_value) . '" class="' . esc_attr($field['class']) . '" placeholder="' . esc_attr($field['placeholder']) . '" jdf />';
                    break;
            }

            if (!empty($field['description'])) {
                echo '<p class="description">' . esc_html($field['description']) . '</p>';
            }
            echo '</div>';
        }
        echo '</div>';

        echo '<style>
            .jtheme-metabox { padding: 10px; }
            .jtheme-metabox-field { margin-bottom: 15px; }
            .jtheme-metabox-field label { display: block; font-weight: bold; margin-bottom: 5px; }
            .jtheme-metabox-field .description { font-style: italic; color: #777; }
            .jtheme-metabox-field .radio-label { display: block; margin-bottom: 5px; }
            .image-field-container, .file-field-container { margin-top: 5px; }
            .image-preview, .file-preview { margin-bottom: 10px; }
            .image-remove-button, .file-remove-button { margin-left: 5px; }
            .file-name { display: inline-block; padding: 5px 10px; background: #f5f5f5; border-radius: 3px; }
        </style>';
    }

    public function save($post_id)
    {
        // Debug: Log save attempt
        error_log("Metabox save attempt for post_id: $post_id, metabox: {$this->id}");

        // Check autosave
        if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
            error_log("Autosave detected, skipping save for post_id: $post_id");
            return;
        }

        // Verify nonce
        $nonce_name = $this->id . '_nonce';
        if (!isset($_POST[$nonce_name])) {
            error_log("Nonce not set for metabox: {$this->id}, POST data: " . print_r($_POST, true));
            return;
        }

        if (!wp_verify_nonce($_POST[$nonce_name], $this->id . '_nonce_action')) {
            error_log("Nonce verification failed for metabox: {$this->id}, nonce: {$_POST[$nonce_name]}");
            return;
        }

        // Check permissions
        $post_type = get_post_type($post_id);
        if ('page' === $post_type) {
            if (!current_user_can('edit_page', $post_id)) {
                error_log("User lacks edit_page permission for post_id: $post_id");
                return;
            }
        } elseif (!current_user_can('edit_post', $post_id)) {
            error_log("User lacks edit_post permission for post_id: $post_id");
            return;
        }

        // Save fields
        foreach ($this->fields as $field_id => $field) {
            $meta_key = '_' . $field_id;
            $field_name = $field_id;

            if (in_array($field['type'], ['file', 'image'])) {
                $value = isset($_POST[$field_name]) ? absint($_POST[$field_name]) : '';
                error_log("Processing {$field['type']} field: $field_id, value: " . ($value ?: 'empty'));

                if ($value) {
                    $result = update_post_meta($post_id, $meta_key, $value);
                    error_log("Updated meta $meta_key for post_id $post_id, result: " . var_export($result, true));
                } else {
                    $result = delete_post_meta($post_id, $meta_key);
                    error_log("Deleted meta $meta_key for post_id $post_id, result: " . var_export($result, true));
                }
            } elseif ($field['type'] === 'checkbox') {
                $value = isset($_POST[$field_name]) ? '1' : '';
                $result = update_post_meta($post_id, $meta_key, $value);
                error_log("Updated checkbox $meta_key for post_id $post_id, value: $value, result: " . var_export($result, true));
            } elseif (isset($_POST[$field_name])) {
                $value = $this->sanitize_meta_field($field['type'], $_POST[$field_name]);
                $result = update_post_meta($post_id, $meta_key, $value);
                error_log("Updated field $meta_key for post_id $post_id, value: " . (is_scalar($value) ? $value : 'non-scalar') . ", result: " . var_export($result, true));
            }
        }
    }

    private function sanitize_meta_field($type, $value)
    {
        switch ($type) {
            case 'text':
                return sanitize_text_field($value);
            case 'textarea':
                return wp_kses_post($value);
            case 'select':
            case 'radio':
                return sanitize_text_field($value);
            case 'checkbox':
                return '1';
            case 'image':
            case 'file':
                return absint($value);
            default:
                return sanitize_text_field($value);
        }
    }
}
?>