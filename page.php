<?php
/**
 * The template for displaying all pages
 *
 * @package JThem
 */

get_header();
?>

<main id="primary" class="site-main container mx-auto px-4 py-8">

    <?php
    while ( have_posts() ) :
        the_post();
        ?>
        
        <article id="post-<?php the_ID(); ?>" <?php post_class('bg-white rounded-lg shadow-md p-6 mb-8'); ?>>
            <header class="entry-header mb-6">
                <h1 class="entry-title text-3xl font-bold"><?php the_title(); ?></h1>
            </header>

            <div class="entry-content prose max-w-none">
                <?php the_content(); ?>
            </div>
        </article>

    <?php endwhile; ?>

</main>

<?php
get_footer(); 