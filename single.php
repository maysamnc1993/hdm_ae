<?php
global $post;
the_post(); // Ensure $post is se
/**
 * The template for displaying single posts
 *
 * @package JThem
 */

get_header();
theme_scripts('single-blog');
theme_part('global/banner');
?>
<main class="container mx-auto px-4 py-8">
    <?php echo theme_breadcrumbs() ?>

    <section class="xl:max-w-full max-w-[1170px] mx-auto md:px-4 sm:px-8 xl:px-0">
        <div class="flex flex-wrap gap-7.5 justify-between">
            <!-- Blog Details Start -->

            <div class="xl:max-w-7/10 lg:max-w-[770px] w-full ">
                <div class="bg-neutral-100 content p-4 md:p-10 rounded-3xl">
                    <?php
                    // Display the featured image
                    if (has_post_thumbnail()) {
                        the_post_thumbnail('full', ['class' => 'w-full mb-10']);
                    } else {
                        echo '<img src="images/default-image.png" alt="default" class="w-full mb-10">'; // Default image if no featured image
                    }
                    ?>

                    <h1 class="m-5 text-2xl text-right">
                        <?php the_title(); ?>
                    </h1>



                    <div class="mt-9">
                        <?php the_content(); // Display the post content 
                        ?>
                    </div>


                    <div class="flex flex-col gap-3 sm:flex-row sm:items-center justify-between py-4">
                        <!-- Post Information -->
                        <div class="flex flex-wrap items-center gap-4">
                            <span class="flex items-center gap-1">
                                <?php svg_icon('profile'); ?>
                                <span class="author-name"><?php echo get_the_author_meta('display_name'); ?></span>
                            </span>
                            <span class="text-custom-sm flex items-center gap-1">
                                <?php svg_icon('calendar'); ?>
                                <?php helepre_post_date(); ?>
                            </span>
                        </div>


                        <!-- Post Engagement -->
                        <div class="flex flex-wrap justify-between md:justify-start items-center gap-4 border-t md:border-t-0 border-dashed border-brand-primary p-5">
                            <!-- Share Icon -->
                            <span class="flex items-center gap-1 cursor-pointer share-post" data-post-id="<?php the_ID(); ?>">
                                <?php svg_icon('share'); ?>
                                <span class="sr-only"><?php _e('اشتراک گذاری', 'helepre'); ?></span>
                            </span>
                            <div class="flex gap-4">
                                <!-- Comments -->
                                <span class="flex items-center gap-1">
                                    <?php svg_icon('message'); ?>
                                    <span class="comment-count"><?php echo get_comments_number(); ?></span>
                                </span>

                                <!-- Likes and Dislikes -->
                                <span class="flex items-center gap-1 cursor-pointer post-reaction" data-post-id="<?php the_ID(); ?>" data-reaction="like">
                                    <?php
                                    $user_id = get_current_user_id();
                                    $user_reaction = $user_id ? get_user_meta($user_id, 'helepre_post_reaction_' . get_the_ID(), true) : '';
                                    $like_active = $user_reaction === 'like' ? ' active' : '';
                                    ?>
                                    <span class="reaction-icon<?php echo $like_active; ?>"><?php svg_icon('like'); ?></span>
                                    <span id="like-count-<?php the_ID(); ?>" class="reaction-count"><?php echo get_post_meta(get_the_ID(), 'like_count', true) ?: 0; ?></span>
                                </span>

                                <span class="flex items-center gap-1 cursor-pointer post-reaction" data-post-id="<?php the_ID(); ?>" data-reaction="dislike">
                                    <?php
                                    $dislike_active = $user_reaction === 'dislike' ? ' active' : '';
                                    ?>
                                    <span class="reaction-icon<?php echo $dislike_active; ?>"><?php svg_icon('dislike'); ?></span>
                                    <span id="dislike-count-<?php the_ID(); ?>" class="reaction-count"><?php echo get_post_meta(get_the_ID(), 'dislike_count', true) ?: 0; ?></span>
                                </span>
                            </div>
                        </div>
                    </div>

                    <!-- Reaction notification area -->
                    <div id="reaction-notification-<?php the_ID(); ?>" class="reaction-notification" aria-live="polite"></div>
                </div>
                <section class=" my-14">
                    <?php
                    // If comments are open or we have at least one comment, load up the comment template.
                    if (comments_open() || get_comments_number()) :
                        comments_template();
                    endif; ?>
                </section>


            </div>

            <!-- Blog Details End -->

            <!-- Blog Sidebar Start -->
            <?php get_sidebar() ?>
            <!-- Blog Sidebar End -->
        </div>
    </section>

    <section class="my-14">
        <h2 class="m-5">مقلات مرتبط</h2>



        <!-- Fetch related posts -->
        <?php
        $related_posts = theme_get_related_posts(get_the_ID(), 3); // Adjust the number of posts as needed

        if ($related_posts->have_posts()) : ?>
            <div class="related-posts grid md:grid-cols-3 gap-14 max-w-9/10 mx-auto">

                <?php while ($related_posts->have_posts()) : $related_posts->the_post(); ?>
                    <a href="<?php the_permalink(); ?>" class="blog-card">
                        <div class="image-container">
                            <?php if (has_post_thumbnail()) : ?>
                                <?php the_post_thumbnail('medium', ['alt' => get_the_title()]); ?>
                            <?php else : ?>
                                <img src="/api/placeholder/400/144" alt="Placeholder image">
                            <?php endif; ?>
                        </div>
                        <div class="content">
                            <h3><?php the_title(); ?></h3>
                            <p><?php echo wp_trim_words(get_the_excerpt(), 20, '...'); ?></p>
                            <div class="footer">
                                <div class="profile">
                                    <?php svg_icon('profile', 'w-5 h-5 mr-1 text-gray-500'); ?>
                                    <span class="text-sm text-gray-500"><?php the_author(); ?></span>
                                </div>
                                <button class="read-more">
                                    <span>ادامه مطلب</span>
                                    <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </a>
                <?php endwhile; ?>
                <?php wp_reset_postdata(); // Reset the global post object 
                ?>
            </div>
        <?php endif; ?>

    </section>



</main>

<?php get_footer(); ?>