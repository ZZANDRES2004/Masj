<!-- resources/views/layouts/blank.blade.php -->
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>MASJ</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet" />

    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>
<body>
    <main class="py-4">
        <div class="container">
            @yield('content')
        </div>
    </main>
</body>
</html>
