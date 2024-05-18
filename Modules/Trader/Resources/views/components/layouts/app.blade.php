<livewire:trader::layouts.header />

    </head>
    <body class="home">
        <!-- Preloader -->
        
        {{--  @if(isset($_SESSION['subscribe-show']) && $_SESSION['subscribe-show'] == true)

        @yield('reloadlogo')
        @endif  --}}
       
        <!-- Preloader -->
        <div class="page-wrapper">
        <livewire:trader::layouts.navbar />

        @yield('content')

        <livewire:trader::layouts.footer />
        </div>
        <livewire:trader::layouts.footer-menu />
        {{-- Laravel Vite - JS File --}}
        {{-- {{ module_vite('build-vendors', 'Resources/assets/js/app.js') }} --}}
        {{--  @if(isset($_SESSION['subscribe-show']) && $_SESSION['subscribe-show'] == true)
        <script>
            

            $(window).on('load', function(){
                setInterval(function() {
                // Preloader
                $(".loader").fadeOut();
                $(".loader-mask").fadeOut("slow")
                },400);
            });
          
            
            </script>
            @endif  --}}
          
          
       

    </body>
</html>
