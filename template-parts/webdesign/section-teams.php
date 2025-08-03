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

$teams = $args['teams'] ?? [
    'title' => '',
    'description' => '',
    'team_member' => []
];

// اگر هیچ داده‌ای وجود نداشت، قالب را رندر نکنید
if (empty($teams['team_member'])) {
    return;
}
?>

<div class="Teams-Text">
    <div class="container">
        <?php if (!empty($teams['title'])) : ?>
            <h2><?php echo esc_html($teams['title']); ?></h2>
        <?php endif; ?>
        <?php if (!empty($teams['description'])) : ?>
            <p><?php echo esc_html($teams['description']); ?></p>
        <?php endif; ?>
    </div>
</div>
<section class="Teams">
    <div class="container_ring">
        <div id="ring">
            <?php foreach ($teams['team_member'] as $item) : ?>
                <div class="img" style="background-image: url('<?php echo esc_url($item['image']); ?>');">
                    <div class="img-text">
                        <h3><?php echo esc_html($item['full_name']); ?></h3>
                        <p><?php echo esc_html($item['job_position']); ?></p>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
    <!-- <div class="vignette"></div> -->
    <div id="dragger"></div>
</section>