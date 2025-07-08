<?php

// Template Name: PPC Page

theme_scripts('ppc');
get_header();
?>

<div class="section-creative" >

    <div class="container">

        <div class="box_of_circle_effect">
            <div class="circle_effect_1"></div>
            <!-- <div class="circle_effect_2"></div> -->
        </div>

        <div class="Video_effect">
            <video src="http://localhost/HDM-AE/wp-content/uploads/2025/07/Cw9D8nOGuMDx0eVn02OhggPWXg1.mp4" autoplay muted loop playsinline></video>
        </div>

        <div class="box_Of_text">

            <div class="content_section">
                <h1>Get Seen. Get Clicked. Get <span><i>Customers</i><b>Customers</b></span></h1>
                <p>Our PPC advertising puts your brand in front of high-intent customers. actively searching for your products or services. From Google to Meta and beyond, we build and optimize campaigns that convert, delivering real, measurable growth from every click.</p>        
                <ul class="ListOfCTA">
                                <li>
                                    <a href="#" class="CTA_Default">
                                        <div class="box_1"></div>
                                        <div class="box_2"></div>
                                        <span style="background-image:url(<?=wp_get_attachment_image_url(127,'full')?>)">
                                            
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 256 256" style="user-select: none; width: 100%; height: 100%; display: inline-block; fill: var(--token-a85af9cb-7834-4006-a277-2dd1295ae376, rgb(255, 255, 255)); color: var(--token-a85af9cb-7834-4006-a277-2dd1295ae376, rgb(255, 255, 255)); flex-shrink: 0;" focusable="false" color="var(--token-a85af9cb-7834-4006-a277-2dd1295ae376, rgb(255, 255, 255))"><g color="var(--token-a85af9cb-7834-4006-a277-2dd1295ae376, rgb(255, 255, 255))" weight="regular"><path d="M200,64V168a8,8,0,0,1-16,0V83.31L69.66,197.66a8,8,0,0,1-11.32-11.32L172.69,72H88a8,8,0,0,1,0-16H192A8,8,0,0,1,200,64Z"></path></g></svg>
                                            <b>Request a Quote</b>
                                        </span>
                                    </a>
                                </li>
                        <?php
                            foreach($section_1["cta"] as $item){
                                echo '
                                   <li>
                                    <a href="'.$item["link"].'" class="CTA_Default">
                                        <div class="box_1"></div>
                                        <div class="box_2"></div>
                                        <span style="background-image:url('.wp_get_attachment_image_url(127,'full').')">
                                            
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 256 256" style="user-select: none; width: 100%; height: 100%; display: inline-block; fill: var(--token-a85af9cb-7834-4006-a277-2dd1295ae376, rgb(255, 255, 255)); color: var(--token-a85af9cb-7834-4006-a277-2dd1295ae376, rgb(255, 255, 255)); flex-shrink: 0;" focusable="false" color="var(--token-a85af9cb-7834-4006-a277-2dd1295ae376, rgb(255, 255, 255))"><g color="var(--token-a85af9cb-7834-4006-a277-2dd1295ae376, rgb(255, 255, 255))" weight="regular"><path d="M200,64V168a8,8,0,0,1-16,0V83.31L69.66,197.66a8,8,0,0,1-11.32-11.32L172.69,72H88a8,8,0,0,1,0-16H192A8,8,0,0,1,200,64Z"></path></g></svg>
                                            <b>'.$item["title"].'</b>
                                        </span>
                                    </a>
                                </li>
                                ';
                            }
                        ?>
                    </ul>
            </div>

        </div>
        

    </div>

</div>

<div class="ValuesDetails">
    <div class="container">
            <div class="title_box">
                <h2 class="title">Turns Clicks Into Customers</br> with PPC Advertising</h2>
                <p class="description">Convert visitors into real customers and boost your ROI with high-performance PPC advertising.</p>
            </div>
        <div class="flex flex-row">
            
            <div class="w-4/12">
                <div class="value_item">
                    <div class="thumb" style="background-image:url(http://localhost/HDM-AE/wp-content/uploads/2025/07/001_prev_ui.png)"></div>
                    <h3>Drive Targeted Traffic</h3>
                    <p> Reach people actively searching for your products or services.</p>
                </div>
            </div>
            <div class="w-4/12">
                <div class="value_item">
                    <div class="thumb" style="background-image:url(http://localhost/HDM-AE/wp-content/uploads/2025/07/002_prev_ui.png)"></div>
                    <h3>Maximize Conversion</h3>
                    <p> It’s not just about traffic; it’s about converting visitors into real customers.</p>
                </div>
            </div>
            <div class="w-4/12">
                <div class="value_item">
                    <div class="thumb" style="background-image:url(http://localhost/HDM-AE/wp-content/uploads/2025/07/003_prev_ui.png)"></div>
                    <h3>Achieve Better ROI</h3>
                    <p>PPC delivers fast results, and you only pay for the clicks that matter.</p>
                </div>
            </div>
        
    </div>
</div>

<?php
get_footer();
?>