<?php

/**
 * Template Part: Creative Section
 * Description: Displays the hero section with text, CTAs, and video dashboard.
 *
 * @param array $args {
 *     @type array $section_1    ACF field data for section 1.
 *     @type array $video_section ACF field data for video section.
 * }
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

$section_1 = $args['section_1'] ?? [];
$video_section = $args['video_section'] ?? [];
?>

<div class="section-creative">

    <div class="container">

        <div class="box_of_circle_effect">
            <div class="circle_effect_1"></div>
            <!-- <div class="circle_effect_2"></div> -->
        </div>

        <div class="box_of_text">
            <div class="content_section">

                <span class="slogan"><?= $section_1['small_title'] ?></span>
                <h1><?= $section_1['title'] ?></h1>
                <p><?= $section_1['description'] ?></p>
                <ul class="ListOfCTA">
                    <?php
                    foreach ($section_1["cta"] as $item) {
                        echo '
                                   <li>
                                    <a href="' . $item["link"] . '" class="CTA_Default">
                                        <div class="box_1"></div>
                                        <div class="box_2"></div>
                                        <span style="background-image:url(' . wp_get_attachment_image_url(127, 'full') . ')">
                                            
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 256 256" style="user-select: none; width: 100%; height: 100%; display: inline-block; fill: var(--token-a85af9cb-7834-4006-a277-2dd1295ae376, rgb(255, 255, 255)); color: var(--token-a85af9cb-7834-4006-a277-2dd1295ae376, rgb(255, 255, 255)); flex-shrink: 0;" focusable="false" color="var(--token-a85af9cb-7834-4006-a277-2dd1295ae376, rgb(255, 255, 255))"><g color="var(--token-a85af9cb-7834-4006-a277-2dd1295ae376, rgb(255, 255, 255))" weight="regular"><path d="M200,64V168a8,8,0,0,1-16,0V83.31L69.66,197.66a8,8,0,0,1-11.32-11.32L172.69,72H88a8,8,0,0,1,0-16H192A8,8,0,0,1,200,64Z"></path></g></svg>
                                            <b>' . $item["title"] . '</b>
                                        </span>
                                    </a>
                                </li>
                                ';
                    }
                    ?>
                </ul>
            </div>
        </div>

        <div class="dashboard">
            <div class="dash-img">
                <img src="<?= $video_section["video_cover"] ?>" alt="">
                <video loop muted playsinline src="<?= $video_section["video_file"] ?>" controls playsinline>
                    <source src="<?= $video_section["video_file"] ?>" type="video/mp4">
                </video>
            </div>
        </div>

    </div>

</div>