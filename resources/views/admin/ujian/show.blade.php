<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Ujian | ONMAI Admin</title>
    
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
            <h2 class="text-xl font-bold font-heading text-gray-800">Detail Ujian</h2>
            <div class="flex items-center gap-4">
                <div class="text-right hidden sm:block">
                    <span class="block text-sm font-bold text-gray-800">{{ Auth::user()->name }}</span>
                    <span class="block text-xs text-brand font-bold uppercase tracking-wider">Super Admin</span>
                </div>
                <img src="{{ asset('assets/imgs/customer01.jpg') }}" alt="Profile" class="w-10 h-10 rounded-full border-2 border-gray-200 shadow-sm object-cover">
            </div>
        </header>

        <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-50 p-4 md:p-8">
            
            <div class="max-w-4xl mx-auto animate-[fadeIn_0.5s_ease-out]">
                
                <div class="flex flex-col md:flex-row justify-between items-center mb-6 gap-4">
                    <a href="{{ route('admin.ujian.index') }}" class="inline-flex items-center gap-2 text-gray-500 hover:text-brand font-bold transition group">
                        <i class="fas fa-arrow-left group-hover:-translate-x-1 transition-transform"></i> Kembali ke Bank Soal
                    </a>

                    <div class="flex gap-2">
                        <a href="{{ route('admin.ujian.edit', $ujian->id) }}" class="px-4 py-2 bg-blue-100 text-blue-600 rounded-lg font-bold hover:bg-blue-600 hover:text-white transition flex items-center gap-2">
                            <i class="fas fa-edit"></i> Edit Ujian
                        </a>
                        <form action="{{ route('admin.ujian.destroy', $ujian->id) }}" method="POST" onsubmit="return confirm('Hapus ujian ini permanen?')">
                            @csrf @method('DELETE')
                            <button type="submit" class="px-4 py-2 bg-red-100 text-red-600 rounded-lg font-bold hover:bg-red-600 hover:text-white transition flex items-center gap-2">
                                <i class="fas fa-trash"></i> Hapus
                            </button>
                        </form>
                    </div>
                </div>

                <div class="bg-white rounded-2xl shadow-lg border-t-4 border-brand overflow-hidden mb-8">
                    <div class="p-8 border-b border-gray-100 bg-gray-50/50">
                        <div class="flex justify-between items-start">
                            <div>
                                <h1 class="text-3xl font-bold font-heading text-gray-800 mb-2">{{ $ujian->nama_ujian }}</h1>
                                <p class="text-gray-500 font-medium text-sm">Status Hasil: 
                                    <span class="font-bold {{ $ujian->tampilkan_hasil ? 'text-green-600' : 'text-red-500' }}">
                                        {{ $ujian->tampilkan_hasil ? 'Ditampilkan ke Siswa' : 'Disembunyikan' }}
                                    </span>
                                </p>
                            </div>
                            <div class="text-right">
                                <span class="block text-4xl font-bold text-gray-800">
                                    {{ \Carbon\Carbon::parse($ujian->waktu_mulai)->diffInMinutes(\Carbon\Carbon::parse($ujian->waktu_selesai)) }}
                                </span>
                                <span class="text-xs uppercase font-bold text-gray-400">Menit</span>
                            </div>
                        </div>
                    </div>
                    
                    <div class="p-6 grid grid-cols-1 md:grid-cols-3 gap-6 text-sm">
                        <div class="flex items-center gap-3 p-3 bg-gray-50 rounded-xl border border-gray-100">
                            <div class="w-10 h-10 rounded-full bg-blue-100 text-blue-600 flex items-center justify-center"><i class="fas fa-book"></i></div>
                            <div>
                                <span class="block text-gray-400 text-xs font-bold uppercase">Mata Pelajaran</span>
                                <span class="block font-bold text-gray-800 text-base">{{ $ujian->mapel }}</span>
                            </div>
                        </div>
                        <div class="flex items-center gap-3 p-3 bg-gray-50 rounded-xl border border-gray-100">
                            <div class="w-10 h-10 rounded-full bg-green-100 text-green-600 flex items-center justify-center"><i class="fas fa-layer-group"></i></div>
                            <div>
                                <span class="block text-gray-400 text-xs font-bold uppercase">Kelas</span>
                                <span class="block font-bold text-gray-800 text-base">Kelas {{ $ujian->kelas }}</span>
                            </div>
                        </div>
                        <div class="flex items-center gap-3 p-3 bg-gray-50 rounded-xl border border-gray-100">
                            <div class="w-10 h-10 rounded-full bg-purple-100 text-purple-600 flex items-center justify-center"><i class="far fa-calendar-alt"></i></div>
                            <div>
                                <span class="block text-gray-400 text-xs font-bold uppercase">Waktu Pelaksanaan</span>
                                <span class="block font-bold text-gray-800 text-xs">{{ \Carbon\Carbon::parse($ujian->waktu_mulai)->format('d M H:i') }} s.d</span>
                                <span class="block font-bold text-gray-800 text-xs">{{ \Carbon\Carbon::parse($ujian->waktu_selesai)->format('d M H:i') }}</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-2xl shadow-lg border border-gray-100 overflow-hidden">
                    <div class="p-6 border-b border-gray-100 flex justify-between items-center bg-gray-50">
                        <h3 class="font-bold text-gray-800 text-lg flex items-center gap-2">
                            <i class="fas fa-list-ol text-brand"></i> Daftar Soal ({{ $ujian->soals->count() }})
                        </h3>
                    </div>
                    
                    <div class="divide-y divide-gray-100">
                        @forelse($ujian->soals as $index => $soal)
                            <div class="p-6 hover:bg-yellow-50/20 transition group">
                                <div class="flex gap-4">
                                    <span class="shrink-0 w-8 h-8 flex items-center justify-center bg-gray-800 text-brand font-bold rounded-lg shadow-sm text-sm mt-1">
                                        {{ $index + 1 }}
                                    </span>
                                    
                                    <div class="flex-1">
                                        <div class="prose max-w-none text-gray-800 font-medium mb-4">
                                            {!! $soal->pertanyaan !!}
                                        </div>

                                        <div class="grid grid-cols-1 md:grid-cols-2 gap-3 text-sm">
                                            <div class="flex gap-2 p-2 rounded border {{ $soal->jawaban_benar == 'A' ? 'bg-green-50 border-green-200' : 'border-gray-100 bg-white' }}">
                                                <span class="font-bold {{ $soal->jawaban_benar == 'A' ? 'text-green-600' : 'text-gray-400' }}">A.</span>
                                                <span class="{{ $soal->jawaban_benar == 'A' ? 'text-green-700 font-bold' : 'text-gray-600' }}">{!! $soal->opsi_a ?? $soal->a !!}</span>
                                                @if($soal->jawaban_benar == 'A') <i class="fas fa-check text-green-500 ml-auto"></i> @endif
                                            </div>
                                            <div class="flex gap-2 p-2 rounded border {{ $soal->jawaban_benar == 'B' ? 'bg-green-50 border-green-200' : 'border-gray-100 bg-white' }}">
                                                <span class="font-bold {{ $soal->jawaban_benar == 'B' ? 'text-green-600' : 'text-gray-400' }}">B.</span>
                                                <span class="{{ $soal->jawaban_benar == 'B' ? 'text-green-700 font-bold' : 'text-gray-600' }}">{!! $soal->opsi_b ?? $soal->b !!}</span>
                                                @if($soal->jawaban_benar == 'B') <i class="fas fa-check text-green-500 ml-auto"></i> @endif
                                            </div>
                                            <div class="flex gap-2 p-2 rounded border {{ $soal->jawaban_benar == 'C' ? 'bg-green-50 border-green-200' : 'border-gray-100 bg-white' }}">
                                                <span class="font-bold {{ $soal->jawaban_benar == 'C' ? 'text-green-600' : 'text-gray-400' }}">C.</span>
                                                <span class="{{ $soal->jawaban_benar == 'C' ? 'text-green-700 font-bold' : 'text-gray-600' }}">{!! $soal->opsi_c ?? $soal->c !!}</span>
                                                @if($soal->jawaban_benar == 'C') <i class="fas fa-check text-green-500 ml-auto"></i> @endif
                                            </div>
                                            <div class="flex gap-2 p-2 rounded border {{ $soal->jawaban_benar == 'D' ? 'bg-green-50 border-green-200' : 'border-gray-100 bg-white' }}">
                                                <span class="font-bold {{ $soal->jawaban_benar == 'D' ? 'text-green-600' : 'text-gray-400' }}">D.</span>
                                                <span class="{{ $soal->jawaban_benar == 'D' ? 'text-green-700 font-bold' : 'text-gray-600' }}">{!! $soal->opsi_d ?? $soal->d !!}</span>
                                                @if($soal->jawaban_benar == 'D') <i class="fas fa-check text-green-500 ml-auto"></i> @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="text-center py-12">
                                <div class="w-16 h-16 bg-gray-100 text-gray-300 rounded-full flex items-center justify-center mx-auto mb-3">
                                    <i class="fas fa-folder-open text-2xl"></i>
                                </div>
                                <h4 class="text-gray-500 font-bold">Belum Ada Soal</h4>
                                <p class="text-gray-400 text-sm">Ujian ini belum memiliki butir soal.</p>
                            </div>
                        @endforelse
                    </div>
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