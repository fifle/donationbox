<footer role="contentinfo" class="pt-10 pb-16 text-center">

    @if(Route::currentRouteName() === 'donation')
    <a href="mailto:donationbox.ee@gmail.com?subject=Report%20Alert%20from%20Donationbox.ee&body=Your%20name%3A%0D%0AYour%20email%3A%0D%0AReason%20for%20reporting%3A%0D%0AReported%20URL%3A%20{{ urlencode(url()->full()) }}"
       target="_blank"
       class="d-font glass-footer-link inline-flex items-center gap-2 mb-6 text-red-500 border-red-200"
       aria-label="@lang('Report fraud or suspicious activity')">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path></svg>
        @lang("Report fraud")
    </a>
    @endif

    <div class="flex justify-center gap-2 mb-6">
        <a href="https://donationbox.ee" class="d-font glass-footer-link" target="_blank">EE</a>
        <a href="https://donationbox.lv" class="d-font glass-footer-link" target="_blank">LV</a>
        <a href="https://donationbox.lt" class="d-font glass-footer-link" target="_blank">LT</a>
    </div>
    
    <div class="flex flex-wrap justify-center gap-x-4 gap-y-2 mb-4 text-xs text-gray-500">
        <a href="/about" class="hover:text-gray-700 transition-colors">@lang("FAQ")</a>
        <a href="/about" class="hover:text-gray-700 transition-colors">@lang("About us")</a>
        <a href="https://bit.ly/db_ee_privacypolicy" target="_blank" class="hover:text-gray-700 transition-colors">@lang("Privacy Policy")</a>
        <a href="https://github.com/fifle/donationbox" class="hover:text-gray-700 transition-colors" target="_blank">GitHub</a>
        <a href="mailto:donationbox.ee@gmail.com" class="hover:text-gray-700 transition-colors" target="_blank">@lang("Contact us")</a>
    </div>

    <div class="text-xs text-gray-400 space-y-1">
        <p>@lang("Made with") <span class="text-pink-400">&#9829;</span> @lang("by") <a href="//fleisher.ee" class="text-gray-500 hover:text-gray-700 transition-colors" target="_blank">@lang("Pavel")</a> @lang("and inspired by Sheila")</p>
        @if (env('COUNTRY') == 'ee')
            <a href="/donation?campaign_title=Support+Donationbox.ee&detail=Annetus+donationbox.ee&payee=Pavel+Flei%C5%A1er&iban=EE614204278622417401&pp=pfleiser&rev=pavelvtd" class="inline-flex items-center gap-1 text-pink-500 hover:text-pink-600 transition-colors" target="_blank">
        @else
            <a href="/donation?campaign_title=Support+Donationbox.ee&detail=Donation+donationbox.ee&payee=Pavel+Flei%C5%A1er&pp=pfleiser&rev=pavelvtd" class="inline-flex items-center gap-1 text-pink-500 hover:text-pink-600 transition-colors" target="_blank">
        @endif
            @lang("Support the project")
            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
        </a>
    </div>
</footer>
