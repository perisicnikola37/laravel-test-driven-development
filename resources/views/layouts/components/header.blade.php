<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>

<body class="bg-transparent text-black">
    <header class="flex items-center justify-between px-6 py-4">
        <!-- Logo on the left -->
        <div>
            <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/9/9a/Laravel.svg/1969px-Laravel.svg.png"
                alt="Logo" class="h-10 w-auto">
        </div>
        <!-- Avatar and user name on the right -->
        <div class="flex items-center space-x-4">
            <!-- Avatar -->
            <img src="https://avatars.githubusercontent.com/u/79047182?v=4" alt="Avatar"
                class="h-10 w-10 rounded-full">
            <!-- User name -->
            <span class="text-lg font-semibold">{{ Auth::user()->name }}</span>
        </div>
    </header>
</body>

</html>
