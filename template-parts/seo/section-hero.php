<?php

/**
 * Template Part: Creative Section
 * Description: Displays the hero section with text, CTAs, and Instagram images with GSAP slide-out animation.
 *
 * @param array $args {
 *     @type array $section_1    ACF field data for section 1.
 * }
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

$hero = $args['hero'] ?? [];
// Function to render CTA button
function render_cta_button($text, $image_id = 127, $link = '#')
{
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

<section class="section-creative">
    <div class="container mx-auto px-4">
        <div class="box_of_circle_effect relative">
            <div class="circle_effect_1"></div>
        </div>

        

        <div class="box_of_text">
            <div class="content_section">
                <h1 class="text-4xl md:text-6xl lg:text-8xl font-black text-white uppercase text-center mb-4 Default_Title SeoTitle">
                    <?=$hero["title"]?>
                </h1>
                <div class="text-base text-white font-light text-center leading-relaxed mb-8 SEO_Description"><?php echo $hero['description']; ?></div>


        

                <ul class="ListOfCTA flex justify-center gap-4">
                    <?php
                    render_cta_button('Contact Us');
                    render_cta_button('Work With Us');
                    render_cta_button('Contact Us');
                    render_cta_button('Work With Us');
                    ?>
                </ul>
            </div>
        </div>



        <div class="flex my-25 justify-center image-container">
            <?php
            $images = [
                ['path' => $hero["image_1"], 'class' => 'instagram-img image-left'],
                ['path' => $hero["image_2"], 'class' => 'instagram-img image-center'],
                ['path' => $hero["image_3"], 'class' => 'instagram-img image-right']
            ];
            foreach ($images as $index => $image) {
            ?>
                    <div class="<?php echo esc_attr($image['class']); ?>">
                        <img src="<?php echo  $image['path']; ?>" alt="<?php echo esc_attr($index + 1); ?>" loading="lazy">
                    </div>
            <?php
               
            }
            ?>
        </div>
    </div>
</section>

<script>

</script>