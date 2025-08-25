<?php
// دریافت فیلدهای ACF
$header_tag = get_field('feature_benefit_header_tag');
$header_title = get_field('feature_benefit_header_title');
$header_description = get_field('feature_benefit_header_description');
$header_tag_color = get_field('feature_benefit_header_tag_color') ?: '#6B7280';
$header_title_color = get_field('feature_benefit_header_title_color') ?: '#1F2937';
$header_description_color = get_field('feature_benefit_header_description_color') ?: '#4B5563';
$stats = get_field('feature_benefit_stats');
$stats_border_color = get_field('feature_benefit_stats_border_color') ?: '#E5E7EB';
$skills = get_field('feature_benefit_skills');
$background_color = get_field('feature_benefit_background_color') ?: '#F9FAFB';

// اگر هیچ محتوایی وجود نداشته باشد، سکشن نمایش داده نشود
if (!$header_tag && !$header_title && !$header_description && !$stats && !$skills) {
    return;
}
?>

<section class="py-24 min-h-screen section-feature-benefit" style="background-color: <?php echo esc_attr($background_color); ?>;">
    <div class="container mx-auto px-6 lg:px-12 max-w-7xl">
        <div class="flex flex-col lg:flex-row justify-between gap-16 lg:gap-24">
            <!-- Left Column - Title Section -->
            <?php if ($header_tag || $header_title || $header_description || $stats) : ?>
                <div class="w-full lg:w-2/5 lg:pr-8 title-section sticky top-100px z-50">
                    <div class="space-y-8">
                        <?php if ($header_tag || $header_title || $header_description) : ?>
                            <div class="space-y-6">
                                <?php if ($header_tag) : ?>
                                    <span class="inline-block text-sm font-semibold tracking-widest uppercase" style="color: <?php echo esc_attr($header_tag_color); ?>;">
                                        <?php echo esc_html($header_tag); ?>
                                    </span>
                                <?php endif; ?>
                                <?php if ($header_title) : ?>
                                    <h2 class="text-4xl lg:text-5xl xl:text-6xl font-bold leading-tight" style="color: <?php echo esc_attr($header_title_color); ?>;">
                                        <?php echo esc_html($header_title); ?>
                                    </h2>
                                <?php endif; ?>
                                <?php if ($header_description) : ?>
                                    <p class="text-lg leading-relaxed max-w-lg" style="color: <?php echo esc_attr($header_description_color); ?>;">
                                        <?php echo esc_html($header_description); ?>
                                    </p>
                                <?php endif; ?>
                            </div>
                        <?php endif; ?>
                        <!-- Stats Section -->
                        <?php if ($stats) : ?>
                            <div class="flex gap-12 pt-8" style="border-top: 1px solid <?php echo esc_attr($stats_border_color); ?>;">
                                <?php foreach ($stats as $stat) : ?>
                                    <div>
                                        <?php if ($stat['stat_value']) : ?>
                                            <div class="text-3xl font-bold" style="color: <?php echo esc_attr($stat['stat_value_color'] ?: '#1F2937'); ?>;">
                                                <?php echo esc_html($stat['stat_value']); ?>
                                            </div>
                                        <?php endif; ?>
                                        <?php if ($stat['stat_label']) : ?>
                                            <div class="text-sm font-medium" style="color: <?php echo esc_attr($stat['stat_label_color'] ?: '#6B7280'); ?>;">
                                                <?php echo esc_html($stat['stat_label']); ?>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            <?php endif; ?>

            <!-- Right Column - Skills Column -->
            <?php if ($skills) : ?>
                <div class="w-full lg:w-3/5">
                    <div class="space-y-12 relative">
                        <?php foreach ($skills as $index => $skill) : ?>
                            <div style="--card-index: <?php echo $index; ?>;" class="skill-card rounded-2xl shadow-sm hover:shadow-md border sticky" style="background-color: <?php echo esc_attr($skill['skill_card_background_color'] ?: '#FFFFFF'); ?>; border-color: <?php echo esc_attr($skill['skill_card_border_color'] ?: '#F3F4F6'); ?>;">
                                <div class="p-8">
                                    <div class="flex items-start space-x-6">
                                        <div class="flex-shrink-0">
                                            <div class="w-16 h-16 rounded-xl flex items-center justify-center" style="background: linear-gradient(to bottom right, <?php echo esc_attr($skill['skill_icon_background_color'] ?: '#3B82F6'); ?>, <?php echo esc_attr($skill['skill_icon_background_color_end'] ?: '#1D4ED8'); ?>);">
                                                <?php if ($skill['skill_icon']) : ?>
                                                    <img src="<?php echo esc_url($skill['skill_icon']['url']); ?>" alt="<?php echo esc_attr($skill['skill_title']); ?>" class="w-8 h-8 object-contain" />
                                                <?php else : ?>
                                                    <svg class="w-8 h-8 text-white" fill="currentColor" viewBox="0 0 24 24">
                                                        <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 18c-4.42 0-8-3.58-8-8s3.58-8 8-8 8 3.58 8 8-3.58 8-8 8z" />
                                                    </svg>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                        <div class="flex-1 space-y-4">
                                            <div>
                                                <?php if ($skill['skill_title']) : ?>
                                                    <h3 class="text-2xl font-bold" style="color: <?php echo esc_attr($skill['skill_title_color'] ?: '#1F2937'); ?>;">
                                                        <?php echo esc_html($skill['skill_title']); ?>
                                                    </h3>
                                                <?php endif; ?>
                                                <?php if ($skill['skill_description']) : ?>
                                                    <span class="text font-medium" style="color: <?php echo esc_attr($skill['skill_description_color'] ?: '#6B7280'); ?>;">
                                                        <?php echo esc_html($skill['skill_description']); ?>
                                                    </span>
                                                <?php endif; ?>
                                            </div>
                                            <?php if ($skill['skill_progress']) : ?>
                                                <div class="space-y-3 relative">
                                                    <div class="progress-container w-full bg-gray-200 rounded-full h-3 relative">
                                                        <div class="progress-bar relative h-full rounded-full" style="--progress-width: <?php echo esc_attr($skill['skill_progress']); ?>%; background-color: <?php echo esc_attr($skill['skill_progress_bar_color'] ?: '#2563EB'); ?>;">
                                                            <span class="progress-badge absolute top-1/2 right-0 translate-x-full -translate-y-1/2 text-sm font-medium px-3.5 py-2 rounded-full" style="background-color: <?php echo esc_attr($skill['skill_progress_badge_color'] ?: '#2563EB'); ?>; color: <?php echo esc_attr($skill['skill_progress_badge_text_color'] ?: '#FFFFFF'); ?>;">
                                                                <?php echo esc_html($skill['skill_progress']); ?>%
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>
</section>