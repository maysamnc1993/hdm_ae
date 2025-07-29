<section class="ads-applications relative">
    <div class="bg-dots" style="background-image: url(<?php 
        $bg_image = get_field('ads_background_image') ?: 'svg/bg-app-ads.svg'; // Fallback to default
        echo inline_url_img($bg_image);
    ?>)"></div>
    <div class="container flex flex-col gap-7 md:gap-12 content-container">
        <div class="content flex flex-col text-white gap-6 w-full">
            <span class="gray-color">
                <?php echo esc_html(get_field('ads_about_me')); ?>
            </span>
            <div class="flex justify-between items-end flex-col md:flex-row gap-4 md:gap-0">
                <h2 class="text-8 md:text-12 leading-10 md:leading-14 text-white max-w-xl"><?php echo esc_html(get_field('ads_main_title')); ?></h2>
                <p class="gray-color max-w-50"><?php echo esc_html(get_field('ads_main_description')); ?></p>
            </div>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-5">
            <?php
            if (have_rows('ads_cards')) {
                $index = 1; // For numbering cards
                while (have_rows('ads_cards')) {
                    the_row();
                    $title = get_sub_field('card_title');
                    $subtitle = get_sub_field('card_subtitle');
                    $description = get_sub_field('card_description');
            ?>
                    <div class="cart flex flex-col gap-3">
                        <h3 class="text-white text-2xl"><?php echo esc_html($index . '. ' . $title); ?></h3>
                        <p class="gray-color"><?php echo esc_html($subtitle); ?></p>
                        <p class="gray-color"><?php echo esc_html($description); ?></p>
                    </div>
            <?php
                    $index++;
                }
            }
            ?>
        </div>
    </div>
</section>