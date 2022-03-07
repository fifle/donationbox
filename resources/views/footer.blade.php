<div class="pt-8 pb-14 text-center text-gray-600">

    @if(Route::currentRouteName() === 'donation')
    <a href="mailto:donationbox.ee@gmail.com?subject=Report%20Alert%20from%20Donationbox.ee&body=Your%20name%3A%0D%0AYour%20email%3A%0D%0AReason%20for%20reporting%3A%0D%0AReported%20URL%3A%20{{
    urlencode(url()->full()) }}"
       target="_blank"
       class="transition duration-150 ease-in-out bg-white px-5
                                                py-2 mb-4 text-sm shadow-sm font-medium
                                                     tracking-wider border text-red-400 rounded-full hover:shadow-lg
                                                     hover:bg-gray-50 inline-flex items-center">

        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3
        .org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path></svg>
        Report fraud
    </a>
    @endif

    <div class="flex justify-center mb-2 text-xs">
        <a href="/about" class="no-underline hover:underline text-blue-800">
            FAQ
        </a>
        <span class="ml-2 mr-2">
            |
        </span>
        <a href="/about" class="no-underline hover:underline text-blue-800">
            About us
        </a>
        <span class="ml-2 mr-2">
            |
        </span>
        <a href="#" class="no-underline hover:underline text-blue-800" target="_blank">
            GitHub <sup class="z-0">soon</sup>
        </a>
    </div>

    <div class="text-xs">
    Made with ❤ by <a href="//fleisher.ee" class="no-underline
                 hover:underline text-blue-800" target="_blank">
        <div class="inline-flex items-center">Pavel<svg class="w-3 h-3 ml-1" fill="none"
                                                        stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3
                .org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0
                 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path></svg>
        </div>
    </a>
    and inspired by Sheila
    <br>
    <a href="/donation?campaign_title=Support+Donationbox.ee&detail=Annetus+donationbox.ee&payee=Pavel+Flei%C5%A1er&iban=EE614204278622417401&pp=pfleiser&rev=pavelvtd" class="no-underline
                 hover:underline text-xs text-blue-800 mt-4" target="_blank">
        <div class="inline-flex items-center mt-2">
            Support the project <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                     xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
        </div>
    </a>
    </div>
</div>
