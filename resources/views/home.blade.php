<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="Pusat Bimbingan Belajar ONMAI" />
    <meta name="author" content="ONMAI" />
    <title>@yield('title', 'ONMAI - Pusat Bimbingan Belajar')</title>
    
    <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
    
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,600,700,800" rel="stylesheet" type="text/css" />
    <link href="https://fonts.googleapis.com/css?family=Roboto+Slab:400,100,300,700" rel="stylesheet" type="text/css" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <style>
        body { font-family: 'Roboto Slab', serif; }
        h1, h2, h3, h4, h5, h6, .font-heading { font-family: 'Montserrat', sans-serif; }
        
        /* Utilitas Warna Brand */
        .bg-brand { background-color: #ffc800; }
        .text-brand { color: #ffc800; }
        .text-brands { color: white; }
        .border-brand { border-color: #ffc800; }
        .hover-bg-brand:hover { background-color: #d9aa00; }
        
        /* Animasi Hamburger Menu (Garis Tiga ke X) */
        .hamburger span {
            display: block;
            width: 25px;
            height: 3px;
            background-color: white;
            margin-bottom: 5px;
            position: relative;
            border-radius: 3px;
            transition: transform 0.4s cubic-bezier(0.68, -0.55, 0.265, 1.55),
                        opacity 0.4s ease;
        }
        .hamburger.active span:nth-child(1) { transform: translateY(8px) rotate(45deg); }
        .hamburger.active span:nth-child(2) { opacity: 0; }
        .hamburger.active span:nth-child(3) { transform: translateY(-8px) rotate(-45deg); }

        /* Animasi Dropdown Desktop */
        .dropdown-menu {
            opacity: 0;
            visibility: hidden;
            transform: translateY(10px);
            transition: all 0.3s ease-in-out;
        }
        .group:hover .dropdown-menu {
            opacity: 1;
            visibility: visible;
            transform: translateY(0);
        }

        /* Animasi Menu Mobile */
        #mobile-menu {
            max-height: 0;
            opacity: 0;
            overflow: hidden;
            transition: max-height 0.4s ease-in-out, opacity 0.4s ease-in-out;
        }
        #mobile-menu.open {
            max-height: 500px; /* Nilai cukup besar untuk menampung menu */
            opacity: 1;
        }
    </style>
</head>
<body id="page-top" class="bg-gray-50 text-gray-700 antialiased selection:bg-[#ffc800] selection:text-black">

    <nav class="fixed w-full z-50 top-0 transition-all duration-300 bg-gray-900 shadow-xl" id="mainNav">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-20">
                <a class="flex items-center gap-3 text-xl font-bold font-heading tracking-wider text-white group" href="#page-top">
                    <img src="{{ asset('landing-page/assets/img/img1.png') }}" class="h-10 w-auto transition-transform duration-300 group-hover:scale-110" alt="Logo" />
                    <span class="text-brands">ONMAI</span>
                </a>
    
                <div class="hidden lg:flex items-center space-x-8 uppercase text-[0.85rem] font-bold tracking-wide text-gray-300 font-heading">
                    <a class="relative group py-2 hover:text-[#ffc800] transition duration-300" href="#services">
                        Fasilitas
                        <span class="absolute bottom-0 left-0 w-0 h-0.5 bg-[#ffc800] transition-all duration-300 group-hover:w-full"></span>
                    </a>
                    
                    <a class="relative group py-2 hover:text-[#ffc800] transition duration-300" href="#portfolio">
                        Program Belajar
                        <span class="absolute bottom-0 left-0 w-0 h-0.5 bg-[#ffc800] transition-all duration-300 group-hover:w-full"></span>
                    </a>
                    
                    <a class="relative group py-2 hover:text-[#ffc800] transition duration-300" href="#about">
                        Tentang
                        <span class="absolute bottom-0 left-0 w-0 h-0.5 bg-[#ffc800] transition-all duration-300 group-hover:w-full"></span>
                    </a>
                    
                    <div class="relative group h-full flex items-center">
                        <button class="relative flex items-center hover:text-[#ffc800] transition focus:outline-none py-6">
                            Lainnya 
                            <i class="fas fa-caret-down ml-1 text-xs transition-transform duration-300 group-hover:rotate-180"></i>
                            <span class="absolute bottom-4 left-0 w-0 h-0.5 bg-[#ffc800] transition-all duration-300 group-hover:w-full"></span>
                        </button>
                        
                        <div class="dropdown-menu absolute right-0 top-16 w-64 bg-white rounded-lg shadow-2xl py-2 border-t-4 text-gray-800 normal-case origin-top-right z-50">
                            
                            <a href="#team" class="relative group flex items-center px-4 py-3 hover:bg-gray-100  transition-all duration-300">
                                <span class="w-1 h-0 absolute left-0 top-0 transition-all duration-300 group-hover:h-full"></span> 
                                <span class="group-hover:translate-x-2 transition-transform duration-300 font-medium">Sukses Bersama Onmai</span>
                            </a>
                    
                            <a href="#contact" class="relative group flex items-center px-4 py-3 hover:bg-gray-100  transition-all duration-300">
                                <span class="w-1 h-0  absolute left-0 top-0 transition-all duration-300 group-hover:h-full"></span>
                                <span class="group-hover:translate-x-2 transition-transform duration-300 font-medium">Contact</span>
                            </a>
                    
                            <a href="{{ route('index.soal')}}" class="relative group flex items-center px-4 py-3 hover:bg-gray-100 transition-all duration-300">
                                <span class="w-1 h-0 absolute left-0 top-0 transition-all duration-300 group-hover:h-full"></span>
                                <span class="group-hover:translate-x-2 transition-transform duration-300 font-medium">Soal-soal</span>
                            </a>
                    
                            <div class="border-t border-gray-100 my-1"></div>
                    
                            <a href="https://wa.me/6285273168989" target="_blank" class="relative group flex items-center px-4 py-3 hover:bg-green-50 transition-all duration-300 text-green-600 font-bold">
                                <i class="fab fa-whatsapp mr-2 text-xl group-hover:scale-125 transition-transform duration-300"></i>
                                <span class="group-hover:translate-x-1 transition-transform duration-300">Hubungi Kami</span>
                            </a>
                        </div>
                    </div>
    
                    @auth
                        <a href="{{ route('dashboard') }}" class="group relative inline-flex items-center gap-2 px-8 py-3 bg-[#ffc800] text-white font-bold rounded-full overflow-hidden shadow-lg transition-all duration-300 hover:scale-105 hover:shadow-[0_0_20px_rgba(255,200,0,0.5)] active:scale-95">
                            <div class="absolute inset-0 w-full h-full bg-gradient-to-r from-transparent via-white/40 to-transparent -translate-x-[150%] skew-x-12 transition-transform duration-1000 group-hover:translate-x-[150%] ease-in-out"></div>
                            <i class="fas fa-tachometer-alt text-lg transition-transform duration-300 group-hover:translate-x-1 relative z-10" aria-hidden="true"></i>
                            <span class="relative z-10 tracking-wide">DASHBOARD</span>
                        </a>
                    @else
                        <a href="{{ route('login') }}" class="group relative inline-flex items-center gap-2 px-8 py-3 bg-[#ffc800] text-white font-bold rounded-full overflow-hidden shadow-lg transition-all duration-300 hover:scale-105 hover:shadow-[0_0_20px_rgba(255,200,0,0.5)] active:scale-95">
                            <div class="absolute inset-0 w-full h-full bg-gradient-to-r from-transparent via-white/40 to-transparent -translate-x-[150%] skew-x-12 transition-transform duration-1000 group-hover:translate-x-[150%] ease-in-out"></div>
                            <i class="fa fa-sign-in text-lg transition-transform duration-300 group-hover:translate-x-1 relative z-10" aria-hidden="true"></i>
                            <span class="relative z-10 tracking-wide">LOGIN</span>
                        </a>
                    @endauth
    
                </div>
    
                <div class="lg:hidden flex items-center">
                    <button id="mobile-menu-btn" class="hamburger focus:outline-none p-2">
                        <span></span>
                        <span></span>
                        <span></span>
                    </button>
                </div>
            </div>
        </div>
    
        <div id="mobile-menu" class="lg:hidden bg-gray-900 border-t border-gray-800 absolute w-full left-0 shadow-xl z-40">
            <ul class="px-6 py-6 space-y-4 font-bold text-white uppercase text-sm font-heading tracking-wide">
                <li><a class="block hover:text-brand transition-colors hover:translate-x-2 duration-200" href="#services">Fasilitas</a></li>
                <li><a class="block hover:text-brand transition-colors hover:translate-x-2 duration-200" href="#portfolio">Program Belajar</a></li>
                <li><a class="block hover:text-brand transition-colors hover:translate-x-2 duration-200" href="#about">About</a></li>
                <li><a class="block hover:text-brand transition-colors hover:translate-x-2 duration-200" href="#team">Sukses Bersama</a></li>
                <li class="border-t border-gray-700 pt-2 text-xs text-gray-400">Lainnya</li>
                <li><a class="block hover:text-brand transition-colors hover:translate-x-2 duration-200" href="{{ route('index.soal')}}">Soal-soal</a></li>
                <li><a class="block text-brand hover:translate-x-2 duration-200" href="https://wa.me/6285273168989"><i class="fab fa-whatsapp mr-1"></i> Hubungi Kami</a></li>
                <li class="pt-4">
                    @auth
                        <a class="block w-full text-center py-3 bg-brand text-white rounded-lg hover-bg-brand shadow-lg" href="{{ route('dashboard') }}">Dashboard</a>
                    @else
                        <a class="block w-full text-center py-3 bg-brand text-white rounded-lg hover-bg-brand shadow-lg" href="{{ route('login') }}">Login</a>
                    @endauth
                </li>
            </ul>
        </div>
    </nav>

    <header class="relative h-screen min-h-[600px] flex items-center justify-center bg-gray-900 overflow-hidden">
        <div class="absolute inset-0 z-0">
            <img src="/landing-page/assets/img/img8.png" alt="" class="w-full h-full object-cover opacity-50 blur-[1px]" fetchpriority="high"/>
            <div class="absolute inset-0 bg-gradient-to-t from-gray-900 via-gray-900/60 to-gray-900/30"></div>
        </div>

        <div class="relative container mx-auto px-4 text-center text-white z-10 pt-16">
        <div class="inline-block px-4 py-1 mb-6 border border-brand/50 rounded-full bg-brand/10 backdrop-blur-sm">
                <span class="text-brand font-bold uppercase text-xs sm:text-sm tracking-widest">Pusat Bimbingan Belajar</span>
            </div>
            <h1 class="text-5xl md:text-7xl lg:text-8xl font-extrabold uppercase tracking-tight mb-6 font-heading text-white drop-shadow-2xl">
                ON<span class="text-brands">MAI</span>
            </h1>
            <p class="text-xl md:text-2xl font-light tracking-widest mb-10 text-gray-300">SARAN UNTUK BERPRESTASI</p>
            
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <a class="px-8 py-4 bg-brand text-white font-bold text-lg uppercase rounded-lg shadow-lg shadow-brand/40 hover-bg-brand transform hover:-translate-y-1 transition duration-300 font-heading tracking-wider" href="#services">
                    Fasilitas Kami
                </a>
                <a class="px-8 py-4 bg-transparent border-2 border-white text-white font-bold text-lg uppercase rounded-lg hover:bg-white hover:text-gray-900 transform hover:-translate-y-1 transition duration-300 font-heading tracking-wider" href="#portfolio">
                    Program Belajar
                </a>
            </div>
        </div>
    </header>

    <section class="py-24 bg-white" id="services">
        <div class="container mx-auto px-4">
            <div class="text-center mb-16 max-w-3xl mx-auto">
                <h2 class="text-4xl font-extrabold uppercase mb-4 text-gray-800 font-heading">Fasilitas <span class="text-brand">Premium</span></h2>
                <p class="text-lg text-gray-500 font-light leading-relaxed">
                    Di ONMAI, kami menciptakan suasana bimbel yang <span class="text-brand font-bold">cozy</span> dan nyaman, agar belajar tidak lagi membosankan.
                </p>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="group relative bg-white rounded-2xl p-8 shadow-lg hover:shadow-2xl transition-all duration-300 border border-gray-100 hover:border-brand/30">
                    <div class="absolute top-0 right-0 w-24 h-24 bg-brand/10 rounded-bl-full rounded-tr-2xl transition-all duration-300 group-hover:bg-brand/20"></div>
                    
                    <div class="relative z-10 flex justify-center mb-6">
                        <div class="w-50 h-50 rounded-xl bg-gray-50 flex items-center justify-center border-4 border-white shadow-md group-hover:scale-105 transition duration-300 overflow-hidden">
                             <img src="{{ asset('landing-page/assets/img/img3.png') }}" class="w-full h-full object-cover" alt="Ruang Belajar">
                        </div>
                    </div>
                    <div class="text-center relative z-10">
                        <h4 class="text-2xl font-bold mb-3 font-heading text-gray-800 group-hover:text-brand transition">Ruang Belajar</h4>
                        <p class="text-gray-600 leading-relaxed">Full AC, Free WiFi kecepatan tinggi, dan Full Furnished untuk kenyamanan maksimal.</p>
                    </div>
                </div>
    
                <div class="group relative bg-white rounded-2xl p-8 shadow-lg hover:shadow-2xl transition-all duration-300 border border-gray-100 hover:border-brand/30"> 
                    <div class="absolute top-0 right-0 w-24 h-24 bg-brand/10 rounded-bl-full rounded-tr-2xl transition-all duration-300 group-hover:bg-brand/20"></div>
                    
                    <div class="relative z-10 flex justify-center mb-6">
                        <div class="w-50 h-50 rounded-xl bg-gray-50 flex items-center justify-center border-4 border-white shadow-md group-hover:scale-105 transition duration-300 overflow-hidden">
                             <img src="{{ asset('landing-page/assets/img/img4.png') }}" class="w-full h-full object-cover" alt="Persiapan Ujian">
                        </div>
                    </div>
                    <div class="text-center relative z-10">
                        <h4 class="text-2xl font-bold mb-3 font-heading text-gray-800 group-hover:text-brand transition">Persiapan Ujian</h4>
                        <p class="text-gray-600 leading-relaxed">Program intensif TKA, UTBK, UTS, UAS, hingga Ulangan Harian.</p>
                    </div>
                </div>
    
                <div class="group relative bg-white rounded-2xl p-8 shadow-lg hover:shadow-2xl transition-all duration-300 border border-gray-100 hover:border-brand/30">
                    <div class="absolute top-0 right-0 w-24 h-24 bg-brand/10 rounded-bl-full rounded-tr-2xl transition-all duration-300 group-hover:bg-brand/20"></div>
                    
                    <div class="relative z-10 flex justify-center mb-6">
                        <div class="w-50 h-50 rounded-xl bg-gray-50 flex items-center justify-center border-4 border-white shadow-md group-hover:scale-105 transition duration-300 overflow-hidden">
                             <img src="{{ asset('landing-page/assets/img/img5.png') }}" class="w-full h-full object-cover" alt="Ruang Depan">
                        </div>
                    </div>
                    <div class="text-center relative z-10">
                        <h4 class="text-2xl font-bold mb-3 font-heading text-gray-800 group-hover:text-brand transition">Ruang Depan</h4>
                        <p class="text-gray-600 leading-relaxed">Lobby tunggu yang nyaman dengan sofa empuk dan area kantin mini.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="py-24 bg-gray-50 relative" id="portfolio">
        <div class="absolute top-0 left-0 w-full h-full overflow-hidden pointer-events-none opacity-5">
             <i class="fas fa-book absolute -top-10 -left-10 text-9xl"></i>
             <i class="fas fa-graduation-cap absolute bottom-10 right-10 text-9xl"></i>
        </div>

        <div class="container mx-auto px-4 relative z-10">
            <div class="text-center mb-16">
                <h2 class="text-4xl font-extrabold uppercase mb-4 text-gray-800 font-heading">Program Belajar</h2>
                <h3 class="text-lg text-gray-500 font-serif italic">Pilihan paket bimbingan berkualitas sesuai jenjang pendidikan</h3>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <div class="bg-white rounded-xl shadow-md hover:shadow-2xl transition-all duration-300 overflow-hidden flex flex-col group border-t-4 border-brand">
                    <div class="relative h-56 bg-gray-200 overflow-hidden h-full relative">
                        <img class="w-full h-full object-cover transform group-hover:scale-110 transition duration-500" src="{{ asset ('landing-page/assets/img/portfolio/1.png') }}" alt="SD" />
                        <div class="absolute top-0 right-0 bg-brand text-white text-sm font-bold px-4 py-2 rounded-bl-xl shadow-md">
                            KELAS 1-6
                        </div>
                    </div>
                    <div class="p-6 flex-grow flex flex-col">
                        <h4 class="text-2xl font-bold mb-4 font-heading text-center text-gray-800">Sekolah Dasar (SD)</h4>
                        
                        <div class="space-y-3 text-sm text-gray-600 flex-grow">
                            <div class="flex items-center"><i class="fas fa-check-circle text-brand mr-3"></i> Matematika & IPA</div>
                            <div class="flex items-center"><i class="fas fa-check-circle text-brand mr-3"></i> B. Inggris & B. Indonesia</div>
                            <div class="flex items-center"><i class="fas fa-check-circle text-brand mr-3"></i> PR Tuntas</div>
                            <div class="flex items-center font-bold text-gray-800 bg-brand/10 p-2 rounded"><i class="fas fa-gift text-brand mr-3"></i> Tambahan Belajar Gratis</div>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-xl shadow-md hover:shadow-2xl transition-all duration-300 overflow-hidden flex flex-col group border-t-4 border-brand">
                    <div class="relative h-56 bg-gray-200 overflow-hidden h-full relative">
                        <img class="w-full h-full object-cover transform group-hover:scale-110 transition duration-500" src="{{ asset ('landing-page/assets/img/portfolio/2.png') }}" alt="SMP" />
                        <div class="absolute top-0 right-0 bg-brand text-white text-sm font-bold px-4 py-2 rounded-bl-xl shadow-md">
                            KELAS 7-9
                        </div>
                    </div>
                    <div class="p-6 flex-grow flex flex-col">
                        <h4 class="text-2xl font-bold mb-4 font-heading text-center text-gray-800">Sekolah Menengah (SMP)</h4>
                        
                        <div class="space-y-3 text-sm text-gray-600 flex-grow">
                            <div class="flex items-center"><i class="fas fa-check-circle text-brand mr-3"></i> MTK, Fisika, Biologi</div>
                            <div class="flex items-center"><i class="fas fa-check-circle text-brand mr-3"></i> B. Inggris, B. Indo, IPS</div>
                            <div class="flex items-center"><i class="fas fa-check-circle text-brand mr-3"></i> PR Tuntas & Tambahan Gratis</div>
                            <div class="flex items-center font-bold text-gray-800 bg-brand/10 p-2 rounded"><i class="fas fa-star text-brand mr-3"></i> Kelas 9: Persiapan TKA</div>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-xl shadow-md hover:shadow-2xl transition-all duration-300 overflow-hidden flex flex-col group border-t-4 border-brand">
                    <div class="relative h-56 bg-gray-200 overflow-hidden h-full relative">
                        <img class="w-full h-full object-cover object-top transform group-hover:scale-105 transition duration-700 ease-in-out" src="{{ asset ('landing-page/assets/img/portfolio/3.png') }}" alt="SMA" />
                        <div class="absolute top-0 right-0 bg-brand text-white text-sm font-bold px-4 py-2 rounded-bl-xl shadow-md">
                            KELAS 10-11
                        </div>
                    </div>
                    <div class="p-6 flex-grow flex flex-col">
                        <h4 class="text-2xl font-bold mb-4 font-heading text-center text-gray-800">SMA Reguler</h4>
                        
                        <div class="space-y-3 text-sm text-gray-600 flex-grow">
                            <div class="flex items-center"><i class="fas fa-check-circle text-brand mr-3"></i> MTK, Fisika, Bio, Ekonomi</div>
                            <div class="flex items-center"><i class="fas fa-check-circle text-brand mr-3"></i> B. Inggris, B. Indo, IPS</div>
                            <div class="flex items-center"><i class="fas fa-check-circle text-brand mr-3"></i> PR Tuntas & Tambahan Gratis</div>
                            <div class="flex items-center font-bold text-gray-800 bg-brand/10 p-2 rounded"><i class="fas fa-comments text-brand mr-3"></i> Konsultasi Orang Tua</div>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-xl shadow-md hover:shadow-2xl transition-all duration-300 overflow-hidden flex flex-col group border-t-4 border-brand lg:col-span-3 lg:w-2/3 lg:mx-auto">
                    <div class="flex flex-col md:flex-row h-full relative">
                        <div class="md:w-1/2 relative h-56 md:h-auto bg-gray-200 overflow-hidden">
                             <img class="w-full h-full object-cover transform group-hover:scale-110 transition duration-500" src="{{ asset ('landing-page/assets/img/portfolio/4.png') }}" alt="SMA 12" />
                        </div>
                        <div class="p-8 md:w-1/2 flex flex-col justify-center relative"> <div class="absolute top-0 left-0 bg-brand text-white text-sm font-bold px-4 py-2 rounded-br-xl shadow-md">
                            KELAS 12 PEJUANG PTN
                        </div>
                    
                        <h4 class="text-2xl font-bold mb-2 font-heading text-gray-800">Program Akhir SMA & Alumni</h4>
                        <p class="text-gray-500 mb-4 text-sm">Fokus total menembus PTN impian.</p>
                        
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 text-sm text-gray-600 mb-4">
                            <div>
                                <h6 class="font-bold text-brand mb-1">Mata Pelajaran:</h6>
                                <ul class="space-y-1">
                                    <li><i class="fas fa-check text-xs mr-1 text-gray-400"></i> MTK, Fisika, Biologi</li>
                                    <li><i class="fas fa-check text-xs mr-1 text-gray-400"></i> Ekonomi, B.Inggris, B.Indo</li>
                                </ul>
                            </div>
                            <div>
                                <h6 class="font-bold text-brand mb-1">Persiapan UTBK:</h6>
                                <ul class="space-y-1">
                                    <li><i class="fas fa-check text-xs mr-1 text-gray-400"></i> TPS & Literasi</li>
                                    <li><i class="fas fa-check text-xs mr-1 text-gray-400"></i> Penalaran Matematika</li>
                                </ul>
                            </div>
                        </div>
                        
                        <div class="bg-gray-100 p-3 rounded-lg border-l-4 border-brand">
                            <span class="font-bold text-gray-800 text-sm block mb-1">Program Khusus Tersedia:</span>
                            <div class="flex flex-wrap gap-2">
                                <span class="px-2 py-1 bg-white rounded text-xs border shadow-sm">KEDINASAN</span>
                                <span class="px-2 py-1 bg-white rounded text-xs border shadow-sm">KEDOKTERAN (Intensif)</span>
                            </div>
                        </div>
                    </div>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <section class="py-24 bg-white overflow-hidden" id="about">
        <div class="container mx-auto px-4">
            <div class="text-center mb-20">
                <h2 class="text-4xl font-extrabold uppercase mb-4 text-gray-800 font-heading">Suasana Belajar</h2>
                <h3 class="text-lg text-gray-500 font-serif italic">Belajar serius tapi santai, itulah kunci kami.</h3>
            </div>

            <div class="relative space-y-24 mt-16">
                <div class="hidden md:block absolute left-1/2 transform -translate-x-1/2 h-full w-1 bg-gray-100 z-0"></div>
            
                <div class="relative z-10 flex flex-col md:flex-row items-center gap-12">
                    <div class="md:w-1/2 flex justify-center md:justify-end pr-0 md:pr-12">
                        <div class="relative w-64 h-64 md:w-72 md:h-72 rounded-full border-8 border-white shadow-2xl overflow-hidden group z-10">
                            <img class="w-full h-full object-cover transform group-hover:scale-110 transition duration-700" src="{{ asset('landing-page/assets/img/about/3.png') }}" alt="Semangat" />
                            <div class="absolute inset-0 bg-brand/20 opacity-0 group-hover:opacity-100 transition duration-300"></div>
                        </div>
                    </div>
                    
                    <div class="md:w-1/2 text-center md:text-left pl-0 md:pl-12">
                        <div class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-brand/10 mb-4 text-brand shadow-sm">
                            <i class="fas fa-music text-2xl"></i>
                        </div>
                        <h4 class="text-3xl font-bold font-heading mb-4 text-gray-800">Semangat & Ceria</h4>
                        <p class="text-gray-600 text-lg leading-relaxed max-w-md mx-auto md:mx-0">
                            Belajar sambil seru-seruan menyanyikan yel-yel. Kelas penuh dengan semangat untuk membangkitkan mood belajar sebelum materi dimulai.
                        </p>
                    </div>
                </div>
            
                <div class="relative z-10 flex flex-col md:flex-row-reverse items-center gap-12">
                    <div class="md:w-1/2 flex justify-center md:justify-start pl-0 md:pl-12">
                        <div class="relative w-64 h-64 md:w-72 md:h-72 rounded-full border-8 border-white shadow-2xl overflow-hidden group z-10">
                            <img class="w-full h-full object-cover transform group-hover:scale-110 transition duration-700" src="{{ asset('landing-page/assets/img/about/4.png') }}" alt="Nyaman" />
                            <div class="absolute inset-0 bg-brand/20 opacity-0 group-hover:opacity-100 transition duration-300"></div>
                        </div>
                    </div>
                    
                    <div class="md:w-1/2 text-center md:text-right pr-0 md:pr-12"> <div class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-brand/10 mb-4 text-brand shadow-sm">
                            <i class="fas fa-couch text-2xl"></i>
                        </div>
                        <h4 class="text-3xl font-bold font-heading mb-4 text-gray-800">Tenang & Nyaman</h4>
                        <p class="text-gray-600 text-lg leading-relaxed max-w-md mx-auto md:ml-auto md:mr-0">
                            Saat fokus dibutuhkan, kelas menjadi tempat yang tenang. Fasilitas yang nyaman mendukung konsentrasi penuh siswa.
                        </p>
                    </div>
                </div>
            
                <div class="relative z-10 flex flex-col md:flex-row items-center gap-12">
                    <div class="md:w-1/2 flex justify-center md:justify-end pr-0 md:pr-12">
                        <div class="relative w-64 h-64 md:w-72 md:h-72 rounded-full border-8 border-white shadow-2xl overflow-hidden group z-10">
                            <img class="w-full h-full object-cover transform group-hover:scale-110 transition duration-700" src="{{ asset('landing-page/assets/img/about/1.png') }}" alt="Interaktif" />
                            <div class="absolute inset-0 bg-brand/20 opacity-0 group-hover:opacity-100 transition duration-300"></div>
                        </div>
                    </div>
                    
                    <div class="md:w-1/2 text-center md:text-left pl-0 md:pl-12">
                        <div class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-brand/10 mb-4 text-brand shadow-sm">
                            <i class="fas fa-users text-2xl"></i>
                        </div>
                        <h4 class="text-3xl font-bold font-heading mb-4 text-gray-800">Ramai & Interaktif</h4>
                        <p class="text-gray-600 text-lg leading-relaxed max-w-md mx-auto md:mx-0">
                            Kelas yang ramai diskusi dan seru. Ilmu bertambah, tawa pun ikut mengalir, menghilangkan rasa bosan dan kantuk.
                        </p>
                    </div>
                </div>
            
                <div class="relative z-10 flex justify-center pt-8 pb-10">
                    <div class="relative group cursor-pointer">
                        <div class="absolute inset-0 bg-brand rounded-full opacity-75 animate-ping"></div>
                        
                        <div class="relative w-48 h-48 bg-brand rounded-full border-8 border-white shadow-2xl flex items-center justify-center text-center p-4 transform transition duration-300 group-hover:scale-105 group-hover:rotate-3">
                            <h4 class="text-white font-extrabold font-heading text-xl leading-tight uppercase drop-shadow-md">
                                Be Part<br>Of Our<br>Story!
                            </h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="py-24 bg-gray-50" id="team">
        <div class="container mx-auto px-4">
            <div class="text-center mb-16">
                <h2 class="text-4xl font-extrabold uppercase mb-4 text-gray-800 font-heading">Sukses Bersama ONMAI</h2>
                <h3 class="text-lg text-gray-500 font-serif italic">Bukti nyata keberhasilan siswa kami</h3>
            </div>
            
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-10 max-w-6xl mx-auto">
                
                <div class="bg-white p-6 rounded-2xl shadow-lg text-center group hover:-translate-y-2 transition duration-300">
                    <div class="w-40 h-40 mx-auto mb-6 rounded-full border-4 border-gray-100 p-1 group-hover:border-brand transition duration-300">
                        <img class="w-full h-full rounded-full object-cover" src="{{ asset('landing-page/assets/img/team/1.png') }}" alt="" />
                    </div>
                    <h4 class="text-2xl font-bold text-gray-800 mb-1 font-heading">MAYANG</h4>
                    <p class="text-gray-400 text-xs uppercase tracking-wide mb-4">SMAN 05 Kota Bengkulu</p>
                    <div class="bg-brand text-white text-xs font-bold px-4 py-2 rounded-full inline-block shadow-md">
                        LULUS HUKUM UNIB
                    </div>
                </div>

                <div class="bg-white p-6 rounded-2xl shadow-lg text-center group hover:-translate-y-2 transition duration-300">
                    <div class="w-40 h-40 mx-auto mb-6 rounded-full border-4 border-gray-100 p-1 group-hover:border-brand transition duration-300">
                         <img class="w-full h-full rounded-full object-cover" src="{{ asset('landing-page/assets/img/team/2.png') }}" alt="" />
                    </div>
                    <h4 class="text-2xl font-bold text-gray-800 mb-1 font-heading">MASYAH</h4>
                    <p class="text-gray-400 text-xs uppercase tracking-wide mb-4">SMAN 05 Kota Bengkulu</p>
                    <div class="bg-brand text-white text-xs font-bold px-4 py-2 rounded-full inline-block shadow-md">
                        LULUS MANAJEMEN UNIB
                    </div>
                </div>

                 <div class="bg-white p-6 rounded-2xl shadow-lg text-center group hover:-translate-y-2 transition duration-300">
                    <div class="w-40 h-40 mx-auto mb-6 rounded-full border-4 border-gray-100 p-1 group-hover:border-brand transition duration-300">
                         <img class="w-full h-full rounded-full object-cover" src="{{ asset('landing-page/assets/img/team/4.png') }}" alt="" />
                    </div>
                    <h4 class="text-2xl font-bold text-gray-800 mb-1 font-heading">AISYAH</h4>
                    <p class="text-gray-400 text-xs uppercase tracking-wide mb-4">SMAN Kehutanan Pekanbaru</p>
                    <div class="bg-brand text-white text-xs font-bold px-4 py-2 rounded-full inline-block shadow-md">
                        LULUS KEHUTANAN UNIB
                    </div>
                </div>

                 <div class="bg-white p-6 rounded-2xl shadow-lg text-center group hover:-translate-y-2 transition duration-300 lg:col-start-2">
                    <div class="w-40 h-40 mx-auto mb-6 rounded-full border-4 border-gray-100 p-1 group-hover:border-brand transition duration-300">
                         <img class="w-full h-full rounded-full object-cover" src="{{ asset('landing-page/assets/img/team/3.png') }}" alt="" />
                    </div>
                    <h4 class="text-2xl font-bold text-gray-800 mb-1 font-heading">REHAN</h4>
                    <p class="text-gray-400 text-xs uppercase tracking-wide mb-4">SMAN 05 Kota Bengkulu</p>
                    <div class="bg-brand text-white text-xs font-bold px-4 py-2 rounded-full inline-block shadow-md">
                        LULUS KEDOKTERAN UNIB
                    </div>
                </div>

            </div>
            
            <div class="text-center mt-20">
                <p class="text-xl md:text-3xl font-heading text-gray-700">
                    Jadilah Bagian dari Generasi <span class="text-brand font-extrabold underline decoration-4 underline-offset-4">ONMAI</span> Selanjutnya...
                </p>
            </div>
        </div>
    </section>

    <div class="py-16 bg-white border-t border-gray-100">
        <div class="container mx-auto px-4">
            <div class="flex justify-center group">
                 <img class="img-fluid block max-w-full h-auto rounded-xl shadow-2xl opacity-90 group-hover:opacity-100 transition duration-500 transform group-hover:scale-[1.01]" src="{{ asset('landing-page/assets/img/team/5.png') }}" alt="Kegiatan Onmai" />
            </div>
        </div>
    </div>

    <section class="py-20 bg-gray-900 text-white relative overflow-hidden" id="contact">
        <div class="absolute top-0 left-0 w-64 h-64 bg-brand/10 rounded-full blur-3xl -translate-x-1/2 -translate-y-1/2"></div>
        <div class="absolute bottom-0 right-0 w-64 h-64 bg-blue-500/10 rounded-full blur-3xl translate-x-1/2 translate-y-1/2"></div>

        <div class="container mx-auto px-4 text-center relative z-10">
            <div class="flex flex-col items-center justify-center gap-2 mb-8">
                <img src="{{ asset('landing-page/assets/img/img1.png') }}" alt="Logo ONMAI" class="h-20 w-auto mb-2">
                <span class="text-5xl font-extrabold font-heading tracking-wide">ON<span class="text-brand">MAI</span></span>
            </div>
            
            <div class="flex flex-col md:flex-row justify-center gap-6 mb-12">
                
                <a href="https://wa.me/6282282377168" target="_blank" class="group flex items-center justify-center gap-3 px-6 py-3 bg-white/10 rounded-full hover:bg-green-600 hover:text-white transition duration-300 backdrop-blur-sm border border-white/10 ">
                    <i class="fab fa-whatsapp text-2xl text-green-400 group-hover:text-white transition-colors duration-300"></i>
                    <span class="font-bold text-lg">Whatsapp ONMAI</span>
                </a>
                <a href="https://instagram.com/bimbel_onmai" target="_blank" class="flex items-center justify-center gap-3 px-6 py-3 bg-white/10 rounded-full hover:bg-pink-600 hover:text-white transition duration-300 backdrop-blur-sm border border-white/10">
                    <i class="fab fa-instagram text-2xl text-pink-400"></i>
                    <span class="font-bold text-lg">@bimbel_onmai</span>
                </a>
            </div>
            
            <div class="border-t border-gray-800 pt-8 max-w-2xl mx-auto">
                <h4 class="text-xl font-bold mb-2 uppercase text-brand tracking-widest">Alamat Kantor Pusat</h4>
                <p class="text-gray-400 text-lg">Jl. Mayjend Sutoyo No. 25 Tanah Patah, Kota Bengkulu</p>
            </div>
        </div>
    </section>

    <footer class="py-6 bg-black text-white text-sm border-t border-gray-800">
        <div class="container mx-auto px-4">
            <div class="flex flex-col md:flex-row items-center justify-between gap-4">
                <div class="text-gray-500">&copy; 2025 ONMAI. All rights reserved.</div>
                <div class="flex gap-4">
                    <a class="w-10 h-10 rounded-full bg-gray-800 flex items-center justify-center hover-bg-brand text-gray-400 hover:text-white transition duration-300 transform hover:scale-110" href="#!"><i class="fab fa-instagram"></i></a>
                    <a class="w-10 h-10 rounded-full bg-gray-800 flex items-center justify-center hover-bg-brand text-gray-400 hover:text-white transition duration-300 transform hover:scale-110" href="#!"><i class="fa-solid fa-envelope"></i></a>
                    <a class="w-10 h-10 rounded-full bg-gray-800 flex items-center justify-center hover-bg-brand text-gray-400 hover:text-white transition duration-300 transform hover:scale-110" href="#!"><i class="fa-solid fa-earth-americas"></i></a>
                </div>
            </div>
        </div>
    </footer>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const btn = document.getElementById('mobile-menu-btn');
            const menu = document.getElementById('mobile-menu');

            btn.addEventListener('click', () => {
                // 1. Toggle class 'open' di menu (untuk trigger animasi slide down)
                menu.classList.toggle('open');
                
                // 2. Toggle animasi icon hamburger (tambah class 'active')
                btn.classList.toggle('active');
            });

            // Tutup menu jika link diklik
            menu.querySelectorAll('a').forEach(link => {
                link.addEventListener('click', () => {
                    menu.classList.remove('open');
                    btn.classList.remove('active'); // Reset icon
                });
            });
        });
    </script>
</body>
</html>