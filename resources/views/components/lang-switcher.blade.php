<!-- Language switcher -->
<div class="relative items-center text-right">
    @php $locale = session()->get('locale'); @endphp
    <button id="dropdownSmallButton" data-dropdown-toggle="dropdownSmall" class="inline-flex items-center text-sm font-medium text-center d-font transition duration-150 ease-in-out
                                                        focus:outline-none py-2 mr-2 rounded-lg
                                                         text-center text-gray-600
                                                        font-medium focus:ring-1 focus:ring-offset-1
                                                        focus:ring-pink-700 w-auto" type="button">
        <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>                @switch($locale)
            @case('en')
            EN
            @break
            @case('ru')
            RU
            @break
            @case('ee')
            EE
            @break
            @case('lv')
            LV
            @break
            @case('lt')
            LT
            @break
            @default
            EN
        @endswitch
        <svg class="w-3 h-3 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg></button>

    <div id="dropdownSmall" class="text-left z-10 hidden bg-white divide-y divide-gray-100 rounded shadow dark:bg-gray-700 dark:divide-gray-600">
        <ul class="py-1 text-sm text-gray-700 dark:text-gray-200" aria-labelledby="dropdownSmallButton">
            <li>
                <a href="lang/en" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">English</a>
            </li>
            @if(env('COUNTRY') == 'ee')
                <li>
                    <a href="lang/ee" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Eesti</a>
                </li>
            @endif
{{--            @if(env('COUNTRY') == 'lv')--}}
{{--                <li>--}}
{{--                    <a href="lang/lv" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Latviešu</a>--}}
{{--                </li>--}}
{{--            @endif--}}
{{--            @if(env('COUNTRY') == 'lt')--}}
{{--                <li>--}}
{{--                    <a href="lang/lt" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Lietuvių</a>--}}
{{--                </li>--}}
{{--            @endif--}}
            <li>
                <a href="lang/ru" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Русский</a>
            </li>
        </ul>
    </div>
</div>
