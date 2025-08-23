<?php

/**
 * Component: Additional Ad Services
 * Description: Displays a grid of ad service items with dynamic step numbers and progress dots.
 *
 * @param array $args {
 *     @type array $ad_services ACF field data for ad service items.
 * }
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

// Safely extract ad_services data from $args
$lists_item = $args['lists_item'] ?? [];

?>


<div class="SectionListsItem">

    <div class="container">

        <div class="title_box">

            <h2 class="title"><?=$lists_item["title"]?></h2>
            <p class="description"><?=wp_strip_all_tags($lists_item["description"])?></p>
        </div>
        <div class="Lists_item">

            <?php
                foreach($lists_item["list"] as $item){

                    echo '
                        <div class="item">
                            <img src="'.$item['image']['url'].'">
                            <h3>'.$item['title'].'</h3>
                            <p>'.$item['description'].'</p>
                        </div>
                    ';

                }
            ?>
        </div>

        

    </div>

</div>