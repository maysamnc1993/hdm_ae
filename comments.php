<?php

/**
 * The template for displaying comments.
 *
 * This template handles the display of comments and the comment form, fully integrated with WordPress.
 * It uses Tailwind CSS for styling and maintains the existing visual appearance.
 *
 * @package JThem
 */

if (post_password_required()) {
    return;
}
?>

<section id="comments" class="tt-comments-list mt-10">
    <?php if (have_comments()) : ?>
        <h2 class="text-3xl font-light mb-6"><?php printf(_n('%d Comment', '%d Comments', get_comments_number(), 'jthem'), number_format_i18n(get_comments_number())); ?></h2>
        <ul class="list-none p-0 m-0" id="comments-list">
            <?php
            wp_list_comments([
                'style'       => 'ul',
                'short_ping'  => true,
                'avatar_size' => 50,
                'callback'    => function ($comment, $args, $depth) {
            ?>
                <li class="tt-comment bg-neutral-gray-500/10 p-5 rounded-[15px] mt-10 <?php echo $depth > 1 ? 'ml-10' : ''; ?>" id="comment-<?php comment_ID(); ?>">
                    <!-- <div class="tt-comment-avatar float-left mr-5 w-[50px] h-[50px] rounded-full overflow-hidden">
                        <?php echo get_avatar($comment, $args['avatar_size'], '', '', ['class' => 'w-full h-full object-cover object-center']); ?>
                    </div> -->
                    <div class="tt-comment-body relative block">
                        <div class="tt-comment-meta pr-[60px] mb-5 pb-5 border-b border-neutral-gray-500/26">
                            <h4 class="tt-comment-heading text-lg text-light overflow-hidden whitespace-nowrap text-ellipsis m-0 mb-2">
                                <a href="<?php echo esc_url(get_comment_author_url()); ?>" class="text-light bg-[length:0_96%] bg-no-repeat bg-[position:0_calc(100%-1px)] bg-gradient-to-b from-transparent to-current hover:bg-[length:100%_96%] transition-[background-size] duration-400"><?php comment_author(); ?></a>
                            </h4>
                            <time class="tt-comment-time block text-sm text-neutral-gray-100 mb-3" datetime="<?php echo esc_attr(get_comment_date('c')); ?>">
                                <?php echo esc_html(get_comment_date('F j, Y \a\t g:ia')); ?>
                            </time>
                        </div>
                        <span class="tt-comment-reply absolute top-5 right-5 text-sm italic text-neutral-gray-100 z-10">
                            <?php
                            comment_reply_link(array_merge($args, [
                                'depth'      => $depth,
                                'max_depth'  => $args['max_depth'],
                                'reply_text' => __('Reply', 'jthem'),
                                'add_below'  => 'comment',
                                'before'     => '<span class="bg-[length:0_96%] bg-no-repeat bg-[position:0_calc(100%-1px)] bg-gradient-to-b from-transparent to-current hover:bg-[length:100%_96%] transition-[background-size] duration-300">',
                                'after'      => '</span>',
                            ]));
                            ?>
                        </span>
                        <div class="tt-comment-text text-lg text-light clear-both">
                            <?php comment_text(); ?>
                            <?php if ($comment->comment_approved == '0') : ?>
                                <p class="text-sm text-neutral-gray-100 italic"><?php _e('Your comment is awaiting moderation.', 'jthem'); ?></p>
                            <?php endif; ?>
                        </div>
                    </div>
                </li>
            <?php
                },
            ]);
            ?>
        </ul>
        <?php if (get_comment_pages_count() > 1 && get_option('page_comments')) : ?>
            <nav class="comment-navigation flex justify-between mt-6">
                <div><?php previous_comments_link(__('Older Comments', 'jthem')); ?></div>
                <div><?php next_comments_link(__('Newer Comments', 'jthem')); ?></div>
            </nav>
        <?php endif; ?>
    <?php endif; ?>

    <?php if (!comments_open() && get_comments_number()) : ?>
        <p class="no-comments text-neutral-gray-100"><?php _e('Comments are closed.', 'jthem'); ?></p>
    <?php endif; ?>

    <?php
    comment_form([
        'id_form'           => 'tt-post-comment-form',
        'class_form'        => 'bg-neutral-gray-500/8 p-7 rounded-[15px] mt-10',
        'title_reply'       => __('Leave a Comment:', 'jthem'),
        'title_reply_before' => '<h4 class="tt-post-comment-form-heading text-2xl mb-3">',
        'title_reply_after'  => '</h4>',
        'comment_field'     => '<div class="tt-form-group mb-7"><label for="comment" class="inline-block mb-2 text-lg font-medium">' . __('Comment', 'jthem') . ' <span class="required text-brand-primary">*</span></label><textarea id="comment" name="comment" class="tt-form-control w-full bg-transparent p-3 text-lg text-light border border-brand-muted rounded-lg" rows="6" required></textarea></div>',
        'fields'            => [
            'author' => '<div class="tt-row flex flex-wrap -mx-2"><div class="tt-col-lg-6 w-full lg:w-1/2 px-2"><div class="tt-form-group mb-7"><label for="author" class="inline-block mb-2 text-lg font-medium">' . __('Name', 'jthem') . ' <span class="required text-brand-primary">*</span></label><input id="author" name="author" type="text" class="tt-form-control w-full bg-transparent p-3 h-14 text-lg text-light border border-brand-muted rounded-lg" required /></div></div>',
            'email'  => '<div class="tt-col-lg-6 w-full lg:w-1/2 px-2"><div class="tt-form-group mb-7"><label for="email" class="inline-block mb-2 text-lg font-medium">' . __('Email address', 'jthem') . ' <span class="text-sm text-neutral-gray-100">(Optional)</span></label><input id="email" name="email" type="email" class="tt-form-control w-full bg-transparent p-3 h-14 text-lg text-light border border-brand-muted rounded-lg" /></div></div></div>',
            'cookies' => '<p class="comment-form-cookies-consent mb-7"><input id="wp-comment-cookies-consent" name="wp-comment-cookies-consent" type="checkbox" value="yes" /><label for="wp-comment-cookies-consent" class="text-sm text-neutral-gray-100">' . __('Save my name, email, and website in this browser for the next time I comment.', 'jthem') . '</label></p>',
            'nonce' => '<input type="hidden" name="nonce" value="' . wp_create_nonce('comment_nonce') . '" />',
        ],
        'comment_notes_before' => '<small class="tt-form-text text-sm text-neutral-gray-100 block mb-7">' . __('Fields marked with an asterisk (*) are required!', 'jthem') . '</small>',
        'submit_field'      => '<div class="mt-5">%1$s %2$s</div>',
        'class_submit'      => 'tt-btn inline-block',
        'submit_button'     => render_cta_submit('Post Comment', 127),
    ]);
    ?>
</section>