
<?php 

/**
 * Component: Why App
 * Description: Displays animated text for the Why App section with customizable content and color.
 *
 * @param array $args {
 *     @type array $why_app ACF field data for Why App section.
 * }
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

// Safely extract why_app data from $args, defaulting to an empty array
$why_app = $args['why_app'] ?? [];

// Check if required data is present and valid
if (empty($why_app) || !is_array($why_app)) {
    return; // Exit early if no data
}

$text = $why_app['text'] ?? '';
$text_color = $why_app['text_color'] ?? '#efefef';
$section_color = $why_app['section_color'] ?? '#e0e0e0';

// Exit early if no text
if (empty($text)) {
    return;
}

?>

<section class="colorful-text-section my-4" style="background-color: <?php echo esc_attr($section_color); ?>;">
    <div class="container">
        
        <h2 class="animated-text" data-text-color="<?php echo esc_attr($text_color); ?>"><?php echo $text ?></h2>
    </div>
</section>