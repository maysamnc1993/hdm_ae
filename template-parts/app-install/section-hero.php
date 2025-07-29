<?php
// Updated hero section using ACF fields
$hero_image_1 = get_field('hero_image_1');
$hero_image_2 = get_field('hero_image_2');
$hero_image_3 = get_field('hero_image_3');
$hero_title = get_field('hero_title');
$hero_description = get_field('hero_description');
$hero_cta_text = get_field('hero_cta_text');
$hero_cta_link = get_field('hero_cta_link');
?>

<section class="hero-section">
    <div class="hero-images">
        <?php
        if ($hero_image_1) {
            echo '<img src="' . esc_url($hero_image_1['url']) . '" class="theme-image hero-image-1" alt="' . esc_attr($hero_image_1['alt']) . '">';
        } else {
            display_img("install-app/hero-1.avif", "hero-image-1", "Hero Image 1");
        }
        if ($hero_image_2) {
            echo '<img src="' . esc_url($hero_image_2['url']) . '" class="theme-image hero-image-2" alt="' . esc_attr($hero_image_2['alt']) . '">';
        } else {
            display_img("install-app/hero-2.avif", "hero-image-2", "Hero Image 2");
        }
        if ($hero_image_3) {
            echo '<img src="' . esc_url($hero_image_3['url']) . '" class="theme-image hero-image-3" alt="' . esc_attr($hero_image_3['alt']) . '">';
        } else {
            display_img("install-app/hero-3.avif", "hero-image-3", "Hero Image 3");
        }
        ?>
    </div>
    <div class="hero-content">
        <h1><?php echo esc_html($hero_title ?: 'Unleash Your Potential'); ?></h1>
        <p><?php echo wp_kses_post($hero_description ?: 'Join our innovative platform to explore cutting-edge solutions designed to inspire and empower you.'); ?></p>
        <?php
        if ($hero_cta_text && $hero_cta_link): ?>
            <a href="<?= $hero_cta_link ?>" class="CTA_Default">
                <div class="box_1"></div>
                <div class="box_2"></div>
                <span style=<?php echo "background-image:url('" . wp_get_attachment_image_url(127, 'full') . "')" ?>>

                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 256 256" style="user-select: none; width: 100%; height: 100%; display: inline-block; fill: var(--token-a85af9cb-7834-4006-a277-2dd1295ae376, rgb(255, 255, 255)); color: var(--token-a85af9cb-7834-4006-a277-2dd1295ae376, rgb(255, 255, 255)); flex-shrink: 0;" focusable="false" color="var(--token-a85af9cb-7834-4006-a277-2dd1295ae376, rgb(255, 255, 255))">
                        <g color="var(--token-a85af9cb-7834-4006-a277-2dd1295ae376, rgb(255, 255, 255))" weight="regular">
                            <path d="M200,64V168a8,8,0,0,1-16,0V83.31L69.66,197.66a8,8,0,0,1-11.32-11.32L172.69,72H88a8,8,0,0,1,0-16H192A8,8,0,0,1,200,64Z"></path>
                        </g>
                    </svg>
                    <b><?= $hero_cta_text ?></b>
                </span>
            </a>
        <?php endif ?>

    </div>
</section>