
<?php
/**
 * Template Part: FAQ Section
 * Description: Displays frequently asked questions with accordion functionality.
 */

// Ensure this file is not accessed directly.
if (!defined('ABSPATH')) {
    exit;
}

// Safely extract the FAQ data from $args, defaulting to an empty array.
$faq_data = $args['faq'] ?? [];

// Check if the required data is present and not empty.
if (empty($faq_data) || !is_array($faq_data)) {

    return; // Exit early if no data to display.
}

$faq_title       = $faq_data['title'] ?? '';
$faq_description = $faq_data['description'] ?? '';
$faq_image_url   = $faq_data['image'] ?? '';
$faq_list        = $faq_data['faq_list'] ?? [];

// Exit early if there are no FAQ items to display.
if (empty($faq_list) || !is_array($faq_list)) {
    return;
}
?>

<section class="py-16 sec-faq">
    <div class="container mx-auto px-4">
        <div class="flex flex-col lg:flex-row items-center gap-8 aic">

            <!-- FAQ Text and Image Column -->
            <div class="w-full lg:w-1/2">
                <?php if (!empty($faq_title)) : ?>
                    <h2><?php echo $faq_title; ?></h2>
                <?php endif; ?>

                <?php if (!empty($faq_description)) : ?>
                    <p class="sec-faq-desc"><?php echo $faq_description; ?></p>
                <?php endif; ?>

                <?php if (!empty($faq_image_url)) : ?>
                    <img src="<?php echo esc_url($faq_image_url); ?>" alt="<?php echo esc_attr($faq_title); ?>">
                <?php endif; ?>
            </div>
            <!-- End FAQ Text and Image Column -->

            <!-- FAQ Items Column -->
            <div class="w-full lg:w-1/2">
                <div class="faqs__items">
                    <?php foreach ($faq_list as $faq_item) :
                        // Extract individual FAQ item data with defaults
                        $question = $faq_item['question'] ?? '';
                        $answer   = $faq_item['answer'] ?? '';

                        // Skip item if question is empty
                        if (empty($question)) {
                            continue;
                        }
                    ?>
                        <div class="faq__item">
                            <div class="faq__item__head">
                                <?php echo $question; ?>
                                <i></i> <!-- Icon for accordion toggle -->
                            </div>
                            <div class="faq__item__body">
                                <?php
                                // Use wp_kses_post for basic HTML support in answers,
                                // or esc_html if you only want plain text.
                                echo wp_kses_post($answer);
                                ?>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
            <!-- End FAQ Items Column -->

        </div>
    </div>
</section>
