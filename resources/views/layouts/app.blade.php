<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Fono Bri')</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Fredoka+One&family=Nunito:wght@400;600;700&family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
    <style>
        :root {
            --sky-100: #E0F4FF;
            --sky-300: #7DCCF5;
            --sky-500: #29ABE2;
            --sky-700: #1A7FAD;
            --accent-yellow:   #FFD93D;
            --accent-coral:    #FF6B6B;
            --accent-green:    #6BCB77;
            --accent-lavender: #A78BFA;
            --accent-orange:   #FF9F43;
            --white:    #FFFFFF;
            --gray-50:  #F8FAFC;
            --gray-100: #F1F5F9;
            --gray-200: #E2E8F0;
            --gray-500: #64748B;
            --gray-700: #334155;
            --gray-800: #1E293B;
            --font-title: 'Fredoka One', cursive;
            --font-body:  'Nunito', sans-serif;
            --font-ui:    'Poppins', sans-serif;
        }
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
        body { font-family: var(--font-body); color: var(--gray-800); background: var(--gray-50); }
    </style>
    @yield('styles')
</head>
<body>
    @yield('content')
    @yield('scripts')
</body>
</html>
