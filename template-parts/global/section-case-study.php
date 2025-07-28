<?php

/**
 * Template Part: Top Case Study Section
 * Description: Displays the top case study with image and text.
 *
 * @param array $args {
 *     @type array $top_case_study ACF field data for top case study.
 * }
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

$top_case_study = $args['top_case_study'] ?? [];
?>

<section class="caseStudy slama-2">

    <div class="container">

        <div class="box_of_data">

            <div class="box_of_image">
                <img src="<?= $top_case_study["image"] ?? "" ?>">
                <div class="shadow_box"></div>
            </div>
            <div class="data">

                <i class="countUp" data-number="<?= $top_case_study["count"] ?? "" ?>">0</i>
                <h2><?= $top_case_study["title"] ?? "" ?></h2>
                <span class="title"><?= $top_case_study["text"] ?? "" ?></span>

            </div>

        </div>

    </div>

</section>