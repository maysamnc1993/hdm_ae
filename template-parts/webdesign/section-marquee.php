<?php

/**
 * Template Part: Marquee Section
 * Description: Displays a scrolling portfolio marquee with images.
 *
 * @param array $args {
 *     @type array $portfolio ACF field data for portfolio items.
 * }
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

$portfolio = $args['portfolio'] ?? [];
?>

<section id="section-marquee">
    <div class="textBox">
        <h1>Our Portfolio</h1>
        <p>Discover a selection of our recent projects that showcase our expertise in design, development, and digital marketing.</p>
    </div>
    <div class="marquee">
        <div class="track">
            <div class="content">
                <?php
                foreach ($portfolio as $item) {
                    echo '
                                <a href="#">
                                    <h2>' . $item["title"] . '</h2>
                                    <img src="' . $item["image"] . '" alt="">
                                </a>
                            ';
                }

                ?>

            </div>
        </div>
    </div>
</section>