<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <title>{!! urldecode($campaign_title) !!} | {!! urldecode($payee) !!} | DonationBox.ee</title>
    @include('head')
</head>
<body class="antialiased">
<div class="min-h-screen flex items-center justify-center bg-gray-50 py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-md w-full space-y-2">
        <div>
            <div class="mt-2 mb-6 w-1/3 mx-auto">
                <a href="/" target="_blank">
                    <img class="mx-auto" src="/img/db-logo-fl.png">
                </a>
            </div>
            <h2 class="mt-0 text-center text-2xl font-semibold text-gray-700">
                {!! urldecode($campaign_title) !!}
            </h2>
            <div class="mt-2 mb-4 text-center text-sm text-gray-600">
                {!! urldecode($payee) !!}<br>
                {!! urldecode($iban) !!}<br>
                {!! urldecode($detail) !!}<br>
                @if($pp)
                Paypal username: {!! urldecode($pp) !!}<br>
                @endif
                <a href="{{ sprintf("https://www.teatmik.ee/en/search/%s", $payee) }}" class="no-underline
                 hover:underline text-xs text-blue-800" target="_blank">
                    <div class="inline-flex items-center mt-2">
                        Check payee's background
                        <svg class="w-3 h-3 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                             xmlns="http://www.w3
                .org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0
                 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path></svg>
                    </div>
                </a><br>
            </div>

        </div>
        <div x-data="app()" x-cloak>
            <!-- / Bottom Navigation -->
            <div x-show.transition="step != 'complete'">
                <!-- Top Navigation -->
                <div class="py-1">
                    <div class="flex flex-col md:flex-row md:items-center md:justify-between">
                    </div>
                </div>
                <!-- /Top Navigation -->
            </div>

            <div class="bg-white rounded-lg p-5 pt-0 shadow justify-between mb-4">
                <div x-show.transition="step != 'complete'">

                    <!-- Step Content -->
                    <div class="py-1">
                        <!-- Step 1 -->
                        <div>
                            <div class="mb-5">
                                <div class="rounded-md -space-y-px">
                                    <div class="grid gap-6">
                                        <div class="col-span-12">
                                            <div x-data="{toggle: false}">
                                                <div class="flex items-center justify-center mt-8">
                                                    <div class="mr-3 text-xs">One-time payment</div>
                                                    <div
                                                        class="
            relative
            w-12
            h-6
            transition
            duration-200
            ease-linear
            rounded-full
          "
                                                        :class="[toggle ? 'bg-indigo-800' : 'bg-gray-300']"
                                                    >
                                                        <label
                                                            for="toggle"
                                                            class="
              absolute
              left-0
              w-6
              h-6
              transition
              duration-100
              ease-linear
              transform
              bg-gray-100
              rounded-full
              cursor-pointer
            "
                                                            :class="[toggle ? 'translate-x-full border-gray-400' : 'translate-x-0 border-green-400']"
                                                        >
                                                        </label>

                                                        <input
                                                            type="checkbox"
                                                            id="toggle"
                                                            name="toggle"
                                                            x-model="toggle"
                                                            class="w-full h-full appearance-none focus:outline-none"
                                                        />
                                                    </div>
                                                    <div class="ml-3 text-xs">Recurring payment</div>
                                                </div>
                                                <div class="flex items-center justify-center mt-8 mb-4">
                                                    <div class="rounded-full h-6 w-6 flex items-center justify-center bg-yellow-100
                                    text-gray-500 text-xs font-bold">1</div>
                                                    <div class="ml-3 text-xs text-gray-500 text-center">Enter the amount of your donation</div>
                                                </div>
                                                <div x-data="{ preamount: '' }">
                                                    <div class="w-48 max-w-xs mr-auto ml-auto">
                                                        <div class="relative">
                                                            <div
                                                                class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                                          <span class="text-gray-500 text-lg">
                                                            €
                                                          </span>
                                                            </div>
                                                            <form class="space-y-4" action="{{ route('redirect') }}"
                                                                  method="get" id="sumforbank">@csrf</form>
                                                            <input
                                                                form="sumforbank"
                                                                type="number"
                                                                name="donationsum"
                                                                id="donationsum"
                                                                value="{{ $amount }}"
                                                                class="transition duration-150 ease-in-out w-full
                                                                pl-7 pr-7 px-3 py-3 border border-gray-300
                                                        placeholder-gray-500 text-gray-900 rounded-md
                                                        focus:outline-none focus:ring-indigo-500
                                                        focus:border-indigo-500 focus:z-10 text-5xl text-center"
                                                                placeholder="0.00" min="0" step="any" maxlength="4"
                                                                x-model="preamount"
                                                                required>
                                                        </div>
                                                    </div>
                                                    <div class="p-1 mt-1 mb-8 text-center space-y-2">
                                                        <button class="transition duration-150 ease-in-out w-16
                                                        focus:outline-none py-2 px-5 mr-2 rounded-lg
                                                        shadow-sm text-center text-gray-600 bg-white hover:bg-gray-100
                                                        font-medium border" @click="preamount = '5'">
                                                            5€
                                                        </button>
                                                        <button class="transition duration-150 ease-in-out w-16
                                                        focus:outline-none py-2 px-5 mr-2 rounded-lg
                                                        shadow-sm text-center text-gray-600 bg-white hover:bg-gray-100
                                                        font-medium border" @click="preamount = '10'">
                                                            10€
                                                        </button>
                                                        <button class="transition duration-150 ease-in-out w-16
                                                        focus:outline-none py-2 px-5 mr-2 rounded-lg
                                                        shadow-sm text-center text-gray-600 bg-white hover:bg-gray-100
                                                        font-medium border" @click="preamount = '25'">
                                                            25€
                                                        </button>
                                                    </div>
                                                </div>
                                                <div class="flex items-center justify-center">
                                                    <div class="rounded-full h-6 w-6 flex items-center justify-center bg-yellow-100
                                    text-gray-500 text-xs font-bold">2</div>
                                                    <div class="ml-3 text-xs text-gray-500 text-center">Choose a payment
                                                        method</div>
                                                </div>
                                                <div class="">
                                                    <div x-show="!toggle" class="p-1 mt-2 text-center space-x-1 space-y-2">
                                                        <button
                                                            form="sumforbank"
                                                            type="submit"
                                                            name="action"
                                                            value="swed"
                                                            class="transition duration-150 ease-in-out bg-yellow-500 px-5 py-3
                                                    text-sm shadow-sm font-medium
                                                        tracking-wider border text-yellow-100 rounded-full
                                                        hover:shadow-lg hover:bg-yellow-600">Swedbank
                                                        </button>
                                                        @if($sebuid)
                                                        <button
                                                            form="sumforbank"
                                                            type="submit"
                                                            name="action"
                                                            value="seb"
                                                            class="transition duration-150 ease-in-out bg-green-500 px-5 py-3
                                                     text-sm shadow-sm
                                                    font-medium tracking-wider border text-green-100 rounded-full
                                                    hover:shadow-lg hover:bg-green-600">SEB
                                                        </button>
                                                        @endif
                                                        <button
                                                            form="sumforbank"
                                                            type="submit"
                                                            name="action"
                                                            value="lhv"
                                                            class="transition duration-150 ease-in-out bg-gray-700 px-5 py-3
                                                    text-sm shadow-sm
                                                    font-medium tracking-wider border text-gray-100 rounded-full
                                                    hover:shadow-lg hover:bg-gray-800">LHV
                                                        </button>
                                                        <button
                                                            form="sumforbank"
                                                            type="submit"
                                                            name="action"
                                                            value="coop"
                                                            class="transition duration-150 ease-in-out  bg-blue-600 px-5 py-3
                                                    text-sm shadow-sm
                                                    font-medium tracking-wider border text-blue-100 rounded-full
                                                    hover:shadow-lg hover:bg-blue-700">Coop
                                                        </button>
{{--                                                        <button--}}
{{--                                                            form="sumforbank"--}}
{{--                                                            type="submit"--}}
{{--                                                            name="action"--}}
{{--                                                            value="luminor"--}}
{{--                                                            class="transition duration-150 ease-in-out bg-pink-900 px-5--}}
{{--                                                py-3 text-sm shadow-sm--}}
{{--                                                    font-medium tracking-wider border text-pink-100 rounded-full--}}
{{--                                                    hover:shadow-lg hover:bg-pink-800">Luminor--}}
{{--                                                        </button>--}}
{{--                                                        <button--}}
{{--                                                            form="sumforbank"--}}
{{--                                                            type="submit"--}}
{{--                                                            name="action"--}}
{{--                                                            value="citadele"--}}
{{--                                                            class="transition duration-150 ease-in-out bg-red-600 px-5--}}
{{--                                                py-3 text-sm shadow-sm font-medium--}}
{{--                                                     tracking-wider border text-red-100 rounded-full hover:shadow-lg--}}
{{--                                                     hover:bg-red-700">Citadele--}}
{{--                                                        </button>--}}
                                                        @if($pp)
                                                            <button
                                                                form="sumforbank"
                                                                type="submit"
                                                                name="action"
                                                                value="paypal"
                                                                class="transition duration-150 ease-in-out bg-blue-800 px-5
                                                py-3 text-sm shadow-sm font-medium
                                                     tracking-wider border text-blue-100 rounded-full hover:shadow-lg
                                                     hover:bg-blue-900">Paypal
                                                            </button>
                                                        @endif
                                                        @if($db)
                                                            <button
                                                                form="sumforbank"
                                                                type="submit"
                                                                name="action"
                                                                value="donorbox"
                                                                class="transition duration-150 ease-in-out bg-white px-5
                                                py-3 text-sm shadow-sm font-medium
                                                     tracking-wider border text-red-400 rounded-full hover:shadow-lg
                                                     hover:bg-gray-50 inline-flex items-center">
                                                                <span>Credit cards (Donorbox)</span>
                                                            </button>
                                                        @endif
                                                    </div>
                                                    <div x-show="toggle" class="p-1 mt-2 text-center space-x-1 space-y-2">
                                                        <button
                                                            form="sumforbank"
                                                            type="submit"
                                                            name="action"
                                                            value="swed-standing"
                                                            class="transition duration-150 ease-in-out bg-yellow-500 px-5 py-3
                                                    text-sm shadow-sm font-medium
                                                        tracking-wider border text-yellow-100 rounded-full
                                                        hover:shadow-lg hover:bg-yellow-600">Swedbank
                                                        </button>
                                                        @if($sebuid)
                                                        <button
                                                            form="sumforbank"
                                                            type="submit"
                                                            name="action"
                                                            value="seb"
                                                            class="transition duration-150 ease-in-out bg-green-500 px-5 py-3
                                                     text-sm shadow-sm
                                                    font-medium tracking-wider border text-green-100 rounded-full
                                                    hover:shadow-lg hover:bg-green-600">SEB
                                                        </button>
                                                        @endif
                                                        <button
                                                            form="sumforbank"
                                                            type="submit"
                                                            name="action"
                                                            value="lhv"
                                                            class="transition duration-150 ease-in-out bg-gray-700 px-5 py-3
                                                    text-sm shadow-sm
                                                    font-medium tracking-wider border text-gray-100 rounded-full
                                                    hover:shadow-lg hover:bg-gray-800">LHV
                                                        </button>
                                                        <button
                                                            form="sumforbank"
                                                            type="submit"
                                                            name="action"
                                                            value="coop"
                                                            class="transition duration-150 ease-in-out  bg-blue-600 px-5 py-3
                                                    text-sm shadow-sm
                                                    font-medium tracking-wider border text-blue-100 rounded-full
                                                    hover:shadow-lg hover:bg-blue-700">Coop
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            @include('secure')

            <div class="bg-white rounded-lg p-5 mt-4 shadow justify-between">
                <div class="content-center">
                    <p class="mt-2 mb-2 text-center text-1xl font-bold text-gray-600">
                        Scan QR-code and easily share donation box!
                    </p>
                    <img src="data:image/png;base64, {!! base64_encode($qrcode) !!}" class="p-3.5">

                    <div class="p-1 mt-2 text-center">
                    <a href="#" class="no-underline text-mg text-blue-800">
                        <div class="transition duration-150 ease-in-out bg-white
                                                     px-5 py-3 text-sm shadow-sm font-medium
                                                     tracking-wider border text-gray-600 rounded-full hover:shadow-lg
                                                     hover:bg-gray-50 inline-flex items-center">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                 xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"></path></svg>
                            Download QR-code as PDF
                        </div>
                    </a>
                    <a href="data:image/png;base64, {!! base64_encode($qrcode) !!}" class="no-underline text-mg
                    text-blue-800" download="donationbox-{{$iban}}.png">
                        <div class="mt-2 transition duration-150 ease-in-out bg-white
                                                     px-5 py-3 text-sm shadow-sm font-medium
                                                     tracking-wider border text-gray-600 rounded-full hover:shadow-lg
                                                     hover:bg-gray-50 inline-flex items-center">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                 xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                            Download QR-code as an PNG image
                        </div>
                    </a>
                </div>
                </div>
            </div>

            <div class="bg-white rounded-lg p-5 mt-10 shadow justify-between">
                <div class="content-center">
                    <p class="mt-2 mb-2 text-center text-1xl font-bold text-gray-600">
                        Share this donation box with your friends!
                    </p>
                    <div class="mt-2 inline-flex items-center">
                        {!! Share::page(url()->full(), urldecode($campaign_title))->facebook()->twitter()->linkedin()->whatsapp() !!}
                        <!-- Trigger -->
                            <button href="#_" class="btn px-4 py-2.5 ml-2 font-medium bg-blue-50 hover:bg-blue-100
                            hover:text-blue-600
                text-blue-500 rounded-lg text-sm inline-flex items-center" data-clipboard-text="{{ $link }}" >
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                     xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 5H6a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2v-1M8 5a2 2 0 002 2h2a2 2 0 002-2M8 5a2 2 0 012-2h2a2 2 0 012 2m0 0h2a2 2 0 012 2v3m2 4H10m0 0l3-3m-3 3l3 3"></path></svg> Copy link to clipboard
                            </button>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-lg p-5 mt-10 shadow justify-between">
                <p class="mt-2 mb-2 text-center text-1xl font-bold text-gray-600">
                    Embed your donation box to your webpage
                </p>

                <!-- Target -->
                <input id="foo"
                       class="shadow appearance-none border rounded py-2 px-3 w-auto text-gray-700 leading-tight
                       focus:outline-none focus:shadow-outline"
                       value="{{ sprintf("<iframe src='%s' width='500' height='700' style='border:none;overflow:hidden'
                        scrolling='no' frameborder='0' allowfullscreen='true' allow='autoplay; clipboard-write; encrypted-media; picture-in-picture; web-share'></iframe>", $embedlink) }}">

                <!-- Trigger -->
                <button href="#_" class="btn px-3 py-2.5 font-medium bg-blue-50 hover:bg-blue-100 hover:text-blue-600
                text-blue-500 rounded-lg text-sm inline-flex items-center" data-clipboard-target="#foo">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                         xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 5H6a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2v-1M8 5a2 2 0 002 2h2a2 2 0 002-2M8 5a2 2 0 012-2h2a2 2 0 012 2m0 0h2a2 2 0 012 2v3m2 4H10m0 0l3-3m-3 3l3 3"></path></svg>
                    Copy to clipboard
                </button>

                <script type="text/javascript">
                    var Clipboard = new ClipboardJS('.btn');
                </script>
            </div>


                @include('footer')


        </div>
    </div>

</div>

<script>
    function app() {
        return {
            step: 1,
            passwordStrengthText: '',
            togglePassword: false,

            password: '',
            gender: 'Male',

            checkPasswordStrength() {
                var strongRegex = new RegExp("^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#\$%\^&\*])(?=.{8,})");
                var mediumRegex = new RegExp("^(((?=.*[a-z])(?=.*[A-Z]))|((?=.*[a-z])(?=.*[0-9]))|((?=.*[A-Z])(?=.*[0-9])))(?=.{6,})");

                let value = this.password;

                if (strongRegex.test(value)) {
                    this.passwordStrengthText = "Strong password";
                } else if (mediumRegex.test(value)) {
                    this.passwordStrengthText = "Could be stronger";
                } else {
                    this.passwordStrengthText = "Too weak";
                }
            }
        }
    }
</script>
</body>
</html>
