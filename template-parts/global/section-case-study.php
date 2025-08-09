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

<section class="caseStudy slama-2 <?=$top_case_study["class"]?>">

    <div class="container">

        <div class="box_of_data">

            <div class="box_of_image">
                <img src="<?= $top_case_study["image"]["url"] ?? "" ?>">
                <div class="shadow_box"></div>
            </div>
            <div class="data">
                <?php if($top_case_study["count"] == ""){}else{?>
                    <i class="countUp" data-number="<?= $top_case_study["count"] ?? "" ?>">0</i>
                <?php } ?>
                <h2><?= $top_case_study["title"] ?? "" ?></h2>
                <span class="title"><?= $top_case_study["text"] ?? "" ?></span>
                <?php
                    if($top_case_study["link_text"] == ""){}else{
                        ?>

                            <a href="<?= $$top_case_study["link_anchor"] ?>" class="CTA_Default">
                                <div class="box_1"></div>
                                <div class="box_2"></div>
                                <span style=<?php echo "background-image:url('" . wp_get_attachment_image_url(127, 'full') . "')" ?>>

                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 256 256" style="user-select: none; width: 100%; height: 100%; display: inline-block; fill: var(--token-a85af9cb-7834-4006-a277-2dd1295ae376, rgb(255, 255, 255)); color: var(--token-a85af9cb-7834-4006-a277-2dd1295ae376, rgb(255, 255, 255)); flex-shrink: 0;" focusable="false" color="var(--token-a85af9cb-7834-4006-a277-2dd1295ae376, rgb(255, 255, 255))">
                                        <g color="var(--token-a85af9cb-7834-4006-a277-2dd1295ae376, rgb(255, 255, 255))" weight="regular">
                                            <path d="M200,64V168a8,8,0,0,1-16,0V83.31L69.66,197.66a8,8,0,0,1-11.32-11.32L172.69,72H88a8,8,0,0,1,0-16H192A8,8,0,0,1,200,64Z"></path>
                                        </g>
                                    </svg>
                                    <b><?= $top_case_study["link_text"] ?></b>
                                </span>
                            </a>

                        <?php
                    }
                ?>

            </div>

        </div>

    </div>

</section>