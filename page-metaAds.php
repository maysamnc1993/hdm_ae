<?php
/**
 * Template Name: Meta Ads
 * Template Post Type: page
 */
theme_scripts('metaAds');
get_header();

// Include global ACF field groups
if (!defined('THEME_URI')) {
    define('THEME_URI', get_template_directory());
}


$fields = [
    'faq' => [
        'title' => get_field('faq_title', get_the_ID()),
        'description' => get_field('faq_description', get_the_ID()),
        'image' => ($image = get_field('faq_image', get_the_ID())) ? $image['url'] : '',
        'faq_list' => get_field('faq_list', get_the_ID()) ?: [],
    ],
    'case_study' => [
        'sub_title' => get_field('case_study_sub_title', get_the_ID()),
        'title' => get_field('case_study_title', get_the_ID()),
        'case_study_list' => get_field('case_study_list', get_the_ID()) ?: [],
    ],
    'ad_services' => get_field('ad_service_items', get_the_ID()) ?: [],
];

// Determine video source (prefer uploaded video if available)
$video_source = get_field('video_upload') ?: get_field('video_source') ?: 'https://a.storyblok.com/f/325490/x/6ccfd466b9/2025_02_homerun_showreel_sanstexte.mp4';

// Get scrolling cards
$scrolling_cards = get_field('scrolling_cards') ?: [];
$card_count = count($scrolling_cards);
$container_height = $card_count * 100; // 100vh per card
?>

<!-- Section 1: Hero Section -->
<div class="section-hero">
    <div class="text-area">
        <span class="small-title"><?php echo esc_html(get_field('small_title') ?: 'Small Title not set'); ?></span>
        <h1 class="main-heading">
            <span>
                <i><?php echo esc_html(get_field('meta_text') ?: 'Meta Text not set'); ?></i>
                <b><?php echo esc_html(get_field('meta_text') ?: 'Meta Text not set'); ?></b>
            </span>
            <span class="on-top">
                <i><?php echo esc_html(get_field('ads_text') ?: 'Ads Text not set'); ?></i>
                <b><?php echo esc_html(get_field('ads_text') ?: 'Ads Text not set'); ?></b>
            </span>
            <br>
            <?php echo esc_html(get_field('management_text') ?: 'Management Text not set'); ?>
        </h1>
    </div>
</div>

<!-- Section 2: Video Section -->
<div id="home-hero-video" class="lg absolute top-0 right-0 z-[1] h-144 w-230 origin-center bg-black lg:h-[15vw] lg:w-[24vw]">
    <span class="video-caption"><?php echo esc_html(get_field('video_caption') ?: 'Premium Meta Ads Agency'); ?></span>
    <video class="absolute inset-0 h-full w-full object-cover" autoplay muted loop playsinline title="" aria-label="" data-copyright="" data-source="">
        <source src="<?php echo esc_url($video_source); ?>" type="video/mp4">
    </video>
</div>
<div class="scroll-height"></div>

<!-- Section 3: Business Model Section -->
<div class="sticky-container">
    <div class="sticky-section" id="stickySection">
        <div class="column-1" role="region" aria-label="Main content">
            <h2><?php echo esc_html(get_field('column_1_title') ?: 'Amazing Design'); ?></h2>
            <p><?php echo esc_html(get_field('column_1_description') ?: 'This is an incredible section that demonstrates smooth scroll-triggered animations. Watch as the content transforms seamlessly as you scroll down the page. The text scales and fades while new content slides into view.'); ?></p>
        </div>
        <div class="column-2" role="region" aria-label="Image content">
            <div class="image-wrapper">
                <img class="current-image" src="<?php echo esc_url(get_field('column_2_current_image') ?: 'https://images.unsplash.com/photo-1498050108023-c5249f4df085?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80'); ?>" alt="Design workspace">
                <img class="new-image" src="<?php echo esc_url(get_field('column_2_new_image') ?: 'https://images.unsplash.com/photo-1516321318423-f06f85e504b3?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80'); ?>" alt="New design workspace">
            </div>
        </div>
        <div class="column-3 hidden-column" role="region" aria-hidden="true">
            <div class="content-wrapper">
                <?php
                $column_3_items = get_field('column_3_items') ?: [
                    ['item_title' => 'Step 1: Discovery', 'item_description' => 'This is the first hidden column that slides up to replace the image. We begin our journey with discovery and exploration of new possibilities.'],
                    ['item_title' => 'Step 2: Planning', 'item_description' => 'With discoveries in hand, we now plan the next steps to bring our vision to life.']
                ];
                $index = 1;
                foreach ($column_3_items as $item) :
                ?>
                    <div class="content-item <?php echo $index === 1 ? 'active' : ''; ?>" data-acf-title="step_<?php echo $index; ?>_title" data-acf-content="step_<?php echo $index; ?>_content">
                        <h2><?php echo esc_html($item['item_title'] ?: 'Step ' . $index . ': Title'); ?></h2>
                        <p><?php echo esc_html($item['item_description'] ?: 'Step ' . $index . ' Description'); ?></p>
                    </div>
                <?php
                    $index++;
                endforeach;
                ?>
            </div>
        </div>
        <div class="column-4 hidden-column" role="region" aria-hidden="true">
            <img src="<?php echo esc_url(get_field('column_4_image') ?: 'https://images.unsplash.com/photo-1516321318423-f06f85e504b3?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80'); ?>" alt="New design workspace">
        </div>
        <div class="column-5 hidden-column" role="region" aria-hidden="true">
            <div>
                <h2><?php echo esc_html(get_field('column_5_title') ?: 'Step 3: Discovery'); ?></h2>
                <p><?php echo esc_html(get_field('column_5_description') ?: 'Now we move into the development phase where ideas become reality. This is where the magic happens!'); ?></p>
            </div>
        </div>
        <div class="column-6 hidden-column" role="region" aria-hidden="true">
            <div>
                <h2><?php echo esc_html(get_field('column_6_title') ?: 'Step 4: Discovery'); ?></h2>
                <p><?php echo esc_html(get_field('column_6_description') ?: 'Quality assurance and testing ensure everything works perfectly. We refine and polish our creation.'); ?></p>
            </div>
        </div>
        <div class="column-7 hidden-column" role="region" aria-hidden="true">
            <div>
                <h3><?php echo esc_html(get_field('column_7_title') ?: 'Step 5: Launch'); ?></h3>
                <p><?php echo esc_html(get_field('column_7_description') ?: 'Finally, we launch and celebrate! The journey is complete, but new adventures await ahead.'); ?></p>
            </div>
        </div>
    </div>
</div>

<!-- Section 4: Scrolling Cards -->
<section id="section4" style="height: <?php echo esc_attr($container_height); ?>vh;">
    <div class="section4-main">
        <?php if ($scrolling_cards) : ?>
            <?php foreach ($scrolling_cards as $index => $card) : ?>
                <div class="card card<?php echo $index + 1; ?>-section4" style="background-color: <?php echo esc_attr($card['background_color'] ?: '#003ea9'); ?>;">
                    <div class="card-column card-number"><?php echo esc_html($card['card_number'] ?: sprintf('%03d', $index + 1)); ?></div>
                    <div class="card-column card-text">
                        <h2><?php echo esc_html($card['card_title'] ?: 'Card ' . ($index + 1)); ?></h2>
                        <p><?php echo esc_html($card['card_description'] ?: 'Description for card ' . ($index + 1)); ?></p>
                    </div>
                    <div class="card-column card-image">
                        <img src="<?php echo esc_url($card['card_image'] ?: 'https://images.unsplash.com/photo-1498050108023-c5249f4df085?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80'); ?>" alt="<?php echo esc_attr($card['card_title'] ?: 'Card Image'); ?>">
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else : ?>
            <!-- Fallback content -->
            <div class="card card1-section4">Card 1</div>
            <div class="card card2-section4">Card 2</div>
            <div class="card card3-section4">Card 3</div>
            <div class="card card4-section4">Card 4</div>
        <?php endif; ?>
    </div>
</section>

<?php
get_template_part('template-parts/app-install/section', 'additional-ad-services', ['ad_services' => $fields['ad_services']]);
get_template_part('template-parts/seo/section', 'seo-process');
get_template_part('template-parts/global/section', 'faq', ['faq' => $fields['faq']]);
get_footer();
?>