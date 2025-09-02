<?php

/**
 * The template for displaying single blog posts.
 *
 * This template displays a single post with its content, metadata, comments, and related posts.
 * It integrates with Tailwind CSS for styling and uses existing theme functions.
 *
 * @package JThem
 */

get_header();
theme_scripts('single-blog');
theme_part('global/banner');

// Set up post datagrid
global $post;
setup_postdata($post);

// Get Table of Contents data
$toc_data = generate_post_toc();
$toc_html = $toc_data['toc'];
$modified_content = $toc_data['content'];

// Get post metadata
$article_image = theme_get_featured_image_url($post->ID, 'full');
$article_image_alt = get_post_meta(get_post_thumbnail_id($post->ID), '_wp_attachment_image_alt', true) ?: get_the_title();
$article_image_caption = wp_get_attachment_caption(get_post_thumbnail_id($post->ID));
$article_date = get_the_date('F j, Y');
$article_datetime = get_the_date('c');
$article_tags = get_the_tags();
$article_author = get_the_author_meta('display_name');
$author_url = get_author_posts_url(get_the_author_meta('ID'));
$reading_time = reading_time();
$related_posts = theme_get_related_posts($post->ID, 3, ['post_tag']);
?>

<main class="relma-main my-32">
    <div class="relma-main__inner max-w-[1240px] mx-auto px-5">
        <!-- Article Header -->
        <div class="main-row__col article-header pt-10 border-t border-brand-muted">
            <!-- Social Share Links -->
            <div class="article-share">
                <ul class="inline-grid gap-5 lg:flex flex-col">
                    <li class="facebook">
                        <a href="https://www.facebook.com/sharer.php?u=<?php echo esc_url(get_permalink()); ?>" title="Share on Facebook" target="_blank" class="text-brand-primary hover:text-brand-accent">
                            <svg xmlns="http://www.w3.org/2000/svg" width="1.2em" height="1.2em" viewBox="0 0 24 24">
                                <path fill="currentColor" d="M12.001 2c-5.523 0-10 4.477-10 10c0 4.991 3.657 9.128 8.438 9.878v-6.987h-2.54V12h2.54V9.797c0-2.506 1.492-3.89 3.777-3.89c1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.243 0-1.63.771-1.63 1.562V12h2.773l-.443 2.89h-2.33v6.988C18.344 21.129 22 16.992 22 12c0-5.523-4.477-10-10-10"></path>
                            </svg>
                        </a>
                    </li>
                    <li class="twitter">
                        <a href="https://twitter.com/share?text=<?php echo urlencode(get_the_title()); ?>&amp;url=<?php echo esc_url(get_permalink()); ?>" title="Share on Twitter" target="_blank" class="text-brand-primary hover:text-brand-accent">
                            <svg xmlns="http://www.w3.org/2000/svg" width="1.2em" height="1.2em" viewBox="0 0 24 24">
                                <path fill="currentColor" d="M10.488 14.651L15.25 21h7l-7.858-10.478L20.93 3h-2.65l-5.117 5.886L8.75 3h-7l7.51 10.015L2.32 21h2.65zM16.25 19L5.75 5h2l10.5 14z"></path>
                            </svg>
                        </a>
                    </li>
                    <li class="mail">
                        <a href="mailto:?subject=<?php echo urlencode(get_the_title()); ?>&amp;body=<?php echo esc_url(get_permalink()); ?>&nbsp;<?php echo urlencode(get_the_title()); ?>" title="Share via Email" class="text-brand-primary hover:text-brand-accent">
                            <svg xmlns="http://www.w3.org/2000/svg" width="1.2em" height="1.2em" viewBox="0 0 24 24">
                                <path fill="currentColor" fill-rule="evenodd" d="M3.172 5.172C2 6.343 2 8.229 2 12s0 5.657 1.172 6.828S6.229 20 10 20h4c3.771 0 5.657 0 6.828-1.172S22 15.771 22 12s0-5.657-1.172-6.828S17.771 4 14 4h-4C6.229 4 4.343 4 3.172 5.172M18.576 7.52a.75.75 0 0 1-.096 1.056l-2.196 1.83c-.887.74-1.605 1.338-2.24 1.746c-.66.425-1.303.693-2.044.693s-1.384-.269-2.045-.693c-.634-.408-1.352-1.007-2.239-1.745L5.52 8.577a.75.75 0 0 1 .96-1.153l2.16 1.799c.933.777 1.58 1.315 2.128 1.667c.529.34.888.455 1.233.455s.704-.114 1.233-.455c.547-.352 1.195-.89 2.128-1.667l2.159-1.8a.75.75 0 0 1 1.056.097" clip-rule="evenodd"></path>
                            </svg>
                        </a>
                    </li>
                    <li class="clipboard">
                        <span role="button" data-share-copy="" data-url="<?php echo esc_url(get_permalink()); ?>" title="Copy URL" aria-label="Copy URL" onclick="navigator.clipboard.writeText(event.currentTarget.getAttribute('data-url'))" class="text-brand-primary hover:text-brand-accent">
                            <svg xmlns="http://www.w3.org/2000/svg" width="1.2em" height="1.2em" viewBox="0 0 24 24">
                                <path fill="currentColor" fill-rule="evenodd" d="M8 2.25A6.75 6.75 0 0 0 2.969 13.5a.75.75 0 0 0 1.118-1A5.25 5.25 0 0 1 8 3.75h4a5.25 5.25 0 1 1 0 10.5h-2a.75.75 0 0 0 0 1.5h2a6.75 6.75 0 0 0 0-13.5z" clip-rule="evenodd"></path>
                                <path fill="currentColor" d="M6.75 15c0-2.9 2.35-5.25 5.25-5.25h2a.75.75 0 0 0 0-1.5h-2a6.75 6.75 0 0 0 0 13.5h4a6.75 6.75 0 0 0 5.031-11.25a.75.75 0 0 0-1.118 1A5.25 5.25 0 0 1 16 20.25h-4A5.25 5.25 0 0 1 6.75 15" opacity="0.5"></path>
                            </svg>
                        </span>
                    </li>
                </ul>
            </div>
            <!-- Article Metadata and Title -->
            <div class="article-heading">
                <div class="article-meta flex flex-wrap items-center gap-4 text-sm text-neutral-gray-100">
                    <?php if ($article_tags) : ?>
                        <span class="article-tag">In <a href="<?php echo esc_url(get_tag_link($article_tags[0]->term_id)); ?>" class="text-brand-primary hover:text-brand-accent"><?php echo esc_html($article_tags[0]->name); ?></a></span>
                    <?php endif; ?>
                    <span class="article-author">By <a href="<?php echo esc_url($author_url); ?>" class="text-brand-primary hover:text-brand-accent"><?php echo esc_html($article_author); ?></a></span>
                    <span class="article-read-time"><?php echo esc_html($reading_time); ?></span>
                </div>
                <h1 class="article-title text-2xl font-bold lg:text-3xl leading-tight "><?php the_title(); ?></h1>
                <div class="article-meta flex flex-wrap items-center gap-4 text-sm text-neutral-gray-100 mt-2">
                    <time datetime="<?php echo esc_attr($article_datetime); ?>"><?php echo esc_html($article_date); ?></time>
                </div>
            </div>
            <!-- Featured Image -->
            <?php if ($article_image) : ?>
                <div class="article-thumb kg-width-full col-span-1 lg:col-span-5">
                    <img class="article-thumb__image kg-image rounded-[35px] w-full h-[500px] object-cover" src="<?php echo esc_url($article_image); ?>" alt="<?php echo esc_attr($article_image_alt); ?>">
                    <?php if ($article_image_caption) : ?>
                        <figcaption class="text-neutral-gray-100 text-sm mt-2 text-center"><?php echo wp_kses_post($article_image_caption); ?></figcaption>
                    <?php endif; ?>
                </div>
            <?php endif; ?>
        </div>
        <!-- Main Content with Sidebar -->
        <div class="main-row has-sidebar flex flex-wrap justify-between items-start mt-10 gap-10">
            <!-- Sidebar with Table of Contents -->
            <aside class="main-row__col sidebar widget-area w-full lg:w-[calc(28%-50px)] lg:sticky lg:top-2.5">
                <?php if ($toc_html) : ?>
                    <div class="toc widget border-r border-brand-muted pr-4">
                        <div class="widget-header mb-6">
                            <h2 class="widget-header__title text-4xl font-light">Table of Contents</h2>
                        </div>
                        <div class="widget-content"><?php echo wp_kses_post($toc_html); ?></div>
                    </div>
                <?php endif; ?>
            </aside>
            <!-- Article Content and Comments -->
            <article class="main-row__col main article-content w-full lg:w-[72%] leading-loose">
                <div class="content prose max-w-none"><?php echo wp_kses_post($modified_content); ?></div>
                <section class="kg-comments mt-10" id="comments">
                    <?php if (comments_open() || get_comments_number()) : ?>
                        <?php comments_template(); ?>
                    <?php else : ?>
                        <p class="no-comments text-neutral-gray-100">Comments are closed.</p>
                    <?php endif; ?>
                </section>
            </article>
        </div>
        <!-- Related Posts -->
        <?php if ($related_posts->have_posts()) : ?>
            <div class="main-row mt-10">
                <div class="main-row__col artile-footer pt-10 border-t border-brand-muted">
                    <div class="list-posts widget style-grid3 posts-related">
                        <div class="widget-header mb-6">
                            <h2 class="widget-header__title text-4xl font-light">Related Posts</h2>
                        </div>
                        <div class="widget-content">
                            <div class="items grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-5">
                                <?php while ($related_posts->have_posts()) : $related_posts->the_post();
                                    $related_post_id = get_the_ID();
                                    $related_image = theme_get_featured_image_url($related_post_id, 'medium');
                                    $related_image_alt = get_post_meta(get_post_thumbnail_id($related_post_id), '_wp_attachment_image_alt', true) ?: get_the_title();
                                    $related_date = get_the_date('F j, Y', $related_post_id);
                                    $related_tags = get_the_tags();
                                    $related_author = get_the_author_meta('display_name');
                                    $related_author_url = get_author_posts_url(get_the_author_meta('ID'));
                                    $is_featured = has_term('featured', 'post_tag', $related_post_id);
                                ?>
                                    <article class="item post tag-living<?php echo $is_featured ? ' featured' : ''; ?> grid grid-cols-[auto_1fr] gap-5 items-center">
                                        <div class="post-thumb w-[150px] h-[150px] rounded-[25px] overflow-hidden">
                                            <a href="<?php echo esc_url(get_permalink()); ?>">
                                                <img class="post-thumb__image w-full h-full object-cover hover:scale-110 transition-transform duration-400" src="<?php echo esc_url($related_image); ?>" alt="<?php echo esc_attr($related_image_alt); ?>">
                                            </a>
                                        </div>
                                        <div class="post-content">
                                            <div class="post-meta flex flex-wrap items-center gap-4 text-sm text-neutral-gray-100">
                                                <?php if ($is_featured) : ?>
                                                    <span class="post-featured flex items-center gap-1 text-brand-primary">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24">
                                                            <path fill="none" stroke="currentColor" stroke-width="1.5" d="m5.67 9.914l3.062-4.143c1.979-2.678 2.969-4.017 3.892-3.734s.923 1.925.923 5.21v.31c0 1.185 0 1.777.379 2.148l.02.02c.387.363 1.003.363 2.236.363c2.22 0 3.329 0 3.704.673l.018.034c.354.683-.289 1.553-1.574 3.29l-3.062 4.144c-1.98 2.678-2.969 4.017-3.892 3.734s-.923-1.925-.923-5.21v-.31c0-1.185 0-1.777-.379-2.148l-.02-.02c-.387-.363-1.003-.363-2.236-.363c-2.22 0-3.329 0-3.703-.673l-.019-.034c-.354-.683.289-1.552 1.574-3.29Z"></path>
                                                        </svg> Featured
                                                    </span>
                                                <?php endif; ?>
                                                <time datetime="<?php echo esc_attr(get_the_date('c', $related_post_id)); ?>"><?php echo esc_html($related_date); ?></time>
                                            </div>
                                            <h3 class="post-title text-lg font-medium mt-2"><a href="<?php echo esc_url(get_permalink()); ?>" class="bg-[length:0_1px] bg-no-repeat bg-[position:left_90%] bg-gradient-to-r from-current to-current hover:bg-[length:100%_1px] transition-[background-size] duration-300"><?php the_title(); ?></a></h3>
                                            <div class="post-meta flex flex-wrap items-center gap-4 text-sm text-neutral-gray-100 mt-2">
                                                <?php if ($related_tags) : ?>
                                                    <span class="post-tag">In <a href="<?php echo esc_url(get_tag_link($related_tags[0]->term_id)); ?>" class="text-brand-primary hover:text-brand-accent"><?php echo esc_html($related_tags[0]->name); ?></a></span>
                                                <?php endif; ?>
                                                <span class="post-author">By <a href="<?php echo esc_url($related_author_url); ?>" class="text-brand-primary hover:text-brand-accent"><?php echo esc_html($related_author); ?></a></span>
                                            </div>
                                        </div>
                                    </article>
                                <?php endwhile;
                                wp_reset_postdata(); ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php endif; ?>
    </div>
</main>

<?php
wp_reset_postdata();
get_footer();
?>