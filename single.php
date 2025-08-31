<?php

/**
 * The template for displaying single posts
 *
 * @package JThem
 */

get_header();
theme_scripts('single-blog');
theme_part('global/banner');

// Ensure post data is set up
global $post;
setup_postdata($post);

// Get Table of Contents data
$toc_data = generate_post_toc();
$toc_html = $toc_data['toc'];
$modified_content = $toc_data['content'];

// Get post data using WordPress core and theme helper functions
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
    <div class="relma-main__inner">
        <div class="main-row">
            <div class="main-row__col article-header">
                <div class="article-share">
                    <ul>
                        <li class="facebook">
                            <a href="https://www.facebook.com/sharer.php?u=<?php echo esc_url(get_permalink()); ?>" title="Facebook" target="_blank">
                                <svg xmlns="http://www.w3.org/2000/svg" width="1.2em" height="1.2em" viewBox="0 0 24 24">
                                    <path fill="currentColor" d="M12.001 2c-5.523 0-10 4.477-10 10c0 4.991 3.657 9.128 8.438 9.878v-6.987h-2.54V12h2.54V9.797c0-2.506 1.492-3.89 3.777-3.89c1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.243 0-1.63.771-1.63 1.562V12h2.773l-.443 2.89h-2.33v6.988C18.344 21.129 22 16.992 22 12c0-5.523-4.477-10-10-10"></path>
                                </svg>
                            </a>
                        </li>
                        <li class="twitter">
                            <a href="https://twitter.com/share?text=<?php echo urlencode(get_the_title()); ?>&amp;url=<?php echo esc_url(get_permalink()); ?>" title="Twitter" target="_blank">
                                <svg xmlns="http://www.w3.org/2000/svg" width="1.2em" height="1.2em" viewBox="0 0 24 24">
                                    <path fill="currentColor" d="M10.488 14.651L15.25 21h7l-7.858-10.478L20.93 3h-2.65l-5.117 5.886L8.75 3h-7l7.51 10.015L2.32 21h2.65zM16.25 19L5.75 5h2l10.5 14z"></path>
                                </svg>
                            </a>
                        </li>
                        <li class="mail">
                            <a href="mailto:?subject=<?php echo urlencode(get_the_title()); ?>&amp;body=<?php echo esc_url(get_permalink()); ?>&nbsp;<?php echo urlencode(get_the_title()); ?>" title="Mail">
                                <svg xmlns="http://www.w3.org/2000/svg" width="1.2em" height="1.2em" viewBox="0 0 24 24">
                                    <path fill="currentColor" fill-rule="evenodd" d="M3.172 5.172C2 6.343 2 8.229 2 12s0 5.657 1.172 6.828S6.229 20 10 20h4c3.771 0 5.657 0 6.828-1.172S22 15.771 22 12s0-5.657-1.172-6.828S17.771 4 14 4h-4C6.229 4 4.343 4 3.172 5.172M18.576 7.52a.75.75 0 0 1-.096 1.056l-2.196 1.83c-.887.74-1.605 1.338-2.24 1.746c-.66.425-1.303.693-2.044.693s-1.384-.269-2.045-.693c-.634-.408-1.352-1.007-2.239-1.745L5.52 8.577a.75.75 0 0 1 .96-1.153l2.16 1.799c.933.777 1.58 1.315 2.128 1.667c.529.34.888.455 1.233.455s.704-.114 1.233-.455c.547-.352 1.195-.89 2.128-1.667l2.159-1.8a.75.75 0 0 1 1.056.097" clip-rule="evenodd"></path>
                                </svg>
                            </a>
                        </li>
                        <li class="clipboard">
                            <span role="button" data-share-copy="" data-url="<?php echo esc_url(get_permalink()); ?>" title="Copy URL" aria-label="Copy URL" onclick="navigator.clipboard.writeText(event.currentTarget.getAttribute('data-url'))">
                                <svg xmlns="http://www.w3.org/2000/svg" width="1.2em" height="1.2em" viewBox="0 0 24 24">
                                    <path fill="currentColor" fill-rule="evenodd" d="M8 2.25A6.75 6.75 0 0 0 2.969 13.5a.75.75 0 0 0 1.118-1A5.25 5.25 0 0 1 8 3.75h4a5.25 5.25 0 1 1 0 10.5h-2a.75.75 0 0 0 0 1.5h2a6.75 6.75 0 0 0 0-13.5z" clip-rule="evenodd"></path>
                                    <path fill="currentColor" d="M6.75 15c0-2.9 2.35-5.25 5.25-5.25h2a.75.75 0 0 0 0-1.5h-2a6.75 6.75 0 0 0 0 13.5h4a6.75 6.75 0 0 0 5.031-11.25a.75.75 0 0 0-1.118 1A5.25 5.25 0 0 1 16 20.25h-4A5.25 5.25 0 0 1 6.75 15" opacity="0.5"></path>
                                </svg>
                            </span>
                        </li>
                    </ul>
                </div>
                <div class="article-heading">
                    <div class="article-meta">
                        <?php if ($article_tags) : ?>
                            <span class="article-tag">In <a href="<?php echo esc_url(get_tag_link($article_tags[0]->term_id)); ?>" class="text-primary"><?php echo esc_html($article_tags[0]->name); ?></a></span>
                        <?php endif; ?>
                        <span class="article-author">By <a href="<?php echo esc_url($author_url); ?>" class="text-primary"><?php echo esc_html($article_author); ?></a></span>
                        <span class="article-read-time"><?php echo esc_html($reading_time); ?></span>
                    </div>
                    <h1 class="article-title"><?php the_title(); ?></h1>
                    <div class="article-meta">
                        <?php echo $article_date; ?>
                    </div>
                </div>
                <?php if ($article_image) : ?>
                    <div class="article-thumb kg-width-full">
                        <img class="article-thumb__image kg-image" src="<?php echo esc_url($article_image); ?>" alt="<?php echo esc_attr($article_image_alt); ?>">
                        <?php if ($article_image_caption) : ?>
                            <figcaption><?php echo wp_kses_post($article_image_caption); ?></figcaption>
                        <?php endif; ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>
        <div class="main-row has-sidebar">
            <aside class="main-row__col sidebar widget-area">
                <?php if ($toc_html) : ?>
                    <div class="toc widget">
                        <div class="widget-header">
                            <h2 class="widget-header__title">Table of Contents</h2>
                        </div>
                        <div class="widget-content">
                            <?php echo wp_kses_post($toc_html); ?>
                        </div>
                    </div>
                <?php endif; ?>
            </aside>
            <article class="main-row__col main article-content">
                <?php echo wp_kses_post($modified_content); ?>
                <section class="kg-comments" id="comments" data-comments="">

                </section>
            </article>
        </div>
        <?php if ($related_posts->have_posts()) : ?>
            <div class="main-row">
                <div class="main-row__col artile-footer">
                    <div class="list-posts widget style-grid3 posts-related">
                        <div class="widget-header">
                            <h2 class="widget-header__title">Related Posts</h2>
                        </div>
                        <div class="widget-content">
                            <div class="items">
                                <?php while ($related_posts->have_posts()) : $related_posts->the_post();
                                    $related_post_id = get_the_ID();
                                    $related_image = theme_get_featured_image_url($related_post_id, 'medium');
                                    $related_image_alt = get_post_meta(get_post_thumbnail_id($related_post_id), '_wp_attachment_image_alt', true) ?: get_the_title();
                                    $related_date = get_the_date('F j, Y', $related_post_id);
                                    $related_datetime = get_the_date('c', $related_post_id);
                                    $related_tags = get_the_tags();
                                    $related_author = get_the_author_meta('display_name');
                                    $related_author_url = get_author_posts_url(get_the_author_meta('ID'));
                                    $is_featured = has_term('featured', 'post_tag', $related_post_id);
                                ?>
                                    <article class="item post tag-living<?php echo $is_featured ? ' featured' : ''; ?>">
                                        <div class="post-thumb">
                                            <a href="<?php echo esc_url(get_permalink()); ?>">

                                                <img class="post-thumb__image" src="<?php echo esc_url($related_image); ?>" alt="<?php echo esc_attr($related_image_alt); ?>">
                                            </a>
                                        </div>
                                        <div class="post-content">
                                            <div class="post-meta">
                                                <?php if ($is_featured) : ?>
                                                    <span class="post-featured">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24">
                                                            <path fill="none" stroke="currentColor" stroke-width="1.5" d="m5.67 9.914l3.062-4.143c1.979-2.678 2.969-4.017 3.892-3.734s.923 1.925.923 5.21v.31c0 1.185 0 1.777.379 2.148l.02.02c.387.363 1.003.363 2.236.363c2.22 0 3.329 0 3.704.673l.018.034c.354.683-.289 1.553-1.574 3.29l-3.062 4.144c-1.98 2.678-2.969 4.017-3.892 3.734s-.923-1.925-.923-5.21v-.31c0-1.185 0-1.777-.379-2.148l-.02-.02c-.387-.363-1.003-.363-2.236-.363c-2.22 0-3.329 0-3.703-.673l-.019-.034c-.354-.683.289-1.552 1.574-3.29Z"></path>
                                                        </svg> Featured
                                                    </span>
                                                <?php endif; ?>
                                                <?php echo $related_date; ?>
                                            </div>
                                            <h3 class="post-title"><a href="<?php echo esc_url(get_permalink()); ?>"><?php the_title(); ?></a></h3>
                                            <div class="post-meta">
                                                <?php if ($related_tags) : ?>
                                                    <span class="post-tag">In <a href="<?php echo esc_url(get_tag_link($related_tags[0]->term_id)); ?>" class="text-primary"><?php echo esc_html($related_tags[0]->name); ?></a></span>
                                                <?php endif; ?>
                                                <span class="post-author">By <a href="<?php echo esc_url($related_author_url); ?>" class="text-primary"><?php echo esc_html($related_author); ?></a></span>
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