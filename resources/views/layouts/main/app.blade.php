<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    @vite('resources/css/app.css')
    <link rel="icon"
        href="https://upload.wikimedia.org/wikipedia/commons/thumb/9/9a/Laravel.svg/1200px-Laravel.svg.png"
        type="image/x-icon">
</head>

<body>
    <div>
        <h1 class="text-3xl font-bold underline">
            @yield('content')
        </h1>
    </div>
</body>

</html>
