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

<section class="section-1">
<div class="box_of_circle_effect">
        <div class="circle_effect_1"></div>
    </div>
    <div class="text-area">
        <h1 class="Default_Title">
            <?=$hero["title"]?>
        </h1>
        <p class="description"><?php echo wp_strip_all_tags($hero["description"])?></p>
        <ul class="ListOfCTA flex justify-center gap-4">
                    <?php
                    render_cta_button($hero["hero_cta_text"],127,$hero["hero_cta_link"]);
                    render_cta_button($hero["hero_cta_text_2"],127,$hero["hero_cta_link_2"]);
                    ?>
                </ul>
    </div>
  <div class="hero-wrap">
    <svg class="video-mask" viewBox="0 0 1920 1080" preserveAspectRatio="xMidYMid slice" aria-hidden="true">
      <defs>
        <mask id="hdm-mask" maskUnits="userSpaceOnUse">
          <rect width="100%" height="100%" fill="black"></rect>
          <text id="mask-text"
                x="50%" y="50%"
                text-anchor="middle"
                dominant-baseline="middle"
                font-family="Poppins, Montserrat, Arial, sans-serif"
                font-weight="900"
                font-size="420"
                letter-spacing="8"
                fill="white">HDM</text>
          <!-- این مستطیل با opacity از 0→1 کل ویدیو را نمایان می‌کند -->
          <rect id="mask-fullrect" width="100%" height="100%" fill="white" opacity="0"></rect>
        </mask>
      </defs>

      <!-- ویدیو (آدرس ویدیو را اینجا بگذار) -->
      <foreignObject width="100%" height="100%" mask="url(#hdm-mask)">
        <video id="home-hero-video" autoplay muted loop playsinline
               style="width:100%; height:100%; object-fit:cover;"
               src="<?=$hero["video"]["url"]?>"></video>
      </foreignObject>
    </svg>
  </div>
</section>

<section class="section-2">
  <!-- هر محتوایی قبل از ویدیو فول‌عرض -->
  <div class="content pre">...</div>

  <!-- جایگاه داک‌شدن ویدیو در سکشن ۲ -->
  <div class="video-dock" id="video-dock"></div>

</section>

