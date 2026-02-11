<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="{{ asset('css/index.css') }}">

    <title>Trek Guide</title>
     @vite(['resources/css/app.css', 'resources/js/app.js'])

</head>
<body>

   

    <x-navbar />
   
    <x-herosection />
    <x-mapsection />
    <x-footer/>
   
   


</body>
</html>
