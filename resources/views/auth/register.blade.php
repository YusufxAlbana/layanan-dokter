{{--
Register Page
-------------
Halaman registrasi untuk user baru.

Features:
- Form registrasi lengkap
- Validasi password
- Auto login setelah register

TODO Backend:
- User creation
- Email verification
--}}

@extends('layouts.app')

@section('title', 'Daftar')

@section('content')

    <div class="min-h-screen flex items-center justify-center py-12 px-4" x-data="registerForm()">
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

            {{-- Register Card --}}
            <div class="bg-white rounded-3xl shadow-xl border border-slate-100 p-8">
                <div class="text-center mb-8">
                    <h1 class="text-2xl font-bold text-slate-800 mb-2">Buat Akun Baru</h1>
                    <p class="text-slate-500">Daftar untuk kemudahan membuat janji</p>
                </div>

                {{-- Success Message --}}
                <div x-show="success" x-transition class="mb-6 p-4 bg-emerald-50 border border-emerald-200 rounded-xl">
                    <p class="text-sm text-emerald-600">Registrasi berhasil! Mengalihkan...</p>
                </div>

                {{-- Error Message --}}
                <div x-show="error" x-transition class="mb-6 p-4 bg-red-50 border border-red-200 rounded-xl">
                    <p class="text-sm text-red-600" x-text="error"></p>
                </div>

                {{-- Register Form --}}
                <form @submit.prevent="register" class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-2">Nama Lengkap</label>
                        <div class="relative">
                            <i data-lucide="user"
                                class="absolute left-4 top-1/2 -translate-y-1/2 w-5 h-5 text-slate-400"></i>
                            <input type="text" x-model="name" required placeholder="Masukkan nama lengkap"
                                class="w-full pl-12 pr-4 py-3 bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-sky-500 focus:border-sky-500 transition">
                        </div>
                    </div>

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
                        <label class="block text-sm font-medium text-slate-700 mb-2">No. Telepon</label>
                        <div class="relative">
                            <i data-lucide="phone"
                                class="absolute left-4 top-1/2 -translate-y-1/2 w-5 h-5 text-slate-400"></i>
                            <input type="tel" x-model="phone" required placeholder="08xxxxxxxxxx"
                                class="w-full pl-12 pr-4 py-3 bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-sky-500 focus:border-sky-500 transition">
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-2">Password</label>
                        <div class="relative">
                            <i data-lucide="lock"
                                class="absolute left-4 top-1/2 -translate-y-1/2 w-5 h-5 text-slate-400"></i>
                            <input :type="showPassword ? 'text' : 'password'" x-model="password" required minlength="6"
                                placeholder="Minimal 6 karakter"
                                class="w-full pl-12 pr-12 py-3 bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-sky-500 focus:border-sky-500 transition">
                            <button type="button" @click="showPassword = !showPassword"
                                class="absolute right-4 top-1/2 -translate-y-1/2 text-slate-400 hover:text-slate-600">
                                <i x-show="!showPassword" data-lucide="eye" class="w-5 h-5"></i>
                                <i x-show="showPassword" data-lucide="eye-off" class="w-5 h-5"></i>
                            </button>
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-2">Konfirmasi Password</label>
                        <div class="relative">
                            <i data-lucide="lock"
                                class="absolute left-4 top-1/2 -translate-y-1/2 w-5 h-5 text-slate-400"></i>
                            <input :type="showPassword ? 'text' : 'password'" x-model="confirmPassword" required
                                placeholder="Ulangi password"
                                class="w-full pl-12 pr-4 py-3 bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-sky-500 focus:border-sky-500 transition">
                        </div>
                        <p x-show="password && confirmPassword && password !== confirmPassword"
                            class="mt-1 text-sm text-red-500">
                            Password tidak cocok
                        </p>
                    </div>

                    <div class="flex items-start">
                        <input type="checkbox" x-model="agree" required
                            class="w-4 h-4 mt-1 rounded border-slate-300 text-sky-500 focus:ring-sky-500">
                        <span class="ml-2 text-sm text-slate-600">
                            Saya setuju dengan
                            <a href="#" class="text-sky-600 hover:underline">Syarat & Ketentuan</a> dan
                            <a href="#" class="text-sky-600 hover:underline">Kebijakan Privasi</a>
                        </span>
                    </div>

                    <button type="submit" :disabled="loading || (password !== confirmPassword)"
                        class="w-full py-3 bg-gradient-to-r from-sky-500 to-emerald-500 text-white font-semibold rounded-xl shadow-lg shadow-sky-500/30 hover:shadow-sky-500/50 hover:scale-[1.02] transition-all disabled:opacity-50 disabled:cursor-not-allowed">
                        <span x-show="!loading">Daftar Sekarang</span>
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

                {{-- Login Link --}}
                <p class="text-center mt-6 text-slate-600">
                    Sudah punya akun?
                    <a href="{{ url('/login') }}" class="text-sky-600 hover:text-sky-700 font-semibold">Masuk</a>
                </p>
            </div>
        </div>
    </div>

@endsection

@push('scripts')
    <script>
        function registerForm() {
            return {
                name: '',
                email: '',
                phone: '',
                password: '',
                confirmPassword: '',
                showPassword: false,
                agree: false,
                loading: false,
                success: false,
                error: '',

                register() {
                    if (this.password !== this.confirmPassword) {
                        this.error = 'Password tidak cocok';
                        return;
                    }

                    this.loading = true;
                    this.error = '';

                    setTimeout(() => {
                        // Check if email already exists
                        const users = JSON.parse(localStorage.getItem('klinik_users') || '[]');
                        if (users.find(u => u.email === this.email)) {
                            this.error = 'Email sudah terdaftar. Silakan login.';
                            this.loading = false;
                            return;
                        }

                        // Create new user
                        const newUser = {
                            id: 'U' + String(users.length + 1).padStart(3, '0'),
                            name: this.name,
                            email: this.email,
                            phone: this.phone,
                            password: this.password,
                            createdAt: new Date().toLocaleDateString('id-ID')
                        };

                        users.push(newUser);
                        localStorage.setItem('klinik_users', JSON.stringify(users));

                        // Auto login
                        localStorage.setItem('klinik_current_user', JSON.stringify(newUser));

                        // Also add to patients list
                        const patients = JSON.parse(localStorage.getItem('klinik_patients') || '[]');
                        patients.push({
                            id: 'P' + String(patients.length + 1).padStart(3, '0'),
                            name: this.name,
                            email: this.email,
                            phone: this.phone,
                            userId: newUser.id,
                            visits: [],
                            createdAt: newUser.createdAt,
                            color: ['0ea5e9', '10b981', '8b5cf6', 'f59e0b'][Math.floor(Math.random() * 4)]
                        });
                        localStorage.setItem('klinik_patients', JSON.stringify(patients));

                        this.success = true;
                        this.loading = false;

                        // Redirect
                        setTimeout(() => {
                            window.location.href = '{{ url("/patients/register") }}';
                        }, 1500);
                    }, 1000);
                }
            }
        }
    </script>
@endpush