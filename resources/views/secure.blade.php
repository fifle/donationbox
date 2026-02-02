<div class="secure-block w-full py-2 flex justify-center text-gray-600" role="region" aria-label="@lang('Security and privacy')">
    <a href="/about#security" class="d-font inline-flex items-center justify-center gap-2 no-underline hover:underline text-xs text-center text-gray-600 hover:text-gray-800 px-4 max-w-md" target="_blank" aria-label="@lang("Learn more about security and data privacy")">
        <svg class="w-4 h-4 flex-shrink-0 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
        <span>@lang("It's secure and we won't store your data.")@if(app()->getLocale() === 'en')<br class="hidden sm:block">@endif @lang("Learn more about how it works >")</span>
    </a>
</div>
