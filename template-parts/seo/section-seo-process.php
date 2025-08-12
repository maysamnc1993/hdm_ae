<?php
// Check if the repeater field has rows before rendering the section
if (function_exists('have_rows') && have_rows('seo_process_cubes')):
?>
<section class="seo-process container flex flex-col gap-8 items-center justify-center my-12">
    <!-- Section Title -->
    <div class="flex flex-col gap-6 my-12 items-center justify-center">
        <?php if (function_exists('get_field') && get_field('section_title_top')): ?>
            <span class="text-brand-primary text-xl"><?php echo esc_html(get_field('section_title_top')); ?></span>
        <?php endif; ?>

        <h2 class="section-title text-6xl font-bold text-center text-white">
            <?php
            if (function_exists('get_field') && get_field('section_title')) {
                echo esc_html(get_field('section_title'));
            } else {
                echo 'Our Process'; // Fallback title
            }
            ?>
        </h2>

        <?php if (function_exists('get_field') && get_field('section_title_bottom')): ?>
            <p class="text-white text-2xl"><?php echo esc_html(get_field('section_title_bottom')); ?></p>
        <?php endif; ?>
    </div>
    <div class="Cube_items">
    <?php
    $index = 1; // Counter for --index CSS variable
    while (have_rows('seo_process_cubes')) : the_row();
        $cube_title = get_sub_field('cube_title');
        $cube_description = get_sub_field('cube_description');
        $cube_front_image = get_sub_field('cube_front_image');
        $cube_top_image = get_sub_field('cube_top_image');
    ?>
        <div class="cube-container" style="--index: <?php echo $index; ?>;">
            <div class="cube">
                <div class="face front" style="background-image:url(<?php echo esc_url($cube_front_image); ?>)">
                    <div class="text-container">
                        <p class="title"><?php echo esc_html($cube_title); ?></p>
                        <p class="description"><?php echo esc_html($cube_description); ?></p>
                    </div>
                    <figure class="max-w-56">
                        <span class="count"><?=$index?></span>
                        <!-- <img src="" class="w-full h-full" alt="<?php echo esc_attr($cube_title); ?>" loading="lazy"> -->
                    </figure>
                </div>
                <div class="face top">
                    <img src="<?php echo esc_url($cube_top_image); ?>" alt="Hidden Image" loading="lazy">
                </div>
            </div>
        </div>
    <?php
        $index++;
    endwhile;
    ?>
    </div>
</section>
<?php
endif; // End of repeater check