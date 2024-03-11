<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    @vite('resources/css/app.css')
</head>

<body>
    <div>
        <h1 class="text-3xl font-bold underline">
            @yield('content')
        </h1>
    </div>
</body>

</html>
