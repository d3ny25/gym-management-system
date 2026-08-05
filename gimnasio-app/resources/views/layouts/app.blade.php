<!doctype html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Gimnasio - @yield('title', 'Panel')</title>
    @if(app()->environment('production'))
        <link rel="stylesheet" href="{{ asset('build/assets/app-C0uu6LLs.css') }}">
        <script type="module" src="{{ asset('build/assets/app-BvRk9kiK.js') }}"></script>
    @else
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @endif
</head>
<body class="bg-[#F8FAFC] text-[#1F2937] min-h-screen md:flex">
    @include('components.sidebar')
    <div class="flex-1 flex flex-col min-h-screen">
        @include('components.navbar')

        <main class="p-6 md:p-8 lg:p-10">
            @yield('content')
        </main>

        @include('components.footer')
    </div>

    <div id="sidebar-overlay" class="fixed inset-0 bg-black/50 z-20 hidden md:hidden"></div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const toggle = document.getElementById('menu-toggle');
            const sidebar = document.getElementById('sidebar');
            const overlay = document.getElementById('sidebar-overlay');

            if (!toggle || !sidebar || !overlay) return;

            toggle.addEventListener('click', function () {
                const isOpen = sidebar.classList.contains('translate-x-0');
                sidebar.classList.toggle('-translate-x-full', isOpen);
                sidebar.classList.toggle('translate-x-0', !isOpen);
                overlay.classList.toggle('hidden', isOpen);
            });

            overlay.addEventListener('click', function () {
                sidebar.classList.add('-translate-x-full');
                sidebar.classList.remove('translate-x-0');
                overlay.classList.add('hidden');
            });
        });
    </script>
</body>
</html>
