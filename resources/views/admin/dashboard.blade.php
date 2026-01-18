<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard | ONMAI</title>
    
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,600,700" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Roboto+Slab:400,300,700" rel="stylesheet">
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        brand: '#ffc800',
                        dark: '#1f2937',
                        darker: '#111827',
                    },
                    fontFamily: {
                        heading: ['Montserrat', 'sans-serif'],
                        body: ['Roboto Slab', 'serif'],
                    }
                }
            }
        }
    </script>
</head>
<body class="bg-gray-100 font-body text-gray-800 flex h-screen overflow-hidden relative">

    <div id="sidebar-overlay" class="fixed inset-0 bg-black/50 z-20 hidden transition-opacity opacity-0 lg:hidden"></div>

    <aside id="sidebar" class="w-64 bg-darker text-white fixed inset-y-0 left-0 transform -translate-x-full md:relative md:translate-x-0 flex flex-col shadow-2xl z-30 transition-transform duration-300 ease-in-out">
        <div class="h-20 flex items-center justify-center border-b border-gray-800 shrink-0">
            <a href="#" class="flex items-center gap-2 text-xl font-bold font-heading text-brand tracking-widest">
                <i class="fas fa-crown"></i> ADMIN
            </a>
        </div>

        <nav class="flex-1 overflow-y-auto py-4">
            <ul class="space-y-1">
                <li>
                    <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3 px-6 py-3 bg-gray-800 border-r-4 border-brand text-white transition">
                        <i class="fas fa-tachometer-alt w-5 text-center"></i> Dashboard
                    </a>
                </li>
                <li>
                    <a href="#" class="flex items-center gap-3 px-6 py-3 text-gray-400 hover:bg-gray-800 hover:text-brand transition">
                        <i class="fas fa-user-tie w-5 text-center"></i> Data Guru
                    </a>
                </li>
                <li>
                    <a href="#" class="flex items-center gap-3 px-6 py-3 text-gray-400 hover:bg-gray-800 hover:text-brand transition">
                        <i class="fas fa-user-graduate w-5 text-center"></i> Data Siswa
                    </a>
                </li>
                <li>
                    <a href="#" class="flex items-center gap-3 px-6 py-3 text-gray-400 hover:bg-gray-800 hover:text-brand transition">
                        <i class="fas fa-file-alt w-5 text-center"></i> Bank Soal
                    </a>
                </li>
                <li>
                    <a href="#" class="flex items-center gap-3 px-6 py-3 text-gray-400 hover:bg-gray-800 hover:text-brand transition">
                        <i class="fas fa-cogs w-5 text-center"></i> Pengaturan
                    </a>
                </li>
            </ul>
        </nav>

        <div class="p-4 border-t border-gray-800 shrink-0">
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="w-full flex items-center justify-center gap-2 px-4 py-2 bg-red-600/20 text-red-500 hover:bg-red-600 hover:text-white rounded-lg transition duration-300 font-bold text-sm">
                    <i class="fas fa-sign-out-alt"></i> LOGOUT
                </button>
            </form>
        </div>
    </aside>

    <div class="flex-1 flex flex-col h-screen overflow-hidden relative w-full">
        
        <header class="h-20 bg-white shadow-sm flex items-center justify-between px-4 md:px-8 border-b-4 border-brand z-10 shrink-0">
            <button id="sidebar-toggle" class="md:hidden text-gray-600 text-2xl focus:outline-none hover:text-brand transition">
                <i class="fas fa-bars"></i>
            </button>

            <h2 class="text-xl font-bold font-heading text-gray-800 hidden md:block">Dashboard Administrator</h2>
            <h2 class="text-lg font-bold font-heading text-gray-800 md:hidden">Admin Panel</h2>

            <div class="flex items-center gap-4">
                <div class="text-right hidden sm:block">
                    <span class="block text-sm font-bold text-gray-800">{{ Auth::user()->name ?? 'Admin' }}</span>
                    <span class="block text-xs text-brand font-bold uppercase tracking-wider">Super Admin</span>
                </div>
                <img src="{{ asset('assets/imgs/customer01.jpg') }}" alt="Profile" class="w-10 h-10 rounded-full border-2 border-gray-200 shadow-sm object-cover">
            </div>
        </header>

        <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-50 p-4 md:p-8">
            
            <div class="bg-gradient-to-r from-gray-900 to-gray-800 rounded-2xl p-8 mb-8 shadow-lg text-white relative overflow-hidden">
                <div class="absolute right-0 top-0 h-full w-1/3 bg-white/5 skew-x-12 transform origin-bottom-left"></div>
                <h1 class="text-2xl font-bold font-heading mb-2 relative z-10">Selamat Datang, Administrator!</h1>
                <p class="text-gray-300 relative z-10">Berikut adalah ringkasan aktivitas sistem pembelajaran ONMAI hari ini.</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                
                <div class="bg-white rounded-xl shadow-md p-6 border-l-4 border-blue-500 hover:shadow-lg transition transform hover:-translate-y-1">
                    <div class="flex justify-between items-center">
                        <div>
                            <p class="text-xs text-gray-400 font-bold uppercase tracking-wider">Total Siswa</p>
                            <h3 class="text-3xl font-bold text-gray-800 mt-1">{{ $totalSiswa ?? 0 }}</h3>
                        </div>
                        <div class="w-12 h-12 bg-blue-100 text-blue-600 rounded-full flex items-center justify-center text-xl">
                            <i class="fas fa-user-graduate"></i>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-xl shadow-md p-6 border-l-4 border-green-500 hover:shadow-lg transition transform hover:-translate-y-1">
                    <div class="flex justify-between items-center">
                        <div>
                            <p class="text-xs text-gray-400 font-bold uppercase tracking-wider">Total Guru</p>
                            <h3 class="text-3xl font-bold text-gray-800 mt-1">{{ $totalGuru ?? 0 }}</h3>
                        </div>
                        <div class="w-12 h-12 bg-green-100 text-green-600 rounded-full flex items-center justify-center text-xl">
                            <i class="fas fa-chalkboard-teacher"></i>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-xl shadow-md p-6 border-l-4 border-brand hover:shadow-lg transition transform hover:-translate-y-1">
                    <div class="flex justify-between items-center">
                        <div>
                            <p class="text-xs text-gray-400 font-bold uppercase tracking-wider">Ujian Aktif</p>
                            <h3 class="text-3xl font-bold text-gray-800 mt-1">{{ $totalUjian ?? 0 }}</h3>
                        </div>
                        <div class="w-12 h-12 bg-yellow-100 text-yellow-600 rounded-full flex items-center justify-center text-xl">
                            <i class="fas fa-file-signature"></i>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-xl shadow-md p-6 border-l-4 border-purple-500 hover:shadow-lg transition transform hover:-translate-y-1">
                    <div class="flex justify-between items-center">
                        <div>
                            <p class="text-xs text-gray-400 font-bold uppercase tracking-wider">Bank Soal</p>
                            <h3 class="text-3xl font-bold text-gray-800 mt-1">{{ $totalSoal ?? 0 }}</h3>
                        </div>
                        <div class="w-12 h-12 bg-purple-100 text-purple-600 rounded-full flex items-center justify-center text-xl">
                            <i class="fas fa-database"></i>
                        </div>
                    </div>
                </div>

            </div>

            <h3 class="text-lg font-bold text-gray-800 mb-4 font-heading border-l-4 border-brand pl-3">Menu Cepat</h3>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                
                <a href="#" class="bg-white p-6 rounded-xl shadow-sm border border-gray-100 hover:border-brand transition group">
                    <div class="mb-4 w-10 h-10 bg-gray-900 text-white rounded-lg flex items-center justify-center group-hover:bg-brand group-hover:text-gray-900 transition">
                        <i class="fas fa-user-plus"></i>
                    </div>
                    <h4 class="font-bold text-gray-800">Tambah User</h4>
                    <p class="text-xs text-gray-500 mt-1">Daftarkan akun guru atau siswa baru.</p>
                </a>

                <a href="#" class="bg-white p-6 rounded-xl shadow-sm border border-gray-100 hover:border-brand transition group">
                    <div class="mb-4 w-10 h-10 bg-gray-900 text-white rounded-lg flex items-center justify-center group-hover:bg-brand group-hover:text-gray-900 transition">
                        <i class="fas fa-server"></i>
                    </div>
                    <h4 class="font-bold text-gray-800">Monitor Server</h4>
                    <p class="text-xs text-gray-500 mt-1">Cek status penggunaan server.</p>
                </a>

                <a href="#" class="bg-white p-6 rounded-xl shadow-sm border border-gray-100 hover:border-brand transition group">
                    <div class="mb-4 w-10 h-10 bg-gray-900 text-white rounded-lg flex items-center justify-center group-hover:bg-brand group-hover:text-gray-900 transition">
                        <i class="fas fa-print"></i>
                    </div>
                    <h4 class="font-bold text-gray-800">Laporan Nilai</h4>
                    <p class="text-xs text-gray-500 mt-1">Cetak rekap nilai ujian siswa.</p>
                </a>

            </div>

        </main>
    </div>
    
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            
            const sidebar = document.getElementById('sidebar');
            const toggleBtn = document.getElementById('sidebar-toggle');
            const overlay = document.getElementById('sidebar-overlay');

            function toggleSidebar() {
                if (sidebar.classList.contains('-translate-x-full')) {
                    sidebar.classList.remove('-translate-x-full');
                    sidebar.classList.add('translate-x-0');
                    overlay.classList.remove('hidden');
                    setTimeout(() => {
                        overlay.classList.remove('opacity-0');
                        overlay.classList.add('opacity-100');
                    }, 10);
                } else {
                    sidebar.classList.remove('translate-x-0');
                    sidebar.classList.add('-translate-x-full');
                    overlay.classList.remove('opacity-100');
                    overlay.classList.add('opacity-0');
                    setTimeout(() => {
                        overlay.classList.add('hidden');
                    }, 300);
                }
            }

            if (toggleBtn) {
                toggleBtn.addEventListener('click', function(e) {
                    e.stopPropagation();
                    toggleSidebar();
                });
            }

            if (overlay) {
                overlay.addEventListener('click', function() {
                    toggleSidebar();
                });
            }
        });
    </script>
</body>
</html>