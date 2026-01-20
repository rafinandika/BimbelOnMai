@extends('mandiri') 

@section('title', 'Daftar Ujian Saya')

@section('content')

<div class="container mx-auto max-w-7xl pb-12">
    
    {{-- === BAGIAN NOTIFIKASI TAMBAHAN === --}}
    
    {{-- 1. Notifikasi Error (Merah) - Muncul jika soal kosong/tidak ada --}}
    @if(session('error'))
        <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 rounded-r shadow-sm mb-6 animate-[fadeIn_0.5s_ease-out] flex items-center justify-between">
            <div class="flex items-center gap-3">
                <div class="bg-red-200 rounded-full p-2">
                    <i class="fas fa-exclamation-triangle text-red-600"></i>
                </div>
                <div>
                    <p class="font-bold text-sm">Mohon Maaf</p>
                    <p class="text-sm">{{ session('error') }}</p>
                </div>
            </div>
            {{-- Tombol Close --}}
            <button onclick="this.parentElement.style.display='none'" class="text-red-400 hover:text-red-700 transition">
                <i class="fas fa-times"></i>
            </button>
        </div>
    @endif

    {{-- 2. Notifikasi Warning (Kuning) - Muncul jika sudah pernah mengerjakan --}}
    @if(session('warning'))
        <div class="bg-yellow-100 border-l-4 border-yellow-500 text-yellow-700 p-4 rounded-r shadow-sm mb-6 animate-[fadeIn_0.5s_ease-out] flex items-center gap-3">
            <div class="bg-yellow-200 rounded-full p-2">
                <i class="fas fa-info-circle text-yellow-600"></i>
            </div>
            <div>
                <p class="font-bold text-sm">Informasi</p>
                <p class="text-sm">{{ session('warning') }}</p>
            </div>
        </div>
    @endif

    {{-- 3. Notifikasi Sukses (Hijau) --}}
    @if(session('success'))
        <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 rounded-r shadow-sm mb-6 animate-[fadeIn_0.5s_ease-out] flex items-center gap-3">
            <div class="bg-green-200 rounded-full p-2">
                <i class="fas fa-check text-green-600"></i>
            </div>
            <div>
                <p class="font-bold text-sm">Berhasil</p>
                <p class="text-sm">{{ session('success') }}</p>
            </div>
        </div>
    @endif

    {{-- === AKHIR BAGIAN NOTIFIKASI === --}}


    <div class="bg-white rounded-2xl shadow-lg p-6 mb-8 border-l-4 border-[#ffc800] flex flex-col md:flex-row items-center justify-between gap-4 animate-[fadeIn_0.5s_ease-out]">
        <div>
            <h2 class="text-2xl font-bold text-gray-800 font-heading">
                Selamat Datang, <span class="text-[#ffc800]">{{ auth()->user()->name }}</span>! 👋
            </h2>
            <p class="text-gray-500 text-sm mt-1">Siap untuk menguji kemampuanmu hari ini?</p>
        </div>
        <div class="hidden md:block">
            <span class="px-4 py-2 bg-yellow-50 text-[#ffc800] rounded-full text-xs font-bold uppercase tracking-wider border border-yellow-200">
                <i class="fas fa-calendar-alt mr-1"></i> {{ now()->format('d F Y') }}
            </span>
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @forelse ($ujian as $item)
            <div class="group bg-white rounded-2xl shadow-md hover:shadow-2xl transition-all duration-300 flex flex-col overflow-hidden border border-gray-100 relative transform hover:-translate-y-1">
                
                <div class="absolute top-0 right-0 mt-4 mr-4">
                    @if($item->bisa_dikerjakan)
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold bg-green-100 text-green-700 shadow-sm">
                            <span class="w-2 h-2 bg-green-500 rounded-full mr-2 animate-pulse"></span> Tersedia
                        </span>
                    @else
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold bg-gray-100 text-gray-500 shadow-sm">
                            <i class="fas fa-lock mr-1"></i> Terkunci
                        </span>
                    @endif
                </div>

                <div class="p-6 flex-grow">
                    <div class="w-14 h-14 rounded-xl bg-gradient-to-br from-yellow-100 to-white border border-yellow-200 flex items-center justify-center text-[#ffc800] mb-4 shadow-sm group-hover:scale-110 transition-transform duration-300">
                        <i class="fas fa-book-open text-2xl"></i>
                    </div>

                    <h3 class="text-lg font-bold text-gray-800 mb-1 font-heading line-clamp-2 group-hover:text-[#ffc800] transition-colors">
                        {{ $item->nama_ujian }}
                    </h3>
                    <p class="text-xs text-gray-400 font-medium mb-4 uppercase tracking-wider">Tryout Online</p>

                    <div class="space-y-3 bg-gray-50 p-4 rounded-xl border border-gray-100">
                        <div class="flex items-start gap-3">
                            <div class="mt-1 w-5 flex justify-center text-gray-400"><i class="fas fa-bookmark text-xs"></i></div>
                            <div>
                                <span class="block text-xs text-gray-400">Mata Pelajaran</span>
                                <span class="text-sm font-semibold text-gray-700">{{ $item->mapel }}</span>
                            </div>
                        </div>

                        <div class="flex items-start gap-3">
                            <div class="mt-1 w-5 flex justify-center text-gray-400"><i class="fas fa-graduation-cap text-xs"></i></div>
                            <div>
                                <span class="block text-xs text-gray-400">Kelas</span>
                                <span class="text-sm font-semibold text-gray-700">{{ $item->kelas }}</span>
                            </div>
                        </div>

                        <div class="flex items-start gap-3">
                            <div class="mt-1 w-5 flex justify-center text-gray-400"><i class="fas fa-clock text-xs"></i></div>
                            <div>
                                <span class="block text-xs text-gray-400">Waktu Pengerjaan</span>
                                <span class="text-sm font-semibold text-gray-700">
                                    @if($item->waktu_mulai && $item->waktu_selesai)
                                        <div class="flex flex-col">
                                            <span>{{ $item->waktu_mulai->format('d M H:i') }}</span>
                                            <span class="text-gray-400 text-xs">s/d</span>
                                            <span>{{ $item->waktu_selesai->format('d M H:i') }}</span>
                                        </div>
                                    @else
                                        <span class="text-red-500 italic">Belum Dijadwalkan</span>
                                    @endif
                                </span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="p-6 pt-0 mt-auto">
                    @if($item->bisa_dikerjakan)
                        <a href="{{ route('tryout.kerjakan', ['ujian' => $item->id, 'index' => 0]) }}" 
                           class="group/btn relative w-full inline-flex items-center justify-center gap-2 px-6 py-3 bg-[#ffc800] text-white font-bold rounded-xl overflow-hidden shadow-lg transition-all duration-300 hover:scale-[1.02] hover:shadow-yellow-500/30 active:scale-95">
                            <div class="absolute inset-0 w-full h-full bg-gradient-to-r from-transparent via-white/30 to-transparent -translate-x-[150%] skew-x-12 transition-transform duration-1000 group-hover/btn:translate-x-[150%] ease-in-out"></div>
                            <span class="relative z-10">KERJAKAN SEKARANG</span>
                            <i class="fas fa-arrow-right relative z-10 transition-transform duration-300 group-hover/btn:translate-x-1"></i>
                        </a>
                    @else
                        <button disabled class="w-full py-3 bg-gray-100 text-gray-400 font-bold rounded-xl cursor-not-allowed border border-gray-200 flex items-center justify-center gap-2">
                            <i class="fas fa-lock"></i> Belum Dibuka
                        </button>
                    @endif
                </div>
            </div>
        @empty
            <div class="col-span-1 md:col-span-2 lg:col-span-3 text-center py-20 bg-white rounded-2xl border border-dashed border-gray-300">
                <div class="w-20 h-20 bg-gray-50 rounded-full flex items-center justify-center mx-auto mb-4 text-gray-300">
                    <i class="fas fa-clipboard-list text-4xl"></i>
                </div>
                <h3 class="text-lg font-bold text-gray-600">Belum Ada Ujian Tersedia</h3>
                <p class="text-gray-400 text-sm">Silakan cek kembali nanti atau hubungi admin.</p>
            </div>
        @endforelse
    </div>

</div>

@endsection