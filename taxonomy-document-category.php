<?php
/**
 * Template Name: Document Category Archive
 */
get_header();
?>

<div class="documents-archive">
    <h1><?php single_term_title(); ?></h1>

    <?php if (have_posts()) : ?>
        <div class="document-list">
            <?php while (have_posts()) : the_post(); ?>
                <article id="post-<?php the_ID(); ?>" <?php post_class('document-item'); ?>>
                    <h2><?php the_title(); ?></h2>
                    <?php if (has_excerpt()) : ?>
                        <div class="document-excerpt">
                            <?php the_excerpt(); ?>
                        </div>
                    <?php endif; ?>

                    <?php
                    // Get the first attached file
                    $attachments = get_posts([
                        'post_type' => 'attachment',
                        'posts_per_page' => 1,
                        'post_parent' => get_the_ID(),
                        'post_status' => 'inherit',
                    ]);
                    if ($attachments) :
                        $attachment = $attachments[0];
                        $file_url = wp_get_attachment_url($attachment->ID);
                        $file_type = wp_check_filetype($file_url);
                        ?>
                        <p>
                            <a href="<?php echo esc_url($file_url); ?>" class="document-download" download>
                                Download <?php echo esc_html($file_type['ext']); ?>
                            </a>
                        </p>
                    <?php endif; ?>
                </article>
            <?php endwhile; ?>
        </div>

        <!-- Pagination -->
        <div class="pagination">
            <?php
            the_posts_pagination([
                'prev_text' => __('Previous', 'your-theme-textdomain'),
                'next_text' => __('Next', 'your-theme-textdomain'),
            ]);
            ?>
        </div>
    <?php else : ?>
        <p><?php _e('No documents found in this category.', 'your-theme-textdomain'); ?></p>
    <?php endif; ?>
</div>

<?php get_footer(); ?>