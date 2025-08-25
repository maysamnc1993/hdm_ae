<?php
// Retrieve ACF fields
$header_text = acf_get('hero_header_text');
$header_images = acf_get('hero_header_images');
$title = acf_get('hero_title');
$paragraph = acf_get('hero_paragraph');
$button_text = acf_get('hero_button_text');
$button_url = acf_get('hero_button_url');
$gradient_start = acf_get('hero_gradient_start', null, '#020024');
$gradient_middle = acf_get('hero_gradient_middle', null, '#090979');
$gradient_end = acf_get('hero_gradient_end', null, '#00D4FF');
$background_image = acf_get('hero_background_image');
$decorative_images = acf_get('hero_decorative_images');

// If no content is provided, don't display the section
if (!$header_text && !$header_images && !$title && !$paragraph && !$button_text && !$button_url && !$background_image && !$decorative_images) {
    return;
}
?>

<section class="hero container relative md:p-20">
    <div class="min-h-screen flex items-center justify-center">
        <div class="glass-effect w-full md:p-6 md:mx-4">
            <div class="relative">
                <div class="gradient-sec" style="background: linear-gradient(90deg, <?php echo esc_attr($gradient_start); ?> 0%, <?php echo esc_attr($gradient_middle); ?> 35%, <?php echo esc_attr($gradient_end); ?> 100%);"></div>
                <?php if ($background_image && !empty($background_image['url'])) : ?>
                    <img src="<?php echo esc_url($background_image['url']); ?>" alt="<?php echo esc_attr($background_image['alt'] ?? 'Background'); ?>" class="mix-blend-multiply max-w-xl mx-auto absolute inset-0">
                <?php endif; ?>
                <div class="content">
                    <!-- Header Section -->
                    <?php if ($header_text || $header_images) : ?>
                        <div class="flex flex-row items-center mb-8 border rounded-lg gap-2 max-w-fit w-full mx-auto md:py-1 md:px-2">
                            <?php if ($header_images && is_array($header_images)) : ?>
                                <div class="image-stack flex">
                                    <?php
                                    // Fallback images to match base code
                                    $fallback_images = [
                                        'https://framerusercontent.com/images/8QSV8713iAwFaGT6PSn3muGjb0.png?scale-down-to=512',
                                        'https://framerusercontent.com/images/9c6oP9UeeUMhCrtxCaarIn0Od0I.png?scale-down-to=512',
                                        'https://framerusercontent.com/images/IRBSRKfPdjJkMe2wneg5nPoI.png?scale-down-to=512'
                                    ];
                                    ?>
                                    <?php foreach ($header_images as $index => $image) : ?>
                                        <?php
                                        $image_data = $image['header_image'] ?? null;
                                        $image_classes = 'w-8 h-8 object-cover';
                                        if ($index !== 0) {
                                            $image_classes .= ' image-stack-masked';
                                        }
                                        // Use ACF image if available, otherwise fallback
                                        if ($image_data && is_array($image_data) && !empty($image_data['url'])) {
                                            echo '<img src="' . esc_url($image_data['url']) . '" alt="portrait ' . ($index + 1) . '" class="' . esc_attr($image_classes) . '" style="margin-right: -24px; z-index: ' . (10 - $index) . ';">';
                                        } elseif (isset($fallback_images[$index])) {
                                            echo '<img src="' . esc_url($fallback_images[$index]) . '" alt="portrait ' . ($index + 1) . '" class="' . esc_attr($image_classes) . '" style="margin-right: -24px; z-index: ' . (10 - $index) . ';">';
                                        }
                                        ?>
                                    <?php endforeach; ?>
                                </div>
                            <?php endif; ?>
                            <?php if ($header_text) : ?>
                                <div class="text-center md:text-right mt-4 md:mt-0">
                                    <p class="text-base text-white font-bold"><?php echo esc_html($header_text); ?></p>
                                </div>
                            <?php endif; ?>
                        </div>
                    <?php endif; ?>

                    <!-- Title Section -->
                    <?php if ($title) : ?>
                        <div class="text-center mb-6">
                            <h2 class="text-4xl md:text-5xl text-white font-bold leading-tight">
                                <?php echo esc_html($title); ?>
                            </h2>
                        </div>
                    <?php endif; ?>

                    <!-- Paragraph Section -->
                    <?php if ($paragraph) : ?>
                        <div class="text-center mb-8">
                            <p class="text-lg text-gray-300 max-w-2xl mx-auto">
                                <?php echo esc_html($paragraph); ?>
                            </p>
                        </div>
                    <?php endif; ?>

                    <!-- Button Section -->
                    <?php if ($button_text && $button_url) : ?>
                        <div class="text-center">
                            <a href="<?php echo esc_url($button_url); ?>" class="inline-block bg-gradient-to-b from-gray-800 to-gray-900 text-white px-6 py-3 rounded-xl hover:bg-gray-700 transition-all duration-300" target="_blank" rel="noopener">
                                <?php echo esc_html($button_text); ?>
                            </a>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>

    <?php
    // Decorative image positions to match base code
    $positions = [
        'top-40 left-20',
        'top-40 right-20',
        'bottom-40 left-20',
        'bottom-40 right-20'
    ];
    ?>
    <?php if ($decorative_images && is_array($decorative_images)) : ?>
        <?php foreach ($decorative_images as $index => $deco_image) : ?>
            <?php if (!empty($deco_image['decorative_image']['url'])) : ?>
                <img src="<?php echo esc_url($deco_image['decorative_image']['url']); ?>" alt="<?php echo esc_attr($deco_image['decorative_image']['alt'] ?? 'Decorative Image ' . ($index + 1)); ?>" class="max-w-[200px] mx-auto absolute decorative-image <?php echo esc_attr($positions[$index] ?? $deco_image['decorative_image_position'] ?? ''); ?>">
            <?php endif; ?>
        <?php endforeach; ?>
    <?php endif; ?>
</section>