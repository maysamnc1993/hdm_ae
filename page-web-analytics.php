<?php
/**
 * Template Name: Web Analytics Page
 *
 * Premium Web Analytics Page - Modern & Professional Design
 * Built with advanced animations and interactions
 */

if (!defined('ABSPATH')) exit;

theme_scripts('wa');

get_header();

// -----------------------
// Fetch ACF fields with defaults
// -----------------------
$hero = [
    'media' => get_field('hero_media') ?: '',  // Changed to support both image and video
    'media_type' => get_field('hero_media_type') ?: 'video',  // 'video' or 'image'
    'title' => get_field('hero_title') ?: 'Know Exactly What Drives Revenue',
    'description' => get_field('hero_description') ?: 'HDM builds measurement systems that make your marketing data reliable, actionable, and scalable.',
    'cta_text' => get_field('hero_cta_text') ?: 'Book a Call',
    'cta_link' => get_field('hero_cta_link') ?: '#',
    'clutch_point' => get_field('hero_clutch_point') ?: '',
    'clutch_url' => get_field('hero_clutch_url') ?: '#',
    'google_point' => get_field('hero_google_review_point') ?: '',
    'google_url' => get_field('hero_google_review_url') ?: '#',
    'clutch_image' => get_field('clutch_image') ?: '',
    'google_image' => get_field('google_review_image') ?: '',
];

$problem = [
    'title' => get_field('problem_title') ?: 'What problem does this service solve?',
    'description' => get_field('problem_description') ?: 'It helps you clearly understand what is happening across your marketing system...',
];

$deliverables = get_field('deliverables') ?: [];

$why_hdm = [
    'title' => get_field('why_hdm_title') ?: 'Why HDM (Dubai Market Fit)',
    'points' => get_field('why_hdm_points') ?: [],
    'image' => get_field('why_hdm_image') ?: '',  // Added image support
];

$cta_section = [
    'title' => get_field('cta_title') ?: 'Book a 15-Minute Measurement Call',
    'description' => get_field('cta_description') ?: 'Tell us what youre struggling with, and well clearly explain what you actually need and what to fix first.',
    'cta_text' => get_field('cta_button_text') ?: 'Book a Call',
    'cta_link' => get_field('cta_button_link') ?: '#',
];

// -----------------------
// Render Premium CTA Button
// -----------------------
function render_premium_cta($text, $link, $variant = 'primary') {
    if (!$text || !$link) return;
    $class = $variant === 'primary' ? 'btn-premium' : 'btn-premium-outline';
    echo '<a href="'.esc_url($link).'" class="'.$class.'">
            <span class="btn-content">'.$text.'</span>
            <span class="btn-shine"></span>
          </a>';
}

?>

<!-- Particles Background -->

<!-- Hero Section -->
<section class="section-hero">
    <div class="hero-gradient-mesh"></div>
    <div class="container-premium">
        <div class="hero-grid">
            <div class="hero-content" data-aos="fade-right">
                <div class="hero-badge">
                    <span class="badge-pulse"></span>
                    <span class="badge-text">🚀 Analytics Excellence</span>
                </div>
                
                <h1 class="hero-title">
                    <?= esc_html($hero['title']) ?>
                    <span class="title-gradient">Drive Revenue</span>
                </h1>
                
                <p class="hero-description">
                    <?= esc_html($hero['description']) ?>
                </p>
                
                <div class="hero-cta-group">
                    <?php render_premium_cta($hero['cta_text'], $hero['cta_link']); ?>
                    <a href="#problem" class="btn-premium-outline">
                        <span class="btn-content">Learn More</span>
                    </a>
                </div>
                
                <!-- Social Proof -->
                <?php if($hero['clutch_image'] || $hero['google_image']): ?>
                <div class="social-proof" data-aos="fade-up" data-aos-delay="200">
                    <?php if($hero['clutch_image']): ?>
                        <a href="<?= esc_url($hero['clutch_url']) ?>" class="proof-item">
                            <div class="proof-icon">
                                <img src="<?= esc_url($hero['clutch_image']['url'] ?? $hero['clutch_image']) ?>" alt="Clutch">
                            </div>
                            <div class="proof-text">
                                <div class="stars">⭐⭐⭐⭐⭐</div>
                                <span><?= esc_html($hero['clutch_point']) ?></span>
                            </div>
                        </a>
                    <?php endif; ?>
                    
                    <?php if($hero['google_image']): ?>
                        <a href="<?= esc_url($hero['google_url']) ?>" class="proof-item">
                            <div class="proof-icon">
                                <img src="<?= esc_url($hero['google_image']['url'] ?? $hero['google_image']) ?>" alt="Google Reviews">
                            </div>
                            <div class="proof-text">
                                <div class="stars">⭐⭐⭐⭐⭐</div>
                                <span><?= esc_html($hero['google_point']) ?></span>
                            </div>
                        </a>
                    <?php endif; ?>
                </div>
                <?php endif; ?>
            </div>
            
            <div class="hero-visual" data-aos="fade-left">
                <?php 
                // Support both video and image
                $media = $hero['media'];
                $media_url = '';
                $is_video = false;
                
                if ($media) {
                    // Check if it's an array (ACF return format)
                    if (is_array($media)) {
                        $media_url = $media['url'] ?? '';
                        $mime_type = $media['mime_type'] ?? '';
                        $is_video = strpos($mime_type, 'video') !== false;
                    } else {
                        $media_url = $media;
                        // Try to detect if it's a video by extension
                        $ext = pathinfo($media_url, PATHINFO_EXTENSION);
                        $is_video = in_array(strtolower($ext), ['mp4', 'webm', 'ogg', 'mov']);
                    }
                }
                
                if ($media_url): ?>
                    <div class="media-container">
                        <div class="media-glow"></div>
                        <?php if ($is_video): ?>
                            <video src="<?= esc_url($media_url) ?>" 
                                   autoplay muted loop playsinline 
                                   class="hero-media hero-video"></video>
                        <?php else: ?>
                            <img src="<?= esc_url($media_url) ?>" 
                                 alt="<?= esc_attr($hero['title']) ?>" 
                                 class="hero-media hero-image">
                        <?php endif; ?>
                        <div class="media-overlay"></div>
                    </div>
                <?php else: ?>
                    <div class="hero-placeholder">
                        <div class="placeholder-grid">
                            <div class="grid-item"></div>
                            <div class="grid-item"></div>
                            <div class="grid-item"></div>
                            <div class="grid-item"></div>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
    
    <!-- Scroll Indicator -->
    <div class="scroll-indicator">
        <div class="scroll-line"></div>
        <span>Scroll</span>
    </div>
</section>

<!-- Problem Section -->
<section class="section-problem" id="problem">
    <div class="container-premium">
        <div class="problem-content" data-aos="fade-up">
            <div class="section-label">
                <span>The Challenge</span>
            </div>
            <h2 class="section-title">
                <?= esc_html($problem['title']) ?>
            </h2>
            <p class="section-description">
                <?= esc_html($problem['description']) ?>
            </p>
        </div>
        
        <!-- Stats Grid -->
        <div class="stats-grid" data-aos="fade-up" data-aos-delay="200">
            <div class="stat-card">
                <div class="stat-number">87%</div>
                <div class="stat-label">Data Accuracy</div>
            </div>
            <div class="stat-card">
                <div class="stat-number">3x</div>
                <div class="stat-label">ROI Improvement</div>
            </div>
            <div class="stat-card">
                <div class="stat-number">24/7</div>
                <div class="stat-label">Live Tracking</div>
            </div>
            <div class="stat-card">
                <div class="stat-number">100+</div>
                <div class="stat-label">Happy Clients</div>
            </div>
        </div>
    </div>
</section>

<!-- Deliverables Section -->
<section class="section-deliverables">
    <div class="container-premium">
        <div class="section-header" data-aos="fade-up">
            <div class="section-label">
                <span>What You Get</span>
            </div>
            <h2 class="section-title">Our Deliverables</h2>
            <p class="section-subtitle">Comprehensive solutions tailored to your needs</p>
        </div>
        
        <div class="deliverables-grid">
            <?php 
            $delay = 0;
            foreach ($deliverables as $index => $item): 
                $delay += 100;
                // Get icon - support both image and icon class
                $icon = $item['icon'] ?? '';
                $icon_type = '';
                $icon_value = '';
                
                if (is_array($icon)) {
                    // It's an image
                    $icon_type = 'image';
                    $icon_value = $icon['url'] ?? '';
                } elseif (!empty($icon)) {
                    // It's an icon class (e.g., "fa-chart-line")
                    $icon_type = 'class';
                    $icon_value = $icon;
                }
            ?>
                <div class="deliverable-card" data-aos="fade-up" data-aos-delay="<?= $delay ?>">
                    <div class="card-number">0<?= $index + 1 ?></div>
                    <div class="card-icon">
                        <?php if ($icon_type === 'image' && $icon_value): ?>
                            <img src="<?= esc_url($icon_value) ?>" alt="<?= esc_attr($item['title'] ?? '') ?>">
                        <?php elseif ($icon_type === 'class' && $icon_value): ?>
                            <i class="<?= esc_attr($icon_value) ?>"></i>
                        <?php else: ?>
                            <!-- Default SVG icon -->
                            <svg width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M12 2L2 7l10 5 10-5-10-5z"/>
                                <path d="M2 17l10 5 10-5"/>
                                <path d="M2 12l10 5 10-5"/>
                            </svg>
                        <?php endif; ?>
                    </div>
                    <h3 class="card-title"><?= esc_html($item['title'] ?? '') ?></h3>
                    <p class="card-description"><?= esc_html($item['description'] ?? '') ?></p>
                    <div class="card-shine"></div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- Why HDM Section -->
<section class="section-why-hdm">
    <div class="container-premium">
        <div class="why-hdm-layout">
            <div class="why-hdm-content" data-aos="fade-right">
                <div class="section-label">
                    <span>Our Edge</span>
                </div>
                <h2 class="section-title"><?= esc_html($why_hdm['title']) ?></h2>
                
                <div class="features-list">
                    <?php foreach($why_hdm['points'] as $index => $point): ?>
                        <div class="feature-item" data-aos="fade-up" data-aos-delay="<?= $index * 100 ?>">
                            <div class="feature-check">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none">
                                    <path d="M20 6L9 17l-5-5" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                            </div>
                            <p><?= esc_html($point['text'] ?? '') ?></p>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
            
            <div class="why-hdm-visual" data-aos="fade-left">
                <?php 
                $why_image = $why_hdm['image'];
                $why_image_url = '';
                
                if ($why_image) {
                    if (is_array($why_image)) {
                        $why_image_url = $why_image['url'] ?? '';
                    } else {
                        $why_image_url = $why_image;
                    }
                }
                ?>
                
                <div class="visual-card">
                    <div class="visual-pattern"></div>
                    
                    <?php if ($why_image_url): ?>
                        <!-- Image Version -->
                        <div class="visual-image-container">
                            <img src="<?= esc_url($why_image_url) ?>" alt="Why HDM" class="visual-image">
                            <div class="image-overlay"></div>
                        </div>
                    <?php else: ?>
                        <!-- Default Metrics Version -->
                        <div class="visual-content">
                            <div class="metric-card">
                                <div class="metric-icon">
                                    <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                        <path d="M12 2L2 7l10 5 10-5-10-5z"/>
                                        <path d="M2 17l10 5 10-5"/>
                                    </svg>
                                </div>
                                <div class="metric-value">15+</div>
                                <div class="metric-label">Years Experience</div>
                            </div>
                            
                            <div class="metric-card">
                                <div class="metric-icon">
                                    <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                        <circle cx="12" cy="12" r="10"/>
                                        <path d="M12 6v6l4 2"/>
                                    </svg>
                                </div>
                                <div class="metric-value">500+</div>
                                <div class="metric-label">Projects Delivered</div>
                            </div>
                            
                            <div class="metric-card">
                                <div class="metric-icon">
                                    <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                        <path d="M20 6L9 17l-5-5"/>
                                    </svg>
                                </div>
                                <div class="metric-value">98%</div>
                                <div class="metric-label">Client Satisfaction</div>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- CTA Section -->
<section class="section-cta">
    <div class="cta-gradient-mesh"></div>
    <div class="container-premium">
        <div class="cta-content" data-aos="zoom-in">
            <div class="cta-icon">
                <svg width="64" height="64" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <rect x="3" y="4" width="18" height="18" rx="2" ry="2"/>
                    <line x1="16" y1="2" x2="16" y2="6"/>
                    <line x1="8" y1="2" x2="8" y2="6"/>
                    <line x1="3" y1="10" x2="21" y2="10"/>
                </svg>
            </div>
            <h2 class="cta-title"><?= esc_html($cta_section['title']) ?></h2>
            <p class="cta-description"><?= esc_html($cta_section['description']) ?></p>
            
            <div class="cta-buttons">
                <?php render_premium_cta($cta_section['cta_text'], $cta_section['cta_link']); ?>
            </div>
            
            <div class="cta-features">
                <div class="cta-feature">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor">
                        <path d="M12 2L2 7l10 5 10-5-10-5z"/>
                    </svg>
                    <span>Free Consultation</span>
                </div>
                <div class="cta-feature">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor">
                        <path d="M12 2L2 7l10 5 10-5-10-5z"/>
                    </svg>
                    <span>No Commitment</span>
                </div>
                <div class="cta-feature">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor">
                        <path d="M12 2L2 7l10 5 10-5-10-5z"/>
                    </svg>
                    <span>Expert Guidance</span>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- AOS & Particles Scripts -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.css" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js"></script>
<script src="https://cdn.jsdelivr.net/particles.js/2.0.0/particles.min.js"></script>
<script>
// Initialize AOS
AOS.init({
    duration: 1000,
    once: true,
    offset: 100,
    easing: 'ease-out-cubic'
});

// Initialize Particles
particlesJS('particles-js', {
    particles: {
        number: { value: 80, density: { enable: true, value_area: 800 } },
        color: { value: '#f9452d' },
        shape: { type: 'circle' },
        opacity: { value: 0.3, random: true },
        size: { value: 3, random: true },
        line_linked: {
            enable: true,
            distance: 150,
            color: '#f9452d',
            opacity: 0.2,
            width: 1
        },
        move: {
            enable: true,
            speed: 2,
            direction: 'none',
            random: false,
            straight: false,
            out_mode: 'out',
            bounce: false
        }
    },
    interactivity: {
        detect_on: 'canvas',
        events: {
            onhover: { enable: true, mode: 'grab' },
            onclick: { enable: true, mode: 'push' },
            resize: true
        },
        modes: {
            grab: { distance: 140, line_linked: { opacity: 0.5 } },
            push: { particles_nb: 4 }
        }
    },
    retina_detect: true
});

// Smooth Scroll
document.querySelectorAll('a[href^="#"]').forEach(anchor => {
    anchor.addEventListener('click', function (e) {
        e.preventDefault();
        const target = document.querySelector(this.getAttribute('href'));
        if (target) {
            target.scrollIntoView({ behavior: 'smooth', block: 'start' });
        }
    });
});

// Parallax Effect on Hero
window.addEventListener('scroll', () => {
    const scrolled = window.pageYOffset;
    const hero = document.querySelector('.section-hero');
    if (hero && scrolled < window.innerHeight) {
        hero.style.transform = `translateY(${scrolled * 0.5}px)`;
    }
});
</script>

<?php get_footer(); ?>