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
// Function to render CTA button
?>


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
