<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

        <!-- Styles -->
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">

        <!-- Scripts -->
        <script src="{{ asset('js/app.js') }}" defer></script>

    </head>
    <body class="antialiased bg-color-main text-color-main">

        <div class="pt-36 md:pb-36 md:pt-56 text-center flex flex-col items-center">
            <h1 class="title text-5xl md:text-5xl lg:text-6xl max-w-[720px] mb-10">
                <span class="relative z-30">Digital Creative - мерч</span>
            </h1>

            @if (Route::has('login'))
                    @auth
                        <a href="{{ route('dashboard') }}" class="btn btn-blue text-xl">В магазин</a>
                    @else
                    <div class="mt-8">
                        <a class="btn btn-blue mr-6 text-xl" href="{{ route('login') }}">Войти</a>
                        @if (Route::has('register'))
                        <a class="btn btn-blue text-xl" href="{{ route('register') }}">Регистрация</a>
                        @endif
                    </div>
                    @endauth
            @endif

        </div>
        </div>

    </body>
</html>
