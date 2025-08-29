<?php

/**
 * Template Part: Category List Section
 *
 * Displays a list of blog categories with their icons and hover effects.
 * Integrates with the Term_Meta class to display category icons.
 *
 */

// Get all categories (excluding empty ones)
$categories = get_categories([
    'taxonomy'   => 'category',
    'hide_empty' => true,
    'orderby'    => 'name',
    'order'      => 'ASC',
]);

?>

<section class="sm:pt-5 pb-16 sm:pb-24 overflow-hidden">
    <div class="container mt-12">
        <!-- Section Header -->
        <div class="flex flex-col gap-6 my-12 items-center justify-center">
            <?php
            $header_group = get_field('header_group'); 
            $category_subtitle = $header_group['category_subtitle'] ?? 'Where I Can Help';
            $category_title = $header_group['category_title'] ?? 'Our Process';
            ?>
            <span class="text-brand-primary text-xl">
                <?php echo esc_html($category_subtitle); ?>
            </span>
            <h2 class="section-title text-6xl font-bold text-center text-white">
                <?php echo esc_html($category_title); ?>
            </h2>
        </div>

        <!-- Category List -->
        <?php if (!empty($categories)) : ?>
            <ul class="text-center flex flex-wrap justify-center gap-x-3 gap-y-4 sm:gap-6 lg:gap-8 [&>li]:text-2xl sm:[&>li]:text-3xl lg:[&>li]:text-4xl [&>li]:cursor-pointer font-primary text-black [&>li]:capitalize">
                <?php
                $total_categories = count($categories);
                $index = 0;
                foreach ($categories as $category) :
                    $index++;
                    // Get category icon (using Term_Meta field 'category_icon')
                    $category_icon_id = get_term_meta($category->term_id, '_category_icon', true);
                    $category_icon_url = $category_icon_id ? wp_get_attachment_url($category_icon_id) : get_template_directory_uri() . '/images/fallback.jpg';
                ?>
                    <li class="relative group transition-all duration-300">
                        <a class="inline-block text-white" href="<?php echo esc_url(get_category_link($category->term_id)); ?>">
                            <span class="transition-all duration-100 relative z-30 group-hover:text-white group-hover:drop-shadow-lg">
                                <?php echo esc_html($category->name); ?>
                            </span>
                            <span class="absolute h-[80px] sm:h-[100px] lg:h-[130px] w-[140px] sm:w-[200px] lg:w-[250px] left-1/2 top-[35%] -translate-x-1/2 -translate-y-1/2 opacity-0 invisible scale-90 -rotate-12 transition-all duration-300 group-hover:opacity-100 group-hover:visible group-hover:scale-100 overflow-hidden rounded-lg z-20 pointer-events-none mt-4 group-hover:mt-0">
                                <?php
                                // Determine which field to use based on taxonomy
                                $taxonomy = $category->taxonomy ?? 'category';
                                $field_id = 'category_icon';

                                if (has_category_icon($category->term_id, $field_id)):
                                    // Display the uploaded icon
                                    echo display_category_icon(
                                        $category->term_id,
                                        'thumbnail',
                                        $field_id,
                                        ['class' => 'object-cover h-full w-full scale-125 group-hover:scale-100 transition-all duration-300']
                                    );
                                endif ?>
                            </span>
                        </a>
                        <?php if ($index < $total_categories) : ?>
                            <span class="ml-3 sm:ml-6 lg:ml-8 opacity-30 text-white">/</span>
                        <?php endif; ?>
                    </li>
                <?php endforeach; ?>
            </ul>
        <?php else : ?>
            <p class="text-center text-white">No categories found.</p>
        <?php endif; ?>
    </div>
</section>