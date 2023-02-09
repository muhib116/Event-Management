<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title inertia></title>
        
        <!-- Fontawesome -->
        <script src="https://kit.fontawesome.com/38516d3f67.js" crossorigin="anonymous"></script>
        <!-- favicon -->
        @php
            $settings = \App\Models\SiteSetting::where('name', 'fave_icon')->first();
        @endphp
        <link rel="shortcut icon" href="{{ asset(@$settings->value) }}" type="image/x-icon">
        <!-- Scripts -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/js-cookie/2.2.0/js.cookie.min.js"></script>

        @routes
        @vite(['resources/js/app.js', "resources/js/Pages/{$page['component']}.vue"])
        @inertiaHead
    </head>
    <body class="" id="root__body">
        @inertia

        
        <div id='translatorWrapper' class="fixed top-1/2 z-30 bg-white px-4 rounded-l w-[150px] -right-[150px]" style="display: none;">
            <span onclick="toogleTranslator()" class="shadow icon absolute right-full inline-block py-2 px-1 rounded-l top-[20px] bg-white cursor-pointer">
                <svg style="width: 16px;height:16px;" xmlns="http://www.w3.org/2000/svg" width="200" height="200" viewBox="796 796 200 200" xml:space="preserve"><path d="M973.166 818.5H818.833c-12.591 0-22.833 10.243-22.833 22.833v109.333c0 12.59 10.243 22.833 22.833 22.833h154.333c12.59 0 22.834-10.243 22.834-22.833V841.333c0-12.59-10.244-22.833-22.834-22.833zM896 961.5h-77.167c-5.973 0-10.833-4.859-10.833-10.833V841.333c0-5.974 4.86-10.833 10.833-10.833H896v131zm82.58-89.371c-.547 9.145-5.668 27.261-20.869 39.845 4.615 1.022 9.629 1.573 14.92 1.573v12c-10.551 0-20.238-1.919-28.469-5.325-7.689 3.301-16.969 5.325-28.125 5.325v-12c5.132 0 9.924-.501 14.366-1.498-8.412-7.016-13.382-16.311-13.382-26.78h11.999c0 8.857 5.66 16.517 14.884 21.623 4.641-2.66 8.702-6.112 12.164-10.351 5.628-6.886 8.502-14.521 9.754-20.042h-49.785v-12h22.297v-11.986h12V864.5h21.055c1.986 0 3.902.831 5.258 2.28a7.213 7.213 0 0 1 1.933 5.349z"/><path d="m839.035 914.262-4.45 11.258h-15.971l26.355-61.09h15.971l25.746 61.09h-16.583l-4.363-11.258h-26.705zm13.44-34.386-8.902 22.604h17.629l-8.727-22.604z"/></svg>
            </span>
            <div id="google_translate_element"></div>
        </div>

        <script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
        <script type="text/javascript">
            function googleTranslateElementInit() {
                new google.translate.TranslateElement({pageLanguage: 'en'}, 'google_translate_element');
            }

            function toogleTranslator(){
                translatorWrapper.classList.toggle('-right-[0px]')
            }
        </script>
        <style>
            .skiptranslate {
                display: none !important;
            }
        </style>
    </body>
</html>
