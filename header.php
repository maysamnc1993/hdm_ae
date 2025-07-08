<!DOCTYPE html>
<html <?php language_attributes(); ?> dir="ltr">

<head>
<script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());
    </script>
     <!--Google Tag Manager -->
    <!-- <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
    new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
    j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
    'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
    })(window,document,'script','dataLayer','GTM-WLQ4DP8');</script> -->
     <!--End Google Tag Manager -->
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php wp_head(); ?>
</head>

<body <?php body_class('bg-gray-50'); ?>>
        <!--Google Tag Manager (noscript) -->
        <!-- <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-WLQ4DP8"
    height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript> -->
     <!--End Google Tag Manager (noscript) -->
    <?php wp_body_open(); ?>

<header>

    <div class="container">

        <div class="flex flex-row">
            <div class="w-2/12"><a href="https://hdmarketing.ae" class="logo"><img src="<?=wp_get_attachment_image_url(115,'full')?>"></a></div>
            <div class="w-8/12"><?=wp_nav_menu(array("menu" => 7 , "menu_class" => "mainMenu"))?></div>
            <div class="w-2/12">
                <a href="#reqeust_section" class="CTA_Default">
                    <div class="box_1"></div>
                    <div class="box_2"></div>
                    <span style="background-image:url('.wp_get_attachment_image_url(127,'full').')">
                        
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 256 256" style="user-select: none; width: 100%; height: 100%; display: inline-block; fill: var(--token-a85af9cb-7834-4006-a277-2dd1295ae376, rgb(255, 255, 255)); color: var(--token-a85af9cb-7834-4006-a277-2dd1295ae376, rgb(255, 255, 255)); flex-shrink: 0;" focusable="false" color="var(--token-a85af9cb-7834-4006-a277-2dd1295ae376, rgb(255, 255, 255))"><g color="var(--token-a85af9cb-7834-4006-a277-2dd1295ae376, rgb(255, 255, 255))" weight="regular"><path d="M200,64V168a8,8,0,0,1-16,0V83.31L69.66,197.66a8,8,0,0,1-11.32-11.32L172.69,72H88a8,8,0,0,1,0-16H192A8,8,0,0,1,200,64Z"></path></g></svg>
                        <b>Request Now</b>
                    </span>
                </a>
            </div>
        </div>

    </div>

</header>