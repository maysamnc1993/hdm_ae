<?php

/**
 * Template Part: Trending Articles Section
 *
 * Displays a sidebar with a heading and a grid of trending blog posts.
 * Uses comment count for ordering (fallback since _trending_score is not set).
 * Integrates with Term_Meta for category icons.
 *
 * @package YourThemeName
 */

// Query trending posts (ordered by comment count as a fallback)
$args = [
    'post_type'      => 'post',
    'posts_per_page' => 5,
    'post_status'    => 'publish',
    'orderby'        => 'comment_count', // Fallback to comment count for trending
    'order'          => 'DESC',
    'meta_query'     => [
        'relation' => 'OR',
        [
            'key'     => '_is_featured',
            'value'   => '1',
            'compare' => '!=', // Exclude posts where _is_featured is 1
        ],
        [
            'key'     => '_is_featured',
            'compare' => 'NOT EXISTS', // Include posts without _is_featured
        ],
    ],
];
$trending_posts_query = new WP_Query($args);
?>

<section class="pt-16 sm:pt-24 pb-6 sm:pb-12 bg-light">
    <div class="container">
        <div class="row justify-center">
            <div class="lg:col-10">
                <div class="row">
                    <div class="lg:col-6">
                        <div class="mb-14 lg:mb-20 text-center lg:text-start">
                            <?php
                            $trending_group = get_field('trending_group'); // فراخوانی گروه
                            $trending_subtitle = $trending_group['trending_subtitle'] ?? 'Trending Articles';
                            $trending_title = $trending_group['trending_title'] ?? 'Where Knowledge Meets Passion';
                            $trending_description = $trending_group['trending_description'] ?? 'Trending Articles of consectetur morbi. Amet venenatis urna cursus eget nunc scelerisque viverra.';
                            $button_link = $trending_group['trending_button_link'] ?? ['url' => get_post_type_archive_link('post'), 'title' => 'All Posts'];
                            $button_text = $trending_group['trending_button_text'] ?? 'All Posts';
                            ?>
                            <p class="text-base uppercase font-secondary pl-4 relative after:absolute after:rounded-full -mt-1 after:content-[''] after:h-2 after:w-2 after:bg-primary after:left-0 after:top-2 w-fit mb-8 mx-auto lg:mx-0">
                                <?php echo esc_html($trending_subtitle); ?>
                            </p>
                            <h2 class="text-3xl md:text-4xl !leading-normal mb-4 text-balance">
                                <?php echo esc_html($trending_title); ?>
                            </h2>
                            <p class="text-[#4E4C3D] lg:mb-8 leading-relaxed font-light uppercase text-balance text-sm sm:text-base">
                                <?php echo esc_html($trending_description); ?>
                            </p>
                            <a class="button button-lg group animate-top-right" href="<?php echo esc_url($button_link['url']); ?>">
                                <span class="relative overflow-hidden transition-none [&amp;&gt;span]:block">
                                    <span class="group-hover:-translate-y-[200%] group-hover:scale-y-[2] group-hover:rotate-12">
                                        <?php echo esc_html($button_link['title'] ?: $button_text); ?>
                                    </span>
                                    <span class="absolute left-0 top-0 scale-y-[2] rotate-12 translate-y-[200%] group-hover:translate-y-0 group-hover:scale-y-100 group-hover:rotate-0">
                                        <?php echo esc_html($button_link['title'] ?: $button_text); ?>
                                    </span>
                                </span>
                                <span class="overflow-hidden leading-none -translate-y-[2px]">
                                    <svg class="inline-block animate-icon" width="10" height="10" viewBox="0 0 10 10" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M1 9.00005L9 1.00005M9 1.00005H1.8M9 1.00005V8.20005" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                    </svg>
                                </span>
                            </a>
                        </div>
                        <div class="row">
                            <?php if ($trending_posts_query->have_posts()) : ?>
                                <?php
                                $counter = 0;
                                // First column: 2 posts
                                while ($trending_posts_query->have_posts() && $counter < 2) : $trending_posts_query->the_post();
                                    $col_class = ($counter == 0) ? 'lg:col-8 sm:col-6 mx-auto mb-12' : 'lg:col-10 sm:col-6 ml-auto mb-12';
                                ?>
                                    <div class="<?php echo esc_attr($col_class); ?>">
                                        <article class="post-card post-category-top group relative has-line-link">
                                            <div class="relative">
                                                <span class="post-category bg-light text-dark z-10">
                                                    <?php
                                                    $category = get_the_category()[0] ?? null;
                                                    if ($category) :
                                                    ?>
                                                        <a class="border-border transition duration-300 hover:bg-dark hover:text-white hover:border-dark" href="<?php echo esc_url(get_category_link($category->term_id)); ?>">
                                                            <?php echo esc_html($category->name); ?>
                                                        </a>
                                                        <span class="text-light corner left">
                                                            <svg width="101" height="101" viewBox="0 0 101 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                <path fill-rule="evenodd" clip-rule="evenodd" d="M101 0H0V101H1C1 45.7715 45.7715 1 101 1V0Z" fill="currentColor"></path>
                                                            </svg>
                                                        </span>
                                                        <span class="text-light corner bottom">
                                                            <svg width="101" height="101" viewBox="0 0 101 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                <path fill-rule="evenodd" clip-rule="evenodd" d="M101 0H0V101H1C1 45.7715 45.7715 1 101 1V0Z" fill="currentColor"></path>
                                                            </svg>
                                                        </span>
                                                    <?php endif; ?>
                                                </span>
                                                <?php if (has_post_thumbnail()) : ?>
                                                    <?php
                                                    the_post_thumbnail('large', [
                                                        'class' => 'rounded-xl md:rounded-2xl w-full object-cover bg-white/40 aspect-[9/10] lg:aspect-[9/12]',
                                                        'alt'   => get_the_title(),
                                                    ]);
                                                    ?>
                                                <?php else : ?>
                                                    <img alt="<?php the_title_attribute(); ?>" loading="lazy" width="520" height="660" class="rounded-xl md:rounded-2xl w-full object-cover bg-white/40 aspect-[9/10] lg:aspect-[9/12]" src="<?php echo esc_url(get_template_directory_uri() . '/images/fallback.jpg'); ?>">
                                                <?php endif; ?>
                                            </div>
                                            <div class="mt-6 text-center">
                                                <span class="text-sm flex justify-center gap-2 items-center mb-3 uppercase">
                                                    <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <path d="M12.6663 2.66677H11.333V2.0001C11.333 1.82329 11.2628 1.65372 11.1377 1.5287C11.0127 1.40367 10.8432 1.33344 10.6663 1.33344C10.4895 1.33344 10.32 1.40367 10.1949 1.5287C10.0699 1.65372 9.99967 1.82329 9.99967 2.0001V2.66677H5.99967V2.0001C5.99967 1.82329 5.92944 1.65372 5.80441 1.5287C5.67939 1.40367 5.50982 1.33344 5.33301 1.33344C5.1562 1.33344 4.98663 1.40367 4.8616 1.5287C4.73658 1.65372 4.66634 1.82329 4.66634 2.0001V2.66677H3.33301C2.80257 2.66677 2.29387 2.87748 1.91879 3.25255C1.54372 3.62763 1.33301 4.13633 1.33301 4.66677V12.6668C1.33301 13.1972 1.54372 13.7059 1.91879 14.081C2.29387 14.4561 2.80257 14.6668 3.33301 14.6668H12.6663C13.1968 14.6668 13.7055 14.4561 14.0806 14.081C14.4556 13.7059 14.6663 13.1972 14.6663 12.6668V4.66677C14.6663 4.13633 14.4556 3.62763 14.0806 3.25255C13.7055 2.87748 13.1968 2.66677 12.6663 2.66677ZM13.333 12.6668C13.333 12.8436 13.2628 13.0131 13.1377 13.1382C13.0127 13.2632 12.8432 13.3334 12.6663 13.3334H3.33301C3.1562 13.3334 2.98663 13.2632 2.8616 13.1382C2.73658 13.0131 2.66634 12.8436 2.66634 12.6668V8.0001H13.333V12.6668ZM13.333 6.66677H2.66634V4.66677C2.66634 4.48996 2.73658 4.32039 2.8616 4.19536C2.98663 4.07034 3.1562 4.0001 3.33301 4.0001H4.66634V4.66677C4.66634 4.84358 4.73658 5.01315 4.8616 5.13817C4.98663 5.2632 5.1562 5.33343 5.33301 5.33343C5.50982 5.33343 5.67939 5.2632 5.80441 5.13817C5.92944 5.01315 5.99967 4.84358 5.99967 4.66677V4.0001H9.99967V4.66677C9.99967 4.84358 10.0699 5.01315 10.1949 5.13817C10.32 5.2632 10.4895 5.33343 10.6663 5.33343C10.8432 5.33343 11.0127 5.2632 11.1377 5.13817C11.2628 5.01315 11.333 4.84358 11.333 4.66677V4.0001H12.6663C12.8432 4.0001 13.0127 4.07034 13.1377 4.19536C13.2628 4.32039 13.333 4.48996 13.333 4.66677V6.66677Z" fill="currentColor"></path>
                                                    </svg>
                                                    <?php echo get_the_date('M j, Y'); ?>
                                                </span>
                                                <h3 class="text-2xl text-dark leading-relaxed mb-4 line-link">
                                                    <a class="link-stretched line-link-el" aria-label="<?php the_title_attribute(); ?>" href="<?php the_permalink(); ?>">
                                                        <?php the_title(); ?>
                                                    </a>
                                                </h3>
                                                <ul class="flex flex-wrap items-center justify-center gap-3 gap-y-1 mb-6 uppercase text-sm text-[#464536]">
                                                    <li class="flex items-center">
                                                        <?php
                                                        $author_id = get_the_author_meta('ID');
                                                        $author_avatar = get_avatar_url($author_id, ['size' => 24]);
                                                        $author_name = get_the_author_meta('first_name') ?: get_the_author();
                                                        ?>
                                                        <img alt="Author of the post - <?php echo esc_attr($author_name); ?>" loading="lazy" width="24" height="24" class="h-6 w-6 border border-[#ABABAB] rounded-full mr-2 bg-white/40" src="<?php echo esc_url($author_avatar); ?>">
                                                        <?php echo esc_html($author_name); ?>
                                                    </li>
                                                    <li>•</li>
                                                    <li><?php echo esc_html(reading_time()); ?></li>
                                                </ul>
                                                <span class="inline-block text-black group-hover:text-black group-hover:rotate-45 transition duration-300">
                                                    <svg width="16" height="16" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <path d="M1.99902 18.0009L18 1.99991M18 1.99991H3.59912M18 1.99991V16.4008" stroke="black" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                                    </svg>
                                                </span>
                                            </div>
                                        </article>
                                    </div>
                                    <?php $counter++; ?>
                                <?php endwhile; ?>
                        </div>
                    </div>
                    <div class="lg:col-6">
                        <div class="row">
                            <?php
                                // Second column: 3 posts
                                while ($trending_posts_query->have_posts() && $counter < 5) : $trending_posts_query->the_post();
                                    $col_class = ($counter == 2 || $counter == 4) ? 'lg:col-10 sm:col-6 ml-auto mb-12' : 'lg:col-8 sm:col-6 ml-auto mb-12';
                            ?>
                                <div class="<?php echo esc_attr($col_class); ?>">
                                    <article class="post-card post-category-top group relative has-line-link">
                                        <div class="relative">
                                            <span class="post-category bg-light text-dark z-10">
                                                <?php
                                                $category = get_the_category()[0] ?? null;
                                                if ($category) :
                                                ?>
                                                    <a class="border-border transition duration-300 hover:bg-dark hover:text-white hover:border-dark" href="<?php echo esc_url(get_category_link($category->term_id)); ?>">
                                                        <?php echo esc_html($category->name); ?>
                                                    </a>
                                                    <span class="text-light corner left">
                                                        <svg width="101" height="101" viewBox="0 0 101 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                            <path fill-rule="evenodd" clip-rule="evenodd" d="M101 0H0V101H1C1 45.7715 45.7715 1 101 1V0Z" fill="currentColor"></path>
                                                        </svg>
                                                    </span>
                                                    <span class="text-light corner bottom">
                                                        <svg width="101" height="101" viewBox="0 0 101 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                            <path fill-rule="evenodd" clip-rule="evenodd" d="M101 0H0V101H1C1 45.7715 45.7715 1 101 1V0Z" fill="currentColor"></path>
                                                        </svg>
                                                    </span>
                                                <?php endif; ?>
                                            </span>
                                            <?php if (has_post_thumbnail()) : ?>
                                                <?php
                                                the_post_thumbnail('large', [
                                                    'class' => 'rounded-xl md:rounded-2xl w-full object-cover bg-white/40 aspect-[9/10] lg:aspect-[9/12]',
                                                    'alt'   => get_the_title(),
                                                ]);
                                                ?>
                                            <?php else : ?>
                                                <img alt="<?php the_title_attribute(); ?>" loading="lazy" width="520" height="660" class="rounded-xl md:rounded-2xl w-full object-cover bg-white/40 aspect-[9/10] lg:aspect-[9/12]" src="<?php echo esc_url(get_template_directory_uri() . '/images/fallback.jpg'); ?>">
                                            <?php endif; ?>
                                        </div>
                                        <div class="mt-6 text-center">
                                            <span class="text-sm flex justify-center gap-2 items-center mb-3 uppercase">
                                                <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M12.6663 2.66677H11.333V2.0001C11.333 1.82329 11.2628 1.65372 11.1377 1.5287C11.0127 1.40367 10.8432 1.33344 10.6663 1.33344C10.4895 1.33344 10.32 1.40367 10.1949 1.5287C10.0699 1.65372 9.99967 1.82329 9.99967 2.0001V2.66677H5.99967V2.0001C5.99967 1.82329 5.92944 1.65372 5.80441 1.5287C5.67939 1.40367 5.50982 1.33344 5.33301 1.33344C5.1562 1.33344 4.98663 1.40367 4.8616 1.5287C4.73658 1.65372 4.66634 1.82329 4.66634 2.0001V2.66677H3.33301C2.80257 2.66677 2.29387 2.87748 1.91879 3.25255C1.54372 3.62763 1.33301 4.13633 1.33301 4.66677V12.6668C1.33301 13.1972 1.54372 13.7059 1.91879 14.081C2.29387 14.4561 2.80257 14.6668 3.33301 14.6668H12.6663C13.1968 14.6668 13.7055 14.4561 14.0806 14.081C14.4556 13.7059 14.6663 13.1972 14.6663 12.6668V4.66677C14.6663 4.13633 14.4556 3.62763 14.0806 3.25255C13.7055 2.87748 13.1968 2.66677 12.6663 2.66677ZM13.333 12.6668C13.333 12.8436 13.2628 13.0131 13.1377 13.1382C13.0127 13.2632 12.8432 13.3334 12.6663 13.3334H3.33301C3.1562 13.3334 2.98663 13.2632 2.8616 13.1382C2.73658 13.0131 2.66634 12.8436 2.66634 12.6668V8.0001H13.333V12.6668ZM13.333 6.66677H2.66634V4.66677C2.66634 4.48996 2.73658 4.32039 2.8616 4.19536C2.98663 4.07034 3.1562 4.0001 3.33301 4.0001H4.66634V4.66677C4.66634 4.84358 4.73658 5.01315 4.8616 5.13817C4.98663 5.2632 5.1562 5.33343 5.33301 5.33343C5.50982 5.33343 5.67939 5.2632 5.80441 5.13817C5.92944 5.01315 5.99967 4.84358 5.99967 4.66677V4.0001H9.99967V4.66677C9.99967 4.84358 10.0699 5.01315 10.1949 5.13817C10.32 5.2632 10.4895 5.33343 10.6663 5.33343C10.8432 5.33343 11.0127 5.2632 11.1377 5.13817C11.2628 5.01315 11.333 4.84358 11.333 4.66677V4.0001H12.6663C12.8432 4.0001 13.0127 4.07034 13.1377 4.19536C13.2628 4.32039 13.333 4.48996 13.333 4.66677V6.66677Z" fill="currentColor"></path>
                                                </svg>
                                                <?php echo get_the_date('M j, Y'); ?>
                                            </span>
                                            <h3 class="text-2xl text-dark leading-relaxed mb-4 line-link">
                                                <a class="link-stretched line-link-el" aria-label="<?php the_title_attribute(); ?>" href="<?php the_permalink(); ?>">
                                                    <?php the_title(); ?>
                                                </a>
                                            </h3>
                                            <ul class="flex flex-wrap items-center justify-center gap-3 gap-y-1 mb-6 uppercase text-sm text-[#464536]">
                                                <li class="flex items-center">
                                                    <?php
                                                    $author_id = get_the_author_meta('ID');
                                                    $author_avatar = get_avatar_url($author_id, ['size' => 24]);
                                                    $author_name = get_the_author_meta('first_name') ?: get_the_author();
                                                    ?>
                                                    <img alt="Author of the post - <?php echo esc_attr($author_name); ?>" loading="lazy" width="24" height="24" class="h-6 w-6 border border-[#ABABAB] rounded-full mr-2 bg-white/40" src="<?php echo esc_url($author_avatar); ?>">
                                                    <?php echo esc_html($author_name); ?>
                                                </li>
                                                <li>•</li>
                                                <li><?php echo esc_html(reading_time()); ?></li>
                                            </ul>
                                            <span class="inline-block text-black group-hover:text-black group-hover:rotate-45 transition duration-300">
                                                <svg width="16" height="16" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M1.99902 18.0009L18 1.99991M18 1.99991H3.59912M18 1.99991V16.4008" stroke="black" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                                </svg>
                                            </span>
                                        </div>
                                    </article>
                                </div>
                                <?php $counter++; ?>
                            <?php endwhile; ?>
                            <?php wp_reset_postdata(); ?>
                        <?php else : ?>
                            <div class="col-12">
                                <p class="text-center">No trending posts found.</p>
                            </div>
                        <?php endif; ?>
                        </div>
                    </div>
                    <div class="col-12 block lg:hidden mb-10">
                        <?php
                        $button_link = get_field('trending_button_link') ?: ['url' => get_post_type_archive_link('post'), 'title' => 'All Posts'];
                        ?>
                        <a class="button button-lg group animate-top-right w-fit mx-auto" href="<?php echo esc_url($button_link['url']); ?>">
                            <span class="relative overflow-hidden transition-none [&amp;&gt;span]:block">
                                <span class="group-hover:-translate-y-[200%] group-hover:scale-y-[2] group-hover:rotate-12">
                                    <?php echo esc_html($button_link['title'] ?: get_field('trending_button_text') ?: 'All Posts'); ?>
                                </span>
                                <span class="absolute left-0 top-0 scale-y-[2] rotate-12 translate-y-[200%] group-hover:translate-y-0 group-hover:scale-y-100 group-hover:rotate-0">
                                    <?php echo esc_html($button_link['title'] ?: get_field('trending_button_text') ?: 'All Posts'); ?>
                                </span>
                            </span>
                            <span class="overflow-hidden leading-none -translate-y-[2px]">
                                <svg class="inline-block animate-icon" width="10" height="10" viewBox="0 0 10 10" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M1 9.00005L9 1.00005M9 1.00005H1.8M9 1.00005V8.20005" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                </svg>
                            </span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>