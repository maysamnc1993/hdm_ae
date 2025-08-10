<?php

/**
 * Template Part: Featured Post Section
 * 
 * Displays the featured post section for the blog page, including dynamic post data
 * and Tailwind CSS styling. Uses WordPress query to fetch the featured post.
 *
 */
// Query the featured post (assuming a meta field or category for 'featured')
$args = array(
    'post_type'      => 'post',
    'posts_per_page' => 1,
    'meta_key'       => '_is_featured', 
    'meta_value'     => '1',
    'post_status'    => 'publish',
);
$featured_query = new WP_Query($args);

if ($featured_query->have_posts()) :
    while ($featured_query->have_posts()) : $featured_query->the_post();
?>

        <section class="container my-36">
            <div class="row my-6 sm:my-10">
                <!-- Featured Post Column -->
                <div class="lg:col-7">
                    <article class="postBg transition-all duration-500 opacity-100 post-card group relative has-line-link-white rounded-2xl rounded-tr-none text-center px-4 sm:px-8 md:px-12 py-10 sm:py-16 mt-[52px] sm:mt-8">
                        <!-- Decorative SVG and Background -->
                        <div class="absolute -top-[31px] right-0 flex">
                            <svg class="text-brand-primary relative -right-px" width="86" height="32" viewBox="0 0 86 32" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M85.3511 32H0C8.17473 32 15.7118 28.9386 19.7164 23.9923L32.6592 8.00769C36.6639 3.06146 44.2025 0 52.3758 0H85.3511V32Z" fill="currentColor"></path>
                            </svg>
                            <div class="h-8 bg-brand-primary w-32 sm:w-52 rounded-tr-2xl"></div>
                        </div>
                        <!-- Featured Post Label -->
                        <h2 class="text-sm uppercase font-brand-primary pl-7 pr-3 py-1 after:absolute after:rounded-full after:content-[''] after:h-2 after:w-2 after:bg-primary after:left-3 after:top-[10px] text-white absolute bg-white/15 -top-4 right-4 rounded-full">
                            Featured Post
                        </h2>
                        <!-- Post Meta and Content -->
                        <div class="mt-6 text-white">
                            <span class="text-sm flex gap-2 items-center justify-center mb-3 uppercase">
                                <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M12.6663 2.66677H11.333V2.0001C11.333 1.82329 11.2628 1.65372 11.1377 1.5287C11.0127 1.40367 10.8432 1.33344 10.6663 1.33344C10.4895 1.33344 10.32 1.40367 10.1949 1.5287C10.0699 1.65372 9.99967 1.82329 9.99967 2.0001V2.66677H5.99967V2.0001C5.99967 1.82329 5.92944 1.65372 5.80441 1.5287C5.67939 1.40367 5.50982 1.33344 5.33301 1.33344C5.1562 1.33344 4.98663 1.40367 4.8616 1.5287C4.73658 1.65372 4.66634 1.82329 4.66634 2.0001V2.66677H3.33301C2.80257 2.66677 2.29387 2.87748 1.91879 3.25255C1.54372 3.62763 1.33301 4.13633 1.33301 4.66677V12.6668C1.33301 13.1972 1.54372 13.7059 1.91879 14.081C2.29387 14.4561 2.80257 14.6668 3.33301 14.6668H12.6663C13.1968 14.6668 13.7055 14.4561 14.0806 14.081C14.4556 13.7059 14.6663 13.1972 14.6663 12.6668V4.66677C14.6663 4.13633 14.4556 3.62763 14.0806 3.25255C13.7055 2.87748 13.1968 2.66677 12.6663 2.66677ZM13.333 12.6668C13.333 12.8436 13.2628 13.0131 13.1377 13.1382C13.0127 13.2632 12.8432 13.3334 12.6663 13.3334H3.33301C3.1562 13.3334 2.98663 13.2632 2.8616 13.1382C2.73658 13.0131 2.66634 12.8436 2.66634 12.6668V8.0001H13.333V12.6668ZM13.333 6.66677H2.66634V4.66677C2.66634 4.48996 2.73658 4.32039 2.8616 4.19536C2.98663 4.07034 3.1562 4.0001 3.33301 4.0001H4.66634V4.66677C4.66634 4.84358 4.73658 5.01315 4.8616 5.13817C4.98663 5.2632 5.1562 5.33343 5.33301 5.33343C5.50982 5.33343 5.67939 5.2632 5.80441 5.13817C5.92944 5.01315 5.99967 4.84358 5.99967 4.66677V4.0001H9.99967V4.66677C9.99967 4.84358 10.0699 5.01315 10.1949 5.13817C10.32 5.2632 10.4895 5.33343 10.6663 5.33343C10.8432 5.33343 11.0127 5.2632 11.1377 5.13817C11.2628 5.01315 11.333 4.84358 11.333 4.66677V4.0001H12.6663C12.8432 4.0001 13.0127 4.07034 13.1377 4.19536C13.2628 4.32039 13.333 4.48996 13.333 4.66677V6.66677Z" fill="currentColor"></path>
                                </svg>
                                <?php echo get_the_date('F j, Y'); ?>
                            </span>
                            <h3 class="text-3xl sm:text-4xl text-white !leading-normal line-clamp-3">
                                <a class="link-stretched line-link-el text-white" aria-label="<?php the_title_attribute(); ?>" href="<?php the_permalink(); ?>">
                                    <?php the_title(); ?>
                                </a>
                            </h3>
                            <ul class="flex flex-wrap items-center justify-center gap-3 gap-y-1 uppercase text-sm mt-6 mb-4">
                                <li class="flex items-center">
                                    <?php
                                    // Get author data
                                    $author_id = get_the_author_meta('ID');
                                    $author_avatar = get_avatar_url($author_id, array('size' => 24));
                                    ?>
                                    <img alt="Author of the post - <?php the_author(); ?>" loading="lazy" width="24" height="24" class="h-6 w-6 border border-[#ABABAB] rounded-full mr-2" src="<?php echo esc_url($author_avatar); ?>">
                                    <?php the_author(); ?>
                                </li>
                                <li>•</li>
                                <li><?php echo esc_html(reading_time()); ?></li>
                            </ul>
                            <span class="h-12 sm:h-14 w-12 sm:w-14 m-auto flex items-center justify-center text-white sm:text-[#90A096] group-hover:text-white group-hover:bg-white/10 bg-white/30 sm:bg-transparent rounded-full transition-all duration-300 p-[17px] sm:p-0 group-hover:rotate-45">
                                <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M1.99902 18.0009L18 1.99991M18 1.99991H3.59912M18 1.99991V16.4008" stroke="white" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                </svg>
                            </span>
                        </div>
                    </article>
                </div>
                <!-- Category and Menu Column (Visible on Large Screens) -->
                <div class="lg:col-5 relative hidden lg:block">
                    <div class="post-card post-category-top relative">
                        <div class="post-category bg-neutral-dark z-10">
                            <div class="flex items-center justify-end relative z-20">
                                <button class="flex items-center gap-3 uppercase text-white bg-black rounded-full py-[14px] px-5 cursor-pointer focus:outline-none active:outline-none active:border-none hover:bg-white hover:text-black group has-transition border-none font-medium menu-btn" type="button" aria-label="Toggle Navigation Menu">
                                    <span class="w-5 cursor-pointer [&amp;&gt;span]:h-[2px] [&amp;&gt;span]:block [&amp;&gt;span]:bg-white group-hover:[&amp;&gt;span]:bg-black [&amp;&gt;span]:rounded [&amp;&gt;span]:has-transition ">
                                        <span class="w-1/2 mb-1 "></span>
                                        <span class="w-full mb-1 "></span>
                                        <span class="w-1/2 ml-auto "></span>
                                    </span>
                                    Menu
                                </button>
                            </div>
                            <div class="text-light corner left">
                                <svg width="101" height="101" viewBox="0 0 101 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M101 0H0V101H1C1 45.7715 45.7715 1 101 1V0Z" fill="#00081F"></path>
                                </svg>
                            </div>
                            <span class="text-light corner bottom">
                                <svg width="101" height="101" viewBox="0 0 101 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M101 0H0V101H1C1 45.7715 45.7715 1 101 1V0Z" fill="#00081F"></path>
                                </svg>
                            </span>
                        </div>
                    </div>
                    <div class="post-card post-category-bottom relative h-full transition-all duration-500 opacity-100">
                        <div class="absolute w-full h-full">
                            <span class="post-category text-dark bg-neutral-dark z-10">
                                <a class="border-border transition duration-300 hover:bg-white text-white hover:text-primary-brand" href="<?php echo esc_url(get_category_link(get_the_category()[0]->term_id)); ?>">
                                    <?php echo esc_html(get_the_category()[0]->name); ?>
                                </a>
                                <span class="text-light corner left">
                                    <svg width="101" height="101" viewBox="0 0 101 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" clip-rule="evenodd" d="M101 0H0V101H1C1 45.7715 45.7715 1 101 1V0Z" fill="#00081F"></path>
                                    </svg>
                                </span>
                                <span class="text-light corner bottom">
                                    <svg width="101" height="101" viewBox="0 0 101 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" clip-rule="evenodd" d="M101 0H0V101H1C1 45.7715 45.7715 1 101 1V0Z" fill="#00081F"></path>
                                    </svg>
                                </span>
                            </span>
                            <?php
                            // Display featured image with custom classes
                            if (has_post_thumbnail()) {
                                the_post_thumbnail('full', array(
                                    'class' => 'rounded-xl md:rounded-2xl w-full max-h-full max-w-none object-cover h-full bg-white/40',
                                    'alt'   => get_the_title(),
                                ));
                            } else {
                                // Fallback image if no thumbnail
                                echo '<img src="' . get_template_directory_uri() . '/images/fallback.jpg" class="rounded-xl md:rounded-2xl w-full max-h-full max-w-none object-cover h-full bg-white/40" alt="Fallback Image">';
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </section>

<?php
    endwhile;
    wp_reset_postdata();

endif;
