<?php
/**
 * Template Part: Book Request Section
 * Description: Displays a call-to-action for booking a request.
 *
 * @param array $args {
 *     @type array $book_request ACF field data for book request.
 * }
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

$book_request = $args['book_request'] ?? [];
?>

<section class="BookRequest w-full flex items-center justify-center py-20 bg-brand-primary">
    <div class="container max-w-7xl mx-auto px-4">
        <div class="content_section flex flex-col items-center justify-center">
            <h2 class="text-white text-4xl font-bold uppercase"><?php echo esc_html($book_request['title'] ?? ''); ?></h2>
            <p class="text-white text-base font-light leading-loose mt-5 text-center"><?php echo esc_html($book_request['description'] ?? ''); ?></p>
            <a href="<?php echo esc_url($book_request['link'] ?? '#'); ?>" class="mt-5 bg-white text-brand-primary font-bold py-3 px-6 rounded-full">Book Now</a>
        </div>
    </div>
</section>