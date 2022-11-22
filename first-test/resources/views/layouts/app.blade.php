<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="icon" href="{{ URL::asset('accenture-logo.ico') }}" type="image/x-icon"/>
    <title>By Atiqah</title>

    <script src="https://cdn.tailwindcss.com/?plugins=forms"></script>
</head>
<body>
  
<div class="container">
    @yield('content')
</div>
   
</body>
</html>