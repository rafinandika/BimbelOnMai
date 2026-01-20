@extends('tryout.index')

@section('content')

<style>
    /* Styling Pilihan Ganda Custom */
    .custom-radio:checked + div {
        background-color: #fefce8; /* Yellow-50 */
        border-color: #ffc800;
        box-shadow: 0 0 0 1px #ffc800 inset;
    }
    .custom-radio:checked + div .radio-dot {
        background-color: #ffc800;
        border-color: #ffc800;
        color: white;
    }
    
    /* FIX: Agar gambar di dalam soal tidak berantakan/turun */
    .soal-content img, .jawaban-content img {
        display: inline-block !important;
        vertical-align: middle;
        max-width: 100%;
        height: auto;
        margin: 5px 0;
        border-radius: 6px;
    }
    .soal-content p {
        display: inline-block;
        margin-bottom: 0.5rem;
    }
</style>

<div class="min-h-screen pb-12">
    
    <div class="bg-gray-900 text-white p-4 rounded-xl shadow-lg mb-6 flex flex-col md:flex-row justify-between items-center sticky top-20 z-40 border-b-4 border-[#ffc800]">
        <div class="mb-2 md:mb-0">
            <h2 class="text-lg font-bold font-heading">{{ $ujian->nama_ujian }}</h2>
            <p class="text-xs text-gray-400">{{ $ujian->mapel }} | Kelas {{ $ujian->kelas }}</p>
        </div>
        <div class="text-center md:text-right flex items-center gap-4">
            <div id="warning-badge" class="hidden px-3 py-1 bg-red-600 rounded text-xs font-bold animate-pulse">
                PERINGATAN: <span id="warning-count">0</span>/3
            </div>

            <div>
                <span class="block text-[10px] text-gray-400 uppercase tracking-widest font-bold">Sisa Waktu</span>
                <span id="countdown-timer" class="text-2xl font-mono font-bold text-[#ffc800] tracking-wider">--:--:--</span>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

        <div class="lg:col-span-2 animate-[fadeIn_0.5s_ease-out]">
            <div class="bg-white rounded-2xl shadow-lg border border-gray-100 overflow-hidden relative">
                
                <div class="bg-gray-50 px-6 py-4 border-b border-gray-200 flex justify-between items-center">
                    <span class="bg-gray-800 text-white text-xs font-bold px-3 py-1 rounded-full shadow-sm">
                        Soal No. {{ $index + 1 }}
                    </span>
                    <span class="text-xs text-gray-500 font-medium">
                        Total: {{ count($soal_list) }} soal
                    </span>
                </div>

                <div class="p-6 md:p-8">
                    <div class="soal-content text-gray-800 text-lg font-medium leading-relaxed mb-8 prose max-w-none">
                        {!! $soal->pertanyaan !!}
                    </div>

                    <form method="POST" action="{{ route('tryout.jawab') }}" id="form-ujian">
                        @csrf
                        <input type="hidden" name="ujian_id" value="{{ $ujian->id }}">
                        <input type="hidden" name="soal_id" value="{{ $soal->id }}">
                        <input type="hidden" name="index" value="{{ $index }}">

                        <div class="space-y-4">
                            @php
                                $opsi = [
                                    'A' => $soal->opsi_a ?? $soal->a,
                                    'B' => $soal->opsi_b ?? $soal->b,
                                    'C' => $soal->opsi_c ?? $soal->c,
                                    'D' => $soal->opsi_d ?? $soal->d,
                                ];
                            @endphp

                            @foreach($opsi as $key => $value)
                                @if(!empty($value))
                                <label class="cursor-pointer block group">
                                    <input type="radio" name="jawaban" value="{{ $key }}" class="hidden custom-radio"
                                        {{ ($jawaban_user && $jawaban_user->jawaban === $key) ? 'checked' : '' }} 
                                        onchange="this.form.submit()">
                                    
                                    <div class="flex items-start gap-4 p-4 rounded-xl border border-gray-200 hover:border-[#ffc800] hover:bg-yellow-50/50 transition-all duration-200">
                                        <div class="radio-dot w-8 h-8 rounded-lg bg-gray-100 border border-gray-300 flex items-center justify-center shrink-0 text-sm font-bold text-gray-500 transition-colors group-hover:bg-[#ffc800] group-hover:text-white group-hover:border-[#ffc800]">
                                            {{ $key }}
                                        </div>
                                        <div class="jawaban-content text-gray-700 text-sm md:text-base prose max-w-none pt-1">
                                            {!! $value !!}
                                        </div>
                                    </div>
                                </label>
                                @endif
                            @endforeach
                        </div>

                        <div class="flex justify-between items-center mt-8 pt-6 border-t border-gray-100">
                            @if($index > 0)
                                <button type="submit" name="prev" class="px-5 py-2.5 bg-gray-100 text-gray-600 rounded-lg font-bold hover:bg-gray-200 transition text-sm flex items-center gap-2">
                                    <i class="fas fa-chevron-left"></i> Sebelumnya
                                </button>
                            @else
                                <button disabled class="px-5 py-2.5 bg-gray-50 text-gray-300 rounded-lg font-bold text-sm cursor-not-allowed flex items-center gap-2">
                                    <i class="fas fa-chevron-left"></i> Sebelumnya
                                </button>
                            @endif

                            @if($index < count($soal_list) - 1)
                                <button type="submit" name="next" class="px-5 py-2.5 bg-[#ffc800] text-white rounded-lg font-bold shadow-md hover:bg-yellow-500 hover:shadow-lg transition text-sm flex items-center gap-2">
                                    Selanjutnya <i class="fas fa-chevron-right"></i>
                                </button>
                            @else
                                <button type="button" class="px-6 py-2.5 bg-green-600 text-white rounded-lg font-bold shadow-md hover:bg-green-700 transition text-sm flex items-center gap-2" onclick="confirmFinish()">
                                    Selesai <i class="fas fa-check"></i>
                                </button>
                            @endif
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="lg:col-span-1">
            <div class="sticky top-40 space-y-6">
                <div class="bg-white rounded-2xl shadow-lg border border-gray-100 p-6">
                    <h3 class="text-sm font-bold text-gray-800 uppercase tracking-wide mb-4 border-b border-gray-100 pb-2">Navigasi Soal</h3>
                    <div class="grid grid-cols-5 gap-2">
                        @foreach($soal_list as $i => $s)
                            @php
                                $sudah_dijawab = isset($jawaban_all[$s->id]);
                                $is_active = $i == $index;
                                $bgClass = $is_active 
                                    ? 'bg-[#ffc800] text-white border-[#ffc800] ring-2 ring-yellow-200 font-extrabold scale-110 shadow-md' 
                                    : ($sudah_dijawab 
                                        ? 'bg-green-500 text-white border-green-500 hover:bg-green-600' 
                                        : 'bg-white text-gray-500 border-gray-200 hover:border-gray-400 hover:bg-gray-50');
                            @endphp
                            <a href="{{ route('tryout.kerjakan', ['ujian' => $ujian->id, 'index' => $i]) }}"
                               class="w-full aspect-square flex items-center justify-center rounded-lg border text-sm font-bold transition-all duration-200 {{ $bgClass }}">
                                {{ $i + 1 }}
                            </a>
                        @endforeach
                    </div>
                </div>

                <form method="POST" action="{{ route('tryout.selesai', $ujian->id) }}" id="form-selesai">
                    @csrf
                    <button type="submit" onclick="return confirm('Apakah Anda yakin ingin mengakhiri ujian ini? Jawaban tidak dapat diubah setelah ini.')" 
                        class="w-full py-3 bg-red-50 text-red-600 border border-red-100 rounded-xl font-bold hover:bg-red-600 hover:text-white transition-all duration-300 shadow-sm flex items-center justify-center gap-2 group">
                        <i class="fas fa-flag-checkered group-hover:scale-110 transition-transform"></i> AKHIRI UJIAN
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

<meta name="csrf-token" content="{{ csrf_token() }}">

<script>
    const resultUrl = "{{ route('tryout.hasil', $ujian->id) }}";

    // 1. LOGIKA TIMER
    const waktuSelesai = new Date("{{ $ujian->waktu_selesai }}").getTime();
    const timerInterval = setInterval(function() {
        const now = new Date().getTime();
        const distance = waktuSelesai - now;
        const hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
        const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
        const seconds = Math.floor((distance % (1000 * 60)) / 1000);
        const display = (hours < 10 ? "0" + hours : hours) + ":" + (minutes < 10 ? "0" + minutes : minutes) + ":" + (seconds < 10 ? "0" + seconds : seconds);
        const timerEl = document.getElementById("countdown-timer");
        
        if(timerEl) {
            timerEl.innerHTML = display;
            if(distance < 300000) { 
                timerEl.classList.remove('text-[#ffc800]');
                timerEl.classList.add('text-red-500', 'animate-ping');
            }
        }
        if (distance < 0) {
            clearInterval(timerInterval);
            alert("Waktu ujian telah habis!");
            document.getElementById('form-selesai').submit();
        }
    }, 1000);

    // 2. LOGIKA ANTI-CHEAT (PELANGGARAN)
    let warningCount = 0;
    const maxWarnings = 3;
    let isProcessing = false;

    // Fungsi Lapor Pelanggaran ke Server
    function reportViolation() {
        if (isProcessing) return;
        isProcessing = true;

        fetch("{{ route('ujian.pelanggaran') }}", {
            method: "POST",
            headers: {
                "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                "Content-Type": "application/json"
            },
            body: JSON.stringify({ ujian_id: {{ $ujian->id }} })
        })
        .then(res => res.json())
        .then(data => {
            isProcessing = false;
            warningCount = data.peringatan || warningCount + 1;

            // Update Badge Peringatan di Header
            const badge = document.getElementById('warning-badge');
            const countSpan = document.getElementById('warning-count');
            if(badge && countSpan) {
                badge.classList.remove('hidden');
                countSpan.innerText = warningCount;
            }

            if (data.status === 'selesai' || warningCount >= maxWarnings) {
                alert("PELANGGARAN BERAT!\n\nAnda telah meninggalkan halaman ujian sebanyak 3 kali.\nSistem otomatis menghentikan ujian Anda & menyimpan jawaban saat ini.");
                window.location.href = resultUrl; // Redirect paksa ke hasil
            } else {
                alert(`PERINGATAN (${warningCount}/3)!\n\nDilarang membuka tab lain atau minimize browser.\nJika mencapai 3 kali, ujian akan dihentikan otomatis.`);
            }
        })
        .catch(err => {
            isProcessing = false;
            console.error("Gagal lapor pelanggaran", err);
        });
    }

    // Event Listener: Pindah Tab / Minimize
    document.addEventListener("visibilitychange", function () {
        if (document.hidden) {
            reportViolation();
        }
    });

    // 3. LOGIKA TOMBOL BACK BROWSER -> KE HALAMAN HASIL
    // Memasukkan state palsu ke history agar tombol back tidak ke halaman sebelumnya
    history.pushState(null, null, location.href);
    
    // Saat tombol back ditekan (popstate event triggered)
    window.onpopstate = function () {
        // Mencegah user kembali ke soal
        history.pushState(null, null, location.href);
        
        // Konfirmasi sebelum lempar ke halaman hasil
        if(confirm("Apakah Anda ingin keluar dari ujian dan melihat hasil?\n\nMenekan tombol 'Back' dianggap mengakhiri ujian.")) {
             // Redirect ke halaman hasil
            window.location.href = resultUrl;
        }
    };

    // 4. KONFIRMASI TOMBOL SELESAI
    function confirmFinish() {
        if(confirm('Yakin ingin mengakhiri ujian? Pastikan semua jawaban sudah terisi.')) {
            document.getElementById('form-selesai').submit();
        }
    }

    // 5. FIX GAMBAR PATH
    document.addEventListener("DOMContentLoaded", function() {
        const appUrl = "{{ url('/') }}"; 
        document.querySelectorAll('.soal-content img, .jawaban-content img').forEach(img => {
            let src = img.getAttribute('src');
            if (src && !src.startsWith('http') && !src.startsWith('/') && !src.startsWith('data:')) {
                img.src = appUrl + '/' + src;
            }
        });
    });

</script>

@endsection