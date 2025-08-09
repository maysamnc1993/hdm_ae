<?php

/**
 * Template Part: SEO Hero Section
 * Description: Displays the hero section for the SEO page with text, CTAs, and images from ACF fields.
 *
 * @param array $args {
 *     @type array $hero ACF field data for the hero section.
 * }
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

// Initialize data, preferring $args if provided, otherwise fall back to get_field
$hero = $args['hero'] ?? [
    'title' => get_field('seo_hero_title', get_the_ID()) ?: 'Mastering SEO Success',
    'description' => get_field('seo_hero_description', get_the_ID()) ?: 'Boost your online presence with proven SEO strategies to rank higher and attract more traffic.',
    'image_1' => ($image = get_field('seo_hero_image_1', get_the_ID())) ? $image['url'] : '',
    'image_2' => ($image = get_field('seo_hero_image_2', get_the_ID())) ? $image['url'] : '',
    'image_3' => ($image = get_field('seo_hero_image_3', get_the_ID())) ? $image['url'] : '',
    'cta_text_1' => get_field('seo_hero_cta_text_1', get_the_ID()) ?: 'Get Started',
    'cta_link_1' => get_field('seo_hero_cta_link_1', get_the_ID()) ?: '#',
    'cta_text_2' => get_field('seo_hero_cta_text_2', get_the_ID()) ?: 'Learn More',
    'cta_link_2' => get_field('seo_hero_cta_link_2', get_the_ID()) ?: '#',
];

// Check if the section should be displayed (require title and at least one image)
if (empty($hero['title']) || (empty($hero['image_1']) && empty($hero['image_2']) && empty($hero['image_3']))) {
    return; // Exit early if critical fields are empty
}

// Function to render CTA button
function render_cta_button($text, $link, $image_id = 127)
{
    if (empty($text) || empty($link)) {
        return; // Skip if CTA text or link is empty
    }
    $image_url = esc_url(wp_get_attachment_image_url($image_id, 'full'));
?>
    <li>
        <a href="<?php echo esc_url($link); ?>" class="CTA_Default">
            <div class="box_1"></div>
            <div class="box_2"></div>
            <span style="background-image: url('<?php echo $image_url; ?>')">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 256 256" style="user-select: none; width: 100%; height: 100%; display: inline-block; fill: var(--token-a85af9cb-7834-4006-a277-2dd1295ae376, rgb(255, 255, 255)); color: var(--token-a85af9cb-7834-4006-a277-2dd1295ae376, rgb(255, 255, 255)); flex-shrink: 0;" focusable="false" color="var(--token-a85af9cb-7834-4006-a277-2dd1295ae376, rgb(255, 255, 255))">
                    <g color="var(--token-a85af9cb-7834-4006-a277-2dd1295ae376, rgb(255, 255, 255))" weight="regular">
                        <path d="M200,64V168a8,8,0,0,1-16,0V83.31L69.66,197.66a8,8,0,0,1-11.32-11.32L172.69,72H88a8,8,0,0,1,0-16H192A8,8,0,0,1,200,64Z"></path>
                    </g>
                </svg>
                <b class="font-bold"><?php echo esc_html($text); ?></b>
            </span>
        </a>
    </li>
<?php
}
?>

<section class="section-hero">
    <div class="container mx-auto px-4">
        <div class="box_of_circle_effect relative">
            <div class="circle_effect_1"></div>
        </div>

        <div class="box_of_text">
            <div class="content_section">
                <h1 class="text-4xl md:text-6xl lg:text-8xl font-black text-white uppercase text-center mb-4">
                    <?php echo wp_kses_post($hero['title']); ?>
                </h1>
                <p class="text-base text-white font-light text-center leading-relaxed mb-8"><?php echo wp_kses_post($hero['description']); ?></p>
                <ul class="ListOfCTA flex justify-center gap-4">
                    <?php
                    render_cta_button($hero['cta_text_1'], $hero['cta_link_1']);
                    render_cta_button($hero['cta_text_2'], $hero['cta_link_2']);
                    ?>
                </ul>
            </div>
        </div>

        <div class="flex my-25 justify-center image-container">
            <?php
            $images = [
                ['url' => $hero['image_1'], 'class' => 'hero-img image-left', 'alt' => 'SEO Hero image 1'],
                ['url' => $hero['image_2'], 'class' => 'hero-img image-center', 'alt' => 'SEO Hero image 2'],
                ['url' => $hero['image_3'], 'class' => 'hero-img image-right', 'alt' => 'SEO Hero image 3'],
            ];
            foreach ($images as $index => $image) {
                if (!empty($image['url'])) {
            ?>
                    <div class="<?php echo esc_attr($image['class']); ?>">
                        <img src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>" loading="lazy">
                    </div>
            <?php
                }
            }
            ?>
        </div>
    </div>
</section>