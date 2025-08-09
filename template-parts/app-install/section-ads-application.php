<?php
/**
 * Ads Applications Section Template
 * Displays the ads applications section with background image, text, and cards.
 *
 * @param array $args {
 *     @type array $ads_applications ACF field data for the ads applications section.
 * }
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

// Initialize data, preferring $args if provided, otherwise fall back to get_field
$ads_applications = $args['ads_applications'] ?? [
    'background_image' => get_field('ads_background_image', get_the_ID()) ?: get_template_directory_uri() . '/svg/bg-app-ads.svg',
    'about_me' => get_field('ads_about_me', get_the_ID()) ?: 'Our App Install Ads Services',
    'main_title' => get_field('ads_main_title', get_the_ID()) ?: 'An Imaginative Brain Behind the Displays',
    'main_description' => get_field('ads_main_description', get_the_ID()) ?: 'Designing websites that feel as good as they look.',
    'cards' => get_field('ads_cards', get_the_ID()) ?: [],
];

// Check if the section should be displayed (require main_title and at least one card)
if (empty($ads_applications['main_title']) || empty($ads_applications['cards'])) {
    return; // Exit early if critical fields are empty
}
?>

<section class="ads-applications relative">
    <div class="bg-dots" style="background-image: url(<?php 
        echo esc_url($ads_applications['background_image']);
    ?>)"></div>
    <div class="container flex flex-col gap-7 md:gap-12 content-container">
        <div class="content flex flex-col text-white gap-6 w-full">
            <span class="gray-color">
                <?php echo esc_html($ads_applications['about_me']); ?>
            </span>
            <div class="flex justify-between items-end flex-col md:flex-row gap-4 md:gap-0">
                <h2 class="text-8 md:text-12 leading-10 md:leading-14 text-white max-w-xl"><?php echo wp_kses_post($ads_applications['main_title']); ?></h2>
            </div>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-5">
            <?php
            if (!empty($ads_applications['cards'])) {
                $index = 1;
                foreach ($ads_applications['cards'] as $card) {
                    $title = $card['card_title'] ?? '';
                    $subtitle = $card['card_subtitle'] ?? '';
                    $description = $card['card_description'] ?? '';
                    // Skip if card title is empty (optional robustness)
                    if (empty($title)) {
                        continue;
                    }
            ?>
                    <div class="cart flex flex-col gap-3">
                        <p class="gray-color badge"><?php echo esc_html($subtitle); ?></p>
                        <h3 class="text-white text-2xl"><?php echo esc_html( $title); ?></h3>
                        <p class="gray-color"><?php echo esc_html($description); ?></p>
                    </div>
            <?php
                    $index++;
                }
            } else {
                echo '<p class="gray-color">No ad services available.</p>';
            }
            ?>
        </div>
    </div>
</section>