<?php
/**
 * Language Switcher for WordPress
 *
 * Provides a widget and utility functions for multilingual support,
 * with Polylang integration or a fallback URL parameter method.
 *
 * @package JTheme
 * @since 1.0.0
 */

declare(strict_types=1);

class JThem_Language_Handler {
    /**
     * Supported locales and their language codes.
     *
     * @var array<string, string>
     */
    private const LOCALE_MAP = [
        'fa_IR' => 'fa',
        'en_US' => 'en',
        'en_GB' => 'en',
        'ar_SA' => 'ar',
        'fr_FR' => 'fr',
        'de_DE' => 'de',
        'es_ES' => 'es',
    ];

    /**
     * Initialize the language handler.
     */
    public function __construct() {
        $this->register_hooks();
    }

    /**
     * Register all WordPress hooks.
     */
    private function register_hooks(): void {
        add_action('widgets_init', [$this, 'register_widget']);
        add_action('wp_head', [$this, 'add_language_meta']);
        add_filter('body_class', [$this, 'add_rtl_body_class']);
        add_filter('language_attributes', [$this, 'set_html_direction']);
        add_filter('locale', [$this, 'filter_locale']);
    }

    /**
     * Register the language switcher widget.
     */
    public function register_widget(): void {
        register_widget(JThem_Language_Switcher_Widget::class);
    }

    /**
     * Add language meta tag to the head.
     */
    public function add_language_meta(): void {
        $lang_code = $this->get_language_code();
        printf('<meta name="language" content="%s">' . PHP_EOL, esc_attr($lang_code));
    }

    /**
     * Add RTL class to body if applicable.
     *
     * @param array<string> $classes Existing body classes.
     * @return array<string> Updated body classes.
     */
    public function add_rtl_body_class(array $classes): array {
        if ($this->is_rtl_locale(get_locale())) {
            $classes[] = 'rtl';
        }
        return $classes;
    }

    /**
     * Set HTML direction attribute based on locale.
     *
     * @param string $output Current language attributes.
     * @return string Updated language attributes.
     */
    public function set_html_direction(string $output): string {
        $direction = $this->is_rtl_locale(get_locale()) ? 'rtl' : 'ltr';
        return str_replace('<html', sprintf('<html dir="%s"', $direction), $output);
    }

    /**
     * Filter locale based on URL parameter if Polylang is not active.
     *
     * @param string $locale Current locale.
     * @return string Filtered locale.
     */
    public function filter_locale(string $locale): string {
        if (function_exists('pll_current_language')) {
            return $locale; // Let Polylang handle it.
        }

        $lang = filter_input(INPUT_GET, 'lang', FILTER_SANITIZE_SPECIAL_CHARS);
        if ($lang === 'fa') {
            return 'fa_IR';
        } elseif ($lang === 'en') {
            return 'en_US';
        }

        return $locale;
    }

    /**
     * Get the language code from a locale.
     *
     * @param string $locale Locale to convert (optional, defaults to current).
     * @return string Language code.
     */
    public function get_language_code(string $locale = ''): string {
        $locale = $locale ?: get_locale();
        return self::LOCALE_MAP[$locale] ?? substr($locale, 0, 2);
    }

    /**
     * Check if a locale is RTL.
     *
     * @param string $locale Locale to check.
     * @return bool True if RTL, false otherwise.
     */
    private function is_rtl_locale(string $locale): bool {
        return $locale === 'fa_IR'; // Add more RTL locales as needed.
    }
}

/**
 * Language Switcher Widget
 */
class JThem_Language_Switcher_Widget extends WP_Widget {
    /**
     * Initialize the widget.
     */
    public function __construct() {
        parent::__construct(
            'jthem_language_switcher',
            esc_html__('Language Switcher', 'JTheme'),
            ['description' => esc_html__('Switch between available languages', 'JTheme')]
        );
    }

    /**
     * Render the widget frontend.
     *
     * @param array<string, mixed> $args Widget arguments.
     * @param array<string, mixed> $instance Widget instance settings.
     */
    public function widget($args, $instance): void {
        echo $args['before_widget'];

        if (!empty($instance['title'])) {
            echo $args['before_title'] . apply_filters('widget_title', $instance['title']) . $args['after_title'];
        }

        echo '<div class="language-switcher flex flex-col space-y-2">';
        $this->render_language_links();
        echo '</div>';

        echo $args['after_widget'];
    }

    /**
     * Render language links based on Polylang or fallback.
     */
    private function render_language_links(): void {
        if (function_exists('pll_the_languages') && function_exists('pll_current_language')) {
            $this->render_polylang_links();
        } else {
            $this->render_fallback_links();
        }
    }

    /**
     * Render links using Polylang.
     */
    private function render_polylang_links(): void {
        $current_lang = pll_current_language();
        $languages = pll_the_languages(['raw' => 1]);

        foreach ($languages as $lang_code => $language) {
            $is_active = $current_lang === $lang_code;
            $classes = $is_active ? 'font-bold text-blue-600' : 'text-gray-600 hover:text-blue-600';
            $spacing = is_rtl() ? 'ml-2' : 'mr-2';

            printf(
                '<a href="%s" class="%s transition"><span class="inline-flex items-center"><span class="%s">%s</span>%s</span></a>',
                esc_url($language['url']),
                esc_attr($classes),
                esc_attr($spacing),
                esc_html($language['name']),
                $is_active ? $this->get_checkmark_svg() : ''
            );
        }
    }

    /**
     * Render fallback links using URL parameters.
     */
    private function render_fallback_links(): void {
        $current_url = home_url(add_query_arg([], $GLOBALS['wp_the_query']->get_queried_object()));
        $is_persian = get_locale() === 'fa_IR';
        $spacing = is_rtl() ? 'ml-2' : 'mr-2';

        // Persian link
        $persian_classes = $is_persian ? 'font-bold text-blue-600' : 'text-gray-600 hover:text-blue-600';
        printf(
            '<a href="%s" class="%s transition"><span class="inline-flex items-center"><span class="%s">%s</span>%s</span></a>',
            esc_url(add_query_arg('lang', 'fa', $current_url)),
            esc_attr($persian_classes),
            esc_attr($spacing),
            esc_html__('فارسی', 'JTheme'),
            $is_persian ? $this->get_checkmark_svg() : ''
        );

        // English link
        $english_classes = !$is_persian ? 'font-bold text-blue-600' : 'text-gray-600 hover:text-blue-600';
        printf(
            '<a href="%s" class="%s transition"><span class="inline-flex items-center"><span class="%s">%s</span>%s</span></a>',
            esc_url(add_query_arg('lang', 'en', $current_url)),
            esc_attr($english_classes),
            esc_attr($spacing),
            esc_html__('English', 'JTheme'),
            !$is_persian ? $this->get_checkmark_svg() : ''
        );
    }

    /**
     * Get the checkmark SVG HTML.
     *
     * @return string SVG markup.
     */
    private function get_checkmark_svg(): string {
        return '<svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" /></svg>';
    }

    /**
     * Render the widget form in the admin.
     *
     * @param array<string, mixed> $instance Current instance settings.
     */
    public function form($instance): void {
        $title = !empty($instance['title']) ? $instance['title'] : esc_html__('Languages', 'JTheme');
        ?>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('title')); ?>">
                <?php esc_html_e('Title:', 'JTheme'); ?>
            </label>
            <input class="widefat" 
                   id="<?php echo esc_attr($this->get_field_id('title')); ?>" 
                   name="<?php echo esc_attr($this->get_field_name('title')); ?>" 
                   type="text" 
                   value="<?php echo esc_attr($title); ?>">
        </p>
        <?php if (!function_exists('pll_the_languages')) : ?>
            <p class="description">
                <?php esc_html_e('For better multilingual support, install and activate the Polylang plugin.', 'JTheme'); ?>
            </p>
        <?php endif; ?>
        <?php
    }

    /**
     * Sanitize widget form values before saving.
     *
     * @param array<string, mixed> $new_instance New values.
     * @param array<string, mixed> $old_instance Old values.
     * @return array<string, mixed> Sanitized values.
     */
    public function update($new_instance, $old_instance): array {
        return [
            'title' => !empty($new_instance['title']) ? sanitize_text_field($new_instance['title']) : '',
        ];
    }
}

// Instantiate the language handler.
new JThem_Language_Handler();