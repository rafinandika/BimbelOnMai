<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Siswa | ONMAI</title>

    <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />

    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,600,700,800" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Roboto+Slab:400,300,700" rel="stylesheet">
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        body { font-family: 'Roboto Slab', serif; }
        .font-heading { font-family: 'Montserrat', sans-serif; }
    </style>
</head>
<body class="bg-gray-50 text-gray-800 antialiased flex flex-col min-h-screen">

    <nav class="bg-gray-900 shadow-xl border-b-4 border-[#ffc800] sticky top-0 z-50">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-20 items-center">
                
                <div class="flex items-center gap-4">
                    <a href="{{ url('/') }}" class="flex items-center gap-3 group">
                        <div class="w-10 h-10 bg-white/10 rounded-full flex items-center justify-center group-hover:bg-[#ffc800] transition duration-300">
                            <i class="fas fa-graduation-cap text-lg text-white group-hover:text-gray-900 transition"></i>
                        </div>
                        <div class="flex flex-col">
                            <span class="text-xl font-bold font-heading tracking-wider text-white group-hover:text-[#ffc800] transition duration-300">
                                TRY<span class="text-[#ffc800] group-hover:text-white transition">OUT</span>
                            </span>
                            <span class="text-[10px] text-gray-400 uppercase tracking-widest font-bold">Student Area</span>
                        </div>
                    </a>
                </div>

                <div class="flex items-center gap-4 md:gap-6">
                    
                    <div class="hidden md:flex items-center gap-3 text-right">
                        <div>
                            <span class="block text-sm font-bold text-gray-200">
                                {{ Auth::user()->name ?? 'Siswa' }}
                            </span>
                            <span class="block text-xs text-[#ffc800] font-bold uppercase">Peserta Ujian</span>
                        </div>
                        <img src="{{ asset('assets/imgs/customer01.jpg') }}" alt="User" class="w-10 h-10 rounded-full border-2 border-gray-600 shadow-sm">
                    </div>

                    <div class="h-8 w-px bg-gray-700 hidden md:block"></div>

                    <a href="{{ route('logout') }}" 
                       onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                       class="group flex items-center gap-2 px-4 py-2 bg-red-600/10 text-red-500 rounded-lg hover:bg-red-600 hover:text-white transition duration-300 border border-red-600/30">
                        <i class="fas fa-power-off text-sm group-hover:scale-110 transition-transform"></i>
                        <span class="hidden sm:inline font-bold text-sm">LOGOUT</span>
                    </a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
                        @csrf
                    </form>
                </div>

            </div>
        </div>
    </nav>

    <main class="flex-grow container mx-auto px-4 sm:px-6 lg:px-8 py-8 animate-[fadeIn_0.5s_ease-out]">
        
        @if(session('error'))
            <div class="mb-6 bg-red-100 border-l-4 border-red-500 text-red-700 p-4 rounded shadow-sm flex items-center justify-between animate-pulse">
                <div class="flex items-center gap-3">
                    <i class="fas fa-exclamation-triangle text-xl"></i>
                    <div>
                        <p class="font-bold">Mohon Maaf</p>
                        <p class="text-sm">{{ session('error') }}</p>
                    </div>
                </div>
                <button onclick="this.parentElement.remove()" class="text-red-700 hover:text-red-900 transition">
                    <i class="fas fa-times"></i>
                </button>
            </div>
        @endif

        @if(session('warning'))
            <div class="mb-6 bg-yellow-100 border-l-4 border-yellow-500 text-yellow-700 p-4 rounded shadow-sm flex items-center gap-3">
                <i class="fas fa-info-circle text-xl"></i>
                <p class="font-bold text-sm">{{ session('warning') }}</p>
            </div>
        @endif

        <div class="mb-6">
            @yield('header')
        </div>

        @yield('content')
    </main>

    <footer class="bg-white border-t border-gray-200 py-6 mt-auto">
        <div class="container mx-auto px-4 text-center">
            <p class="text-sm text-gray-500 font-medium">
                &copy; {{ date('Y') }} <span class="text-[#ffc800] font-bold">ONMAI</span> Learning System. All rights reserved.
            </p>
        </div>
    </footer>

</body>
</html>