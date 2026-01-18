<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buat Ujian Baru | ONMAI Admin</title>
    
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
            <h2 class="text-xl font-bold font-heading text-gray-800">Buat Ujian Baru</h2>
            <div class="flex items-center gap-4">
                <div class="text-right hidden sm:block">
                    <span class="block text-sm font-bold text-gray-800">{{ Auth::user()->name }}</span>
                    <span class="block text-xs text-brand font-bold uppercase tracking-wider">Super Admin</span>
                </div>
                <img src="{{ asset('assets/imgs/customer01.jpg') }}" alt="Profile" class="w-10 h-10 rounded-full border-2 border-gray-200 shadow-sm object-cover">
            </div>
        </header>

        <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-50 p-4 md:p-8">
            
            <div class="max-w-3xl mx-auto animate-[fadeIn_0.5s_ease-out]">
                
                <div class="mb-6">
                    <a href="{{ route('admin.ujian.index') }}" class="inline-flex items-center gap-2 text-gray-500 hover:text-brand font-bold transition group">
                        <i class="fas fa-arrow-left group-hover:-translate-x-1 transition-transform"></i> Kembali ke Daftar Ujian
                    </a>
                </div>

                <div class="bg-white rounded-2xl shadow-lg border-t-4 border-brand overflow-hidden">
                    <div class="p-8">
                        <div class="flex items-center gap-3 mb-6 border-b border-gray-100 pb-4">
                            <div class="w-10 h-10 rounded-full bg-yellow-100 text-yellow-600 flex items-center justify-center">
                                <i class="fas fa-plus"></i>
                            </div>
                            <div>
                                <h2 class="text-2xl font-bold font-heading text-gray-800">Formulir Ujian Baru</h2>
                                <p class="text-sm text-gray-500">Isi detail ujian di bawah ini.</p>
                            </div>
                        </div>

                        <form action="{{ route('admin.ujian.store') }}" method="POST">
                            @csrf
                            
                            <div class="space-y-6">
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                    <div>
                                        <label class="block text-sm font-bold text-gray-700 mb-2">Nama Ujian <span class="text-red-500">*</span></label>
                                        <input type="text" name="nama_ujian" value="{{ old('nama_ujian') }}" required
                                            class="w-full px-4 py-3 rounded-xl border border-gray-300 focus:border-brand focus:ring-2 focus:ring-brand/20 outline-none transition shadow-sm"
                                            placeholder="Contoh: UTS Matematika Sem 1">
                                        @error('nama_ujian') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                                    </div>
                                    <div>
                                        <label class="block text-sm font-bold text-gray-700 mb-2">Mata Pelajaran <span class="text-red-500">*</span></label>
                                        <input type="text" name="mapel" value="{{ old('mapel') }}" required
                                            class="w-full px-4 py-3 rounded-xl border border-gray-300 focus:border-brand focus:ring-2 focus:ring-brand/20 outline-none transition shadow-sm"
                                            placeholder="Contoh: Matematika Wajib">
                                        @error('mapel') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                                    </div>
                                </div>

                                <div>
                                    <label class="block text-sm font-bold text-gray-700 mb-2">Kelas <span class="text-red-500">*</span></label>
                                    <select name="kelas" class="w-full px-4 py-3 rounded-xl border border-gray-300 focus:border-brand focus:ring-2 focus:ring-brand/20 outline-none transition shadow-sm bg-white">
                                        <option value="" disabled selected>Pilih Kelas</option>
                                        <option value="10">Kelas 10</option>
                                        <option value="11">Kelas 11</option>
                                        <option value="12">Kelas 12</option>
                                        <option value="Umum">Umum</option>
                                    </select>
                                    @error('kelas') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                                </div>

                                <div class="p-4 bg-gray-50 rounded-xl border border-gray-100">
                                    <h4 class="text-sm font-bold text-gray-800 mb-4 border-b border-gray-200 pb-2">Jadwal Pelaksanaan</h4>
                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                        <div>
                                            <label class="block text-xs font-bold text-gray-500 uppercase mb-1">Waktu Mulai</label>
                                            <input type="datetime-local" name="waktu_mulai" value="{{ old('waktu_mulai') }}" required
                                                class="w-full px-4 py-2.5 rounded-lg border border-gray-300 focus:border-brand focus:ring-2 focus:ring-brand/20 outline-none transition shadow-sm bg-white">
                                        </div>
                                        <div>
                                            <label class="block text-xs font-bold text-gray-500 uppercase mb-1">Waktu Selesai</label>
                                            <input type="datetime-local" name="waktu_selesai" value="{{ old('waktu_selesai') }}" required
                                                class="w-full px-4 py-2.5 rounded-lg border border-gray-300 focus:border-brand focus:ring-2 focus:ring-brand/20 outline-none transition shadow-sm bg-white">
                                        </div>
                                    </div>
                                    <p class="text-xs text-gray-400 mt-3"><i class="fas fa-info-circle"></i> Durasi ujian akan dihitung otomatis dari selisih waktu mulai dan selesai.</p>
                                </div>

                            </div>

                            <div class="mt-8 flex items-center justify-end gap-3 pt-6 border-t border-gray-100">
                                <a href="{{ route('admin.ujian.index') }}" class="px-6 py-2.5 rounded-xl text-gray-600 font-bold hover:bg-gray-100 transition">
                                    Batal
                                </a>
                                <button type="submit" class="px-8 py-2.5 bg-brand text-white rounded-xl font-bold shadow-md hover:bg-yellow-500 hover:shadow-lg hover:-translate-y-1 transition-all duration-300 flex items-center gap-2">
                                    <i class="fas fa-save"></i> Simpan Ujian
                                </button>
                            </div>

                        </form>
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