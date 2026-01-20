@extends('index')

@section('content')

<style>
    /* CSS agar gambar responsif dan muncul dengan benar */
    .prose img, .answer-content img { 
        max-width: 100%; 
        height: auto; 
        border-radius: 8px; 
        margin: 5px 0; 
        display: inline-block !important; /* Penting agar gambar tidak hidden */
        vertical-align: middle;
    }
    .prose p, .answer-content p { 
        margin-bottom: 0.5rem; 
        display: inline-block; /* Agar teks dan gambar bisa sejajar */
    }
</style>

<div class="min-h-screen bg-gray-50 py-8 px-4 sm:px-6">
    <div class="max-w-4xl mx-auto animate-[fadeIn_0.5s_ease-out]">

        <div class="bg-white rounded-2xl shadow-lg border-l-4 border-[#ffc800] p-6 mb-8 flex flex-col md:flex-row justify-between items-center gap-4">
            <div>
                <h6 class="text-xs font-bold text-gray-400 uppercase tracking-widest mb-1">Mata Pelajaran</h6>
                <h1 class="text-2xl font-bold font-heading text-gray-800">{{ $mandiri->nama_mapel ?? 'Latihan Soal' }}</h1>
            </div>
            
            <a href="{{ route('index.soal')}}" class="px-4 py-2 bg-gray-100 text-gray-600 rounded-lg text-sm font-bold hover:bg-gray-200 transition flex items-center gap-2">
                <i class="fas fa-arrow-left"></i> Kembali
            </a>
        </div>

        <div class="space-y-6">
            @forelse ($mapel as $index => $soal)
                <div class="bg-white rounded-2xl shadow-md border border-gray-100 overflow-hidden hover:shadow-lg transition-shadow duration-300">
                    
                    <div class="bg-gray-50/50 px-6 py-5 border-b border-gray-100 flex items-start gap-4">
                        <span class="shrink-0 w-8 h-8 flex items-center justify-center bg-gray-800 text-[#ffc800] font-bold rounded-lg text-sm shadow-sm">
                            {{ $index + 1 }}
                        </span>

                        <div class="prose text-gray-800 font-medium text-base leading-relaxed w-full">
                            {!! $soal->pertanyaan !!}
                        </div>
                    </div>

                    <div class="p-6">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            
                            <div class="flex items-start gap-3 p-3 rounded-xl border border-gray-100 bg-white hover:border-[#ffc800]/50 hover:bg-yellow-50/30 transition group">
                                <span class="shrink-0 w-6 h-6 flex items-center justify-center rounded-full bg-gray-100 text-gray-500 text-xs font-bold group-hover:bg-[#ffc800] group-hover:text-white transition">A</span>
                                <div class="text-sm text-gray-600 group-hover:text-gray-900 answer-content w-full">
                                    {!! $soal->a !!}
                                </div>
                            </div>

                            <div class="flex items-start gap-3 p-3 rounded-xl border border-gray-100 bg-white hover:border-[#ffc800]/50 hover:bg-yellow-50/30 transition group">
                                <span class="shrink-0 w-6 h-6 flex items-center justify-center rounded-full bg-gray-100 text-gray-500 text-xs font-bold group-hover:bg-[#ffc800] group-hover:text-white transition">B</span>
                                <div class="text-sm text-gray-600 group-hover:text-gray-900 answer-content w-full">
                                    {!! $soal->b !!}
                                </div>
                            </div>

                            <div class="flex items-start gap-3 p-3 rounded-xl border border-gray-100 bg-white hover:border-[#ffc800]/50 hover:bg-yellow-50/30 transition group">
                                <span class="shrink-0 w-6 h-6 flex items-center justify-center rounded-full bg-gray-100 text-gray-500 text-xs font-bold group-hover:bg-[#ffc800] group-hover:text-white transition">C</span>
                                <div class="text-sm text-gray-600 group-hover:text-gray-900 answer-content w-full">
                                    {!! $soal->c !!}
                                </div>
                            </div>

                            <div class="flex items-start gap-3 p-3 rounded-xl border border-gray-100 bg-white hover:border-[#ffc800]/50 hover:bg-yellow-50/30 transition group">
                                <span class="shrink-0 w-6 h-6 flex items-center justify-center rounded-full bg-gray-100 text-gray-500 text-xs font-bold group-hover:bg-[#ffc800] group-hover:text-white transition">D</span>
                                <div class="text-sm text-gray-600 group-hover:text-gray-900 answer-content w-full">
                                    {!! $soal->d !!}
                                </div>
                            </div>

                        </div>
                    </div>

                </div>
            @empty
                <div class="text-center py-12 bg-white rounded-2xl shadow-sm">
                    <p class="text-gray-500">Belum ada soal untuk mata pelajaran ini.</p>
                </div>
            @endforelse
        </div>
    </div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        const appUrl = "{{ url('/') }}"; 
        
        const contentImages = document.querySelectorAll('.prose img, .answer-content img');
        
        contentImages.forEach(img => {
            let src = img.getAttribute('src');

            if (src && !src.startsWith('http') && !src.startsWith('/') && !src.startsWith('data:')) {
                img.src = appUrl + '/' + src;
            }
        });
    });
</script>

@endsection