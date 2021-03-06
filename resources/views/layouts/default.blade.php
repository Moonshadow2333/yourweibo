<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title','Yourweibo App') - laravel新手入门教程</title>
    <link rel="stylesheet" type="text/css" href="/css/app.css">
    <link rel="stylesheet" type="text/css" href="/css/mycss.css">
</head>
<body>
    @include('layouts._header')
    <div class="container">
        @include('shared._messages')
        @yield('content')
        @include('layouts._footer')
    </div>
    <script src="{{ mix('js/app.js') }}"></script>
</body>
</html>
