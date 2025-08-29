<?php

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

$customer = $args['customer'] ?? [];
?>

<section class="Customer_list">
    <div class="container">

        <div class="TextBox">
            <h2><?php echo wp_strip_all_tags($customer["description"]);?></h2>
        </div>

        <div class="OurCustomers">
            <div class="TXT">Our Customers</div>
            <div class="logo-scroller" data-speed="140">
                <ul class="Customer_Gallery">

                <?php
                    foreach($customer["gallery"] as $item){
                        echo '<li><img src="'.$item["url"].'"></li>';
                    }
                ?>

                </ul>
            </div>
        </div>

    </div>
</section>