<?php

/**
 * Template Part: Popular Articles Section
 *
 * Displays a sticky sidebar with a heading and a vertical list of popular blog posts,
 * ordered by comment count. Integrates with Term_Meta for category icons.
 *

 */

// Query popular posts (ordered by comment count)
$args = [
    'post_type'      => 'post',
    'posts_per_page' => 4,
    'post_status'    => 'publish',
    'orderby'        => 'comment_count',
    'order'          => 'DESC',
    'meta_query'     => [
        'relation' => 'OR',
        [
            'key'     => '_is_featured',
            'value'   => '1',
            'compare' => '!=',
        ],
        [
            'key'     => '_is_featured',
            'compare' => 'NOT EXISTS',
        ],
    ],
];
$popular_posts_query = new WP_Query($args);
?>

<section class="py-16 sm:py-24 darkBg">
    <div class="container">
        <div class="row">

            <!-- Sticky Sidebar -->
            <div class="lg:col-5 mb-14 lg:mb-0">
                <div class="sticky top-12 lg:pr-12 text-center md:text-start">
                    <p class="text-white text-base uppercase font-secondary pl-4 relative after:absolute after:rounded-full -mt-1 after:content-[''] after:h-2 after:w-2 after:bg-primary after:left-0 after:top-2 w-fit mb-8 mx-auto md:mx-0">
                        <?php echo esc_html(get_field('popular_subtitle') ?: 'Popular Articles'); ?>
                    </p>
                    <h2 class="text-3xl md:text-4xl text-white !leading-normal mb-4">
                        <?php echo esc_html(get_field('popular_title') ?: 'Business insights and workplace culture'); ?>
                    </h2>
                    <p class="text-[#9C9C9C] md:mb-8 leading-relaxed uppercase font-light text-balance">
                        <?php echo esc_html(get_field('popular_description') ?: 'Popular Articles of consectetur morbi. Amet venenatis urna cursus eget nunc scelerisque viverra.'); ?>
                    </p>
                    <div class="hidden md:inline-block">
                        <?php
                        $button_link = get_field('popular_button_link') ?: ['url' => get_post_type_archive_link('post'), 'title' => 'All Posts'];
                        ?>
                        <a class="button button-lg button-light group animate-top-right" href="<?php echo esc_url($button_link['url']); ?>">
                            <span class="relative overflow-hidden transition-none [&>span]:block">
                                <span class="group-hover:-translate-y-[200%] group-hover:scale-y-[2] group-hover:rotate-12">
                                    <?php echo esc_html($button_link['title'] ?: get_field('popular_button_text') ?: 'All Posts'); ?>
                                </span>
                                <span class="absolute left-0 top-0 scale-y-[2] rotate-12 translate-y-[200%] group-hover:translate-y-0 group-hover:scale-y-100 group-hover:rotate-0">
                                    <?php echo esc_html($button_link['title'] ?: get_field('popular_button_text') ?: 'All Posts'); ?>
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
            <!-- Posts List -->
            <div class="lg:col-7">
                <?php if ($popular_posts_query->have_posts()) : ?>
                    <?php
                    $counter = 0;
                    while ($popular_posts_query->have_posts()) : $popular_posts_query->the_post();
                        $margin_class = ($counter % 2 == 0) ? 'md:mr-20' : 'md:ml-20';
                    ?>
                        <div class="mb-16 <?php echo esc_attr($margin_class); ?>">
                            <article class="post-card post-category-top group relative has-line-link-white">
                                <div class="relative">
                                    <!-- Category Tag -->
                                    <?php
                                    $category = get_the_category()[0] ?? null;
                                    if ($category) :
                                    ?>
                                        <span class="post-category text-white bg-black z-10">
                                            <a class="transition duration-300 bg-black text-white border-white/30 hover:bg-white hover:text-dark" href="<?php echo esc_url(get_category_link($category->term_id)); ?>">
                                                <?php echo esc_html($category->name); ?>
                                            </a>
                                            <span class="text-black corner left">
                                                <svg width="101" height="101" viewBox="0 0 101 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M101 0H0V101H1C1 45.7715 45.7715 1 101 1V0Z" fill="currentColor"></path>
                                                </svg>
                                            </span>
                                            <span class="text-black corner bottom">
                                                <svg width="101" height="101" viewBox="0 0 101 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M101 0H0V101H1C1 45.7715 45.7715 1 101 1V0Z" fill="currentColor"></path>
                                                </svg>
                                            </span>
                                        </span>
                                    <?php endif; ?>
                                    <!-- Post Thumbnail -->
                                    <?php if (has_post_thumbnail()) : ?>
                                        <?php
                                        the_post_thumbnail('large', [
                                            'class' => 'rounded-xl md:rounded-2xl h-[360px] w-full object-cover bg-white/10',
                                            'alt'   => get_the_title(),
                                        ]);
                                        ?>
                                    <?php else : ?>
                                        <img alt="<?php the_title_attribute(); ?>" loading="lazy" width="742" height="500" class="rounded-xl md:rounded-2xl h-[360px] w-full object-cover bg-white/10" src="<?php echo esc_url(get_template_directory_uri() . '/images/fallback.jpg'); ?>">
                                    <?php endif; ?>
                                </div>
                                <div class="mt-6 text-white text-center">
                                    <!-- Post Date -->
                                    <span class="text-sm flex gap-2 items-center mb-3 uppercase justify-center">
                                        <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M12.6663 2.66677H11.333V2.0001C11.333 1.82329 11.2628 1.65372 11.1377 1.5287C11.0127 1.40367 10.8432 1.33344 10.6663 1.33344C10.4895 1.33344 10.32 1.40367 10.1949 1.5287C10.0699 1.65372 9.99967 1.82329 9.99967 2.0001V2.66677H5.99967V2.0001C5.99967 1.82329 5.92944 1.65372 5.80441 1.5287C5.67939 1.40367 5.50982 1.33344 5.33301 1.33344C5.1562 1.33344 4.98663 1.40367 4.8616 1.5287C4.73658 1.65372 4.66634 1.82329 4.66634 2.0001V2.66677H3.33301C2.80257 2.66677 2.29387 2.87748 1.91879 3.25255C1.54372 3.62763 1.33301 4.13633 1.33301 4.66677V12.6668C1.33301 13.1972 1.54372 13.7059 1.91879 14.081C2.29387 14.4561 2.80257 14.6668 3.33301 14.6668H12.6663C13.1968 14.6668 13.7055 14.4561 14.0806 14.081C14.4556 13.7059 14.6663 12.6668V4.66677C14.6663 4.13633 14.4556 3.62763 14.0806 3.25255C13.7055 2.87748 13.1968 2.66677 12.6663 2.66677ZM13.333 12.6668C13.333 12.8436 13.2628 13.0131 13.1377 13.1382C13.0127 13.2632 12.8432 13.3334 12.6663 13.3334H3.33301C3.1562 13.3334 2.98663 13.2632 2.8616 13.1382C2.73658 13.0131 2.66634 12.8436 2.66634 12.6668V8.0001H13.333V12.6668ZM13.333 6.66677H2.66634V4.66677C2.66634 4.48996 2.73658 4.32039 2.8616 4.19536C2.98663 4.07034 3.1562 4.0001 3.33301 4.0001H4.66634V4.66677C4.66634 4.84358 4.73658 5.01315 4.8616 5.13817C4.98663 5.2632 5.1562 5.33343 5.33301 5.33343C5.50982 5.33343 5.67939 5.2632 5.80441 5.13817C5.92944 5.01315 5.99967 4.84358 5.99967 4.66677V4.0001H9.99967V4.66677C9.99967 4.84358 10.0699 5.01315 10.1949 5.13817C10.32 5.2632 10.4895 5.33343 10.6663 5.33343C10.8432 5.33343 11.0127 5.2632 11.1377 5.13817C11.2628 5.01315 11.333 4.84358 11.333 4.66677V4.0001H12.6663C12.8432 4.0001 13.0127 4.07034 13.1377 4.19536C13.2628 4.32039 13.333 4.48996 13.333 4.66677V6.66677Z" fill="currentColor"></path>
                                        </svg>
                                        <?php echo get_the_date('M j, Y'); ?>
                                    </span>
                                    <!-- Post Title -->
                                    <h3 class="text-2xl text-white leading-relaxed">
                                        <a class="link-stretched line-link-el text-white" href="<?php the_permalink(); ?>">
                                            <?php the_title(); ?>
                                        </a>
                                    </h3>
                                    <!-- Post Meta -->
                                    <ul class="flex flex-wrap items-center gap-3 gap-y-1 uppercase text-sm my-6 text-white/75 justify-center">
                                        <li class="flex items-center">
                                            <?php
                                            $author_id = get_the_author_meta('ID');
                                            $author_avatar = get_avatar_url($author_id, ['size' => 24]);
                                            $author_name = get_the_author_meta('first_name') ?: get_the_author();
                                            ?>
                                            <img alt="Author of the post - <?php echo esc_attr($author_name); ?>" loading="lazy" width="24" height="24" class="h-6 w-6 border border-[#ABABAB] rounded-full mr-2 bg-white/5" src="<?php echo esc_url($author_avatar); ?>">
                                            <?php echo esc_html($author_name); ?>
                                        </li>
                                        <li>•</li>
                                        <li><?php echo esc_html(reading_time()); ?></li>
                                    </ul>
                                    <!-- Arrow Icon -->
                                    <a class="inline-block text-[#90A096] group-hover:text-white group-hover:rotate-45 transition duration-300 mt-4" aria-label="Read More about <?php the_title_attribute(); ?>" href="<?php the_permalink(); ?>">
                                        <svg width="16" height="16" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M1.99902 18.0009L18 1.99991M18 1.99991H3.59912M18 1.99991V16.4008" stroke="white" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                        </svg>
                                    </a>
                                </div>
                            </article>
                        </div>
                        <?php $counter++; ?>
                    <?php endwhile; ?>
                    <?php wp_reset_postdata(); ?>
                <?php else : ?>
                    <div class="col-12">
                        <p class="text-center text-white">No popular posts found.</p>
                    </div>
                <?php endif; ?>
                <!-- Mobile "All Posts" Button -->
                <div class="col-12 block md:hidden mt-16">
                    <a class="button button-lg button-light group animate-top-right w-fit mx-auto" href="<?php echo esc_url(get_post_type_archive_link('post')); ?>">
                        <span class="relative overflow-hidden transition-none [&>span]:block">
                            <span class="group-hover:-translate-y-[200%] group-hover:scale-y-[2] group-hover:rotate-12">All Posts</span>
                            <span class="absolute left-0 top-0 scale-y-[2] rotate-12 translate-y-[200%] group-hover:translate-y-0 group-hover:scale-y-100 group-hover:rotate-0">All Posts</span>
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
</section>