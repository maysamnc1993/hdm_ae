<?php
/**
 * Template Part: Float Image Section
 * Description: Displays a floating Dribbble image with animation.
 *
 * @param array $args {
 *     @type array $dribbble ACF field data for Dribbble image.
 * }
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

$dribbble = $args['dribbble'] ?? [];
?>

  <section class="section-floatimg">
        <div class="floatimg-wrap">
            <img src="<?=$dribbble["logo"]?>" alt="">
            <p><?=$dribbble["description"]?></p>
            <a href="<?=$dribbble["view_profile_link"]?>">View Portfolio</a>
        </div>

        <?php
            $i =0;
            foreach($dribbble["dribbble_image"] as $item){
                $i++;
                echo '<img src="'.$item["image"].'" class="dribImg img'.$i.'" alt="">';
            }
        ?>
       
    </section>
