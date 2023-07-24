<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" style="height: 100%;">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>@yield('title')</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
    
    <!-- Styles -->
    <link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="https://unpkg.com/multiple-select@1.6.0/dist/multiple-select.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">

    <link rel="stylesheet" href="{{ URL::asset('css/tag.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('css/task.css') }}">

    {{-- JS --}}
    <script src="https://code.jquery.com/jquery-3.6.1.min.js"></script>
    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
    <script src="https://unpkg.com/multiple-select@1.6.0/dist/multiple-select.min.js"></script>

    <script src="{{ URL::asset('js/tag.js') }}"></script>
    <script src="{{ URL::asset('js/task.js') }}"></script>
    <script src="{{ URL::asset('js/getDataForSearch.js') }}"></script>
    <script src="{{ URL::asset('js/taskList.js') }}"></script>
</head>

<body style="height: 100%;">
    
    
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @yield('content')
</body>

</html>