<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="{{ asset('css/index.css') }}">

    <title>Trek Guide</title>
     @vite(['resources/css/app.css', 'resources/js/app.js'])

</head>
<body>

   

    <x-navbar />
    @yield('content')
    
    <x-footer/>
   
   


</body>
</html>
