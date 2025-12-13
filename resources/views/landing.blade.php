{{--
Landing Page
------------
Halaman utama website klinik gigi.

Sections:
1. Hero Section dengan CTA
2. Section Layanan Klinik
3. Section Profil Dokter
4. Section Testimoni
5. Section CTA Final

TODO Backend:
- Fetch data dokter dari database
- Fetch testimoni dari database
- Tambahkan dynamic layanan klinik
--}}

@extends('layouts.app')

@section('title', 'Klinik Gigi Sehat - Layanan Kesehatan Gigi Profesional')

@section('content')

    {{-- Hero Section --}}
    <section
        class="relative min-h-[90vh] flex items-center overflow-hidden bg-gradient-to-br from-sky-50 via-white to-emerald-50">
        {{-- Background Decorations --}}
        <div class="absolute inset-0 overflow-hidden">
            <div class="absolute -top-40 -right-40 w-96 h-96 bg-sky-200 rounded-full opacity-30 blur-3xl"></div>
            <div class="absolute top-1/2 -left-40 w-80 h-80 bg-emerald-200 rounded-full opacity-30 blur-3xl"></div>
            <div class="absolute -bottom-40 right-1/4 w-72 h-72 bg-amber-200 rounded-full opacity-20 blur-3xl"></div>
        </div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20 relative z-10">
            <div class="grid lg:grid-cols-2 gap-12 items-center">
                {{-- Left Content --}}
                <div class="text-center lg:text-left">
                    <div
                        class="inline-flex items-center px-4 py-2 bg-sky-100 text-sky-700 rounded-full text-sm font-medium mb-6 animate-fade-in">
                        <i data-lucide="sparkles" class="w-4 h-4 mr-2"></i>
                        Klinik Gigi Terpercaya #1 di Jakarta
                    </div>

                    <h1 class="text-4xl sm:text-5xl lg:text-6xl font-extrabold text-slate-800 leading-tight mb-6 animate-fade-in"
                        style="animation-delay: 0.1s">
                        Senyum Sehat,
                        <span class="gradient-text">Hidup Bahagia</span>
                    </h1>

                    <p class="text-lg text-slate-600 mb-8 max-w-xl mx-auto lg:mx-0 animate-fade-in"
                        style="animation-delay: 0.2s">
                        Dapatkan perawatan gigi terbaik dari dokter profesional dengan teknologi modern. Jadwalkan kunjungan
                        Anda sekarang dan rasakan perbedaannya.
                    </p>

                    <div class="flex flex-col sm:flex-row items-center justify-center lg:justify-start space-y-4 sm:space-y-0 sm:space-x-4 animate-fade-in"
                        style="animation-delay: 0.3s">
                        <a href="{{ url('/patients/register') }}"
                            class="inline-flex items-center px-8 py-4 bg-gradient-to-r from-sky-500 to-emerald-500 text-white font-bold rounded-2xl shadow-xl shadow-sky-500/30 hover:shadow-sky-500/50 hover:scale-105 transition-all duration-300">
                            <i data-lucide="calendar-plus" class="w-5 h-5 mr-2"></i>
                            Buat Janji Sekarang
                        </a>
                        <a href="{{ url('/doctors') }}"
                            class="inline-flex items-center px-8 py-4 bg-white text-slate-700 font-semibold rounded-2xl shadow-lg hover:shadow-xl transition-all duration-300 border border-slate-200">
                            <i data-lucide="users" class="w-5 h-5 mr-2 text-sky-500"></i>
                            Lihat Dokter Kami
                        </a>
                    </div>

                    {{-- Stats --}}
                    <div class="grid grid-cols-3 gap-6 mt-12 animate-fade-in" style="animation-delay: 0.4s">
                        <div class="text-center lg:text-left">
                            <p class="text-3xl font-bold text-sky-600">15+</p>
                            <p class="text-sm text-slate-500">Dokter Spesialis</p>
                        </div>
                        <div class="text-center lg:text-left">
                            <p class="text-3xl font-bold text-emerald-600">10K+</p>
                            <p class="text-sm text-slate-500">Pasien Puas</p>
                        </div>
                        <div class="text-center lg:text-left">
                            <p class="text-3xl font-bold text-amber-600">8</p>
                            <p class="text-sm text-slate-500">Tahun Pengalaman</p>
                        </div>
                    </div>
                </div>

                {{-- Right Content - Image --}}
                <div class="relative animate-fade-in" style="animation-delay: 0.3s">
                    <div class="relative z-10">
                        <img src="https://images.unsplash.com/photo-1629909613654-28e377c37b09?w=600&h=700&fit=crop"
                            alt="Dokter Gigi Profesional"
                            class="w-full max-w-lg mx-auto rounded-3xl shadow-2xl shadow-slate-300/50">
                    </div>

                    {{-- Floating Cards --}}
                    <div class="absolute -bottom-6 -left-6 bg-white p-4 rounded-2xl shadow-xl animate-float z-20">
                        <div class="flex items-center space-x-3">
                            <div class="w-12 h-12 bg-emerald-100 rounded-xl flex items-center justify-center">
                                <i data-lucide="check-circle" class="w-6 h-6 text-emerald-600"></i>
                            </div>
                            <div>
                                <p class="font-bold text-slate-800">100%</p>
                                <p class="text-sm text-slate-500">Kepuasan Pasien</p>
                            </div>
                        </div>
                    </div>

                    <div class="absolute -top-6 -right-6 bg-white p-4 rounded-2xl shadow-xl animate-float z-20"
                        style="animation-delay: 1s">
                        <div class="flex items-center space-x-3">
                            <div class="w-12 h-12 bg-sky-100 rounded-xl flex items-center justify-center">
                                <i data-lucide="award" class="w-6 h-6 text-sky-600"></i>
                            </div>
                            <div>
                                <p class="font-bold text-slate-800">Tersertifikasi</p>
                                <p class="text-sm text-slate-500">Dokter Profesional</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Services Section --}}
    <section class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            {{-- Section Header --}}
            <div class="text-center mb-16">
                <span
                    class="inline-flex items-center px-4 py-2 bg-sky-100 text-sky-700 rounded-full text-sm font-medium mb-4">
                    <i data-lucide="heart" class="w-4 h-4 mr-2"></i>
                    Layanan Kami
                </span>
                <h2 class="text-3xl sm:text-4xl font-bold text-slate-800 mb-4">
                    Pelayanan Kesehatan Gigi <span class="gradient-text">Terlengkap</span>
                </h2>
                <p class="text-slate-600 max-w-2xl mx-auto">
                    Kami menyediakan berbagai layanan perawatan gigi dengan standar internasional dan teknologi terkini.
                </p>
            </div>

            {{-- Services Grid --}}
            <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-8">
                {{-- Service 1: Pemeriksaan Gigi --}}
                <a href="{{ url('/services/S001') }}"
                    class="group block bg-white rounded-3xl border border-slate-100 hover:border-sky-200 hover:shadow-xl hover:shadow-sky-500/10 transition-all duration-300 overflow-hidden cursor-pointer">
                    <div class="h-48 overflow-hidden">
                        <img src="{{ asset('images/services/pemeriksaan_gigi.png') }}" alt="Pemeriksaan Gigi"
                            class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                    </div>
                    <div class="p-6">
                        <h3 class="text-xl font-bold text-slate-800 mb-3 group-hover:text-sky-600 transition-colors">
                            Pemeriksaan Gigi</h3>
                        <p class="text-slate-600 mb-4">Pemeriksaan menyeluruh untuk mendeteksi masalah gigi dan gusi sejak
                            dini.</p>
                        <span class="inline-flex items-center text-sky-600 font-semibold group-hover:text-sky-700">
                            Pelajari Lebih
                            <i data-lucide="arrow-right"
                                class="w-4 h-4 ml-2 group-hover:translate-x-1 transition-transform"></i>
                        </span>
                    </div>
                </a>

                {{-- Service 2: Pembersihan Karang --}}
                <a href="{{ url('/services/S002') }}"
                    class="group block bg-white rounded-3xl border border-slate-100 hover:border-emerald-200 hover:shadow-xl hover:shadow-emerald-500/10 transition-all duration-300 overflow-hidden cursor-pointer">
                    <div class="h-48 overflow-hidden">
                        <img src="{{ asset('images/services/pembersihan_karang.png') }}" alt="Pembersihan Karang"
                            class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                    </div>
                    <div class="p-6">
                        <h3 class="text-xl font-bold text-slate-800 mb-3 group-hover:text-emerald-600 transition-colors">
                            Pembersihan Karang</h3>
                        <p class="text-slate-600 mb-4">Scaling dan pembersihan karang gigi untuk kesehatan mulut optimal.
                        </p>
                        <span class="inline-flex items-center text-emerald-600 font-semibold group-hover:text-emerald-700">
                            Pelajari Lebih
                            <i data-lucide="arrow-right"
                                class="w-4 h-4 ml-2 group-hover:translate-x-1 transition-transform"></i>
                        </span>
                    </div>
                </a>

                {{-- Service 3: Bleaching Gigi --}}
                <a href="{{ url('/services/S005') }}"
                    class="group block bg-white rounded-3xl border border-slate-100 hover:border-amber-200 hover:shadow-xl hover:shadow-amber-500/10 transition-all duration-300 overflow-hidden cursor-pointer">
                    <div class="h-48 overflow-hidden">
                        <img src="{{ asset('images/services/bleaching_gigi.png') }}" alt="Bleaching Gigi"
                            class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                    </div>
                    <div class="p-6">
                        <h3 class="text-xl font-bold text-slate-800 mb-3 group-hover:text-amber-600 transition-colors">
                            Bleaching Gigi</h3>
                        <p class="text-slate-600 mb-4">Pemutihan gigi profesional untuk senyum yang lebih cerah dan percaya
                            diri.</p>
                        <span class="inline-flex items-center text-amber-600 font-semibold group-hover:text-amber-700">
                            Pelajari Lebih
                            <i data-lucide="arrow-right"
                                class="w-4 h-4 ml-2 group-hover:translate-x-1 transition-transform"></i>
                        </span>
                    </div>
                </a>

                {{-- Service 4: Kawat Gigi --}}
                <a href="{{ url('/services/S007') }}"
                    class="group block bg-white rounded-3xl border border-slate-100 hover:border-purple-200 hover:shadow-xl hover:shadow-purple-500/10 transition-all duration-300 overflow-hidden cursor-pointer">
                    <div class="h-48 overflow-hidden">
                        <img src="{{ asset('images/services/kawat_gigi.png') }}" alt="Kawat Gigi"
                            class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                    </div>
                    <div class="p-6">
                        <h3 class="text-xl font-bold text-slate-800 mb-3 group-hover:text-purple-600 transition-colors">
                            Kawat Gigi / Braces</h3>
                        <p class="text-slate-600 mb-4">Pemasangan kawat gigi untuk merapikan susunan gigi dengan hasil
                            maksimal.</p>
                        <span class="inline-flex items-center text-purple-600 font-semibold group-hover:text-purple-700">
                            Pelajari Lebih
                            <i data-lucide="arrow-right"
                                class="w-4 h-4 ml-2 group-hover:translate-x-1 transition-transform"></i>
                        </span>
                    </div>
                </a>

                {{-- Service 5: Perawatan Saluran Akar --}}
                <a href="{{ url('/services/S009') }}"
                    class="group block bg-white rounded-3xl border border-slate-100 hover:border-rose-200 hover:shadow-xl hover:shadow-rose-500/10 transition-all duration-300 overflow-hidden cursor-pointer">
                    <div class="h-48 overflow-hidden">
                        <img src="{{ asset('images/services/saluran_akar.png') }}" alt="Perawatan Saluran Akar"
                            class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                    </div>
                    <div class="p-6">
                        <h3 class="text-xl font-bold text-slate-800 mb-3 group-hover:text-rose-600 transition-colors">
                            Perawatan Saluran Akar</h3>
                        <p class="text-slate-600 mb-4">Perawatan saluran akar untuk menyelamatkan gigi yang terinfeksi.</p>
                        <span class="inline-flex items-center text-rose-600 font-semibold group-hover:text-rose-700">
                            Pelajari Lebih
                            <i data-lucide="arrow-right"
                                class="w-4 h-4 ml-2 group-hover:translate-x-1 transition-transform"></i>
                        </span>
                    </div>
                </a>

                {{-- Service 6: Implan Gigi --}}
                <a href="{{ url('/services/S010') }}"
                    class="group block bg-white rounded-3xl border border-slate-100 hover:border-indigo-200 hover:shadow-xl hover:shadow-indigo-500/10 transition-all duration-300 overflow-hidden cursor-pointer">
                    <div class="h-48 overflow-hidden">
                        <img src="{{ asset('images/services/implan_gigi.png') }}" alt="Implan Gigi"
                            class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                    </div>
                    <div class="p-6">
                        <h3 class="text-xl font-bold text-slate-800 mb-3 group-hover:text-indigo-600 transition-colors">
                            Implan Gigi</h3>
                        <p class="text-slate-600 mb-4">Pemasangan implan gigi berkualitas tinggi untuk mengganti gigi yang
                            hilang.</p>
                        <span class="inline-flex items-center text-indigo-600 font-semibold group-hover:text-indigo-700">
                            Pelajari Lebih
                            <i data-lucide="arrow-right"
                                class="w-4 h-4 ml-2 group-hover:translate-x-1 transition-transform"></i>
                        </span>
                    </div>
                </a>
            </div>
        </div>
    </section>

    {{-- Doctors Section --}}
    <section class="py-20 bg-gradient-to-br from-slate-50 to-sky-50" x-data="doctorsSection()" x-init="init()">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            {{-- Section Header --}}
            <div class="text-center mb-16">
                <span
                    class="inline-flex items-center px-4 py-2 bg-emerald-100 text-emerald-700 rounded-full text-sm font-medium mb-4">
                    <i data-lucide="stethoscope" class="w-4 h-4 mr-2"></i>
                    Tim Dokter Kami
                </span>
                <h2 class="text-3xl sm:text-4xl font-bold text-slate-800 mb-4">
                    Dokter <span class="gradient-text">Profesional</span> & Berpengalaman
                </h2>
                <p class="text-slate-600 max-w-2xl mx-auto">
                    Didukung oleh tim dokter gigi tersertifikasi dengan pengalaman bertahun-tahun dalam bidangnya.
                </p>
            </div>

            {{-- Empty State --}}
            <div x-show="doctors.length === 0" class="text-center py-16">
                <div class="w-24 h-24 bg-slate-100 rounded-full flex items-center justify-center mx-auto mb-6">
                    <i data-lucide="stethoscope" class="w-12 h-12 text-slate-400"></i>
                </div>
                <h3 class="text-xl font-bold text-slate-800 mb-2">Segera Hadir</h3>
                <p class="text-slate-500 max-w-md mx-auto mb-6">
                    Tim dokter profesional kami akan segera tersedia. Hubungi kami untuk informasi lebih lanjut.
                </p>
                <a href="tel:+6212345678"
                    class="inline-flex items-center px-6 py-3 bg-sky-500 hover:bg-sky-600 text-white font-medium rounded-xl shadow-lg transition">
                    <i data-lucide="phone" class="w-5 h-5 mr-2"></i>
                    Hubungi Kami
                </a>
            </div>

            {{-- Doctors Grid --}}
            <div x-show="doctors.length > 0" class="grid sm:grid-cols-2 lg:grid-cols-3 gap-8">
                <template x-for="doctor in doctors.filter(d => d.status === 'active').slice(0, 3)" :key="doctor.id">
                    <div
                        class="group bg-white rounded-3xl overflow-hidden shadow-lg hover:shadow-2xl transition-all duration-300 border border-slate-100">
                        {{-- Photo --}}
                        <div class="relative h-64 overflow-hidden">
                            <template x-if="doctor.photo">
                                <img :src="doctor.photo" :alt="doctor.name"
                                    class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                            </template>
                            <template x-if="!doctor.photo">
                                <div class="w-full h-full flex items-center justify-center text-white text-6xl font-bold"
                                    :style="'background: linear-gradient(135deg, #' + doctor.color + ', #' + doctor.color + '99)'">
                                    <span x-text="doctor.name.split(' ')[1]?.charAt(0) || doctor.name.charAt(0)"></span>
                                </div>
                            </template>
                            <div class="absolute inset-0 bg-gradient-to-t from-slate-900/70 to-transparent"></div>
                            <div class="absolute bottom-4 left-4 right-4">
                                <h3 class="text-xl font-bold text-white" x-text="doctor.name"></h3>
                                <p class="text-white/80 text-sm" x-text="doctor.specialty"></p>
                            </div>
                        </div>

                        {{-- Info --}}
                        <div class="p-6">
                            <div class="flex items-center justify-between mb-4">
                                <div class="flex items-center text-slate-600">
                                    <i data-lucide="briefcase" class="w-4 h-4 mr-2 text-sky-500"></i>
                                    <span class="text-sm" x-text="doctor.experience + ' Tahun'"></span>
                                </div>
                                <div class="flex items-center text-slate-600">
                                    <i data-lucide="graduation-cap" class="w-4 h-4 mr-2 text-emerald-500"></i>
                                    <span class="text-sm truncate max-w-[100px]" x-text="doctor.education"></span>
                                </div>
                            </div>

                            <a :href="'/doctors/' + doctor.id + '/schedule'"
                                class="w-full inline-flex items-center justify-center px-4 py-3 bg-gradient-to-r from-sky-500 to-emerald-500 text-white font-semibold rounded-xl shadow-lg shadow-sky-500/30 hover:shadow-sky-500/50 hover:scale-105 transition-all">
                                <i data-lucide="calendar" class="w-5 h-5 mr-2"></i>
                                Lihat Jadwal
                            </a>
                        </div>
                    </div>
                </template>
            </div>

            {{-- View All Button --}}
            <div x-show="doctors.length > 0" class="text-center mt-12">
                <a href="{{ url('/doctors') }}"
                    class="inline-flex items-center px-8 py-4 bg-white text-slate-700 font-semibold rounded-2xl shadow-lg hover:shadow-xl transition-all duration-300 border border-slate-200 hover:border-sky-300">
                    <i data-lucide="users" class="w-5 h-5 mr-2 text-sky-500"></i>
                    Lihat Semua Dokter
                    <i data-lucide="arrow-right" class="w-5 h-5 ml-2"></i>
                </a>
            </div>
        </div>
    </section>

    @push('scripts')
        <script>
            function doctorsSection() {
                return {
                    doctors: [],

                    async init() {
                        try {
                            const res = await fetch('/api/doctors');
                            const data = await res.json();
                            this.doctors = data.doctors || [];
                        } catch (error) {
                            console.error('Error loading doctors:', error);
                        }
                        setTimeout(() => lucide.createIcons(), 100);
                    }
                }
            }
        </script>
    @endpush

    {{-- Testimonials Section --}}
    <section class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            {{-- Section Header --}}
            <div class="text-center mb-16">
                <span
                    class="inline-flex items-center px-4 py-2 bg-amber-100 text-amber-700 rounded-full text-sm font-medium mb-4">
                    <i data-lucide="message-square-quote" class="w-4 h-4 mr-2"></i>
                    Testimoni
                </span>
                <h2 class="text-3xl sm:text-4xl font-bold text-slate-800 mb-4">
                    Apa Kata <span class="gradient-text">Pasien Kami</span>
                </h2>
                <p class="text-slate-600 max-w-2xl mx-auto">
                    Pengalaman nyata dari pasien yang telah merasakan layanan kami.
                </p>
            </div>

            {{-- Testimonials Grid --}}
            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
                {{-- Testimonial 1 --}}
                <div class="p-8 bg-gradient-to-br from-sky-50 to-white rounded-3xl border border-sky-100">
                    <div class="flex items-center mb-4">
                        @for ($i = 0; $i < 5; $i++)
                            <i data-lucide="star" class="w-5 h-5 text-amber-400 fill-amber-400"></i>
                        @endfor
                    </div>
                    <p class="text-slate-600 mb-6 italic">
                        "Pelayanan yang sangat ramah dan profesional. Dokter menjelaskan dengan detail setiap prosedur yang
                        dilakukan. Sangat merekomendasikan klinik ini!"
                    </p>
                    <div class="flex items-center">
                        <img src="https://ui-avatars.com/api/?name=Budi+Santoso&background=0ea5e9&color=fff"
                            alt="Budi Santoso" class="w-12 h-12 rounded-full mr-4">
                        <div>
                            <p class="font-semibold text-slate-800">Budi Santoso</p>
                            <p class="text-sm text-slate-500">Pasien Reguler</p>
                        </div>
                    </div>
                </div>

                {{-- Testimonial 2 --}}
                <div class="p-8 bg-gradient-to-br from-emerald-50 to-white rounded-3xl border border-emerald-100">
                    <div class="flex items-center mb-4">
                        @for ($i = 0; $i < 5; $i++)
                            <i data-lucide="star" class="w-5 h-5 text-amber-400 fill-amber-400"></i>
                        @endfor
                    </div>
                    <p class="text-slate-600 mb-6 italic">
                        "Anak saya yang takut ke dokter gigi jadi berani setelah ditangani dengan sabar oleh tim dokter di
                        sini. Terima kasih banyak!"
                    </p>
                    <div class="flex items-center">
                        <img src="https://ui-avatars.com/api/?name=Dewi+Lestari&background=10b981&color=fff"
                            alt="Dewi Lestari" class="w-12 h-12 rounded-full mr-4">
                        <div>
                            <p class="font-semibold text-slate-800">Dewi Lestari</p>
                            <p class="text-sm text-slate-500">Ibu Rumah Tangga</p>
                        </div>
                    </div>
                </div>

                {{-- Testimonial 3 --}}
                <div class="p-8 bg-gradient-to-br from-amber-50 to-white rounded-3xl border border-amber-100">
                    <div class="flex items-center mb-4">
                        @for ($i = 0; $i < 5; $i++)
                            <i data-lucide="star" class="w-5 h-5 text-amber-400 fill-amber-400"></i>
                        @endfor
                    </div>
                    <p class="text-slate-600 mb-6 italic">
                        "Proses pembuatan janji online sangat mudah dan cepat. Tidak perlu antri lama. Fasilitas klinik juga
                        sangat modern dan bersih."
                    </p>
                    <div class="flex items-center">
                        <img src="https://ui-avatars.com/api/?name=Ahmad+Fauzi&background=f59e0b&color=fff"
                            alt="Ahmad Fauzi" class="w-12 h-12 rounded-full mr-4">
                        <div>
                            <p class="font-semibold text-slate-800">Ahmad Fauzi</p>
                            <p class="text-sm text-slate-500">Pengusaha</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- CTA Section --}}
    <section class="py-20 bg-gradient-to-r from-sky-600 to-emerald-600 relative overflow-hidden">
        {{-- Background Pattern --}}
        <div class="absolute inset-0 opacity-10">
            <div class="absolute top-0 left-0 w-40 h-40 bg-white rounded-full -translate-x-1/2 -translate-y-1/2"></div>
            <div class="absolute bottom-0 right-0 w-60 h-60 bg-white rounded-full translate-x-1/2 translate-y-1/2"></div>
        </div>

        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center relative z-10">
            <h2 class="text-3xl sm:text-4xl font-bold text-white mb-6">
                Siap Untuk Senyum Lebih Sehat?
            </h2>
            <p class="text-xl text-white/90 mb-8 max-w-2xl mx-auto">
                Jadwalkan kunjungan Anda sekarang dan dapatkan konsultasi gratis untuk perawatan pertama.
            </p>
            <div class="flex flex-col sm:flex-row items-center justify-center space-y-4 sm:space-y-0 sm:space-x-4">
                <a href="{{ url('/patients/register') }}"
                    class="inline-flex items-center px-8 py-4 bg-white text-sky-600 font-bold rounded-2xl shadow-xl hover:shadow-2xl hover:scale-105 transition-all duration-300">
                    <i data-lucide="calendar-plus" class="w-5 h-5 mr-2"></i>
                    Buat Janji Sekarang
                </a>
                <a href="tel:+6212345678"
                    class="inline-flex items-center px-8 py-4 bg-transparent text-white font-semibold rounded-2xl border-2 border-white/50 hover:bg-white/10 transition-all duration-300">
                    <i data-lucide="phone" class="w-5 h-5 mr-2"></i>
                    (021) 1234-5678
                </a>
            </div>
        </div>
    </section>

@endsection