{{--
Jadwal Dokter Page
------------------
Halaman untuk menampilkan profil lengkap dan jadwal dokter.

Features:
- Profil dokter lengkap
- Kalender/tabel jadwal ketersediaan
- Tombol buat janji

TODO Backend:
- Fetch data dokter berdasarkan ID
- Fetch jadwal dari database
- Implementasi real-time availability
--}}

@extends('layouts.app')

@section('title', 'Jadwal Dr. Andi Pratama - Klinik Gigi Sehat')

@section('content')

    {{-- Breadcrumb --}}
    <section class="bg-slate-50 border-b border-slate-200 py-4">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <nav class="flex items-center space-x-2 text-sm">
                <a href="{{ url('/') }}" class="text-slate-500 hover:text-sky-600 transition">Home</a>
                <i data-lucide="chevron-right" class="w-4 h-4 text-slate-400"></i>
                <a href="{{ url('/doctors') }}" class="text-slate-500 hover:text-sky-600 transition">Dokter</a>
                <i data-lucide="chevron-right" class="w-4 h-4 text-slate-400"></i>
                <span class="text-slate-800 font-medium">Dr. Andi Pratama</span>
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
                            <img src="https://images.unsplash.com/photo-1612349317150-e413f6a5b16d?w=400&h=400&fit=crop"
                                alt="Dr. Andi Pratama" class="w-full h-72 object-cover">
                            <div
                                class="absolute top-4 right-4 px-3 py-1.5 bg-white/90 backdrop-blur-sm rounded-xl flex items-center space-x-1 shadow-lg">
                                <i data-lucide="star" class="w-4 h-4 text-amber-500 fill-amber-500"></i>
                                <span class="text-sm font-semibold text-slate-800">4.9</span>
                            </div>
                        </div>

                        {{-- Info --}}
                        <div class="p-6">
                            <h1 class="text-2xl font-bold text-slate-800 mb-1">Dr. Andi Pratama, Sp.KG</h1>
                            <p class="text-sky-600 font-medium mb-4 flex items-center">
                                <i data-lucide="stethoscope" class="w-4 h-4 mr-2"></i>
                                Dokter Gigi Konservasi
                            </p>

                            {{-- Stats --}}
                            <div class="grid grid-cols-2 gap-4 mb-6">
                                <div class="text-center p-3 bg-sky-50 rounded-xl">
                                    <p class="text-2xl font-bold text-sky-600">12</p>
                                    <p class="text-xs text-slate-500">Tahun Pengalaman</p>
                                </div>
                                <div class="text-center p-3 bg-emerald-50 rounded-xl">
                                    <p class="text-2xl font-bold text-emerald-600">2.5K+</p>
                                    <p class="text-xs text-slate-500">Pasien</p>
                                </div>
                            </div>

                            {{-- Bio --}}
                            <div class="mb-6">
                                <h3 class="font-semibold text-slate-800 mb-2">Tentang Dokter</h3>
                                <p class="text-slate-600 text-sm leading-relaxed">
                                    Dr. Andi Pratama adalah spesialis konservasi gigi dengan pengalaman lebih dari 12 tahun.
                                    Beliau menyelesaikan pendidikan spesialis di Universitas Indonesia dan telah menangani
                                    ribuan kasus perawatan gigi.
                                </p>
                            </div>

                            {{-- Education --}}
                            <div class="mb-6">
                                <h3 class="font-semibold text-slate-800 mb-2">Pendidikan</h3>
                                <ul class="space-y-2 text-sm text-slate-600">
                                    <li class="flex items-start">
                                        <i data-lucide="graduation-cap" class="w-4 h-4 mr-2 mt-0.5 text-sky-500"></i>
                                        Sp. Konservasi Gigi - Universitas Indonesia
                                    </li>
                                    <li class="flex items-start">
                                        <i data-lucide="graduation-cap" class="w-4 h-4 mr-2 mt-0.5 text-sky-500"></i>
                                        Dokter Gigi - Universitas Gadjah Mada
                                    </li>
                                </ul>
                            </div>

                            {{-- Layanan --}}
                            <div>
                                <h3 class="font-semibold text-slate-800 mb-2">Layanan</h3>
                                <div class="flex flex-wrap gap-2">
                                    <span class="px-3 py-1 bg-slate-100 rounded-lg text-sm text-slate-600">Tambal
                                        Gigi</span>
                                    <span class="px-3 py-1 bg-slate-100 rounded-lg text-sm text-slate-600">Perawatan Saluran
                                        Akar</span>
                                    <span class="px-3 py-1 bg-slate-100 rounded-lg text-sm text-slate-600">Veneer</span>
                                    <span class="px-3 py-1 bg-slate-100 rounded-lg text-sm text-slate-600">Crown</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Right Column - Schedule --}}
                <div class="lg:col-span-2" id="jadwal">
                    <div class="bg-white rounded-3xl border border-slate-200 p-6 lg:p-8">
                        <h2 class="text-2xl font-bold text-slate-800 mb-6 flex items-center">
                            <i data-lucide="calendar" class="w-6 h-6 mr-3 text-sky-500"></i>
                            Jadwal Ketersediaan
                        </h2>

                        {{-- Week Navigation --}}
                        <div class="flex items-center justify-between mb-6">
                            <button class="p-2 rounded-xl bg-slate-100 hover:bg-slate-200 transition">
                                <i data-lucide="chevron-left" class="w-5 h-5 text-slate-600"></i>
                            </button>
                            <h3 class="text-lg font-semibold text-slate-800">
                                Desember 2024
                            </h3>
                            <button class="p-2 rounded-xl bg-slate-100 hover:bg-slate-200 transition">
                                <i data-lucide="chevron-right" class="w-5 h-5 text-slate-600"></i>
                            </button>
                        </div>

                        {{-- Week Days --}}
                        <div class="grid grid-cols-7 gap-2 mb-6">
                            @php
                                $days = ['Sen', 'Sel', 'Rab', 'Kam', 'Jum', 'Sab', 'Min'];
                                $dates = [9, 10, 11, 12, 13, 14, 15];
                            @endphp

                            @foreach($days as $index => $day)
                                <div class="text-center">
                                    <p class="text-xs text-slate-500 mb-1">{{ $day }}</p>
                                    <button
                                        class="w-full py-3 rounded-xl {{ $dates[$index] == 11 ? 'bg-sky-500 text-white' : 'bg-slate-100 text-slate-700 hover:bg-sky-100' }} font-semibold transition">
                                        {{ $dates[$index] }}
                                    </button>
                                </div>
                            @endforeach
                        </div>

                        {{-- Time Slots --}}
                        <div class="mb-8">
                            <h4 class="text-sm font-semibold text-slate-500 uppercase tracking-wider mb-4">
                                Pilih Waktu - Rabu, 11 Desember 2024
                            </h4>

                            {{-- Morning --}}
                            <div class="mb-6">
                                <p class="text-sm text-slate-600 mb-3 flex items-center">
                                    <i data-lucide="sunrise" class="w-4 h-4 mr-2 text-amber-500"></i>
                                    Pagi
                                </p>
                                <div class="grid grid-cols-3 sm:grid-cols-4 gap-2">
                                    <button
                                        class="py-3 px-4 bg-slate-100 text-slate-400 rounded-xl text-sm font-medium cursor-not-allowed line-through">
                                        08:00
                                    </button>
                                    <button
                                        class="py-3 px-4 bg-emerald-50 border-2 border-emerald-500 text-emerald-700 rounded-xl text-sm font-medium hover:bg-emerald-100 transition">
                                        09:00
                                    </button>
                                    <button
                                        class="py-3 px-4 bg-emerald-50 border-2 border-emerald-500 text-emerald-700 rounded-xl text-sm font-medium hover:bg-emerald-100 transition">
                                        10:00
                                    </button>
                                    <button
                                        class="py-3 px-4 bg-emerald-50 border-2 border-emerald-500 text-emerald-700 rounded-xl text-sm font-medium hover:bg-emerald-100 transition">
                                        11:00
                                    </button>
                                </div>
                            </div>

                            {{-- Afternoon --}}
                            <div class="mb-6">
                                <p class="text-sm text-slate-600 mb-3 flex items-center">
                                    <i data-lucide="sun" class="w-4 h-4 mr-2 text-orange-500"></i>
                                    Siang
                                </p>
                                <div class="grid grid-cols-3 sm:grid-cols-4 gap-2">
                                    <button
                                        class="py-3 px-4 bg-slate-100 text-slate-400 rounded-xl text-sm font-medium cursor-not-allowed line-through">
                                        13:00
                                    </button>
                                    <button
                                        class="py-3 px-4 bg-slate-100 text-slate-400 rounded-xl text-sm font-medium cursor-not-allowed line-through">
                                        14:00
                                    </button>
                                    <button
                                        class="py-3 px-4 bg-emerald-50 border-2 border-emerald-500 text-emerald-700 rounded-xl text-sm font-medium hover:bg-emerald-100 transition">
                                        15:00
                                    </button>
                                    <button
                                        class="py-3 px-4 bg-emerald-50 border-2 border-emerald-500 text-emerald-700 rounded-xl text-sm font-medium hover:bg-emerald-100 transition">
                                        16:00
                                    </button>
                                </div>
                            </div>

                            {{-- Evening --}}
                            <div>
                                <p class="text-sm text-slate-600 mb-3 flex items-center">
                                    <i data-lucide="sunset" class="w-4 h-4 mr-2 text-purple-500"></i>
                                    Sore
                                </p>
                                <div class="grid grid-cols-3 sm:grid-cols-4 gap-2">
                                    <button
                                        class="py-3 px-4 bg-emerald-50 border-2 border-emerald-500 text-emerald-700 rounded-xl text-sm font-medium hover:bg-emerald-100 transition">
                                        17:00
                                    </button>
                                    <button
                                        class="py-3 px-4 bg-emerald-50 border-2 border-emerald-500 text-emerald-700 rounded-xl text-sm font-medium hover:bg-emerald-100 transition">
                                        18:00
                                    </button>
                                    <button
                                        class="py-3 px-4 bg-emerald-50 border-2 border-emerald-500 text-emerald-700 rounded-xl text-sm font-medium hover:bg-emerald-100 transition">
                                        19:00
                                    </button>
                                    <button
                                        class="py-3 px-4 bg-slate-100 text-slate-400 rounded-xl text-sm font-medium cursor-not-allowed line-through">
                                        20:00
                                    </button>
                                </div>
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
                        <div
                            class="flex flex-col sm:flex-row items-center justify-between gap-4 p-6 bg-gradient-to-r from-sky-50 to-emerald-50 rounded-2xl">
                            <div>
                                <p class="text-sm text-slate-600">Jadwal yang dipilih:</p>
                                <p class="text-lg font-bold text-slate-800">Rabu, 11 Desember 2024 - 09:00 WIB</p>
                            </div>
                            <a href="{{ url('/patients/register') }}"
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