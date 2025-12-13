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

            {{-- Info Jadwal Terpilih (dari halaman schedule) --}}
            <div x-show="prefilledDate && prefilledTime"
                class="bg-gradient-to-r from-sky-50 to-emerald-50 rounded-2xl shadow-lg border border-slate-100 p-6 mb-6">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-slate-600">Jadwal yang dipilih:</p>
                        <p class="text-lg font-bold text-slate-800">
                            <span x-text="prefilledDoctor"></span>
                        </p>
                        <p class="text-sky-600 font-medium">
                            <span x-text="formattedPrefilledDate"></span> - <span x-text="prefilledTime"></span> WIB
                        </p>
                    </div>
                    <div class="w-12 h-12 bg-emerald-500 rounded-full flex items-center justify-center">
                        <i data-lucide="calendar-check" class="w-6 h-6 text-white"></i>
                    </div>
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
                <div class="bg-white rounded-2xl shadow-lg border border-slate-100 overflow-hidden">
                    <div class="bg-gradient-to-r from-slate-50 to-slate-100 p-6 border-b border-slate-100">
                        <h2 class="text-lg font-bold text-slate-800 flex items-center">
                            <div
                                class="w-10 h-10 bg-sky-100 rounded-full flex items-center justify-center mr-3 text-sky-600">
                                <i data-lucide="calendar" class="w-5 h-5"></i>
                            </div>
                            Detail Janji Temu
                        </h2>
                    </div>

                    <div class="p-6 grid sm:grid-cols-2 gap-6">
                        {{-- Dokter --}}
                        <div class="sm:col-span-2">
                            <label class="block text-sm font-semibold text-slate-700 mb-2">Pilih Dokter</label>
                            <template x-if="hasPrefilledSchedule">
                                <div
                                    class="w-full px-4 py-4 bg-emerald-50 border border-emerald-200 rounded-xl text-emerald-700 font-bold flex items-center shadow-sm">
                                    <div class="w-8 h-8 bg-emerald-100 rounded-full flex items-center justify-center mr-3">
                                        <i data-lucide="user-check" class="w-4 h-4"></i>
                                    </div>
                                    <span x-text="prefilledDoctor"></span>
                                    <input type="hidden" x-model="form.doctor">
                                </div>
                            </template>
                            <template x-if="!hasPrefilledSchedule">
                                <div class="relative group">
                                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                        <i data-lucide="stethoscope"
                                            class="w-5 h-5 text-slate-400 group-focus-within:text-sky-500 transition-colors"></i>
                                    </div>
                                    <select x-model="form.doctor" required @change="onDoctorChange($event)"
                                        class="w-full pl-12 pr-4 py-4 bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-sky-500 focus:border-sky-500 transition-all font-medium appearance-none">
                                        <option value="">Pilih Dokter Spesialis</option>
                                        <template x-for="doctor in doctors" :key="doctor.id">
                                            <option :value="doctor.id" x-text="doctor.name + ' - ' + doctor.specialty">
                                            </option>
                                        </template>
                                    </select>
                                    <div class="absolute inset-y-0 right-0 pr-4 flex items-center pointer-events-none">
                                        <i data-lucide="chevron-down" class="w-5 h-5 text-slate-400"></i>
                                    </div>
                                </div>
                            </template>
                        </div>

                        {{-- Tanggal --}}
                        <div>
                            <label class="block text-sm font-semibold text-slate-700 mb-2">Tanggal Kunjungan</label>
                            <template x-if="hasPrefilledSchedule">
                                <div
                                    class="w-full px-4 py-4 bg-emerald-50 border border-emerald-200 rounded-xl text-emerald-700 font-bold flex items-center shadow-sm">
                                    <div class="w-8 h-8 bg-emerald-100 rounded-full flex items-center justify-center mr-3">
                                        <i data-lucide="calendar-check" class="w-4 h-4"></i>
                                    </div>
                                    <span x-text="formattedPrefilledDate"></span>
                                    <input type="hidden" x-model="form.date">
                                </div>
                            </template>
                            <template x-if="!hasPrefilledSchedule">
                                <div class="relative group">
                                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                        <i data-lucide="calendar"
                                            class="w-5 h-5 text-slate-400 group-focus-within:text-sky-500 transition-colors"></i>
                                    </div>
                                    <input type="date" x-model="form.date" required :min="minDate"
                                        class="w-full pl-12 pr-4 py-4 bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-sky-500 focus:border-sky-500 transition-all font-medium cursor-pointer"
                                        onclick="this.showPicker()">
                                </div>
                            </template>
                        </div>

                        {{-- Waktu --}}
                        <div>
                            <label class="block text-sm font-semibold text-slate-700 mb-2">Jam Kedatangan</label>
                            <template x-if="hasPrefilledSchedule">
                                <div
                                    class="w-full px-4 py-4 bg-emerald-50 border border-emerald-200 rounded-xl text-emerald-700 font-bold flex items-center shadow-sm">
                                    <div class="w-8 h-8 bg-emerald-100 rounded-full flex items-center justify-center mr-3">
                                        <i data-lucide="clock" class="w-4 h-4"></i>
                                    </div>
                                    <span x-text="prefilledTime + ' WIB'"></span>
                                    <input type="hidden" x-model="form.time">
                                </div>
                            </template>
                            <template x-if="!hasPrefilledSchedule">
                                <div class="relative group">
                                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                        <i data-lucide="clock"
                                            class="w-5 h-5 text-slate-400 group-focus-within:text-sky-500 transition-colors"></i>
                                    </div>
                                    <select x-model="form.time" required
                                        class="w-full pl-12 pr-4 py-4 bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-sky-500 focus:border-sky-500 transition-all font-medium appearance-none">
                                        <option value="">Pilih Jam</option>
                                        <option value="09:00">09:00 WIB</option>
                                        <option value="10:00">10:00 WIB</option>
                                        <option value="11:00">11:00 WIB</option>
                                        <option value="13:00">13:00 WIB</option>
                                        <option value="14:00">14:00 WIB</option>
                                        <option value="15:00">15:00 WIB</option>
                                        <option value="16:00">16:00 WIB</option>
                                    </select>
                                    <div class="absolute inset-y-0 right-0 pr-4 flex items-center pointer-events-none">
                                        <i data-lucide="chevron-down" class="w-5 h-5 text-slate-400"></i>
                                    </div>
                                </div>
                            </template>
                        </div>

                        {{-- Layanan --}}
                        <div class="sm:col-span-2">
                            <label class="block text-sm font-semibold text-slate-700 mb-2">Jenis Layanan</label>
                            <div class="relative group">
                                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                    <i data-lucide="activity"
                                        class="w-5 h-5 text-slate-400 group-focus-within:text-sky-500 transition-colors"></i>
                                </div>
                                <select x-model="form.service" required
                                    class="w-full pl-12 pr-4 py-4 bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-sky-500 focus:border-sky-500 transition-all font-medium appearance-none">
                                    <option value="">Pilih Layanan Perawatan</option>
                                    <template x-for="service in availableServices" :key="service.id">
                                        <option :value="service.id"
                                            x-text="service.name + ' - Rp ' + service.price.toLocaleString('id-ID')">
                                        </option>
                                    </template>
                                </select>
                                <div class="absolute inset-y-0 right-0 pr-4 flex items-center pointer-events-none">
                                    <i data-lucide="chevron-down" class="w-5 h-5 text-slate-400"></i>
                                </div>
                            </div>
                            <p x-show="hasPrefilledSchedule" class="text-xs text-slate-500 mt-2 flex items-center">
                                <i data-lucide="info" class="w-3 h-3 mr-1"></i>
                                Layanan disesuaikan dengan keahlian dokter: <span x-text="prefilledSpecialty"
                                    class="font-bold ml-1 text-sky-600"></span>
                            </p>
                        </div>

                        {{-- Keluhan --}}
                        <div class="sm:col-span-2">
                            <label class="block text-sm font-semibold text-slate-700 mb-2">Keluhan / Catatan</label>
                            <div class="relative group">
                                <div class="absolute top-4 left-4 pointer-events-none">
                                    <i data-lucide="message-square"
                                        class="w-5 h-5 text-slate-400 group-focus-within:text-sky-500 transition-colors"></i>
                                </div>
                                <textarea x-model="form.complaint" required rows="3"
                                    placeholder="Jelaskan keluhan gigi Anda secara singkat..."
                                    class="w-full pl-12 pr-4 py-4 bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-sky-500 focus:border-sky-500 transition-all resize-none font-medium"></textarea>
                            </div>
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
                    doctors: [],
                    selectedDoctorSpecialty: '',

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

                    prefilledDoctor: '',
                    prefilledDoctorId: '',
                    prefilledSpecialty: '',
                    prefilledDate: '',
                    prefilledTime: '',

                    // Mapping specialty ke services
                    specialtyServices: {
                        'Dokter Gigi Umum': [
                            { id: 'checkup', name: 'Pemeriksaan Gigi', price: 150000 },
                            { id: 'scaling', name: 'Pembersihan Karang Gigi', price: 300000 },
                            { id: 'filling', name: 'Tambal Gigi', price: 250000 },
                            { id: 'extraction', name: 'Cabut Gigi', price: 200000 }
                        ],
                        'Konservasi Gigi': [
                            { id: 'filling', name: 'Tambal Gigi', price: 250000 },
                            { id: 'root-canal', name: 'Perawatan Saluran Akar', price: 800000 },
                            { id: 'veneer', name: 'Veneer', price: 3000000 },
                            { id: 'crown', name: 'Crown', price: 2500000 }
                        ],
                        'Ortodonti': [
                            { id: 'braces-consult', name: 'Konsultasi Kawat Gigi', price: 200000 },
                            { id: 'braces', name: 'Pemasangan Kawat Gigi', price: 15000000 },
                            { id: 'invisalign', name: 'Invisalign', price: 40000000 },
                            { id: 'retainer', name: 'Retainer', price: 1500000 }
                        ],
                        'Bedah Mulut': [
                            { id: 'wisdom-tooth', name: 'Cabut Gigi Bungsu', price: 1500000 },
                            { id: 'implant', name: 'Implant Gigi', price: 15000000 },
                            { id: 'oral-surgery', name: 'Operasi Mulut', price: 5000000 },
                            { id: 'biopsy', name: 'Biopsi', price: 2000000 }
                        ],
                        'Kedokteran Gigi Anak': [
                            { id: 'child-checkup', name: 'Pemeriksaan Anak', price: 150000 },
                            { id: 'fluoride', name: 'Fluoride Treatment', price: 200000 },
                            { id: 'fissure-sealant', name: 'Fissure Sealant', price: 300000 },
                            { id: 'baby-teeth', name: 'Perawatan Gigi Susu', price: 200000 }
                        ],
                        'Prostodonti': [
                            { id: 'denture', name: 'Gigi Tiruan', price: 3000000 },
                            { id: 'crown', name: 'Crown', price: 2500000 },
                            { id: 'bridge', name: 'Bridge', price: 4000000 },
                            { id: 'implant', name: 'Implant Gigi', price: 15000000 }
                        ],
                        'Periodonti': [
                            { id: 'scaling', name: 'Pembersihan Karang Gigi', price: 300000 },
                            { id: 'gum-treatment', name: 'Perawatan Gusi', price: 500000 },
                            { id: 'periodontal-surgery', name: 'Bedah Periodontal', price: 3000000 },
                            { id: 'deep-scaling', name: 'Scaling & Root Planing', price: 600000 }
                        ],
                        'Endodonti': [
                            { id: 'root-canal', name: 'Perawatan Saluran Akar', price: 800000 },
                            { id: 'retreatment', name: 'Retreatment', price: 1000000 },
                            { id: 'apicoectomy', name: 'Apikoektomi', price: 2500000 },
                            { id: 'internal-bleaching', name: 'Bleaching Internal', price: 1000000 }
                        ]
                    },

                    get hasPrefilledSchedule() {
                        return this.prefilledDoctorId && this.prefilledDate && this.prefilledTime;
                    },

                    get availableServices() {
                        // Jika sudah ada prefilled specialty (dari halaman schedule)
                        if (this.prefilledSpecialty && this.specialtyServices[this.prefilledSpecialty]) {
                            return this.specialtyServices[this.prefilledSpecialty];
                        }
                        // Jika dokter dipilih dari dropdown, gunakan specialty dokter tersebut
                        if (this.selectedDoctorSpecialty && this.specialtyServices[this.selectedDoctorSpecialty]) {
                            return this.specialtyServices[this.selectedDoctorSpecialty];
                        }
                        // Default: tampilkan layanan umum
                        return this.specialtyServices['Dokter Gigi Umum'];
                    },

                    get formattedPrefilledDate() {
                        if (!this.prefilledDate) return '';
                        const date = new Date(this.prefilledDate);
                        const options = { weekday: 'long', day: 'numeric', month: 'long', year: 'numeric' };
                        return date.toLocaleDateString('id-ID', options);
                    },

                    async init() {
                        // Load doctors from API
                        await this.loadDoctors();

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

                        // Skip guest selection - langsung masuk mode guest
                        this.isGuest = true;

                        // Pre-fill dari URL params (dari halaman schedule)
                        const urlParams = new URLSearchParams(window.location.search);
                        const doctorId = urlParams.get('doctor');
                        const doctorName = urlParams.get('doctor_name');
                        const specialty = urlParams.get('specialty');
                        const date = urlParams.get('date');
                        const time = urlParams.get('time');

                        if (doctorId) {
                            this.prefilledDoctorId = doctorId;
                            this.form.doctor = doctorId;
                        }
                        if (doctorName) {
                            this.prefilledDoctor = decodeURIComponent(doctorName);
                        }
                        if (specialty) {
                            this.prefilledSpecialty = decodeURIComponent(specialty);
                        }
                        if (date) {
                            this.prefilledDate = date;
                            this.form.date = date;
                        }
                        if (time) {
                            this.prefilledTime = time;
                            this.form.time = time;
                        }
                    },

                    async loadDoctors() {
                        try {
                            const response = await fetch('/api/doctors');
                            const data = await response.json();
                            this.doctors = data.doctors || [];
                        } catch (error) {
                            console.error('Error loading doctors:', error);
                            this.doctors = [];
                        }
                    },

                    onDoctorChange(event) {
                        const doctorId = event.target.value;
                        const doctor = this.doctors.find(d => d.id === doctorId);
                        if (doctor) {
                            this.selectedDoctorSpecialty = doctor.specialty;
                            // Reset service selection when doctor changes
                            this.form.service = '';
                        } else {
                            this.selectedDoctorSpecialty = '';
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