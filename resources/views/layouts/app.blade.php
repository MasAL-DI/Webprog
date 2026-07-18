<!DOCTYPE html>
<<html lang="id" data-theme="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Presensi RFID')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js', 'resources/js/echo.js'])
    @livewireStyles
</head>
<body class="bg-gradient-to-br from-slate-100 via-blue-50 to-slate-100 min-h-screen">
    <main class="max-w-5xl mx-auto p-6">
        @yield('content')
    </main>
    @livewireScripts
</body>
</html>
