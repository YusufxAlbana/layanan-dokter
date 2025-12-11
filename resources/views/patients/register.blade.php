{{--
Patient Registration / Booking Page
------------------------------------
Halaman registrasi pasien dan booking janji temu.

Features:
- Dua mode: User Login (form singkat) vs Guest (form lengkap)
- Auto-fill data untuk user yang sudah login
- Progress indicator

TODO Backend:
- Validasi dan simpan ke database
- Integrasi dengan jadwal dokter
--}}

@extends('layouts.app')

@section('title', 'Buat Janji Temu')

@section('content')

    <div class="min-h-screen bg-gradient-to-b from-sky-50 to-white py-12" x-data="bookingForm()" x-init="init()">
        <div class="max-w-4xl mx-auto px-4 sm:px-6">

            {{-- Progress Indicator --}}
            <div class="flex items-center justify-center mb-10">
                <div class="flex items-center space-x-4">
                    <div class="flex items-center">
                        <div
                            class="w-10 h-10 bg-sky-500 text-white rounded-full flex items-center justify-center font-bold">
                            1</div>
                        <span class="ml-2 font-medium text-slate-800 hidden sm:block">Data & Jadwal</span>
                    </div>
                    <div class="w-16 h-1 bg-slate-200"></div>
                    <div class="flex items-center">
                        <div
                            class="w-10 h-10 bg-slate-200 text-slate-500 rounded-full flex items-center justify-center font-bold">
                            2</div>
                        <span class="ml-2 font-medium text-slate-400 hidden sm:block">Pembayaran</span>
                    </div>
                    <div class="w-16 h-1 bg-slate-200"></div>
                    <div class="flex items-center">
                        <div
                            class="w-10 h-10 bg-slate-200 text-slate-500 rounded-full flex items-center justify-center font-bold">
                            3</div>
                        <span class="ml-2 font-medium text-slate-400 hidden sm:block">Konfirmasi</span>
                    </div>
                </div>
            </div>

            {{-- Header --}}
            <div class="text-center mb-8">
                <h1 class="text-3xl font-bold text-slate-800 mb-2">Buat Janji Temu</h1>
                <p class="text-slate-600"
                    x-text="isLoggedIn ? 'Data Anda sudah terisi otomatis' : 'Lengkapi data untuk membuat janji'"></p>
            </div>

            {{-- Login Prompt for Guests --}}
            <div x-show="!isLoggedIn && !isGuest"
                class="bg-white rounded-2xl shadow-lg border border-slate-100 p-8 mb-6 text-center">
                <div class="w-16 h-16 bg-sky-100 rounded-full flex items-center justify-center mx-auto mb-4">
                    <i data-lucide="user-check" class="w-8 h-8 text-sky-600"></i>
                </div>
                <h2 class="text-xl font-bold text-slate-800 mb-2">Sudah Punya Akun?</h2>
                <p class="text-slate-600 mb-6">Masuk untuk mengisi formulir lebih cepat dengan data yang tersimpan.</p>
                <div class="flex flex-col sm:flex-row items-center justify-center gap-4">
                    <a href="{{ url('/login') }}"
                        class="w-full sm:w-auto px-8 py-3 bg-gradient-to-r from-sky-500 to-emerald-500 text-white font-semibold rounded-xl shadow-lg shadow-sky-500/30 hover:shadow-sky-500/50 transition">
                        <i data-lucide="log-in" class="w-5 h-5 inline mr-2"></i>
                        Masuk
                    </a>
                    <button @click="isGuest = true"
                        class="w-full sm:w-auto px-8 py-3 bg-slate-100 hover:bg-slate-200 text-slate-700 font-medium rounded-xl transition">
                        Lanjut Tanpa Akun
                    </button>
                </div>
            </div>

            {{-- Booking Form --}}
            <form x-show="isLoggedIn || isGuest" x-transition @submit.prevent="submitBooking" class="space-y-6">

                {{-- User Info Card (Logged In) --}}
                <div x-show="isLoggedIn" class="bg-gradient-to-r from-sky-500 to-emerald-500 rounded-2xl p-6 text-white">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center space-x-4">
                            <div class="w-14 h-14 bg-white/20 rounded-xl flex items-center justify-center">
                                <i data-lucide="user" class="w-7 h-7"></i>
                            </div>
                            <div>
                                <p class="text-white/80 text-sm">Selamat datang kembali,</p>
                                <p class="text-xl font-bold" x-text="currentUser?.name"></p>
                                <p class="text-white/80 text-sm" x-text="currentUser?.email"></p>
                            </div>
                        </div>
                        <button type="button" @click="logout()"
                            class="px-4 py-2 bg-white/20 hover:bg-white/30 rounded-xl text-sm font-medium transition">
                            Ganti Akun
                        </button>
                    </div>
                </div>

                {{-- Guest Data Form --}}
                <div x-show="isGuest && !isLoggedIn" class="bg-white rounded-2xl shadow-lg border border-slate-100 p-6">
                    <h2 class="text-lg font-semibold text-slate-800 mb-6 flex items-center">
                        <i data-lucide="user" class="w-5 h-5 mr-2 text-sky-500"></i>
                        Data Pribadi
                    </h2>

                    <div class="grid sm:grid-cols-2 gap-4">
                        <div class="sm:col-span-2">
                            <label class="block text-sm font-medium text-slate-700 mb-2">Nama Lengkap <span
                                    class="text-red-500">*</span></label>
                            <input type="text" x-model="form.name" required placeholder="Masukkan nama lengkap"
                                class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-sky-500 focus:border-sky-500 transition">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-slate-700 mb-2">Email <span
                                    class="text-red-500">*</span></label>
                            <input type="email" x-model="form.email" required placeholder="nama@email.com"
                                class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-sky-500 focus:border-sky-500 transition">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-slate-700 mb-2">No. Telepon <span
                                    class="text-red-500">*</span></label>
                            <input type="tel" x-model="form.phone" required placeholder="08xxxxxxxxxx"
                                class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-sky-500 focus:border-sky-500 transition">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-slate-700 mb-2">Tanggal Lahir <span
                                    class="text-red-500">*</span></label>
                            <input type="date" x-model="form.birthDate" required
                                class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-sky-500 focus:border-sky-500 transition">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-slate-700 mb-2">Jenis Kelamin <span
                                    class="text-red-500">*</span></label>
                            <select x-model="form.gender" required
                                class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-sky-500 focus:border-sky-500 transition">
                                <option value="">Pilih</option>
                                <option value="L">Laki-laki</option>
                                <option value="P">Perempuan</option>
                            </select>
                        </div>

                        <div class="sm:col-span-2">
                            <label class="block text-sm font-medium text-slate-700 mb-2">Alamat</label>
                            <textarea x-model="form.address" rows="2" placeholder="Alamat lengkap (opsional)"
                                class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-sky-500 focus:border-sky-500 transition resize-none"></textarea>
                        </div>
                    </div>
                </div>

                {{-- Appointment Details --}}
                <div class="bg-white rounded-2xl shadow-lg border border-slate-100 p-6">
                    <h2 class="text-lg font-semibold text-slate-800 mb-6 flex items-center">
                        <i data-lucide="calendar" class="w-5 h-5 mr-2 text-sky-500"></i>
                        Detail Janji Temu
                    </h2>

                    <div class="grid sm:grid-cols-2 gap-4">
                        <div class="sm:col-span-2">
                            <label class="block text-sm font-medium text-slate-700 mb-2">Pilih Layanan <span
                                    class="text-red-500">*</span></label>
                            <select x-model="form.service" required
                                class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-sky-500 focus:border-sky-500 transition">
                                <option value="">Pilih layanan</option>
                                <option value="checkup">Pemeriksaan Gigi - Rp 150.000</option>
                                <option value="scaling">Pembersihan Karang Gigi - Rp 300.000</option>
                                <option value="filling">Tambal Gigi - Rp 250.000</option>
                                <option value="extraction">Cabut Gigi - Rp 200.000</option>
                                <option value="bleaching">Bleaching - Rp 1.500.000</option>
                                <option value="braces">Konsultasi Kawat Gigi - Rp 200.000</option>
                            </select>
                        </div>

                        <div class="sm:col-span-2">
                            <label class="block text-sm font-medium text-slate-700 mb-2">Pilih Dokter <span
                                    class="text-red-500">*</span></label>
                            <select x-model="form.doctor" required
                                class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-sky-500 focus:border-sky-500 transition">
                                <option value="">Pilih dokter</option>
                                <option value="dr-andi">Dr. Andi Pratama, Sp.KG</option>
                                <option value="dr-sarah">Dr. Sarah Amanda, Sp.Ort</option>
                                <option value="dr-rizki">Dr. Rizki Hidayat, Sp.BM</option>
                                <option value="dr-maya">Dr. Maya Putri, Sp.KGA</option>
                                <option value="dr-hendra">Dr. Hendra Wijaya, Sp.Pros</option>
                            </select>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-slate-700 mb-2">Tanggal <span
                                    class="text-red-500">*</span></label>
                            <input type="date" x-model="form.date" required :min="minDate"
                                class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-sky-500 focus:border-sky-500 transition">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-slate-700 mb-2">Waktu <span
                                    class="text-red-500">*</span></label>
                            <select x-model="form.time" required
                                class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-sky-500 focus:border-sky-500 transition">
                                <option value="">Pilih waktu</option>
                                <option value="09:00">09:00 WIB</option>
                                <option value="10:00">10:00 WIB</option>
                                <option value="11:00">11:00 WIB</option>
                                <option value="13:00">13:00 WIB</option>
                                <option value="14:00">14:00 WIB</option>
                                <option value="15:00">15:00 WIB</option>
                                <option value="16:00">16:00 WIB</option>
                            </select>
                        </div>

                        <div class="sm:col-span-2">
                            <label class="block text-sm font-medium text-slate-700 mb-2">Keluhan <span
                                    class="text-red-500">*</span></label>
                            <textarea x-model="form.complaint" required rows="3"
                                placeholder="Jelaskan keluhan atau alasan kunjungan Anda..."
                                class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-sky-500 focus:border-sky-500 transition resize-none"></textarea>
                        </div>
                    </div>
                </div>

                {{-- Submit --}}
                <div class="flex flex-col sm:flex-row items-center justify-between gap-4">
                    <a href="{{ url('/') }}"
                        class="w-full sm:w-auto px-6 py-3 bg-slate-100 hover:bg-slate-200 text-slate-700 font-medium rounded-xl transition text-center">
                        <i data-lucide="arrow-left" class="w-5 h-5 inline mr-2"></i>
                        Kembali
                    </a>
                    <button type="submit" :disabled="loading"
                        class="w-full sm:w-auto px-8 py-3 bg-gradient-to-r from-sky-500 to-emerald-500 text-white font-semibold rounded-xl shadow-lg shadow-sky-500/30 hover:shadow-sky-500/50 hover:scale-[1.02] transition-all disabled:opacity-50">
                        <span x-show="!loading">Lanjut ke Pembayaran</span>
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
                </div>
            </form>

        </div>
    </div>

@endsection

@push('scripts')
    <script>
        function bookingForm() {
            return {
                isLoggedIn: false,
                isGuest: false,
                currentUser: null,
                loading: false,
                minDate: new Date().toISOString().split('T')[0],

                form: {
                    name: '',
                    email: '',
                    phone: '',
                    birthDate: '',
                    gender: '',
                    address: '',
                    service: '',
                    doctor: '',
                    date: '',
                    time: '',
                    complaint: ''
                },

                init() {
                    // Check if user is logged in
                    const user = localStorage.getItem('klinik_current_user');
                    if (user) {
                        this.currentUser = JSON.parse(user);
                        this.isLoggedIn = true;
                        // Pre-fill form
                        this.form.name = this.currentUser.name;
                        this.form.email = this.currentUser.email;
                        this.form.phone = this.currentUser.phone || '';
                    }

                    // Check if coming as guest
                    const urlParams = new URLSearchParams(window.location.search);
                    if (urlParams.get('guest') === 'true') {
                        this.isGuest = true;
                    }
                },

                logout() {
                    localStorage.removeItem('klinik_current_user');
                    this.isLoggedIn = false;
                    this.currentUser = null;
                    this.isGuest = false;
                    // Reset form
                    this.form = {
                        name: '', email: '', phone: '', birthDate: '', gender: '', address: '',
                        service: '', doctor: '', date: '', time: '', complaint: ''
                    };
                },

                submitBooking() {
                    this.loading = true;

                    setTimeout(() => {
                        // Create appointment
                        const appointments = JSON.parse(localStorage.getItem('klinik_appointments') || '[]');
                        const newAppointment = {
                            id: 'KGS-' + String(appointments.length + 1).padStart(3, '0'),
                            ...this.form,
                            status: 'pending',
                            createdAt: new Date().toISOString(),
                            userId: this.currentUser?.id || null
                        };
                        appointments.push(newAppointment);
                        localStorage.setItem('klinik_appointments', JSON.stringify(appointments));

                        // If guest, add to patients
                        if (this.isGuest && !this.isLoggedIn) {
                            const patients = JSON.parse(localStorage.getItem('klinik_patients') || '[]');
                            // Check if patient already exists by email
                            if (!patients.find(p => p.email === this.form.email)) {
                                patients.push({
                                    id: 'P' + String(patients.length + 1).padStart(3, '0'),
                                    name: this.form.name,
                                    email: this.form.email,
                                    phone: this.form.phone,
                                    birthDate: this.form.birthDate,
                                    gender: this.form.gender,
                                    address: this.form.address,
                                    visits: [],
                                    createdAt: new Date().toLocaleDateString('id-ID'),
                                    color: ['0ea5e9', '10b981', '8b5cf6', 'f59e0b'][Math.floor(Math.random() * 4)]
                                });
                                localStorage.setItem('klinik_patients', JSON.stringify(patients));
                            }
                        }

                        // Save current booking for checkout
                        localStorage.setItem('klinik_current_booking', JSON.stringify(newAppointment));

                        // Redirect to checkout
                        window.location.href = '{{ url("/appointment/checkout") }}';
                    }, 1000);
                }
            }
        }
    </script>
@endpush