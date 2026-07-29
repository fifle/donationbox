<!-- Language switcher -->
<div class="relative inline-flex items-center">
    @php 
        // Use app locale so switcher matches actual content (middleware sets app locale from param, session, or country default)
        $locale = app()->getLocale();
        // Link to the current page with a locale param instead of a redirect endpoint, so the
        // target never depends on the Referer header and stays on this site.
        $localeNames = ['en' => 'English'];
        $countryLocales = ['ee' => 'Eesti', 'lv' => 'Latviešu', 'lt' => 'Lietuvių'];
        if (isset($countryLocales[env('COUNTRY')])) {
            $localeNames[env('COUNTRY')] = $countryLocales[env('COUNTRY')];
        }
        $localeNames['ru'] = 'Русский';

        $localeUrl = fn ($code) => \App\Helpers\CurrentUrl::with(['locale' => $code]);
    @endphp
    <button id="dropdownSmallButton" data-dropdown-toggle="dropdownSmall" class="inline-flex items-center text-sm font-medium text-center d-font transition duration-150 ease-in-out
                                                        focus:outline-none py-2 mr-2 rounded-lg
                                                         text-center text-gray-600
                                                        font-medium focus:ring-1 focus:ring-offset-1
                                                        focus:ring-pink-700 w-auto" type="button"
            aria-label="@lang('Select language')"
            aria-haspopup="true"
            aria-expanded="false">
        <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>                @switch($locale)
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
        <svg class="w-3 h-3 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg></button>

    <div id="dropdownSmall" class="absolute right-0 top-full mt-1 min-w-[8rem] text-left z-50 hidden bg-white divide-y divide-gray-100 rounded-lg shadow-lg border border-gray-200 dark:bg-gray-700 dark:divide-gray-600 dark:border-gray-600">
        <ul class="py-1 text-sm text-gray-700 dark:text-gray-200" aria-labelledby="dropdownSmallButton">
            @foreach($localeNames as $code => $name)
                <li>
                    <a href="{{ $localeUrl($code) }}"
                       @if($code === $locale) aria-current="true" @endif
                       class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">{{ $name }}</a>
                </li>
            @endforeach
        </ul>
    </div>
</div>
