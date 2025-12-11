{{--
Login Page
----------
Halaman login untuk user.

Features:
- Form login email & password
- Link ke register
- Opsi lanjut tanpa login

TODO Backend:
- Authentication logic
- Session management
--}}

@extends('layouts.app')

@section('title', 'Masuk')

@section('content')

    <div class="min-h-screen flex items-center justify-center py-12 px-4" x-data="loginForm()">
        <div class="max-w-md w-full">
            {{-- Logo --}}
            <div class="text-center mb-8">
                <a href="{{ url('/') }}" class="inline-flex items-center space-x-3">
                    <img src="{{ asset('logo.png') }}" alt="Klinik Gigi Sehat" class="w-16 h-16 object-contain">
                    <div class="text-left">
                        <span class="block text-2xl font-bold text-slate-800">Klinik Gigi</span>
                        <span class="block text-sm text-slate-500">Sehat & Profesional</span>
                    </div>
                </a>
            </div>

            {{-- Login Card --}}
            <div class="bg-white rounded-3xl shadow-xl border border-slate-100 p-8">
                <div class="text-center mb-8">
                    <h1 class="text-2xl font-bold text-slate-800 mb-2">Selamat Datang Kembali</h1>
                    <p class="text-slate-500">Masuk untuk membuat janji temu lebih mudah</p>
                </div>

                {{-- Error Message --}}
                <div x-show="error" x-transition class="mb-6 p-4 bg-red-50 border border-red-200 rounded-xl">
                    <p class="text-sm text-red-600" x-text="error"></p>
                </div>

                {{-- Login Form --}}
                <form @submit.prevent="login" class="space-y-5">
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-2">Email</label>
                        <div class="relative">
                            <i data-lucide="mail"
                                class="absolute left-4 top-1/2 -translate-y-1/2 w-5 h-5 text-slate-400"></i>
                            <input type="email" x-model="email" required placeholder="nama@email.com"
                                class="w-full pl-12 pr-4 py-3 bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-sky-500 focus:border-sky-500 transition">
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-2">Password</label>
                        <div class="relative">
                            <i data-lucide="lock"
                                class="absolute left-4 top-1/2 -translate-y-1/2 w-5 h-5 text-slate-400"></i>
                            <input :type="showPassword ? 'text' : 'password'" x-model="password" required
                                placeholder="Masukkan password"
                                class="w-full pl-12 pr-12 py-3 bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-sky-500 focus:border-sky-500 transition">
                            <button type="button" @click="showPassword = !showPassword"
                                class="absolute right-4 top-1/2 -translate-y-1/2 text-slate-400 hover:text-slate-600">
                                <i x-show="!showPassword" data-lucide="eye" class="w-5 h-5"></i>
                                <i x-show="showPassword" data-lucide="eye-off" class="w-5 h-5"></i>
                            </button>
                        </div>
                    </div>

                    <div class="flex items-center justify-between">
                        <label class="flex items-center">
                            <input type="checkbox" x-model="remember"
                                class="w-4 h-4 rounded border-slate-300 text-sky-500 focus:ring-sky-500">
                            <span class="ml-2 text-sm text-slate-600">Ingat saya</span>
                        </label>
                        <a href="#" class="text-sm text-sky-600 hover:text-sky-700 font-medium">Lupa password?</a>
                    </div>

                    <button type="submit" :disabled="loading"
                        class="w-full py-3 bg-gradient-to-r from-sky-500 to-emerald-500 text-white font-semibold rounded-xl shadow-lg shadow-sky-500/30 hover:shadow-sky-500/50 hover:scale-[1.02] transition-all disabled:opacity-50 disabled:cursor-not-allowed">
                        <span x-show="!loading">Masuk</span>
                        <span x-show="loading" class="flex items-center justify-center">
                            <svg class="animate-spin w-5 h-5 mr-2" fill="none" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4">
                                </circle>
                                <path class="opacity-75" fill="currentColor"
                                    d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z"></path>
                            </svg>
                            Memproses...
                        </span>
                    </button>
                </form>

                {{-- Divider --}}
                <div class="flex items-center my-6">
                    <div class="flex-1 border-t border-slate-200"></div>
                    <span class="px-4 text-sm text-slate-400">atau</span>
                    <div class="flex-1 border-t border-slate-200"></div>
                </div>

                {{-- Continue Without Login --}}
                <a href="{{ url('/patients/register') }}?guest=true"
                    class="w-full flex items-center justify-center py-3 bg-slate-100 hover:bg-slate-200 text-slate-700 font-medium rounded-xl transition">
                    <i data-lucide="user" class="w-5 h-5 mr-2"></i>
                    Lanjut Tanpa Masuk
                </a>

                {{-- Register Link --}}
                <p class="text-center mt-6 text-slate-600">
                    Belum punya akun?
                    <a href="{{ url('/register') }}" class="text-sky-600 hover:text-sky-700 font-semibold">Daftar
                        Sekarang</a>
                </p>
            </div>
        </div>
    </div>

@endsection

@push('scripts')
    <script>
        function loginForm() {
            return {
                email: '',
                password: '',
                showPassword: false,
                remember: false,
                loading: false,
                error: '',

                login() {
                    this.loading = true;
                    this.error = '';

                    // Simulate login - check localStorage for registered users
                    setTimeout(() => {
                        const users = JSON.parse(localStorage.getItem('klinik_users') || '[]');
                        const user = users.find(u => u.email === this.email && u.password === this.password);

                        if (user) {
                            // Save logged in user
                            localStorage.setItem('klinik_current_user', JSON.stringify(user));
                            // Redirect to booking
                            window.location.href = '{{ url("/patients/register") }}';
                        } else {
                            this.error = 'Email atau password salah. Silakan coba lagi.';
                        }

                        this.loading = false;
                    }, 1000);
                }
            }
        }
    </script>
@endpush