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
                            <div class="mt-5 mb-3">
                                <div class="rounded-md -space-y-px">
                                    <div class="grid gap-6">
                                        <div class="col-span-12">
                                            <p>You will be automatically redirected to <b>{!! $bankname !!}</b> to
                                                finalize
                                                your
                                                payment.<   /p>
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
