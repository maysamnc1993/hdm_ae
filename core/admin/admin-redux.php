<?php
// Check if Redux exists and is activated
if (!class_exists('Redux')) {
    return;
}

// Define the option name for Redux
$opt_name = "jtheme_options";

// Add initialization hook
add_action('after_setup_theme', function () use ($opt_name) {
    Redux::set_args($opt_name, [
        'opt_name' => $opt_name,
        'display_name' => __('تنظیمات سایت', 'jtheme'),
        'display_version' => '1.0.0',
        'menu_type' => 'menu',
        'allow_sub_menu' => true,
        'menu_title' => __('تنظیمات سایت', 'jtheme'),
        'page_title' => __('تنظیمات سایت', 'jtheme'),
        'admin_bar' => true,
        'admin_bar_icon' => 'dashicons-admin-generic',
        'menu_icon' => 'dashicons-admin-generic',
        'page_priority' => 2,
        'page_permissions' => 'manage_options',
        'save_defaults' => true,
        'show_import_export' => true,
    ]);

    // تنظیمات عمومی
    Redux::set_section($opt_name, [
        'title' => __('تنظیمات عمومی', 'jtheme'),
        'id' => 'general_settings',
        'icon' => 'el el-cog',
        'fields' => [
            [
                'id' => 'arv_site_logo',
                'type' => 'media',
                'title' => __('انتخاب لوگو', 'jtheme'),
                'default' => '',
                'mode' => false
            ],
            [
                'id' => 'arv_facebook_url',
                'type' => 'text',
                'title' => __('صفحه فیس‌بوک', 'jtheme'),
                'default' => '',
            ],
            [
                'id' => 'arv_telegram_url',
                'type' => 'text',
                'title' => __('صفحه تلگرام', 'jtheme'),
                'default' => '',
            ],
            [
                'id' => 'arv_linkedin_url',
                'type' => 'text',
                'title' => __('صفحه لینکدین', 'jtheme'),
                'default' => '',
            ],
            [
                'id' => 'arv_instagram_url',
                'type' => 'text',
                'title' => __('صفحه اینستاگرام', 'jtheme'),
                'default' => '',
            ],
            [
                'id' => 'arv_whatsapp_url',
                'type' => 'text',
                'title' => __('لینک واتساپ', 'jtheme'),
                'default' => '',
            ],
            [
                'id' => 'arv_twitter_url',
                'type' => 'text',
                'title' => __('صفحه توییتر', 'jtheme'),
                'default' => '',
            ],
            [
                'id' => 'arv_youtube_url',
                'type' => 'text',
                'title' => __('کانال یوتیوب', 'jtheme'),
                'default' => '',
            ],
            [
                'id' => 'free_consulting_url',
                'type' => 'text',
                'title' => __('لینک مشاوره رایگان', 'jtheme'),
                'default' => '',
            ],
            [
                'id' => 'free_consulting_text',
                'type' => 'text',
                'title' => __('متن مشاوره رایگان', 'jtheme'),
                'default' => '',
            ],
        ],
    ]);
    // تنظیمات هدر
    Redux::set_section($opt_name, [
        'title' => __('تنظیمات هدر', 'jtheme'),
        'id' => 'header_settings',
        'icon' => 'el el-cog',
        'fields' => [
            [
                'id' => 'header_logo',
                'type' => 'media',
                'title' => __('لوگوی سایت', 'jtheme'),
                'default' => '',
            ],
            [
                'id' => 'header_app_download_link',
                'type' => 'text',
                'title' => __('لینک دانلود اپلیکیشن', 'jtheme'),
                'default' => esc_url(home_url('/app-download')),
            ],
            [
                'id' => 'header_customer_club_link',
                'type' => 'text',
                'title' => __('لینک باشگاه مشتریان', 'jtheme'),
                'default' => esc_url(home_url('/customer-club')),
            ],
            [
                'id' => 'header_portals_link',
                'type' => 'text',
                'title' => __('لینک پورتال‌ها', 'jtheme'),
                'default' => esc_url(home_url('/portals')),
            ],
            [
                'id' => 'header_consultation_link',
                'type' => 'text',
                'title' => __('لینک مشاوره خرید بیمه', 'jtheme'),
                'default' => esc_url(home_url('/consultation')),
            ],
        ],
    ]);
    // تنظیمات فوتر
    Redux::set_section($opt_name, [
        'title' => __('تنظیمات فوتر', 'jtheme'),
        'id' => 'footer_settings',
        'icon' => 'el el-cog',
        'fields' => [
            [
                'id' => 'footer_phone',
                'type' => 'text',
                'title' => __('تلفن', 'jtheme'),
                'default' => '۰۲۱ - ۸۹۶۳',
            ],
            [
                'id' => 'footer_email_customer',
                'type' => 'text',
                'title' => __('ایمیل امور مشتریان', 'jtheme'),
                'default' => 'complainsaman@insurance.ir',
            ],
            [
                'id' => 'footer_email_general',
                'type' => 'text',
                'title' => __('ایمیل عمومی', 'jtheme'),
                'default' => 'mailroom@samaninsurance.ir',
            ],
            [
                'id' => 'footer_design_credit',
                'type' => 'textarea',
                'title' => __('طراحی شده توسط', 'jtheme'),
                'default' => 'طراحی شده توسط آژانس دیجیتال مارکتینگ HDM',
            ],
            [
                'id' => 'footer_rights',
                'type' => 'textarea',
                'title' => __('حقوق مادی و محتوای وبسایت', 'jtheme'),
                'default' => 'تمامی حقوق مادی و محتوای این وبسایت، متعلق به بیمه سامان می‌باشد.',
            ],
        ],
    ]);

    // تنظیمات صفحه اصلی
    Redux::set_section($opt_name, [
        'title' => __('تنظیمات صفحه اصلی', 'jtheme'),
        'id' => 'home_settings',
        'icon' => 'el el-cog',
        'fields' => array(
            array(
                'id' => 'home_slider',
                'type' => 'repeater',
                'item_name' => __('اسلاید', 'jtheme'),
                'group_values' => true,
                'title' => __('اسلایدر صفحه اصلی', 'jtheme'),
                'default' => '',
                'fields' => array(
                    array(
                        'id' => 'slide_image',
                        'type' => 'media',
                        'title' => __('تصویر اسلاید', 'jtheme'),
                    ),
                    array(
                        'id' => 'slide_image_mobile',
                        'type' => 'media',
                        'title' => __('تصویر اسلاید موبایل', 'jtheme'),
                    ),
                    array(
                        'id' => 'slide_title',
                        'type' => 'text',
                        'title' => __('عنوان اسلاید', 'jtheme'),
                    ),

                )
            ),
            array(
                'id' => 'services_cards_repeater',
                'type' => 'repeater',
                'group_values' => true,
                'title' => __('مدیریت کارت های سرویس', 'jtheme'),
                'subtitle' => __('اضافه کردن کارت های سرویس با آیکن، عنوان و لینک.', 'jtheme'),
                'item_name' => __('کارت سرویس', 'jtheme'),
                'fields' => array(
                    array(
                        'id' => 'card_icon_svg',
                        'type' => 'media',
                        'url' => true,
                        'title' => __('آیکن SVG آپلود', 'jtheme'),
                        'compiler' => 'true',
                        'subtitle' => __('آپلود فایل SVG برای آیکن سرویس.', 'jtheme'),
                    ),
                    array(
                        'id' => 'card_title',
                        'type' => 'text',
                        'title' => __('عنوان سرویس', 'jtheme'),
                    ),
                    array(
                        'id' => 'card_link',
                        'type' => 'text',
                        'title' => __('لینک سرویس', 'jtheme'),
                    ),
                )
            ),
            array(
                'id' => 'services_cards_link',
                'type' => 'text',
                'title' => __(' لینک صفحه سرویس ها', 'jtheme'),
            ),
            array(
                'id' => 'services_cards_link_text',
                'type' => 'text',
                'title' => __('متن لینک صفحه سرویس ها', 'jtheme'),
            ),
            array(
                'id' => 'testimonial_title',
                'type' => 'text',
                'title' => __('عنوان نظرات', 'jtheme'),
                'default' => __('تجربه‌هایی از مشتریان سامان', 'jtheme'),
            ),
            array(
                'id' => 'testimonial_repeater',
                'type' => 'repeater',
                'group_values' => true,
                'title' => __('مدیریت نظرات', 'jtheme'),
                'subtitle' => __('اضافه کردن نظرات با آیکن، عنوان و لینک.', 'jtheme'),
                'item_name' => __('نظرات', 'jtheme'),
                'fields' => array(
                    array(
                        'id' => 'testimonial_image',
                        'type' => 'media',
                        'url' => true,
                        'title' => __('تصویر نظرات', 'jtheme'),
                        'compiler' => 'true',
                        'subtitle' => __('آپلود فایل تصویر برای نظرات.', 'jtheme'),
                    ),
                    array(
                        'id' => 'testimonial_name',
                        'type' => 'text',
                        'title' => __('نام نظر دهنده', 'jtheme'),
                    ),
                    array(
                        'id' => 'testimonial_comment',
                        'type' => 'textarea',
                        'title' => __('نظر نظرات', 'jtheme'),
                    ),
                    array(
                        'id' => 'testimonial_date',
                        'type' => 'text',
                        'title' => __('تاریخ نظرات', 'jtheme'),
                    ),
                    array(
                        'id' => 'testimonial_category',
                        'type' => 'text',
                        'title' => __('دسته بندی نظرات', 'jtheme'),
                    ),

                )
            ),
            array(
                'id' => 'category_title',
                'type' => 'text',
                'title' => __('عنوان دسته بندی ها', 'jtheme'),
                'default' => __('خدمات الکترونیک', 'jtheme'),
            ),
            array(
                'id' => 'category_cards_repeater',
                'type' => 'repeater',
                'group_values' => true,
                'title' => __('مدیریت کارت های دسته بندی', 'jtheme'),
                'subtitle' => __('اضافه کردن کارت های دسته بندی با آیکن، عنوان و لینک.', 'jtheme'),
                'item_name' => __('کارت دسته بندی', 'jtheme'),
                'fields' => array(
                    array(
                        'id' => 'category_image',
                        'type' => 'media',
                        'url' => true,
                        'title' => __('تصویر کارت دسته بندی', 'jtheme'),
                        'compiler' => 'true',
                        'subtitle' => __('آپلود فایل تصویر برای کارت دسته بندی.', 'jtheme'),
                    ),
                    array(
                        'id' => 'category_title',
                        'type' => 'text',
                        'title' => __('عنوان کارت دسته بندی', 'jtheme'),
                    ),
                    array(
                        'id' => 'category_link',
                        'type' => 'text',
                        'title' => __('لینک صفحه دسته بندی', 'jtheme'),
                    ),
                )
            ),
            [
                'id' => 'partners_repeater',
                'type' => 'repeater',
                'group_values' => true,
                'title' => __('مدیریت شرکای تجاری', 'jtheme'),
                'item_name' => __('شریک تجاری', 'jtheme'),
                'fields' => [
                    [
                        'id' => 'partner_image',
                        'type' => 'media',
                        'title' => __('تصویر شریک', 'jtheme'),
                    ],
                    [
                        'id' => 'partner_link',
                        'type' => 'text',
                        'title' => __('لینک شریک', 'jtheme'),
                    ],
                ],
            ],
            // About Section Settings
            array(
                'id' => 'about_title',
                'type' => 'text',
                'title' => __('عنوان بخش درباره ما', 'jtheme'),
                'default' => __('درباره بیمه سامان', 'jtheme'),
            ),
            array(
                'id' => 'about_description',
                'type' => 'textarea',
                'title' => __('توضیحات بخش درباره ما', 'jtheme'),
                'default' => __('کادر کارشناسی بیمه سامان با دارا بودن تحصیلات دانشگاهی و آشنایی کامل با صنعت بیمه، زیر نظر مدیران با تجربه، سعی در حفظ منافع بیمه‌گزاران داشته و با ارائه مشاوره در زمینه مدیریت ریسک، از بروز خسارات احتمالی پیشگیری می‌کنند.', 'jtheme'),
            ),
            array(
                'id' => 'about_video_thumbnail',
                'type' => 'media',
                'url' => true,
                'title' => __(' ویدیو درباره ما', 'jtheme'),
                'subtitle' => __(' پیش نمایش ویدیو', 'jtheme'),
            ),
            array(
                'id' => 'about_video_url',
                'type' => 'text',
                'title' => __('آدرس ویدیو درباره ما', 'jtheme'),
                'subtitle' => __('آدرس ویدیو MP4 برای پخش در مودال', 'jtheme'),
                'desc' => __('آدرس ویدیو را وارد کنید (mp4, webm)', 'jtheme'),
            ),
            array(
                'id' => 'about_stats',
                'type' => 'repeater',
                'group_values' => true,
                'title' => __('آمار و ارقام', 'jtheme'),
                'item_name' => __('آمار', 'jtheme'),
                'fields' => array(
                    array(
                        'id' => 'stat_number',
                        'type' => 'text',
                        'title' => __('عدد', 'jtheme'),
                    ),
                    array(
                        'id' => 'stat_title',
                        'type' => 'text',
                        'title' => __('عنوان', 'jtheme'),
                    ),
                ),
                'default' => array(
                    array(
                        'stat_number' => '+۵۵۰۰۰',
                        'stat_title' => 'بیمه‌شدگان بیمه عمر',
                    ),
                    array(
                        'stat_number' => '+۷۵۴',
                        'stat_title' => 'بیمه‌شدگان بیمه اتومبیل',
                    ),
                    array(
                        'stat_number' => '+۱۰۰۰۰۰',
                        'stat_title' => 'بیمه‌شدگان بیمه مسئولیت',
                    ),
                )
            ),
            array(
                'id' => 'about_features',
                'type' => 'repeater',
                'group_values' => true,
                'title' => __('ویژگی های ما', 'jtheme'),
                'item_name' => __('ویژگی', 'jtheme'),
                'fields' => array(
                    array(
                        'id' => 'feature_icon',
                        'type' => 'media',
                        'url' => true,
                        'title' => __('آیکون ویژگی', 'jtheme'),
                    ),
                    array(
                        'id' => 'feature_title',
                        'type' => 'text',
                        'title' => __('عنوان ویژگی', 'jtheme'),
                    ),
                ),
                'default' => array(
                    array(
                        'feature_title' => 'صدور آنلاین بیمه',
                        'feature_icon' => 'about-icons.svg',
                    )
                )
            ),

            [
                'id' => 'application_title',
                'type' => 'text',
                'title' => __('عنوان بخش اپلیکیشن', 'jtheme'),
                'default' => __('اپلیکیشن بیمه سامان', 'jtheme'),
            ],
            [
                'id' => 'application_description',
                'type' => 'textarea',
                'title' => __('توضیحات اپلیکیشن', 'jtheme'),
                'default' => __('با اپلیکیشن بیمه سامان، تجربه‌ای جدید از مدیریت بیمه‌های خود را در دستانتان خواهید داشت. این اپلیکیشن به شما امکان می‌دهد به راحتی و در هر زمان و مکانی به تمامی خدمات بیمه‌ای خود دسترسی پیدا کنید. از اطلاع‌رسانی‌های لحظه‌ای گرفته تا پیگیری وضعیت بیمه‌ها و درخواست خدمات، همه چیز به شکلی ساده و سریع در دسترس شماست. با دانلود این اپلیکیشن، تمامی نیازهای بیمه‌ای خود را تنها با چند لمس پاسخ دهید.', 'jtheme'),
            ],
            [
                'id' => 'application_btn_text',
                'type' => 'text',
                'title' => __('متن دکمه اپلیکیشن', 'jtheme'),
                'default' => __('دانلود اپلیکیشن', 'jtheme'),
            ],
            [
                'id' => 'application_btn_link',
                'type' => 'text',
                'title' => __('لینک دانلود اپلیکیشن', 'jtheme'),
                'default' => '#',
            ],
            [
                'id' => 'application_image',
                'type' => 'media',
                'url' => true,
                'title' => __('تصویر بخش اپلیکیشن', 'jtheme'),
                'compiler' => 'true',
                'default' => get_template_directory() . "/src/images/application.png",
            ],
            
            [
                'id' => 'contact_section_visibility',
                'type' => 'switch',
                'title' => __('نمایش بخش تماس با ما', 'jtheme'),
                'default' => true,
            ],
            [
                'id' => 'contact_address',
                'type' => 'textarea',
                'title' => __('آدرس', 'jtheme'),
                'default' => __('ساختمان مرکزی: تهران، خیابان نلسون ماندلا (آفریقا)، نبش خیابان مریم، برج بیمه شماره ۲، طبقه ۱۴', 'jtheme'),
            ],
            [
                'id' => 'contact_phone_1',
                'type' => 'text',
                'title' => __('تلفن 1', 'jtheme'),
                'default' => '۲۶۲۱۴۹۰۴ - ۲۴۵۵۱۰۰۰ داخلی ۱۸۱ - ۱۸۲',
            ],
            [
                'id' => 'contact_phone_2',
                'type' => 'text',
                'title' => __('تلفن 2', 'jtheme'),
                'default' => '۶۱۳۶۱ - ۰۲۱',
            ],
            [
                'id' => 'contact_phone_3',
                'type' => 'text',
                'title' => __('تلفن 3', 'jtheme'),
                'default' => '۶۱۳۶۲۴۲۹',
            ],
            [
                'id' => 'contact_complaint_system',
                'type' => 'text',
                'title' => __('سامانه رسیدگی به شکایات', 'jtheme'),
                'default' => 'سامانه رسیدگی به شکایات و اعلامات:',
            ],
            [
                'id' => 'contact_background_image',
                'type' => 'media',
                'url' => true,
                'title' => __('تصویر پس‌زمینه بخش تماس با ما', 'jtheme'),
                'compiler' => 'true',
                'default' => '',
            ],
            [
                'id' => 'contact_image',
                'type' => 'media',
                'url' => true,
                'title' => __('تصویر بخش تماس با ما', 'jtheme'),
                'compiler' => 'true',
                'default' => '',
            ],

        ),

    ]);

    Redux::set_section($opt_name, [
        'title' => __('تنظیمات صفحه اپلیکیشن', 'jtheme'),
        'id' => 'app_page_settings',
        'icon' => 'el el-mobile',
        'fields' => [
            // Main Section: Title, Description, and Button Texts
            [
                'id' => 'app_main_title',
                'type' => 'text',
                'title' => __('عنوان اصلی', 'jtheme'),
                'default' => 'دانلود اپلیکیشن',
            ],
            [
                'id' => 'app_main_description',
                'type' => 'textarea',
                'title' => __('توضیحات اصلی', 'jtheme'),
                'default' => 'تصور کنید همه امور بیمه‌ای خود را به سادگی و در عرض چند دقیقه، بدون نیاز به مراجعه حضوری یا انتظارهای طولانی از طریق گوشی‌تان انجام دهید. در دنیای پرشتاب امروز که هر لحظه اهمیت دارد، چرا باید برای پیگیری بیمه‌نامه‌ها وقت زیادی از دست بدهید؟ با دانلود اپلیکیشن بیمه سامان، ضمن استفاده از خدمات بیمه‌ای، می‌توانید از تخفیف‌ها و خدمات ویژه بهره‌مند شوید و همه‌چیز را در دست خود داشته باشید.',
            ],
            // Download Buttons: Links and Texts
            [
                'id' => 'app_pwa_link',
                'type' => 'text',
                'title' => __('لینک PWA', 'jtheme'),
                'default' => '#',
            ],
            [
                'id' => 'app_pwa_text',
                'type' => 'text',
                'title' => __('متن دکمه PWA', 'jtheme'),
                'default' => 'PWA نسخه تحت وب',
            ],
            [
                'id' => 'app_sibapp_link',
                'type' => 'text',
                'title' => __('لینک سیب اپ', 'jtheme'),
                'default' => '#',
            ],
            [
                'id' => 'app_sibapp_text',
                'type' => 'text',
                'title' => __('متن دکمه سیب اپ', 'jtheme'),
                'default' => 'دانلود از سیب اپ',
            ],
            [
                'id' => 'app_myket_link',
                'type' => 'text',
                'title' => __('لینک مایکت', 'jtheme'),
                'default' => '#',
            ],
            [
                'id' => 'app_myket_text',
                'type' => 'text',
                'title' => __('متن دکمه مایکت', 'jtheme'),
                'default' => 'دانلود از مایکت',
            ],
            [
                'id' => 'app_bazaar_link',
                'type' => 'text',
                'title' => __('لینک بازار', 'jtheme'),
                'default' => '#',
            ],
            [
                'id' => 'app_bazaar_text',
                'type' => 'text',
                'title' => __('متن دکمه بازار', 'jtheme'),
                'default' => 'دانلود از بازار',
            ],
            // Phone Mockup Video
            [
                'id' => 'app_mockup_video',
                'type' => 'media',
                'title' => __('ویدیو ماکاپ', 'jtheme'),
                'library_filter' => ['video/mp4'],
                'default' => ['url' => get_template_directory_uri() . '/assets/videos/mockup.mp4'],
            ],
            [
                'id' => 'app_mockup_poster',
                'type' => 'media',
                'title' => __('پوستر ویدیوی ماکاپ', 'jtheme'),
                'default' => ['url' => get_theme_img('mockup.png')],
            ],
            // Why the App Section: Repeater for Benefits
            [
                'id' => 'app_benefits',
                'type' => 'repeater',
                'group_values' => true,
                'title' => __('مزایای اپلیکیشن', 'jtheme'),
                'fields' => [
                    [
                        'id' => 'icon',
                        'type' => 'media',
                        'title' => __('آیکون', 'jtheme'),
                    ],
                    [
                        'id' => 'title',
                        'type' => 'text',
                        'title' => __('عنوان', 'jtheme'),
                        'default' => 'مدیریت سریع و آسان بیمه‌نامه‌ها',
                    ],
                    [
                        'id' => 'link',
                        'type' => 'text',
                        'title' => __('لینک', 'jtheme'),
                        'default' => '#',
                    ],
                ],
                'default' => [
                    ['title' => 'مدیریت سریع و آسان بیمه‌نامه‌ها', 'link' => '#', 'icon' => ['url' => get_theme_img('icon-analytics.png')]],
                    ['title' => 'مدیریت سریع و آسان بیمه‌نامه‌ها', 'link' => '#', 'icon' => ['url' => get_theme_img('icon-analytics.png')]],
                    ['title' => 'مدیریت سریع و آسان بیمه‌نامه‌ها', 'link' => '#', 'icon' => ['url' => get_theme_img('icon-analytics.png')]],
                    ['title' => 'مدیریت سریع و آسان بیمه‌نامه‌ها', 'link' => '#', 'icon' => ['url' => get_theme_img('icon-analytics.png')]],
                    ['title' => 'مدیریت سریع و آسان بیمه‌نامه‌ها', 'link' => '#', 'icon' => ['url' => get_theme_img('icon-analytics.png')]],
                    ['title' => 'مدیریت سریع و آسان بیمه‌نامه‌ها', 'link' => '#', 'icon' => ['url' => get_theme_img('icon-analytics.png')]],
                ],
            ],
            // About Application Section: Benefits List
            [
                'id' => 'app_benefits_list_title',
                'type' => 'text',
                'title' => __('عنوان لیست مزایا', 'jtheme'),
                'default' => 'مزایای استفاده از اپلیکیشن بیمه سامان',
            ],
            [
                'id' => 'app_benefits_list',
                'type' => 'editor',
                'title' => __('لیست مزایا', 'jtheme'),
                'default' => '<p>مدیریت سریع و آسان بیمه‌نامه‌ها: بدون نیاز به جستجو در کاغذها و اسناد، به راحتی می‌توانید در قسمت بیمه‌های من تمامی بیمه‌نامه‌های خود را مشاهده کنید و از جزئیات آن‌ها مطلع شوید.</p>' .
                    '<p>ثبت و پیگیری خسارت‌ها به‌صورت آنلاین: در صورتی که با خسارتی روبرو شدید، تنها کافی است درخواست خود را در قسمت خسارت‌ها ثبت کنید و از طریق اپلیکیشن پیگیر وضعیت آن باشید. دیگر نیازی به مراجعه حضوری نیست.</p>' .
                    '<p>دسترسی به وضعیت بیمه‌نامه‌ها: هیچ وقت لازم نیست نگران تاریخ تمدید یا تغییرات وضعیت بیمه‌نامه‌تان باشید. همیشه از آخرین وضعیت بیمه‌نامه‌ها و مراحل تسویه خسارت آگاه خواهید بود.</p>' .
                    '<p>خرید آنلاین انواع بیمه‌ها: با دانلود اپلیکیشن بیمه سامان، از بیمه خودرو تا بیمه درمانی و مسافرتی، می‌توانید انواع آن‌ها را به‌صورت آنلاین و فقط با چند کلیک ساده خریداری کنید.</p>' .
                    '<p>باشگاه مشتریان و تخفیف‌های ویژه: عضویت در باشگاه مشتریان بیمه سامان به شما این امکان را می‌دهد که از تخفیف‌ها و امتیازات ویژه برخوردار شوید و در هزینه‌های خود صرفه‌جویی کنید.</p>' .
                    '<p>کیف پول دیجیتال: پرداخت‌های خود را به راحتی انجام دهید و از قابلیت شارژ خودکار کیف پول برای امور مالی و پرداخت‌ها بهره‌مند شوید.</p>',
            ],
            // Video Slider Section
            [
                'id' => 'app_video_slider_title',
                'type' => 'text',
                'title' => __('عنوان اسلایدر ویدیویی', 'jtheme'),
                'default' => 'راهنمای استفاده از اپلیکیشن بیمه سامان',
            ],
            [
                'id' => 'app_video_slider_description',
                'type' => 'textarea',
                'title' => __('توضیحات اسلایدر ویدیویی', 'jtheme'),
                'default' => 'پس از دانلود اپلیکیشن بیمه سامان و شروع استفاده، کافی است وارد بخش راهنمای برنامه شوید...',
            ],
            [
                'id' => 'app_video_slides',
                'type' => 'repeater',
                'group_values' => true,
                'title' => __('اسلایدهای ویدیویی', 'jtheme'),
                'fields' => [
                    [
                        'id' => 'video',
                        'type' => 'media',
                        'title' => __('فایل ویدیویی', 'jtheme'),
                        'library_filter' => ['video/mp4'],
                    ],
                    [
                        'id' => 'poster',
                        'type' => 'media',
                        'title' => __('پوستر ویدیو', 'jtheme'),
                    ],
                    [
                        'id' => 'title',
                        'type' => 'text',
                        'title' => __('عنوان', 'jtheme'),
                    ],
                    [
                        'id' => 'description',
                        'type' => 'text',
                        'title' => __('توضیحات', 'jtheme'),
                    ],
                ],
                'default' => [
                    [
                        'title' => 'مرحله اول:',
                        'description' => 'وارد برنامه شوید و ثبت‌نام کنید.',
                        'poster' => ['url' => get_theme_img('application-slider.png')],
                        'video' => ['url' => get_template_directory_uri() . '/assets/videos/app-step-1.mp4'],
                    ],
                    [
                        'title' => 'مرحله دوم:',
                        'description' => 'اطلاعات خود را وارد کنید.',
                        'poster' => ['url' => get_theme_img('application-slider.png')],
                        'video' => ['url' => get_template_directory_uri() . '/assets/videos/app-step-2.mp4'],
                    ],
                    [
                        'title' => 'مرحله سوم:',
                        'description' => 'بیمه مورد نظر خود را انتخاب کنید.',
                        'poster' => ['url' => get_theme_img('application-slider.png')],
                        'video' => ['url' => get_template_directory_uri() . '/assets/videos/app-step-3.mp4'],
                    ],
                ],
            ],
            // Download Button
            [
                'id' => 'app_download_button_link',
                'type' => 'text',
                'title' => __('لینک دکمه دانلود', 'jtheme'),
                'default' => '#',
            ],
            [
                'id' => 'app_download_button_text',
                'type' => 'text',
                'title' => __('متن دکمه دانلود', 'jtheme'),
                'default' => 'دانلود اپلیکیشن',
            ],
        ],
    ]);


    // تنظیمات صفحه تماس با ما
    Redux::setSection($opt_name, array(
        'title' => 'تماس با ما',
        'id' => 'contact_page',
        'icon' => 'el el-home',
        'desc' => 'تنظیمات صفحه تماس با ما',
        'fields' => array(
            // Page title
            array(
                'id' => 'contact_page_title',
                'type' => 'text',
                'title' => 'عنوان صفحه',
                'subtitle' => 'عنوان اصلی صفحه تماس با ما',
                'default' => 'تماس با ما',
            ),

            // Contact cards section divider
            array(
                'id' => 'contact_info_divider',
                'type' => 'section',
                'title' => 'راه‌های ارتباطی',
                'subtitle' => 'اطلاعات تماس شرکت بیمه سامان',
                'indent' => false,
            ),

            // Contact info section title
            array(
                'id' => 'contact_info_title',
                'type' => 'text',
                'title' => 'عنوان بخش راه‌های ارتباطی',
                'default' => 'راه‌های ارتباطی',
            ),

            // Email Address
            array(
                'id' => 'contact_email',
                'type' => 'text',
                'title' => 'آدرس ایمیل',
                'subtitle' => 'آدرس ایمیل شرکت',
                'default' => 'mailroom@samaninsurance.ir',
                'validate' => 'email',
            ),

            // Fax Number
            array(
                'id' => 'contact_fax',
                'type' => 'text',
                'title' => 'شماره فکس',
                'subtitle' => 'شماره فکس شرکت',
                'default' => '۸۸۷۰۰۲۰۴',
            ),

            // Phone Number
            array(
                'id' => 'contact_phone',
                'type' => 'text',
                'title' => 'شماره تلفن',
                'subtitle' => 'شماره تلفن شرکت',
                'default' => '۸۹۵۳ - ۰۲۱',
            ),

            // Office locations section divider
            array(
                'id' => 'office_locations_divider',
                'type' => 'section',
                'title' => 'ساختمان‌های شرکت',
                'subtitle' => 'اطلاعات مربوط به ساختمان‌های شرکت',
                'indent' => false,
            ),

            // Office locations
            array(
                'id' => 'office_locations',
                'type' => 'repeater',
                'title' => 'مکان‌های دفاتر شرکت',
                'subtitle' => 'اطلاعات مربوط به ساختمان‌های شرکت را وارد کنید',
                'group_values' => true,
                'item_name' => 'ساختمان',
                'sortable' => true,
                'fields' => array(
                    array(
                        'id' => 'title',
                        'type' => 'text',
                        'title' => 'عنوان ساختمان',
                        'default' => 'ساختمان مرکزی شماره',
                    ),
                    array(
                        'id' => 'address',
                        'type' => 'textarea',
                        'title' => 'آدرس',
                        'rows' => 2,
                        'default' => 'تهران، خیابان سید جمال الدین اسد آبادی، شماره ۴۳۳',
                    ),
                    array(
                        'id' => 'postal_code',
                        'type' => 'text',
                        'title' => 'کد پستی',
                        'default' => '۱۴۳۴۹۳۳۵۷۴',
                    ),
                    array(
                        'id' => 'tel_code',
                        'type' => 'text',
                        'title' => 'شماره تماس',
                        'default' => '',
                    ),
                    array(
                        'id' => 'map_url',
                        'type' => 'text',
                        'title' => 'آدرس نقشه گوگل',
                        'subtitle' => 'لینک iframe نقشه گوگل را وارد کنید',
                        'default' => 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d103544.36865896698!2d51.344163627849795!3d35.80578750000001!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3f8e057f4392d531%3A0x366d789be759f42!2z2KjbjNmF2Ycg2LPYp9mF2KfZhiDZhtmF2KfbjNmG2K_ar9uMINmF2YLYtdmI2K_bjA!5e0!3m2!1sen!2sde!4v1745220566815!5m2!1sen!2sde',
                    ),
                ),
                'default' => array(
                    array(
                        'title' => 'ساختمان مرکزی شماره ۱',
                        'address' => 'تهران، خیابان سید جمال الدین اسد آبادی، شماره ۴۳۳',
                        'postal_code' => '۱۴۳۴۹۳۳۵۷۴',
                        'map_url' => 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d103544.36865896698!2d51.344163627849795!3d35.80578750000001!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3f8e057f4392d531%3A0x366d789be759f42!2z2KjbjNmF2Ycg2LPYp9mF2KfZhiDZhtmF2KfbjNmG2K_ar9uMINmF2YLYtdmI2K_bjA!5e0!3m2!1sen!2sde!4v1745220566815!5m2!1sen!2sde',
                    ),
                ),
            ),

            // Office hours section divider
            array(
                'id' => 'office_hours_divider',
                'type' => 'section',
                'title' => 'ساعات کاری',
                'subtitle' => 'تنظیمات ساعات کاری دفاتر شرکت',
                'indent' => false,
            ),

            // Office hours section title
            array(
                'id' => 'office_hours_title',
                'type' => 'text',
                'title' => 'عنوان بخش ساعات کاری',
                'default' => 'ساعت کار ادارات مرکزی شرکت بیمه سامان',
            ),

            // Weekday hours
            array(
                'id' => 'weekday_hours',
                'type' => 'text',
                'title' => 'ساعت کاری شنبه تا چهارشنبه',
                'default' => 'ساعت ۸:۰۰ الی ۱۶:۰۰',
            ),

            // Thursday hours
            array(
                'id' => 'thursday_hours',
                'type' => 'text',
                'title' => 'ساعت کاری پنجشنبه',
                'default' => 'ساعت ۸:۰۰ الی ۱۳:۰۰',
            ),
        )
    ));

    // تنظیمات صفحه ی ارتباط با مدیران

    Redux::set_section($opt_name, [
        'title' => __('تنظیمات ارتباط با مدیران ', 'jtheme'),
        'id' => 'contact_managers_settings',
        'icon' => 'el el-users', // Updated icon for better representation
        'fields' => array(
            array(
                'id' => 'contact_board_members_title', // Unique ID
                'type' => 'text',
                'title' => __('عنوان بخش اعضای هیئت مدیره', 'jtheme'), // Board Members Title
                'desc' => __('عنوان بخش اعضای هیئت مدیره را وارد کنید.', 'jtheme'), // Enter the title for the Board Members section.
                'default' => 'اعضای هیئت مدیره',
            ),
            array(
                'id' => 'contact_board_members', // Unique ID
                'type' => 'repeater',
                'title' => __('اعضای هیئت مدیره', 'jtheme'), // Board Members
                'desc' => __('اعضای هیئت مدیره را اضافه کنید.', 'jtheme'), // Add board members.
                'sortable' => true,
                'group_values' => true, // Remove individual item labels
                'fields' => array(
                    array(
                        'id' => 'contact_member_image', // Unique ID
                        'type' => 'media',
                        'title' => __('تصویر', 'jtheme'), // Image
                    ),
                    array(
                        'id' => 'contact_member_name', // Unique ID
                        'type' => 'text',
                        'title' => __('نام', 'jtheme'), // Name
                    ),
                    array(
                        'id' => 'contact_member_position', // Unique ID
                        'type' => 'text',
                        'title' => __('سمت', 'jtheme'), // Position
                    ),
                    array(
                        'id' => 'contact_member_phone', // Unique ID
                        'type' => 'text',
                        'title' => __('شماره تماس', 'jtheme'), // Position
                    ),
                    array(
                        'id' => 'contact_member_fax', // Unique ID
                        'type' => 'text',
                        'title' => __('شماره نمابر', 'jtheme'), // Position
                    ),
                ),
            ),
            array(
                'id' => 'contact_download_organizational_chart', // Unique ID
                'type' => 'media',
                'title' => __('فایل دانلودی چارت سازمانی', 'jtheme'), // Organizational Chart Download File
                'library_filter' => array('jpg', 'png', 'pdf', 'txt', 'zip', 'word'),
            ),
        )
    ]);
    // تنظیمات صفحه درباره ی ما
    Redux::setSection($opt_name, array(
        'title' => __('صفحه درباره ما', 'jtheme'), // About Us Page
        'id' => 'about_us_section',
        'icon' => 'el el-info-circle',
        'fields' => array(

            array(
                'id' => 'about_intro_image',
                'type' => 'media',
                'title' => __('تصویر بخش معرفی درباره ما', 'jtheme'), // About Intro Image
                'desc' => __('تصویر اصلی بخش معرفی درباره ما را آپلود کنید.', 'jtheme'), // Upload the main image for the About Us intro section.
                'subtitle' => __('سایز پیشنهادی: [ابعاد پیشنهادی را وارد کنید]', 'jtheme'), // Recommended size: [Suggest dimensions]
            ),

            array(
                'id' => 'about_intro_title',
                'type' => 'text',
                'title' => __('عنوان بخش معرفی درباره ما', 'jtheme'), // About Intro Title
                'desc' => __('عنوان بخش معرفی درباره ما را وارد کنید.', 'jtheme'), // Enter the title for the About Us intro section.
                'default' => 'درباره ما',
            ),

            array(
                'id' => 'about_intro_content',
                'type' => 'editor',
                'title' => __('محتوای بخش معرفی درباره ما', 'jtheme'), // About Intro Content
                'desc' => __('محتوای اصلی بخش معرفی درباره ما را وارد کنید.', 'jtheme'), // Enter the main content for the About Us intro section.
                'default' => 'شرکت بیمه سامان در تاریخ ۲۷ بهمن ۱۳۸۲ با هدف ارائه خدمات بیمه‌های بازرگانی در رشته‌های اموال، مسئولیت و اشخاص تأسیس شد.',
                'args' => array(
                    'teeny' => true,
                    'textarea_rows' => 10,
                    'media_buttons' => false,
                )
            ),

            array(
                'id' => 'about_video_image',
                'type' => 'media',
                'title' => __('تصویر بخش خدمات دیجیتال', 'jtheme'), // Digital Services Image
                'desc' => __('تصویر بخش خدمات دیجیتال را آپلود کنید.', 'jtheme'), // Upload the image for the Digital Services section.
                //'subtitle' => __('سایز پیشنهادی: [ابعاد پیشنهادی را وارد کنید]', 'jtheme'), // Recommended size: [Suggest dimensions]
            ),

            array(
                'id' => 'about_video_link',
                'type' => 'text',
                'title' => __('لینک ویدیو بخش خدمات دیجیتال', 'jtheme'), // Digital Services Image
                'desc' => __('لینک ویدیو بخش خدمات دیجیتال را وارد کنید.', 'jtheme'), // Upload the image for the Digital Services section.
                //'subtitle' => __('سایز پیشنهادی: [ابعاد پیشنهادی را وارد کنید]', 'jtheme'), // Recommended size: [Suggest dimensions]
            ),

            array(
                'id' => 'about_video_content',
                'type' => 'editor',
                'title' => __('محتوای بخش خدمات دیجیتال', 'jtheme'), // Digital Services Content
                'desc' => __('محتوای بخش خدمات دیجیتال را وارد کنید.', 'jtheme'), // Enter the content for the Digital Services section.
                'default' => 'از مهم‌ترین ویژگی‌های بیمه سامان، بهره‌گیری از فناوری‌های نوین و ارائه خدمات دیجیتال در صنعت بیمه است. ما با ایجاد زیرساخت‌های پیشرفته، فرایندهای بیمه‌ای را ساده‌تر و سریع‌تر کرده‌ایم تا مشتریانمان تجربه‌ای متفاوت و راحت از خدمات بیمه‌ای داشته باشند.',
                'args' => array(
                    'teeny' => true,
                    'textarea_rows' => 10,
                    'media_buttons' => false,
                )
            ),

            array(
                'id' => 'about_goals_title',
                'type' => 'text',
                'title' => __('عنوان بخش اهداف، چشم اندازها و ارزش ها', 'jtheme'), // Goals, Vision and Values Title
                'desc' => __('عنوان بخش اهداف، چشم اندازها و ارزش ها را وارد کنید.', 'jtheme'), // Enter the title for the Goals, Vision and Values section.
                'default' => 'اهداف، چشم‌اندازها و ارزش‌ها',
            ),

            array(
                'id' => 'about_goals_content',
                'type' => 'editor',
                'title' => __('محتوای بخش اهداف، چشم اندازها و ارزش ها', 'jtheme'), // Goals, Vision and Values Content
                'desc' => __('محتوای بخش اهداف، چشم اندازها و ارزش ها را وارد کنید.', 'jtheme'), // Enter the content for the Goals, Vision and Values section.
                'default' => 'شرکت بیمه سامان، از مجموعه‌های شناخته شده و نوآور در صنعت بیمه کشور است که با تکیه بر تخصص، تجربه و دانش فنی مدیران و کارکنان خود و همچنین تعهد به ارائه خدمات حرفه‌ای و متمایز نسبت به سایر شرکت‌های فعال در این حوزه، همواره در تلاش است تا ضمن برقراری آرامش و امنیت برای مشتریان خود، محصولات و استانداردهای جدیدی برای ارائه خدمات تعریف کند.',
                'args' => array(
                    'teeny' => true,
                    'textarea_rows' => 10,
                    'media_buttons' => false,
                )
            ),

            array(
                'id' => 'company_values_intro',
                'type' => 'editor',
                'title' => __('متن معرفی ارزش‌های سازمانی', 'jtheme'), // Company Values Intro
                'desc' => __('متن معرفی بخش ارزش‌های سازمانی را وارد کنید.', 'jtheme'), // Enter the intro content for the Company Values section.
                'default' => 'ارزش‌های بیمه سامان شامل گشودگی و تجربه پذیری، چابکی، کارتیمی مبتنی بر اعتماد، مشتری مداری و بی‌پروا و مرز زدن است.',
                'args' => array(
                    'teeny' => true,
                    'textarea_rows' => 5,
                    'media_buttons' => false,
                )
            ),

            array(
                'id' => 'company_values_services_intro',
                'type' => 'editor',
                'title' => __('متن معرفی خدمات ارزش‌های سازمانی', 'jtheme'), // Company Values Services Intro
                'desc' => __('متن معرفی بخش خدمات ارزش‌های سازمانی را وارد کنید.', 'jtheme'), // Enter the intro content for the Company Values Services section.
                'default' => 'طبقه‌بندی اصلی خدمات گسترده بیمه‌ای که شرکت بیمه سامان در آن فعال است، در لیست زیر قابل مشاهده می‌باشد.',
                'args' => array(
                    'teeny' => true,
                    'textarea_rows' => 5,
                    'media_buttons' => false,
                )
            ),

            array(
                'id' => 'company_values_cards',
                'type' => 'repeater',
                'title' => __('کارت‌های خدمات ارزش‌های سازمانی', 'jtheme'), // Company Values Services Cards
                'desc' => __('کارت‌های خدمات ارزش‌های سازمانی را اضافه کنید.', 'jtheme'), // Add company values service cards.
                'sortable' => true,
                'group_values' => true, // Remove individual item labels
                'fields' => array(
                    array(
                        'id' => 'image',
                        'type' => 'media',
                        'title' => __('تصویر', 'jtheme'), // Image
                    ),
                    array(
                        'id' => 'title',
                        'type' => 'text',
                        'title' => __('عنوان', 'jtheme'), // Title
                    ),
                    array(
                        'id' => 'content',
                        'type' => 'textarea',
                        'title' => __('محتوا', 'jtheme'), // Content
                    ),
                ),
            ),

            array(
                'id' => 'company_values_final_text',
                'type' => 'text',
                'title' => __('متن پایانی ارزش‌های سازمانی', 'jtheme'), // Company Values Final Text
                'desc' => __('متن پایانی بخش ارزش‌های سازمانی را وارد کنید.', 'jtheme'), // Enter the final text for the Company Values section.
                'default' => 'آینده‌ای مطمئن‌تر، با بیمه سامان دست یافتنی است.',
            ),

            array(
                'id' => 'competency_framework_title',
                'type' => 'text',
                'title' => __('عنوان چارچوب شایستگی‌ها', 'jtheme'), // Competency Framework Title
                'desc' => __('عنوان بخش چارچوب شایستگی‌ها را وارد کنید.', 'jtheme'), // Enter the title for the Competency Framework section.
                'default' => 'چهارچوب شایستگی‌های بیمه سامان',
            ),

            array(
                'id' => 'competency_framework_description',
                'type' => 'editor',
                'title' => __('توضیحات چارچوب شایستگی‌ها', 'jtheme'), // Competency Framework Description
                'desc' => __('توضیحات بخش چارچوب شایستگی‌ها را وارد کنید.', 'jtheme'), // Enter the description for the Competency Framework section.
                'default' => 'در بیمه سامان، موفقیت ما بر پایه چارچوبی از شایستگی‌های کلیدی و مدیریتی استوار است تا کارکنان و مدیران را در مسیر رشد و تعالی قرار دهد. هدف از تعیین این ساختار، ارتقای کیفیت خدمات و افزایش رضایت مشتریان است و به ما کمک می‌کند تا همواره در صنعت بیمه پیشرو باشیم.',
                'args' => array(
                    'teeny' => true,
                    'textarea_rows' => 5,
                    'media_buttons' => false,
                )
            ),

            array(
                'id' => 'key_competencies_title',
                'type' => 'text',
                'title' => __('عنوان شایستگی‌های کلیدی', 'jtheme'), // Key Competencies Title
                'desc' => __('عنوان بخش شایستگی‌های کلیدی را وارد کنید.', 'jtheme'), // Enter the title for the Key Competencies section.
                'default' => 'شایستگی‌های کلیدی',
            ),

            array(
                'id' => 'key_competencies_cards',
                'type' => 'repeater',
                'title' => __('کارت‌های شایستگی‌های کلیدی', 'jtheme'), // Key Competencies Cards
                'desc' => __('کارت‌های شایستگی‌های کلیدی را اضافه کنید.', 'jtheme'), // Add key competencies cards.
                'sortable' => true,
                'group_values' => true, // Remove individual item labels
                'fields' => array(
                    array(
                        'id' => 'image',
                        'type' => 'media',
                        'title' => __('تصویر', 'jtheme'), // Image
                    ),
                    array(
                        'id' => 'title',
                        'type' => 'text',
                        'title' => __('عنوان', 'jtheme'), // Title
                    ),
                    array(
                        'id' => 'content',
                        'type' => 'textarea',
                        'title' => __('محتوا', 'jtheme'), // Content
                    ),
                ),
            ),

            array(
                'id' => 'about_business_data_analysis_image',
                'type' => 'media',
                'title' => __('تصویر بخش تحلیل داده های کسب و کار', 'jtheme'), // Business Data Analysis Image
                'desc' => __('تصویر بخش تحلیل داده های کسب و کار را آپلود کنید.', 'jtheme'), // Upload the image for the Business Data Analysis section.
                'subtitle' => __('سایز پیشنهادی: [ابعاد پیشنهادی را وارد کنید]', 'jtheme'), // Recommended size: [Suggest dimensions]
            ),

            array(
                'id' => 'about_business_data_analysis_content',
                'type' => 'editor',
                'title' => __('محتوای بخش تحلیل داده های کسب و کار', 'jtheme'), // Business Data Analysis Content
                'desc' => __('محتوای بخش تحلیل داده های کسب و کار را وارد کنید.', 'jtheme'), // Enter the content for the Business Data Analysis section.
                'default' => 'از مهم‌ترین ویژگی‌های بیمه سامان، بهره‌گیری از فناوری‌های نوین و ارائه خدمات دیجیتال در صنعت بیمه است. ما با ایجاد زیرساخت‌های پیشرفته، فرایندهای بیمه‌ای را ساده‌تر و سریع‌تر کرده‌ایم تا مشتریانمان تجربه‌ای متفاوت و راحت از خدمات بیمه‌ای داشته باشند.',
                'args' => array(
                    'teeny' => true,
                    'textarea_rows' => 10,
                    'media_buttons' => false,
                )
            ),

            array(
                'id' => 'board_members_title',
                'type' => 'text',
                'title' => __('عنوان بخش اعضای هیئت مدیره', 'jtheme'), // Board Members Title
                'desc' => __('عنوان بخش اعضای هیئت مدیره را وارد کنید.', 'jtheme'), // Enter the title for the Board Members section.
                'default' => 'اعضای هیئت مدیره',
            ),

            array(
                'id' => 'board_members',
                'type' => 'repeater',
                'title' => __('اعضای هیئت مدیره', 'jtheme'), // Board Members
                'desc' => __('اعضای هیئت مدیره را اضافه کنید.', 'jtheme'), // Add board members.
                'sortable' => true,
                'group_values' => true, // Remove individual item labels
                'fields' => array(
                    array(
                        'id' => 'image',
                        'type' => 'media',
                        'title' => __('تصویر', 'jtheme'), // Image
                    ),
                    array(
                        'id' => 'name',
                        'type' => 'text',
                        'title' => __('نام', 'jtheme'), // Name
                    ),
                    array(
                        'id' => 'position',
                        'type' => 'text',
                        'title' => __('سمت', 'jtheme'), // Position
                    ),
                ),
            ),

            array(
                'id' => 'download_organizational_chart',
                'type' => 'media',
                'title' => __('فایل دانلودی چارت سازمانی', 'jtheme'), // Board Members Title
                'library_filter' => array('jpg', 'png', 'pdf', 'txt', 'zip', 'word'),
            ),

            array(
                'id' => 'certificates_title',
                'type' => 'text',
                'title' => __('عنوان بخش گواهینامه‌ها', 'jtheme'), // Certificates Title
                'desc' => __('عنوان بخش گواهینامه‌ها را وارد کنید.', 'jtheme'), // Enter the title for the Certificates section.
                'default' => 'گواهی نامه‌ها و تقدیرنامه‌های شرکت بیمه سامان',
            ),

            array(
                'id' => 'certificates_description',
                'type' => 'editor',
                'title' => __('توضیحات بخش گواهینامه‌ها', 'jtheme'), // Certificates Description
                'desc' => __('توضیحات بخش گواهینامه‌ها را وارد کنید.', 'jtheme'), // Enter the description for the Certificates section.
                'default' => 'بیمه سامان از آغاز، ارائه خدمات بیمه‌ای با بالاترین استانداردهای کیفی و همچنین رضایت مشتریان را سرلوحه فعالیت‌ها خود قرار داده است. تلاش برای بهبود مستمر در مسیر جلب رضایت مشتریان و نیز پایبندی به اصول حرفه‌ای و استانداردهای برتر صنعت بیمه از افتخارات این شرکت بوده که دستاورد آن، اعتماد و ارزیابی مثبت نهادهای تخصصی است. دریافت گواهینامه‌های معتبر و تقدیرنامه‌های مختلف، گواهی بر تعهد ما به ارائه خدماتی مطمئن و حرفه‌ای است.',
                'args' => array(
                    'teeny' => true,
                    'textarea_rows' => 5,
                    'media_buttons' => false,
                )
            ),
        )
    ));

    // تنظیمات صفحه بورسیه ی تحصیلی
    // Scholarship Page Settings
    Redux::setSection($opt_name, array(
        'title' => 'تنظیمات صفحه بورسیه',
        'id' => 'scholarship-settings',
        'desc' => 'در این بخش می‌توانید تمامی اطلاعات مربوط به صفحه بورسیه تحصیلی را تنظیم کنید.',
        'icon' => 'el el-book',
        'fields' => array(
            // Main scholarship info section
            array(
                'id' => 'scholarship_main_section',
                'type' => 'section',
                'title' => 'بخش اصلی اطلاعات بورسیه',
                'indent' => true,
            ),
            array(
                'id' => 'scholarship_main_image',
                'type' => 'media',
                'title' => 'تصویر اصلی بورسیه',
                'subtitle' => 'تصویر نمایش داده شده در بخش اصلی صفحه بورسیه',
                'desc' => 'ابعاد پیشنهادی: 400×300 پیکسل',
                'library_filter' => array('jpg', 'jpeg', 'png'),
            ),
            array(
                'id' => 'scholarship_main_title',
                'type' => 'text',
                'title' => 'عنوان بخش اصلی',
                'default' => 'بورسیه تحصیلی',
            ),
            array(
                'id' => 'scholarship_main_content',
                'type' => 'editor',
                'title' => 'محتوای بخش اصلی',
                'subtitle' => 'متن توضیحات اصلی بورسیه',
                'desc' => 'می‌توانید از ویرایشگر متن برای قالب‌بندی محتوا استفاده کنید',
                'default' => 'شرکت بیمه سامان در راستای ایفای تعهدات اجتماعی و مسئولیت‌های خود در قبال توسعه علم و دانش، مطابق با شیوه نامه اجرایی بورس صنعت و مشاغل...',
                'args' => array(
                    'wpautop' => true,
                    'media_buttons' => true,
                    'textarea_rows' => 10,
                    'teeny' => false,
                )
            ),

            // Study fields section
            array(
                'id' => 'scholarship_fields_section',
                'type' => 'section',
                'title' => 'بخش رشته‌های تحصیلی',
                'indent' => true,
            ),
            array(
                'id' => 'scholarship_fields_title',
                'type' => 'text',
                'title' => 'عنوان بخش رشته‌های تحصیلی',
                'default' => 'شرایط عمومی و اختصاصی متقاضیان بدو ورود بورسیه تحصیلی شرکت بیمه سامان',
            ),
            array(
                'id' => 'scholarship_fields_description',
                'type' => 'textarea',
                'title' => 'توضیحات رشته‌های تحصیلی',
                'subtitle' => 'متن توضیحی رشته‌های مورد پذیرش',
                'default' => 'دانشجویان مقطع کارشناسی ارشد رشته‌ها و گرایش‌های زیر که در حال تحصیل در دانشگاه‌های تهران، صنعتی شریف...',
            ),

            // Study Fields Cards (Repeater)
            array(
                'id' => 'scholarship_fields_repeater',
                'type' => 'repeater',
                'title' => 'کارت‌های رشته‌های تحصیلی',
                'subtitle' => 'رشته‌های تحصیلی مورد پذیرش برای بورسیه را اضافه کنید',
                'desc' => 'می‌توانید رشته‌های جدید اضافه کنید یا رشته‌های موجود را ویرایش کنید',
                'group_values' => true,
                'item_name' => 'رشته تحصیلی',
                'fields' => array(
                    array(
                        'id' => 'icon',
                        'type' => 'media',
                        'title' => 'آیکون رشته',
                        'subtitle' => 'آیکون مرتبط با رشته تحصیلی',
                        'desc' => 'ابعاد پیشنهادی: 64×64 پیکسل',
                    ),
                    array(
                        'id' => 'title',
                        'type' => 'text',
                        'title' => 'عنوان رشته',
                        'subtitle' => 'نام رشته تحصیلی',
                    ),
                    array(
                        'id' => 'orientation',
                        'type' => 'text',
                        'title' => 'گرایش',
                        'subtitle' => 'گرایش رشته تحصیلی',
                    ),
                ),
                'default' => array(
                    array(
                        'title' => 'آمار',
                        'orientation' => 'گرایش بیم سنجی',
                    ),
                    array(
                        'title' => 'علوم کامپیوتر',
                        'orientation' => 'گرایش داده‌کاوی',
                    ),
                    array(
                        'title' => 'مهندسی کامپیوتر',
                        'orientation' => 'گرایش هوش مصنوعی و رباتیک',
                    ),
                    array(
                        'title' => 'ریاضی کاربردی',
                        'orientation' => 'گرایش ریاضی مالی',
                    ),
                    array(
                        'title' => 'مهندسی صنایع',
                        'orientation' => 'گرایش مدل‌سازی سیستم‌ها و تحلیل داده',
                    ),
                )
            ),

            // Information sections (Admission process)
            array(
                'id' => 'scholarship_info_section',
                'type' => 'section',
                'title' => 'بخش‌های اطلاعات',
                'indent' => true,
            ),
            array(
                'id' => 'scholarship_info_repeater',
                'type' => 'repeater',
                'title' => 'بخش‌های اطلاعات',
                'subtitle' => 'بخش‌های مختلف اطلاعات مربوط به بورسیه',
                'desc' => 'می‌توانید بخش‌های جدید اضافه کنید یا بخش‌های موجود را ویرایش کنید',
                'group_values' => true,
                'item_name' => 'بخش اطلاعات',
                'fields' => array(
                    array(
                        'id' => 'title',
                        'type' => 'text',
                        'title' => 'عنوان بخش',
                        'subtitle' => 'عنوان بخش اطلاعات',
                    ),
                    array(
                        'id' => 'content',
                        'type' => 'editor',
                        'title' => 'محتوای بخش',
                        'subtitle' => 'متن توضیحات این بخش',
                        'args' => array(
                            'wpautop' => true,
                            'media_buttons' => true,
                            'textarea_rows' => 6,
                        )
                    ),
                ),
                'default' => array(
                    array(
                        'title' => 'الف) شیوه پذیرش',
                        'content' => 'شیوه پذیرش دانشجویان بورسیه از طریق ثبت نام در سایت بیمه سامان یا معرفی دانشگاه‌های منتخب و سازمان امور دانشجویی می باشد لذا تکمیل فرم ثبت نام متقاضیان علاقمند حائز شرایط الزامی می باشد . پس از بررسی اطلاعات متقاضیان و تایید شرایط جهت شرکت در مصاحبه عمومی و تخصصی اطلاع رسانی خواهد شد.',
                    ),
                )
            ),

            // Universities Table
            array(
                'id' => 'scholarship_universities_section',
                'type' => 'section',
                'title' => 'جدول دانشگاه‌های منتخب',
                'indent' => true,
            ),
            array(
                'id' => 'scholarship_universities_title',
                'type' => 'text',
                'title' => 'عنوان جدول دانشگاه‌ها',
                'default' => 'جدول دانشگاه‌های منتخب',
            ),
            // Add top editor for universities section
            array(
                'id' => 'scholarship_universities_content_top',
                'type' => 'editor',
                'title' => 'محتوای بالای جدول دانشگاه‌ها',
                'subtitle' => 'این محتوا در بالای جدول دانشگاه‌ها نمایش داده می‌شود',
                'args' => array(
                    'wpautop' => true,
                    'media_buttons' => true,
                    'textarea_rows' => 6,
                    'teeny' => false,
                )
            ),
            array(
                'id' => 'scholarship_universities_repeater',
                'type' => 'repeater',
                'title' => 'دانشگاه‌های منتخب',
                'subtitle' => 'لیست دانشگاه‌های منتخب برای بورسیه',
                'desc' => 'دانشگاه‌ها به صورت دو ستونی نمایش داده می‌شوند',
                'group_values' => true,
                'item_name' => 'دانشگاه',
                'fields' => array(
                    array(
                        'id' => 'rank',
                        'type' => 'text',
                        'title' => 'ردیف',
                        'subtitle' => 'شماره ردیف دانشگاه',
                    ),
                    array(
                        'id' => 'name',
                        'type' => 'text',
                        'title' => 'نام دانشگاه',
                        'subtitle' => 'نام کامل دانشگاه',
                    ),
                ),
                'default' => array(
                    array('rank' => '۱', 'name' => 'دانشگاه تهران'),
                    array('rank' => '۲', 'name' => 'دانشگاه صنعتی شریف'),
                    array('rank' => '۳', 'name' => 'دانشگاه شهید بهشتی'),
                    array('rank' => '۴', 'name' => 'دانشگاه علم و صنعت ایران'),
                    array('rank' => '۵', 'name' => 'دانشگاه تربیت مدرس'),
                    array('rank' => '۶', 'name' => 'دانشگاه خواجه نصیرالدین طوسی'),
                    array('rank' => '۷', 'name' => 'دانشگاه علامه طباطبایی'),
                    array('rank' => '۸', 'name' => 'دانشگاه خوارزمی'),
                    array('rank' => '۹', 'name' => 'دانشگاه صنعتی امیرکبیر'),
                    array('rank' => '۱۰', 'name' => 'دانشگاه شیراز'),
                    array('rank' => '۱۱', 'name' => 'دانشگاه تبریز'),
                    array('rank' => '۱۲', 'name' => 'دانشگاه یزد'),
                    array('rank' => '۱۳', 'name' => 'دانشگاه اصفهان'),
                    array('rank' => '۱۴', 'name' => 'دانشگاه فردوسی مشهد'),
                    array('rank' => '۱۵', 'name' => 'دانشگاه شهید باهنر کرمان'),
                    array('rank' => '۱۶', 'name' => 'دانشگاه شهید چمران اهواز'),
                    array('rank' => '۱۷', 'name' => 'دانشگاه مازندران'),
                    array('rank' => '۱۸', 'name' => 'دانشگاه صنعتی اصفهان'),
                    array('rank' => '۱۹', 'name' => 'دانشگاه صنعتی تبریز'),
                    array('rank' => '۲۰', 'name' => 'دانشگاه گیلان'),
                    array('rank' => '۲۱', 'name' => 'دانشگاه تحصیلات تکمیلی زنجان'),
                    array('rank' => '۲۲', 'name' => 'دانشگاه الزهرا تهران'),
                )
            ),
            // Add bottom editor for universities section
            array(
                'id' => 'scholarship_universities_content_bottom',
                'type' => 'editor',
                'title' => 'محتوای پایین جدول دانشگاه‌ها',
                'subtitle' => 'این محتوا در پایین جدول دانشگاه‌ها نمایش داده می‌شود',
                'args' => array(
                    'wpautop' => true,
                    'media_buttons' => true,
                    'textarea_rows' => 6,
                    'teeny' => false,
                )
            ),

            // Steps Section
            array(
                'id' => 'scholarship_steps_section',
                'type' => 'section',
                'title' => 'مراحل پذیرش',
                'indent' => true,
            ),
            array(
                'id' => 'scholarship_steps_repeater',
                'type' => 'repeater',
                'title' => 'مراحل پذیرش بورسیه',
                'subtitle' => 'کارت‌های مراحل مختلف پذیرش بورسیه',
                'desc' => 'هر مرحله به صورت یک کارت نمایش داده می‌شود',
                'group_values' => true,
                'item_name' => 'مرحله',
                'fields' => array(
                    array(
                        'id' => 'step_number',
                        'type' => 'text',
                        'title' => 'شماره مرحله',
                        'subtitle' => 'مثال: مرحله ۱',
                    ),
                    array(
                        'id' => 'step_content',
                        'type' => 'textarea',
                        'title' => 'توضیحات مرحله',
                        'subtitle' => 'شرح کوتاه این مرحله از پذیرش',
                    ),
                ),
                'default' => array(
                    array(
                        'step_number' => 'مرحله ۱',
                        'step_content' => 'مصاحبه عمومی و اولیه شرکت بیمه سامان و بررسی مدارک',
                    ),
                    array(
                        'step_number' => 'مرحله ۲',
                        'step_content' => 'تایید اولیه و معرفی به سازمان امور دانشجویی',
                    ),
                    array(
                        'step_number' => 'مرحله ۳',
                        'step_content' => 'مصاحبه تخصصی و عمومی توسط سازمان امور دانشجویی',
                    ),
                    array(
                        'step_number' => 'مرحله ۴',
                        'step_content' => 'معرفی دانشجویان پذیرفته شده و عقد قرارداد',
                    ),
                    array(
                        'step_number' => 'مرحله ۵',
                        'step_content' => 'شروع دوره بورسیه و پرداخت مزایا',
                    ),
                )
            ),

            // CTA Button
            array(
                'id' => 'scholarship_cta_section',
                'type' => 'section',
                'title' => 'دکمه ثبت‌نام',
                'indent' => true,
            ),
            array(
                'id' => 'scholarship_cta_text',
                'type' => 'text',
                'title' => 'متن دکمه ثبت‌نام',
                'default' => 'برای ثبت‌نام بورسیه تحصیلی سامان، کلیک کنید',
            ),
            array(
                'id' => 'scholarship_cta_link',
                'type' => 'text',
                'title' => 'لینک دکمه ثبت‌نام',
                'subtitle' => 'آدرس صفحه ثبت‌نام بورسیه',
                'default' => '#',
                'validate' => 'url',
            ),
        )
    ));


    //تنظیمات صفحه استخدام
    // Title of the section
    Redux::setSection($opt_name, array(
        'title' => 'تنظیمات صفحه استخدام', // Title of the section
        'id' => 'employment-settings', // Unique section ID
        'fields' => array(
            array(
                'id' => 'job_title',
                'type' => 'text',
                'title' => 'عنوان شغلی', // Job Title
                'default' => 'کارشناس فنی خسارت بیمه', // Default value
                'desc' => 'عنوان شغلی برای نمایش در صفحه استخدام' // Description
            ),
            array(
                'id' => 'job_qualifications',
                'type' => 'textarea',
                'title' => 'نیازمندی‌های شغلی', // Job Qualifications
                'default' => 'مسلط به فرآیند صدور و خسارت، آشنایی با زبان انگلیسی...', // Default content
                'desc' => 'لیست نیازمندی‌های این شغل. با استفاده از فرمت مناسب (علامت‌گذاری شده با نقطه قرمز)' // Description
            ),
            array(
                'id' => 'job_description',
                'type' => 'textarea',
                'title' => 'توضیحات موقعیت شغلی', // Job Description
                'default' => 'بررسی و ارزیابی خسارت در رشته های بیمه ای...', // Default description
                'desc' => 'توضیحات و وظایف شغلی که باید انجام داده شود' // Description
            ),
            //            array(
            //                'id' => 'job_image',
            //                'type' => 'media',
            //                'title' => 'تصویر شغلی', // Job Image
            //                'desc' => 'تصویری برای نشان دادن موقعیت شغلی در صفحه استخدام' // Description
            //            ),
            array(
                'id' => 'cta_button_text',
                'type' => 'text',
                'title' => 'متن دکمه ارسال درخواست', // CTA Button Text
                'default' => 'ارسال درخواست', // Default text for button
                'desc' => 'متن دکمه برای ارسال درخواست' // Description
            ),
        )
    ));

    //تنظیمات صفحه سیاست
    Redux::setSection($opt_name, array(
        'title' => 'تنظیمات صفحه سیاست', // Title of the section
        'id' => 'terms-settings', // Unique section ID
        'fields' => array(
            // Terms and Conditions Title
            array(
                'id' => 'terms_title',
                'type' => 'text',
                'title' => 'عنوان قوانین و مقررات',
                'default' => 'قوانین و مقررات وب‌سایت',
                'desc' => 'عنوان نمایش داده شده برای بخش قوانین و مقررات وب‌سایت'
            ),
            // Terms and Conditions Content
            array(
                'id' => 'terms_content',
                'type' => 'editor',
                'title' => 'محتوای قوانین و مقررات',
                'default' => 'کلیه عناصر موجود در این وب سایت، شامل اطلاعات، اسناد، تعلیمات، لوگوها...',
                'desc' => 'متن کامل قوانین و مقررات وب‌سایت'
            ),
            array(
                'id' => 'terms_img',
                'type' => 'media',
                'title' => 'عکس قوانین و مقررات',
                //                'default' => 'عکس کنار متن محتوای قوانین و مقرارات',
                //                'desc' => 'متن کامل قوانین و مقررات وب‌سایت'
            ),
            // Cookies Title
            array(
                'id' => 'cookies_title',
                'type' => 'text',
                'title' => 'عنوان کوکی ها',
                'default' => 'کوکی ها',
                'desc' => 'عنوان نمایش داده شده برای بخش کوکی ها'
            ),
            // Cookies Content
            array(
                'id' => 'cookies_content',
                'type' => 'textarea',
                'title' => 'محتوای کوکی ها',
                'default' => 'کوکی یک فایل کوچک است که روی هارد دیسک شما قرار می‌گیرد...',
                'desc' => 'متن کامل توضیحات کوکی‌ها'
            ),
            // Cookie Details Bullet Points
            array(
                'id' => 'cookies_details_1',
                'type' => 'editor',
                'title' => 'جزئیات کوکی‌ها',
                'desc' => 'لیست نکات توضیحی در مورد استفاده از کوکی‌ها (هر مورد در یک خط جدید وارد شود)',

            ),
        )
    ));


    // تنظیمات صفحه بلاگ
    Redux::setSection($opt_name, array(
        'title' => 'تنظیمات صفحه بلاگ',
        'id' => 'blog-settings',
        'fields' => array(
            array(
                'id' => 'hero_display',
                'type' => 'switch',
                'title' => 'نمایش بخش قهرمان',
                'default' => true,
            ),
            array(
                'id' => 'hero_posts_count',
                'type' => 'slider',
                'title' => 'تعداد مطالب در گرید بخش قهرمان',
                'default' => 4,
                'min' => 1,
                'max' => 8,
                'step' => 1,
                'required' => array('hero_display', 'equals', true),
            ),
            array(
                'id' => 'hero_category',
                'type' => 'select',
                'data' => 'categories',
                'title' => 'دسته‌بندی مطالب گرید',
                'desc' => 'اگر انتخاب نشود، آخرین مطالب نمایش داده می‌شود',
                'required' => array('hero_display', 'equals', true),
            ),
            array(
                'id' => 'hero_single_display',
                'type' => 'switch',
                'title' => 'نمایش مطلب تکی در بخش قهرمان',
                'default' => true,
                'required' => array('hero_display', 'equals', true),
            ),
            array(
                'id' => 'hero_single_category',
                'type' => 'select',
                'data' => 'categories',
                'title' => 'دسته‌بندی مطلب تکی',
                'desc' => 'اگر انتخاب نشود، آخرین مطلب نمایش داده می‌شود',
                'required' => array('hero_single_display', 'equals', true),
            ),
            // Categories Slider
            array(
                'id' => 'category_slider_display',
                'type' => 'switch',
                'title' => 'نمایش اسلایدر دسته‌بندی‌ها',
                'default' => true,
            ),
            array(
                'id' => 'selected_categories',
                'type' => 'select',
                'multi' => true,
                'data' => 'categories',
                'title' => 'دسته‌بندی‌های اسلایدر',
                'required' => array('category_slider_display', 'equals', true),
            ),

            // Insurance News Section
            array(
                'id' => 'news_display',
                'type' => 'switch',
                'title' => 'نمایش بخش اخبار بیمه',
                'default' => true,
            ),
            array(
                'id' => 'news_title',
                'type' => 'text',
                'title' => 'عنوان بخش اخبار',
                'default' => 'اخبار بیمه',
                'required' => array('news_display', 'equals', true),
            ),
            array(
                'id' => 'news_category',
                'type' => 'select',
                'data' => 'categories',
                'title' => 'دسته‌بندی اخبار',
                'required' => array('news_display', 'equals', true),
            ),
            array(
                'id' => 'news_count',
                'type' => 'slider',
                'title' => 'تعداد اخبار',
                'default' => 4,
                'min' => 1,
                'max' => 8,
                'step' => 1,
                'required' => array('news_display', 'equals', true),
            ),
            array(
                'id' => 'news_more_text',
                'type' => 'text',
                'title' => 'متن دکمه نمایش بیشتر',
                'default' => 'مشاهده همه',
                'required' => array('news_display', 'equals', true),
            ),
            array(
                'id' => 'best_categories_display',
                'type' => 'switch',
                'title' => 'نمایش بخش دسته‌بندی‌های برتر',
                'default' => true,
            ),
            array(
                'id' => 'best_categories',
                'type' => 'select',
                'multi' => true,
                'data' => 'categories',
                'title' => 'دسته‌بندی‌های برتر',
                'desc' => 'حداکثر سه دسته‌بندی انتخاب کنید. اگر بیش از سه انتخاب شود، فقط سه تای اول نمایش داده می‌شوند.',
                'required' => array('best_categories_display', 'equals', true),
            ),
            array(
                'id' => 'posts_per_category',
                'type' => 'slider',
                'title' => 'تعداد مطالب هر دسته‌بندی',
                'default' => 3,
                'min' => 1,
                'max' => 10,
                'step' => 1,
                'required' => array('best_categories_display', 'equals', true),
            ),

            // Health Insurance Section
            array(
                'id' => 'health_section_display',
                'type' => 'switch',
                'title' => 'نمایش بخش بیمه درمان',
                'default' => true,
            ),
            array(
                'id' => 'health_category',
                'type' => 'select',
                'data' => 'categories',
                'title' => 'دسته‌بندی بیمه درمان',
                'required' => array('health_section_display', 'equals', true),
            ),
            array(
                'id' => 'health_count',
                'type' => 'slider',
                'title' => 'تعداد مطالب بیمه درمان',
                'default' => 4,
                'min' => 1,
                'max' => 8,
                'step' => 1,
                'required' => array('health_section_display', 'equals', true),
            ),

            // Cargo Insurance Section
            array(
                'id' => 'cargo_section_display',
                'type' => 'switch',
                'title' => 'نمایش بخش بیمه باربری',
                'default' => true,
            ),
            array(
                'id' => 'cargo_category',
                'type' => 'select',
                'data' => 'categories',
                'title' => 'دسته‌بندی بیمه باربری',
                'required' => array('cargo_section_display', 'equals', true),
            ),
            array(
                'id' => 'cargo_count',
                'type' => 'slider',
                'title' => 'تعداد مطالب بیمه باربری',
                'default' => 4,
                'min' => 1,
                'max' => 8,
                'step' => 1,
                'required' => array('cargo_section_display', 'equals', true),
            ),
        ),
    ));

    //مقلات برگزیده
    Redux::setSection($opt_name, array(
        'title' => __('مقاله برگزیده', 'redux-framework'),
        'id' => 'featured-post-section',
        'desc' => __('انتخاب مقاله برگزیده برای نمایش در صفحه اصلی', 'redux-framework'),
        'subsection' => false,
        'fields' => array(
            array(
                'id' => 'featured_post',
                'type' => 'select',
                'title' => __('مقاله برگزیده', 'redux-framework'),
                'desc' => __('مقاله‌ای که می‌خواهید در صفحه اصلی به‌عنوان مقاله برگزیده نمایش داده شود را انتخاب کنید.', 'redux-framework'),
                'data' => 'posts', // اینجا لیست مقالات را می‌آورد
                'default' => '',
            ),
        ),
    ));
});
