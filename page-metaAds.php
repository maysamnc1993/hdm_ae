<?php
// Template Name: Meta Ads
theme_scripts('metaAds');
get_header();
?>

<!-- Section 1: Hero Section -->
<div class="section-hero">
    <div class="text-area">
        <span class="small-title">Maximize Results with Expert</span>
        <h1 class="main-heading">
            <span>
                <i>Meta</i>
                <b>Meta</b>
            </span>
            <span class="on-top">
                <i>Ads</i>
                <b>Ads</b>
            </span>
            <br>
            Management
        </h1>
    </div>
</div>

<!-- Section 2: Video Section -->
<div id="home-hero-video" class="lg absolute top-0 right-0 z-[1] h-144 w-230 origin-center bg-black lg:h-[15vw] lg:w-[24vw]">
    <span class="video-caption">Premium Meta Ads Agency</span>
    <video class="absolute inset-0 h-full w-full object-cover" autoplay muted loop playsinline title="" aria-label="" data-copyright="" data-source="" __idm_id__="950273">
        <source src="https://a.storyblok.com/f/325490/x/6ccfd466b9/2025_02_homerun_showreel_sanstexte.mp4" type="video/mp4">
    </video>
</div>
<div class="scroll-height"></div>

<!-- Section 3: Business Model Section -->

<div class="sticky-container">
    <div class="sticky-section" id="stickySection">
      <!-- Column 1: Text Content -->
      <div class="column-1" role="region" aria-label="Main content">
        <h2>Amazing Design</h2>
        <p>This is an incredible section that demonstrates smooth scroll-triggered animations. Watch as the content transforms seamlessly as you scroll down the page. The text scales and fades while new content slides into view.</p>
      </div>

      <!-- Column 2: Image -->
      <div class="column-2" role="region" aria-label="Image content">
        <div class="image-wrapper">
          <img class="current-image" src="https://images.unsplash.com/photo-1498050108023-c5249f4df085?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" alt="Design workspace">
          <img class="new-image" src="https://images.unsplash.com/photo-1516321318423-f06f85e504b3?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" alt="New design workspace">
        </div>
      </div>

      <!-- Column 3: Hidden Content -->
      <div class="column-3 hidden-column" role="region" aria-hidden="true">
        <div class="content-wrapper">
          <h2>Step 1: Discovery</h2>
          <p>This is the first hidden column that slides up to replace the image. We begin our journey with discovery and exploration of new possibilities.</p>
        </div>
      </div>

      <!-- Column 4: Hidden Content -->
      <div class="column-4 hidden-column" role="region" aria-hidden="true">
        <img src="https://images.unsplash.com/photo-1516321318423-f06f85e504b3?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" alt="New design workspace">
      </div>

      <!-- Column 5: Hidden Content -->
      <div class="column-5 hidden-column" role="region" aria-hidden="true">
        <div>
          <h2>Step 3: Discovery</h2>
          <p>Now we move into the development phase where ideas become reality. This is where the magic happens!</p>
        </div>
      </div>

      <!-- Column 6: Hidden Content -->
      <div class="column-6 hidden-column" role="region" aria-hidden="true">
        <div>
          <h2>Step 4: Discovery</h2>
          <p>Quality assurance and testing ensure everything works perfectly. We refine and polish our creation.</p>
        </div>
      </div>

      <!-- Column 7: Hidden Content -->
      <div class="column-7 hidden-column" role="region" aria-hidden="true">
        <div>
          <h3>Step 5: Launch</h3>
          <p>Finally, we launch and celebrate! The journey is complete, but new adventures await ahead.</p>
        </div>
      </div>
    </div>
  </div>

<!-- Section 4: Scrolling Cards -->
<section id="section4">
        <div class="section4-main">
            <div class="card card1-section4">Card 1</div>
            <div class="card card2-section4">Card 2</div>
            <div class="card card3-section4">Card 3</div>
            <div class="card card4-section4">Card 4</div>
        </div>
</section>

<!-- Section 5: Rainbow Scroll Indicator -->
<!-- <div id="wrapper">
    <div id="content">
        <div class="scroll">
            <span>SCROLL</span>
            <svg viewBox="0 0 24 24">
                <line class="st1" x1="12" y1="1" x2="12" y2="22.5" />
                <line class="st1" x1="12.1" y1="22.4" x2="18.9" y2="15.6" />
                <line class="st1" x1="11.9" y1="22.4" x2="5.1" y2="15.6" />
            </svg>
        </div>
    </div>
</div> -->

<?php
get_footer();
?>