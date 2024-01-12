<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    @vite(['resources/sass/app.scss', 'resources/js/app.js'])

    <title>Test App</title>
</head>
<body>
<div class="wrapper">
    @yield('content')
</div>

{{--scripts--}}
<script src="{{ asset('assets/js/app.js') }}"></script>
@stack('child-scripts')
</body>
</html>
