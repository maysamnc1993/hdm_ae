<?php
// Template Name: google ads

theme_scripts('googleAds');
get_header();
?>

<section class="container">
    <div class="min-h-screen flex items-center justify-center">
        <div class="glass-effect w-full p-6 mx-4">
            <div class="relative">
                <?php display_img('google-ads/bg-hero.avif') ?>
                <div class="radial-gradient-overlay" id="gradient-overlay"></div>
            </div>
            <div class="content">
                <!-- Header Section -->
                <div class="flex flex-col md:flex-row items-center justify-between mb-8">
                    <div class="image-stack flex space-x-4">
                        <div>
                            <img src="https://framerusercontent.com/images/8QSV8713iAwFaGT6PSn3muGjb0.png?scale-down-to=512" alt="portrait 1" class="w-16 h-16 object-cover">
                        </div>
                        <div class="transform -translate-x-1/2">
                            <img src="https://framerusercontent.com/images/9c6oP9UeeUMhCrtxCaarIn0Od0I.png?scale-down-to=512" alt="portrait 2" class="w-16 h-16 object-cover">
                        </div>
                        <div>
                            <img src="https://framerusercontent.com/images/IRBSRKfPdjJkMe2wneg5nPoI.png?scale-down-to=512" alt="portrait 3" class="w-16 h-16 object-cover">
                        </div>
                    </div>
                    <div class="text-center md:text-right mt-4 md:mt-0">
                        <p class="text-2xl text-white font-bold">10,000+</p>
                        <p class="text-lg text-gray-300">users with improved mental health</p>
                    </div>
                </div>

                <!-- Title Section -->
                <div class="text-center mb-6">
                    <h2 class="text-4xl md:text-5xl text-white font-bold leading-tight">
                        Ride your mind’s waves,<br>don’t drown in them.
                    </h2>
                </div>

                <!-- Paragraph Section -->
                <div class="text-center mb-8">
                    <p class="text-lg text-gray-300 max-w-2xl mx-auto">
                        Join thousands who've reduced anxiety by 67% and improved daily mood by 58% with our science-backed approach to mental wellness.
                    </p>
                </div>

                <!-- Button Section -->
                <div class="text-center">
                    <a href="https://framer.link/madebythanh" target="_blank" rel="noopener" class="inline-block bg-gradient-to-b from-gray-800 to-gray-900 text-white px-6 py-3 rounded-xl hover:bg-gray-700 transition-all duration-300">
                        Start Your Journey
                    </a>
                </div>
            </div>
        </div>
    </div>


</section>

<?php get_footer(); ?>