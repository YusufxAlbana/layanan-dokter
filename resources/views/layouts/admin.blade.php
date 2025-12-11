<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Dashboard') | Klinik Gigi Sehat</title>

    <!-- Favicon -->
    <link rel="icon" type="image/png" href="{{ asset('favicon.png') }}?v={{ time() }}">
    <link rel="apple-touch-icon" href="{{ asset('favicon.png') }}?v={{ time() }}">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap"
        rel="stylesheet">

    <!-- TailwindCSS -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Alpine.js -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <!-- Lucide Icons -->
    <script src="https://unpkg.com/lucide@latest/dist/umd/lucide.min.js"></script>

    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
        }
    </style>

    @stack('styles')
</head>

<body class="bg-slate-100 text-slate-800 antialiased" x-data="{ sidebarOpen: true, mobileMenuOpen: false }">
    <div class="flex h-screen overflow-hidden">

        <!-- Sidebar -->
        <aside :class="sidebarOpen ? 'w-64' : 'w-20'"
            class="hidden lg:flex flex-col bg-gradient-to-b from-slate-900 to-slate-800 text-white transition-all duration-300 ease-in-out">
            <!-- Logo -->
            <div class="flex items-center justify-between h-16 px-4 border-b border-slate-700">
                <a href="/" class="flex items-center space-x-3">
                    <div
                        class="w-10 h-10 bg-gradient-to-br from-sky-400 to-emerald-400 rounded-xl flex items-center justify-center">
                        <i data-lucide="heart-pulse" class="w-6 h-6 text-white"></i>
                    </div>
                    <span x-show="sidebarOpen" x-transition class="font-bold text-lg">Klinik Admin</span>
                </a>
                <button @click="sidebarOpen = !sidebarOpen" class="p-1.5 rounded-lg hover:bg-slate-700 transition">
                    <i data-lucide="chevron-left" class="w-5 h-5" :class="!sidebarOpen && 'rotate-180'"></i>
                </button>
            </div>

            <!-- Navigation -->
            <nav class="flex-1 px-3 py-4 space-y-1 overflow-y-auto">
                <!-- Dashboard -->
                <a href="{{ url('/admin') }}"
                    class="flex items-center px-3 py-2.5 rounded-xl bg-sky-500/20 text-sky-400 group">
                    <i data-lucide="layout-dashboard" class="w-5 h-5 flex-shrink-0"></i>
                    <span x-show="sidebarOpen" x-transition class="ml-3 font-medium">Dashboard</span>
                </a>

                <!-- Pasien -->
                <a href="{{ url('/admin/patients') }}"
                    class="flex items-center px-3 py-2.5 rounded-xl text-slate-300 hover:bg-slate-700/50 hover:text-white transition group">
                    <i data-lucide="users" class="w-5 h-5 flex-shrink-0"></i>
                    <span x-show="sidebarOpen" x-transition class="ml-3 font-medium">Data Pasien</span>
                </a>

                <!-- Dokter -->
                <a href="{{ url('/admin/doctors') }}"
                    class="flex items-center px-3 py-2.5 rounded-xl text-slate-300 hover:bg-slate-700/50 hover:text-white transition group">
                    <i data-lucide="stethoscope" class="w-5 h-5 flex-shrink-0"></i>
                    <span x-show="sidebarOpen" x-transition class="ml-3 font-medium">Data Dokter</span>
                </a>

                <!-- Janji Temu -->
                <a href="{{ url('/admin/appointments') }}"
                    class="flex items-center px-3 py-2.5 rounded-xl text-slate-300 hover:bg-slate-700/50 hover:text-white transition group">
                    <i data-lucide="calendar-check" class="w-5 h-5 flex-shrink-0"></i>
                    <span x-show="sidebarOpen" x-transition class="ml-3 font-medium">Janji Temu</span>
                </a>

                <!-- Rekam Medis -->
                <a href="{{ url('/admin/medical-records') }}"
                    class="flex items-center px-3 py-2.5 rounded-xl text-slate-300 hover:bg-slate-700/50 hover:text-white transition group">
                    <i data-lucide="file-text" class="w-5 h-5 flex-shrink-0"></i>
                    <span x-show="sidebarOpen" x-transition class="ml-3 font-medium">Rekam Medis</span>
                </a>

                <!-- Feedback -->
                <a href="{{ url('/admin/feedbacks') }}"
                    class="flex items-center px-3 py-2.5 rounded-xl text-slate-300 hover:bg-slate-700/50 hover:text-white transition group">
                    <i data-lucide="message-square" class="w-5 h-5 flex-shrink-0"></i>
                    <span x-show="sidebarOpen" x-transition class="ml-3 font-medium">Feedback</span>
                </a>

                <div class="pt-4 mt-4 border-t border-slate-700">
                    <p x-show="sidebarOpen"
                        class="px-3 text-xs font-semibold text-slate-500 uppercase tracking-wider mb-2">Pengaturan</p>

                    <!-- Settings -->
                    <a href="#"
                        class="flex items-center px-3 py-2.5 rounded-xl text-slate-300 hover:bg-slate-700/50 hover:text-white transition group">
                        <i data-lucide="settings" class="w-5 h-5 flex-shrink-0"></i>
                        <span x-show="sidebarOpen" x-transition class="ml-3 font-medium">Pengaturan</span>
                    </a>
                </div>
            </nav>

            <!-- User Info -->
            <div class="p-4 border-t border-slate-700">
                <div class="flex items-center space-x-3">
                    <div
                        class="w-10 h-10 bg-gradient-to-br from-sky-400 to-emerald-400 rounded-full flex items-center justify-center">
                        <span class="text-white font-bold">A</span>
                    </div>
                    <div x-show="sidebarOpen" x-transition>
                        <p class="font-medium text-sm">Admin User</p>
                        <p class="text-xs text-slate-400">admin@klinik.com</p>
                    </div>
                </div>
            </div>
        </aside>

        <!-- Mobile Sidebar -->
        <div x-show="mobileMenuOpen" x-transition:enter="transition ease-out duration-200"
            x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
            x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100"
            x-transition:leave-end="opacity-0" class="fixed inset-0 z-40 lg:hidden">
            <!-- Overlay -->
            <div class="fixed inset-0 bg-slate-900/50" @click="mobileMenuOpen = false"></div>

            <!-- Sidebar -->
            <aside class="fixed inset-y-0 left-0 w-64 bg-gradient-to-b from-slate-900 to-slate-800 text-white z-50">
                <!-- Logo -->
                <div class="flex items-center justify-between h-16 px-4 border-b border-slate-700">
                    <a href="/" class="flex items-center space-x-3">
                        <div
                            class="w-10 h-10 bg-gradient-to-br from-sky-400 to-emerald-400 rounded-xl flex items-center justify-center">
                            <i data-lucide="heart-pulse" class="w-6 h-6 text-white"></i>
                        </div>
                        <span class="font-bold text-lg">Klinik Admin</span>
                    </a>
                    <button @click="mobileMenuOpen = false" class="p-1.5 rounded-lg hover:bg-slate-700 transition">
                        <i data-lucide="x" class="w-5 h-5"></i>
                    </button>
                </div>

                <!-- Navigation -->
                <nav class="flex-1 px-3 py-4 space-y-1">
                    <a href="{{ url('/admin') }}"
                        class="flex items-center px-3 py-2.5 rounded-xl bg-sky-500/20 text-sky-400">
                        <i data-lucide="layout-dashboard" class="w-5 h-5"></i>
                        <span class="ml-3 font-medium">Dashboard</span>
                    </a>
                    <a href="{{ url('/admin/patients') }}"
                        class="flex items-center px-3 py-2.5 rounded-xl text-slate-300 hover:bg-slate-700/50">
                        <i data-lucide="users" class="w-5 h-5"></i>
                        <span class="ml-3 font-medium">Data Pasien</span>
                    </a>
                    <a href="{{ url('/admin/doctors') }}"
                        class="flex items-center px-3 py-2.5 rounded-xl text-slate-300 hover:bg-slate-700/50">
                        <i data-lucide="stethoscope" class="w-5 h-5"></i>
                        <span class="ml-3 font-medium">Data Dokter</span>
                    </a>
                    <a href="{{ url('/admin/appointments') }}"
                        class="flex items-center px-3 py-2.5 rounded-xl text-slate-300 hover:bg-slate-700/50">
                        <i data-lucide="calendar-check" class="w-5 h-5"></i>
                        <span class="ml-3 font-medium">Janji Temu</span>
                    </a>
                    <a href="{{ url('/admin/medical-records') }}"
                        class="flex items-center px-3 py-2.5 rounded-xl text-slate-300 hover:bg-slate-700/50">
                        <i data-lucide="file-text" class="w-5 h-5"></i>
                        <span class="ml-3 font-medium">Rekam Medis</span>
                    </a>
                </nav>
            </aside>
        </div>

        <!-- Main Content Area -->
        <div class="flex-1 flex flex-col overflow-hidden">
            <!-- Topbar -->
            <header
                class="bg-white shadow-sm border-b border-slate-200 h-16 flex items-center justify-between px-4 lg:px-6">
                <!-- Mobile menu button -->
                <button @click="mobileMenuOpen = true" class="lg:hidden p-2 rounded-lg hover:bg-slate-100 transition">
                    <i data-lucide="menu" class="w-5 h-5 text-slate-600"></i>
                </button>

                <!-- Page Title -->
                <h1 class="text-lg font-semibold text-slate-800">@yield('page-title', 'Dashboard')</h1>

                <!-- Right side -->
                <div class="flex items-center space-x-3">
                    <!-- Notifications -->
                    <button class="relative p-2 rounded-lg hover:bg-slate-100 transition">
                        <i data-lucide="bell" class="w-5 h-5 text-slate-600"></i>
                        <span class="absolute top-1 right-1 w-2 h-2 bg-red-500 rounded-full"></span>
                    </button>

                    <!-- User dropdown -->
                    <div x-data="{ open: false }" class="relative">
                        <button @click="open = !open"
                            class="flex items-center space-x-2 p-2 rounded-lg hover:bg-slate-100 transition">
                            <div
                                class="w-8 h-8 bg-gradient-to-br from-sky-400 to-emerald-400 rounded-full flex items-center justify-center">
                                <span class="text-white text-sm font-bold">A</span>
                            </div>
                            <i data-lucide="chevron-down" class="w-4 h-4 text-slate-500"></i>
                        </button>

                        <!-- Dropdown menu -->
                        <div x-show="open" @click.away="open = false" x-transition
                            class="absolute right-0 mt-2 w-48 bg-white rounded-xl shadow-lg border border-slate-200 py-1 z-50">
                            <a href="#" class="flex items-center px-4 py-2 text-sm text-slate-700 hover:bg-slate-100">
                                <i data-lucide="user" class="w-4 h-4 mr-2"></i>
                                Profil
                            </a>
                            <a href="#" class="flex items-center px-4 py-2 text-sm text-slate-700 hover:bg-slate-100">
                                <i data-lucide="settings" class="w-4 h-4 mr-2"></i>
                                Pengaturan
                            </a>
                            <hr class="my-1 border-slate-200">
                            <a href="{{ url('/') }}"
                                class="flex items-center px-4 py-2 text-sm text-red-600 hover:bg-red-50">
                                <i data-lucide="log-out" class="w-4 h-4 mr-2"></i>
                                Keluar
                            </a>
                        </div>
                    </div>
                </div>
            </header>

            <!-- Page Content -->
            <main class="flex-1 overflow-y-auto p-4 lg:p-6">
                @yield('content')
            </main>
        </div>
    </div>

    <!-- Initialize Lucide Icons -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            lucide.createIcons();
        });
    </script>

    @stack('scripts')
</body>

</html>