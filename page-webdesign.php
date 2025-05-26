<?php

// Template Name: Web Design

theme_scripts('webdesign');
get_header();

$section_1 = get_field('section_1',get_the_ID());
$video_section = get_field('video_section',get_the_ID());
$portfolio = get_field('portfolio',get_the_ID());
$values = get_field('values',get_the_ID());

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
      
      <div class="container_ring">
          <div id="ring">
            
            <div class="img" style="background-image: url(http://localhost/HDM-AE/wp-content/uploads/2025/05/original-7c0b60e005b4f359adb1ee0d99eeddfe.png);"></div>
            <div class="img" style="background-image: url(http://localhost/HDM-AE/wp-content/uploads/2025/05/original-7c0b60e005b4f359adb1ee0d99eeddfe.png);"></div>
            <div class="img" style="background-image: url(http://localhost/HDM-AE/wp-content/uploads/2025/05/original-7c0b60e005b4f359adb1ee0d99eeddfe.png);"></div>
            <div class="img" style="background-image: url(http://localhost/HDM-AE/wp-content/uploads/2025/05/original-7c0b60e005b4f359adb1ee0d99eeddfe.png);"></div>
            <div class="img" style="background-image: url(http://localhost/HDM-AE/wp-content/uploads/2025/05/original-7c0b60e005b4f359adb1ee0d99eeddfe.png);"></div>
            <div class="img" style="background-image: url(http://localhost/HDM-AE/wp-content/uploads/2025/05/original-7c0b60e005b4f359adb1ee0d99eeddfe.png);"></div>
            <div class="img" style="background-image: url(http://localhost/HDM-AE/wp-content/uploads/2025/05/original-7c0b60e005b4f359adb1ee0d99eeddfe.png);"></div>
            <div class="img" style="background-image: url(http://localhost/HDM-AE/wp-content/uploads/2025/05/original-7c0b60e005b4f359adb1ee0d99eeddfe.png);"></div>
            <div class="img" style="background-image: url(http://localhost/HDM-AE/wp-content/uploads/2025/05/original-7c0b60e005b4f359adb1ee0d99eeddfe.png);"></div>
            <div class="img" style="background-image: url(http://localhost/HDM-AE/wp-content/uploads/2025/05/original-7c0b60e005b4f359adb1ee0d99eeddfe.png);"></div>
            <div class="img" style="background-image: url(http://localhost/HDM-AE/wp-content/uploads/2025/05/original-7c0b60e005b4f359adb1ee0d99eeddfe.png);"></div>
            <div class="img" style="background-image: url(http://localhost/HDM-AE/wp-content/uploads/2025/05/original-7c0b60e005b4f359adb1ee0d99eeddfe.png);"></div>
     
            

  
            
            
          </div>
        </div>
        <!-- <div class="vignette"></div> -->
        
        <div id="dragger"></div>
  
  </section>






    <!-- <div style="display:inline-block;width:100%;height:100vh"></div> -->

    

<?php
get_footer();
?>

<script src='https://cdnjs.cloudflare.com/ajax/libs/gsap/3.6.1/gsap.min.js'></script>
    <script src='https://unpkg.com/gsap@3/dist/Draggable.min.js'></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/zepto/1.2.0/zepto.min.js'></script>
    <script>

  // Teams
  
 let xPos = 0;

 gsap.timeline()
     .set(dragger, { opacity:0 }) //make the drag layer invisible
     .set(ring,    { rotationY:180 }) //set initial rotationY so the parallax jump happens off screen
     // .set(ring,    { rotationX: 45 }) 
     .set('.img',  { // apply transform rotations to each image
       rotateY: (i)=> i*-30,
       transformOrigin: '50% 50% 1000px',
       z: -1000,
      //  backgroundImage:(i)=>'url(https://picsum.photos/id/'+(i+32)+'/700/300/)',
      //  backgroundPosition:(i)=>getBgPos(i),
       backfaceVisibility:'hidden'
     })    
     .from('.img', {
       duration:1.5,
       y:200,
       opacity:0,
       stagger:0.1,
       ease:'expo'
     })
 
 Draggable.create(dragger, {
   
   onDragStart:(e)=>{ 
     if (e.touches) e.clientX = e.touches[0].clientX;
     xPos = Math.round(e.clientX);
   },
   
   onDrag:(e)=>{
     if (e.touches) e.clientX = e.touches[0].clientX;    
     
     gsap.to(ring, {
       rotationY: '-=' +( (Math.round(e.clientX)-xPos)%360 ),
       onUpdate: ()=>{gsap.set('.img', { backgroundPosition:(i)=>getBgPos(i) }) }
     });
     
     xPos = Math.round(e.clientX);
   },
   
   onDragEnd:()=> {
     // gsap.to(ring, { rotationY: Math.round(gsap.getProperty(ring,'rotationY')/36)*36 }) // move to nearest photo...at the expense of the inertia effect
     gsap.set(dragger, {x:0, y:0}) // reset drag layer
   }
   
 })
 
 
 function getBgPos(i){ //returns the background-position string to create parallax movement in each image
   return ( -gsap.utils.wrap(0,360,gsap.getProperty(ring, 'rotationY')-180-i*18)/360*400 )+'px 0px';
 }


    </script>