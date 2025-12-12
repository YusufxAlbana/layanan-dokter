{{--
Services / Pricelist Page
-------------------------
Halaman daftar layanan dan harga.
--}}

@extends('layouts.app')

@section('title', 'Layanan & Harga')

@section('content')

    <div x-data="servicesPage()" x-init="init()">

        {{-- Hero Section --}}
        <section class="relative py-20 bg-gradient-to-br from-sky-50 via-white to-emerald-50 overflow-hidden">
            <div class="absolute inset-0">
                <div class="absolute -top-40 -right-40 w-96 h-96 bg-sky-200 rounded-full opacity-30 blur-3xl"></div>
                <div class="absolute -bottom-40 -left-40 w-80 h-80 bg-emerald-200 rounded-full opacity-30 blur-3xl"></div>
            </div>

            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
                <div class="text-center max-w-3xl mx-auto">
                    <span
                        class="inline-flex items-center px-4 py-2 bg-sky-100 text-sky-700 rounded-full text-sm font-medium mb-6">
                        <i data-lucide="list" class="w-4 h-4 mr-2"></i>
                        Layanan & Harga
                    </span>
                    <h1 class="text-4xl sm:text-5xl font-extrabold text-slate-800 mb-6">
                        Daftar <span class="gradient-text">Layanan</span> Kami
                    </h1>
                    <p class="text-lg text-slate-600">
                        Kami menyediakan berbagai layanan perawatan gigi dengan harga transparan dan terjangkau.
                        Semua perawatan dilakukan oleh dokter profesional dengan peralatan modern.
                    </p>
                </div>
            </div>
        </section>

        {{-- Filter & Search --}}
        <section class="py-8 bg-white border-b border-slate-100 sticky top-20 z-40">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex flex-col sm:flex-row items-center justify-between gap-4">
                    <div class="relative flex-1 max-w-md w-full">
                        <i data-lucide="search" class="absolute left-4 top-1/2 -translate-y-1/2 w-5 h-5 text-slate-400"></i>
                        <input type="text" x-model="search" placeholder="Cari layanan..."
                            class="w-full pl-12 pr-4 py-3 bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-sky-500 focus:border-sky-500 transition">
                    </div>
                    <div class="flex items-center space-x-2">
                        <span class="text-sm text-slate-500">Urutkan:</span>
                        <select x-model="sortBy"
                            class="px-4 py-2 bg-slate-50 border border-slate-200 rounded-xl text-sm focus:ring-2 focus:ring-sky-500">
                            <option value="name">Nama</option>
                            <option value="price-low">Harga Terendah</option>
                            <option value="price-high">Harga Tertinggi</option>
                        </select>
                    </div>
                </div>
            </div>
        </section>

        {{-- Services Grid --}}
        <section class="py-16 bg-gradient-to-b from-white to-slate-50">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

                {{-- Results Info --}}
                <div class="flex items-center justify-between mb-8">
                    <p class="text-slate-600">
                        Menampilkan <span class="font-semibold text-slate-800" x-text="filteredServices.length"></span>
                        layanan
                    </p>
                </div>

                {{-- Grid --}}
                <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-8">
                    <template x-for="service in filteredServices" :key="service.id">
                        <div
                            class="group bg-white rounded-3xl overflow-hidden shadow-lg hover:shadow-2xl transition-all duration-300 border border-slate-100">
                            {{-- Image Header --}}
                            <div class="relative h-48 overflow-hidden">
                                <img :src="service.image" :alt="service.name"
                                    class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                                <div class="absolute inset-0 bg-gradient-to-t from-black/30 to-transparent"></div>
                                {{-- Duration Badge --}}
                                <div
                                    class="absolute top-4 right-4 px-3 py-1 bg-white/90 backdrop-blur rounded-full text-sm font-medium text-slate-700">
                                    <i data-lucide="clock" class="w-4 h-4 inline mr-1"></i>
                                    <span x-text="service.duration + ' menit'"></span>
                                </div>
                            </div>

                            {{-- Content --}}
                            <div class="p-6">
                                <h3 class="text-xl font-bold text-slate-800 mb-2" x-text="service.name"></h3>
                                <p class="text-slate-600 text-sm mb-4 line-clamp-2" x-text="service.description"></p>

                                {{-- Price --}}
                                <div class="flex items-end justify-between mb-6">
                                    <div>
                                        <span class="text-sm text-slate-500">Mulai dari</span>
                                        <p class="text-2xl font-bold text-sky-600" x-text="formatPrice(service.price)"></p>
                                    </div>
                                </div>

                                {{-- CTA Button --}}
                                <a :href="'/services/' + service.id"
                                    class="w-full inline-flex items-center justify-center px-4 py-3 bg-gradient-to-r from-sky-500 to-emerald-500 text-white font-semibold rounded-xl shadow-lg shadow-sky-500/30 hover:shadow-sky-500/50 hover:scale-105 transition-all">
                                    <i data-lucide="eye" class="w-5 h-5 mr-2"></i>
                                    Lihat Layanan Detail
                                </a>
                            </div>
                        </div>
                    </template>
                </div>

                {{-- Empty State --}}
                <div x-show="filteredServices.length === 0" class="text-center py-16">
                    <div class="w-20 h-20 bg-slate-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i data-lucide="search-x" class="w-10 h-10 text-slate-400"></i>
                    </div>
                    <h3 class="text-xl font-bold text-slate-800 mb-2">Layanan Tidak Ditemukan</h3>
                    <p class="text-slate-500">Coba kata kunci lain atau hapus filter pencarian.</p>
                </div>
            </div>
        </section>

        {{-- Why Choose Us --}}
        <section class="py-16 bg-white">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center mb-12">
                    <h2 class="text-3xl font-bold text-slate-800 mb-4">Mengapa Memilih Kami?</h2>
                    <p class="text-slate-600 max-w-2xl mx-auto">
                        Kami berkomitmen memberikan layanan terbaik dengan harga yang transparan.
                    </p>
                </div>

                <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-8">
                    <div class="text-center p-6">
                        <div class="w-16 h-16 bg-sky-100 rounded-2xl flex items-center justify-center mx-auto mb-4">
                            <i data-lucide="shield-check" class="w-8 h-8 text-sky-600"></i>
                        </div>
                        <h3 class="font-bold text-slate-800 mb-2">Harga Transparan</h3>
                        <p class="text-sm text-slate-600">Tidak ada biaya tersembunyi. Semua harga sudah termasuk
                            konsultasi.</p>
                    </div>

                    <div class="text-center p-6">
                        <div class="w-16 h-16 bg-emerald-100 rounded-2xl flex items-center justify-center mx-auto mb-4">
                            <i data-lucide="award" class="w-8 h-8 text-emerald-600"></i>
                        </div>
                        <h3 class="font-bold text-slate-800 mb-2">Dokter Profesional</h3>
                        <p class="text-sm text-slate-600">Ditangani oleh dokter spesialis berpengalaman dan tersertifikasi.
                        </p>
                    </div>

                    <div class="text-center p-6">
                        <div class="w-16 h-16 bg-amber-100 rounded-2xl flex items-center justify-center mx-auto mb-4">
                            <i data-lucide="sparkles" class="w-8 h-8 text-amber-600"></i>
                        </div>
                        <h3 class="font-bold text-slate-800 mb-2">Peralatan Modern</h3>
                        <p class="text-sm text-slate-600">Menggunakan teknologi dan peralatan kedokteran gigi terkini.</p>
                    </div>

                    <div class="text-center p-6">
                        <div class="w-16 h-16 bg-purple-100 rounded-2xl flex items-center justify-center mx-auto mb-4">
                            <i data-lucide="heart" class="w-8 h-8 text-purple-600"></i>
                        </div>
                        <h3 class="font-bold text-slate-800 mb-2">Garansi Perawatan</h3>
                        <p class="text-sm text-slate-600">Garansi untuk beberapa jenis perawatan sesuai ketentuan.</p>
                    </div>
                </div>
            </div>
        </section>

        {{-- CTA Section --}}
        <section class="py-16 bg-gradient-to-r from-sky-600 to-emerald-600">
            <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
                <h2 class="text-3xl font-bold text-white mb-4">Ada Pertanyaan Tentang Layanan?</h2>
                <p class="text-white/90 mb-8">
                    Tim kami siap membantu menjawab pertanyaan Anda tentang layanan dan harga.
                </p>
                <div class="flex flex-col sm:flex-row items-center justify-center space-y-4 sm:space-y-0 sm:space-x-4">
                    <a href="{{ url('/patients/register') }}"
                        class="inline-flex items-center px-8 py-4 bg-white text-sky-600 font-bold rounded-2xl shadow-xl hover:shadow-2xl hover:scale-105 transition-all">
                        <i data-lucide="calendar-plus" class="w-5 h-5 mr-2"></i>
                        Buat Janji Konsultasi
                    </a>
                    <a href="tel:+6212345678"
                        class="inline-flex items-center px-8 py-4 bg-transparent text-white font-semibold rounded-2xl border-2 border-white/50 hover:bg-white/10 transition-all">
                        <i data-lucide="phone" class="w-5 h-5 mr-2"></i>
                        (021) 1234-5678
                    </a>
                </div>
            </div>
        </section>

    </div>

@endsection

@push('scripts')
    <script>
        function servicesPage() {
            return {
                services: [],
                search: '',
                sortBy: 'name',

                async init() {
                    await this.loadServices();
                    setTimeout(() => lucide.createIcons(), 100);
                },

                async loadServices() {
                    try {
                        const res = await fetch('/data/services.json');
                        const data = await res.json();
                        this.services = data.services || [];
                    } catch (error) {
                        console.error('Error loading services:', error);
                    }
                },

                get filteredServices() {
                    let result = this.services.filter(s =>
                        s.name.toLowerCase().includes(this.search.toLowerCase()) ||
                        s.description.toLowerCase().includes(this.search.toLowerCase())
                    );

                    if (this.sortBy === 'price-low') {
                        result.sort((a, b) => a.price - b.price);
                    } else if (this.sortBy === 'price-high') {
                        result.sort((a, b) => b.price - a.price);
                    } else {
                        result.sort((a, b) => a.name.localeCompare(b.name));
                    }

                    return result;
                },

                formatPrice(price) {
                    return 'Rp ' + price.toLocaleString('id-ID');
                },

                getGradientClass(id) {
                    const gradients = [
                        'bg-gradient-to-br from-sky-500 to-sky-600',
                        'bg-gradient-to-br from-emerald-500 to-emerald-600',
                        'bg-gradient-to-br from-amber-500 to-amber-600',
                        'bg-gradient-to-br from-purple-500 to-purple-600',
                        'bg-gradient-to-br from-rose-500 to-rose-600',
                        'bg-gradient-to-br from-indigo-500 to-indigo-600',
                        'bg-gradient-to-br from-cyan-500 to-cyan-600',
                        'bg-gradient-to-br from-pink-500 to-pink-600',
                        'bg-gradient-to-br from-teal-500 to-teal-600',
                        'bg-gradient-to-br from-orange-500 to-orange-600'
                    ];
                    const index = parseInt(id.replace('S', '')) - 1;
                    return gradients[index % gradients.length];
                },

                getIcon(name) {
                    const icons = {
                        'Pemeriksaan': 'search',
                        'Pembersihan': 'sparkles',
                        'Tambal': 'circle-dot',
                        'Cabut': 'scissors',
                        'Bleaching': 'sun',
                        'Konsultasi': 'message-circle',
                        'Kawat': 'git-branch',
                        'Crown': 'crown',
                        'Saluran': 'heart-pulse',
                        'Veneer': 'smile',
                        'Implan': 'plus-circle'
                    };

                    for (const [key, icon] of Object.entries(icons)) {
                        if (name.includes(key)) return icon;
                    }
                    return 'heart';
                }
            }
        }
    </script>
@endpush