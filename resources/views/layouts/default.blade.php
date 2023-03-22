<!DOCTYPE @lang('eng')>
<html>
<title>User Listing - @yield('title')</title>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <style>
        body {
            font-family: 'Lato', sans-serif;
        }
    </style>
</head>
<body class="body">
@include('partials.header')
@include('partials.scripts')
@yield('content')
@include('partials.footer')
</body>
</html>
