<?php

function my_theme_register_required_plugins()
{

    $plugins = array(

        array(
            'name'      => 'Redux Framework',
            'slug'      => 'redux-framework',
            'required'  => true,
        ),
    );

    $config = array(
        'id'           => 'my-theme-prefix',
        'default_path' => '',
        'menu'         => 'redux-installer',
        'has_notices'  => true,
        'dismissable'  => true,
        'dismiss_msg'  => '',
        'is_automatic' => true, 
        'message'      => '',

        'strings'      => array(
            'page_title'                      => __('نصب پلاگین مورد نیاز: Redux Framework', 'my-theme-textdomain'),
            'menu_title'                      => __('نصب Redux', 'my-theme-textdomain'),
            'installing'                      => __('درحال نصب پلاگین: %s', 'my-theme-textdomain'),
            'updating'                        => __('در حال بروزرسانی پلاگین: %s', 'my-theme-textdomain'),
            'oops'                            => __('مشکلی در API پلاگین رخ داده است.', 'my-theme-textdomain'),
            'notice_can_install_required'     => _n_noop(
                'این قالب به پلاگین زیر نیاز دارد: %1$s.',
                'این قالب به پلاگین های زیر نیاز دارد: %1$s.',
                'my-theme-textdomain'
            ),
            'notice_can_activate_required'    => _n_noop(
                'پلاگین مورد نیاز زیر در حال حاضر غیرفعال است: %1$s.',
                'پلاگین های مورد نیاز زیر در حال حاضر غیرفعال هستند: %1$s.',
                'my-theme-textdomain'
            ),
            'install_link'                    => _n_noop(
                'شروع نصب پلاگین',
                'شروع نصب پلاگین ها',
                'my-theme-textdomain'
            ),
            'update_link'                     => _n_noop(
                'شروع بروزرسانی پلاگین',
                'شروع بروزرسانی پلاگین ها',
                'my-theme-textdomain'
            ),
            'activate_link'                   => _n_noop(
                'شروع فعال سازی پلاگین',
                'شروع فعال سازی پلاگین ها',
                'my-theme-textdomain'
            ),
            'return'                          => __('بازگشت به نصب کننده پلاگین های مورد نیاز', 'my-theme-textdomain'),
            'plugin_activated'                => __('پلاگین با موفقیت فعال شد.', 'my-theme-textdomain'),
            'activated_successfully'          => __('پلاگین زیر با موفقیت فعال شد:', 'my-theme-textdomain'),
            'plugin_already_active'           => __('هیچ اقدامی انجام نشد. پلاگین %1$s قبلاً فعال بود.', 'my-theme-textdomain'),
            'complete'                        => __('همه پلاگین ها با موفقیت نصب و فعال شدند. %1$s', 'my-theme-textdomain'),
            'dismiss'                         => __('نادیده گرفتن این پیام', 'my-theme-textdomain'),
            'notice_cannot_install_activate'  => __('یک یا چند پلاگین مورد نیاز برای نصب، بروزرسانی یا فعال سازی وجود دارد.', 'my-theme-textdomain'),
            'contact_admin'                   => __('لطفاً برای کمک با مدیر این سایت تماس بگیرید.', 'my-theme-textdomain'),
        ),
    );

    DepChecker($plugins, $config);
}

add_action('DepChecker_register', 'my_theme_register_required_plugins');
