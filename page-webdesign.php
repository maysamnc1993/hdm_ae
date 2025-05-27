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


   
    <!-- <div style="display:inline-block;width:100%;height:100vh"></div> -->
 
    
    <script src='https://cdnjs.cloudflare.com/ajax/libs/gsap/3.6.1/gsap.min.js'></script>
    <script src='https://unpkg.com/gsap@3/dist/Draggable.min.js'></script>
<?php
get_footer();
?>
