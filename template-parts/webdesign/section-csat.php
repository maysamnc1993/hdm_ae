<?php
/**
 * Template Part: CSAT Section
 * Description: Displays customer satisfaction metrics with animated numbers.
 *
 * @param array $args {
 *     @type array $csat ACF field data for CSAT metrics.
 * }
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

$book_request = $args['book_request'] ?? [];
var_dump($book_request);
?>

 <section class="section-date" id="reqeust_section">
        <div class="container">
            <h2><?=$book_request['title']?></h2>
            <div class="date__wrap">
            
                <?=do_shortcode('[custom_calendar]')?>
            </div>
        </div>
    </section>
