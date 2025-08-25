<?php

/**
 * Services Section Template
 * Modern interactive services showcase with smooth animations, connected to ACF
 *
 * @param array $args {
 *     @type array $services ACF field data for the services section.
 * }
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

$services = $args['services'] ?? [
    'header_brand' => 'hdm marketing',
    'header_title' => 'services',
    'text_color' => '#1F2937',
    'background_color' => '#FFFFFF',
    'hover_text_color' => '#1F2937',
    'border_color' => '#F9452D',
    'items' => [],
];
?>

<section class="grow-app" style="<?php
                                    echo 'color: ' . esc_attr($services['text_color']) . '; background-color: ' . esc_attr($services['background_color']) . ';';
                                    echo '--hover-text-color: ' . esc_attr($services['hover_text_color']) . '; --border-color: ' . esc_attr($services['border_color']) . ';';
                                    ?>">
    <!-- Header Section -->
    <!-- <div class="container flex justify-between items-center py-5 mx-auto px-4">
        <span class="font-bold"><?php echo esc_html($services['header_brand']); ?></span>
        <span class="flex items-center gap-1 font-bold">
            <div class="corner-radius"></div>
            <?php echo esc_html($services['header_title']); ?>
        </span>
    </div> -->

    <!-- Main Content Section -->
    <div class="container flex-col-reverse md:flex-row flex items-start justify-center px-4 sm:px-6 lg:px-8 md:py-20 my-12 md:my-20 gap-6 md:gap-12 mx-auto">
        <!-- Content Items -->
        <div class="content">
            <div class="content-container">
                <?php
                if (!empty($services['items'])) {
                    $index = 1;
                    foreach ($services['items'] as $item) {
                        $title = $item['service_title'] ?? '';
                        $description = $item['service_description'] ?? '';
                        $image = $item['service_image'] ?? '';
                ?>
                        <!-- Service Item -->
                        <div class="content-item" data-title="<?php echo esc_attr($index); ?>">
                            <?php
                            if ($image) {
                                echo wp_get_attachment_image(
                                    $image['ID'],
                                    'full',
                                    false,
                                    array(
                                        'class' => 'w-full h-64 object-cover',
                                        'alt' => esc_attr($title)
                                    )
                                );
                            } ?>
                            <div class="flex-col flex gap-1">
                                <h3><?php echo esc_html($title); ?></h3>
                                <p><?php echo esc_html($description); ?></p>
                            </div>
                        </div>
                <?php
                        $index++;
                    }
                } else {
                    
                }
                ?>
            </div>
        </div>

        <!-- Navigation Titles -->
        <div class="titles">
            <?php
            if (!empty($services['items'])) {
                $index = 1;
                foreach ($services['items'] as $item) {
                    $title = $item['service_title'] ?? '';
                    $index_padded = sprintf("%02d", $index);
            ?>
                    <h3 class="title" data-title="<?php echo esc_attr($index); ?>" tabindex="0" role="button" aria-label="View <?php echo esc_attr($title); ?> service">
                        <?php echo esc_html($title); ?>
                        <sup>{ <span><?php echo esc_html($index_padded); ?></span> }</sup>
                    </h3>
            <?php
                    $index++;
                }
            } else {
               
            }
            ?>
        </div>
    </div>
</section>