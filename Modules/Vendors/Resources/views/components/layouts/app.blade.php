<livewire:vendors::layouts.header />

    </head>
    <body class="home">
        <!-- Preloader -->
        {{--  <div class="loader-mask">
            <div class="loader">
                <img src="{{url('site/images/preload.gif')}}" alt="">
            </div>
        </div>  --}}
        <!-- Preloader -->
        <div class="page-wrapper">
        <livewire:vendors::layouts.navbar />

        @yield('content')

        <livewire:vendors::layouts.footer />
        </div>
        <livewire:vendors::layouts.footer-menu />
        {{-- Laravel Vite - JS File --}}
        {{-- {{ module_vite('build-vendors', 'Resources/assets/js/app.js') }} --}}
        {{--  <script>

            $(window).on('load', function(){
                setInterval(function() {
                // Preloader
                $(".loader").fadeOut();
                $(".loader-mask").fadeOut("slow")
                },3400);
            });

            </script>  --}}

    </body>
</html>
