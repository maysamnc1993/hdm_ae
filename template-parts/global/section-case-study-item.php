
<?php
/**
 * Template Part: Case Study Items Section
 * Description: Displays a list of case study items.
 *
 */

// Ensure this file is not accessed directly.
if (!defined('ABSPATH')) {
    exit;
}

// Safely extract the case_study data from $args, defaulting to an empty array.
$case_study_data = $args['case_study'] ?? [];

// Check if the required data is present and not empty.
if (empty($case_study_data) || !is_array($case_study_data)) {
    // Optionally log an error or handle the case where data is missing.
    // error_log('Case Study data is missing or invalid in template part.');
    return; // Exit early if no data to display.
}

$case_study_list = $case_study_data['case_study_list'] ?? [];
$sub_title       = $case_study_data['sub_title'] ?? '';
$title           = $case_study_data['title'] ?? '';

// Exit early if there are no items to display.
if (empty($case_study_list) || !is_array($case_study_list)) {
    return;
}
?>

<section class="caseStudyItem salam1">
    <div class="container">
        <div class="box_of_caseStudy">

            <!-- Section Header -->
            <div class="titleBox">
                <?php if (!empty($sub_title)) : ?>
                    <span class="badge"><?php echo esc_html($sub_title); ?></span>
                <?php endif; ?>
                <?php if (!empty($title)) : ?>
                    <h2 class="title"><?php echo esc_html($title); ?></h2>
                <?php endif; ?>
            </div>
            <!-- End Section Header -->

            <!-- Case Study Items List -->
            <?php foreach ($case_study_list as $index => $item) : ?>
                <?php
                // Increment index for display (1-based)
                $display_index = $index + 1;
                $item_sub_title = $item['sub_title'] ?? '';
                $item_title     = $item['title'] ?? '';
                $item_description = $item['description'] ?? '';
                ?>
                <div class="CaseStudyItem c_<?php echo esc_attr($display_index); ?>">

                    <div class="Number">
                        <i><?php echo esc_html($display_index); ?></i>
                        <b>Case Study</b>
                    </div>

                    <div class="text">
                        <?php if (!empty($item_sub_title)) : ?>
                            <span class="subtitle"><?php echo esc_html($item_sub_title); ?></span>
                        <?php endif; ?>

                        <?php if (!empty($item_title)) : ?>
                            <h2 class="title"><?php echo esc_html($item_title); ?></h2>
                        <?php endif; ?>

                        <div class="Problem">
                            <?php if (!empty($item_description)) : ?>
                                <p><?php echo esc_html($item_description); ?></p>
                            <?php endif; ?>
                        </div>

                       
                        <a href="#">Read More</a> <!-- Placeholder link -->

                    </div>

                </div>
            <?php endforeach; ?>
            <!-- End Case Study Items List -->

        </div>
    </div>
</section>
