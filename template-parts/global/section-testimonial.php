
<?php
/**
 * Component: Testimonial
 * Description: Displays client testimonials with images and quotes in a marquee layout.
 *
 * @param array $args {
 *     @type array $testimonial ACF field data for testimonials.
 * }
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

// Safely extract testimonial data from $args, defaulting to an empty array
$testimonial = $args['testimonial'] ?? [];

// Check if required data is present and valid
if (empty($testimonial) || !is_array($testimonial)) {
    return; // Exit early if no data
}

$title = $testimonial['title'] ?? '';
$description = $testimonial['description'] ?? '';
$testimonial_list = $testimonial['testimonial_list'] ?? [];

// Exit early if no testimonial items
if (empty($testimonial_list) || !is_array($testimonial_list)) {
    return;
}
?>

<section class="section-cm testimonial-component">
    <div class="container">
        <?php if (!empty($title)) : ?>
            <h2><?php echo esc_html($title); ?></h2>
        <?php endif; ?>
        <?php if (!empty($description)) : ?>
            <p class="section-cm-desc"><?php echo $description; ?></p>
        <?php endif; ?>

        <div class="cm-wrap">
            <div class="marquee__group">
                <?php foreach ($testimonial_list as $item) :
                    $image = $item['image'] ?? '';
                    $full_name = $item['full_name'] ?? '';
                    $message = $item['message'] ?? '';
                    $job_position = $item['job_position'] ?? '';
                    // Skip if critical fields are empty
                    if (empty($full_name) || empty($message)) {
                        continue;
                    }
                ?>
                    <div class="cm-item">
                        <div class="d-flex">
                            <?php if (!empty($image)) : ?>
                                <img src="<?php echo esc_url($image); ?>" alt="">
                            <?php endif; ?>
                            <strong><?php echo esc_html($full_name); ?></strong>
                            <div>
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                            </div>
                        </div>
                        <p><?php echo $message; ?></p>
                        <?php if (!empty($job_position)) : ?>
                            <span><?php echo esc_html($job_position); ?></span>
                        <?php endif; ?>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>

        <div class="cm-wrap marquee--reverse mt-4">
            <div class="marquee__group">
                <?php foreach ($testimonial_list as $item) :
                    $image = $item['image'] ?? '';
                    $full_name = $item['full_name'] ?? '';
                    $message = $item['message'] ?? '';
                    $job_position = $item['job_position'] ?? '';
                    if (empty($full_name) || empty($message)) {
                        continue;
                    }
                ?>
                    <div class="cm-item">
                        <div class="d-flex">
                            <?php if (!empty($image)) : ?>
                                <img src="<?php echo esc_url($image); ?>" alt="">
                            <?php endif; ?>
                            <strong><?php echo esc_html($full_name); ?></strong>
                            <div>
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                            </div>
                        </div>
                        <p><?php echo $message; ?></p>
                        <?php if (!empty($job_position)) : ?>
                            <span><?php echo esc_html($job_position); ?></span>
                        <?php endif; ?>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</section>
