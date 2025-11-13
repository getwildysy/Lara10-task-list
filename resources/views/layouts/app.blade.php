<!DOCTYPE html>
<html lang="zh_TW">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="//unpkg.com/alpinejs" defer></script>

    {{-- 讓自訂的tailwind樣式可以使用 --}}
    {{-- {{ blade - formatter - disable }} --}}
    <style type="text/tailwindcss">
        .btn {
            @apply rounded-md px-4 py-2 text-center font-medium shadow-sm ring-1 ring-slate-700/10 transition-colors duration-200
        }

        .btn-primary {
            @apply bg-indigo-600 text-white hover:bg-indigo-700
        }

        .btn-secondary {
            @apply bg-gray-200 text-gray-800 hover:bg-gray-300
        }

        .btn-danger {
            @apply bg-red-600 text-white hover:bg-red-700
        }

        .btn-warning {
            @apply bg-yellow-500 text-white hover:bg-yellow-600
        }

        .link {
            @apply font-medium text-gray-700 underline decoration-pink-500
        }

        label {
            @apply block uppercase text-slate-700 mb-2
        }

        input, textarea {
            @apply shadow-sm appearance-none border rounded w-full py-2 px-3 text-slate-700 leading-tight focus:outline-none focus:ring-2 focus:ring-indigo-500
        }

        .error {
            @apply text-red-500 text-sm
        }
    </style>
    {{-- blade-formatter-enable --}}
    <title>Laravel App - @yield('title')</title>
    @yield('styles')

</head>

{{-- 將 body 加上背景色，並讓內容撐滿最小高度 --}}

<body class="bg-gray-100 min-h-screen">
    <div class="container mx-auto mt-10 mb-10 max-w-lg">
        {{-- 將所有內容包裹在一個白色卡片中 --}}
        <div class="bg-white p-6 sm:p-8 rounded-lg shadow-xl">

            <h1 class="mb-6 text-3xl font-bold text-gray-800">@yield('title')</h1>

            {{-- 使用 alpine js 來控制 flash --}}
            <div x-data="{ flash: true }">
                @if (session()->has('success'))
                    <div x-show="flash"
                        class="relative mb-6 rounded border border-green-400 bg-green-100 px-4 py-3 text-lg text-green-700"
                        role="alert">
                        <strong class="font-bold">Success!</strong>
                        <div>{{ session('success') }}</div>

                        <span class="absolute top-0 bottom-0 right-0 px-4 py-3">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="1.5" @click="flash = false" stroke="currentColor"
                                class="h-6 w-6 cursor-pointer">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </span>
                    </div>
                @endif
            </div>

            @yield('content')
        </div>
    </div>
</body>

</html>
