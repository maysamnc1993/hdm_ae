<?php
// Template Name: archive blog

theme_scripts('blog');
get_header();
?>

<section class="container my-36">
    <div class="row my-6 sm:my-10">
        <div class="lg:col-7">

            <article class="postBg transition-all duration-500 opacity-100 post-card group relative has-line-link-white rounded-2xl rounded-tr-none text-center px-4 sm:px-8 md:px-12 py-10 sm:py-16 mt-[52px] sm:mt-8">
                <div class="absolute -top-[31px] right-0 flex">
                    <svg class="text-brand-primary relative -right-px" width="86" height="32" viewBox="0 0 86 32" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M85.3511 32H0C8.17473 32 15.7118 28.9386 19.7164 23.9923L32.6592 8.00769C36.6639 3.06146 44.2025 0 52.3758 0H85.3511V32Z" fill="currentColor"></path>
                    </svg>
                    <div class="h-8 bg-brand-primary w-32 sm:w-52 rounded-tr-2xl"></div>
                </div>
                <h2 class="text-sm uppercase font-brand-primary pl-7 pr-3 py-1 after:absolute after:rounded-full after:content-[''] after:h-2 after:w-2 after:bg-primary after:left-3 after:top-[10px] text-white absolute bg-white/15 -top-4 right-4 rounded-full">
                    Featured Post</h2>
                <div class="mt-6 text-white">
                    <span class="text-sm flex gap-2 items-center justify-center mb-3 uppercase">
                        <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M12.6663 2.66677H11.333V2.0001C11.333 1.82329 11.2628 1.65372 11.1377 1.5287C11.0127 1.40367 10.8432 1.33344 10.6663 1.33344C10.4895 1.33344 10.32 1.40367 10.1949 1.5287C10.0699 1.65372 9.99967 1.82329 9.99967 2.0001V2.66677H5.99967V2.0001C5.99967 1.82329 5.92944 1.65372 5.80441 1.5287C5.67939 1.40367 5.50982 1.33344 5.33301 1.33344C5.1562 1.33344 4.98663 1.40367 4.8616 1.5287C4.73658 1.65372 4.66634 1.82329 4.66634 2.0001V2.66677H3.33301C2.80257 2.66677 2.29387 2.87748 1.91879 3.25255C1.54372 3.62763 1.33301 4.13633 1.33301 4.66677V12.6668C1.33301 13.1972 1.54372 13.7059 1.91879 14.081C2.29387 14.4561 2.80257 14.6668 3.33301 14.6668H12.6663C13.1968 14.6668 13.7055 14.4561 14.0806 14.081C14.4556 13.7059 14.6663 13.1972 14.6663 12.6668V4.66677C14.6663 4.13633 14.4556 3.62763 14.0806 3.25255C13.7055 2.87748 13.1968 2.66677 12.6663 2.66677ZM13.333 12.6668C13.333 12.8436 13.2628 13.0131 13.1377 13.1382C13.0127 13.2632 12.8432 13.3334 12.6663 13.3334H3.33301C3.1562 13.3334 2.98663 13.2632 2.8616 13.1382C2.73658 13.0131 2.66634 12.8436 2.66634 12.6668V8.0001H13.333V12.6668ZM13.333 6.66677H2.66634V4.66677C2.66634 4.48996 2.73658 4.32039 2.8616 4.19536C2.98663 4.07034 3.1562 4.0001 3.33301 4.0001H4.66634V4.66677C4.66634 4.84358 4.73658 5.01315 4.8616 5.13817C4.98663 5.2632 5.1562 5.33343 5.33301 5.33343C5.50982 5.33343 5.67939 5.2632 5.80441 5.13817C5.92944 5.01315 5.99967 4.84358 5.99967 4.66677V4.0001H9.99967V4.66677C9.99967 4.84358 10.0699 5.01315 10.1949 5.13817C10.32 5.2632 10.4895 5.33343 10.6663 5.33343C10.8432 5.33343 11.0127 5.2632 11.1377 5.13817C11.2628 5.01315 11.333 4.84358 11.333 4.66677V4.0001H12.6663C12.8432 4.0001 13.0127 4.07034 13.1377 4.19536C13.2628 4.32039 13.333 4.48996 13.333 4.66677V6.66677Z" fill="currentColor"></path>
                        </svg>
                        May 20, 2024
                    </span>
                    <h3 class="text-3xl sm:text-4xl text-white !leading-normal line-clamp-3">
                        <a class="link-stretched line-link-el text-white" aria-label="Cloud-Native Cybersecurity Startup Security Raises $60M Fund" href="blog-details.html">
                            Cloud-Native Cybersecurity Startup Security
                            Raises $60M Fund
                        </a>
                    </h3>
                    <ul class="flex flex-wrap items-center justify-center gap-3 gap-y-1 uppercase text-sm mt-6 mb-4">
                        <li class="flex items-center"><img alt="Author of the post - Kathryn Jackson" loading="lazy" width="24" height="24" class="h-6 w-6 border border-[#ABABAB] rounded-full mr-2" src="images/author/kathryn-jackson.jpg">
                            Kathryn Jackson
                        </li>
                        <li>•</li>
                        <li>02 MIN TO READ</li>
                    </ul><span class="h-12 sm:h-14 w-12 sm:w-14 m-auto flex items-center justify-center text-white sm:text-[#90A096] group-hover:text-white group-hover:bg-white/10 bg-white/30 sm:bg-transparent rounded-full transition-all duration-300 p-[17px] sm:p-0 group-hover:rotate-45">
                        <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M1.99902 18.0009L18 1.99991M18 1.99991H3.59912M18 1.99991V16.4008" stroke="white" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"></path>
                        </svg>
                    </span>
                </div>
            </article>
        </div>
        <div class="lg:col-5 relative hidden lg:block">
            <div class="post-card post-category-top relative">
                <div class="post-category bg-neutral-dark z-10">
                    <div class="flex items-center justify-end relative z-20">
                        <button class="flex items-center gap-3 uppercase text-white bg-black rounded-full py-[14px] px-5 cursor-pointer focus:outline-none active:outline-none active:border-none hover:bg-white hover:text-black group has-transition border-none font-medium menu-btn" type="button" aria-label="Toggle Navigation Menu">
                            <span class="w-5 cursor-pointer [&amp;&gt;span]:h-[2px] [&amp;&gt;span]:block [&amp;&gt;span]:bg-white group-hover:[&amp;&gt;span]:bg-black [&amp;&gt;span]:rounded [&amp;&gt;span]:has-transition ">
                                <span class="w-1/2 mb-1 "></span>
                                <span class="w-full mb-1 "></span>
                                <span class="w-1/2 ml-auto "></span>
                            </span>
                            Menu
                        </button>
                    </div>
                    <div class="text-light corner left">
                        <svg width="101" height="101" viewBox="0 0 101 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" clip-rule="evenodd" d="M101 0H0V101H1C1 45.7715 45.7715 1 101 1V0Z" fill="#00081F"></path>
                        </svg>
                    </div>
                    <span class="text-light corner bottom">
                        <svg width="101" height="101" viewBox="0 0 101 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" clip-rule="evenodd" d="M101 0H0V101H1C1 45.7715 45.7715 1 101 1V0Z" fill="#00081F"></path>
                        </svg>
                    </span>
                </div>
            </div>
            <div class="post-card post-category-bottom relative h-full transition-all duration-500 opacity-100">
                <div class="absolute w-full h-full">
                    <span class="post-category text-dark bg-neutral-dark z-10">
                        <a class="border-border transition duration-300 hover:bg-white text-white hover:text-primary-brand" href="category-single.html">security</a>
                        <span class="text-light corner left">
                            <svg width="101" height="101" viewBox="0 0 101 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" clip-rule="evenodd" d="M101 0H0V101H1C1 45.7715 45.7715 1 101 1V0Z" fill="#00081F"></path>
                            </svg>
                        </span>
                        <span class="text-light corner bottom">
                            <svg width="101" height="101" viewBox="0 0 101 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" clip-rule="evenodd" d="M101 0H0V101H1C1 45.7715 45.7715 1 101 1V0Z" fill="#00081F"></path>
                            </svg>
                        </span>
                    </span>
                    <?php
                    display_img("blog/post-03.jpg", 'rounded-xl md:rounded-2xl w-full max-h-full max-w-none object-cover h-full bg-white/40')
                    ?>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="sm:pt-5 pb-16 sm:pb-24 overflow-hidden">
    <div class="container mt-12">
        <div class="flex flex-col gap-6 my-12 items-center justify-center">
            <span class="text-brand-primary text-xl">Where I Can Help</span>

            <h2 class="section-title text-6xl font-bold text-center text-white">
                Our Process </h2>


        </div>
        <ul class="text-center flex flex-wrap justify-center gap-x-3 gap-y-4 sm:gap-6 lg:gap-8 [&amp;&gt;li]:text-2xl sm:[&amp;&gt;li]:text-3xl lg:[&amp;&gt;li]:text-4xl [&amp;&gt;li]:cursor-pointer font-primary text-black [&amp;&gt;li]:capitalize">
            <li class="relative group transition-all duration-300">
                <a class="inline-block text-white" href="category-single.html">
                    <span class="transition-all duration-100 relative z-30 group-hover:text-white group-hover:drop-shadow-lg">security</span>
                    <span class="absolute h-[80px] sm:h-[100px] lg:h-[130px] w-[140px] sm:w-[200px] lg:w-[250px] left-1/2 top-[35%] -translate-x-1/2 -translate-y-1/2 opacity-0 invisible scale-90 -rotate-12 transition-all duration-300 group-hover:opacity-100 group-hover:visible group-hover:scale-100 overflow-hidden rounded-lg z-20 pointer-events-none mt-4 group-hover:mt-0">
                        <img alt="security" loading="lazy" width="250" height="130" class="object-cover h-full w-full scale-125 group-hover:scale-100 transition-all duration-300" src="https://eyolo-html.vercel.app/images/blog/post-03.jpg"></span>
                </a>
                <span class="ml-3 sm:ml-6 lg:ml-8 opacity-30 text-white">/</span>
            </li>
            <li class="relative group transition-all duration-300">
                <a class="inline-block text-white" href="category-single.html">
                    <span class="transition-all duration-100 relative z-30 group-hover:text-white group-hover:drop-shadow-lg">lifestyle</span>
                    <span class="absolute h-[80px] sm:h-[100px] lg:h-[130px] w-[140px] sm:w-[200px] lg:w-[250px] left-1/2 top-[35%] -translate-x-1/2 -translate-y-1/2 opacity-0 invisible scale-90 -rotate-12 transition-all duration-300 group-hover:opacity-100 group-hover:visible group-hover:scale-100 overflow-hidden rounded-lg z-20 pointer-events-none mt-4 group-hover:mt-0">
                        <img alt="lifestyle" loading="lazy" width="250" height="130" class="object-cover h-full w-full scale-125 group-hover:scale-100 transition-all duration-300" src="https://eyolo-html.vercel.app/images/blog/post-09.jpg">
                    </span>
                </a>
                <span class="ml-3 sm:ml-6 lg:ml-8 opacity-30 text-white">/</span>
            </li>
            <li class="relative group transition-all duration-300">
                <a class="inline-block text-white" href="category-single.html">
                    <span class="transition-all duration-100 relative z-30 group-hover:text-white group-hover:drop-shadow-lg">web</span>
                    <span class="absolute h-[80px] sm:h-[100px] lg:h-[130px] w-[140px] sm:w-[200px] lg:w-[250px] left-1/2 top-[35%] -translate-x-1/2 -translate-y-1/2 opacity-0 invisible scale-90 -rotate-12 transition-all duration-300 group-hover:opacity-100 group-hover:visible group-hover:scale-100 overflow-hidden rounded-lg z-20 pointer-events-none mt-4 group-hover:mt-0">
                        <img alt="web" loading="lazy" width="250" height="130" class="object-cover h-full w-full scale-125 group-hover:scale-100 transition-all duration-300" src="https://eyolo-html.vercel.app/images/blog/post-07.jpg">
                    </span>
                </a>
                <span class="ml-3 sm:ml-6 lg:ml-8 opacity-30 text-white">/</span>
            </li>
            <li class="relative group transition-all duration-300">
                <a class="inline-block text-white" href="category-single.html">
                    <span class="transition-all duration-100 relative z-30 group-hover:text-white group-hover:drop-shadow-lg">
                        happiness
                    </span>
                    <span class="absolute h-[80px] sm:h-[100px] lg:h-[130px] w-[140px] sm:w-[200px] lg:w-[250px] left-1/2 top-[35%] -translate-x-1/2 -translate-y-1/2 opacity-0 invisible scale-90 -rotate-12 transition-all duration-300 group-hover:opacity-100 group-hover:visible group-hover:scale-100 overflow-hidden rounded-lg z-20 pointer-events-none mt-4 group-hover:mt-0">
                        <img alt="happiness" loading="lazy" width="250" height="130" class="object-cover h-full w-full scale-125 group-hover:scale-100 transition-all duration-300" src="https://eyolo-html.vercel.app/images/blog/post-02.jpg">
                    </span>
                </a>
                <span class="ml-3 sm:ml-6 lg:ml-8 opacity-30 text-white">/</span>
            </li>
            <li class="relative group transition-all duration-300">
                <a class="inline-block text-white" href="category-single.html">
                    <span class="transition-all duration-100 relative z-30 group-hover:text-white group-hover:drop-shadow-lg">
                        startups
                    </span>
                    <span class="absolute h-[80px] sm:h-[100px] lg:h-[130px] w-[140px] sm:w-[200px] lg:w-[250px] left-1/2 top-[35%] -translate-x-1/2 -translate-y-1/2 opacity-0 invisible scale-90 -rotate-12 transition-all duration-300 group-hover:opacity-100 group-hover:visible group-hover:scale-100 overflow-hidden rounded-lg z-20 pointer-events-none mt-4 group-hover:mt-0">
                        <img alt="startups" loading="lazy" width="250" height="130" class="object-cover h-full w-full scale-125 group-hover:scale-100 transition-all duration-300" src="https://eyolo-html.vercel.app/images/blog/post-01.jpg">
                    </span>
                </a>
                <span class="ml-3 sm:ml-6 lg:ml-8 opacity-30 text-white">/</span>
            </li>
            <li class="relative group transition-all duration-300"><a class="inline-block text-white" href="category-single.html"><span class="transition-all duration-100 relative z-30 group-hover:text-white group-hover:drop-shadow-lg">
                        career
                    </span>
                    <span class="absolute h-[80px] sm:h-[100px] lg:h-[130px] w-[140px] sm:w-[200px] lg:w-[250px] left-1/2 top-[35%] -translate-x-1/2 -translate-y-1/2 opacity-0 invisible scale-90 -rotate-12 transition-all duration-300 group-hover:opacity-100 group-hover:visible group-hover:scale-100 overflow-hidden rounded-lg z-20 pointer-events-none mt-4 group-hover:mt-0">
                        <img alt="career" loading="lazy" width="250" height="130" class="object-cover h-full w-full scale-125 group-hover:scale-100 transition-all duration-300" src="https://eyolo-html.vercel.app/images/blog/post-05.jpg">
                    </span>
                </a>
                <span class="ml-3 sm:ml-6 lg:ml-8 opacity-30 text-white">/</span>
            </li>
            <li class="relative group transition-all duration-300">
                <a class="inline-block text-white" href="category-single.html">
                    <span class="transition-all duration-100 relative z-30 group-hover:text-white group-hover:drop-shadow-lg">
                        self care
                    </span>
                    <span class="absolute h-[80px] sm:h-[100px] lg:h-[130px] w-[140px] sm:w-[200px] lg:w-[250px] left-1/2 top-[35%] -translate-x-1/2 -translate-y-1/2 opacity-0 invisible scale-90 -rotate-12 transition-all duration-300 group-hover:opacity-100 group-hover:visible group-hover:scale-100 overflow-hidden rounded-lg z-20 pointer-events-none mt-4 group-hover:mt-0">
                        <img alt="self care" loading="lazy" width="250" height="130" class="object-cover h-full w-full scale-125 group-hover:scale-100 transition-all duration-300" src="https://eyolo-html.vercel.app/images/blog/post-12.jpg">
                    </span>
                </a>
                <span class="ml-3 sm:ml-6 lg:ml-8 opacity-30 text-white">/</span>
            </li>
            <li class="relative group transition-all duration-300">
                <a class="inline-block text-white" href="category-single.html">
                    <span class="transition-all duration-100 relative z-30 group-hover:text-white group-hover:drop-shadow-lg">
                        digital marketing
                    </span>
                    <span class="absolute h-[80px] sm:h-[100px] lg:h-[130px] w-[140px] sm:w-[200px] lg:w-[250px] left-1/2 top-[35%] -translate-x-1/2 -translate-y-1/2 opacity-0 invisible scale-90 -rotate-12 transition-all duration-300 group-hover:opacity-100 group-hover:visible group-hover:scale-100 overflow-hidden rounded-lg z-20 pointer-events-none mt-4 group-hover:mt-0">
                        <img alt="digital marketing" loading="lazy" width="250" height="130" class="object-cover h-full w-full scale-125 group-hover:scale-100 transition-all duration-300" src="https://eyolo-html.vercel.app/images/blog/post-06.jpg">
                    </span>
                </a>
            </li>
        </ul>
    </div>
</section>


<section class="pb-16 sm:pb-24">
    <div class="container">
        <div class="col-12">
            <hr class="border-[#DBD8BD]">
        </div>
        <div class="row mt-16 sm:mt-24">
            <div class="lg:col-4 mb-14 lg:mb-0">
                <div class="sticky top-12 lg:pr-12 text-center lg:text-start text-white">
                    <p class="text-base text-white uppercase font-secondary pl-4 relative after:absolute after:rounded-full -mt-1 after:content-[''] after:h-2 after:w-2 after:bg-primary after:left-0 after:top-2 w-fit mb-8 mx-auto md:mx-0">
                        Latest Articles</p>
                    <h2 class="text-3xl md:text-4xl !leading-normal mb-4 text-white">Discover. Learn. Transform. Quick</h2>
                    <p class="text-white lg:mb-8 leading-relaxed font-light uppercase text-balance text-sm sm:text-base">
                        Latest Articles of Amet venenatis urna cursus eget nunc scelerisque viverra.</p>
                    <div class="hidden lg:inline-block">
                        <a class="button button-lg group animate-top-right text-white" href="blogs.html">
                            <span class="relative overflow-hidden transition-none [&amp;&gt;span]:block">
                                <span class="group-hover:-translate-y-[200%] group-hover:scale-y-[2] group-hover:rotate-12">All
                                    Posts
                                </span>
                                <span class="absolute left-0 top-0 scale-y-[2] rotate-12 translate-y-[200%] group-hover:translate-y-0 group-hover:scale-y-100 group-hover:rotate-0">All
                                    Posts
                                </span>
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
            <div class="lg:col-8">
                <div class="row gy-6">
                    <div class="md:col-6">
                        <article class="post-card post-category-top group relative has-line-link">
                            <div class="relative"><span class="post-category bg-light text-dark z-10"><a class="border-border transition duration-300 hover:bg-dark hover:text-white hover:border-dark" href="category-single.html">startups</a>
                                    <span class="text-light corner left">
                                        <svg width="101" height="101" viewBox="0 0 101 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd" clip-rule="evenodd" d="M101 0H0V101H1C1 45.7715 45.7715 1 101 1V0Z" fill="#00081f"></path>
                                        </svg>
                                    </span>
                                    <span class="text-light corner bottom">
                                        <svg width="101" height="101" viewBox="0 0 101 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd" clip-rule="evenodd" d="M101 0H0V101H1C1 45.7715 45.7715 1 101 1V0Z" fill="#00081f"></path>
                                        </svg>
                                    </span>
                                </span>
                                <img alt="First Look: Nine New Indie Bio Companies That Present to VCs NY Next Month" loading="lazy" width="520" height="660" class="rounded-xl md:rounded-2xl w-full object-cover bg-white/40 h-80" src="https://eyolo-html.vercel.app/images/blog/post-01.jpg">
                            </div>
                            <div class="mt-6 text-center">
                                <span class="text-sm flex justify-center gap-2 items-center mb-3 uppercase text-white">
                                    <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M12.6663 2.66677H11.333V2.0001C11.333 1.82329 11.2628 1.65372 11.1377 1.5287C11.0127 1.40367 10.8432 1.33344 10.6663 1.33344C10.4895 1.33344 10.32 1.40367 10.1949 1.5287C10.0699 1.65372 9.99967 1.82329 9.99967 2.0001V2.66677H5.99967V2.0001C5.99967 1.82329 5.92944 1.65372 5.80441 1.5287C5.67939 1.40367 5.50982 1.33344 5.33301 1.33344C5.1562 1.33344 4.98663 1.40367 4.8616 1.5287C4.73658 1.65372 4.66634 1.82329 4.66634 2.0001V2.66677H3.33301C2.80257 2.66677 2.29387 2.87748 1.91879 3.25255C1.54372 3.62763 1.33301 4.13633 1.33301 4.66677V12.6668C1.33301 13.1972 1.54372 13.7059 1.91879 14.081C2.29387 14.4561 2.80257 14.6668 3.33301 14.6668H12.6663C13.1968 14.6668 13.7055 14.4561 14.0806 14.081C14.4556 13.7059 14.6663 13.1972 14.6663 12.6668V4.66677C14.6663 4.13633 14.4556 3.62763 14.0806 3.25255C13.7055 2.87748 13.1968 2.66677 12.6663 2.66677ZM13.333 12.6668C13.333 12.8436 13.2628 13.0131 13.1377 13.1382C13.0127 13.2632 12.8432 13.3334 12.6663 13.3334H3.33301C3.1562 13.3334 2.98663 13.2632 2.8616 13.1382C2.73658 13.0131 2.66634 12.8436 2.66634 12.6668V8.0001H13.333V12.6668ZM13.333 6.66677H2.66634V4.66677C2.66634 4.48996 2.73658 4.32039 2.8616 4.19536C2.98663 4.07034 3.1562 4.0001 3.33301 4.0001H4.66634V4.66677C4.66634 4.84358 4.73658 5.01315 4.8616 5.13817C4.98663 5.2632 5.1562 5.33343 5.33301 5.33343C5.50982 5.33343 5.67939 5.2632 5.80441 5.13817C5.92944 5.01315 5.99967 4.84358 5.99967 4.66677V4.0001H9.99967V4.66677C9.99967 4.84358 10.0699 5.01315 10.1949 5.13817C10.32 5.2632 10.4895 5.33343 10.6663 5.33343C10.8432 5.33343 11.0127 5.2632 11.1377 5.13817C11.2628 5.01315 11.333 4.84358 11.333 4.66677V4.0001H12.6663C12.8432 4.0001 13.0127 4.07034 13.1377 4.19536C13.2628 4.32039 13.333 4.48996 13.333 4.66677V6.66677Z" fill="currentColor"></path>
                                    </svg>
                                    May 12, 2024
                                </span>
                                <h3 class="text-2xl text-white leading-relaxed mb-4 line-link line-clamp-3 min-h-30"><a class="link-stretched line-link-el text-white" aria-label="First Look: Nine New Indie Bio Companies That Present to VCs NY Next Month" href="blog-details.html">First Look: Nine
                                        New Indie Bio Companies That Present to VCs NY Next Month</a>
                                </h3>
                                <ul class="flex flex-wrap items-center justify-center gap-3 gap-y-1 mb-6 uppercase text-sm text-brand-primary">
                                    <li class="flex items-center">
                                        <img alt="Author of the post - Nilima Nike" loading="lazy" width="24" height="24" class="h-6 w-6 border border-[#ABABAB] rounded-full mr-2 bg-white/40" src="images/author/nilima-nike.jpg">
                                        Nilima
                                    </li>
                                    <li>•</li>
                                    <li>03 MIN TO READ</li>
                                </ul>
                                <span class="inline-block text-black group-hover:text-black group-hover:rotate-45 transition duration-300">
                                    <svg width="16" height="16" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M1.99902 18.0009L18 1.99991M18 1.99991H3.59912M18 1.99991V16.4008" stroke="black" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                    </svg>
                                </span>
                            </div>
                        </article>
                    </div>
                    <div class="md:col-6">
                        <article class="post-card post-category-top group relative has-line-link">
                            <div class="relative">
                                <span class="post-category bg-light text-dark z-10">
                                    <a class="border-border transition duration-300 hover:bg-dark hover:text-white hover:border-dark" href="category-single.html">
                                        career
                                    </a>
                                    <span class="text-light corner left">
                                        <svg width="101" height="101" viewBox="0 0 101 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd" clip-rule="evenodd" d="M101 0H0V101H1C1 45.7715 45.7715 1 101 1V0Z" fill="#00081f"></path>
                                        </svg>
                                    </span>
                                    <span class="text-light corner bottom">
                                        <svg width="101" height="101" viewBox="0 0 101 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd" clip-rule="evenodd" d="M101 0H0V101H1C1 45.7715 45.7715 1 101 1V0Z" fill="#00081f"></path>
                                        </svg>
                                    </span>
                                </span>
                                <img alt="Breaking into a Tech Support &amp; Devs Opportunity" loading="lazy" width="520" height="660" class="rounded-xl md:rounded-2xl w-full object-cover bg-white/40 h-80" src="https://eyolo-html.vercel.app/images/blog/post-05.jpg">
                            </div>
                            <div class="mt-6 text-center">
                                <span class="text-sm flex justify-center gap-2 items-center mb-3 uppercase text-white">
                                    <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M12.6663 2.66677H11.333V2.0001C11.333 1.82329 11.2628 1.65372 11.1377 1.5287C11.0127 1.40367 10.8432 1.33344 10.6663 1.33344C10.4895 1.33344 10.32 1.40367 10.1949 1.5287C10.0699 1.65372 9.99967 1.82329 9.99967 2.0001V2.66677H5.99967V2.0001C5.99967 1.82329 5.92944 1.65372 5.80441 1.5287C5.67939 1.40367 5.50982 1.33344 5.33301 1.33344C5.1562 1.33344 4.98663 1.40367 4.8616 1.5287C4.73658 1.65372 4.66634 1.82329 4.66634 2.0001V2.66677H3.33301C2.80257 2.66677 2.29387 2.87748 1.91879 3.25255C1.54372 3.62763 1.33301 4.13633 1.33301 4.66677V12.6668C1.33301 13.1972 1.54372 13.7059 1.91879 14.081C2.29387 14.4561 2.80257 14.6668 3.33301 14.6668H12.6663C13.1968 14.6668 13.7055 14.4561 14.0806 14.081C14.4556 13.7059 14.6663 13.1972 14.6663 12.6668V4.66677C14.6663 4.13633 14.4556 3.62763 14.0806 3.25255C13.7055 2.87748 13.1968 2.66677 12.6663 2.66677ZM13.333 12.6668C13.333 12.8436 13.2628 13.0131 13.1377 13.1382C13.0127 13.2632 12.8432 13.3334 12.6663 13.3334H3.33301C3.1562 13.3334 2.98663 13.2632 2.8616 13.1382C2.73658 13.0131 2.66634 12.8436 2.66634 12.6668V8.0001H13.333V12.6668ZM13.333 6.66677H2.66634V4.66677C2.66634 4.48996 2.73658 4.32039 2.8616 4.19536C2.98663 4.07034 3.1562 4.0001 3.33301 4.0001H4.66634V4.66677C4.66634 4.84358 4.73658 5.01315 4.8616 5.13817C4.98663 5.2632 5.1562 5.33343 5.33301 5.33343C5.50982 5.33343 5.67939 5.2632 5.80441 5.13817C5.92944 5.01315 5.99967 4.84358 5.99967 4.66677V4.0001H9.99967V4.66677C9.99967 4.84358 10.0699 5.01315 10.1949 5.13817C10.32 5.2632 10.4895 5.33343 10.6663 5.33343C10.8432 5.33343 11.0127 5.2632 11.1377 5.13817C11.2628 5.01315 11.333 4.84358 11.333 4.66677V4.0001H12.6663C12.8432 4.0001 13.0127 4.07034 13.1377 4.19536C13.2628 4.32039 13.333 4.48996 13.333 4.66677V6.66677Z" fill="currentColor"></path>
                                    </svg>
                                    May 10, 2024
                                </span>
                                <h3 class="text-2xl text-white leading-relaxed mb-4 line-link line-clamp-3 min-h-30"><a class="link-stretched line-link-el text-white" aria-label="Breaking into a Tech Support &amp; Devs Opportunity" href="blog-details.html">Breaking
                                        into a Tech Support &amp; Devs
                                        Opportunity</a></h3>
                                <ul class="flex flex-wrap items-center justify-center gap-3 gap-y-1 mb-6 uppercase text-sm text-brand-primary">
                                    <li class="flex items-center"><img alt="Author of the post - Alex Walton" loading="lazy" width="24" height="24" class="h-6 w-6 border border-[#ABABAB] rounded-full mr-2 bg-white/40" src="images/author/alex-walton.jpg">Alex</li>
                                    <li>•</li>
                                    <li>03 MIN TO READ</li>
                                </ul><span class="inline-block text-black group-hover:text-black group-hover:rotate-45 transition duration-300">
                                    <svg width="16" height="16" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M1.99902 18.0009L18 1.99991M18 1.99991H3.59912M18 1.99991V16.4008" stroke="black" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                    </svg>
                                </span>
                            </div>
                        </article>
                    </div>
                    <div class="md:col-6">
                        <article class="post-card post-category-top group relative has-line-link">
                            <div class="relative">
                                <span class="post-category bg-light text-dark z-10">
                                    <a class="border-border transition duration-300 hover:bg-dark hover:text-white hover:border-dark" href="category-single.html">lifestyle</a>
                                    <span class="text-light corner left">
                                        <svg width="101" height="101" viewBox="0 0 101 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd" clip-rule="evenodd" d="M101 0H0V101H1C1 45.7715 45.7715 1 101 1V0Z" fill="#00081f"></path>
                                        </svg>
                                    </span>
                                    <span class="text-light corner bottom">
                                        <svg width="101" height="101" viewBox="0 0 101 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd" clip-rule="evenodd" d="M101 0H0V101H1C1 45.7715 45.7715 1 101 1V0Z" fill="#00081f"></path>
                                        </svg>
                                    </span>
                                </span>
                                <img alt="Embracing Change: Navigating Life Transitions with Resilience" loading="lazy" width="520" height="660" class="rounded-xl md:rounded-2xl w-full object-cover bg-white/40 h-80" src="https://eyolo-html.vercel.app/images/blog/post-09.jpg">
                            </div>
                            <div class="mt-6 text-center"><span class="text-sm flex justify-center gap-2 items-center mb-3 uppercase text-white">
                                    <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M12.6663 2.66677H11.333V2.0001C11.333 1.82329 11.2628 1.65372 11.1377 1.5287C11.0127 1.40367 10.8432 1.33344 10.6663 1.33344C10.4895 1.33344 10.32 1.40367 10.1949 1.5287C10.0699 1.65372 9.99967 1.82329 9.99967 2.0001V2.66677H5.99967V2.0001C5.99967 1.82329 5.92944 1.65372 5.80441 1.5287C5.67939 1.40367 5.50982 1.33344 5.33301 1.33344C5.1562 1.33344 4.98663 1.40367 4.8616 1.5287C4.73658 1.65372 4.66634 1.82329 4.66634 2.0001V2.66677H3.33301C2.80257 2.66677 2.29387 2.87748 1.91879 3.25255C1.54372 3.62763 1.33301 4.13633 1.33301 4.66677V12.6668C1.33301 13.1972 1.54372 13.7059 1.91879 14.081C2.29387 14.4561 2.80257 14.6668 3.33301 14.6668H12.6663C13.1968 14.6668 13.7055 14.4561 14.0806 14.081C14.4556 13.7059 14.6663 13.1972 14.6663 12.6668V4.66677C14.6663 4.13633 14.4556 3.62763 14.0806 3.25255C13.7055 2.87748 13.1968 2.66677 12.6663 2.66677ZM13.333 12.6668C13.333 12.8436 13.2628 13.0131 13.1377 13.1382C13.0127 13.2632 12.8432 13.3334 12.6663 13.3334H3.33301C3.1562 13.3334 2.98663 13.2632 2.8616 13.1382C2.73658 13.0131 2.66634 12.8436 2.66634 12.6668V8.0001H13.333V12.6668ZM13.333 6.66677H2.66634V4.66677C2.66634 4.48996 2.73658 4.32039 2.8616 4.19536C2.98663 4.07034 3.1562 4.0001 3.33301 4.0001H4.66634V4.66677C4.66634 4.84358 4.73658 5.01315 4.8616 5.13817C4.98663 5.2632 5.1562 5.33343 5.33301 5.33343C5.50982 5.33343 5.67939 5.2632 5.80441 5.13817C5.92944 5.01315 5.99967 4.84358 5.99967 4.66677V4.0001H9.99967V4.66677C9.99967 4.84358 10.0699 5.01315 10.1949 5.13817C10.32 5.2632 10.4895 5.33343 10.6663 5.33343C10.8432 5.33343 11.0127 5.2632 11.1377 5.13817C11.2628 5.01315 11.333 4.84358 11.333 4.66677V4.0001H12.6663C12.8432 4.0001 13.0127 4.07034 13.1377 4.19536C13.2628 4.32039 13.333 4.48996 13.333 4.66677V6.66677Z" fill="currentColor"></path>
                                    </svg>
                                    Apr 23, 2024</span>
                                <h3 class="text-2xl text-white leading-relaxed mb-4 line-link line-clamp-3 min-h-30"><a class="link-stretched line-link-el text-white" aria-label="Embracing Change: Navigating Life Transitions with Resilience" href="blog-details.html">Embracing Change: Navigating
                                        Life
                                        Transitions with Resilience</a></h3>
                                <ul class="flex flex-wrap items-center justify-center gap-3 gap-y-1 mb-6 uppercase text-sm text-brand-primary">
                                    <li class="flex items-center">
                                        <img alt="Author of the post - Alex Walton" loading="lazy" width="24" height="24" class="h-6 w-6 border border-[#ABABAB] rounded-full mr-2 bg-white/40" src="images/author/alex-walton.jpg">Alex
                                    </li>
                                    <li>•</li>
                                    <li>03 MIN TO READ</li>
                                </ul>
                                <span class="inline-block text-black group-hover:text-black group-hover:rotate-45 transition duration-300">
                                    <svg width="16" height="16" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M1.99902 18.0009L18 1.99991M18 1.99991H3.59912M18 1.99991V16.4008" stroke="black" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                    </svg>
                                </span>
                            </div>
                        </article>
                    </div>
                    <div class="md:col-6">
                        <article class="post-card post-category-top group relative has-line-link">
                            <div class="relative">
                                <span class="post-category bg-light text-dark z-10">
                                    <a class="border-border transition duration-300 hover:bg-dark hover:text-white hover:border-dark" href="category-single.html">self-care
                                    </a>
                                    <span class="text-light corner left">
                                        <svg width="101" height="101" viewBox="0 0 101 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd" clip-rule="evenodd" d="M101 0H0V101H1C1 45.7715 45.7715 1 101 1V0Z" fill="#00081f"></path>
                                        </svg>
                                    </span>
                                    <span class="text-light corner bottom">
                                        <svg width="101" height="101" viewBox="0 0 101 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd" clip-rule="evenodd" d="M101 0H0V101H1C1 45.7715 45.7715 1 101 1V0Z" fill="#00081f"></path>
                                        </svg>
                                    </span>
                                </span>
                                <img alt="Finding Balance: Prioritizing Self-Care in a Busy World" loading="lazy" width="520" height="660" class="rounded-xl md:rounded-2xl w-full object-cover bg-white/40 h-80" src="https://eyolo-html.vercel.app/images/blog/post-12.jpg">
                            </div>
                            <div class="mt-6 text-center">
                                <span class="text-sm flex justify-center gap-2 items-center mb-3 uppercase text-white">
                                    <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M12.6663 2.66677H11.333V2.0001C11.333 1.82329 11.2628 1.65372 11.1377 1.5287C11.0127 1.40367 10.8432 1.33344 10.6663 1.33344C10.4895 1.33344 10.32 1.40367 10.1949 1.5287C10.0699 1.65372 9.99967 1.82329 9.99967 2.0001V2.66677H5.99967V2.0001C5.99967 1.82329 5.92944 1.65372 5.80441 1.5287C5.67939 1.40367 5.50982 1.33344 5.33301 1.33344C5.1562 1.33344 4.98663 1.40367 4.8616 1.5287C4.73658 1.65372 4.66634 1.82329 4.66634 2.0001V2.66677H3.33301C2.80257 2.66677 2.29387 2.87748 1.91879 3.25255C1.54372 3.62763 1.33301 4.13633 1.33301 4.66677V12.6668C1.33301 13.1972 1.54372 13.7059 1.91879 14.081C2.29387 14.4561 2.80257 14.6668 3.33301 14.6668H12.6663C13.1968 14.6668 13.7055 14.4561 14.0806 14.081C14.4556 13.7059 14.6663 13.1972 14.6663 12.6668V4.66677C14.6663 4.13633 14.4556 3.62763 14.0806 3.25255C13.7055 2.87748 13.1968 2.66677 12.6663 2.66677ZM13.333 12.6668C13.333 12.8436 13.2628 13.0131 13.1377 13.1382C13.0127 13.2632 12.8432 13.3334 12.6663 13.3334H3.33301C3.1562 13.3334 2.98663 13.2632 2.8616 13.1382C2.73658 13.0131 2.66634 12.8436 2.66634 12.6668V8.0001H13.333V12.6668ZM13.333 6.66677H2.66634V4.66677C2.66634 4.48996 2.73658 4.32039 2.8616 4.19536C2.98663 4.07034 3.1562 4.0001 3.33301 4.0001H4.66634V4.66677C4.66634 4.84358 4.73658 5.01315 4.8616 5.13817C4.98663 5.2632 5.1562 5.33343 5.33301 5.33343C5.50982 5.33343 5.67939 5.2632 5.80441 5.13817C5.92944 5.01315 5.99967 4.84358 5.99967 4.66677V4.0001H9.99967V4.66677C9.99967 4.84358 10.0699 5.01315 10.1949 5.13817C10.32 5.2632 10.4895 5.33343 10.6663 5.33343C10.8432 5.33343 11.0127 5.2632 11.1377 5.13817C11.2628 5.01315 11.333 4.84358 11.333 4.66677V4.0001H12.6663C12.8432 4.0001 13.0127 4.07034 13.1377 4.19536C13.2628 4.32039 13.333 4.48996 13.333 4.66677V6.66677Z" fill="currentColor"></path>
                                    </svg>
                                    Apr 09, 2024
                                </span>
                                <h3 class="text-2xl text-white leading-relaxed mb-4 line-link line-clamp-3 min-h-30">
                                    <a class="link-stretched line-link-el text-white" aria-label="Finding Balance: Prioritizing Self-Care in a Busy World" href="blog-details.html">Finding Balance:
                                        Prioritizing Self-Care
                                        in a Busy World</a>
                                </h3>
                                <ul class="flex flex-wrap items-center justify-center gap-3 gap-y-1 mb-6 uppercase text-sm text-brand-primary">
                                    <li class="flex items-center">
                                        <img alt="Author of the post - Kathryn Jackson" loading="lazy" width="24" height="24" class="h-6 w-6 border border-[#ABABAB] rounded-full mr-2 bg-white/40" src="images/author/kathryn-jackson.jpg">Kathryn
                                    </li>
                                    <li>•</li>
                                    <li>03 MIN TO READ</li>
                                </ul>
                                <span class="inline-block text-black group-hover:text-black group-hover:rotate-45 transition duration-300">
                                    <svg width="16" height="16" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M1.99902 18.0009L18 1.99991M18 1.99991H3.59912M18 1.99991V16.4008" stroke="black" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                    </svg>
                                </span>
                            </div>
                        </article>
                    </div>
                    <div class="col-12 block lg:hidden">
                        <a class="button button-lg group animate-top-right w-fit mx-auto" href="blogs.html">
                            <span class="relative overflow-hidden transition-none [&amp;&gt;span]:block">
                                <span class="group-hover:-translate-y-[200%] group-hover:scale-y-[2] group-hover:rotate-12">All
                                    Posts</span>
                                <span class="absolute left-0 top-0 scale-y-[2] rotate-12 translate-y-[200%] group-hover:translate-y-0 group-hover:scale-y-100 group-hover:rotate-0">All
                                    Posts</span>
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
        </div>
    </div>
</section>



<section class="py-16 sm:py-24 darkBg">
    <div class="container">
        <div class="row">
            <div class="lg:col-5 mb-14 lg:mb-0">
                <div class="sticky top-12 lg:pr-12 text-center md:text-start">
                    <p class="text-white text-base uppercase font-secondary pl-4 relative after:absolute after:rounded-full -mt-1 after:content-[''] after:h-2 after:w-2 after:bg-primary after:left-0 after:top-2 w-fit mb-8 mx-auto md:mx-0">
                        Popular Articles</p>
                    <h2 class="text-3xl md:text-4xl text-white !leading-normal mb-4">Business insights and workplace culture
                    </h2>
                    <p class="text-[#9C9C9C] md:mb-8 leading-relaxed uppercase font-light text-balance">Popular Articles
                        of
                        consectetur morbi. Amet venenatis urna cursus eget nunc scelerisque viverra.</p>
                    <div class="hidden md:inline-block">
                        <a class="button button-lg button-light group animate-top-right" href="blogs.html">
                            <span class="relative overflow-hidden transition-none [&amp;&gt;span]:block"><span class="group-hover:-translate-y-[200%] group-hover:scale-y-[2] group-hover:rotate-12">All
                                    Posts
                                </span>
                                <span class="absolute left-0 top-0 scale-y-[2] rotate-12 translate-y-[200%] group-hover:translate-y-0 group-hover:scale-y-100 group-hover:rotate-0">All
                                    Posts
                                </span>
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
            <div class="lg:col-7">
                <div class="mb-16 md:mr-20">
                    <article class="post-card post-category-top group relative has-line-link-white">
                        <div class="relative">
                            <span class="post-category text-white bg-black z-10">
                                <a class="transition duration-300 bg-black text-white border-white/30 hover:bg-white hover:text-dark" href="category-single.html">creativity</a>
                                <span class="text-black corner left">
                                    <svg width="101" height="101" viewBox="0 0 101 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" clip-rule="evenodd" d="M101 0H0V101H1C1 45.7715 45.7715 1 101 1V0Z" fill="currentColor"></path>
                                    </svg>
                                </span>
                                <span class="text-black corner bottom">
                                    <svg width="101" height="101" viewBox="0 0 101 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" clip-rule="evenodd" d="M101 0H0V101H1C1 45.7715 45.7715 1 101 1V0Z" fill="currentColor"></path>
                                    </svg>
                                </span>
                            </span>
                            <img alt="Unleashing Creativity: Exploring Creative Practices to Spark Innovation" loading="lazy" width="742" height="500" class="rounded-xl md:rounded-2xl h-[360px] w-full object-cover bg-white/10" src="https://eyolo-html.vercel.app/images/blog/post-11.jpg">
                        </div>
                        <div class="mt-6 text-white text-center">
                            <span class="text-sm flex gap-2 items-center mb-3 uppercase justify-center">
                                <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M12.6663 2.66677H11.333V2.0001C11.333 1.82329 11.2628 1.65372 11.1377 1.5287C11.0127 1.40367 10.8432 1.33344 10.6663 1.33344C10.4895 1.33344 10.32 1.40367 10.1949 1.5287C10.0699 1.65372 9.99967 1.82329 9.99967 2.0001V2.66677H5.99967V2.0001C5.99967 1.82329 5.92944 1.65372 5.80441 1.5287C5.67939 1.40367 5.50982 1.33344 5.33301 1.33344C5.1562 1.33344 4.98663 1.40367 4.8616 1.5287C4.73658 1.65372 4.66634 1.82329 4.66634 2.0001V2.66677H3.33301C2.80257 2.66677 2.29387 2.87748 1.91879 3.25255C1.54372 3.62763 1.33301 4.13633 1.33301 4.66677V12.6668C1.33301 13.1972 1.54372 13.7059 1.91879 14.081C2.29387 14.4561 2.80257 14.6668 3.33301 14.6668H12.6663C13.1968 14.6668 13.7055 14.4561 14.0806 14.081C14.4556 13.7059 14.6663 13.1972 14.6663 12.6668V4.66677C14.6663 4.13633 14.4556 3.62763 14.0806 3.25255C13.7055 2.87748 13.1968 2.66677 12.6663 2.66677ZM13.333 12.6668C13.333 12.8436 13.2628 13.0131 13.1377 13.1382C13.0127 13.2632 12.8432 13.3334 12.6663 13.3334H3.33301C3.1562 13.3334 2.98663 13.2632 2.8616 13.1382C2.73658 13.0131 2.66634 12.8436 2.66634 12.6668V8.0001H13.333V12.6668ZM13.333 6.66677H2.66634V4.66677C2.66634 4.48996 2.73658 4.32039 2.8616 4.19536C2.98663 4.07034 3.1562 4.0001 3.33301 4.0001H4.66634V4.66677C4.66634 4.84358 4.73658 5.01315 4.8616 5.13817C4.98663 5.2632 5.1562 5.33343 5.33301 5.33343C5.50982 5.33343 5.67939 5.2632 5.80441 5.13817C5.92944 5.01315 5.99967 4.84358 5.99967 4.66677V4.0001H9.99967V4.66677C9.99967 4.84358 10.0699 5.01315 10.1949 5.13817C10.32 5.2632 10.4895 5.33343 10.6663 5.33343C10.8432 5.33343 11.0127 5.2632 11.1377 5.13817C11.2628 5.01315 11.333 4.84358 11.333 4.66677V4.0001H12.6663C12.8432 4.0001 13.0127 4.07034 13.1377 4.19536C13.2628 4.32039 13.333 4.48996 13.333 4.66677V6.66677Z" fill="currentColor"></path>
                                </svg>
                                Dec 15, 2023
                            </span>
                            <h3 class="text-2xl text-white leading-relaxed">
                                <a class="link-stretched line-link-el" href="blog-details.html">Unleashing Creativity:
                                    Exploring Creative Practices to Spark Innovation
                                </a>
                            </h3>
                            <ul class="flex flex-wrap items-center gap-3 gap-y-1 uppercase text-sm my-6 text-white/75 justify-center">
                                <li class="flex items-center">
                                    <img alt="Author of the post - Nilima Nike" loading="lazy" width="24" height="24" class="h-6 w-6 border border-[#ABABAB] rounded-full mr-2 bg-white/5" src="images/author/nilima-nike.jpg">Nilima Nike
                                </li>
                                <li>•</li>
                                <li>02 MIN TO READ</li>
                            </ul>
                            <a class="inline-block text-[#90A096] group-hover:text-white group-hover:rotate-45 transition duration-300 mt-4" aria-label="Read More about Unleashing Creativity: Exploring Creative Practices to Spark Innovation" href="blog-details.html">
                                <svg width="16" height="16" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M1.99902 18.0009L18 1.99991M18 1.99991H3.59912M18 1.99991V16.4008" stroke="white" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                </svg>
                            </a>
                        </div>
                    </article>
                </div>
                <div class="mb-16 md:ml-20">
                    <article class="post-card post-category-top group relative has-line-link-white">
                        <div class="relative"><span class="post-category text-white bg-black z-10"><a class="transition duration-300 bg-black text-white border-white/30 hover:bg-white hover:text-dark" href="category-single.html">web</a>
                                <span class="text-black corner left">
                                    <svg width="101" height="101" viewBox="0 0 101 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" clip-rule="evenodd" d="M101 0H0V101H1C1 45.7715 45.7715 1 101 1V0Z" fill="currentColor"></path>
                                    </svg>
                                </span>
                                <span class="text-black corner bottom">
                                    <svg width="101" height="101" viewBox="0 0 101 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" clip-rule="evenodd" d="M101 0H0V101H1C1 45.7715 45.7715 1 101 1V0Z" fill="currentColor"></path>
                                    </svg>
                                </span>
                            </span>
                            <img alt="How to Add Claps to Your Blog and Testimonial Things" loading="lazy" width="742" height="500" class="rounded-xl md:rounded-2xl h-[360px] w-full object-cover bg-white/10" src="https://eyolo-html.vercel.app/images/blog/post-04.jpg">
                        </div>
                        <div class="mt-6 text-white text-center">
                            <span class="text-sm flex gap-2 items-center mb-3 uppercase justify-center">
                                <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M12.6663 2.66677H11.333V2.0001C11.333 1.82329 11.2628 1.65372 11.1377 1.5287C11.0127 1.40367 10.8432 1.33344 10.6663 1.33344C10.4895 1.33344 10.32 1.40367 10.1949 1.5287C10.0699 1.65372 9.99967 1.82329 9.99967 2.0001V2.66677H5.99967V2.0001C5.99967 1.82329 5.92944 1.65372 5.80441 1.5287C5.67939 1.40367 5.50982 1.33344 5.33301 1.33344C5.1562 1.33344 4.98663 1.40367 4.8616 1.5287C4.73658 1.65372 4.66634 1.82329 4.66634 2.0001V2.66677H3.33301C2.80257 2.66677 2.29387 2.87748 1.91879 3.25255C1.54372 3.62763 1.33301 4.13633 1.33301 4.66677V12.6668C1.33301 13.1972 1.54372 13.7059 1.91879 14.081C2.29387 14.4561 2.80257 14.6668 3.33301 14.6668H12.6663C13.1968 14.6668 13.7055 14.4561 14.0806 14.081C14.4556 13.7059 14.6663 13.1972 14.6663 12.6668V4.66677C14.6663 4.13633 14.4556 3.62763 14.0806 3.25255C13.7055 2.87748 13.1968 2.66677 12.6663 2.66677ZM13.333 12.6668C13.333 12.8436 13.2628 13.0131 13.1377 13.1382C13.0127 13.2632 12.8432 13.3334 12.6663 13.3334H3.33301C3.1562 13.3334 2.98663 13.2632 2.8616 13.1382C2.73658 13.0131 2.66634 12.8436 2.66634 12.6668V8.0001H13.333V12.6668ZM13.333 6.66677H2.66634V4.66677C2.66634 4.48996 2.73658 4.32039 2.8616 4.19536C2.98663 4.07034 3.1562 4.0001 3.33301 4.0001H4.66634V4.66677C4.66634 4.84358 4.73658 5.01315 4.8616 5.13817C4.98663 5.2632 5.1562 5.33343 5.33301 5.33343C5.50982 5.33343 5.67939 5.2632 5.80441 5.13817C5.92944 5.01315 5.99967 4.84358 5.99967 4.66677V4.0001H9.99967V4.66677C9.99967 4.84358 10.0699 5.01315 10.1949 5.13817C10.32 5.2632 10.4895 5.33343 10.6663 5.33343C10.8432 5.33343 11.0127 5.2632 11.1377 5.13817C11.2628 5.01315 11.333 4.84358 11.333 4.66677V4.0001H12.6663C12.8432 4.0001 13.0127 4.07034 13.1377 4.19536C13.2628 4.32039 13.333 4.48996 13.333 4.66677V6.66677Z" fill="currentColor"></path>
                                </svg>
                                Feb 07, 2023
                            </span>
                            <h3 class="text-2xl text-white leading-relaxed">
                                <a class="link-stretched line-link-el" href="blog-details.html">How to
                                    Add Claps to Your Blog and Testimonial Things
                                </a>
                            </h3>
                            <ul class="flex flex-wrap items-center gap-3 gap-y-1 uppercase text-sm my-6 text-white/75 justify-center">
                                <li class="flex items-center">
                                    <img alt="Author of the post - Nilima Nike" loading="lazy" width="24" height="24" class="h-6 w-6 border border-[#ABABAB] rounded-full mr-2 bg-white/5" src="images/author/nilima-nike.jpg">Nilima Nike
                                </li>
                                <li>•</li>
                                <li>02 MIN TO READ</li>
                            </ul>
                            <a class="inline-block text-[#90A096] group-hover:text-white group-hover:rotate-45 transition duration-300 mt-4" aria-label="Read More about How to Add Claps to Your Blog and Testimonial Things" href="blog-details.html">
                                <svg width="16" height="16" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M1.99902 18.0009L18 1.99991M18 1.99991H3.59912M18 1.99991V16.4008" stroke="white" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                </svg>
                            </a>
                        </div>
                    </article>
                </div>
                <div class="mb-16 md:mr-20">
                    <article class="post-card post-category-top group relative has-line-link-white">
                        <div class="relative">
                            <span class="post-category text-white bg-black z-10">
                                <a class="transition duration-300 bg-black text-white border-white/30 hover:bg-white hover:text-dark" href="category-single.html">relationships
                                </a>
                                <span class="text-black corner left">
                                    <svg width="101" height="101" viewBox="0 0 101 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" clip-rule="evenodd" d="M101 0H0V101H1C1 45.7715 45.7715 1 101 1V0Z" fill="currentColor"></path>
                                    </svg>
                                </span>
                                <span class="text-black corner bottom">
                                    <svg width="101" height="101" viewBox="0 0 101 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" clip-rule="evenodd" d="M101 0H0V101H1C1 45.7715 45.7715 1 101 1V0Z" fill="currentColor"></path>
                                    </svg>
                                </span>
                            </span>
                            <img alt="Mindfulness in Relationship: Cultivating Connection" loading="lazy" width="742" height="500" class="rounded-xl md:rounded-2xl h-[360px] w-full object-cover bg-white/10" src="https://eyolo-html.vercel.app/images/blog/post-08.jpg">
                        </div>
                        <div class="mt-6 text-white text-center">
                            <span class="text-sm flex gap-2 items-center mb-3 uppercase justify-center">
                                <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M12.6663 2.66677H11.333V2.0001C11.333 1.82329 11.2628 1.65372 11.1377 1.5287C11.0127 1.40367 10.8432 1.33344 10.6663 1.33344C10.4895 1.33344 10.32 1.40367 10.1949 1.5287C10.0699 1.65372 9.99967 1.82329 9.99967 2.0001V2.66677H5.99967V2.0001C5.99967 1.82329 5.92944 1.65372 5.80441 1.5287C5.67939 1.40367 5.50982 1.33344 5.33301 1.33344C5.1562 1.33344 4.98663 1.40367 4.8616 1.5287C4.73658 1.65372 4.66634 1.82329 4.66634 2.0001V2.66677H3.33301C2.80257 2.66677 2.29387 2.87748 1.91879 3.25255C1.54372 3.62763 1.33301 4.13633 1.33301 4.66677V12.6668C1.33301 13.1972 1.54372 13.7059 1.91879 14.081C2.29387 14.4561 2.80257 14.6668 3.33301 14.6668H12.6663C13.1968 14.6668 13.7055 14.4561 14.0806 14.081C14.4556 13.7059 14.6663 13.1972 14.6663 12.6668V4.66677C14.6663 4.13633 14.4556 3.62763 14.0806 3.25255C13.7055 2.87748 13.1968 2.66677 12.6663 2.66677ZM13.333 12.6668C13.333 12.8436 13.2628 13.0131 13.1377 13.1382C13.0127 13.2632 12.8432 13.3334 12.6663 13.3334H3.33301C3.1562 13.3334 2.98663 13.2632 2.8616 13.1382C2.73658 13.0131 2.66634 12.8436 2.66634 12.6668V8.0001H13.333V12.6668ZM13.333 6.66677H2.66634V4.66677C2.66634 4.48996 2.73658 4.32039 2.8616 4.19536C2.98663 4.07034 3.1562 4.0001 3.33301 4.0001H4.66634V4.66677C4.66634 4.84358 4.73658 5.01315 4.8616 5.13817C4.98663 5.2632 5.1562 5.33343 5.33301 5.33343C5.50982 5.33343 5.67939 5.2632 5.80441 5.13817C5.92944 5.01315 5.99967 4.84358 5.99967 4.66677V4.0001H9.99967V4.66677C9.99967 4.84358 10.0699 5.01315 10.1949 5.13817C10.32 5.2632 10.4895 5.33343 10.6663 5.33343C10.8432 5.33343 11.0127 5.2632 11.1377 5.13817C11.2628 5.01315 11.333 4.84358 11.333 4.66677V4.0001H12.6663C12.8432 4.0001 13.0127 4.07034 13.1377 4.19536C13.2628 4.32039 13.333 4.48996 13.333 4.66677V6.66677Z" fill="currentColor"></path>
                                </svg>
                                Oct 18, 2022
                            </span>
                            <h3 class="text-2xl text-white leading-relaxed">
                                <a class="link-stretched line-link-el" href="blog-details.html">Mindfulness in Relationship:
                                    Cultivating
                                    Connection
                                </a>
                            </h3>
                            <ul class="flex flex-wrap items-center gap-3 gap-y-1 uppercase text-sm my-6 text-white/75 justify-center">
                                <li class="flex items-center">
                                    <img alt="Author of the post - Kathryn Jackson" loading="lazy" width="24" height="24" class="h-6 w-6 border border-[#ABABAB] rounded-full mr-2 bg-white/5" src="images/author/kathryn-jackson.jpg">Kathryn Jackson
                                </li>
                                <li>•</li>
                                <li>03 MIN TO READ</li>
                            </ul>
                            <a class="inline-block text-[#90A096] group-hover:text-white group-hover:rotate-45 transition duration-300 mt-4" aria-label="Read More about Mindfulness in Relationship: Cultivating Connection" href="blog-details.html">
                                <svg width="16" height="16" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M1.99902 18.0009L18 1.99991M18 1.99991H3.59912M18 1.99991V16.4008" stroke="white" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                </svg>
                            </a>
                        </div>
                    </article>
                </div>
                <div class=" md:ml-20">
                    <article class="post-card post-category-top group relative has-line-link-white">
                        <div class="relative">
                            <span class="post-category text-white bg-black z-10">
                                <a class="transition duration-300 bg-black text-white border-white/30 hover:bg-white hover:text-dark" href="category-single.html">future-of-work</a>
                                <span class="text-black corner left">
                                    <svg width="101" height="101" viewBox="0 0 101 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" clip-rule="evenodd" d="M101 0H0V101H1C1 45.7715 45.7715 1 101 1V0Z" fill="currentColor"></path>
                                    </svg>
                                </span>
                                <span class="text-black corner bottom">
                                    <svg width="101" height="101" viewBox="0 0 101 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" clip-rule="evenodd" d="M101 0H0V101H1C1 45.7715 45.7715 1 101 1V0Z" fill="currentColor"></path>
                                    </svg>
                                </span>
                            </span>
                            <img alt="The Future of Work: Embracing Remote and Hybrid Work Models" loading="lazy" width="742" height="500" class="rounded-xl md:rounded-2xl h-[360px] w-full object-cover bg-white/10" src="https://eyolo-html.vercel.app/images/blog/post-16.jpg">
                        </div>
                        <div class="mt-6 text-white text-center">
                            <span class="text-sm flex gap-2 items-center mb-3 uppercase justify-center">
                                <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M12.6663 2.66677H11.333V2.0001C11.333 1.82329 11.2628 1.65372 11.1377 1.5287C11.0127 1.40367 10.8432 1.33344 10.6663 1.33344C10.4895 1.33344 10.32 1.40367 10.1949 1.5287C10.0699 1.65372 9.99967 1.82329 9.99967 2.0001V2.66677H5.99967V2.0001C5.99967 1.82329 5.92944 1.65372 5.80441 1.5287C5.67939 1.40367 5.50982 1.33344 5.33301 1.33344C5.1562 1.33344 4.98663 1.40367 4.8616 1.5287C4.73658 1.65372 4.66634 1.82329 4.66634 2.0001V2.66677H3.33301C2.80257 2.66677 2.29387 2.87748 1.91879 3.25255C1.54372 3.62763 1.33301 4.13633 1.33301 4.66677V12.6668C1.33301 13.1972 1.54372 13.7059 1.91879 14.081C2.29387 14.4561 2.80257 14.6668 3.33301 14.6668H12.6663C13.1968 14.6668 13.7055 14.4561 14.0806 14.081C14.4556 13.7059 14.6663 13.1972 14.6663 12.6668V4.66677C14.6663 4.13633 14.4556 3.62763 14.0806 3.25255C13.7055 2.87748 13.1968 2.66677 12.6663 2.66677ZM13.333 12.6668C13.333 12.8436 13.2628 13.0131 13.1377 13.1382C13.0127 13.2632 12.8432 13.3334 12.6663 13.3334H3.33301C3.1562 13.3334 2.98663 13.2632 2.8616 13.1382C2.73658 13.0131 2.66634 12.8436 2.66634 12.6668V8.0001H13.333V12.6668ZM13.333 6.66677H2.66634V4.66677C2.66634 4.48996 2.73658 4.32039 2.8616 4.19536C2.98663 4.07034 3.1562 4.0001 3.33301 4.0001H4.66634V4.66677C4.66634 4.84358 4.73658 5.01315 4.8616 5.13817C4.98663 5.2632 5.1562 5.33343 5.33301 5.33343C5.50982 5.33343 5.67939 5.2632 5.80441 5.13817C5.92944 5.01315 5.99967 4.84358 5.99967 4.66677V4.0001H9.99967V4.66677C9.99967 4.84358 10.0699 5.01315 10.1949 5.13817C10.32 5.2632 10.4895 5.33343 10.6663 5.33343C10.8432 5.33343 11.0127 5.2632 11.1377 5.13817C11.2628 5.01315 11.333 4.84358 11.333 4.66677V4.0001H12.6663C12.8432 4.0001 13.0127 4.07034 13.1377 4.19536C13.2628 4.32039 13.333 4.48996 13.333 4.66677V6.66677Z" fill="currentColor"></path>
                                </svg>
                                Oct 10, 2022
                            </span>
                            <h3 class="text-2xl text-white leading-relaxed">
                                <a class="link-stretched line-link-el" href="blog-details.html">The
                                    Future of Work: Embracing Remote and
                                    Hybrid Work Models
                                </a>
                            </h3>
                            <ul class="flex flex-wrap items-center gap-3 gap-y-1 uppercase text-sm my-6 text-white/75 justify-center">
                                <li class="flex items-center">
                                    <img alt="Author of the post - Kathryn Jackson" loading="lazy" width="24" height="24" class="h-6 w-6 border border-[#ABABAB] rounded-full mr-2 bg-white/5" src="images/author/kathryn-jackson.jpg">Kathryn Jackson
                                </li>
                                <li>•</li>
                                <li>03 MIN TO READ</li>
                            </ul>
                            <a class="inline-block text-[#90A096] group-hover:text-white group-hover:rotate-45 transition duration-300 mt-4" aria-label="Read More about The Future of Work: Embracing Remote and Hybrid Work Models" href="blog-details.html">
                                <svg width="16" height="16" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M1.99902 18.0009L18 1.99991M18 1.99991H3.59912M18 1.99991V16.4008" stroke="white" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                </svg>
                            </a>
                        </div>
                    </article>
                </div>
            </div>
            <div class="col-12 block md:hidden mt-16">
                <a class="button button-lg button-light group animate-top-right w-fit mx-auto" href="blogs.html">
                    <span class="relative overflow-hidden transition-none [&amp;&gt;span]:block">
                        <span class="group-hover:-translate-y-[200%] group-hover:scale-y-[2] group-hover:rotate-12">All
                            Posts
                        </span>
                        <span class="absolute left-0 top-0 scale-y-[2] rotate-12 translate-y-[200%] group-hover:translate-y-0 group-hover:scale-y-100 group-hover:rotate-0">All
                            Posts
                        </span>
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
</section>

<section class="pt-16 sm:pt-24 pb-6 sm:pb-12 bg-light">
    <div class="container">
        <div class="row justify-center">
            <div class="lg:col-10">
                <div class="row">
                    <div class="lg:col-6">
                        <div class="mb-14 lg:mb-20 text-center lg:text-start">
                            <p class="text-base uppercase font-secondary pl-4 relative after:absolute after:rounded-full -mt-1 after:content-[''] after:h-2 after:w-2 after:bg-primary after:left-0 after:top-2 w-fit mb-8 mx-auto lg:mx-0">
                                Trending Articles</p>
                            <h2 class="text-3xl md:text-4xl !leading-normal mb-4 text-balance">Where Knowledge Meets Passion</h2>
                            <p class="text-[#4E4C3D] lg:mb-8 leading-relaxed font-light uppercase text-balance text-sm sm:text-base">
                                Trending Articles of consectetur morbi. Amet venenatis urna cursus eget nunc scelerisque viverra.
                            </p>
                            <div class="hidden lg:inline-block">
                                <a class="button button-lg group animate-top-right" href="blogs.html">
                                    <span class="relative overflow-hidden transition-none [&amp;&gt;span]:block">
                                        <span class="group-hover:-translate-y-[200%] group-hover:scale-y-[2] group-hover:rotate-12">
                                            All Posts
                                        </span>
                                        <span class="absolute left-0 top-0 scale-y-[2] rotate-12 translate-y-[200%] group-hover:translate-y-0 group-hover:scale-y-100 group-hover:rotate-0">
                                            All Posts
                                        </span>
                                    </span>
                                    <span class="overflow-hidden leading-none -translate-y-[2px]">
                                        <svg class="inline-block animate-icon" width="10" height="10" viewBox="0 0 10 10" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M1 9.00005L9 1.00005M9 1.00005H1.8M9 1.00005V8.20005" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                        </svg>
                                    </span>
                                </a>
                            </div>
                        </div>
                        <div class="row">
                            <div class="lg:col-8 sm:col-6 mx-auto mb-12">
                                <article class="post-card post-category-top group relative has-line-link">
                                    <div class="relative">
                                        <span class="post-category bg-light text-dark z-10">
                                            <a class="border-border transition duration-300 hover:bg-dark hover:text-white hover:border-dark" href="category-single.html">
                                                digital-marketing
                                            </a>
                                            <span class="text-light corner left">
                                                <svg width="101" height="101" viewBox="0 0 101 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M101 0H0V101H1C1 45.7715 45.7715 1 101 1V0Z" fill="currentColor"></path>
                                                </svg>
                                            </span>
                                            <span class="text-light corner bottom">
                                                <svg width="101" height="101" viewBox="0 0 101 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M101 0H0V101H1C1 45.7715 45.7715 1 101 1V0Z" fill="currentColor"></path>
                                                </svg>
                                            </span>
                                        </span>
                                        <img alt="How To Write SEO Blog Posts That Rank Easily" loading="lazy" width="520" height="660" class="rounded-xl md:rounded-2xl w-full object-cover bg-white/40 aspect-[9/10] lg:aspect-[9/12]" src="https://eyolo-html.vercel.app/images/blog/post-06.jpg">
                                    </div>
                                    <div class="mt-6 text-center">
                                        <span class="text-sm flex justify-center gap-2 items-center mb-3 uppercase">
                                            <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M12.6663 2.66677H11.333V2.0001C11.333 1.82329 11.2628 1.65372 11.1377 1.5287C11.0127 1.40367 10.8432 1.33344 10.6663 1.33344C10.4895 1.33344 10.32 1.40367 10.1949 1.5287C10.0699 1.65372 9.99967 1.82329 9.99967 2.0001V2.66677H5.99967V2.0001C5.99967 1.82329 5.92944 1.65372 5.80441 1.5287C5.67939 1.40367 5.50982 1.33344 5.33301 1.33344C5.1562 1.33344 4.98663 1.40367 4.8616 1.5287C4.73658 1.65372 4.66634 1.82329 4.66634 2.0001V2.66677H3.33301C2.80257 2.66677 2.29387 2.87748 1.91879 3.25255C1.54372 3.62763 1.33301 4.13633 1.33301 4.66677V12.6668C1.33301 13.1972 1.54372 13.7059 1.91879 14.081C2.29387 14.4561 2.80257 14.6668 3.33301 14.6668H12.6663C13.1968 14.6668 13.7055 14.4561 14.0806 14.081C14.4556 13.7059 14.6663 13.1972 14.6663 12.6668V4.66677C14.6663 4.13633 14.4556 3.62763 14.0806 3.25255C13.7055 2.87748 13.1968 2.66677 12.6663 2.66677ZM13.333 12.6668C13.333 12.8436 13.2628 13.0131 13.1377 13.1382C13.0127 13.2632 12.8432 13.3334 12.6663 13.3334H3.33301C3.1562 13.3334 2.98663 13.2632 2.8616 13.1382C2.73658 13.0131 2.66634 12.8436 2.66634 12.6668V8.0001H13.333V12.6668ZM13.333 6.66677H2.66634V4.66677C2.66634 4.48996 2.73658 4.32039 2.8616 4.19536C2.98663 4.07034 3.1562 4.0001 3.33301 4.0001H4.66634V4.66677C4.66634 4.84358 4.73658 5.01315 4.8616 5.13817C4.98663 5.2632 5.1562 5.33343 5.33301 5.33343C5.50982 5.33343 5.67939 5.2632 5.80441 5.13817C5.92944 5.01315 5.99967 4.84358 5.99967 4.66677V4.0001H9.99967V4.66677C9.99967 4.84358 10.0699 5.01315 10.1949 5.13817C10.32 5.2632 10.4895 5.33343 10.6663 5.33343C10.8432 5.33343 11.0127 5.2632 11.1377 5.13817C11.2628 5.01315 11.333 4.84358 11.333 4.66677V4.0001H12.6663C12.8432 4.0001 13.0127 4.07034 13.1377 4.19536C13.2628 4.32039 13.333 4.48996 13.333 4.66677V6.66677Z" fill="currentColor"></path>
                                            </svg>
                                            Mar 22, 2024</span>
                                        <h3 class="text-2xl text-dark leading-relaxed mb-4 line-link">
                                            <a class="link-stretched line-link-el" aria-label="How To Write SEO Blog Posts That Rank Easily" href="blog-details.html">
                                                How To Write SEO Blog Posts That Rank Easily
                                            </a>
                                        </h3>
                                        <ul class="flex flex-wrap items-center justify-center gap-3 gap-y-1 mb-6 uppercase text-sm text-[#464536]">
                                            <li class="flex items-center">
                                                <img alt="Author of the post - Kathryn Jackson" loading="lazy" width="24" height="24" class="h-6 w-6 border border-[#ABABAB] rounded-full mr-2 bg-white/40" src="images/author/kathryn-jackson.jpg">Kathryn
                                            </li>
                                            <li>•</li>
                                            <li>03 MIN TO READ</li>
                                        </ul>
                                        <span class="inline-block text-black group-hover:text-black group-hover:rotate-45 transition duration-300">
                                            <svg width="16" height="16" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M1.99902 18.0009L18 1.99991M18 1.99991H3.59912M18 1.99991V16.4008" stroke="black" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                            </svg>
                                        </span>
                                    </div>
                                </article>
                            </div>
                            <div class="lg:col-10 sm:col-6 ml-auto mb-12">
                                <article class="post-card post-category-top group relative has-line-link">
                                    <div class="relative">
                                        <span class="post-category bg-light text-dark z-10">
                                            <a class="border-border transition duration-300 hover:bg-dark hover:text-white hover:border-dark" href="category-single.html">security</a>
                                            <span class="text-light corner left">
                                                <svg width="101" height="101" viewBox="0 0 101 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M101 0H0V101H1C1 45.7715 45.7715 1 101 1V0Z" fill="currentColor"></path>
                                                </svg>
                                            </span>
                                            <span class="text-light corner bottom">
                                                <svg width="101" height="101" viewBox="0 0 101 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M101 0H0V101H1C1 45.7715 45.7715 1 101 1V0Z" fill="currentColor"></path>
                                                </svg>
                                            </span>
                                        </span>
                                        <img alt="23andMe Tells Victims It’s Their Fault That Their Data Was Breached" loading="lazy" width="520" height="660" class="rounded-xl md:rounded-2xl w-full object-cover bg-white/40 aspect-[9/10] lg:aspect-[9/12]" src="https://eyolo-html.vercel.app/images/blog/post-15.jpg">
                                    </div>
                                    <div class="mt-6 text-center">
                                        <span class="text-sm flex justify-center gap-2 items-center mb-3 uppercase">
                                            <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M12.6663 2.66677H11.333V2.0001C11.333 1.82329 11.2628 1.65372 11.1377 1.5287C11.0127 1.40367 10.8432 1.33344 10.6663 1.33344C10.4895 1.33344 10.32 1.40367 10.1949 1.5287C10.0699 1.65372 9.99967 1.82329 9.99967 2.0001V2.66677H5.99967V2.0001C5.99967 1.82329 5.92944 1.65372 5.80441 1.5287C5.67939 1.40367 5.50982 1.33344 5.33301 1.33344C5.1562 1.33344 4.98663 1.40367 4.8616 1.5287C4.73658 1.65372 4.66634 1.82329 4.66634 2.0001V2.66677H3.33301C2.80257 2.66677 2.29387 2.87748 1.91879 3.25255C1.54372 3.62763 1.33301 4.13633 1.33301 4.66677V12.6668C1.33301 13.1972 1.54372 13.7059 1.91879 14.081C2.29387 14.4561 2.80257 14.6668 3.33301 14.6668H12.6663C13.1968 14.6668 13.7055 14.4561 14.0806 14.081C14.4556 13.7059 14.6663 13.1972 14.6663 12.6668V4.66677C14.6663 4.13633 14.4556 3.62763 14.0806 3.25255C13.7055 2.87748 13.1968 2.66677 12.6663 2.66677ZM13.333 12.6668C13.333 12.8436 13.2628 13.0131 13.1377 13.1382C13.0127 13.2632 12.8432 13.3334 12.6663 13.3334H3.33301C3.1562 13.3334 2.98663 13.2632 2.8616 13.1382C2.73658 13.0131 2.66634 12.8436 2.66634 12.6668V8.0001H13.333V12.6668ZM13.333 6.66677H2.66634V4.66677C2.66634 4.48996 2.73658 4.32039 2.8616 4.19536C2.98663 4.07034 3.1562 4.0001 3.33301 4.0001H4.66634V4.66677C4.66634 4.84358 4.73658 5.01315 4.8616 5.13817C4.98663 5.2632 5.1562 5.33343 5.33301 5.33343C5.50982 5.33343 5.67939 5.2632 5.80441 5.13817C5.92944 5.01315 5.99967 4.84358 5.99967 4.66677V4.0001H9.99967V4.66677C9.99967 4.84358 10.0699 5.01315 10.1949 5.13817C10.32 5.2632 10.4895 5.33343 10.6663 5.33343C10.8432 5.33343 11.0127 5.2632 11.1377 5.13817C11.2628 5.01315 11.333 4.84358 11.333 4.66677V4.0001H12.6663C12.8432 4.0001 13.0127 4.07034 13.1377 4.19536C13.2628 4.32039 13.333 4.48996 13.333 4.66677V6.66677Z" fill="currentColor"></path>
                                            </svg>
                                            Jan 27, 2024</span>
                                        <h3 class="text-2xl text-dark leading-relaxed mb-4 line-link">
                                            <a class="link-stretched line-link-el" aria-label="23andMe Tells Victims It’s Their Fault That Their Data Was Breached" href="blog-details.html">
                                                23andMe Tells Victims It’s Their Fault That Their Data Was Breached
                                            </a>
                                        </h3>
                                        <ul class="flex flex-wrap items-center justify-center gap-3 gap-y-1 mb-6 uppercase text-sm text-[#464536]">
                                            <li class="flex items-center">
                                                <img alt="Author of the post - Alex Walton" loading="lazy" width="24" height="24" class="h-6 w-6 border border-[#ABABAB] rounded-full mr-2 bg-white/40" src="images/author/alex-walton.jpg">Alex
                                            </li>
                                            <li>•</li>
                                            <li>02 MIN TO READ</li>
                                        </ul>
                                        <span class="inline-block text-black group-hover:text-black group-hover:rotate-45 transition duration-300">
                                            <svg width="16" height="16" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M1.99902 18.0009L18 1.99991M18 1.99991H3.59912M18 1.99991V16.4008" stroke="black" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                            </svg>
                                        </span>
                                    </div>
                                </article>
                            </div>
                        </div>
                    </div>
                    <div class="lg:col-6">
                        <div class="row">
                            <div class="lg:col-10 sm:col-6 ml-auto mb-12">
                                <article class="post-card post-category-top group relative has-line-link">
                                    <div class="relative">
                                        <span class="post-category bg-light text-dark z-10">
                                            <a class="border-border transition duration-300 hover:bg-dark hover:text-white hover:border-dark" href="category-single.html">web</a>
                                            <span class="text-light corner left">
                                                <svg width="101" height="101" viewBox="0 0 101 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M101 0H0V101H1C1 45.7715 45.7715 1 101 1V0Z" fill="currentColor"></path>
                                                </svg>
                                            </span>
                                            <span class="text-light corner bottom">
                                                <svg width="101" height="101" viewBox="0 0 101 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M101 0H0V101H1C1 45.7715 45.7715 1 101 1V0Z" fill="currentColor"></path>
                                                </svg>
                                            </span>
                                        </span>
                                        <img alt="Building a Feature-Rich Blog with Next.js, Tailwind CSS, and Vercel" loading="lazy" width="520" height="660" class="rounded-xl md:rounded-2xl w-full object-cover bg-white/40 aspect-[9/10] lg:aspect-[9/12]" src="https://eyolo-html.vercel.app/images/blog/post-07.jpg">
                                    </div>
                                    <div class="mt-6 text-center">
                                        <span class="text-sm flex justify-center gap-2 items-center mb-3 uppercase">
                                            <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M12.6663 2.66677H11.333V2.0001C11.333 1.82329 11.2628 1.65372 11.1377 1.5287C11.0127 1.40367 10.8432 1.33344 10.6663 1.33344C10.4895 1.33344 10.32 1.40367 10.1949 1.5287C10.0699 1.65372 9.99967 1.82329 9.99967 2.0001V2.66677H5.99967V2.0001C5.99967 1.82329 5.92944 1.65372 5.80441 1.5287C5.67939 1.40367 5.50982 1.33344 5.33301 1.33344C5.1562 1.33344 4.98663 1.40367 4.8616 1.5287C4.73658 1.65372 4.66634 1.82329 4.66634 2.0001V2.66677H3.33301C2.80257 2.66677 2.29387 2.87748 1.91879 3.25255C1.54372 3.62763 1.33301 4.13633 1.33301 4.66677V12.6668C1.33301 13.1972 1.54372 13.7059 1.91879 14.081C2.29387 14.4561 2.80257 14.6668 3.33301 14.6668H12.6663C13.1968 14.6668 13.7055 14.4561 14.0806 14.081C14.4556 13.7059 14.6663 13.1972 14.6663 12.6668V4.66677C14.6663 4.13633 14.4556 3.62763 14.0806 3.25255C13.7055 2.87748 13.1968 2.66677 12.6663 2.66677ZM13.333 12.6668C13.333 12.8436 13.2628 13.0131 13.1377 13.1382C13.0127 13.2632 12.8432 13.3334 12.6663 13.3334H3.33301C3.1562 13.3334 2.98663 13.2632 2.8616 13.1382C2.73658 13.0131 2.66634 12.8436 2.66634 12.6668V8.0001H13.333V12.6668ZM13.333 6.66677H2.66634V4.66677C2.66634 4.48996 2.73658 4.32039 2.8616 4.19536C2.98663 4.07034 3.1562 4.0001 3.33301 4.0001H4.66634V4.66677C4.66634 4.84358 4.73658 5.01315 4.8616 5.13817C4.98663 5.2632 5.1562 5.33343 5.33301 5.33343C5.50982 5.33343 5.67939 5.2632 5.80441 5.13817C5.92944 5.01315 5.99967 4.84358 5.99967 4.66677V4.0001H9.99967V4.66677C9.99967 4.84358 10.0699 5.01315 10.1949 5.13817C10.32 5.2632 10.4895 5.33343 10.6663 5.33343C10.8432 5.33343 11.0127 5.2632 11.1377 5.13817C11.2628 5.01315 11.333 4.84358 11.333 4.66677V4.0001H12.6663C12.8432 4.0001 13.0127 4.07034 13.1377 4.19536C13.2628 4.32039 13.333 4.48996 13.333 4.66677V6.66677Z" fill="currentColor"></path>
                                            </svg>
                                            Mar 25, 2024</span>
                                        <h3 class="text-2xl text-dark leading-relaxed mb-4 line-link">
                                            <a class="link-stretched line-link-el" aria-label="Building a Feature-Rich Blog with Next.js, Tailwind CSS, and Vercel" href="blog-details.html">
                                                Building a Feature-Rich Blog with Next.js, Tailwind CSS, and Vercel
                                            </a>
                                        </h3>
                                        <ul class="flex flex-wrap items-center justify-center gap-3 gap-y-1 mb-6 uppercase text-sm text-[#464536]">
                                            <li class="flex items-center">
                                                <img alt="Author of the post - Alex Walton" loading="lazy" width="24" height="24" class="h-6 w-6 border border-[#ABABAB] rounded-full mr-2 bg-white/40" src="images/author/alex-walton.jpg">Alex
                                            </li>
                                            <li>•</li>
                                            <li>03 MIN TO READ</li>
                                        </ul>
                                        <span class="inline-block text-black group-hover:text-black group-hover:rotate-45 transition duration-300">
                                            <svg width="16" height="16" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M1.99902 18.0009L18 1.99991M18 1.99991H3.59912M18 1.99991V16.4008" stroke="black" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                            </svg>
                                        </span>
                                    </div>
                                </article>
                            </div>
                            <div class="lg:col-8 sm:col-6 ml-auto mb-12">
                                <article class="post-card post-category-top group relative has-line-link">
                                    <div class="relative">
                                        <span class="post-category bg-light text-dark z-10">
                                            <a class="border-border transition duration-300 hover:bg-dark hover:text-white hover:border-dark" href="category-single.html">productivity</a>
                                            <span class="text-light corner left">
                                                <svg width="101" height="101" viewBox="0 0 101 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M101 0H0V101H1C1 45.7715 45.7715 1 101 1V0Z" fill="currentColor"></path>
                                                </svg>
                                            </span>
                                            <span class="text-light corner bottom">
                                                <svg width="101" height="101" viewBox="0 0 101 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M101 0H0V101H1C1 45.7715 45.7715 1 101 1V0Z" fill="currentColor"></path>
                                                </svg>
                                            </span>
                                        </span>
                                        <img alt="The Art of Productivity: Mastering Time Management and Goal Setting" loading="lazy" width="520" height="660" class="rounded-xl md:rounded-2xl w-full object-cover bg-white/40 aspect-[9/10] lg:aspect-[9/12]" src="https://eyolo-html.vercel.app/images/blog/post-13.jpg">
                                    </div>
                                    <div class="mt-6 text-center">
                                        <span class="text-sm flex justify-center gap-2 items-center mb-3 uppercase">
                                            <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M12.6663 2.66677H11.333V2.0001C11.333 1.82329 11.2628 1.65372 11.1377 1.5287C11.0127 1.40367 10.8432 1.33344 10.6663 1.33344C10.4895 1.33344 10.32 1.40367 10.1949 1.5287C10.0699 1.65372 9.99967 1.82329 9.99967 2.0001V2.66677H5.99967V2.0001C5.99967 1.82329 5.92944 1.65372 5.80441 1.5287C5.67939 1.40367 5.50982 1.33344 5.33301 1.33344C5.1562 1.33344 4.98663 1.40367 4.8616 1.5287C4.73658 1.65372 4.66634 1.82329 4.66634 2.0001V2.66677H3.33301C2.80257 2.66677 2.29387 2.87748 1.91879 3.25255C1.54372 3.62763 1.33301 4.13633 1.33301 4.66677V12.6668C1.33301 13.1972 1.54372 13.7059 1.91879 14.081C2.29387 14.4561 2.80257 14.6668 3.33301 14.6668H12.6663C13.1968 14.6668 13.7055 14.4561 14.0806 14.081C14.4556 13.7059 14.6663 13.1972 14.6663 12.6668V4.66677C14.6663 4.13633 14.4556 3.62763 14.0806 3.25255C13.7055 2.87748 13.1968 2.66677 12.6663 2.66677ZM13.333 12.6668C13.333 12.8436 13.2628 13.0131 13.1377 13.1382C13.0127 13.2632 12.8432 13.3334 12.6663 13.3334H3.33301C3.1562 13.3334 2.98663 13.2632 2.8616 13.1382C2.73658 13.0131 2.66634 12.8436 2.66634 12.6668V8.0001H13.333V12.6668ZM13.333 6.66677H2.66634V4.66677C2.66634 4.48996 2.73658 4.32039 2.8616 4.19536C2.98663 4.07034 3.1562 4.0001 3.33301 4.0001H4.66634V4.66677C4.66634 4.84358 4.73658 5.01315 4.8616 5.13817C4.98663 5.2632 5.1562 5.33343 5.33301 5.33343C5.50982 5.33343 5.67939 5.2632 5.80441 5.13817C5.92944 5.01315 5.99967 4.84358 5.99967 4.66677V4.0001H9.99967V4.66677C9.99967 4.84358 10.0699 5.01315 10.1949 5.13817C10.32 5.2632 10.4895 5.33343 10.6663 5.33343C10.8432 5.33343 11.0127 5.2632 11.1377 5.13817C11.2628 5.01315 11.333 4.84358 11.333 4.66677V4.0001H12.6663C12.8432 4.0001 13.0127 4.07034 13.1377 4.19536C13.2628 4.32039 13.333 4.48996 13.333 4.66677V6.66677Z" fill="currentColor"></path>
                                            </svg>
                                            Mar 18, 2024
                                        </span>
                                        <h3 class="text-2xl text-dark leading-relaxed mb-4 line-link">
                                            <a class="link-stretched line-link-el" aria-label="The Art of Productivity: Mastering Time Management and Goal Setting" href="blog-details.html">
                                                The Art of Productivity: Mastering Time Management and Goal Setting
                                            </a>
                                        </h3>
                                        <ul class="flex flex-wrap items-center justify-center gap-3 gap-y-1 mb-6 uppercase text-sm text-[#464536]">
                                            <li class="flex items-center">
                                                <img alt="Author of the post - Alex Walton" loading="lazy" width="24" height="24" class="h-6 w-6 border border-[#ABABAB] rounded-full mr-2 bg-white/40" src="images/author/alex-walton.jpg">Alex
                                            </li>
                                            <li>•</li>
                                            <li>03 MIN TO READ</li>
                                        </ul>
                                        <span class="inline-block text-black group-hover:text-black group-hover:rotate-45 transition duration-300">
                                            <svg width="16" height="16" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M1.99902 18.0009L18 1.99991M18 1.99991H3.59912M18 1.99991V16.4008" stroke="black" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                            </svg>
                                        </span>
                                    </div>
                                </article>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 block lg:hidden mb-10">
                        <a class="button button-lg group animate-top-right w-fit mx-auto" href="blogs.html">
                            <span class="relative overflow-hidden transition-none [&amp;&gt;span]:block">
                                <span class="group-hover:-translate-y-[200%] group-hover:scale-y-[2] group-hover:rotate-12">
                                    All
                                    Posts
                                </span>
                                <span class="absolute left-0 top-0 scale-y-[2] rotate-12 translate-y-[200%] group-hover:translate-y-0 group-hover:scale-y-100 group-hover:rotate-0">
                                    All
                                    Posts
                                </span>
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
        </div>
    </div>
</section>


<section class="py-16 sm:py-24 overflow-clip waveBg">
    <div class="container">
        <div class="border-t pt-8 border-white">
            <div class="sm:flex justify-between">
                <h2 class="text-base uppercase font-secondary pl-4 relative after:absolute after:rounded-full -mt-1 after:content-[''] after:h-2 after:w-2 after:bg-primary after:left-0 after:top-2 text-white w-fit mx-auto sm:mx-0 mb-10 sm:mb-0">
                    Post of the Week
                </h2>
                <a class="button group animate-top-right button-light w-fit hidden sm:flex" href="blogs.html">
                    <span class="relative overflow-hidden transition-none [&amp;&gt;span]:block">
                        <span class="group-hover:-translate-y-[200%] group-hover:scale-y-[2] group-hover:rotate-12">
                            All Weekly Posts
                        </span>
                        <span class="absolute left-0 top-0 scale-y-[2] rotate-12 translate-y-[200%] group-hover:translate-y-0 group-hover:scale-y-100 group-hover:rotate-0">
                            All Weekly Posts
                        </span>
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
    <div class="container mt-8">
        <article class="row g-4 lg:g-6 items-center">
            <div class="md:col-6">
                <div class="post-card post-category-top group relative has-line-link-white">
                    <div class="relative"><span class="post-category text-white bg-brand-muted z-10"><a class="transition duration-300 bg-white text-brand-primary border-white/30 hover:bg-brand-primary hover:text-white" href="category-single.html">happiness</a>
                            <span class="text-secondary corner left">
                                <svg width="101" height="101" viewBox="0 0 101 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M101 0H0V101H1C1 45.7715 45.7715 1 101 1V0Z" fill="#b9561b"></path>
                                </svg>
                            </span>
                            <span class="text-secondary corner bottom">
                                <svg width="101" height="101" viewBox="0 0 101 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M101 0H0V101H1C1 45.7715 45.7715 1 101 1V0Z" fill="#b9561b"></path>
                                </svg>
                            </span>
                        </span>
                        <img alt="The Science of Happiness: Cultivating Joy and Fulfillment in Everyday Life" loading="lazy" width="720" height="600" class="rounded-xl md:rounded-2xl h-[360px] w-full object-cover bg-white/10" src="https://eyolo-html.vercel.app/images/blog/post-02.jpg">
                    </div>
                </div>
            </div>
            <div class="md:col-6 text-center md:text-start">
                <div class="post-card post-category-top group relative has-line-link-white text-white"><span class="text-sm flex justify-center md:justify-start gap-2 items-center mb-3 uppercase">
                        <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M12.6663 2.66677H11.333V2.0001C11.333 1.82329 11.2628 1.65372 11.1377 1.5287C11.0127 1.40367 10.8432 1.33344 10.6663 1.33344C10.4895 1.33344 10.32 1.40367 10.1949 1.5287C10.0699 1.65372 9.99967 1.82329 9.99967 2.0001V2.66677H5.99967V2.0001C5.99967 1.82329 5.92944 1.65372 5.80441 1.5287C5.67939 1.40367 5.50982 1.33344 5.33301 1.33344C5.1562 1.33344 4.98663 1.40367 4.8616 1.5287C4.73658 1.65372 4.66634 1.82329 4.66634 2.0001V2.66677H3.33301C2.80257 2.66677 2.29387 2.87748 1.91879 3.25255C1.54372 3.62763 1.33301 4.13633 1.33301 4.66677V12.6668C1.33301 13.1972 1.54372 13.7059 1.91879 14.081C2.29387 14.4561 2.80257 14.6668 3.33301 14.6668H12.6663C13.1968 14.6668 13.7055 14.4561 14.0806 14.081C14.4556 13.7059 14.6663 13.1972 14.6663 12.6668V4.66677C14.6663 4.13633 14.4556 3.62763 14.0806 3.25255C13.7055 2.87748 13.1968 2.66677 12.6663 2.66677ZM13.333 12.6668C13.333 12.8436 13.2628 13.0131 13.1377 13.1382C13.0127 13.2632 12.8432 13.3334 12.6663 13.3334H3.33301C3.1562 13.3334 2.98663 13.2632 2.8616 13.1382C2.73658 13.0131 2.66634 12.8436 2.66634 12.6668V8.0001H13.333V12.6668ZM13.333 6.66677H2.66634V4.66677C2.66634 4.48996 2.73658 4.32039 2.8616 4.19536C2.98663 4.07034 3.1562 4.0001 3.33301 4.0001H4.66634V4.66677C4.66634 4.84358 4.73658 5.01315 4.8616 5.13817C4.98663 5.2632 5.1562 5.33343 5.33301 5.33343C5.50982 5.33343 5.67939 5.2632 5.80441 5.13817C5.92944 5.01315 5.99967 4.84358 5.99967 4.66677V4.0001H9.99967V4.66677C9.99967 4.84358 10.0699 5.01315 10.1949 5.13817C10.32 5.2632 10.4895 5.33343 10.6663 5.33343C10.8432 5.33343 11.0127 5.2632 11.1377 5.13817C11.2628 5.01315 11.333 4.84358 11.333 4.66677V4.0001H12.6663C12.8432 4.0001 13.0127 4.07034 13.1377 4.19536C13.2628 4.32039 13.333 4.48996 13.333 4.66677V6.66677Z" fill="currentColor"></path>
                        </svg>
                        May 28, 2024</span>
                    <h3 class="text-2xl text-white leading-relaxed">
                        <a class="link-stretched line-link-el text-white" href="blog-details.html">
                            The Science of Happiness: Cultivating Joy and Fulfillment in Everyday Life
                        </a>
                    </h3>
                    <ul class="flex justify-center md:justify-start flex-wrap items-center gap-3 gap-y-1 uppercase text-sm my-6 text-[#BBC5BE]">
                        <li class="flex items-center"><img alt="Author of the post - Alex Walton" loading="lazy" width="24" height="24" class="h-6 w-6 border border-[#ABABAB] rounded-full mr-2 bg-white/10" src="images/author/alex-walton.jpg">Alex Walton</li>
                        <li>•</li>
                        <li>03 MIN TO READ</li>
                    </ul>
                    <a class="inline-block text-[#90A096] group-hover:text-white group-hover:rotate-45 transition duration-300" aria-label="Read More about The Science of Happiness: Cultivating Joy and Fulfillment in Everyday Life" href="blog-details.html">
                        <span class="h-12 w-12 flex items-center justify-center text-white bg-white/20 rounded-full has-transition">
                            <svg width="14" height="14" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M1.99902 18.0009L18 1.99991M18 1.99991H3.59912M18 1.99991V16.4008" stroke="white" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"></path>
                            </svg>
                        </span>
                    </a>
                </div>
            </div>
        </article>
        <div class="block sm:hidden mt-12">
            <a class="button button-lg group animate-top-right button-light w-fit mx-auto" href="blogs.html">
                <span class="relative overflow-hidden transition-none [&amp;&gt;span]:block">
                    <span class="group-hover:-translate-y-[200%] group-hover:scale-y-[2] group-hover:rotate-12">All Weekly
                        Posts
                    </span>
                    <span class="absolute left-0 top-0 scale-y-[2] rotate-12 translate-y-[200%] group-hover:translate-y-0 group-hover:scale-y-100 group-hover:rotate-0">All
                        Weekly Posts
                    </span>
                </span>
                <span class="overflow-hidden leading-none -translate-y-[2px]">
                    <svg class="inline-block animate-icon" width="10" height="10" viewBox="0 0 10 10" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M1 9.00005L9 1.00005M9 1.00005H1.8M9 1.00005V8.20005" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                    </svg>
                </span>
            </a>
        </div>
    </div>
</section>
<?php get_footer(); ?>