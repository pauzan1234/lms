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
  <aside :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full lg:translate-x-0'"
    class="fixed lg:sticky top-0 left-0 h-screen w-72 shrink-0 bg-ink text-paper z-40 flex flex-col transition-transform duration-200">
@include('partials.admin.sidebar')
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
            <p class="text-sm font-medium">{{ Auth::user()->name }}</p>
            <p class="text-xs text-ink/45">{{ Auth::user()->role }}</p>
          </div>
        </div>
      </div>
    </header>

    <!-- Konten -->
    <main class="flex-1 p-5 lg:p-8">

            <div class="mb-7">
        <p class="text-sm text-ink/50 font-mono">Dashboard</p>
        <h1 class="font-display text-2xl lg:text-3xl font-semibold tracking-tight mt-1">Ringkasan E-Learning UNWIR</h1>
      </div>

      <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-6">

        <div class="bg-white border border-line rounded-2xl p-6">
          <div class="flex items-center justify-between">
            <div class="w-11 h-11 rounded-lg bg-teal/10 flex items-center justify-center">
              <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#2563EB" stroke-width="1.8"><path d="M4 19.5A2.5 2.5 0 016.5 17H20"/><path d="M6.5 2H20v20H6.5A2.5 2.5 0 014 19.5v-15A2.5 2.5 0 016.5 2z"/></svg>
            </div>
            <span class="text-xs font-mono px-2 py-1 rounded-full bg-teal/10 text-teal">Ganjil 2025/2026</span>
          </div>
          <p class="font-display text-3xl font-semibold mt-5">150+</p>
          <p class="text-sm text-ink/55 mt-1">Mata Kuliah Aktif</p>
        </div>

        <div class="bg-white border border-line rounded-2xl p-6">
          <div class="flex items-center justify-between">
            <div class="w-11 h-11 rounded-lg bg-coral/10 flex items-center justify-center">
              <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#1D4ED8" stroke-width="1.8"><path d="M20 21v-2a4 4 0 00-3-3.87"/><path d="M14 3.13a4 4 0 010 7.75"/><circle cx="9" cy="7" r="4"/><path d="M2 21v-2a4 4 0 013-3.87"/></svg>
            </div>
            <span class="text-xs font-mono px-2 py-1 rounded-full bg-coral/10 text-coral">6 Fakultas</span>
          </div>
          <p class="font-display text-3xl font-semibold mt-5">450+</p>
          <p class="text-sm text-ink/55 mt-1">Dosen Pengajar</p>
        </div>

        <div class="bg-white border border-line rounded-2xl p-6">
          <div class="flex items-center justify-between">
            <div class="w-11 h-11 rounded-lg bg-amber/15 flex items-center justify-center">
              <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#0F2A4D" stroke-width="1.8"><path d="M22 10v6M2 10l10-5 10 5-10 5-10-5z"/><path d="M6 12v5c0 1.66 2.69 3 6 3s6-1.34 6-3v-5"/></svg>
            </div>
            <span class="text-xs font-mono px-2 py-1 rounded-full bg-amber/15 text-ink">Aktif</span>
          </div>
          <p class="font-display text-3xl font-semibold mt-5">12.000+</p>
          <p class="text-sm text-ink/55 mt-1">Mahasiswa Terdaftar</p>
        </div>

      </div>

    </main>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
</body>
</html>