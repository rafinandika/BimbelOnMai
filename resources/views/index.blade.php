<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Latihan Mandiri | ONMAI</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,600,700|Roboto+Slab:400,700&display=swap" rel="stylesheet">
    
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        body {
            font-family: 'Roboto Slab', serif; 
            background-color: #f9fafb; /* bg-gray-50 yang bersih */
        }
        
        h1, h2, h3, h4, h5, h6, .font-heading {
            font-family: 'Montserrat', sans-serif;
        }
        
        /* Animasi Transisi Halus */
        .fade-in {
            animation: fadeIn 0.5s ease-in-out;
        }
        
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }
    </style>
</head>
<body class="text-gray-800 flex flex-col min-h-screen antialiased">
    <main class="flex-grow w-full">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 fade-in">
            @yield('content')
        </div>
    </main>

    <footer class="bg-white border-t border-gray-200 mt-auto py-6">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <p class="text-sm text-gray-500 font-heading">
                &copy; {{ date('Y') }} <strong>ONMAI Learning System</strong>. All rights reserved.
            </p>
        </div>
    </footer>

    @include('incindex.scricpt')
    
</body>
</html>