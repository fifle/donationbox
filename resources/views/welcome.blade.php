<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    @include('head')
</head>
<body class="antialiased">

<div class="min-h-screen flex items-center justify-center bg-gray-50 py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-md w-full space-y-2">
        <div class="items-center justify-center">
            <div class="mb-4 w-1/2 mx-auto">
                <a href="/" target="_blank">
                    <img class="mx-auto" src="/img/db-logo-fl.png">
                </a>
            </div>
            <h2 class="mt-0 text-center text-xl font-bold text-gray-900">
                Open your own donation box for
                Estonian banks with no hidden fees
            </h2>
            <div class="w-full mt-2 mb-4 flex justify-center items-center text-left">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                     xmlns="http://www.w3
                    .org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
                <a href="#" class="inline-block items-center no-underline hover:underline text-sm text-blue-800
                text-left">
                    It's secure and we don't store your data.
                    <br>Learn more about how it works >
                </a>
            </div>
        </div>
        <div x-data="app()" x-cloak>
            <!-- / Bottom Navigation https://placehold.co/300x300/e2e8f0/cccccc -->
            <div x-show.transition="step != 'complete'">
                <!-- Top Navigation -->
                <!-- /Top Navigation -->
            </div>

            <div class="bg-white rounded-lg p-5 shadow justify-between">
                <div class="">
                    <div x-show.transition="step === 'complete'">
                        <div class="">
                            <div>
                                <button
                                    @click="step = 1"
                                    class="w-40 block mx-auto focus:outline-none py-2 px-5 rounded-lg shadow-sm text-center text-gray-600 bg-white hover:bg-gray-100 font-medium border"
                                >Back to home
                                </button>
                            </div>
                        </div>
                    </div>

                    <div x-show.transition="step != 'complete'">

                        <!-- Step Content -->
                        <div class="py-1">
                            <!-- Step 1 -->
                            <div x-show="step === 1"
                                 x-transition:enter.duration.500ms>
                                <div class="mb-5">
                                    <form class="space-y-4" action="{{ route('donation') }}" method="get"
                                          id="generator">@csrf</form>
                                    <div class="rounded-md -space-y-px">
                                        <div class="grid gap-6">
                                            <div class="col-span-12">
                                                <label for="campaign_title" class="font-bold text-gray-700
                                                        block mb-1">Name your virtual donation box</label>
                                                <div class="tracking-normal text-xs text-gray-500 mb-3
                                                        leading-tight">
                                                    This text will be used as the title of your donation box page.
                                                </div>
                                                <input
                                                    form="generator"
                                                    type="text"
                                                    name="campaign_title"
                                                    id="campaign_title_field"
                                                    value="{{ request('campaign_title') }}"
                                                    class="appearance-none rounded-none relative block
                                                               w-full px-3 py-2 border border-gray-300
                                                               placeholder-gray-500 text-gray-900 rounded-md
                                                               focus:outline-none focus:ring-indigo-500
                                                               focus:border-indigo-500 focus:z-10 lg:text-lg transition duration-150 ease-in-out"
                                                    {{--                                                            placeholder=""--}}
                                                    required>
                                            </div>

                                            <div class="col-span-12">

                                                <label for="detail" class="font-bold text-gray-700
                                                        block mb-1">
                                                    Bank transfer detail
                                                </label>
                                                <div class="tracking-normal text-xs text-gray-500 mb-3
                                                        leading-tight">
                                                    This value will be used as a requisite for the money transfer.
                                                    <br>
                                                    <a href="/" class="no-underline hover:underline
                                                    text-blue-800">
                                                        Learn more about why it's important to keep it serious and
                                                        straightforward.
                                                    </a>
                                                </div>
                                                <input
                                                    form="generator"
                                                    type="text"
                                                    name="detail"
                                                    value="Ülekanne"
                                                    {{--                                                            value="{{ request('detail') }}"--}}
                                                    class="appearance-none rounded-none relative block
                                                               w-full px-3 py-2 border border-gray-300
                                                               placeholder-gray-500 text-gray-900 rounded-md
                                                               focus:outline-none focus:ring-indigo-500
                                                               focus:border-indigo-500 focus:z-10 lg:text-lg transition duration-150 ease-in-out"
                                                    placeholder="eg. Ülekanne"
                                                    required/>

{{--                                                <input type="checkbox" name="duplicateName" id="duplicateName"--}}
{{--                                                       value="Yes" placeholder="test"/>--}}
{{--                                                <label for="duplicateName" class="tracking-normal text-xs--}}
{{--                                                text-gray-500 mb-3 leading-tight">Use the same as the name for the--}}
{{--                                                    donation box?</label>--}}

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Step 2 -->
                        <div x-show="step === 2"
                             x-transition:enter.duration.500ms>
                            <div class="mb-5">
                                @csrf
                                <div class="rounded-md -space-y-px">
                                    <div class="grid gap-6">
                                        <div class="col-span-12">
                                            <label for="campaign_title" class="font-bold text-gray-700
                                                        block mb-2">Payee's name</label>
                                            <div class="tracking-normal text-xs text-gray-500 mb-3
                                                        leading-tight">
                                                Insert the name of the individual or company you would like
                                                to donate to. Please make sure that the name is spelled correctly and in
                                                Latin letters.
                                            </div>
                                            <input
                                                form="generator"
                                                type="text"
                                                name="payee"
                                                value="{{ request('payee') }}"
                                                class="appearance-none rounded-none relative block
                                                               w-full px-3 py-2 border border-gray-300
                                                               placeholder-gray-500 text-gray-900 rounded-md
                                                               focus:outline-none focus:ring-indigo-500
                                                               focus:border-indigo-500 focus:z-10 lg:text-lg transition duration-150 ease-in-out"
                                                placeholder="eg. Vassili Pupkin"
                                                required/>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Step 3 -->
                        <div x-show="step === 3"
                             x-transition:enter.duration.500ms>
                            <div class="mb-5">
                                @csrf
                                <div class="rounded-md -space-y-px">
                                    <div class="grid gap-6">
                                        <div class="col-span-12">
                                            <label for="campaign_title" class="font-bold text-gray-700
                                                        block mb-2">Payee's bank account (IBAN) number</label>
                                            <input
                                                form="generator"
                                                type="text"
                                                name="iban"
                                                value="{{ request('iban') }}"
                                                class="appearance-none rounded-none relative block
                                                               w-full px-3 py-2 border border-gray-300
                                                               placeholder-gray-500 text-gray-900 rounded-md
                                                               focus:outline-none focus:ring-indigo-500
                                                               focus:border-indigo-500 focus:z-10 lg:text-lg transition duration-150 ease-in-out"
                                                placeholder="eg. EE471000001020145685"
                                                required/>
                                        </div>
                                        <div class="col-span-12">
                                            <label for="campaign_title" class="font-bold text-gray-700
                                                        block mb-2">SEB UID code</label>
                                            <div class="tracking-normal text-xs text-gray-500 mb-3
                                                        leading-tight">
                                                If you want to connect SEB bank as part of the payment methods, you
                                                need to get your own UID code from SEB.
                                                <a href="#" class="no-underline hover:underline
                                                    text-blue-800">Read more about how to
                                                    obtain a special identifier for private individuals and companies
                                                >   </a>
                                            </div>
                                            <input
                                                form="generator"
                                                type="text"
                                                name="sebuid"
                                                value="{{ request('sebuid') }}"
                                                class="appearance-none rounded-none relative block
                                                               w-full px-3 py-2 border border-gray-300
                                                               placeholder-gray-500 text-gray-900 rounded-md
                                                               focus:outline-none focus:ring-indigo-500
                                                               focus:border-indigo-500 focus:z-10 lg:text-lg transition duration-150 ease-in-out"
                                                placeholder="Insert your UID here"
                                            />
                                        </div>
                                        <div class="col-span-12">
                                            <label for="campaign_title" class="font-bold text-gray-700
                                                        block mb-2">PayPal.me username</label>
                                            <div class="flex flex-wrap items-stretch w-full mb-2 relative">
                                                <div class="flex -mr-px">
                                                    <span
                                                        class="flex items-center leading-normal bg-grey-lighter rounded rounded-r-none border border-r-0 border-grey-light px-3 whitespace-no-wrap text-grey-dark text-sm">paypal.me/</span>
                                                </div>
                                                <input
                                                    form="generator"
                                                    type="text"
                                                    name="pp"
                                                    value="{{ request('pp') }}"
                                                    class="flex-shrink flex-grow flex-auto flex-auto
                                                        leading-normal w-px flex-1 border h-10 border-grey-light rounded rounded-l-none px-3 relative transition duration-150 ease-in-out"
                                                    placeholder="Insert your Paypal username here"
                                                />
                                            </div>
                                        </div>
                                        <div class="col-span-12">
                                            <label for="campaign_title" class="font-bold text-gray-700
                                                        block mb-2">Donorbox username (for credit cards)</label>
                                                <input
                                                    form="generator"
                                                    type="text"
                                                    name="db"
                                                    value="{{ request('db') }}"
                                                    class="appearance-none rounded-none relative block
                                                               w-full px-3 py-2 border border-gray-300
                                                               placeholder-gray-500 text-gray-900 rounded-md
                                                               focus:outline-none focus:ring-indigo-500
                                                               focus:border-indigo-500 focus:z-10 lg:text-lg transition duration-150 ease-in-out"
                                                    placeholder="Insert your Donorbox username here"
                                                    />
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- / Step Content -->
                </div>
            </div>

            <!-- Bottom Navigation -->
            <div class="fixed bottom-0 left-0 right-0 py-5 bg-white shadow-md" x-show="step != 'complete'">
                <div class="max-w-3xl mx-auto px-4">
                    <div class="flex justify-between">
                        <div class="w-1/2 text-right">
                            <button
                                x-show="step > 1"
                                @click="step--"
                                class="w-32 focus:outline-none py-2 px-5 mr-2 rounded-lg shadow-sm text-center
                                    text-gray-600 bg-white hover:bg-gray-100 font-medium border transition duration-150 ease-in-out"
                            >Previous
                            </button>
                        </div>

                        <div class="w-1/2 ">
                            <button
                                x-show="step < 3"
                                @click="step++"
                                class="w-32 focus:outline-none border border-transparent py-2 px-5 ml-2 rounded-lg
                                    border border-transparent font-medium rounded-md text-white bg-indigo-600
                                    hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition duration-150 ease-in-out">
                                Next
                            </button>

                            <button
                                type="submit"
                                form="generator"
                                value="submit"
                                x-show="step === 3"
                                class="w-32 focus:outline-none border border-transparent py-2 px-5 ml-2 rounded-lg
                                    border border-transparent font-medium rounded-md text-white bg-indigo-600
                                    hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition duration-150 ease-in-out">
                                Complete
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="py-4">
                <div class="flex flex-col md:flex-row md:items-center md:justify-between">
                    <div class="flex-1">
                        <div class="uppercase tracking-normal text-xs font-normal text-gray-400 mb-1 leading-tight"
                             x-text="`Step: ${step} of 3`"></div>
                        {{--                            <div x-show="step === 1">--}}
                        {{--                                <div class="text-lg font-normal text-gray-500 leading-tight">Campaign name</div>--}}
                        {{--                            </div>--}}

                        {{--                            <div x-show="step === 2">--}}
                        {{--                                <div class="text-lg font-normal text-gray-500 leading-tight">Payee's name--}}
                        {{--                                </div>--}}
                        {{--                            </div>--}}

                        {{--                            <div x-show="step === 3">--}}
                        {{--                                <div class="text-lg font-normal text-gray-500 leading-tight">Bank details</div>--}}
                        {{--                            </div>--}}
                    </div>

                    <div class="flex items-center md:w-64">
                        <div class="w-full bg-white rounded-full mr-2">
                            <div class="rounded-full bg-green-500 text-xs leading-none h-2 text-center text-white"
                                 :style="'width: '+ parseInt(step / 3 * 100) +'%'"></div>
                        </div>
                        <div class="text-xs w-10 text-gray-600 transition duration-150 ease-in-out" x-text="parseInt(step / 3 * 100) +'%'"></div>
                    </div>
                </div>
            </div>

        </div>
        @include('footer')
    </div>

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
