<livewire:trader::layouts.header />
    @livewireStyles
    </head>
    <body>
        <livewire:trader::layouts.navbar />

        @yield('content')

        <livewire:trader::layouts.footer />
        {{-- Laravel Vite - JS File --}}
        {{-- {{ module_vite('build-vendors', 'Resources/assets/js/app.js') }} --}}
        @livewireScripts
    </body>
</html>