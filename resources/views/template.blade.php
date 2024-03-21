<!DOCTYPE html>
<html lang="en" data-bs-theme="dark">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite(['resources/sass/app.scss', 'resources/js/app.js','resources/sass/main.css'])
    <link rel="stylesheet" href="https://kit.fontawesome.com/d76d9d2ca0.css" crossorigin="anonymous">
    <title>@yield('title')</title>
</head>

<body class="bg-gray-900 max-h-screen">

    @yield('body')

    <script src="https://kit.fontawesome.com/d76d9d2ca0.js" crossorigin="anonymous"></script>
</body>

</html>
