<?php

// Template Name: Web Design

theme_scripts('webdesign');
get_header();

$section_1 = get_field('section_1',get_the_ID());
$video_section = get_field('video_section',get_the_ID());
$portfolio = get_field('portfolio',get_the_ID());
$values = get_field('values',get_the_ID());
$teams = get_field('teams',get_the_ID());
$testimonial = get_field('testimonial',get_the_ID());
$faq = get_field('faq',get_the_ID());
$book_request = get_field('book_request',get_the_ID());
$dribbble = get_field('dribbble',get_the_ID());

?>




<!-- Section 1 -->

<div class="section-creative" >
        <div class="container">
            <div class="creative-wrap">
                <div class="line-light">
                    <img src="<?=wp_get_attachment_image_url(8,'full')?>" alt="">
                </div>
                <div class="content">

                    <div class="line-wrap">
                        <div class="line"></div>
                        <div class="line"></div>
                        <div class="line"></div>
                        <div class="line"></div>
                        <div class="line"></div>
                    </div>

                    <div class="line-wrap">
                        <div class="line"></div>
                        <div class="line"></div>
                        <div class="line"></div>
                        <div class="line"></div>
                        <div class="line"></div>
                    </div>

                    <div class="line-wrap max-content">
                        <div class="line"></div>
                        <div class="line"><?=$section_1['small_title']?></div>
                        <div class="line HDM">
                            <div class="line-dot"></div>
                            <div class="line-dot"></div>
                            <div class="line-dot"></div>
                            <div class="line-dot"></div>
                            <span class="txt"><?=$section_1['title']?></span>
                        </div>
                        <div class="line">
                            <p><?=$section_1['description']?></p>
                        </div>
                        <div class="line">

                        <ul class="ListOfCTA">
                        <?php
                            foreach($section_1["cta"] as $item){
                                echo '
                                   <li>
                                    <a href="'.$item["link"].'" class="CTA_Default">
                                        <div class="box_1"></div>
                                        <div class="box_2"></div>
                                        <span>
                                            
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

                    <div class="line-wrap">
                        <div class="line"></div>
                        <div class="line"></div>
                        <div class="line"></div>
                        <div class="line"></div>
                        <div class="line"></div>
                    </div>

                    <div class="line-wrap">
                        <div class="line"></div>
                        <div class="line"></div>
                        <div class="line"></div>
                        <div class="line"></div>
                        <div class="line"></div>
                    </div>

                    

                </div>

                <div class="dashboard">
                    <div class="dash-img">
                        <img src="<?=$video_section["video_cover"]?>" alt="">
                        <video controls muted playsinline src="<?=$video_section["video_file"]?>" controls playsinline>
                            <source src="<?=$video_section["video_file"]?>" type="video/mp4">
                        </video>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <section id="section-marquee">
        <div class="marquee">
            <div class="track">
                <div class="content">
                    <?php
                        foreach($portfolio as $item){
                            echo '
                                <a href="">
                                    <h2>'.$item["title"].'</h2>
                                    <img src="'.$item["image"].'" alt="">
                                </a>
                            ';
                        }
                  
                    ?>

                </div>

               


            </div>
        </div>
    </section>



    <section class="WhyChooseUS" id="WhyChooseUS">

        <div class="WhyChooseUS-container">
        
            <div class="Mask">
                
                <div class="Text">
                    <span>WHY CHOOSE US?</span>
                </div>

                <ul class="whyChooseUS-list whyChooseUS-steps">
                    
                    <?php
                        $i = 0;
                        foreach($values as $item){
                            $i++;
                            echo '
                            <li id="item_1 step">
                                <div class="item_head">
                                    <div class="icon_number">
                                        <i>'.$i.'</i>
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 256 256" style="user-select: none; width: 100%; height: 100%; display: inline-block; fill: var(--token-7e73b624-1962-48eb-b0bd-b0ed30511078, rgb(0, 255, 208)); color: var(--token-7e73b624-1962-48eb-b0bd-b0ed30511078, rgb(0, 255, 208)); flex-shrink: 0;" focusable="false" color="var(--token-7e73b624-1962-48eb-b0bd-b0ed30511078, rgb(0, 255, 208))"><g color="var(--token-7e73b624-1962-48eb-b0bd-b0ed30511078, rgb(0, 255, 208))" weight="regular"><path d="M248,128a87.34,87.34,0,0,1-17.6,52.81,8,8,0,1,1-12.8-9.62A71.34,71.34,0,0,0,232,128a72,72,0,0,0-144,0,8,8,0,0,1-16,0,88,88,0,0,1,3.29-23.88C74.2,104,73.1,104,72,104a48,48,0,0,0,0,96H96a8,8,0,0,1,0,16H72A64,64,0,1,1,81.29,88.68,88,88,0,0,1,248,128Zm-69.66,42.34L160,188.69V128a8,8,0,0,0-16,0v60.69l-18.34-18.35a8,8,0,0,0-11.32,11.32l32,32a8,8,0,0,0,11.32,0l32-32a8,8,0,0,0-11.32-11.32Z"></path></g></svg>
                                    </div>
                                    <div class="item_title">
                                        '.$item["title"].'
                                    </div>
                                </div>
                                <div class="item_body">
                                    <p>
                                        '.$item["description"].'
                                    </p>
                                </div>
                                
                            </li>
                            ';

                        }
                    ?>
                </ul>

            </div>

        </div>
    </section>


  <section class="Teams">
      <div class="Teams-Text">
            <h2><?=$teams["title"]?></h2>   
            <p><?=$teams["description"]?></p>
      </div>
      <div class="container_ring">
          <div id="ring">
            <?php
                foreach($teams["team_member"] as $item){
                    echo '
                        <div class="img" style="background-image: url('.$item["image"].');">
                            <div class="img-text">
                                <h3><?=$item["full_name"]?></h3>
                                <p><?=$item["job_position"]?></p>
                            </div>
                        </div>
                    ';
                }
            ?>    
          </div>
        </div>
        <!-- <div class="vignette"></div> -->
        
        <div id="dragger"></div>
  
  </section>



  <section class="section-cm">
        <div class="container">
        <h2><?=$testimonial["title"]?></h2>
            <p class="section-cm-desc"><?=$testimonial["description"]?></p>

            <div class="cm-wrap">

                <div class="marquee__group">
                    <?php

                    $i = 0;
                    foreach($testimonial["testimonial_list"] as $item){
                        $i++;

                        echo '
                            <div class="cm-item">
                                <div class="d-flex">
                                    <img src="'.$item["image"].'" alt="">
                                    <strong>'.$item["full_name"].'</strong>
                                    <div>
                                        <i class="fa-solid fa-star"></i>
                                        <i class="fa-solid fa-star"></i>
                                        <i class="fa-solid fa-star"></i>
                                        <i class="fa-solid fa-star"></i>
                                        <i class="fa-solid fa-star"></i>
                                    </div>
                                </div>
                                <p>'.$item["message"].'</p>
                                <span>'.$item["job_position"].'</span>
                            </div>
                        
                        ';
                        
                    }
                    ?>
                    </div>



            </div>

            <div class="cm-wrap marquee--reverse mt-4">

                <div class="marquee__group">
                   <?php

                    $i = 0;
                    foreach($testimonial["testimonial_list"] as $item){
                        $i++;

                        echo '
                            <div class="cm-item">
                                <div class="d-flex">
                                    <img src="'.$item["image"].'" alt="">
                                    <strong>'.$item["full_name"].'</strong>
                                    <div>
                                        <i class="fa-solid fa-star"></i>
                                        <i class="fa-solid fa-star"></i>
                                        <i class="fa-solid fa-star"></i>
                                        <i class="fa-solid fa-star"></i>
                                        <i class="fa-solid fa-star"></i>
                                    </div>
                                </div>
                                <p>'.$item["message"].'</p>
                                <span>'.$item["job_position"].'</span>
                            </div>
                        
                        ';
                        
                    }
                    ?>
            </div>
        </div>
    </section>

    <section class="py-16 sec-faq">
        <div class="container mx-auto px-4">
            <div class="flex flex-col lg:flex-row items-center gap-8 aic">
                <div class="w-full lg:w-1/2">
                    <h2><?=$faq["title"]?></h2>
                    <p class="sec-faq-desc">
                        <?=$faq["description"]?>
                    </p>
                    <img src="<?=$faq["image"]?>" alt="">
                </div>
                <div class="w-full lg:w-1/2">

            
                <div class="faqs__items">


                        <?php
                            foreach($faq["faq_list"] as $item){
                                echo '
                                    <div class="faq__item">
                                        <div class="faq__item__head">
                                            '.$item["question"].'
                                            <i></i>
                                        </div>
                                        <div class="faq__item__body">
                                            '.$item["answer"].'
                                        </div>
                                    </div>
                                ';
                            }
                        ?>

                       

                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="section-date">
        <div class="container">
            <h2><?=$book_request['title']?></h2>
            <div class="date__wrap">
                <div class="spot">
                    <span></span>
                    2 Spots Available
                </div>
                <img src="http://localhost/HDM-AE/date.avif" alt="">
            </div>
        </div>
    </section>


    <section class="section-floatimg">
        <div class="floatimg-wrap">
            <img src="<?=$dribbble["logo"]?>" alt="">
            <p><?=$dribbble["description"]?></p>
            <a href="<?=$dribbble["view_profile_link"]?>">View Portfolio</a>
        </div>

        <?php
            $i =0;
            foreach($dribbble["dribbble_image"] as $item){
                $i++;
                echo '<img src="'.$item["image"].'" class="dribImg img'.$i.'" alt="">';
            }
        ?>
       
    </section>


    <!-- <section class="section-dev">

<div class="container">
    <span>Integrations</span>
    <h2>Integrates with your workflow</h2>
    <p>
        Whether you're a small business or a large enterprise, our integrations are designed to enhance your
        productivity and make your workflow easier.
    </p>

    <div class="wrap">
        <div class="dev-svg">
            <img class="dev d-none d-lg-block" src="http://localhost/HDM-AE/wp-content/uploads/2025/05/dev.svg" alt="">
            <img class="trace d-lg-none" src="http://localhost/HDM-AE/wp-content/uploads/2025/05/trace.svg" alt="">

        </div>
        <div class="d-flex">
            <div class="box b1">
                <svg style="width:100%;height:100%" viewBox="0 0 24 36" preserveAspectRatio="none" width="100%"
                    height="100%">
                    <use href="#svg1759925162_614"></use>
                </svg>
            </div>
            <div class="box b2">
                <svg style="width:100%;height:100%" viewBox="0 0 36 30" preserveAspectRatio="none" width="100%"
                    height="100%">
                    <use href="#svg174181680_3108"></use>
                </svg>
            </div>
            <div class="box b3">
                <svg style="width:100%;height:100%" viewBox="0 0 36 36" preserveAspectRatio="none" width="100%"
                    height="100%">
                    <use href="#svg-102668775_1324"></use>
                </svg>
            </div>

        </div>
        <div class="d-flex">
            <div class="box b4">


                <svg style="width:100%;height:100%" viewBox="0 0 42 42" preserveAspectRatio="none" width="100%"
                    height="100%">
                    <use href="#svg-89006774_614"></use>
                </svg>

            </div>
        </div>
        <div class="d-flex">


            <div class="box b5">
                <svg style="width:100%;height:100%" viewBox="0 0 32 32" preserveAspectRatio="none" width="100%"
                    height="100%">
                    <use href="#svg1953204403_745"></use>
                </svg>
            </div>
            <div class="box b6">
                <svg style="width:100%;height:100%" viewBox="0 0 36 22" preserveAspectRatio="none" width="100%"
                    height="100%">
                    <use href="#svg1299977864_758"></use>
                </svg>
            </div>

            <div class="box b7">
                <svg style="width:100%;height:100%" viewBox="0 0 36 30" preserveAspectRatio="none" width="100%"
                    height="100%">
                    <use href="#svg-1816558204_833"></use>
                </svg>
            </div>
        </div>
    </div>


    <a href="#" class="dev-link">Explore integrations<i class="fa-solid fa-chevron-right"></i></a>
</div>

</section>




<div id="svg-templates">
<svg width="24" height="36" fill="none" id="svg1759925162_614">
    <path d="M6.007 36a6 6 0 0 0 5.996-5.997v-5.998H6.007a6 6 0 0 0-5.996 5.998A6 6 0 0 0 6.007 36Z"
        fill="#0ACF83" />
    <path d="M0 18a6 6 0 0 1 5.996-5.998h5.996v12.002H5.996A6 6 0 0 1 0 18.006V18Z" fill="#A259FF" />
    <path d="M0 5.998A6 6 0 0 1 5.996 0h5.996v12.002H5.996A6 6 0 0 1 0 6.004v-.006Z" fill="#F24E1E" />
    <path d="M11.945 0h5.996a6 6 0 0 1 5.996 5.998 6 6 0 0 1-5.996 5.998h-5.996V0Z" fill="#FF7262" />
    <path
        d="M24 18a6 6 0 0 1-5.996 5.998c-3.31 0-6.06-2.688-6.06-5.998a6 6 0 0 1 5.997-5.998A6 6 0 0 1 23.937 18H24Z"
        fill="#1ABCFE" />
</svg>
<svg width="36" height="30" fill="none" id="svg174181680_3108">
    <path fill-rule="evenodd" clip-rule="evenodd"
        d="m11.666 24.402 3.393-7.105c-2.591-.548-5.2-2.144-6.675-4.085l-3.548 7.425a20.183 20.183 0 0 0 6.83 3.765Z"
        fill="#1A007F" />
    <path fill-rule="evenodd" clip-rule="evenodd"
        d="M25.828 12.999c-1.705 2.08-4.072 3.622-6.605 4.223l3.383 7.084c2.469-.83 4.777-2.17 6.77-3.888L25.829 13Z"
        fill="#4E000A" />
    <path fill-rule="evenodd" clip-rule="evenodd"
        d="m4.836 20.637-1.774 3.712c-.904 1.888-.225 4.212 1.635 5.196a3.907 3.907 0 0 0 5.35-1.755l1.619-3.388a20.27 20.27 0 0 1-6.83-3.765Z"
        fill="#1A007F" />
    <path fill-rule="evenodd" clip-rule="evenodd"
        d="M32.872 4.892a3.903 3.903 0 0 0-4.585 3.042c-.375 1.862-1.251 3.596-2.459 5.069l3.543 7.424c3.271-2.824 5.687-6.669 6.552-10.972a3.873 3.873 0 0 0-3.051-4.563Z"
        fill="#FF9396" />
    <path fill-rule="evenodd" clip-rule="evenodd"
        d="M19.223 17.221a9.968 9.968 0 0 1-2.31.277 8.96 8.96 0 0 1-1.854-.202c-2.591-.548-5.2-2.144-6.675-4.085a6.567 6.567 0 0 1-.876-1.505C6.701 9.722 4.43 8.765 2.436 9.562A3.877 3.877 0 0 0 .283 14.61c.913 2.255 2.527 4.324 4.553 6.026A20.253 20.253 0 0 0 11.66 24.4c1.715.548 3.495.851 5.248.851 1.945 0 3.863-.335 5.691-.947l-3.377-7.084Z"
        fill="#002DC8" />
    <path fill-rule="evenodd" clip-rule="evenodd"
        d="m31.242 24.332-1.87-3.914-3.544-7.42-.005.006s0-.005.005-.005L20.676 2.213a3.899 3.899 0 0 0-7.033 0L8.39 13.21c1.475 1.942 4.083 3.537 6.675 4.085l1.7-3.553a.445.445 0 0 1 .8 0l1.663 3.479 3.383 7.084 1.662 3.478a3.898 3.898 0 0 0 4.559 2.07c2.346-.644 3.457-3.33 2.41-5.521Z"
        fill="#FF536A" />
    <path fill-rule="evenodd" clip-rule="evenodd"
        d="m11.666 24.402 3.393-7.105c-2.591-.548-5.2-2.144-6.675-4.085l-3.548 7.425a20.183 20.183 0 0 0 6.83 3.765Z"
        fill="#1A007F" />
    <path fill-rule="evenodd" clip-rule="evenodd"
        d="M25.828 12.999c-1.705 2.08-4.072 3.622-6.605 4.223l3.383 7.084c2.469-.83 4.777-2.17 6.77-3.888L25.829 13Z"
        fill="#4E000A" />
    <path fill-rule="evenodd" clip-rule="evenodd"
        d="m4.836 20.637-1.774 3.712c-.904 1.888-.225 4.212 1.635 5.196a3.907 3.907 0 0 0 5.35-1.755l1.619-3.388a20.27 20.27 0 0 1-6.83-3.765Z"
        fill="#1A007F" />
    <path fill-rule="evenodd" clip-rule="evenodd"
        d="M32.872 4.892a3.903 3.903 0 0 0-4.585 3.042c-.375 1.862-1.251 3.596-2.459 5.069l3.543 7.424c3.271-2.824 5.687-6.669 6.552-10.972a3.873 3.873 0 0 0-3.051-4.563Z"
        fill="#FF9396" />
    <path fill-rule="evenodd" clip-rule="evenodd"
        d="M19.223 17.221a9.967 9.967 0 0 1-2.31.277c-.603 0-1.228-.07-1.854-.202-2.591-.548-5.2-2.144-6.675-4.085a6.567 6.567 0 0 1-.876-1.505C6.701 9.722 4.43 8.765 2.436 9.562A3.877 3.877 0 0 0 .283 14.61c.913 2.255 2.527 4.324 4.553 6.026A20.254 20.254 0 0 0 11.66 24.4c1.715.548 3.495.851 5.248.851 1.945 0 3.864-.335 5.691-.947l-3.377-7.084Z"
        fill="#002DC8" />
    <path fill-rule="evenodd" clip-rule="evenodd"
        d="m31.242 24.332-1.87-3.914-3.544-7.42-.005.006s0-.005.005-.005L20.676 2.213a3.899 3.899 0 0 0-7.033 0L8.39 13.21c1.475 1.942 4.083 3.537 6.675 4.085l1.7-3.553a.445.445 0 0 1 .8 0l1.663 3.479 3.383 7.084 1.662 3.478a3.898 3.898 0 0 0 4.559 2.07c2.346-.644 3.457-3.33 2.41-5.521Z"
        fill="#FF536A" />
</svg>
<svg width="36" height="36" fill="none" id="svg-102668775_1324">
    <path fill-rule="evenodd" clip-rule="evenodd"
        d="M7.593 22.757a3.781 3.781 0 1 1-7.563 0 3.781 3.781 0 0 1 3.781-3.784h3.782v3.784Zm1.888 0a3.778 3.778 0 0 1 3.781-3.784 3.778 3.778 0 0 1 3.782 3.784v9.458A3.778 3.778 0 0 1 13.262 36a3.778 3.778 0 0 1-3.781-3.785v-9.458Z"
        fill="#E01E5A" />
    <path fill-rule="evenodd" clip-rule="evenodd"
        d="M13.26 7.569a3.778 3.778 0 0 1-3.78-3.785A3.778 3.778 0 0 1 13.26 0a3.778 3.778 0 0 1 3.782 3.784V7.57h-3.781Zm0 1.918a3.778 3.778 0 0 1 3.782 3.784 3.778 3.778 0 0 1-3.781 3.784H3.78A3.781 3.781 0 0 1 0 13.271a3.781 3.781 0 0 1 3.781-3.784h9.48Z"
        fill="#36C5F0" />
    <path fill-rule="evenodd" clip-rule="evenodd"
        d="M28.409 13.271a3.778 3.778 0 0 1 3.781-3.784 3.778 3.778 0 0 1 3.782 3.784 3.778 3.778 0 0 1-3.782 3.784h-3.78v-3.784Zm-1.888 0a3.778 3.778 0 0 1-3.782 3.784 3.778 3.778 0 0 1-3.781-3.784V3.784A3.778 3.778 0 0 1 22.739 0a3.778 3.778 0 0 1 3.782 3.784v9.487Z"
        fill="#2EB67D" />
    <path fill-rule="evenodd" clip-rule="evenodd"
        d="M22.74 28.43a3.778 3.778 0 0 1 3.78 3.785A3.778 3.778 0 0 1 22.74 36a3.778 3.778 0 0 1-3.782-3.785v-3.784h3.781Zm0-1.889a3.778 3.778 0 0 1-3.782-3.784 3.778 3.778 0 0 1 3.781-3.784h9.48A3.778 3.778 0 0 1 36 22.757a3.778 3.778 0 0 1-3.782 3.784H22.74Z"
        fill="#ECB22E" />
</svg>
<svg width="42" height="42" fill="none" id="svg-89006774_614">
    <path
        d="M31.5 0h-21A10.5 10.5 0 0 0 0 10.5v21A10.5 10.5 0 0 0 10.5 42h21A10.5 10.5 0 0 0 42 31.5v-21A10.5 10.5 0 0 0 31.5 0ZM15.814 24.086a1.577 1.577 0 1 1-2.228 2.228l-4.2-4.2a1.574 1.574 0 0 1 0-2.228l4.2-4.2a1.576 1.576 0 0 1 2.228 2.228L12.728 21l3.086 3.086Zm8.8-10.004-4.2 14.7a1.575 1.575 0 0 1-3.028-.864l4.2-14.7a1.578 1.578 0 0 1 2.527-.86 1.576 1.576 0 0 1 .501 1.724Zm8 8.032-4.2 4.2a1.576 1.576 0 0 1-2.228-2.228L29.272 21l-3.086-3.086a1.576 1.576 0 0 1 2.228-2.228l4.2 4.2a1.572 1.572 0 0 1 0 2.228Z"
        fill="#ADFF85" />
</svg>
<svg width="32" height="32" fill="none" id="svg1953204403_745">
    <path
        d="M32 16.383c0-1.08-.107-2.196-.285-3.241h-15.4v6.17h8.82c-.355 1.986-1.529 3.73-3.272 4.845l5.264 4.008C30.222 25.342 32 21.23 32 16.383Z"
        fill="#4280EF" />
    <path
        d="M16.317 32c4.41 0 8.11-1.43 10.813-3.87l-5.264-3.973c-1.458.976-3.343 1.534-5.549 1.534-4.268 0-7.86-2.824-9.176-6.588L1.735 23.18C4.51 28.584 10.13 32 16.317 32Z"
        fill="#34A353" />
    <path d="M7.14 19.067a9.536 9.536 0 0 1 0-6.135L1.734 8.82a15.736 15.736 0 0 0 0 14.362l5.406-4.114Z"
        fill="#F6B704" />
    <path
        d="M16.317 6.345c2.312-.035 4.589.836 6.26 2.405l4.66-4.601C24.285 1.429 20.372-.034 16.317 0 10.13 0 4.51 3.417 1.735 8.82l5.406 4.113c1.316-3.8 4.909-6.588 9.176-6.588Z"
        fill="#E54335" />
</svg>
<svg width="36" height="22" fill="none" id="svg1299977864_758">
    <path
        d="M4.488 22a4.447 4.447 0 0 1-2.271-.619 4.49 4.49 0 0 1-1.532-6.26L8.77 2.208A4.542 4.542 0 0 1 10.472.556a4.447 4.447 0 0 1 2.289-.554c.797.02 1.574.254 2.253.68a4.491 4.491 0 0 1 1.366 6.297L8.3 19.891a4.539 4.539 0 0 1-1.64 1.552A4.447 4.447 0 0 1 4.488 22Z"
        fill="#F62B54" />
    <path
        d="M18.415 22a4.479 4.479 0 0 1-4.478-4.604 4.471 4.471 0 0 1 .682-2.257l8.07-12.885a4.538 4.538 0 0 1 1.695-1.68 4.487 4.487 0 0 1 6.187 1.863 4.48 4.48 0 0 1-.29 4.576l-8.068 12.884a4.53 4.53 0 0 1-1.635 1.546 4.44 4.44 0 0 1-2.163.557Z"
        fill="#FC0" />
    <path
        d="M31.79 22c2.325 0 4.21-1.863 4.21-4.162s-1.885-4.162-4.21-4.162-4.21 1.863-4.21 4.162S29.466 22 31.79 22Z"
        fill="#00CA72" />
</svg>
<svg width="36" height="30" fill="none" id="svg-1816558204_833">
    <path
        d="M16.075.379 2.654 5.91c-.747.308-.74 1.364.012 1.66l13.478 5.325a5.02 5.02 0 0 0 3.687 0L33.309 7.57c.75-.296.759-1.352.012-1.66L19.9.38a5.02 5.02 0 0 0-3.825 0"
        fill="#FCB400" />
    <path
        d="M19.183 15.803v13.3a.899.899 0 0 0 1.23.833l15.02-5.807a.898.898 0 0 0 .567-.832v-13.3a.899.899 0 0 0-1.23-.833L19.75 14.97a.899.899 0 0 0-.567.833"
        fill="#18BFFF" />
    <path
        d="M15.676 16.488 11.22 18.63l-.453.218-9.408 4.491C.76 23.627 0 23.194 0 22.534V10.05c0-.238.123-.445.288-.6.067-.067.144-.124.228-.17a.962.962 0 0 1 .818-.063L15.6 14.85c.725.286.782 1.299.075 1.639"
        fill="#F82B60" />
    <path
        d="M15.676 16.488 11.22 18.63.288 9.451a.948.948 0 0 1 .228-.17.962.962 0 0 1 .818-.064L15.6 14.85c.725.286.782 1.299.075 1.639"
        fill="#000" fill-opacity=".25" />
</svg>

</div> -->

    <!-- <div style="display:inline-block;width:100%;height:100vh"></div> -->

    
    <script src='https://cdnjs.cloudflare.com/ajax/libs/gsap/3.6.1/gsap.min.js'></script>
    <script src='https://unpkg.com/gsap@3/dist/Draggable.min.js'></script>
<?php
get_footer();
?>
