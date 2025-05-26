<?php
/**
 * Icon Font Helper Functions
 *
 * @package JThem
 * @since 1.0.0
 */

if (!defined('ABSPATH')) exit;

/**
 * Get icon HTML
 *
 * @param string $icon Icon name (without prefix)
 * @param string $class Additional CSS classes
 * @param array $attrs Additional HTML attributes
 * @param string $style Icon style ('outline' or 'solid')
 * @return string Icon HTML
 */
function get_icon($icon, $class = '', $attrs = [], $style = 'outline') {
    if (empty($icon)) {
        return '';
    }

    // Define class names - base class
    $class_names = 'j-icon';
    
    // Add style class (outline is default)
    if ($style === 'solid') {
        $class_names .= ' j-icon-solid';
    } else {
        $class_names .= ' j-icon-outline';
    }
    
    // Add icon specific class
    $class_names .= ' j-icon-' . $icon;
    
    // Add additional classes
    if (!empty($class)) {
        $class_names .= ' ' . $class;
    }

    // Build attributes string
    $attr_string = '';
    foreach ($attrs as $attr => $value) {
        $attr_string .= ' ' . $attr . '="' . esc_attr($value) . '"';
    }

    // Return icon HTML
    return sprintf('<i class="%s"%s aria-hidden="true"></i>', esc_attr($class_names), $attr_string);
}

/**
 * Echo icon HTML - outline style (default)
 *
 * @param string $icon Icon name (without prefix)
 * @param string $class Additional CSS classes
 * @param array $attrs Additional HTML attributes
 */
function icon($icon, $class = '', $attrs = []) {
    echo get_icon($icon, $class, $attrs, 'outline');
}

/**
 * Echo solid icon HTML
 *
 * @param string $icon Icon name (without prefix)
 * @param string $class Additional CSS classes
 * @param array $attrs Additional HTML attributes
 */
function solid_icon($icon, $class = '', $attrs = []) {
    echo get_icon($icon, $class, $attrs, 'solid');
}

/**
 * List available icons
 *
 * @param string $style Icon style ('all', 'outline', or 'solid')
 * @return array List of available icon names
 */
function get_available_icons($style = 'all') {
    // Path to the icon font SCSS file
    $scss_file = get_template_directory() . '/src/scss/core/iconFont/_iconFont.scss';
    
    // Check if file exists
    if (!file_exists($scss_file)) {
        return [];
    }
    
    // Read file contents
    $content = file_get_contents($scss_file);
    
    // Extract icon names based on style
    $icons = [];
    
    if ($style === 'outline' || $style === 'all') {
        // Get outline icons
        if (preg_match_all('/\.j-icon-([a-z0-9-_]+):before/', $content, $matches)) {
            $icons = array_merge($icons, $matches[1]);
        }
    }
    
    if ($style === 'solid' || $style === 'all') {
        // Get solid icons
        if (preg_match_all('/\.j-icon-solid\.j-icon-([a-z0-9-_]+):before/', $content, $matches)) {
            $icons = array_merge($icons, $matches[1]);
        }
    }
    
    // Remove duplicates
    $icons = array_unique($icons);
    
    // Sort alphabetically
    sort($icons);
    
    return $icons;
}

/**
 * Get icon picker HTML for admin 
 *
 * @param string $selected_icon Currently selected icon
 * @param string $selected_style Currently selected style ('outline' or 'solid')
 * @param string $icon_name Name of the icon input field
 * @param string $style_name Name of the style input field
 * @return string Icon picker HTML
 */
function get_icon_picker($selected_icon = '', $selected_style = 'outline', $icon_name = 'icon', $style_name = 'icon_style') {
    // Get available icons
    $outline_icons = get_available_icons('outline');
    $solid_icons = get_available_icons('solid');
    
    // Start output buffer
    ob_start();
    ?>
    <div class="j-icon-picker">
        <div class="j-icon-preview">
            <?php if (!empty($selected_icon)) : ?>
                <i class="j-icon j-icon-<?php echo esc_attr($selected_style); ?> j-icon-<?php echo esc_attr($selected_icon); ?>"></i>
            <?php else : ?>
                <span>Select an icon</span>
            <?php endif; ?>
        </div>
        
        <input type="hidden" name="<?php echo esc_attr($icon_name); ?>" value="<?php echo esc_attr($selected_icon); ?>">
        <input type="hidden" name="<?php echo esc_attr($style_name); ?>" value="<?php echo esc_attr($selected_style); ?>">
        
        <button type="button" class="button j-icon-picker-button">Choose Icon</button>
        
        <div class="j-icon-picker-dropdown">
            <div class="j-icon-picker-search">
                <input type="text" placeholder="Search icons...">
            </div>
            
            <div class="j-icon-picker-tabs">
                <div class="j-icon-picker-tab <?php echo ($selected_style === 'outline' || empty($selected_style)) ? 'active' : ''; ?>" data-tab="outline">Outline</div>
                <div class="j-icon-picker-tab <?php echo ($selected_style === 'solid') ? 'active' : ''; ?>" data-tab="solid">Solid</div>
            </div>
            
            <div class="j-icon-picker-content" id="j-icon-picker-outline" style="<?php echo ($selected_style === 'solid') ? 'display: none;' : ''; ?>">
                <div class="j-icon-picker-icons">
                    <?php foreach ($outline_icons as $icon) : ?>
                        <div class="j-icon-picker-item<?php echo ($selected_icon === $icon && $selected_style === 'outline') ? ' selected' : ''; ?>" data-icon="<?php echo esc_attr($icon); ?>" data-style="outline">
                            <i class="j-icon j-icon-outline j-icon-<?php echo esc_attr($icon); ?>"></i>
                            <span><?php echo esc_html($icon); ?></span>
                        </div>
                    <?php endforeach; ?>
                    <?php if (empty($outline_icons)) : ?>
                        <p>No outline icons available</p>
                    <?php endif; ?>
                </div>
            </div>
            
            <div class="j-icon-picker-content" id="j-icon-picker-solid" style="<?php echo ($selected_style !== 'solid') ? 'display: none;' : ''; ?>">
                <div class="j-icon-picker-icons">
                    <?php foreach ($solid_icons as $icon) : ?>
                        <div class="j-icon-picker-item<?php echo ($selected_icon === $icon && $selected_style === 'solid') ? ' selected' : ''; ?>" data-icon="<?php echo esc_attr($icon); ?>" data-style="solid">
                            <i class="j-icon j-icon-solid j-icon-<?php echo esc_attr($icon); ?>"></i>
                            <span><?php echo esc_html($icon); ?></span>
                        </div>
                    <?php endforeach; ?>
                    <?php if (empty($solid_icons)) : ?>
                        <p>No solid icons available</p>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
    
    <script>
    jQuery(document).ready(function($) {
        $('.j-icon-picker-button').on('click', function() {
            $(this).siblings('.j-icon-picker-dropdown').toggle();
        });
        
        $('.j-icon-picker-search input').on('input', function() {
            var search = $(this).val().toLowerCase();
            $('.j-icon-picker-item').each(function() {
                var icon = $(this).data('icon').toLowerCase();
                $(this).toggle(icon.indexOf(search) > -1);
            });
        });
        
        $('.j-icon-picker-tab').on('click', function() {
            var tab = $(this).data('tab');
            
            // Update tab UI
            $(this).siblings().removeClass('active');
            $(this).addClass('active');
            
            // Show corresponding content
            $(this).closest('.j-icon-picker-dropdown').find('.j-icon-picker-content').hide();
            $('#j-icon-picker-' + tab).show();
        });
        
        $('.j-icon-picker-item').on('click', function() {
            var icon = $(this).data('icon');
            var style = $(this).data('style');
            var picker = $(this).closest('.j-icon-picker');
            
            // Update hidden inputs
            picker.find('input[name="<?php echo esc_js($icon_name); ?>"]').val(icon);
            picker.find('input[name="<?php echo esc_js($style_name); ?>"]').val(style);
            
            // Update preview
            picker.find('.j-icon-preview').html('<i class="j-icon j-icon-' + style + ' j-icon-' + icon + '"></i>');
            
            // Update selection
            picker.find('.j-icon-picker-item').removeClass('selected');
            $(this).addClass('selected');
            
            // Hide dropdown
            picker.find('.j-icon-picker-dropdown').hide();
        });
        
        $(document).on('click', function(e) {
            if (!$(e.target).closest('.j-icon-picker').length) {
                $('.j-icon-picker-dropdown').hide();
            }
        });
    });
    </script>
    
    <style>
    .j-icon-picker {
        position: relative;
        display: inline-block;
    }
    
    .j-icon-preview {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 40px;
        height: 40px;
        background: #f5f5f5;
        border: 1px solid #ddd;
        border-radius: 4px;
        margin-right: 10px;
    }
    
    .j-icon-picker-dropdown {
        display: none;
        position: absolute;
        top: 100%;
        left: 0;
        width: 300px;
        max-height: 400px;
        background: #fff;
        border: 1px solid #ddd;
        border-radius: 4px;
        box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        z-index: 100;
        overflow: hidden;
    }
    
    .j-icon-picker-search {
        padding: 10px;
        border-bottom: 1px solid #eee;
    }
    
    .j-icon-picker-search input {
        width: 100%;
        padding: 6px;
    }
    
    .j-icon-picker-tabs {
        display: flex;
        border-bottom: 1px solid #eee;
    }
    
    .j-icon-picker-tab {
        flex: 1;
        padding: 8px;
        text-align: center;
        cursor: pointer;
        border-bottom: 2px solid transparent;
    }
    
    .j-icon-picker-tab.active {
        border-bottom-color: #2271b1;
        font-weight: bold;
    }
    
    .j-icon-picker-icons {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 5px;
        padding: 10px;
        max-height: 260px;
        overflow-y: auto;
    }
    
    .j-icon-picker-item {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        padding: 8px 4px;
        border-radius: 4px;
        cursor: pointer;
        text-align: center;
    }
    
    .j-icon-picker-item:hover {
        background: #f5f5f5;
    }
    
    .j-icon-picker-item.selected {
        background: #2271b1;
        color: #fff;
    }
    
    .j-icon-picker-item i {
        font-size: 18px;
        margin-bottom: 4px;
    }
    
    .j-icon-picker-item span {
        font-size: 10px;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
        max-width: 100%;
    }
    </style>
    <?php
    
    return ob_get_clean();
} 




