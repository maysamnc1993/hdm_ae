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
$feature_benefit = $args['feature_benefit'] ?? [];

?>


<div class="FeaturesBox">

    <div class="container">

        <div class="Box_of_sticky">
            <h2 class="Default_Title"><?=$feature_benefit["title"]?></h2>
            <p><?=$feature_benefit["description"]?></p>
        </div>

        <div class="features_items">

        <?php
            foreach($feature_benefit["list"] as $item){
            
                echo '
                  <div class="feature_item">
                    <div class="thumb" style="background-image: url('.$item["image"]["url"].');"></div>
                    <h3>'.$item["title"].'</h3>
                    <p>'.$item["description"].'</p>
                </div>
                ';

            }
        ?>
        </div>

    </div>

</div>