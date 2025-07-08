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
$top_case_study = get_field('top_case_study',get_the_ID());

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
                                <a href="#">
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
                <a href="#reqeust_section" class="CTA_Default">
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
                <img src="<?=$top_case_study["image"]?>">
                <div class="shadow_box"></div>
            </div>
            <div class="data">

                    <i class="countUp" data-number="<?=$top_case_study["count"]?>">0</i>
                    <h2><?=$top_case_study["title"]?></h2>
                    <span class="title"><?=$top_case_study["text"]?></span>

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

    <section class="section-date" id="reqeust_section">
        <div class="container">
            <h2><?=$book_request['title']?></h2>
            <div class="date__wrap">
            
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

    <a href="https://wa.me/971562601368" target="_blank" class="whatsappCall">

        <svg xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" width="512" height="512" x="0" y="0" viewBox="0 0 52 52" style="enable-background:new 0 0 512 512" xml:space="preserve" class=""><g><path d="M26 0C11.663 0 0 11.663 0 26c0 4.891 1.359 9.639 3.937 13.762C2.91 43.36 1.055 50.166 1.035 50.237a.996.996 0 0 0 .27.981c.263.253.643.343.989.237l10.306-3.17A25.936 25.936 0 0 0 26 52c14.337 0 26-11.663 26-26S40.337 0 26 0zm0 50a23.94 23.94 0 0 1-12.731-3.651 1 1 0 0 0-.825-.108l-8.999 2.77a991.452 991.452 0 0 1 2.538-9.13c.08-.278.035-.578-.122-.821A23.907 23.907 0 0 1 2 26C2 12.767 12.767 2 26 2s24 10.767 24 24-10.767 24-24 24z" fill="#000000" opacity="1" data-original="#000000" class=""></path><path d="M42.985 32.126c-1.846-1.025-3.418-2.053-4.565-2.803-.876-.572-1.509-.985-1.973-1.218-1.297-.647-2.28-.19-2.654.188a1 1 0 0 0-.125.152c-1.347 2.021-3.106 3.954-3.621 4.058-.595-.093-3.38-1.676-6.148-3.981-2.826-2.355-4.604-4.61-4.865-6.146C20.847 20.51 21.5 19.336 21.5 18c0-1.377-3.212-7.126-3.793-7.707-.583-.582-1.896-.673-3.903-.273a1.01 1.01 0 0 0-.511.273c-.243.243-5.929 6.04-3.227 13.066 2.966 7.711 10.579 16.674 20.285 18.13 1.103.165 2.137.247 3.105.247 5.71 0 9.08-2.873 10.029-8.572a.996.996 0 0 0-.5-1.038zm-12.337 7.385c-10.264-1.539-16.729-11.708-18.715-16.87-1.97-5.12 1.663-9.685 2.575-10.717.742-.126 1.523-.179 1.849-.128.681.947 3.039 5.402 3.143 6.204 0 .525-.171 1.256-2.207 3.293A.996.996 0 0 0 17 22c0 5.236 11.044 12.5 13 12.5 1.701 0 3.919-2.859 5.182-4.722a.949.949 0 0 1 .371.116c.36.181.984.588 1.773 1.104 1.042.681 2.426 1.585 4.06 2.522-.742 3.57-2.816 7.181-10.738 5.991z" fill="#000000" opacity="1" data-original="#000000" class=""></path></g></svg>
        <span>Contact via WhatsApp</span>
    </a>
   
    <!-- <div style="display:inline-block;width:100%;height:100vh"></div> -->
  
      
    <script src='https://cdnjs.cloudflare.com/ajax/libs/gsap/3.6.1/gsap.min.js'></script>
    <script src='https://unpkg.com/gsap@3/dist/Draggable.min.js'></script>
<?php
get_footer();
?>
