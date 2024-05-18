<livewire:vendors::layouts.header />
    @livewireStyles
    </head>
    <body>
        <livewire:vendors::layouts.navbar />
master here
        @yield('content')

        <livewire:vendors::layouts.footer />
        {{-- Laravel Vite - JS File --}}
        {{-- {{ module_vite('build-vendors', 'Resources/assets/js/app.js') }} --}}
        @livewireScripts
    </body>
</html>
