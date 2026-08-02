<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Dashboard — E-Learning UNWIR</title>
 @vite(['resources/css/app.css', 'resources/js/app.js'])
<script src="https://cdn.tailwindcss.com"></script>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Fraunces:ital,opsz,wght@0,9..144,500;0,9..144,600;0,9..144,700&family=Inter:wght@400;500;600;700;800&family=IBM+Plex+Mono:wght@400;500&display=swap" rel="stylesheet">
<script>
  tailwind.config = {
    theme: {
      extend: {
        colors: {
          ink: '#0F2A4D',
          paper: '#F5F8FC',
          amber: '#60A5FA',
          teal: '#2563EB',
          coral: '#1D4ED8',
          line: '#DCE6F5',
        },
        fontFamily: {
          display: ['Fraunces', 'serif'],
          sans: ['Inter', 'sans-serif'],
          mono: ['IBM Plex Mono', 'monospace'],
        },
      }
    }
  }
</script>
<style>
  body { background-color: #F5F8FC; }
  ::-webkit-scrollbar { width: 6px; height: 6px; }
  ::-webkit-scrollbar-thumb { background: #B9CDEE; border-radius: 999px; }
  ::-webkit-scrollbar-track { background: transparent; }
</style>
</head>
<body class="font-sans text-ink antialiased">

<div x-data="{ sidebarOpen: false, courseOpen: true }" class="min-h-screen flex">

  <!-- ============ OVERLAY (mobile) ============ -->
  <div x-show="sidebarOpen" x-cloak @click="sidebarOpen = false"
       class="fixed inset-0 bg-ink/40 z-30 lg:hidden"></div>

  <!-- ============ SIDEBAR ============ -->
  <aside
    :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full lg:translate-x-0'"
    class="fixed lg:sticky top-0 left-0 h-screen w-72 shrink-0 bg-ink text-paper z-40 flex flex-col transition-transform duration-200">

    <!-- Brand -->
    <div class="h-20 flex items-center gap-2.5 px-6 border-b border-white/10 shrink-0">
      <span class="w-9 h-9 rounded-lg bg-amber/20 border border-amber/30 flex items-center justify-center">
        <span class="text-amber font-display font-semibold text-lg">U</span>
      </span>
      <div class="leading-tight">
        <p class="font-display text-lg font-semibold tracking-tight">E-Learning</p>
        <p class="text-[11px] font-mono uppercase tracking-wider text-paper/40">Univ. Wiralodra</p>
      </div>
      <button @click="sidebarOpen = false" class="ml-auto lg:hidden text-paper/50 hover:text-paper">
        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M18 6L6 18M6 6l12 12"/></svg>
      </button>
    </div>

    <!-- Profil singkat -->
    <div class="px-6 py-5 border-b border-white/10 shrink-0">
      <div class="flex items-center gap-3">
        <img src="https://i.pravatar.cc/80?img=32" class="w-11 h-11 rounded-full object-cover border-2 border-white/10" alt="">
        <div class="min-w-0">
          <p class="text-sm font-medium truncate">Dinda Ayu Pratiwi</p>
          <p class="text-xs text-paper/45 truncate font-mono">2210631170045 · TI</p>
        </div>
      </div>
    </div>

    <!-- Navigasi utama + daftar isi kursus -->
    <nav class="flex-1 overflow-y-auto px-4 py-5 space-y-6">

      <div class="space-y-1">
        <a href="#" class="flex items-center gap-3 px-3 py-2.5 rounded-lg bg-white/10 text-paper text-sm font-medium">
          <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><rect x="3" y="3" width="7" height="9" rx="1.5"/><rect x="14" y="3" width="7" height="5" rx="1.5"/><rect x="14" y="12" width="7" height="9" rx="1.5"/><rect x="3" y="16" width="7" height="5" rx="1.5"/></svg>
          Dashboard
        </a>
        <a href="#" class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-paper/70 hover:bg-white/5 hover:text-paper text-sm font-medium transition-colors">
          <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M4 19.5A2.5 2.5 0 016.5 17H20"/><path d="M6.5 2H20v20H6.5A2.5 2.5 0 014 19.5v-15A2.5 2.5 0 016.5 2z"/></svg>
          Mata Kuliah Saya
        </a>
        <a href="#" class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-paper/70 hover:bg-white/5 hover:text-paper text-sm font-medium transition-colors">
          <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M9 11l3 3L22 4"/><path d="M21 12v7a2 2 0 01-2 2H5a2 2 0 01-2-2V5a2 2 0 012-2h11"/></svg>
          Tugas & Kuis
          <span class="ml-auto bg-coral text-white text-[11px] font-mono px-1.5 py-0.5 rounded-full">3</span>
        </a>
        <a href="#" class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-paper/70 hover:bg-white/5 hover:text-paper text-sm font-medium transition-colors">
          <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M3 3v18h18"/><path d="M7 15l4-6 3 4 5-8"/></svg>
          Nilai
        </a>
        <a href="#" class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-paper/70 hover:bg-white/5 hover:text-paper text-sm font-medium transition-colors">
          <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><rect x="3" y="4" width="18" height="16" rx="2"/><path d="M3 10h18M8 2v4M16 2v4"/></svg>
          Jadwal Kuliah
        </a>
        <a href="#" class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-paper/70 hover:bg-white/5 hover:text-paper text-sm font-medium transition-colors">
          <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M21 15a2 2 0 01-2 2H7l-4 4V5a2 2 0 012-2h14a2 2 0 012 2z"/></svg>
          Pesan
        </a>
      </div>

      <!-- Kursus yang sedang dibuka -->
      <div>
        <button @click="courseOpen = !courseOpen" class="w-full flex items-center gap-2 px-3 mb-2 text-[11px] font-mono uppercase tracking-wider text-paper/40">
          <span>Sedang Dibuka</span>
          <svg :class="courseOpen ? 'rotate-90' : ''" class="ml-auto transition-transform" width="12" height="12" viewBox="0 0 12 12" fill="none" stroke="currentColor" stroke-width="1.6"><path d="M4 2l4 4-4 4"/></svg>
        </button>

        <div x-show="courseOpen" x-cloak class="rounded-xl bg-white/5 border border-white/10 p-3">
          <p class="text-sm font-medium leading-snug">Pemrograman Web Lanjut</p>
          <p class="text-[11px] text-paper/40 font-mono mt-0.5 mb-3">TI · Semester 5 · 3 SKS</p>

          <ol class="space-y-0.5">
            <li>
              <a href="#" class="flex items-center gap-2.5 px-2 py-1.5 rounded-md text-paper/60 hover:bg-white/5 hover:text-paper text-[13px] transition-colors">
                <span class="w-4 h-4 rounded-full bg-teal/40 flex items-center justify-center shrink-0"><svg width="9" height="9" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="3"><path d="M20 6L9 17l-5-5"/></svg></span>
                Pengumuman Umum
              </a>
            </li>
            <li>
              <a href="#" class="flex items-center gap-2.5 px-2 py-1.5 rounded-md text-paper/60 hover:bg-white/5 hover:text-paper text-[13px] transition-colors">
                <span class="w-4 h-4 rounded-full bg-teal/40 flex items-center justify-center shrink-0"><svg width="9" height="9" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="3"><path d="M20 6L9 17l-5-5"/></svg></span>
                Pertemuan 1 — Pengantar REST API
              </a>
            </li>
            <li>
              <a href="#" class="flex items-center gap-2.5 px-2 py-1.5 rounded-md text-paper/60 hover:bg-white/5 hover:text-paper text-[13px] transition-colors">
                <span class="w-4 h-4 rounded-full bg-teal/40 flex items-center justify-center shrink-0"><svg width="9" height="9" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="3"><path d="M20 6L9 17l-5-5"/></svg></span>
                Pertemuan 2 — Autentikasi JWT
              </a>
            </li>
            <li>
              <a href="#" class="flex items-center gap-2.5 px-2 py-1.5 rounded-md bg-amber/15 text-paper text-[13px] font-medium">
                <span class="w-4 h-4 rounded-full border-2 border-amber flex items-center justify-center shrink-0"></span>
                Pertemuan 9 — Middleware & Validasi
              </a>
            </li>
            <li>
              <a href="#" class="flex items-center gap-2.5 px-2 py-1.5 rounded-md text-paper/40 hover:bg-white/5 hover:text-paper/70 text-[13px] transition-colors">
                <span class="w-4 h-4 rounded-full border border-white/20 shrink-0"></span>
                Pertemuan 10 — Testing API
              </a>
            </li>
            <li>
              <a href="#" class="flex items-center gap-2.5 px-2 py-1.5 rounded-md text-paper/40 hover:bg-white/5 hover:text-paper/70 text-[13px] transition-colors">
                <span class="w-4 h-4 rounded-full border border-white/20 shrink-0"></span>
                Pertemuan 11 — Deployment
              </a>
            </li>
          </ol>

          <div class="mt-3 pt-3 border-t border-white/10">
            <div class="flex items-center justify-between text-[11px] text-paper/40 mb-1.5 font-mono">
              <span>PROGRES</span><span>62%</span>
            </div>
            <div class="h-1.5 bg-white/10 rounded-full overflow-hidden">
              <div class="h-full bg-amber rounded-full" style="width:62%"></div>
            </div>
          </div>
        </div>
      </div>

    </nav>

    <!-- Bottom -->
    <div class="px-4 py-4 border-t border-white/10 shrink-0 space-y-1">
      <a href="#" class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-paper/70 hover:bg-white/5 hover:text-paper text-sm font-medium transition-colors">
        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><circle cx="12" cy="12" r="3"/><path d="M19.4 15a1.65 1.65 0 00.33 1.82l.06.06a2 2 0 11-2.83 2.83l-.06-.06a1.65 1.65 0 00-1.82-.33 1.65 1.65 0 00-1 1.51V21a2 2 0 01-4 0v-.09A1.65 1.65 0 009 19.4a1.65 1.65 0 00-1.82.33l-.06.06a2 2 0 11-2.83-2.83l.06-.06A1.65 1.65 0 004.6 15a1.65 1.65 0 00-1.51-1H3a2 2 0 010-4h.09A1.65 1.65 0 004.6 9a1.65 1.65 0 00-.33-1.82l-.06-.06a2 2 0 112.83-2.83l.06.06A1.65 1.65 0 009 4.6a1.65 1.65 0 001-1.51V3a2 2 0 014 0v.09a1.65 1.65 0 001 1.51 1.65 1.65 0 001.82-.33l.06-.06a2 2 0 112.83 2.83l-.06.06A1.65 1.65 0 0019.4 9c.36.15.68.4.9.72"/></svg>
        Pengaturan
      </a>
      <form action="#" method="POST">
        <button type="submit" class="w-full flex items-center gap-3 px-3 py-2.5 rounded-lg text-paper/70 hover:bg-white/5 hover:text-paper text-sm font-medium transition-colors">
          <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M9 21H5a2 2 0 01-2-2V5a2 2 0 012-2h4"/><path d="M16 17l5-5-5-5"/><path d="M21 12H9"/></svg>
          Keluar
        </button>
      </form>
    </div>
  </aside>

  <!-- ============ MAIN ============ -->
  <div class="flex-1 min-w-0 flex flex-col">

    <!-- Topbar -->
    <header class="h-20 bg-white border-b border-line flex items-center gap-4 px-5 lg:px-8 sticky top-0 z-20">
      <button @click="sidebarOpen = true" class="lg:hidden text-ink/60 hover:text-ink">
        <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M3 6h18M3 12h18M3 18h18"/></svg>
      </button>

      <div class="relative hidden sm:block w-full max-w-xs">
        <svg class="absolute left-3 top-1/2 -translate-y-1/2 text-ink/30" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><circle cx="11" cy="11" r="8"/><path d="M21 21l-4.3-4.3"/></svg>
        <input type="text" placeholder="Cari mata kuliah..." class="w-full pl-9 pr-3 py-2.5 rounded-lg bg-paper border border-line text-sm focus:outline-none focus:ring-2 focus:ring-teal/30 focus:border-teal">
      </div>

      <div class="ml-auto flex items-center gap-4">
        <button class="relative text-ink/50 hover:text-ink">
          <svg width="21" height="21" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M18 8a6 6 0 00-12 0c0 7-3 9-3 9h18s-3-2-3-9"/><path d="M13.73 21a2 2 0 01-3.46 0"/></svg>
          <span class="absolute -top-0.5 -right-0.5 w-2 h-2 rounded-full bg-coral"></span>
        </button>
        <div class="w-px h-6 bg-line hidden sm:block"></div>
        <div class="flex items-center gap-2.5">
          <img src="https://i.pravatar.cc/80?img=32" class="w-9 h-9 rounded-full object-cover" alt="">
          <div class="hidden sm:block leading-tight">
            <p class="text-sm font-medium">Dinda Ayu Pratiwi</p>
            <p class="text-xs text-ink/45">Mahasiswa</p>
          </div>
        </div>
      </div>
    </header>

    <!-- Konten -->
    <main class="flex-1 p-5 lg:p-8">

      <div class="mb-7">
        <p class="text-sm text-ink/50 font-mono">Pemrograman Web Lanjut / Pertemuan 9</p>
        <h1 class="font-display text-2xl lg:text-3xl font-semibold tracking-tight mt-1">Middleware & Validasi Request</h1>
      </div>

      <div class="grid lg:grid-cols-3 gap-6">
        <div class="lg:col-span-2 space-y-6">

          <div class="bg-white border border-line rounded-2xl p-6">
            <h2 class="font-display text-lg font-medium">Ringkasan Materi</h2>
            <p class="text-sm text-ink/60 leading-relaxed mt-3">
              Pada pertemuan ini mahasiswa mempelajari cara membuat middleware kustom di Laravel untuk memvalidasi request masuk sebelum mencapai controller, termasuk penanganan error terstruktur.
            </p>
            <div class="flex flex-wrap gap-3 mt-5">
              <a href="#" class="inline-flex items-center gap-2 text-sm font-medium bg-ink text-paper px-4 py-2.5 rounded-lg hover:bg-ink/90 transition-colors">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M14 2H6a2 2 0 00-2 2v16a2 2 0 002 2h12a2 2 0 002-2V8z"/><path d="M14 2v6h6"/></svg>
                Slide Pertemuan 9.pdf
              </a>
              <a href="#" class="inline-flex items-center gap-2 text-sm font-medium border border-line px-4 py-2.5 rounded-lg hover:border-ink/30 transition-colors">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M23 7l-7 5 7 5V7z"/><rect x="1" y="5" width="15" height="14" rx="2"/></svg>
                Video Rekaman Kelas
              </a>
            </div>
          </div>

          <div class="bg-white border border-line rounded-2xl p-6">
            <div class="flex items-center justify-between">
              <h2 class="font-display text-lg font-medium">Tugas Pertemuan 9</h2>
              <span class="text-xs font-mono px-2.5 py-1 rounded-full bg-coral/10 text-coral">Batas: 3 hari lagi</span>
            </div>
            <p class="text-sm text-ink/60 leading-relaxed mt-3">
              Buat middleware validasi untuk endpoint pendaftaran mata kuliah, lalu kumpulkan berupa repositori GitHub.
            </p>
            <a href="#" class="inline-flex items-center gap-1.5 text-sm font-medium text-teal mt-4 hover:gap-2.5 transition-all">
              Kumpulkan tugas
              <svg width="14" height="14" viewBox="0 0 14 14" fill="none"><path d="M1 7H13M13 7L7.5 1.5M13 7L7.5 12.5" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"/></svg>
            </a>
          </div>

        </div>

        <!-- Panel kanan: progres & pengumuman -->
        <div class="space-y-6">
          <div class="bg-white border border-line rounded-2xl p-6">
            <h3 class="font-display text-base font-medium">Progres Mata Kuliah</h3>
            <div class="mt-4 h-1.5 bg-line rounded-full overflow-hidden">
              <div class="h-full bg-teal rounded-full" style="width:62%"></div>
            </div>
            <p class="text-xs text-ink/50 mt-2">9 dari 16 pertemuan selesai</p>
          </div>

          <div class="bg-ink text-paper rounded-2xl p-6">
            <h3 class="font-display text-base font-medium">Pengumuman</h3>
            <p class="text-sm text-paper/70 leading-relaxed mt-3">UTS akan dilaksanakan daring pada 14 Oktober 2026 pukul 08.00 melalui menu Tugas & Kuis.</p>
            <p class="text-xs text-paper/40 mt-3 font-mono">2 hari lalu · Dosen Pengampu</p>
          </div>
        </div>
      </div>

    </main>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
</body>
</html>