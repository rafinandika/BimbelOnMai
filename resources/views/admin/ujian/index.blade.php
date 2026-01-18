<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bank Soal / Ujian | ONMAI Admin</title>
    
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,600,700" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Roboto+Slab:400,300,700" rel="stylesheet">
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])
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
                    <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3 px-6 py-3 text-gray-400 hover:bg-gray-800 hover:text-brand transition">
                        <i class="fas fa-tachometer-alt w-5 text-center"></i> Dashboard
                    </a>
                </li>
                <li>
                    <a href="{{ route('guru.index') }}" class="flex items-center gap-3 px-6 py-3 text-gray-400 hover:bg-gray-800 hover:text-brand transition">
                        <i class="fas fa-user-tie w-5 text-center"></i> Data Guru
                    </a>
                </li>
                <li>
                    <a href="{{ route('siswa.index') }}" class="flex items-center gap-3 px-6 py-3 text-gray-400 hover:bg-gray-800 hover:text-brand transition">
                        <i class="fas fa-user-graduate w-5 text-center"></i> Data Siswa
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.ujian.index') }}" class="flex items-center gap-3 px-6 py-3 bg-gray-800 border-r-4 border-brand text-white transition">
                        <i class="fas fa-file-alt w-5 text-center"></i> Bank Soal
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

    <div class="flex-1 flex flex-col h-screen overflow-hidden w-full">
        <header class="h-20 bg-white shadow-sm flex items-center justify-between px-4 md:px-8 border-b-4 border-brand z-10 shrink-0">
            <button id="sidebar-toggle" class="md:hidden text-gray-600 text-2xl focus:outline-none hover:text-brand transition">
                <i class="fas fa-bars"></i>
            </button>
            <h2 class="text-xl font-bold font-heading text-gray-800">Bank Soal & Ujian</h2>
            <div class="flex items-center gap-4">
                <div class="text-right hidden sm:block">
                    <span class="block text-sm font-bold text-gray-800">{{ Auth::user()->name }}</span>
                    <span class="block text-xs text-brand font-bold uppercase tracking-wider">Super Admin</span>
                </div>
                <img src="{{ asset('assets/imgs/customer01.jpg') }}" alt="Profile" class="w-10 h-10 rounded-full border-2 border-gray-200 shadow-sm object-cover">
            </div>
        </header>

        <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-50 p-4 md:p-8">
            
            @if(session('success'))
                <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6 rounded shadow-sm flex justify-between items-center animate-[fadeIn_0.5s_ease-out]">
                    <div class="flex items-center gap-2">
                        <i class="fas fa-check-circle"></i>
                        <p>{{ session('success') }}</p>
                    </div>
                    <button onclick="this.parentElement.remove()" class="text-green-700 hover:text-green-900"><i class="fas fa-times"></i></button>
                </div>
            @endif

            <div class="flex flex-col md:flex-row justify-between items-center mb-6 gap-4 animate-[fadeIn_0.5s_ease-out]">
                
                <form action="{{ route('admin.ujian.index') }}" method="GET" class="relative w-full md:w-96">
                    <input type="text" name="q" value="{{ request('q') }}" placeholder="Cari nama ujian atau mapel..." 
                           class="w-full pl-10 pr-4 py-2.5 rounded-xl border border-gray-300 focus:border-brand focus:ring-2 focus:ring-brand/20 outline-none transition shadow-sm">
                    <button type="submit" class="absolute left-3 top-3.5 text-gray-400 hover:text-brand transition">
                        <i class="fas fa-search"></i>
                    </button>
                </form>
                
                <a href="{{ route('admin.ujian.create') }}" class="w-full md:w-auto px-6 py-2.5 bg-brand text-white rounded-xl font-bold shadow-md hover:bg-yellow-500 transition flex items-center justify-center gap-2 group">
                    <i class="fas fa-plus group-hover:rotate-90 transition-transform duration-300"></i> Buat Ujian Baru
                </a>
            </div>

            <div class="bg-white rounded-2xl shadow-lg border border-gray-100 overflow-hidden mb-6 animate-[fadeIn_0.6s_ease-out]">
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="bg-gray-800 text-white text-xs uppercase tracking-wider">
                                <th class="p-4 font-bold border-b border-gray-700">No</th>
                                <th class="p-4 font-bold border-b border-gray-700">Nama Ujian</th>
                                <th class="p-4 font-bold border-b border-gray-700">Mapel & Kelas</th>
                                <th class="p-4 font-bold border-b border-gray-700">Waktu</th>
                                <th class="p-4 font-bold border-b border-gray-700 text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                            @forelse($ujians as $index => $ujian)
                            <tr class="hover:bg-yellow-50 transition duration-150 group">
                                <td class="p-4 text-sm text-gray-500 font-bold">
                                    {{ $ujians->firstItem() + $index }}
                                </td>
                                <td class="p-4">
                                    <span class="font-bold text-gray-800 block text-base group-hover:text-brand transition">{{ $ujian->nama_ujian }}</span>
                                    <span class="text-xs text-gray-400 mt-1 block">
                                        Status: {{ $ujian->tampilkan_hasil ? 'Hasil Tampil' : 'Hasil Sembunyi' }}
                                    </span>
                                </td>
                                <td class="p-4">
                                    <span class="block text-sm text-gray-700 font-bold">{{ $ujian->mapel }}</span>
                                    <span class="inline-block px-2 py-0.5 rounded bg-gray-100 text-gray-500 text-xs font-bold mt-1 border border-gray-200">
                                        Kelas {{ $ujian->kelas }}
                                    </span>
                                </td>
                                <td class="p-4 text-sm text-gray-600">
                                    <div class="flex flex-col text-xs space-y-1">
                                        <span class="flex items-center gap-1 font-bold text-gray-700">
                                            <i class="fas fa-stopwatch text-brand"></i> 
                                            {{ \Carbon\Carbon::parse($ujian->waktu_mulai)->diffInMinutes(\Carbon\Carbon::parse($ujian->waktu_selesai)) }} Menit
                                        </span>
                                        <span class="text-gray-400">
                                            {{ \Carbon\Carbon::parse($ujian->waktu_mulai)->format('d M H:i') }}
                                        </span>
                                    </div>
                                </td>
                                <td class="p-4 text-center">
                                    <div class="flex items-center justify-center gap-2">
                                        <a href="{{ route('admin.ujian.show', $ujian->id) }}" class="w-8 h-8 rounded-lg bg-green-100 text-green-600 flex items-center justify-center hover:bg-green-600 hover:text-white transition shadow-sm" title="Lihat Detail & Soal">
                                            <i class="fas fa-eye text-xs"></i>
                                        </a>
                                        
                                        <a href="{{ route('admin.ujian.edit', $ujian->id) }}" class="w-8 h-8 rounded-lg bg-blue-100 text-blue-600 flex items-center justify-center hover:bg-blue-600 hover:text-white transition shadow-sm" title="Edit Data Ujian">
                                            <i class="fas fa-edit text-xs"></i>
                                        </a>

                                        <form action="{{ route('admin.ujian.destroy', $ujian->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus ujian ini? Data soal dan nilai siswa terkait akan ikut terhapus secara permanen.')">
                                            @csrf 
                                            @method('DELETE')
                                            <button type="submit" class="w-8 h-8 rounded-lg bg-red-100 text-red-600 flex items-center justify-center hover:bg-red-600 hover:text-white transition shadow-sm" title="Hapus Ujian">
                                                <i class="fas fa-trash text-xs"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="p-12 text-center">
                                    <div class="flex flex-col items-center justify-center text-gray-300">
                                        <div class="w-16 h-16 bg-gray-50 rounded-full flex items-center justify-center mb-3">
                                            <i class="fas fa-folder-open text-2xl"></i>
                                        </div>
                                        <h4 class="text-gray-500 font-bold text-lg">Belum Ada Data Ujian</h4>
                                        <p class="text-gray-400 text-sm mt-1">Silakan tambahkan ujian baru untuk memulai.</p>
                                        @if(request('q'))
                                            <a href="{{ route('admin.ujian.index') }}" class="mt-4 text-brand font-bold text-sm hover:underline">Reset Pencarian</a>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                
                <div class="p-4 border-t border-gray-100 bg-gray-50">
                    {{ $ujians->links() }} 
                </div>
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
                    setTimeout(() => { overlay.classList.remove('opacity-0'); overlay.classList.add('opacity-100'); }, 10);
                } else {
                    sidebar.classList.remove('translate-x-0');
                    sidebar.classList.add('-translate-x-full');
                    overlay.classList.remove('opacity-100');
                    overlay.classList.add('opacity-0');
                    setTimeout(() => { overlay.classList.add('hidden'); }, 300);
                }
            }
            if (toggleBtn) toggleBtn.addEventListener('click', (e) => { e.stopPropagation(); toggleSidebar(); });
            if (overlay) overlay.addEventListener('click', toggleSidebar);
        });
    </script>
</body>
</html>