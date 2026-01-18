@extends('belajar')

@section('content')

<style>
    /* Style Sidebar Mobile */
    .hamburger-lines span {
        display: block; width: 24px; height: 3px; margin-bottom: 5px;
        position: relative; background-color: #374151; border-radius: 3px;
        z-index: 1; transform-origin: 4px 0px;
        transition: transform 0.5s cubic-bezier(0.77,0.2,0.05,1.0),
                    background 0.5s cubic-bezier(0.77,0.2,0.05,1.0),
                    opacity 0.55s ease;
    }
    .hamburger-lines span:first-child { transform-origin: 0% 0%; }
    .hamburger-lines span:nth-last-child(2) { transform-origin: 0% 100%; }

    /* CSS Khusus agar Soal & Gambar Rumus Rapi */
    .soal-content img, .jawaban-content img {
        display: inline-block !important;
        vertical-align: middle;
        max-width: 100%;
        height: auto;
        margin: 4px 0;
    }
    /* Menghilangkan margin bawaan paragraf di dalam opsi jawaban agar sejajar dengan badge A/B/C/D */
    .jawaban-content p {
        margin-top: 0;
        margin-bottom: 0;
    }
</style>

<div class="min-h-screen bg-gray-50 p-4 md:p-8">

    <div class="flex flex-col md:flex-row justify-between items-center mb-8 gap-4">
        <div class="flex items-center gap-4 w-full md:w-auto">
            <div id="dashboard-toggle" class="toggle lg:hidden cursor-pointer p-2 rounded-md hover:bg-gray-200 transition duration-300">
                <div class="hamburger-lines"><span></span><span></span><span></span></div>
            </div>
            <div>
                <h1 class="text-2xl font-bold font-heading text-gray-800">Bank Soal</h1>
                <p class="text-xs text-gray-500">Kelola pertanyaan untuk: <span class="font-bold text-[#ffc800] uppercase">{{ $mandiri->nama_mapel ?? 'Mata Pelajaran' }}</span></p>
            </div>
        </div>

        <div class="flex items-center gap-6 w-full md:w-auto justify-end">
            <div class="flex items-center gap-3 pl-0 md:pl-6 md:border-l border-gray-200 shrink-0">
                <div class="text-right hidden sm:block">
                    <span class="block text-sm font-bold text-gray-700">{{ Auth::user()->name ?? 'Admin' }}</span>
                    <span class="block text-xs text-[#ffc800] font-semibold">Administrator</span>
                </div>
                <div class="relative">
                    <img src="{{ asset('assets/imgs/customer01.jpg') }}" alt="Profile" 
                         class="w-10 h-10 rounded-full object-cover border-2 border-white shadow-md">
                </div>
            </div>
        </div>
    </div>

    <div class="flex flex-col md:flex-row justify-between items-center mb-6 gap-4 animate-[fadeIn_0.5s_ease-out]">
        <a href="{{ route('mandiri.materi') }}" class="flex items-center gap-2 text-gray-500 hover:text-gray-800 transition font-bold text-sm bg-white px-4 py-2 rounded-xl shadow-sm border border-gray-200 hover:shadow-md">
            <i class="fas fa-arrow-left"></i> Kembali
        </a>

        @if(session('success'))
            <div class="flex-grow md:mx-4 w-full md:w-auto">
                <div class="bg-green-50 border-l-4 border-green-500 text-green-700 p-3 rounded-lg text-sm flex items-center shadow-sm">
                    <i class="fas fa-check-circle mr-2"></i>
                    <span>{{ session('success') }}</span>
                </div>
            </div>
        @endif

        <div class="flex items-center gap-3 w-full md:w-auto">
            <form action="{{ route('mapel.import', $mandiri->id) }}" method="POST" enctype="multipart/form-data" class="inline-block">
                @csrf
                <input type="file" name="file" id="importExcel" accept=".csv,.xlsx,.xls" hidden onchange="this.form.submit()">
                <label for="importExcel" class="cursor-pointer flex items-center gap-2 px-4 py-2 bg-green-600 text-white rounded-xl font-bold text-sm shadow-md hover:bg-green-700 transition transform hover:-translate-y-0.5">
                    <i class="fas fa-file-excel"></i> Import Excel
                </label>
            </form>

            <a href="{{ route('mandiri.mapel', $mandiri->id) }}" class="flex items-center gap-2 px-4 py-2 bg-[#ffc800] text-white rounded-xl font-bold text-sm shadow-md hover:bg-yellow-500 transition transform hover:-translate-y-0.5">
                <i class="fas fa-plus"></i> Tambah Soal
            </a>
        </div>
    </div>

    <div class="space-y-8 pb-10">
        @forelse($mandiri->mapels as $index => $mapel)
            <div class="bg-white rounded-2xl shadow-sm border border-gray-200 overflow-hidden hover:shadow-md transition-all duration-300 relative group animate-[fadeIn_0.5s_ease-out]">
                
                <div class="bg-gray-50/50 px-6 py-4 border-b border-gray-100 flex justify-between items-center">
                    <div class="flex items-center gap-3">
                        <span class="bg-[#ffc800] text-white text-xs font-bold px-3 py-1.5 rounded-lg shadow-sm">
                            Soal No. {{ $index + 1 }}
                        </span>
                    </div>
                    
                    <div class="flex items-center gap-2 opacity-100 md:opacity-50 group-hover:opacity-100 transition-opacity duration-200">
                        <a href="{{ route('mapel.edit', [$mandiri->id, $mapel->id]) }}" class="px-3 py-1.5 rounded-lg bg-white border border-gray-200 text-blue-600 text-xs font-bold hover:bg-blue-50 hover:border-blue-200 transition shadow-sm">
                            <i class="fas fa-edit mr-1"></i> Edit
                        </a>
                        <form action="{{ route('mapel.destroy', [$mandiri->id, $mapel->id]) }}" method="POST" class="inline">
                            @csrf @method('DELETE')
                            <button type="submit" class="px-3 py-1.5 rounded-lg bg-white border border-gray-200 text-red-600 text-xs font-bold hover:bg-red-50 hover:border-red-200 transition shadow-sm" onclick="return confirm('Yakin hapus soal ini?')">
                                <i class="fas fa-trash mr-1"></i> Hapus
                            </button>
                        </form>
                    </div>
                </div>

                <div class="p-6 md:p-8">
                    <div class="soal-content prose max-w-none text-gray-800 font-medium text-lg leading-relaxed mb-8">
                        {!! $mapel->pertanyaan !!}
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        
                        <div class="group/opt flex items-start gap-4 p-4 rounded-xl border border-gray-200 bg-white hover:border-[#ffc800] hover:bg-yellow-50/30 transition-all duration-200 cursor-default">
                            <div class="flex-shrink-0 w-8 h-8 rounded-lg bg-gray-100 text-gray-500 font-bold flex items-center justify-center border border-gray-200 group-hover/opt:bg-[#ffc800] group-hover/opt:text-white group-hover/opt:border-[#ffc800] transition-colors text-sm shadow-sm">
                                A
                            </div>
                            <div class="jawaban-content flex-grow pt-1 text-gray-600 text-sm md:text-base prose max-w-none group-hover/opt:text-gray-800">
                                {!! $mapel->a !!}
                            </div>
                        </div>

                        <div class="group/opt flex items-start gap-4 p-4 rounded-xl border border-gray-200 bg-white hover:border-[#ffc800] hover:bg-yellow-50/30 transition-all duration-200 cursor-default">
                            <div class="flex-shrink-0 w-8 h-8 rounded-lg bg-gray-100 text-gray-500 font-bold flex items-center justify-center border border-gray-200 group-hover/opt:bg-[#ffc800] group-hover/opt:text-white group-hover/opt:border-[#ffc800] transition-colors text-sm shadow-sm">
                                B
                            </div>
                            <div class="jawaban-content flex-grow pt-1 text-gray-600 text-sm md:text-base prose max-w-none group-hover/opt:text-gray-800">
                                {!! $mapel->b !!}
                            </div>
                        </div>

                        <div class="group/opt flex items-start gap-4 p-4 rounded-xl border border-gray-200 bg-white hover:border-[#ffc800] hover:bg-yellow-50/30 transition-all duration-200 cursor-default">
                            <div class="flex-shrink-0 w-8 h-8 rounded-lg bg-gray-100 text-gray-500 font-bold flex items-center justify-center border border-gray-200 group-hover/opt:bg-[#ffc800] group-hover/opt:text-white group-hover/opt:border-[#ffc800] transition-colors text-sm shadow-sm">
                                C
                            </div>
                            <div class="jawaban-content flex-grow pt-1 text-gray-600 text-sm md:text-base prose max-w-none group-hover/opt:text-gray-800">
                                {!! $mapel->c !!}
                            </div>
                        </div>

                        <div class="group/opt flex items-start gap-4 p-4 rounded-xl border border-gray-200 bg-white hover:border-[#ffc800] hover:bg-yellow-50/30 transition-all duration-200 cursor-default">
                            <div class="flex-shrink-0 w-8 h-8 rounded-lg bg-gray-100 text-gray-500 font-bold flex items-center justify-center border border-gray-200 group-hover/opt:bg-[#ffc800] group-hover/opt:text-white group-hover/opt:border-[#ffc800] transition-colors text-sm shadow-sm">
                                D
                            </div>
                            <div class="jawaban-content flex-grow pt-1 text-gray-600 text-sm md:text-base prose max-w-none group-hover/opt:text-gray-800">
                                {!! $mapel->d !!}
                            </div>
                        </div>

                    </div>
                    
                    <div class="mt-6 pt-4 border-t border-gray-100 flex justify-end">
                        <div class="bg-gray-100 px-4 py-2 rounded-lg text-xs font-bold text-gray-500 flex items-center gap-2">
                            <i class="fas fa-key text-gray-400"></i>
                            Kunci Jawaban: <span class="text-green-600 text-base">{{ $mapel->kunci_jawaban ?? $mapel->kunci ?? $mapel->jawaban_benar ?? $mapel->jawaban ?? 'KOSONG' }}</span>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-16 text-center animate-[fadeIn_0.5s_ease-out]">
                <div class="w-20 h-20 bg-gray-50 rounded-full flex items-center justify-center mx-auto mb-6 text-gray-300">
                    <i class="fas fa-folder-open text-4xl"></i>
                </div>
                <h3 class="text-xl font-bold text-gray-800 mb-2">Belum Ada Soal</h3>
                <p class="text-gray-500 mb-8 max-w-md mx-auto">Bank soal untuk mata pelajaran ini masih kosong. Silakan tambah manual atau import dari Excel.</p>
                <a href="{{ route('mandiri.mapel', $mandiri->id) }}" class="inline-flex items-center gap-2 px-6 py-2.5 bg-[#ffc800] text-white rounded-xl font-bold shadow-lg hover:bg-yellow-500 transition">
                    <i class="fas fa-plus"></i> Mulai Buat Soal
                </a>
            </div>
        @endforelse
    </div>

    @if(method_exists($mandiri->mapels, 'links'))
    <div class="mt-8">
        {{ $mandiri->mapels->links() }}
    </div>
    @endif

</div>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        // Toggle Sidebar Mobile
        const toggleBtn = document.getElementById('dashboard-toggle');
        const sidebar = document.getElementById('sidebar'); 
        const overlay = document.getElementById('sidebar-overlay');

        if (toggleBtn && sidebar && overlay) {
            function toggleSidebar() {
                if (sidebar.classList.contains('-translate-x-full')) {
                    sidebar.classList.remove('-translate-x-full'); sidebar.classList.add('translate-x-0');
                    overlay.classList.remove('hidden'); setTimeout(() => { overlay.classList.remove('opacity-0'); overlay.classList.add('opacity-100'); }, 10);
                } else {
                    sidebar.classList.remove('translate-x-0'); sidebar.classList.add('-translate-x-full');
                    overlay.classList.remove('opacity-100'); overlay.classList.add('opacity-0'); setTimeout(() => { overlay.classList.add('hidden'); }, 300);
                }
            }
            toggleBtn.addEventListener('click', (e) => { e.stopPropagation(); toggleSidebar(); });
            overlay.addEventListener('click', toggleSidebar);
        }
    });
</script>

@endsection