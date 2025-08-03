<form role="search" method="get" class="search-form" action="<?php echo esc_url(home_url('/')); ?>">
    <input type="search" placeholder="جستجو کنید ..." value="<?php echo get_search_query(); ?>" name="s" class="pl-10 pr-4 py-2 border border-brand-primary rounded-xl w-full focus:outline-none focus:ring-2 focus:ring-blue-500" />
    <button type="submit" aria-label="جستجو کنید ..." class="absolute left-3 top-[50%] transform -translate-y-1/2 text-gray-500 hover:text-blue-500 focus:outline-none">
        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none">
            <path d="M9.58341 17.4993C13.9557 17.4993 17.5001 13.9549 17.5001 9.58268C17.5001 5.21043 13.9557 1.66602 9.58341 1.66602C5.21116 1.66602 1.66675 5.21043 1.66675 9.58268C1.66675 13.9549 5.21116 17.4993 9.58341 17.4993Z" stroke="#264480" stroke-width="1.3" stroke-linecap="round" stroke-linejoin="round" />
            <path d="M18.3334 18.3327L16.6667 16.666" stroke="#264480" stroke-width="1.3" stroke-linecap="round" stroke-linejoin="round" />
        </svg>
    </button>
</form>
