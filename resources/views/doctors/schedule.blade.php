{{--
Jadwal Dokter Page
------------------
Halaman untuk menampilkan profil lengkap dan jadwal dokter.
Data diambil dari JSON yang dikelola melalui admin panel.

Features:
- Profil dokter lengkap (foto, nama, spesialisasi, dll)
- Kalender/tabel jadwal ketersediaan
- Tombol buat janji
--}}

@extends('layouts.app')

@section('title', 'Jadwal ' . $doctor['name'] . ' - Klinik Gigi Sehat')

@section('content')

    {{-- Breadcrumb --}}
    <section class="bg-slate-50 border-b border-slate-200 py-4">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <nav class="flex items-center space-x-2 text-sm">
                <a href="{{ url('/') }}" class="text-slate-500 hover:text-sky-600 transition">Home</a>
                <i data-lucide="chevron-right" class="w-4 h-4 text-slate-400"></i>
                <a href="{{ url('/doctors') }}" class="text-slate-500 hover:text-sky-600 transition">Dokter</a>
                <i data-lucide="chevron-right" class="w-4 h-4 text-slate-400"></i>
                <span class="text-slate-800 font-medium">{{ $doctor['name'] }}</span>
            </nav>
        </div>
    </section>

    {{-- Doctor Profile --}}
    <section class="py-12 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid lg:grid-cols-3 gap-8">
                {{-- Left Column - Profile --}}
                <div class="lg:col-span-1">
                    <div
                        class="bg-gradient-to-br from-slate-50 to-white rounded-3xl border border-slate-200 overflow-hidden sticky top-28">
                        {{-- Photo --}}
                        <div class="relative">
                            @if(!empty($doctor['photo']))
                                <img src="{{ $doctor['photo'] }}" alt="{{ $doctor['name'] }}" class="w-full h-72 object-cover">
                            @else
                                <div
                                    class="w-full h-72 bg-gradient-to-br from-sky-100 to-emerald-100 flex items-center justify-center">
                                    <span
                                        class="text-6xl font-bold text-white bg-sky-500 w-24 h-24 rounded-full flex items-center justify-center">
                                        {{ strtoupper(substr(explode(' ', $doctor['name'])[0], 0, 1)) }}
                                    </span>
                                </div>
                            @endif
                            <div
                                class="absolute top-4 right-4 px-3 py-1.5 bg-white/90 backdrop-blur-sm rounded-xl flex items-center space-x-1 shadow-lg">
                                <span
                                    class="px-2 py-0.5 text-xs font-medium rounded-full {{ ($doctor['status'] ?? 'active') === 'active' ? 'bg-emerald-100 text-emerald-700' : 'bg-slate-100 text-slate-600' }}">
                                    {{ ($doctor['status'] ?? 'active') === 'active' ? 'Aktif' : 'Tidak Aktif' }}
                                </span>
                            </div>
                        </div>

                        {{-- Info --}}
                        <div class="p-6">
                            <h1 class="text-2xl font-bold text-slate-800 mb-1">{{ $doctor['name'] }}</h1>
                            <p class="text-sky-600 font-medium mb-4 flex items-center">
                                <i data-lucide="stethoscope" class="w-4 h-4 mr-2"></i>
                                {{ $doctor['specialty'] ?? 'Dokter Gigi Umum' }}
                            </p>

                            {{-- Stats --}}
                            <div class="grid grid-cols-2 gap-4 mb-6">
                                <div class="text-center p-3 bg-sky-50 rounded-xl">
                                    <p class="text-2xl font-bold text-sky-600">{{ $doctor['experience'] ?? 0 }}</p>
                                    <p class="text-xs text-slate-500">Tahun Pengalaman</p>
                                </div>
                                <div class="text-center p-3 bg-emerald-50 rounded-xl">
                                    <p class="text-2xl font-bold text-emerald-600">
                                        {{ number_format($doctor['totalPatients'] ?? 0) }}+</p>
                                    <p class="text-xs text-slate-500">Pasien</p>
                                </div>
                            </div>

                            {{-- Bio --}}
                            @if(!empty($doctor['bio']))
                                <div class="mb-6">
                                    <h3 class="font-semibold text-slate-800 mb-2">Tentang Dokter</h3>
                                    <p class="text-slate-600 text-sm leading-relaxed">
                                        {{ $doctor['bio'] }}
                                    </p>
                                </div>
                            @endif

                            {{-- Education --}}
                            @if(!empty($doctor['education']))
                                <div class="mb-6">
                                    <h3 class="font-semibold text-slate-800 mb-2">Pendidikan</h3>
                                    <ul class="space-y-2 text-sm text-slate-600">
                                        <li class="flex items-start">
                                            <i data-lucide="graduation-cap" class="w-4 h-4 mr-2 mt-0.5 text-sky-500"></i>
                                            {{ $doctor['education'] }}
                                        </li>
                                    </ul>
                                </div>
                            @endif

                            {{-- Contact Info --}}
                            <div class="mb-6">
                                <h3 class="font-semibold text-slate-800 mb-2">Kontak</h3>
                                <ul class="space-y-2 text-sm text-slate-600">
                                    @if(!empty($doctor['email']))
                                        <li class="flex items-center">
                                            <i data-lucide="mail" class="w-4 h-4 mr-2 text-sky-500"></i>
                                            {{ $doctor['email'] }}
                                        </li>
                                    @endif
                                    @if(!empty($doctor['phone']))
                                        <li class="flex items-center">
                                            <i data-lucide="phone" class="w-4 h-4 mr-2 text-sky-500"></i>
                                            {{ $doctor['phone'] }}
                                        </li>
                                    @endif
                                </ul>
                            </div>

                            {{-- Layanan berdasarkan spesialisasi --}}
                            <div>
                                <h3 class="font-semibold text-slate-800 mb-2">Layanan</h3>
                                <div class="flex flex-wrap gap-2">
                                    @php
                                        $services = [
                                            'Dokter Gigi Umum' => ['Pemeriksaan Gigi', 'Pembersihan Karang Gigi', 'Tambal Gigi', 'Cabut Gigi'],
                                            'Konservasi Gigi' => ['Tambal Gigi', 'Perawatan Saluran Akar', 'Veneer', 'Crown'],
                                            'Ortodonti' => ['Kawat Gigi', 'Invisalign', 'Retainer', 'Konsultasi Ortodonti'],
                                            'Bedah Mulut' => ['Cabut Gigi Bungsu', 'Implant', 'Operasi Mulut', 'Biopsi'],
                                            'Kedokteran Gigi Anak' => ['Pemeriksaan Anak', 'Fluoride Treatment', 'Fissure Sealant', 'Perawatan Gigi Susu'],
                                            'Prostodonti' => ['Gigi Tiruan', 'Crown', 'Bridge', 'Implant'],
                                            'Periodonti' => ['Pembersihan Karang Gigi', 'Perawatan Gusi', 'Bedah Periodontal', 'Scaling'],
                                            'Endodonti' => ['Perawatan Saluran Akar', 'Retreatment', 'Apikoektomi', 'Bleaching Internal'],
                                        ];
                                        $specialty = $doctor['specialty'] ?? 'Dokter Gigi Umum';
                                        $doctorServices = $services[$specialty] ?? $services['Dokter Gigi Umum'];
                                    @endphp
                                    @foreach($doctorServices as $service)
                                        <span
                                            class="px-3 py-1 bg-slate-100 rounded-lg text-sm text-slate-600">{{ $service }}</span>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Right Column - Schedule --}}
                <div class="lg:col-span-2" id="jadwal" x-data="scheduleManager()">
                    <div class="bg-white rounded-3xl border border-slate-200 p-6 lg:p-8">
                        <h2 class="text-2xl font-bold text-slate-800 mb-6 flex items-center">
                            <i data-lucide="calendar" class="w-6 h-6 mr-3 text-sky-500"></i>
                            Jadwal Ketersediaan
                        </h2>

                        {{-- Weekly Schedule from Doctor Data --}}
                        @php
                            $schedule = $doctor['schedule'] ?? [];
                            $dayLabels = [
                                'senin' => 'Senin',
                                'selasa' => 'Selasa',
                                'rabu' => 'Rabu',
                                'kamis' => 'Kamis',
                                'jumat' => 'Jumat',
                                'sabtu' => 'Sabtu',
                                'minggu' => 'Minggu'
                            ];
                        @endphp

                        <div class="mb-8">
                            <h4 class="text-sm font-semibold text-slate-500 uppercase tracking-wider mb-4">
                                Jadwal Praktik Mingguan
                            </h4>

                            <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-3">
                                @foreach($dayLabels as $dayKey => $dayLabel)
                                    @php
                                        $time = $schedule[$dayKey] ?? '-';
                                        $isAvailable = $time !== '-' && !empty($time);
                                    @endphp
                                    <div
                                        class="p-4 rounded-xl {{ $isAvailable ? 'bg-emerald-50 border-2 border-emerald-200' : 'bg-slate-50 border-2 border-slate-200' }}">
                                        <p class="font-medium {{ $isAvailable ? 'text-emerald-700' : 'text-slate-500' }} mb-1">
                                            {{ $dayLabel }}</p>
                                        <p class="text-sm {{ $isAvailable ? 'text-emerald-600' : 'text-slate-400' }}">
                                            @if($isAvailable)
                                                <i data-lucide="clock" class="w-3 h-3 inline mr-1"></i>
                                                {{ $time }}
                                            @else
                                                <i data-lucide="x-circle" class="w-3 h-3 inline mr-1"></i>
                                                Libur
                                            @endif
                                        </p>
                                    </div>
                                @endforeach
                            </div>
                        </div>

                        {{-- Date Selection --}}
                        <div class="mb-8">
                            <h4 class="text-sm font-semibold text-slate-500 uppercase tracking-wider mb-4">
                                Pilih Tanggal
                            </h4>

                            <div class="flex items-center justify-between mb-4">
                                <button @click="prevWeek()"
                                    class="p-2 rounded-xl bg-slate-100 hover:bg-slate-200 transition">
                                    <i data-lucide="chevron-left" class="w-5 h-5 text-slate-600"></i>
                                </button>
                                <h3 class="text-lg font-semibold text-slate-800" x-text="currentMonthYear">
                                </h3>
                                <button @click="nextWeek()"
                                    class="p-2 rounded-xl bg-slate-100 hover:bg-slate-200 transition">
                                    <i data-lucide="chevron-right" class="w-5 h-5 text-slate-600"></i>
                                </button>
                            </div>

                            <div class="grid grid-cols-7 gap-2">
                                <template x-for="(day, index) in weekDays" :key="index">
                                    <div class="text-center">
                                        <p class="text-xs text-slate-500 mb-1" x-text="day.label"></p>
                                        <button @click="selectDate(day)" :class="{
                                                    'bg-sky-500 text-white': day.dateStr === selectedDate,
                                                    'bg-slate-100 text-slate-400 cursor-not-allowed': !day.isAvailable,
                                                    'bg-emerald-50 border-2 border-emerald-500 text-emerald-700 hover:bg-emerald-100': day.isAvailable && day.dateStr !== selectedDate
                                                }" :disabled="!day.isAvailable"
                                            class="w-full py-3 rounded-xl font-semibold transition" x-text="day.date">
                                        </button>
                                    </div>
                                </template>
                            </div>
                        </div>

                        {{-- Time Slots --}}
                        <div class="mb-8" x-show="selectedDate">
                            <h4 class="text-sm font-semibold text-slate-500 uppercase tracking-wider mb-4">
                                Pilih Waktu - <span x-text="selectedDateFormatted"></span>
                            </h4>

                            <div class="grid grid-cols-3 sm:grid-cols-4 md:grid-cols-6 gap-2">
                                <template x-for="slot in timeSlots" :key="slot.time">
                                    <button @click="selectTime(slot.time)" :class="{
                                                'bg-sky-500 text-white': selectedTime === slot.time,
                                                'bg-slate-100 text-slate-400 cursor-not-allowed line-through': !slot.available,
                                                'bg-emerald-50 border-2 border-emerald-500 text-emerald-700 hover:bg-emerald-100': slot.available && selectedTime !== slot.time
                                            }" :disabled="!slot.available"
                                        class="py-3 px-4 rounded-xl text-sm font-medium transition" x-text="slot.time">
                                    </button>
                                </template>
                            </div>
                        </div>

                        {{-- Legend --}}
                        <div class="flex flex-wrap items-center gap-4 mb-8 p-4 bg-slate-50 rounded-xl">
                            <div class="flex items-center space-x-2">
                                <div class="w-4 h-4 bg-emerald-500 rounded"></div>
                                <span class="text-sm text-slate-600">Tersedia</span>
                            </div>
                            <div class="flex items-center space-x-2">
                                <div class="w-4 h-4 bg-slate-300 rounded"></div>
                                <span class="text-sm text-slate-600">Tidak Tersedia</span>
                            </div>
                            <div class="flex items-center space-x-2">
                                <div class="w-4 h-4 bg-sky-500 rounded"></div>
                                <span class="text-sm text-slate-600">Dipilih</span>
                            </div>
                        </div>

                        {{-- Action --}}
                        <div x-show="selectedDate && selectedTime"
                            class="flex flex-col sm:flex-row items-center justify-between gap-4 p-6 bg-gradient-to-r from-sky-50 to-emerald-50 rounded-2xl">
                            <div>
                                <p class="text-sm text-slate-600">Jadwal yang dipilih:</p>
                                <p class="text-lg font-bold text-slate-800">
                                    <span x-text="selectedDateFormatted"></span> - <span x-text="selectedTime"></span> WIB
                                </p>
                            </div>
                            <a href="{{ url('/patients/register') }}?doctor={{ $doctor['id'] }}"
                                class="inline-flex items-center px-8 py-4 bg-gradient-to-r from-sky-500 to-emerald-500 text-white font-bold rounded-xl shadow-lg shadow-sky-500/30 hover:shadow-sky-500/50 hover:scale-105 transition-all duration-300">
                                <i data-lucide="calendar-check" class="w-5 h-5 mr-2"></i>
                                Buat Janji
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection

@push('scripts')
    <script>
        // Pass PHP data to JavaScript
        const doctorSchedule = @json($doctor['schedule'] ?? []);

        function scheduleManager() {
            return {
                currentWeekStart: null,
                weekDays: [],
                selectedDate: null,
                selectedTime: null,
                timeSlots: [],

                init() {
                    // Start from today
                    const today = new Date();
                    today.setHours(0, 0, 0, 0);
                    this.currentWeekStart = this.getMonday(today);
                    this.generateWeek();
                },

                get currentMonthYear() {
                    if (!this.currentWeekStart) return '';
                    const options = { month: 'long', year: 'numeric' };
                    return this.currentWeekStart.toLocaleDateString('id-ID', options);
                },

                get selectedDateFormatted() {
                    if (!this.selectedDate) return '';
                    const date = new Date(this.selectedDate);
                    const options = { weekday: 'long', day: 'numeric', month: 'long', year: 'numeric' };
                    return date.toLocaleDateString('id-ID', options);
                },

                getMonday(date) {
                    const d = new Date(date);
                    const day = d.getDay();
                    const diff = d.getDate() - day + (day === 0 ? -6 : 1);
                    return new Date(d.setDate(diff));
                },

                generateWeek() {
                    const dayNames = ['Min', 'Sen', 'Sel', 'Rab', 'Kam', 'Jum', 'Sab'];
                    const dayKeys = ['minggu', 'senin', 'selasa', 'rabu', 'kamis', 'jumat', 'sabtu'];
                    const today = new Date();
                    today.setHours(0, 0, 0, 0);

                    this.weekDays = [];
                    for (let i = 0; i < 7; i++) {
                        const date = new Date(this.currentWeekStart);
                        date.setDate(date.getDate() + i);

                        const dayIndex = date.getDay();
                        const dayKey = dayKeys[dayIndex];
                        const scheduleTime = doctorSchedule[dayKey] || '-';
                        const isPast = date < today;
                        const isAvailable = scheduleTime !== '-' && scheduleTime !== '' && !isPast;

                        this.weekDays.push({
                            label: dayNames[dayIndex],
                            date: date.getDate(),
                            dateStr: date.toISOString().split('T')[0],
                            dayKey: dayKey,
                            scheduleTime: scheduleTime,
                            isAvailable: isAvailable
                        });
                    }
                },

                prevWeek() {
                    this.currentWeekStart.setDate(this.currentWeekStart.getDate() - 7);
                    this.generateWeek();
                    this.selectedDate = null;
                    this.selectedTime = null;
                    this.timeSlots = [];
                },

                nextWeek() {
                    this.currentWeekStart.setDate(this.currentWeekStart.getDate() + 7);
                    this.generateWeek();
                    this.selectedDate = null;
                    this.selectedTime = null;
                    this.timeSlots = [];
                },

                selectDate(day) {
                    if (!day.isAvailable) return;

                    this.selectedDate = day.dateStr;
                    this.selectedTime = null;
                    this.generateTimeSlots(day.scheduleTime);
                },

                generateTimeSlots(scheduleTime) {
                    this.timeSlots = [];

                    if (!scheduleTime || scheduleTime === '-') return;

                    // Parse schedule time like "09:00 - 15:00"
                    const parts = scheduleTime.split(' - ');
                    if (parts.length !== 2) return;

                    const startHour = parseInt(parts[0].split(':')[0]);
                    const endHour = parseInt(parts[1].split(':')[0]);

                    // Generate hourly slots
                    for (let hour = startHour; hour < endHour; hour++) {
                        const time = hour.toString().padStart(2, '0') + ':00';
                        // Randomly mark some as unavailable for demo
                        // In real app, this would check against appointments
                        const available = Math.random() > 0.3;
                        this.timeSlots.push({ time, available });
                    }
                },

                selectTime(time) {
                    this.selectedTime = time;
                }
            }
        }
    </script>
@endpush