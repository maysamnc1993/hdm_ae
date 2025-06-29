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
$csat = get_field('csat',get_the_ID());
$case_study = get_field('case_study',get_the_ID());

?>




<!-- Section 1 -->

<div class="section-creative" >

    <div class="container">

        <div class="box_of_circle_effect">
            <div class="circle_effect_1"></div>
            <!-- <div class="circle_effect_2"></div> -->
        </div>

        <div class="box_of_text">
            <div class="content_section">

                <span class="slogan"><?=$section_1['small_title']?></span>
                <h1><?=$section_1['title']?></h1>
                <p><?=$section_1['description']?></p>
                <ul class="ListOfCTA">
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

<section id="section-marquee">
        <div class="textBox">
            <h1>Our Portfolio</h1>
            <p>Discover a selection of our recent projects that showcase our expertise in design, development, and digital marketing.</p>
        </div>
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
                <span style="background-image:url(<?=wp_get_attachment_image_url(129,'full')?>)">WHY CHOOSE US?</span>
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
                                    <img src="'.$item["image"].'">
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


<secrion class="Satisfied">
        
        
        <div class="container">

            <div class="box_of_csat">
                <span class="titleCsat" style="background-image:url(<?=$csat["image"]?>)"><?=$csat["title"]?></span>
                <a href="'.$item["link"].'" class="CTA_Default">
                    <div class="box_1"></div>
                    <div class="box_2"></div>
                    <span style="background-image:url(<?=wp_get_attachment_image_url(127,'full')?>)">
                        
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 256 256" style="user-select: none; width: 100%; height: 100%; display: inline-block; fill: var(--token-a85af9cb-7834-4006-a277-2dd1295ae376, rgb(255, 255, 255)); color: var(--token-a85af9cb-7834-4006-a277-2dd1295ae376, rgb(255, 255, 255)); flex-shrink: 0;" focusable="false" color="var(--token-a85af9cb-7834-4006-a277-2dd1295ae376, rgb(255, 255, 255))"><g color="var(--token-a85af9cb-7834-4006-a277-2dd1295ae376, rgb(255, 255, 255))" weight="regular"><path d="M200,64V168a8,8,0,0,1-16,0V83.31L69.66,197.66a8,8,0,0,1-11.32-11.32L172.69,72H88a8,8,0,0,1,0-16H192A8,8,0,0,1,200,64Z"></path></g></svg>
                        <b><?=$csat["text"]?></b>
                    </span>
                </a>
            </div>
        </div>

</secrion>


<section class="caseStudy">

    <div class="container">

        <div class="box_of_data">

            <div class="box_of_image">
                <img src="http://localhost/HDM-AE/wp-content/uploads/2025/06/jzTMdaQ6X2Js2yDQdPP9o3L3XUA.avif">
                <div class="shadow_box"></div>
            </div>
            <div class="data">

                    <i class="countUp">0</i>
                    <h2>Successful agency projects</h2>
                    <span class="title">Brand Identity, Website Design, Product Packaging 6Years of experience in business, improving digital design products for our customers</span>

            </div>

        </div>

    </div>

</section>
<section class="caseStudyItem">

    <div class="container">

            <div class="box_of_caseStudy">
                    <div class="titleBox">
                        <span class="badge"><?=$case_study["sub_title"]?></span>
                        <h2 class="title"><?=$case_study["title"]?></h2>
                    </div>

                    <?php
                        $i = 0;
                        foreach($case_study["case_study_list"] as $item){
                            $i++;

                            echo '
                            
                                <div class="CaseStudyItem c_'.$i.'">

                                                        <div class="Number">
                                                            <i>'.$i.'</i>
                                                            <b>Case Study</b>
                                                        </div>
                                                        <div class="text">

                                                            <span class="subtitle">'.$item['sub_title'].'</span>
                                                            <h2 class="title">'.$item['title'].'</h2>
                                                            <div class="Problem">
                                                                <p>'.$item['description'].'</p>
                                                            </div>
                                                            <a href="#">Read More</a>

                                                        </div>

                                                    </div>

                            ';

                        }
                    ?>

                    
            

            </div>

    </div>

</section>

  <div class="Teams-Text">
        <div class="container">

            <h2><?=$teams["title"]?></h2>   
            <p><?=$teams["description"]?></p>

        </div>
  </div>
  <section class="Teams">
      <div class="container_ring">
          <div id="ring">
            <?php
                foreach($teams["team_member"] as $item){
                    echo '
                        <div class="img" style="background-image: url('.$item["image"].');">
                            <div class="img-text">
                                <h3>'.$item["full_name"].'</h3>
                                <p>'.$item["job_position"].'</p>
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
                <?=do_shortcode('[custom_calendar]')?>
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
