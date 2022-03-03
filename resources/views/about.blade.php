<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    @include('head')
</head>
<body class="antialiased">

<div class="min-h-screen flex items-center justify-center bg-gray-50 py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-xl w-full space-y-2">
        <div class="items-center justify-center mt-8 mb-6">
            <div class="w-1/3 mx-auto mb-4">
                <a href="/" target="_blank">
                    <img class="mx-auto" src="/img/db-logo-fl.png">
                </a>
            </div>
            <h1 class="text-center text-3xl text-gray-700 mb-8">
                FAQ
            </h1>
            <div id="how-it-works" class="bg-white rounded-lg p-5 shadow justify-between">
                <h2 class="font-medium text-xl">
                    How it works?
                </h2>
                <div class="mt-2 text-sm">
                    Here's the desc
                </div>
            </div>

            <hr class="mt-8 mb-8">

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
        }
    }
</script>
</body>
</html>
