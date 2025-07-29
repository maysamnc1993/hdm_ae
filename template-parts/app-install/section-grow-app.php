<?php

/**
 * Services Section Template
 * Modern interactive services showcase with smooth animations, connected to ACF
 */

?>

<section class="grow-app" style="<?php
                                    // Get ACF color fields
                                    $text_color = get_field('services_text_color') ?: '#1F2937'; // Default to rgb(31, 41, 55)
                                    $background_color = get_field('services_background_color') ?: '#FFFFFF'; // Default to white
                                    $hover_text_color = get_field('services_hover_text_color') ?: '#1F2937'; // Default to rgb(31, 41, 55)
                                    $border_color = get_field('services_border_color') ?: '#F9452D'; // Default to rgb(249, 69, 45)
                                    echo 'color: ' . esc_attr($text_color) . '; background-color: ' . esc_attr($background_color) . ';';
                                    echo '--hover-text-color: ' . esc_attr($hover_text_color) . '; --border-color: ' . esc_attr($border_color) . ';';
                                    ?>">
    <!-- Header Section -->
    <div class="container flex justify-between items-center py-5 mx-auto px-4">
        <span class="font-bold">hdm marketing</span>
        <span class="flex items-center gap-1 font-bold">
            <div class="corner-radius"></div>
            services
        </span>
    </div>

    <!-- Main Content Section -->
    <div class="container flex-col-reverse md:flex-row flex items-start justify-center px-4 sm:px-6 lg:px-8 md:py-20 my-12 md:my-20 gap-6 md:gap-12 mx-auto">

        <!-- Content Items -->
        <div class="content">
            <div class="content-container">
                <?php
                if (have_rows('services')) {
                    $index = 1; // Start index for data-title
                    while (have_rows('services')) {
                        the_row();
                        $title = get_sub_field('service_title');
                        $description = get_sub_field('service_description');
                        $image = get_sub_field('service_image');
                ?>
                        <!-- Service Item -->
                        <div class="content-item" data-title="<?php echo esc_attr($index); ?>">
                            <?php
                            if ($image) {
                                echo wp_get_attachment_image(
                                    $image['ID'],
                                    'full', // Use 'full' size and rely on CSS for sizing
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
                }
                ?>
            </div>
        </div>

        <!-- Navigation Titles -->
        <div class="titles">
            <?php
            if (have_rows('services')) {
                $index = 1; // Reset index for titles
                while (have_rows('services')) {
                    the_row();
                    $title = get_sub_field('service_title');
                    $index_padded = sprintf("%02d", $index); // Format index as 01, 02, etc.
            ?>
                    <h3 class="title" data-title="<?php echo esc_attr($index); ?>" tabindex="0" role="button" aria-label="View <?php echo esc_attr($title); ?> service">
                        <?php echo esc_html($title); ?>
                        <sup>{ <span><?php echo esc_html($index_padded); ?></span> }</sup>
                    </h3>
            <?php
                    $index++;
                }
            }
            ?>
        </div>

    </div>
</section>