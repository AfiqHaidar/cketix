<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>Cketix</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.0.0/flowbite.min.css" rel="stylesheet" />

        <style>
            @import url('https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,600;1,700;1,800;1,900&family=Poppins:ital,wght@0,100;0,200;0,300;1,400&display=swap');
            .transition {
                transition: all 0.3s ease;
                }
        </style>
       
    </head>
    <body class="font-mont antialiased ">
        <div class="min-h-screen bg-[#1A1A1A] relative">
    
            
            @include('layouts.navigation')
            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>
        </div>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.0.0/flowbite.min.js"></script>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
              var nav = document.getElementById('myNav');
        
              window.addEventListener('scroll', function() {
                if (window.scrollY > 0) {
                  nav.classList.add('transition', 'bg-black/30' ,'py-2');
                  nav.classList.remove( 'bg-transparent', 'py-5');
                } else {
                  nav.classList.remove('bg-black/30' ,'py-2');
                  nav.classList.add('transition', 'bg-transparent', 'py-5');
                }
              });
            });
          </script>
    </body>
</html>
