<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>{{ env('APP_NAME', 'ParcelPoint') }}</title>
  <link rel="shortcut icon" href="{{ url('Crovex/HTML/assets/images/ParcelPointLogoOnly.png') }}">

  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">

  <style>
    body {
      font-family: 'Plus Jakarta Sans', sans-serif;
    }
    @keyframes float {
      0%, 100% { transform: translateY(0); }
      50% { transform: translateY(-10px); }
    }
    .animated-logo {
      animation: float 3s ease-in-out infinite;
    }
  </style>
</head>
<body class="bg-blue-50/40 text-slate-800 antialiased min-h-screen flex flex-col justify-between relative">

  <nav class="bg-white/80 backdrop-blur-md sticky top-0 z-50 border-b border-blue-100 shadow-sm">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-20 flex items-center justify-between">
      <div class="flex items-center">
        <img src="{{ url('Crovex/HTML/assets/images/ParcelPointWithText.png') }}" alt="Logo ParcelPoint" class="h-10 w-auto object-contain">
      </div>

      <div class="flex items-center gap-6">
        <ul class="hidden md:flex items-center gap-6 text-sm font-medium text-slate-600">
          <li><a href="https://pcr.ac.id" target="_blank" class="hover:text-blue-600 transition">Politeknik Caltex Riau</a></li>
          <li><a href="https://portal.pcr.ac.id" target="_blank" class="hover:text-blue-600 transition">Layanan Lainnya</a></li>
        </ul>

        <div class="h-5 w-px bg-blue-100 hidden md:block"></div>

        @if(Auth::check())
          <a href="/dashboard" class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2.5 rounded-xl text-sm font-semibold shadow-md shadow-blue-200 transition duration-200 flex items-center gap-2">
            <span>Dashboard</span>
            <span class="bg-blue-500 px-2 py-0.5 rounded text-xs uppercase">{{ Auth::user()->name }}</span>
          </a>
        @else
          <a href="/login" class="bg-blue-900 hover:bg-blue-950 text-white px-6 py-2.5 rounded-xl text-sm font-semibold shadow-md shadow-blue-900/20 transition duration-200">
            Login
          </a>
        @endif
      </div>
    </div>
  </nav>

  <main class="flex-grow flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-4xl w-full text-center space-y-8">

      <div class="flex justify-center">
        <div class="bg-white p-4 rounded-3xl shadow-xl shadow-blue-100/60 border border-blue-50 inline-block">
          <img src="{{ url('Crovex/HTML/assets/images/logoPCR.png') }}" alt="Logo PCR" class="h-20 sm:h-24 w-auto object-contain animated-logo">
        </div>
      </div>

      <div class="space-y-3">
        <span class="inline-block text-xs font-bold tracking-widest text-blue-600 uppercase bg-blue-50 px-3 py-1.5 rounded-full">
          #PenitipanPaketTanpaRibet
        </span>
        <h1 class="text-3xl sm:text-4xl lg:text-5xl font-extrabold text-slate-900 tracking-tight">
          Penitipan Surat & Paket Civitas PCR
        </h1>
        <p class="text-base sm:text-lg text-slate-600 max-w-2xl mx-auto leading-relaxed">
          Layanan manajemen dan pelacakan penitipan surat maupun paket yang disediakan khusus untuk seluruh sivitas akademika Politeknik Caltex Riau.
        </p>
      </div>

      <div class="grid md:grid-cols-2 gap-6 max-w-3xl mx-auto pt-4">

        <div class="bg-white p-5 sm:p-6 rounded-2xl shadow-xl shadow-blue-100/40 border border-blue-50 flex flex-col justify-between text-left space-y-4">
          <div>
            <h3 class="text-sm font-bold text-slate-900 flex items-center gap-2">
              <span class="p-1.5 bg-blue-50 text-blue-600 rounded-lg">📦</span>
              Lacak Nomor Resi
            </h3>
            <p class="text-xs text-slate-500 mt-1">Cari tahu status keberadaan paket Anda menggunakan nomor resmi.</p>
          </div>
          <form action="{{ url('/') }}" method="GET" class="flex gap-2 w-full">
            <input type="text" name="resi" value="{{ request('resi') }}" placeholder="Contoh: JP921021..." class="flex-1 min-w-0 bg-slate-50 border border-slate-200 text-sm rounded-xl px-4 py-3 text-slate-800 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition" required>
            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-semibold text-sm px-4 py-3 rounded-xl shadow-md shadow-blue-100 transition duration-150 shrink-0">
              Cari Resi
            </button>
          </form>
        </div>

        <div class="bg-white p-5 sm:p-6 rounded-2xl shadow-xl shadow-blue-100/40 border border-blue-50 flex flex-col justify-between text-left space-y-4">
          <div>
            <h3 class="text-sm font-bold text-slate-900 flex items-center gap-2">
              <span class="p-1.5 bg-sky-50 text-sky-600 rounded-lg">👤</span>
              Cari Nama Pemilik
            </h3>
            <p class="text-xs text-slate-500 mt-1">Gunakan nama mahasiswa/pegawai untuk mengecek paket.</p>
          </div>
          <form action="{{ url('/') }}" method="GET" class="flex gap-2 w-full">
            <input type="text" name="owner" value="{{ request('owner') }}" placeholder="Contoh: Budi Santoso..." class="flex-1 min-w-0 bg-slate-50 border border-slate-200 text-sm rounded-xl px-4 py-3 text-slate-800 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition" required>
            <button type="submit" class="bg-blue-800 hover:bg-blue-900 text-white font-semibold text-sm px-4 py-3 rounded-xl shadow-md shadow-blue-900/10 transition duration-150 shrink-0">
              Cari Nama
            </button>
          </form>
        </div>

      </div>

      @if(request()->has('resi') || request()->has('owner'))

        @if(isset($paket) && $paket)
          <div class="max-w-3xl mx-auto mt-8 text-left">
            <div class="bg-white rounded-2xl shadow-xl shadow-blue-100/50 border border-blue-50 overflow-hidden">

              <div class="bg-gradient-to-r from-blue-600 to-blue-800 px-6 py-4 flex justify-between items-center text-white">
                <div class="flex items-center gap-2">
                  <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                  </svg>
                  <span class="font-bold text-sm tracking-wide uppercase">Hasil Pencarian Paket</span>
                </div>
                <span class="text-xs bg-white/20 px-3 py-1 rounded-full font-medium backdrop-blur-sm">
                  {{ date('d M Y') }}
                </span>
              </div>

              <div class="p-6 grid sm:grid-cols-2 gap-6 bg-slate-50/50">
                <div class="space-y-4">
                  <div>
                    <label class="text-xs font-semibold text-slate-400 uppercase tracking-wider block">Nomor Resi</label>
                    <p class="text-base font-bold text-blue-600 mt-0.5">{{ $paket->resi ?? $paket->no_resi ?? '-' }}</p>
                  </div>
                  <div>
                    <label class="text-xs font-semibold text-slate-400 uppercase tracking-wider block">Nama Pemilik / Penerima</label>
                    <p class="text-base font-bold text-slate-800 mt-0.5">{{ $paket->owner ?? $paket->nama_pemilik ?? '-' }}</p>
                  </div>
                  <div>
                    <label class="text-xs font-semibold text-slate-400 uppercase tracking-wider block">Keterangan Barang</label>
                    <p class="text-sm text-slate-600 mt-0.5">{{ $paket->keterangan ?? $paket->deskripsi ?? 'Tidak ada keterangan tambahan' }}</p>
                  </div>
                </div>

                <div class="space-y-4 border-t sm:border-t-0 sm:border-l border-slate-200 sm:pl-6 flex flex-col justify-between">
                  <div>
                    <label class="text-xs font-semibold text-slate-400 uppercase tracking-wider block">Status Paket Saat Ini</label>
                    @php
                      $status = strtolower($paket->status ?? 'belum diambil');
                      $badgeClass = 'bg-blue-50 text-blue-700 border-blue-200';
                      if($status == 'diambil' || $status == 'success' || $status == 'selesai') {
                          $badgeClass = 'bg-emerald-50 text-emerald-700 border-emerald-200';
                      } elseif($status == 'pending' || $status == 'menunggu') {
                          $badgeClass = 'bg-amber-50 text-amber-700 border-amber-200';
                      }
                    @endphp
                    <span class="inline-flex items-center px-3 py-1 mt-1.5 rounded-full text-xs font-bold uppercase border {{ $badgeClass }}">
                      ● {{ $paket->status ?? 'Belum Diambil' }}
                    </span>
                  </div>
                  <div>
                    <label class="text-xs font-semibold text-slate-400 uppercase tracking-wider block">Posisi / Lokasi Penyimpanan</label>
                    <p class="text-sm font-semibold text-slate-700 mt-0.5">
                      📍 {{ $paket->lokasi ?? $paket->rak ?? 'Loket Utama PCR' }}
                    </p>
                  </div>
                  <div class="pt-2 text-xs text-slate-400 italic">
                    *Silakan ambil paket Anda dengan membawa bukti identitas/KTM yang sah ke loket.
                  </div>
                </div>
              </div>

            </div>
          </div>

        @else
          <div class="max-w-3xl mx-auto mt-8 text-left">
            <div class="bg-white rounded-2xl shadow-xl shadow-rose-100/50 border border-rose-100 overflow-hidden">

              <div class="bg-gradient-to-r from-rose-600 to-red-700 px-6 py-4 flex justify-between items-center text-white">
                <div class="flex items-center gap-2">
                  <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
                  </svg>
                  <span class="font-bold text-sm tracking-wide uppercase">Data Tidak Ditemukan</span>
                </div>
                <span class="text-xs bg-white/20 px-3 py-1 rounded-full font-medium backdrop-blur-sm">
                  {{ date('d M Y') }}
                </span>
              </div>

              <div class="p-6 grid sm:grid-cols-2 gap-6 bg-rose-50/30">
                <div class="space-y-4">
                  <div>
                    <label class="text-xs font-semibold text-rose-400 uppercase tracking-wider block">Status Pencarian</label>
                    <p class="text-base font-bold text-rose-600 mt-0.5">Gagal / Kosong</p>
                  </div>
                  <div>
                    <label class="text-xs font-semibold text-slate-400 uppercase tracking-wider block">Keterangan Sistem</label>
                    <p class="text-sm font-medium text-slate-700 mt-0.5">
                      Data dengan kata kunci "{{ request('resi') ?? request('owner') }}" tidak terdaftar dalam database paket aktif saat ini.
                    </p>
                  </div>
                </div>

                <div class="space-y-4 border-t sm:border-t-0 sm:border-l border-rose-100 sm:pl-6 flex flex-col justify-between">
                  <div>
                    <label class="text-xs font-semibold text-slate-400 uppercase tracking-wider block">Rekomendasi Tindakan</label>
                    <ul class="text-xs text-slate-600 list-disc list-inside space-y-1 mt-1.5 mb-3">
                      <li>Pastikan penulisan nama atau nomor resi sudah benar.</li>
                      <li>Hubungi petugas loket jika merasa paket sudah tiba di PCR.</li>
                    </ul>

                    <a href="https://wa.me/6281234567890?text=Halo%20Admin%20ParcelPoint%20PCR,%20saya%20ingin%20bertanya%20mengenai%20paket%20saya%20yang%20tidak%20ditemukan..."
                       target="_blank"
                       class="inline-flex items-center gap-2 bg-emerald-600 hover:bg-emerald-700 text-white text-xs font-bold px-3 py-2 rounded-xl transition shadow-md shadow-emerald-600/10">
                      <svg class="h-4 w-4 fill-current" viewBox="0 0 24 24">
                        <path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946C.06 5.348 5.397.01 12.008.01c3.202.001 6.212 1.246 8.477 3.514 2.266 2.268 3.507 5.28 3.505 8.484-.004 6.657-5.34 11.997-11.953 11.997-2.005-.001-3.973-.502-5.713-1.457L0 24zm6.59-4.846c1.6.95 3.188 1.449 4.825 1.451 5.436 0 9.86-4.42 9.863-9.864.001-2.636-1.023-5.115-2.884-6.978C16.573 1.843 14.1 1.816 12.012 1.816c-5.44 0-9.866 4.418-9.87 9.864 0 1.696.442 3.354 1.279 4.8l-.29 1.057 1.08-.284z"/>
                      </svg>
                      Hubungi Admin via WA
                    </a>
                  </div>

                  <div class="pt-2 text-xs text-rose-500 font-medium">
                    ⚠️ Sistem tidak mendeteksi data aktif.
                  </div>
                </div>
              </div>

            </div>
          </div>
        @endif

      @endif

    </div>
  </main>

  <a href="https://wa.me/6281234567890?text=Halo%20Admin%20ParcelPoint%20PCR..."
     target="_blank"
     class="fixed bottom-6 right-6 z-50 bg-emerald-500 hover:bg-emerald-600 text-white p-4 rounded-full shadow-2xl flex items-center justify-center transition-all transform hover:scale-110 group"
     title="Hubungi Admin WhatsApp">
    <svg class="h-6 w-6 fill-current" viewBox="0 0 24 24">
      <path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946C.06 5.348 5.397.01 12.008.01c3.202.001 6.212 1.246 8.477 3.514 2.266 2.268 3.507 5.28 3.505 8.484-.004 6.657-5.34 11.997-11.953 11.997-2.005-.001-3.973-.502-5.713-1.457L0 24zm6.59-4.846c1.6.95 3.188 1.449 4.825 1.451 5.436 0 9.86-4.42 9.863-9.864.001-2.636-1.023-5.115-2.884-6.978C16.573 1.843 14.1 1.816 12.012 1.816c-5.44 0-9.866 4.418-9.87 9.864 0 1.696.442 3.354 1.279 4.8l-.29 1.057 1.08-.284zM16.49 14.54c-.24-.12-1.42-.7-1.64-.78-.22-.08-.38-.12-.54.12-.16.24-.62.78-.76.94-.14.16-.28.18-.52.06-1.52-.76-2.52-1.34-3.52-3.06-.26-.46.26-.43.76-1.43.08-.16.04-.3-.02-.42-.06-.12-.54-1.3-.74-1.78-.2-.48-.4-.4-.54-.4h-.46c-.16 0-.42.06-.64.3-.22.24-.84.82-.84 2 0 1.18.86 2.32.98 2.48.12.16 1.7 2.6 4.12 3.64 1.42.6 2.26.8 3.06.72.8-.08 2.46-.96 2.8-1.9.34-.94.34-1.74.24-1.9-.1-.16-.24-.26-.48-.38z"/>
    </svg>
    <span class="absolute right-14 bg-slate-900 text-white text-xs px-3 py-1.5 rounded-xl opacity-0 group-hover:opacity-100 transition whitespace-nowrap shadow-md pointer-events-none">
      Butuh Bantuan? Chat Admin
    </span>
  </a>

  <footer class="bg-white border-t border-blue-50 py-6 text-center text-xs text-slate-400">
    <div class="max-w-7xl mx-auto px-4 flex flex-col sm:flex-row items-center justify-between gap-2">
      <p>&copy; {{ date('Y') }} {{ env('APP_NAME', 'ParcelPoint') }}. Politeknik Caltex Riau.</p>
      <div class="flex gap-4">
        <a href="https://pcr.ac.id" target="_blank" class="hover:underline hover:text-blue-600">Website PCR</a>
        <a href="https://portal.pcr.ac.id" target="_blank" class="hover:underline hover:text-blue-600">Portal Layanan</a>
      </div>
    </div>
  </footer>

</body>
</html>
