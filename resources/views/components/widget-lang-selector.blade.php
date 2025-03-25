<!-- Widget Language Selector Component -->
<div class="mb-4">
    <label for="widget-language" class="block text-sm font-medium text-gray-700 mb-1">{{ __('Widget Language') }}</label>
    <select id="widget-language" name="widget-language" class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md" onchange="updateEmbedCode()">
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
        
        // Remove any existing locale parameter
        embedCode = embedCode.replace(/(&|\?)locale=[^&]+/g, '');
        
        // Add the new locale parameter
        if (embedCode.includes('?')) {
            embedCode = embedCode.replace('?', `?locale=${widgetLanguage}&`);
        } else {
            // If there's no query string yet, add one
            embedCode = embedCode.replace('src="', `src="?locale=${widgetLanguage}`);
        }
        
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