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
// // Function to render CTA button
// function render_cta_button($text, $image_id = 127, $link = '#')
// {
//     $image_url = esc_url(wp_get_attachment_image_url($image_id, 'full'));
// ?>
<!-- //     <li>
//         <a href="<?php echo esc_url($link); ?>" class="CTA_Default">
//             <div class="box_1"></div>
//             <div class="box_2"></div>
//             <span style="background-image: url('<?php echo $image_url; ?>')">
//                 <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 256 256" style="user-select: none; width: 100%; height: 100%; display: inline-block; fill: var(--token-a85af9cb-7834-4006-a277-2dd1295ae376, rgb(255, 255, 255)); color: var(--token-a85af9cb-7834-4006-a277-2dd1295ae376, rgb(255, 255, 255)); flex-shrink: 0;" focusable="false" color="var(--token-a85af9cb-7834-4006-a277-2dd1295ae376, rgb(255, 255, 255))">
//                     <g color="var(--token-a85af9cb-7834-4006-a277-2dd1295ae376, rgb(255, 255, 255))" weight="regular">
//                         <path d="M200,64V168a8,8,0,0,1-16,0V83.31L69.66,197.66a8,8,0,0,1-11.32-11.32L172.69,72H88a8,8,0,0,1,0-16H192A8,8,0,0,1,200,64Z"></path>
//                     </g>
//                 </svg>
//                 <b class="font-bold"><?php echo esc_html($text); ?></b>
//             </span>
//         </a>
//     </li> -->
<?php
// }
// ?>
<!-- Section 1: Hero Section -->
<div class="section-hero">
    <div class="text-area">
        <span class="small-title"><?=$hero["small_text"]?></span>
        <h1 class="main-heading">
            <span>
                <i><?=$hero["text"]?></i>
                <b><?=$hero["text"]?></b>
            </span>
            <span class="on-top">
                <i><?=$hero["text_3"]?></i>
                <b><?=$hero["text_3"]?></b>
            </span>
            <br>
            <?=$hero["text_2"]?>
        </h1>
    </div>
</div>

<!-- Section 2: Video Section -->
<div id="home-hero-video" class="lg absolute top-0 right-0 z-[1] h-144 w-230 origin-center bg-black lg:h-[15vw] lg:w-[24vw]">
    <span class="video-caption">
        <span class="title"><?=$hero["vide_caption"]?></span>
        <span class="description">Unlock the full potential of Facebook and Instagram advertising to drive engagement, leads, and sales.</span>
    </span>

    <video class="absolute inset-0 h-full w-full object-cover" autoplay muted loop playsinline title="" aria-label="" data-copyright="" data-source="" __idm_id__="950273">
        <source src="<?=$hero["video"]?>" type="video/mp4">
    </video>
</div>
<div class="scroll-height"></div>