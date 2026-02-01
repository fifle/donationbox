<!-- Language switcher -->
<div class="relative items-center">
    @php 
        $locale = session()->get('locale'); 
        // Get current URL to preserve all parameters
        $currentUrl = url()->current();
        $queryParams = request()->query();
    @endphp
    <button id="dropdownSmallButton" data-dropdown-toggle="dropdownSmall" 
            class="inline-flex items-center gap-1.5 text-sm font-medium d-font py-1.5 px-3 rounded-lg text-gray-600 hover:text-gray-800 transition-colors" 
            type="button"
            aria-label="@lang('Select language')"
            aria-haspopup="true"
            aria-expanded="false">
        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
        @switch($locale)
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
        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
    </button>

    <div id="dropdownSmall" class="text-left z-10 hidden bg-white/90 backdrop-blur-lg divide-y divide-gray-100 rounded-xl shadow-lg border border-white/50">
        <ul class="py-1 text-sm text-gray-700" aria-labelledby="dropdownSmallButton">
            <li>
                <a href="{{ route('lang', ['locale' => 'en']) }}" class="block px-4 py-2 hover:bg-gray-100/80 transition-colors">English</a>
            </li>
            @if(env('COUNTRY') == 'ee')
                <li>
                    <a href="{{ route('lang', ['locale' => 'ee']) }}" class="block px-4 py-2 hover:bg-gray-100/80 transition-colors">Eesti</a>
                </li>
            @endif
            @if(env('COUNTRY') == 'lv')
                <li>
                    <a href="{{ route('lang', ['locale' => 'lv']) }}" class="block px-4 py-2 hover:bg-gray-100/80 transition-colors">Latviešu</a>
                </li>
            @endif
            @if(env('COUNTRY') == 'lt')
                <li>
                    <a href="{{ route('lang', ['locale' => 'lt']) }}" class="block px-4 py-2 hover:bg-gray-100/80 transition-colors">Lietuvių</a>
                </li>
            @endif
            <li>
                <a href="{{ route('lang', ['locale' => 'ru']) }}" class="block px-4 py-2 hover:bg-gray-100/80 transition-colors">Русский</a>
            </li>
        </ul>
    </div>
</div>
