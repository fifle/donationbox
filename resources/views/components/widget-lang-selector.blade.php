<!-- Widget Language Selector Component -->
<div class="mb-4">
    <label for="widget-language" class="block text-sm font-medium text-gray-700 mb-1">{{ __('Widget Language') }}</label>
    <select id="widget-language" name="widget-language" class="mt-1 block w-full pl-3 pr-10 py-2 text-base border border-gray-300 shadow-sm focus:outline-none focus:ring-1 focus:ring-pink-700 focus:ring-offset-1 focus:border-pink-500 sm:text-sm rounded-lg hover:border-pink-300 transition duration-150 ease-in-out" onchange="updateEmbedCode()">
        <option value="en">English</option>
        <option value="ru">Русский</option>
        @if(env('COUNTRY') == 'ee')
            <option value="ee">Eesti</option>
        @endif
        @if(env('COUNTRY') == 'lv')
            <option value="lv">Latviešu</option>
        @endif
        @if(env('COUNTRY') == 'lt')
            <option value="lt">Lietuvių</option>
        @endif
    </select>
    <p class="mt-1 text-sm text-gray-500">
        {{ __('Select the language for your embedded widget.') }}
    </p>
</div>

<script>
    function updateEmbedCode() {
        const embedCodeElement = document.getElementById('embed-code');
        if (!embedCodeElement) return;
        
        const widgetLanguage = document.getElementById('widget-language').value;
        let embedCode = embedCodeElement.value;
        
        // Extract the URL from the embed code
        const urlMatch = embedCode.match(/src=['"]([^'"]+)['"]/);
        if (!urlMatch || urlMatch.length < 2) return;
        
        let url = urlMatch[1];
        
        // Remove any existing locale parameter
        url = url.replace(/(&|\?)locale=[^&]+/g, '');
        
        // Add the new locale parameter
        if (url.includes('?')) {
            url = url + `&locale=${widgetLanguage}`;
        } else {
            url = url + `?locale=${widgetLanguage}`;
        }
        
        // Replace the URL in the embed code
        embedCode = embedCode.replace(/src=['"][^'"]+['"]/, `src='${url}'`);
        
        embedCodeElement.value = embedCode;
    }
    
    // Initialize on page load
    document.addEventListener('DOMContentLoaded', function() {
        // Set default language based on current locale
        const currentLocale = "{{ app()->getLocale() }}";
        const languageSelector = document.getElementById('widget-language');
        if (languageSelector) {
            languageSelector.value = currentLocale;
            updateEmbedCode();
        }
    });
</script>