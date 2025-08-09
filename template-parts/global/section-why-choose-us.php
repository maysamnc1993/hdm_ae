
<?php
/**
 * Component: Why Choose Us
 * Description: Displays the values section with animated text and images.
 *
 * @param array $args {
 *     @type array  $why_choose_us {
 *         @type string $background_image URL of the background image.
 *         @type array  $values ACF field data for values.
 *     }
 * }
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

// Safely extract why_choose_us data from $args
$why_choose_us = $args['why_choose_us'] ?? [];
$background_image = $why_choose_us['background_image'] ?? '';
$values = $why_choose_us['values'] ?? [];

// Fallback image if none provided
if (empty($background_image)) {
    $background_image = wp_get_attachment_image_url(129, 'full') ?: ''; // Ensure fallback exists
}

// Exit early if no values or invalid data
if (empty($values) || !is_array($values)) {
    return;
}
?>

<section class="WhyChooseUS why-choose-us-component content-section" id="WhyChooseUS">
    <div class="WhyChooseUS-container">
        <div class="Mask">
            <div class="Text">
                <span style="background-image: url(<?php echo esc_url($background_image); ?>)">WHY CHOOSE US?</span>
            </div>
            <ul class="whyChooseUS-list whyChooseUS-steps">
                <?php
                $i = 0;
                foreach ($values as $item) {
                    $i++;
                    $image = $item['image'] ?? '';
                    $title = $item['title'] ?? '';
                    $description = $item['description'] ?? '';
                    // Skip if critical fields are empty
                    if (empty($title) || empty($description)) {
                        continue;
                    }
                ?>
                    <li id="item_<?php echo esc_attr($i); ?>_step" class="<?php echo $i === 1 ? 'active' : ''; ?>">
                        <div class="item_head">
                            <div class="icon_number">
                                <i><?php echo esc_html($i); ?></i>
                                <?php if (!empty($image)) : ?>
                                    <img src="<?php echo esc_url($image); ?>" alt="<?php echo esc_attr($title); ?>">
                                <?php endif; ?>
                            </div>
                            <div class="item_title">
                                <?php echo esc_html($title); ?>
                            </div>
                        </div>
                        <div class="item_body">
                            <p><?php echo wp_kses_post($description); ?></p>
                        </div>
                    </li>
                <?php } ?>
            </ul>
        </div>
    </div>
</section>