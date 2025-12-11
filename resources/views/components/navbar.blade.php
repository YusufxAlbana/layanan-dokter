{{--
Navbar Component
----------------
Komponen navbar responsif untuk halaman publik.
Menggunakan Alpine.js untuk mobile menu toggle dan auth state.
--}}

<nav x-data="{ 
    mobileMenuOpen: false, 
    scrolled: false,
    isLoggedIn: false,
    currentUser: null,
    
    init() {
        const user = localStorage.getItem('klinik_current_user');
        if (user) {
            this.currentUser = JSON.parse(user);
            this.isLoggedIn = true;
        }
    },
    
    logout() {
        localStorage.removeItem('klinik_current_user');
        this.isLoggedIn = false;
        this.currentUser = null;
        window.location.reload();
    }
}" @scroll.window="scrolled = window.scrollY > 20"
    :class="scrolled ? 'bg-white/95 backdrop-blur-md shadow-lg' : 'bg-transparent'"
    class="fixed top-0 left-0 right-0 z-50 transition-all duration-300">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between h-20">

            {{-- Logo --}}
            <a href="{{ url('/') }}" class="flex items-center space-x-3 group">
                <img src="{{ asset('logo.png') }}" alt="Klinik Gigi Sehat"
                    class="w-12 h-12 object-contain group-hover:scale-105 transition-transform">
                <div>
                    <span class="block text-xl font-bold text-slate-800">Klinik Gigi</span>
                    <span class="block text-xs text-slate-500 font-medium">Sehat & Profesional</span>
                </div>
            </a>

            {{-- Desktop Navigation --}}
            <div class="hidden lg:flex items-center space-x-1">
                <a href="{{ url('/') }}"
                    class="px-4 py-2 rounded-xl text-slate-700 hover:text-sky-600 hover:bg-sky-50 font-medium transition">
                    Home
                </a>
                <a href="{{ url('/services') }}"
                    class="px-4 py-2 rounded-xl text-slate-700 hover:text-sky-600 hover:bg-sky-50 font-medium transition">
                    Layanan
                </a>
                <a href="{{ url('/doctors') }}"
                    class="px-4 py-2 rounded-xl text-slate-700 hover:text-sky-600 hover:bg-sky-50 font-medium transition">
                    Dokter
                </a>
                <a href="{{ url('/feedback') }}"
                    class="px-4 py-2 rounded-xl text-slate-700 hover:text-sky-600 hover:bg-sky-50 font-medium transition">
                    Feedback
                </a>
            </div>

            {{-- Auth & CTA Buttons --}}
            <div class="hidden lg:flex items-center space-x-3">
                {{-- Not Logged In --}}
                <template x-if="!isLoggedIn">
                    <div class="flex items-center space-x-3">
                        <a href="{{ url('/login') }}"
                            class="px-4 py-2 text-slate-700 hover:text-sky-600 font-medium transition">
                            Masuk
                        </a>
                        <a href="{{ url('/register') }}"
                            class="px-4 py-2 bg-slate-100 hover:bg-slate-200 text-slate-700 font-medium rounded-xl transition">
                            Daftar
                        </a>
                    </div>
                </template>

                {{-- Logged In --}}
                <template x-if="isLoggedIn">
                    <div class="flex items-center space-x-3" x-data="{ dropdownOpen: false }">
                        <div class="relative">
                            <button @click="dropdownOpen = !dropdownOpen"
                                class="flex items-center space-x-2 px-3 py-2 bg-slate-100 hover:bg-slate-200 rounded-xl transition">
                                <div
                                    class="w-8 h-8 bg-gradient-to-br from-sky-400 to-emerald-400 rounded-full flex items-center justify-center">
                                    <span class="text-white text-sm font-bold"
                                        x-text="currentUser?.name?.charAt(0).toUpperCase()"></span>
                                </div>
                                <span class="font-medium text-slate-700 max-w-[100px] truncate"
                                    x-text="currentUser?.name?.split(' ')[0]"></span>
                                <i data-lucide="chevron-down" class="w-4 h-4 text-slate-500"></i>
                            </button>

                            {{-- Dropdown --}}
                            <div x-show="dropdownOpen" @click.away="dropdownOpen = false" x-transition
                                class="absolute right-0 mt-2 w-48 bg-white rounded-xl shadow-lg border border-slate-200 py-1 z-50">
                                <div class="px-4 py-2 border-b border-slate-100">
                                    <p class="font-medium text-slate-800 truncate" x-text="currentUser?.name"></p>
                                    <p class="text-xs text-slate-500 truncate" x-text="currentUser?.email"></p>
                                </div>
                                <a href="{{ url('/patients/register') }}"
                                    class="flex items-center px-4 py-2 text-sm text-slate-700 hover:bg-slate-100">
                                    <i data-lucide="calendar-plus" class="w-4 h-4 mr-2"></i>
                                    Buat Janji
                                </a>
                                <button @click="logout()"
                                    class="w-full flex items-center px-4 py-2 text-sm text-red-600 hover:bg-red-50">
                                    <i data-lucide="log-out" class="w-4 h-4 mr-2"></i>
                                    Keluar
                                </button>
                            </div>
                        </div>
                    </div>
                </template>

                {{-- Buat Janji Button (always visible) --}}
                <a href="{{ url('/patients/register') }}"
                    class="inline-flex items-center px-6 py-2.5 bg-gradient-to-r from-sky-500 to-emerald-500 text-white font-semibold rounded-xl shadow-lg shadow-sky-500/30 hover:shadow-sky-500/50 hover:scale-105 transition-all duration-200">
                    <i data-lucide="calendar-plus" class="w-5 h-5 mr-2"></i>
                    Buat Janji
                </a>
            </div>

            {{-- Mobile Menu Button --}}
            <button @click="mobileMenuOpen = !mobileMenuOpen"
                class="lg:hidden p-2 rounded-xl hover:bg-slate-100 transition">
                <i x-show="!mobileMenuOpen" data-lucide="menu" class="w-6 h-6 text-slate-700"></i>
                <i x-show="mobileMenuOpen" data-lucide="x" class="w-6 h-6 text-slate-700"></i>
            </button>
        </div>
    </div>

    {{-- Mobile Menu --}}
    <div x-show="mobileMenuOpen" x-transition:enter="transition ease-out duration-200"
        x-transition:enter-start="opacity-0 -translate-y-4" x-transition:enter-end="opacity-100 translate-y-0"
        x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100 translate-y-0"
        x-transition:leave-end="opacity-0 -translate-y-4"
        class="lg:hidden bg-white border-t border-slate-200 shadow-xl">
        <div class="max-w-7xl mx-auto px-4 py-4 space-y-2">
            <a href="{{ url('/') }}"
                class="flex items-center px-4 py-3 rounded-xl text-slate-700 hover:bg-sky-50 hover:text-sky-600 font-medium transition">
                <i data-lucide="home" class="w-5 h-5 mr-3"></i>
                Home
            </a>
            <a href="{{ url('/services') }}"
                class="flex items-center px-4 py-3 rounded-xl text-slate-700 hover:bg-sky-50 hover:text-sky-600 font-medium transition">
                <i data-lucide="list" class="w-5 h-5 mr-3"></i>
                Layanan
            </a>
            <a href="{{ url('/doctors') }}"
                class="flex items-center px-4 py-3 rounded-xl text-slate-700 hover:bg-sky-50 hover:text-sky-600 font-medium transition">
                <i data-lucide="stethoscope" class="w-5 h-5 mr-3"></i>
                Dokter
            </a>
            <a href="{{ url('/feedback') }}"
                class="flex items-center px-4 py-3 rounded-xl text-slate-700 hover:bg-sky-50 hover:text-sky-600 font-medium transition">
                <i data-lucide="message-square" class="w-5 h-5 mr-3"></i>
                Feedback
            </a>

            <hr class="my-2 border-slate-200">

            {{-- Mobile Auth --}}
            <template x-if="!isLoggedIn">
                <div class="space-y-2">
                    <a href="{{ url('/login') }}"
                        class="flex items-center px-4 py-3 rounded-xl text-slate-700 hover:bg-sky-50 hover:text-sky-600 font-medium transition">
                        <i data-lucide="log-in" class="w-5 h-5 mr-3"></i>
                        Masuk
                    </a>
                    <a href="{{ url('/register') }}"
                        class="flex items-center px-4 py-3 rounded-xl text-slate-700 hover:bg-sky-50 hover:text-sky-600 font-medium transition">
                        <i data-lucide="user-plus" class="w-5 h-5 mr-3"></i>
                        Daftar
                    </a>
                </div>
            </template>

            <template x-if="isLoggedIn">
                <div class="space-y-2">
                    <div class="flex items-center px-4 py-3 bg-slate-50 rounded-xl">
                        <div
                            class="w-10 h-10 bg-gradient-to-br from-sky-400 to-emerald-400 rounded-full flex items-center justify-center mr-3">
                            <span class="text-white font-bold"
                                x-text="currentUser?.name?.charAt(0).toUpperCase()"></span>
                        </div>
                        <div>
                            <p class="font-medium text-slate-800" x-text="currentUser?.name"></p>
                            <p class="text-xs text-slate-500" x-text="currentUser?.email"></p>
                        </div>
                    </div>
                    <button @click="logout()"
                        class="flex items-center w-full px-4 py-3 rounded-xl text-red-600 hover:bg-red-50 font-medium transition">
                        <i data-lucide="log-out" class="w-5 h-5 mr-3"></i>
                        Keluar
                    </button>
                </div>
            </template>

            <hr class="my-2 border-slate-200">

            <a href="{{ url('/patients/register') }}"
                class="flex items-center justify-center px-4 py-3 bg-gradient-to-r from-sky-500 to-emerald-500 text-white font-semibold rounded-xl shadow-lg">
                <i data-lucide="calendar-plus" class="w-5 h-5 mr-2"></i>
                Buat Janji Sekarang
            </a>
        </div>
    </div>
</nav>

{{-- Spacer untuk fixed navbar --}}
<div class="h-20"></div>