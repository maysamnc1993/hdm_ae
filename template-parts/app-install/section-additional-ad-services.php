<?php

/**
 * Component: Additional Ad Services
 * Description: Displays a grid of ad service items with dynamic step numbers and progress dots.
 *
 * @param array $args {
 *     @type array $ad_services ACF field data for ad service items.
 * }
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

// Safely extract ad_services data from $args
$ad_services = $args['ad_services'] ?? [];

// Exit early if no ad services
if (empty($ad_services) || !is_array($ad_services)) {
    return;
}

// Determine grid columns based on number of items
$count = count($ad_services);
$grid_cols = min($count, 4); // Max 4 columns
$grid_class = "grid grid-cols-{$grid_cols} gap-5 py-10";
?>

<section class="additional-ad-services container grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-5 py-10">
    <div class="flex justify-center items-center my-5 col-span-4 flex-column">
        <h2 class="text-white text-3xl">
            <?php echo get_field('additional_ad_services_title',get_the_ID()) ?>
        </h2>
        <p class="description"><?php echo get_field('additional_ad_services_text',get_the_ID()) ?></p>
    </div>
    <?php
    $step = 1;
    foreach ($ad_services as $item) {
        $image = $item['image'] ?? '';
        $title = $item['title'] ?? '';
        $caption = $item['caption'] ?? '';
        $link = $item['link'] ?? [];
        // Skip if critical fields are empty
        if (empty($title) || empty($caption) || empty($image)) {
            continue;
        }
        // Generate dot steps (4 dots, with $step determining active dots)
        $dot_count = min($step, 3); // Ensure max 4 dots
        $dots_html = '';
        for ($i = 1; $i <= 3; $i++) {
            $dots_html .= '<div class="dot-step' . ($i <= $dot_count ? ' active' : '') . '"></div>';
        }
    ?>
        <a href="<?php echo esc_url($link['url'] ?? '#'); ?>" class="cart-ads">
            <div class="thumb" style="background-image:url(<?=$image?>)"></div>
            <div class="flex justify-between items-center w-full">
                
                <span class="flex items-center justify-center gap-1">
                    <?php echo $dots_html; ?>
                </span>
            </div>
            <h3 class="title"><?php echo $title ?></h3>
            <div class="caption"><?php echo $caption ?></div>
        </a>
    <?php
        $step++;
    }
    ?>
</section>