<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    @include('head')
</head>
<body class="antialiased">

<div class="min-h-screen flex items-center justify-center bg-gray-50 py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-md w-full space-y-2">
        <div>
            <h2 class="mt-0 text-center text-2xl font-bold text-gray-900">
                {!! urldecode($campaign_title) !!}
            </h2>
            <p class="mt-2 mb-0 text-center text-sm text-gray-600">
                {!! urldecode($payee) !!} / {!! urldecode($iban) !!} / {!! urldecode($detail) !!}
                {{--                <a href="" class="no-underline hover:underline text-xs text-blue-800">payee's background ></a>--}}
            </p>

        </div>
        <div x-data="app()" x-cloak>
            <!-- / Bottom Navigation https://placehold.co/300x300/e2e8f0/cccccc -->
            <div x-show.transition="step != 'complete'">
                <!-- Top Navigation -->
                <div class="py-1">
                    <div class="flex flex-col md:flex-row md:items-center md:justify-between">

                    </div>
                </div>
                <!-- /Top Navigation -->
            </div>

            <div class="bg-white rounded-lg p-5 pt-0 shadow justify-between">
                <div class="">

                </div>

                <div x-show.transition="step != 'complete'">

                    <!-- Step Content -->
                    <div class="py-1">
                        <!-- Step 1 -->
                        <div>
                            <div class="mb-5">
                                <div class="rounded-md -space-y-px">
                                    <div class="grid gap-6">
                                        <div class="col-span-12">
                                            <div>
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
                                                </div>

                                                <div x-data="{ preamount: '' }">

                                                    <div class="w-40 max-w-xs mr-auto ml-auto mt-4">
                                                <div class="relative">
                                                    <div
                                                        class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                                          <span class="text-gray-500 text-lg">
                                                            €
                                                          </span>
                                                    </div>
                                                    <form class="space-y-4" action="{{ route('getBankLink') }}"
                                                          method="post" id="sumforbank">@csrf</form>
                                                    <input
                                                        form="sumforbank"
                                                        type="number"
                                                        name="donationsum"
                                                        id="donationsum"
                                                        value="{{ $amount }}"
                                                        class="w-full pl-7 pr-7 px-3 py-2 border border-gray-300
                                                        placeholder-gray-500 text-gray-900 rounded-md
                                                        focus:outline-none focus:ring-indigo-500
                                                        focus:border-indigo-500 focus:z-10 text-4xl text-center"
                                                        placeholder="0.00"
                                                        x-model="preamount">
                                                </div>
                                                    </div>
                                                    <div class="p-1 mb-4 text-center space-y-2">
                                                        <button class="w-16 focus:outline-none py-2 px-5 mr-2 rounded-lg
                                                        shadow-sm text-center text-gray-600 bg-white hover:bg-gray-100
                                                        font-medium border" @click="preamount = '5'">
                                                            5€
                                                        </button>
                                                        <button class="w-16 focus:outline-none py-2 px-5 mr-2 rounded-lg
                                                        shadow-sm text-center text-gray-600 bg-white hover:bg-gray-100
                                                        font-medium border" @click="preamount = '10'">
                                                            10€
                                                        </button>
                                                        <button class="w-16 focus:outline-none py-2 px-5 mr-2 rounded-lg
                                                        shadow-sm text-center text-gray-600 bg-white hover:bg-gray-100
                                                        font-medium border" @click="preamount = '25'">
                                                            25€
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="p-1 mt-2 text-center space-x-1 space-y-2">
                                                <a
                                                    x-data="{ url: '{!! $swed_single !!}' }"
                                                    href="{!! $swed_single !!}"
                                                    target="_blank">
                                                    <button
                                                        class="bg-yellow-500 px-5 py-3 text-sm shadow-sm
                                                        font-medium tracking-wider border text-yellow-100 rounded-full
                                                        hover:shadow-lg hover:bg-yellow-600">Swedbank
                                                    </button>
                                                </a>
                                                <button
                                                    form="sumforbank"
                                                    type="submit"
                                                        name="action"
                                                        value="swed"
                                                        class="bg-yellow-500 px-5 py-3 text-sm shadow-sm font-medium
                                                        tracking-wider border text-yellow-100 rounded-full hover:shadow-lg hover:bg-yellow-600">Swedbank 1
                                                    </button>
                                                <button class="bg-gray-700 px-5 py-3 text-sm shadow-sm
                                                    font-medium tracking-wider border text-gray-100 rounded-full
                                                    hover:shadow-lg hover:bg-gray-800">LHV
                                                </button>
                                                <button class="bg-green-500 px-5 py-3 text-sm shadow-sm
                                                    font-medium tracking-wider border text-green-100 rounded-full
                                                    hover:shadow-lg hover:bg-green-600">SEB
                                                </button>
                                                <button class="bg-pink-900 px-5 py-3 text-sm shadow-sm
                                                    font-medium tracking-wider border text-pink-100 rounded-full
                                                    hover:shadow-lg hover:bg-pink-800">Luminor
                                                </button>
                                                <button class="bg-blue-600 px-5 py-3 text-sm shadow-sm
                                                    font-medium tracking-wider border text-blue-100 rounded-full
                                                    hover:shadow-lg hover:bg-blue-700">Coop
                                                </button>
                                                <button class="bg-red-600 px-5 py-3 text-sm shadow-sm font-medium
                                                     tracking-wider border text-red-100 rounded-full hover:shadow-lg
                                                     hover:bg-red-700">Citadele
                                                </button>
                                            </div>
                                        </div>

                                    </div>
                                    <div>{!! $qrcode !!}</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


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
