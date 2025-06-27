<!DOCTYPE html>
<html <?php language_attributes(); ?> dir="ltr">

<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php wp_head(); ?>
</head>

<body <?php body_class('bg-gray-50'); ?>>
    <?php wp_body_open(); ?>

<header>

    <div class="container">

        <div class="flex flex-row">
            <div class="w-2/12"><a href="<?=get_bloginfo('url')?>" class="logo"><img src="<?=wp_get_attachment_image_url(115,'full')?>"></a></div>
            <div class="w-8/12"><?=wp_nav_menu(array("menu" => 7 , "menu_class" => "mainMenu"))?></div>
            <div class="w-2/12">
                <a href="'.$item["link"].'" class="CTA_Default">
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