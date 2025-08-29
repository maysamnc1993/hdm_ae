<?php if (have_rows('stat_items')) : ?>
<section class="stat relative overflow-hidden ">
    <div class="container">
    <?php
    // Get background image from ACF, fallback to default
    
    display_img($background_image, "absolute inset-0 w-screen h-full object-cover stat-bg", "Stats background image");
    ?>
    <img src="<?php echo  $background_image ?>" class="absolute inset-0 w-screen h-full object-cover stat-bg" style="display:none;" >
    <div class="h-full flex items-end">
        <div class="grid grid-cols-5 h-full w-full stat-items ">
            <?php
            // Loop through repeater rows
            while (have_rows('stat_items')) : the_row();
                $title = get_sub_field('stat_title');
                $count = get_sub_field('stat_count');
                ?>
                <div class="stat-item">
                    <div class="text-sm title-item"><?php echo esc_html($title); ?></div>
                    <div class="number-item text-4xl font-bold mb-2" data-count="<?php echo esc_attr($count); ?>">0</div>
                </div>
                <?php
            endwhile;
            ?>
        </div>
    </div>
    
</section>
<?php endif; ?>