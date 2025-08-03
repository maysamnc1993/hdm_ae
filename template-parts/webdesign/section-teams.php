<?php
/**
 * Template Part: Teams Section
 * Description: Displays team members with images and details.
 *
 * @param array $args {
 *     @type array $teams ACF field data for teams.
 * }
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

$teams = $args['teams'] ?? [];
?>


<div class="Teams-Text">
    <div class="container">
        <h2><?= $teams["title"] ?></h2>
        <p><?= $teams["description"] ?></p>
    </div>
</div>
 <section class="Teams">
      <div class="container_ring">
          <div id="ring">
            <?php
                foreach($teams["team_member"] as $item){
                    echo '
                        <div class="img" style="background-image: url('.$item["image"].');">
                            <div class="img-text">
                                <h3>'.$item["full_name"].'</h3>
                                <p>'.$item["job_position"].'</p>
                            </div>
                        </div>
                    ';
                }
            ?>    
          </div>
        </div>
        <!-- <div class="vignette"></div> -->
        
        <div id="dragger"></div>
  
  </section>