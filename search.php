<?php
get_header();
theme_scripts('category');
?>

<section class="container mx-auto px-4 py-8">
    <main class="container">
        <?php echo theme_breadcrumbs(); ?>

        <div class="flex justify-between items-center mb-8">
            <h1 class="text-3xl font-bold">نتایج جستجو برای: <?php echo get_search_query(); ?></h1>
        </div>

        <div class="flex flex-col md:flex-row gap-8">
            <!-- Main Content - Insurance Cards Grid -->
            <div class="flex flex-col gap-9 w-full">
                <?php if (have_posts()) : ?>
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
                        <?php while (have_posts()) : the_post(); ?>
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
                    </div>

                    <!-- Pagination -->
                    <div class="pagination mt-4 text-center">
                        <?php echo paginate_links([
                            'prev_text' => __('قبلی', 'jtheme'),
                            'next_text' => __('بعدی', 'jtheme'),
                        ]); ?>
                    </div>
                <?php else : ?>
                    <p>هیچ مطلبی برای نمایش وجود ندارد.</p>
                <?php endif; ?>
            </div>

            <!-- Sidebar -->
            <?php get_sidebar(); ?>
        </div>
    </main>
</section>

<?php get_footer(); ?>
