<?php
global $post;
the_post(); // Ensure $post is se
/**
 * The template for displaying single posts
 *
 * @package JThem
 */

get_header();
theme_scripts('single-blog');
theme_part('global/banner');
$toc_data = generate_post_toc();
$toc_html = $toc_data['toc'];
$modified_content = $toc_data['content'];
?>



<main>
    <section>
        <div id="post-header" class="py-16 sm:py-20 overflow-clip">
            <div class="container">
                <div class="row lg:flex-nowrap items-center">
                    <div class="lg:col-6 text-center lg:text-left">
                        <div class="mb-6 flex flex-col sm:flex-row items-center justify-center lg:justify-start gap-x-4 gap-y-1">
                            <?php
                            $categories = get_the_category();
                            if (!empty($categories)) {
                                $category = $categories[0];
                                echo '<a class="uppercase bg-white/10 border border-border rounded-md px-3 py-2 text-sm block text-white hover:text-white hover:bg-dark transition-all duration-300 w-fit lg:mx-0" href="' . esc_url(get_category_link($category->term_id)) . '">' . esc_html($category->name) . '</a>';
                            }
                            ?>
                            <span class="font-light opacity-40">—</span>
                            <p><?php echo get_the_date('M d, Y'); ?></p>
                        </div>
                        <h1 class="text-3xl md:text-4xl !leading-relaxed mb-6 text-balance text-white">
                            <?php the_title(); ?>
                        </h1>
                        <ul class="flex flex-wrap items-center justify-center lg:justify-start gap-3 gap-y-1 uppercase text-sm text-white mb-14">
                            <li>
                                <a class="text-brand-primary flex items-center hover:text-white hover:underline transition-all duration-300" href="<?php echo esc_url(get_author_posts_url(get_the_author_meta('ID'))); ?>">
                                    <?php echo get_avatar(get_the_author_meta('ID'), 24, '', 'Author Avatar', ['class' => 'h-6 w-6 border border-[#ABABAB] rounded-full mr-2 bg-white/40']); ?>
                                    <?php the_author(); ?>
                                </a>
                            </li>
                            <li>•</li>
                            <li><?php echo ceil(str_word_count(wp_strip_all_tags(get_the_content())) / 200); ?> MIN TO READ</li>
                        </ul>
                    </div>
                    <div class="lg:col-8">
                        <div class="relative w-full h-[380px] lg:h-[460px]">
                            <?php if (has_post_thumbnail()) : ?>
                                <img alt="<?php the_title_attribute(); ?>" loading="lazy" class="rounded-xl object-cover bg-dark/10 w-full h-full" src="<?php echo esc_url(get_the_post_thumbnail_url(null, 'large')); ?>">
                            <?php else : ?>
                                <img alt="Placeholder" loading="lazy" class="rounded-xl object-cover bg-dark/10 w-full h-full" src="https://via.placeholder.com/520x660">
                            <?php endif; ?>
                            <svg class="absolute bottom-0 left-[96px] md:left-[104px] lg:left-[63px] z-20 rotate-[270deg] w-4 h-4 text-light" width="101" height="101" viewBox="0 0 101 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" clip-rule="evenodd" d="M101 0H0V101H1C1 45.7715 45.7715 1 101 1V0Z" fill="#00081F"></path>
                            </svg>
                            <svg class="absolute bottom-0 lg:bottom-[71px] left-[95px] md:left-[102px] lg:left-0 z-20 rotate-[270deg] w-4 h-4 text-light" width="101" height="101" viewBox="0 0 101 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" clip-rule="evenodd" d="M101 0H0V101H1C1 45.7715 45.7715 1 101 1V0Z" fill="#00081F"></path>
                            </svg>
                            <div class="bg-[#f6f5ed] border-8 border-light w-24 sm:w-28 absolute -bottom-10 left-3 lg:-left-12 rounded-full p-3 text-[15px] font-bold">
                                <svg class="uppercase" viewBox="0 0 100 100" xmlns="http://www.w3.org/2000/svg">
                                    <path id="circlePath" d="M 10, 50 a 40,40 0 1,1 80,0 40,40 0 1,1 -80,0" fill="none"></path>
                                    <text>
                                        <textPath href="#circlePath" class="font-light tracking-[0.07em] text-sm">
                                            — scroll down — read more
                                        </textPath>
                                    </text>
                                </svg>
                                <svg class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 text-primary" width="16" height="18" viewBox="0 0 16 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M9 1C9 0.447715 8.55228 -2.41412e-08 8 0C7.44772 2.41412e-08 7 0.447715 7 1L9 1ZM7.29289 17.7071C7.68342 18.0976 8.31658 18.0976 8.70711 17.7071L15.0711 11.3431C15.4616 10.9526 15.4616 10.3195 15.0711 9.92893C14.6805 9.53841 14.0474 9.53841 13.6569 9.92893L8 15.5858L2.34315 9.92893C1.95262 9.53841 1.31946 9.53841 0.928933 9.92893C0.538408 10.3195 0.538408 10.9526 0.928933 11.3431L7.29289 17.7071ZM7 1L7 17L9 17L9 1L7 1Z" fill="currentColor"></path>
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container hidden lg:block">
            <div class="row">
                <div class="col-12 mt-2">
                    <hr class="border-[#DBD8BD]">
                </div>
            </div>
        </div>

        <!-- Start Progressbar -->
        <div id="scroll-progress-block" class="bg-neutral-dark fixed top-0 z-[50] overflow-clip w-full -translate-y-full has-transition" style="transform: translateY(-100%);">
            <div class="px-3 h-8 sm:h-10 bg-white/30 relative grid place-content-center">
                <div id="scroll-progress-bar" class="absolute top-0 left-0 h-full bg-white/60" style="width: 0%;"></div>
                <p class="text-xs sm:text-sm line-clamp-1 relative z-50">
                    <?php the_title(); ?>
                </p>
            </div>
        </div>
        <!-- End Progressbar -->

        <div class="lg:pt-20 pb-16 sm:pb-20 overflow-clip">
            <div class="container">
                <div class="row g-6">
                    <div class="lg:col-8 xl:col-9">
                        <div class="block lg:hidden mb-8">
                            <nav class="toc-mobile border border-[#DBD8BD] rounded-xl lg:p-6">
                                <h3 class="font-secondary uppercase cursor-pointer lg:cursor-auto select-none flex lg:block justify-between items-center px-5 py-4 lg:p-0">
                                    <span class="text-sm sm:text-base">Table of Contents</span>
                                    <span class="block lg:hidden">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" fill="currentColor" height="1em">
                                            <path d="M256 80c0-17.7-14.3-32-32-32s-32 14.3-32 32V224H48c-17.7 0-32 14.3-32 32s14.3 32 32 32H192V432c0 17.7 14.3 32 32 32s32-14.3 32-32V288H400c17.7 0 32-14.3 32-32s-14.3-32-32-32H256V80z"></path>
                                        </svg>
                                    </span>
                                </h3>
                                <ol class="list-decimal pl-9 lg:pl-4 lg:mt-4 p-5 lg:p-0 !pt-0 hidden lg:block">
                                    <?php
                                    // Example TOC items; replace with dynamic TOC generation if available in theme
                                    $toc_items = ['embracing-playfulness' => 'Embracing Playfulness', 'cultivating-curiosity' => 'Cultivating Curiosity', 'experimenting-with-different-mediums' => 'Experimenting with Different Mediums', 'collaborating-with-others' => 'Collaborating with Others', 'embracing-failure' => 'Embracing Failure', 'conclusion' => 'Conclusion'];
                                    foreach ($toc_items as $id => $title) {
                                        echo '<li class="text-[#6c6c5f] mb-3 last:mb-0 text-[15px] group hover:text-secondary"><a href="#' . esc_attr($id) . '" class="has-line-link has-line-link-secondary text-white"><span class="line-link-el group-hover:text-secondary">' . esc_html($title) . '</span></a></li>';
                                    }
                                    ?>
                                </ol>
                            </nav>
                        </div>
                        <div id="post-content" class="prose content max-w-none">
                            <?php echo apply_filters('the_content', $modified_content); ?>
                        </div>
                        <div class="block lg:hidden mt-14 [&_p]:!text-start [&_ul]:!justify-start [&_hr]:!ml-0">
                            <div class="mt-8 relative">
                                <hr class="w-10 mb-7 mx-auto border-t border-white">
                                <p class="mb-3 text-xs opacity-65 uppercase text-center">Share this post</p>
                                <ul class="flex items-center justify-center gap-3">
                                    <li>
                                        <button class="h-10 w-10 flex items-center justify-center border border-white rounded-lg hover:bg-dark hover:text-white transition duration-300 copy-btn">
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 512" fill="currentColor" height="0.9em">
                                                <path d="M579.8 267.7c56.5-56.5 56.5-148 0-204.5c-50-50-128.8-56.5-186.3-15.4l-1.6 1.1c-14.4 10.3-17.7 30.3-7.4 44.6s30.3 17.7 44.6 7.4l1.6-1.1c32.1-22.9 76-19.3 103.8 8.6c31.5 31.5 31.5 82.5 0 114L422.3 334.8c-31.5 31.5-82.5 31.5-114 0c-27.9-27.9-31.5-71.8-8.6-103.8l1.1-1.6c10.3-14.4 6.9-34.4-7.4-44.6s-34.4-6.9-44.6 7.4l-1.1 1.6C206.5 251.2 213 330 263 380c56.5 56.5 148 56.5 204.5 0L579.8 267.7zM60.2 244.3c-56.5 56.5-56.5 148 0 204.5c50 50 128.8 56.5 186.3 15.4l1.6-1.1c14.4-10.3 17.7-30.3 7.4-44.6s-30.3-17.7-44.6-7.4l-1.6 1.1c-32.1 22.9-76 19.3-103.8-8.6C74 372 74 321 105.5 289.5L217.7 177.2c31.5-31.5 82.5-31.5 114 0c27.9 27.9 31.5 71.8 8.6 103.9l-1.1 1.6c-10.3 14.4-6.9 34.4 7.4 44.6s34.4 6.9 44.6-7.4l1.1-1.6C433.5 260.8 427 182 377 132c-56.5-56.5-148-56.5-204.5 0L60.2 244.3z"></path>
                                            </svg>
                                            <svg class="copied hidden" xmlns="http://www.w3.org/2000/svg" height="1.1em" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                <path d="m12 15 2 2 4-4"></path>
                                                <rect width="14" height="14" x="8" y="8" rx="2" ry="2"></rect>
                                                <path d="M4 16c-1.1 0-2-.9-2-2V4c0-1.1.9-2 2-2h10c1.1 0 2 .9 2 2"></path>
                                            </svg>
                                        </button>
                                    </li>
                                    <li>
                                        <a href="https://twitter.com/intent/tweet?text=<?php echo urlencode(get_the_title()); ?>&url=<?php echo urlencode(get_permalink()); ?>" target="_blank" rel="noopener noreferrer" class="h-10 w-10 flex items-center justify-center border border-white rounded-lg hover:bg-dark hover:text-white transition duration-300">
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" fill="currentColor" height="1em">
                                                <path d="M389.2 48h70.6L305.6 224.2 487 464H345L233.7 318.6 106.5 464H35.8L200.7 275.5 26.8 48H172.4L272.9 180.9 389.2 48zM364.4 421.8h39.1L151.1 88h-42L364.4 421.8z"></path>
                                            </svg>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="https://www.facebook.com/sharer.php?u=<?php echo urlencode(get_permalink()); ?>&quote=<?php echo urlencode(get_the_title()); ?>" target="_blank" rel="noopener noreferrer" class="h-10 w-10 flex items-center justify-center border border-white rounded-lg hover:bg-dark hover:text-white transition duration-300">
                                            <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 512 512" fill="currentColor">
                                                <path d="M504 256C504 119 393 8 256 8S8 119 8 256c0 123.78 90.69 226.38 209.25 245V327.69h-63V256h63v-54.64c0-62.15 37-96.48 93.67-96.48 27.14 0 55.52 4.84 55.52 4.84v61h-31.28c-30.8 0-40.41 19.12-40.41 38.73V256h68.78l-10 71.69h-57.78V501C413.31 482.38 504 379.78 504 256z"></path>
                                            </svg>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="https://www.linkedin.com/sharing/share-offsite/?url=<?php echo urlencode(get_permalink()); ?>" target="_blank" rel="noopener noreferrer" class="h-10 w-10 flex items-center justify-center border border-white rounded-lg hover:bg-dark hover:text-white transition duration-300">
                                            <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 448 512" fill="currentColor">
                                                <path d="M416 32H31.9C14.3 32 0 46.5 0 64.3v383.4C0 465.5 14.3 480 31.9 480H416c17.6 0 32-14.5 32-32.3V64.3c0-17.8-14.4-32.3-32-32.3zM135.4 416H69V202.2h66.5V416zm-33.2-243c-21.3 0-38.5-17.3-38.5-38.5S80.9 96 102.2 96c21.2 0 38.5 17.3 38.5 38.5 0 21.3-17.2 38.5-38.5 38.5zm282.1 243h-66.4V312c0-24.8-.5-56.7-34.5-56.7-34.6 0-39.9 27-39.9 54.9V416h-66.4V202.2h63.7v29.2h.9c8.9-16.8 30.6-34.5 62.9-34.5 67.2 0 79.7 44.3 79.7 101.9V416z"></path>
                                            </svg>
                                        </a>
                                    </li>
                                </ul>
                                <div class="lg:text-center text-xs mt-3 transition-all duration-300 absolute w-full opacity-0 invisible translate-y-3 copied-toast">
                                    URL Copied to clipboard
                                </div>
                            </div>
                        </div>
                        <div class="border border-[#DBD8BD] mt-10 lg:mt-20 rounded-lg">
                            <a class="flex flex-col sm:flex-row gap-y-5 gap-x-6 text-white transition-all duration-300 p-5 group" href="<?php echo esc_url(get_author_posts_url(get_the_author_meta('ID'))); ?>">
                                <?php echo get_avatar(get_the_author_meta('ID'), 128, '', 'Author Avatar', ['class' => 'rounded-lg h-28 w-28 bg-white/10 flex-shrink-0 object-cover']); ?>
                                <div class="self-center">
                                    <p class="text-2xl mb-2"><?php the_author(); ?></p>
                                    <p class="ml-auto opacity-75 mb-4"><?php echo esc_html(get_the_author_meta('description') ? 'Writer and Storyteller' : get_the_author_meta('description')); ?></p>
                                    <div class="prose max-w-none text-[15px] line-clamp-2">
                                        <p><?php echo esc_html(get_the_author_meta('description') ? get_the_author_meta('description') : 'This author has not provided a description.'); ?></p>
                                    </div>
                                    <p class="inline-flex items-center gap-3 mt-4 group-hover:text-primary transition-all duration-200 underline decoration-[#b4b6b9] group-hover:decoration-primary">
                                        Read Posts of - <?php the_author(); ?>
                                        <svg class="relative top-[2px]" width="10" height="10" viewBox="0 0 19 19" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M1.33008 17.4023L17.3301 1.40234M17.3301 1.40234H2.93008M17.3301 1.40234V15.8023" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"></path>
                                        </svg>
                                    </p>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="lg:col-4 xl:col-3 hidden lg:block">
                        <div class="sticky top-16">
                            <nav class="border border-white rounded-xl lg:p-6">
                                <h3 class="font-secondary uppercase cursor-pointer lg:cursor-auto select-none flex lg:block justify-between items-center px-5 py-4 lg:p-0">
                                    <span class="text-sm sm:text-base text-white">Table of Contents</span>
                                    <span class="block lg:hidden">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" fill="currentColor" height="1em">
                                            <path d="M256 80c0-17.7-14.3-32-32-32s-32 14.3-32 32V224H48c-17.7 0-32 14.3-32 32s14.3 32 32 32H192V432c0 17.7 14.3 32 32 32s32-14.3 32-32V288H400c17.7 0 32-14.3 32-32s-14.3-32-32-32H256V80z"></path>
                                        </svg>
                                    </span>
                                </h3>
                                <?php echo $toc_html; ?>
                            </nav>
                            <div class="mt-8 relative">
                                <hr class="w-10 mb-7 mx-auto border-t border-white">
                                <p class="mb-3 text-xs opacity-65 uppercase text-center">Share this post</p>
                                <ul class="flex items-center justify-center gap-3">
                                    <li>
                                        <button class="h-10 w-10 flex items-center justify-center border border-white rounded-lg hover:bg-dark hover:text-white transition duration-300 copy-btn">
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 512" fill="currentColor" height="0.9em">
                                                <path d="M579.8 267.7c56.5-56.5 56.5-148 0-204.5c-50-50-128.8-56.5-186.3-15.4l-1.6 1.1c-14.4 10.3-17.7 30.3-7.4 44.6s30.3 17.7 44.6 7.4l1.6-1.1c32.1-22.9 76-19.3 103.8 8.6c31.5 31.5 31.5 82.5 0 114L422.3 334.8c-31.5 31.5-82.5 31.5-114 0c-27.9-27.9-31.5-71.8-8.6-103.8l-1.1 1.6c10.3-14.4 6.9-34.4-7.4-44.6s-34.4-6.9-44.6 7.4l1.1-1.6C206.5 251.2 213 330 263 380c56.5 56.5 148 56.5 204.5 0L579.8 267.7zM60.2 244.3c-56.5 56.5-56.5 148 0 204.5c50 50 128.8 56.5 186.3 15.4l1.6-1.1c14.4-10.3 17.7-30.3 7.4-44.6s-30.3-17.7-44.6-7.4l-1.6 1.1c-32.1 22.9-76 19.3-103.8-8.6C74 372 74 321 105.5 289.5L217.7 177.2c31.5-31.5 82.5-31.5 114 0c27.9 27.9 31.5 71.8 8.6 103.9l-1.1 1.6c-10.3 14.4-6.9 34.4 7.4 44.6s34.4 6.9 44.6-7.4l1.1-1.6C433.5 260.8 427 182 377 132c-56.5-56.5-148-56.5-204.5 0L60.2 244.3z"></path>
                                            </svg>
                                            <svg class="copied hidden" xmlns="http://www.w3.org/2000/svg" height="1.1em" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                <path d="m12 15 2 2 4-4"></path>
                                                <rect width="14" height="14" x="8" y="8" rx="2" ry="2"></rect>
                                                <path d="M4 16c-1.1 0-2-.9-2-2V4c0-1.1.9-2 2-2h10c1.1 0 2 .9 2 2"></path>
                                            </svg>
                                        </button>
                                    </li>
                                    <li>
                                        <a href="https://twitter.com/intent/tweet?text=<?php echo urlencode(get_the_title()); ?>&url=<?php echo urlencode(get_permalink()); ?>" target="_blank" rel="noopener noreferrer" class="h-10 w-10 flex items-center justify-center border border-white rounded-lg hover:bg-dark text-white hover:text-white transition duration-300">
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" fill="currentColor" height="1em">
                                                <path d="M389.2 48h70.6L305.6 224.2 487 464H345L233.7 318.6 106.5 464H35.8L200.7 275.5 26.8 48H172.4L272.9 180.9 389.2 48zM364.4 421.8h39.1L151.1 88h-42L364.4 421.8z"></path>
                                            </svg>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="https://www.facebook.com/sharer.php?u=<?php echo urlencode(get_permalink()); ?>&quote=<?php echo urlencode(get_the_title()); ?>" target="_blank" rel="noopener noreferrer" class="h-10 w-10 flex items-center justify-center border border-white rounded-lg hover:bg-dark text-white hover:text-white transition duration-300">
                                            <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 512 512" fill="currentColor">
                                                <path d="M504 256C504 119 393 8 256 8S8 119 8 256c0 123.78 90.69 226.38 209.25 245V327.69h-63V256h63v-54.64c0-62.15 37-96.48 93.67-96.48 27.14 0 55.52 4.84 55.52 4.84v61h-31.28c-30.8 0-40.41 19.12-40.41 38.73V256h68.78l-10 71.69h-57.78V501C413.31 482.38 504 379.78 504 256z"></path>
                                            </svg>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="https://www.linkedin.com/sharing/share-offsite/?url=<?php echo urlencode(get_permalink()); ?>" target="_blank" rel="noopener noreferrer" class="h-10 w-10 flex items-center justify-center border border-white rounded-lg hover:bg-dark text-white hover:text-white transition duration-300">
                                            <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 448 512" fill="currentColor">
                                                <path d="M416 32H31.9C14.3 32 0 46.5 0 64.3v383.4C0 465.5 14.3 480 31.9 480H416c17.6 0 32-14.5 32-32.3V64.3c0-17.8-14.4-32.3-32-32.3zM135.4 416H69V202.2h66.5V416zm-33.2-243c-21.3 0-38.5-17.3-38.5-38.5S80.9 96 102.2 96c21.2 0 38.5 17.3 38.5 38.5 0 21.3-17.2 38.5-38.5 38.5zm282.1 243h-66.4V312c0-24.8-.5-56.7-34.5-56.7-34.6 0-39.9 27-39.9 54.9V416h-66.4V202.2h63.7v29.2h.9c8.9-16.8 30.6-34.5 62.9-34.5 67.2 0 79.7 44.3 79.7 101.9V416z"></path>
                                            </svg>
                                        </a>
                                    </li>
                                </ul>
                                <div class="lg:text-center text-xs mt-3 transition-all duration-300 absolute w-full opacity-0 invisible translate-y-3 copied-toast">
                                    URL Copied to clipboard
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="pb-16 sm:pb-24">
            <div class="container">
                <div class="border-t pt-8 border-[#DBD8BD]">
                    <div class="flex justify-between items-center sm:items-start">
                        <h2 class="text-base text-white uppercase font-secondary pl-4 relative after:absolute after:rounded-full -mt-1 after:content-[''] after:h-2 after:w-2 after:bg-primary after:left-0 after:top-2">
                            Suggested Posts
                        </h2>
                        <a class="button group animate-top-right" href="<?php echo esc_url(get_permalink(get_option('page_for_posts'))); ?>">
                            <span class="relative overflow-hidden transition-none [&>span]:block">
                                <span class="group-hover:-translate-y-[200%] group-hover:scale-y-[2] group-hover:rotate-12"><i class="hidden sm:inline not-italic">All Posts</i><i class="inline sm:hidden not-italic">All</i></span>
                                <span class="absolute left-0 top-0 scale-y-[2] rotate-12 translate-y-[200%] group-hover:translate-y-0 group-hover:scale-y-100 group-hover:rotate-0"><i class="hidden sm:inline not-italic">All Posts</i><i class="inline sm:hidden not-italic">All</i></span>
                            </span>
                            <span class="overflow-hidden leading-none -translate-y-[2px]">
                                <svg class="inline-block animate-icon" width="10" height="10" viewBox="0 0 10 10" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M1 9.00005L9 1.00005M9 1.00005H1.8M9 1.00005V8.20005" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                </svg>
                            </span>
                        </a>
                    </div>
                </div>
            </div>
            <div class="container mt-12">
                <div class="row gy-6">
                    <?php
                    $related_posts = new WP_Query([
                        'posts_per_page' => 3,
                        'post__not_in' => [get_the_ID()],
                        'category__in' => wp_get_post_categories(get_the_ID()),
                        'orderby' => 'rand',
                    ]);
                    if ($related_posts->have_posts()) :
                        while ($related_posts->have_posts()) : $related_posts->the_post();
                    ?>
                            <div class="md:col-6 lg:col-4">
                                <article class="post-card post-category-top group relative has-line-link">
                                    <div class="relative">
                                        <span class="post-category bg-neutral-dark text-white z-10">
                                            <?php
                                            $categories = get_the_category();
                                            if (!empty($categories)) {
                                                $category = $categories[0];
                                                echo '<a class="border-border transition duration-300 hover:bg-dark text-white hover:border-dark" href="' . esc_url(get_category_link($category->term_id)) . '">' . esc_html($category->name) . '</a>';
                                            }
                                            ?>
                                            <div class="text-light corner left"><svg width="101" height="101" viewBox="0 0 101 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M101 0H0V101H1C1 45.7715 45.7715 1 101 1V0Z" fill="#00081F"></path>
                                                </svg></div>
                                            <div class="text-light corner bottom"><svg width="101" height="101" viewBox="0 0 101 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M101 0H0V101H1C1 45.7715 45.7715 1 101 1V0Z" fill="#00081F"></path>
                                                </svg></div>
                                        </span>
                                        <?php if (has_post_thumbnail()) : ?>
                                            <img alt="<?php the_title_attribute(); ?>" loading="lazy" width="520" height="660" class="rounded-xl md:rounded-2xl w-full object-cover bg-white/40 h-80" src="<?php echo esc_url(get_the_post_thumbnail_url(null, 'medium_large')); ?>">
                                        <?php else : ?>
                                            <img alt="Placeholder" loading="lazy" width="520" height="660" class="rounded-xl md:rounded-2xl w-full object-cover bg-white/40 h-80" src="https://via.placeholder.com/520x660">
                                        <?php endif; ?>
                                    </div>
                                    <div class="mt-6 text-center">
                                        <span class="text-sm flex justify-center gap-2 items-center mb-3 uppercase">
                                            <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M12.6663 2.66677H11.333V2.0001C11.333 1.82329 11.2628 1.65372 11.1377 1.5287C11.0127 1.40367 10.8432 1.33344 10.6663 1.33344C10.4895 1.33344 10.32 1.40367 10.1949 1.5287C10.0699 1.65372 9.99967 1.82329 9.99967 2.0001V2.66677H5.99967V2.0001C5.99967 1.82329 5.92944 1.65372 5.80441 1.5287C5.67939 1.40367 5.50982 1.33344 5.33301 1.33344C5.1562 1.33344 4.98663 1.40367 4.8616 1.5287C4.73658 1.65372 4.66634 1.82329 4.66634 2.0001V2.66677H3.33301C2.80257 2.66677 2.29387 2.87748 1.91879 3.25255C1.54372 3.62763 1.33301 4.13633 1.33301 4.66677V12.6668C1.33301 13.1972 1.54372 13.7059 1.91879 14.081C2.29387 14.4561 2.80257 14.6668 3.33301 14.6668H12.6663C13.1968 14.6668 13.7055 14.4561 14.0806 14.081C14.4556 13.7059 14.6663 13.1972 14.6663 12.6668V4.66677C14.6663 4.13633 14.4556 3.62763 14.0806 3.25255C13.7055 2.87748 13.1968 2.66677 12.6663 2.66677ZM13.333 12.6668C13.333 12.8436 13.2628 13.0131 13.1377 13.1382C13.0127 13.2632 12.8432 13.3334 12.6663 13.3334H3.33301C3.1562 13.3334 2.98663 13.2632 2.8616 13.1382C2.73658 13.0131 2.66634 12.8436 2.66634 12.6668V8.0001H13.333V12.6668ZM13.333 6.66677H2.66634V4.66677C2.66634 4.48996 2.73658 4.32039 2.8616 4.19536C2.98663 4.07034 3.1562 4.0001 3.33301 4.0001H4.66634V4.66677C4.66634 4.84358 4.73658 5.01315 4.8616 5.13817C4.98663 5.2632 5.1562 5.33343 5.33301 5.33343C5.50982 5.33343 5.67939 5.2632 5.80441 5.13817C5.92944 5.01315 5.99967 4.84358 5.99967 4.66677V4.0001H9.99967V4.66677C9.99967 4.84358 10.0699 5.01315 10.1949 5.13817C10.32 5.2632 10.4895 5.33343 10.6663 5.33343C10.8432 5.33343 11.0127 5.2632 11.1377 5.13817C11.2628 5.01315 11.333 4.84358 11.333 4.66677V4.0001H12.6663C12.8432 4.0001 13.0127 4.07034 13.1377 4.19536C13.2628 4.32039 13.333 4.48996 13.333 4.66677V6.66677Z" fill="currentColor"></path>
                                            </svg>
                                            <?php echo get_the_date('M d, Y'); ?>
                                        </span>
                                        <h3 class="text-2xl text-white leading-relaxed mb-4 line-link">
                                            <a class="link-stretched line-link-el text-white" aria-label="<?php the_title_attribute(); ?>" href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                        </h3>
                                        <ul class="flex flex-wrap items-center justify-center gap-3 gap-y-1 mb-6 uppercase text-sm text-brand-primary">
                                            <li class="flex items-center">
                                                <?php echo get_avatar(get_the_author_meta('ID'), 24, '', 'Author Avatar', ['class' => 'h-6 w-6 border border-[#ABABAB] rounded-full mr-2 bg-white/40']); ?>
                                                <?php the_author(); ?>
                                            </li>
                                            <li>•</li>
                                            <li><?php echo ceil(str_word_count(wp_strip_all_tags(get_the_content())) / 200); ?> MIN TO READ</li>
                                        </ul>
                                        <span class="inline-block text-black group-hover:text-black group-hover:rotate-45 transition duration-300">
                                            <svg width="16" height="16" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M1.99902 18.0009L18 1.99991M18 1.99991H3.59912M18 1.99991V16.4008" stroke="black" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                            </svg>
                                        </span>
                                    </div>
                                </article>
                            </div>
                    <?php
                        endwhile;
                        wp_reset_postdata();
                    endif;
                    ?>
                </div>
            </div>
        </div>
        <div class="search-panel fixed bg-neutral-dark inset-0 z-[99] min-h-screen overflow-y-auto transition-all duration-300 no-scrollbar opacity-0 invisible pointer-events-none [&>div]:translate-y-2">
            <div class="[&>div]:px-3 sm:[&>div]:px-8 [&>div]:py-5 sm:[&>div]:py-12 [&>div]:rounded-lg [&>div]:md:rounded-xl w-full max-w-7xl mx-auto has-transition pointer-events-none [&>div]:pointer-events-auto z-50">
                <div>
                    <label for="search" class="relative">
                        <svg class="absolute -top-[2px] sm:-top-2 left-0 h-5 sm:h-7 w-5 sm:w-7" viewBox="0 0 21 21" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M20.3241 18.7231L14.5858 12.9807C15.7171 11.624 16.3975 9.89022 16.3975 7.99659C16.3975 3.67647 12.852 0.163818 8.49092 0.163818C4.12981 0.163818 0.576172 3.68057 0.576172 8.00069C0.576172 12.3208 4.12162 15.8335 8.48272 15.8335C10.3354 15.8335 12.0405 15.1981 13.3931 14.1366L19.1518 19.8953C19.4879 20.2314 19.988 20.2314 20.3241 19.8953C20.6602 19.5592 20.6602 19.0592 20.3241 18.7231ZM2.25667 8.00069C2.25667 4.6069 5.05204 1.84842 8.48272 1.84842C11.9134 1.84842 14.7088 4.6069 14.7088 8.00069C14.7088 11.3945 11.9134 14.153 8.48272 14.153C5.05204 14.153 2.25667 11.3904 2.25667 8.00069Z" fill="#817E61"></path>
                        </svg>
                        <input type="text" placeholder="Search entire blog..." id="search" aria-label="search-query" class="bg-transparent border-b border-borderLight focus:ring-0 focus:outline-none w-full text-white py-3 sm:py-4 text-xl sm:text-3xl font-primary placeholder:text-[#817E61] px-9 sm:px-12 focus:border-primary transition-all duration-500 outline-none shadow-none" autocomplete="off">
                    </label>
                    <button type="button" class="search-close-btn absolute top-6 sm:top-14 right-3 sm:right-7 xl:right-8 border border-primary text-primary z-[999] h-9 sm:h-11 w-9 sm:w-11 grid place-items-center cursor-pointer rounded-full hover:bg-primary hover:text-white hover:scale-105 has-transition focus:outline-none opacity-0 scale-75" aria-label="Close Search">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M18 6 6 18"></path>
                            <path d="m6 6 12 12"></path>
                        </svg>
                    </button>
                    <div class="border-t pt-8 border-[#DBD8BD] mb-10">
                        <div class="mb-8">
                            <h2 class="text-base font-secondary pl-4 relative after:absolute after:rounded-full -mt-1 after:content-[''] after:h-2 after:w-2 after:bg-primary after:left-0 after:top-2 [&>span]:text-primary [&>span]:font-bold [&>span]:lowercase">
                                <i class="uppercase not-italic">Recent Posts</i>
                            </h2>
                        </div>
                        <div class="row gy-2">
                            <?php
                            $recent_posts = new WP_Query(['posts_per_page' => 3, 'post__not_in' => [get_the_ID()]]);
                            if ($recent_posts->have_posts()) :
                                while ($recent_posts->have_posts()) : $recent_posts->the_post();
                            ?>
                                    <div class="lg:col-4">
                                        <div class="border-b border-border group relative has-line-link pb-3 h-full">
                                            <div class="flex gap-3">
                                                <div class="relative shrink-0">
                                                    <?php if (has_post_thumbnail()) : ?>
                                                        <img alt="<?php the_title_attribute(); ?>" loading="lazy" width="200" height="200" class="h-[100px] sm:h-[110px] w-20 sm:w-24 rounded-lg object-cover" src="<?php echo esc_url(get_the_post_thumbnail_url(null, 'thumbnail')); ?>">
                                                    <?php else : ?>
                                                        <img alt="Placeholder" loading="lazy" width="200" height="200" class="h-[100px] sm:h-[110px] w-20 sm:w-24 rounded-lg object-cover" src="https://via.placeholder.com/200x200">
                                                    <?php endif; ?>
                                                </div>
                                                <div class="self-center">
                                                    <span class="text-sm flex gap-2 items-center mb-2 sm:mb-3 uppercase text-brand-primary">
                                                        <svg fill="none" height="16" viewBox="0 0 16 16" width="16" xmlns="http://www.w3.org/2000/svg">
                                                            <path d="M12.6663 2.66677H11.333V2.0001C11.333 1.82329 11.2628 1.65372 11.1377 1.5287C11.0127 1.40367 10.8432 1.33344 10.6663 1.33344C10.4895 1.33344 10.32 1.40367 10.1949 1.5287C10.0699 1.65372 9.99967 1.82329 9.99967 2.0001V2.66677H5.99967V2.0001C5.99967 1.82329 5.92944 1.65372 5.80441 1.5287C5.67939 1.40367 5.50982 1.33344 5.33301 1.33344C5.1562 1.33344 4.98663 1.40367 4.8616 1.5287C4.73658 1.65372 4.66634 1.82329 4.66634 2.0001V2.66677H3.33301C2.80257 2.66677 2.29387 2.87748 1.91879 3.25255C1.54372 3.62763 1.33301 4.13633 1.33301 4.66677V12.6668C1.33301 13.1972 1.54372 13.7059 1.91879 14.081C2.29387 14.4561 2.80257 14.6668 3.33301 14.6668H12.6663C13.1968 14.6668 13.7055 14.4561 14.0806 14.081C14.4556 13.7059 14.6663 13.1972 14.6663 12.6668V4.66677C14.6663 4.13633 14.4556 3.62763 14.0806 3.25255C13.7055 2.87748 13.1968 2.66677 12.6663 2.66677ZM13.333 12.6668C13.333 12.8436 13.2628 13.0131 13.1377 13.1382C13.0127 13.2632 12.8432 13.3334 12.6663 13.3334H3.33301C3.1562 13.3334 2.98663 13.2632 2.8616 13.1382C2.73658 13.0131 2.66634 12.8436 2.66634 12.6668V8.0001H13.333V12.6668ZM13.333 6.66677H2.66634V4.66677C2.66634 4.48996 2.73658 4.32039 2.8616 4.19536C2.98663 4.07034 3.1562 4.0001 3.33301 4.0001H4.66634V4.66677C4.66634 4.84358 4.73658 5.01315 4.8616 5.13817C4.98663 5.2632 5.1562 5.33343 5.33301 5.33343C5.50982 5.33343 5.67939 5.2632 5.80441 5.13817C5.92944 5.01315 5.99967 4.84358 5.99967 4.66677V4.0001H9.99967V4.66677C9.99967 4.84358 10.0699 5.01315 10.1949 5.13817C10.32 5.2632 10.4895 5.33343 10.6663 5.33343C10.8432 5.33343 11.0127 5.2632 11.1377 5.13817C11.2628 5.01315 11.333 4.84358 11.333 4.66677V4.0001H12.6663C12.8432 4.0001 13.0127 4.07034 13.1377 4.19536C13.2628 4.32039 13.333 4.48996 13.333 4.66677V6.66677Z" fill="currentColor"></path>
                                                        </svg>
                                                        <?php echo get_the_date('M d, Y'); ?>
                                                    </span>
                                                    <h3 class="sm:text-lg text-white leading-relaxed line-link line-clamp-3">
                                                        <a class="link-stretched line-link-el text-white" href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                                    </h3>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                            <?php
                                endwhile;
                                wp_reset_postdata();
                            endif;
                            ?>
                        </div>
                        <div class="mt-14">
                            <div class="mb-8">
                                <h2 class="text-base uppercase font-secondary pl-4 relative after:absolute after:rounded-full -mt-1 after:content-[''] after:h-2 after:w-2 after:bg-primary after:left-0 after:top-2">
                                    Browse posts by Topics
                                </h2>
                            </div>
                            <div class="post-card">
                                <div class="post-category !static !flex flex-wrap gap-2 sm:gap-3 sm:justify-start justify-between">
                                    <?php
                                    $categories = get_categories(['hide_empty' => true]);
                                    foreach ($categories as $category) {
                                        echo '<a class="min-h-[40px] py-2 px-3 border-border transition duration-300 hover:bg-dark hover:text-white hover:border-dark !flex items-center gap-x-1 sm:w-auto w-[calc(50%-0.5rem)] justify-center text-center" href="' . esc_url(get_category_link($category->term_id)) . '">' . esc_html($category->name) . ' <span class="bg-primary text-white h-5 w-5 leading-5 rounded-full inline-block text-center text-xs ml-1">' . $category->count . '</span></a>';
                                    }
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="newsletter-panel fixed bg-dark/75 backdrop-blur-lg inset-0 z-[99] min-h-screen overflow-y-auto lg:flex items-center transition-all duration-300 no-scrollbar opacity-0 invisible [&>div]:translate-y-2">
            <button type="button" class="close-newsletter absolute top-6 sm:top-12 right-2 sm:right-12 bg-primary z-[999] h-12 w-12 grid place-items-center text-white cursor-pointer focus:outline-none rounded-full hover:bg-primary/80 hover:scale-105 has-transition scale-90 sm:scale-100 -translate-y-2" aria-label="Close Newsletter">
                <svg class="-ml-[1px] -mt-[1px]" xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M18 6 6 18"></path>
                    <path d="m6 6 12 12"></path>
                </svg>
            </button>
            <div class="close-newsletter fixed inset-0"></div>
            <div class="px-4 sm:px-10 py-10 [&>div]:rounded-lg [&>div]:md:rounded-xl w-full max-w-7xl mx-auto [&>div]:py-10 [&>div]:lg:py-24 has-transition pointer-events-none [&>div]:pointer-events-auto z-50">
                <div class="py-24 waveBg">
                    <div class="container">
                        <div class="row gy-4 items-center">
                            <div class="md:col-10 lg:col-6 text-center text-white mx-auto lg:mx-0">
                                <svg class="w-12 h-12 mx-auto mb-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="m3.75 13.5 10.5-11.25L12 10.5h8.25L9.75 21.75 12 13.5H3.75Z"></path>
                                </svg>
                                <h2 class="text-3xl sm:text-4xl lg:text-5xl text-balance !leading-tight text-white mb-6 max-w-sm mx-auto text-center">
                                    Subscribe to get the New e-book
                                </h2>
                                <p class="font-light leading-relaxed sm:mb-6">Subscribe for the news, articles, resources.</p>
                            </div>
                            <div class="lg:col-5">
                                <div class="newsletterBlock">
                                    <?php
                                    // Assuming a shortcode or widget for newsletter subscription; replace with your form
                                    echo do_shortcode('[your_newsletter_shortcode]');
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>


<?php get_footer(); ?>