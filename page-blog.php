<?php
// Template Name: archive blog

theme_scripts('blog');
get_header();
?>

<?php
get_template_part('template-parts/blog/section','featured-post');
get_template_part('template-parts/blog/section','category-list');
get_template_part('template-parts/blog/section','latest-articles');
get_template_part('template-parts/blog/section','popular-articles');
get_template_part('template-parts/blog/section','trending-articles');
get_template_part('template-parts/blog/section','post-of-the-week');

?>

<?php get_footer(); ?>