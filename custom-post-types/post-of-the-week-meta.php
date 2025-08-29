<?php

namespace JTheme\Modules;

use JTheme\Admin\Metabox;
use JTheme\CustomPostTypes\CPT_Creator;
use JTheme\CustomPostTypes\Taxonomy_Creator;

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}
$weekly_metabox = new Metabox(
    'post_of_the_week_metabox',
    'Post of the Week',
    'post'
);
$weekly_metabox->add_checkbox(
    'is_post_of_the_week',
    'Mark as Post of the Week',
    ['description' => 'Check this box to display this post as the Post of the Week on the blog page.']
);
$weekly_metabox->context('side')->priority('high');
