{{--
Service Detail Page
-------------------
Halaman detail untuk setiap layanan.
--}}

@extends('layouts.app')

@section('title', $service['name'] . ' - Klinik Gigi Sehat')

@section('content')

    {{-- Hero Section --}}
    <section class="relative py-20 bg-gradient-to-br from-sky-50 via-white to-emerald-50 overflow-hidden">
        <div class="absolute inset-0">
            <div class="absolute -top-40 -right-40 w-96 h-96 bg-sky-200 rounded-full opacity-30 blur-3xl"></div>
            <div class="absolute -bottom-40 -left-40 w-80 h-80 bg-emerald-200 rounded-full opacity-30 blur-3xl"></div>
        </div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            {{-- Breadcrumb --}}
            <nav class="flex items-center space-x-2 text-sm text-slate-500 mb-8">
                <a href="{{ url('/') }}" class="hover:text-sky-600 transition">Beranda</a>
                <i data-lucide="chevron-right" class="w-4 h-4"></i>
                <a href="{{ url('/services') }}" class="hover:text-sky-600 transition">Layanan</a>
                <i data-lucide="chevron-right" class="w-4 h-4"></i>
                <span class="text-slate-800 font-medium">{{ $service['name'] }}</span>
            </nav>

            <div class="grid lg:grid-cols-2 gap-12 items-center">
                {{-- Left Content --}}
                <div>
                    <div class="flex flex-wrap items-center gap-3 mb-6">
                        <span
                            class="inline-flex items-center px-4 py-2 bg-sky-100 text-sky-700 rounded-full text-sm font-medium">
                            <i data-lucide="heart" class="w-4 h-4 mr-2"></i>
                            Layanan Kami
                        </span>
                        @if(isset($service['category']))
                            <span
                                class="inline-flex items-center px-4 py-2 bg-emerald-100 text-emerald-700 rounded-full text-sm font-medium">
                                <i data-lucide="tag" class="w-4 h-4 mr-2"></i>
                                {{ $service['category'] }}
                            </span>
                        @endif
                        @if(isset($service['popular']) && $service['popular'])
                            <span
                                class="inline-flex items-center px-4 py-2 bg-amber-100 text-amber-700 rounded-full text-sm font-medium">
                                <i data-lucide="star" class="w-4 h-4 mr-2"></i>
                                Populer
                            </span>
                        @endif
                    </div>
                    <h1 class="text-4xl sm:text-5xl font-extrabold text-slate-800 mb-6">
                        {{ $service['name'] }}
                    </h1>
                    <p class="text-lg text-slate-600 mb-8">
                        {{ $service['full_description'] ?? $service['description'] }}
                    </p>

                    {{-- Quick Info --}}
                    <div class="flex flex-wrap gap-4 mb-8">
                        <div class="flex items-center px-4 py-2 bg-white rounded-xl shadow-sm border border-slate-100">
                            <i data-lucide="clock" class="w-5 h-5 text-sky-500 mr-2"></i>
                            <span class="text-slate-700 font-medium">{{ $service['duration'] }} menit</span>
                        </div>
                        <div class="flex items-center px-4 py-2 bg-white rounded-xl shadow-sm border border-slate-100">
                            <i data-lucide="tag" class="w-5 h-5 text-emerald-500 mr-2"></i>
                            <span class="text-slate-700 font-medium">Rp
                                {{ number_format($service['price'], 0, ',', '.') }}</span>
                        </div>
                    </div>

                    {{-- CTA --}}
                    <div class="flex flex-col sm:flex-row gap-4">
                        <a href="{{ url('/patients/register') }}"
                            class="inline-flex items-center justify-center px-8 py-4 bg-gradient-to-r from-sky-500 to-emerald-500 text-white font-bold rounded-2xl shadow-xl shadow-sky-500/30 hover:shadow-sky-500/50 hover:scale-105 transition-all duration-300">
                            <i data-lucide="calendar-plus" class="w-5 h-5 mr-2"></i>
                            Buat Janji Sekarang
                        </a>
                        <a href="tel:+6212345678"
                            class="inline-flex items-center justify-center px-8 py-4 bg-white text-slate-700 font-semibold rounded-2xl shadow-lg hover:shadow-xl transition-all duration-300 border border-slate-200">
                            <i data-lucide="phone" class="w-5 h-5 mr-2 text-sky-500"></i>
                            Hubungi Kami
                        </a>
                    </div>
                </div>

                {{-- Right Content - Image --}}
                <div class="flex justify-center">
                    <div class="relative">
                        <div class="w-80 h-80 rounded-3xl overflow-hidden shadow-2xl">
                            <img src="{{ $service['image'] ?? '/images/services/default.png' }}"
                                alt="{{ $service['name'] }}" class="w-full h-full object-cover">
                        </div>
                        {{-- Floating Badge --}}
                        <div class="absolute -bottom-4 -right-4 bg-white px-6 py-3 rounded-2xl shadow-xl">
                            <div class="flex items-center space-x-2">
                                <div class="w-10 h-10 bg-emerald-100 rounded-full flex items-center justify-center">
                                    <i data-lucide="check" class="w-5 h-5 text-emerald-600"></i>
                                </div>
                                <span class="font-semibold text-slate-800">Tersedia</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Detail Section --}}
    <section class="py-16 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid lg:grid-cols-3 gap-12">
                {{-- Main Content --}}
                <div class="lg:col-span-2 space-y-8">
                    {{-- About Service --}}
                    <div class="bg-gradient-to-br from-slate-50 to-white rounded-3xl p-8 border border-slate-100">
                        <h2 class="text-2xl font-bold text-slate-800 mb-4 flex items-center">
                            <i data-lucide="info" class="w-6 h-6 mr-3 text-sky-500"></i>
                            Tentang Layanan Ini
                        </h2>
                        <div class="prose prose-slate max-w-none">
                            <p class="text-slate-600 leading-relaxed">
                                {{ $service['full_description'] ?? $service['description'] }}
                            </p>
                            @if(isset($service['benefits']) && is_array($service['benefits']))
                                <h3 class="text-lg font-semibold text-slate-800 mt-6 mb-3">Manfaat:</h3>
                                <ul class="space-y-2">
                                    @foreach($service['benefits'] as $benefit)
                                        <li class="flex items-start">
                                            <i data-lucide="check-circle"
                                                class="w-5 h-5 text-emerald-500 mr-3 mt-0.5 flex-shrink-0"></i>
                                            <span class="text-slate-600">{{ $benefit }}</span>
                                        </li>
                                    @endforeach
                                </ul>
                            @endif
                        </div>
                    </div>

                    {{-- Process --}}
                    <div class="bg-gradient-to-br from-slate-50 to-white rounded-3xl p-8 border border-slate-100">
                        <h2 class="text-2xl font-bold text-slate-800 mb-6 flex items-center">
                            <i data-lucide="list-ordered" class="w-6 h-6 mr-3 text-emerald-500"></i>
                            Proses Perawatan
                        </h2>
                        <div class="space-y-4">
                            @php
                                $processes = $service['process'] ?? [
                                    'Konsultasi awal dengan dokter',
                                    'Pemeriksaan kondisi gigi',
                                    'Penjelasan prosedur dan biaya',
                                    'Pelaksanaan perawatan',
                                    'Kontrol dan evaluasi'
                                ];
                            @endphp
                            @foreach($processes as $index => $step)
                                <div class="flex items-start">
                                    <div
                                        class="w-8 h-8 bg-gradient-to-br from-sky-500 to-emerald-500 rounded-full flex items-center justify-center text-white font-bold text-sm flex-shrink-0 mr-4">
                                        {{ $index + 1 }}
                                    </div>
                                    <p class="text-slate-600 pt-1">{{ $step }}</p>
                                </div>
                            @endforeach
                        </div>

                        {{-- FAQ Section --}}
                        <div class="bg-gradient-to-br from-slate-50 to-white rounded-3xl p-8 border border-slate-100"
                            x-data="{ openFaq: null }">
                            <h2 class="text-2xl font-bold text-slate-800 mb-6 flex items-center">
                                <i data-lucide="help-circle" class="w-6 h-6 mr-3 text-purple-500"></i>
                                Pertanyaan Umum
                            </h2>
                            <div class="space-y-4">
                                @php
                                    $faqs = [
                                        [
                                            'question' => 'Berapa lama prosedur ' . strtolower($service['name']) . ' berlangsung?',
                                            'answer' => 'Prosedur ' . strtolower($service['name']) . ' biasanya membutuhkan waktu sekitar ' . $service['duration'] . ' menit. Durasi dapat bervariasi tergantung kondisi pasien.'
                                        ],
                                        [
                                            'question' => 'Apakah prosedur ini menyakitkan?',
                                            'answer' => 'Kami menggunakan anestesi lokal dan teknologi modern untuk memastikan kenyamanan Anda selama prosedur. Rasa tidak nyaman minimal dan kami akan memastikan Anda merasa nyaman.'
                                        ],
                                        [
                                            'question' => 'Berapa biaya untuk prosedur ini?',
                                            'answer' => 'Biaya ' . strtolower($service['name']) . ' mulai dari Rp ' . number_format($service['price'], 0, ',', '.') . '. Harga final dapat bervariasi tergantung kompleksitas kasus dan kebutuhan spesifik pasien.'
                                        ],
                                        [
                                            'question' => 'Apakah ada persiapan khusus sebelum prosedur?',
                                            'answer' => 'Untuk sebagian besar prosedur, tidak diperlukan persiapan khusus. Namun, kami sarankan untuk makan terlebih dahulu dan menginformasikan kondisi kesehatan atau obat yang sedang dikonsumsi.'
                                        ]
                                    ];
                                @endphp
                                @foreach($faqs as $index => $faq)
                                    <div class="border border-slate-200 rounded-xl overflow-hidden">
                                        <button @click="openFaq = openFaq === {{ $index }} ? null : {{ $index }}"
                                            class="w-full px-6 py-4 text-left flex items-center justify-between bg-white hover:bg-slate-50 transition-colors">
                                            <span class="font-medium text-slate-800">{{ $faq['question'] }}</span>
                                            <i data-lucide="chevron-down"
                                                class="w-5 h-5 text-slate-400 transition-transform duration-300"
                                                :class="{ 'rotate-180': openFaq === {{ $index }} }"></i>
                                        </button>
                                        <div x-show="openFaq === {{ $index }}"
                                            x-transition:enter="transition ease-out duration-200"
                                            x-transition:enter-start="opacity-0 -translate-y-2"
                                            x-transition:enter-end="opacity-100 translate-y-0"
                                            class="px-6 py-4 bg-slate-50 border-t border-slate-200">
                                            <p class="text-slate-600">{{ $faq['answer'] }}</p>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>

                    {{-- Sidebar --}}
                    <div class="space-y-6">
                        {{-- Price Card --}}
                        <div class="bg-gradient-to-br from-sky-500 to-emerald-500 rounded-3xl p-8 text-white">
                            <h3 class="text-lg font-semibold mb-2 opacity-90">Mulai dari</h3>
                            <p class="text-4xl font-bold mb-4">Rp {{ number_format($service['price'], 0, ',', '.') }}</p>
                            <p class="text-white/80 text-sm mb-6">
                                *Harga dapat bervariasi tergantung kondisi dan kebutuhan pasien
                            </p>
                            <a href="{{ url('/patients/register') }}"
                                class="w-full inline-flex items-center justify-center px-6 py-4 bg-white text-sky-600 font-bold rounded-xl shadow-lg hover:shadow-xl hover:scale-105 transition-all">
                                <i data-lucide="calendar-plus" class="w-5 h-5 mr-2"></i>
                                Buat Janji
                            </a>
                        </div>

                        {{-- Info Card --}}
                        <div class="bg-gradient-to-br from-slate-50 to-white rounded-3xl p-6 border border-slate-100">
                            <h3 class="text-lg font-bold text-slate-800 mb-4">Informasi Tambahan</h3>
                            <div class="space-y-4">
                                <div class="flex items-center">
                                    <div class="w-10 h-10 bg-sky-100 rounded-xl flex items-center justify-center mr-4">
                                        <i data-lucide="clock" class="w-5 h-5 text-sky-600"></i>
                                    </div>
                                    <div>
                                        <p class="text-sm text-slate-500">Durasi</p>
                                        <p class="font-semibold text-slate-800">{{ $service['duration'] }} menit</p>
                                    </div>
                                </div>
                                <div class="flex items-center">
                                    <div class="w-10 h-10 bg-emerald-100 rounded-xl flex items-center justify-center mr-4">
                                        <i data-lucide="shield-check" class="w-5 h-5 text-emerald-600"></i>
                                    </div>
                                    <div>
                                        <p class="text-sm text-slate-500">Garansi</p>
                                        <p class="font-semibold text-slate-800">Sesuai ketentuan</p>
                                    </div>
                                </div>
                                <div class="flex items-center">
                                    <div class="w-10 h-10 bg-amber-100 rounded-xl flex items-center justify-center mr-4">
                                        <i data-lucide="user-check" class="w-5 h-5 text-amber-600"></i>
                                    </div>
                                    <div>
                                        <p class="text-sm text-slate-500">Ditangani oleh</p>
                                        <p class="font-semibold text-slate-800">Dokter Spesialis</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- Contact Card --}}
                        <div class="bg-gradient-to-br from-slate-50 to-white rounded-3xl p-6 border border-slate-100">
                            <h3 class="text-lg font-bold text-slate-800 mb-4">Ada Pertanyaan?</h3>
                            <p class="text-slate-600 text-sm mb-4">
                                Hubungi kami untuk informasi lebih lanjut tentang layanan ini.
                            </p>
                            <a href="tel:+6212345678"
                                class="w-full inline-flex items-center justify-center px-6 py-3 bg-slate-100 text-slate-700 font-semibold rounded-xl hover:bg-slate-200 transition-all">
                                <i data-lucide="phone" class="w-5 h-5 mr-2"></i>
                                (021) 1234-5678
                            </a>
                        </div>
                    </div>
                </div>
            </div>
    </section>

    {{-- Related Services --}}
    <section class="py-16 bg-gradient-to-b from-white to-slate-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h2 class="text-2xl font-bold text-slate-800 mb-8">Layanan Lainnya</h2>
            <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-6" x-data="relatedServices()" x-init="init()">
                <template x-for="service in services.filter(s => s.id !== '{{ $service['id'] }}').slice(0, 3)"
                    :key="service.id">
                    <a :href="'/services/' + service.id"
                        class="group bg-white rounded-2xl overflow-hidden shadow-sm hover:shadow-xl transition-all duration-300 border border-slate-100">
                        <div class="h-32 overflow-hidden">
                            <img :src="service.image" :alt="service.name"
                                class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-300">
                        </div>
                        <div class="p-6">
                            <h3 class="font-bold text-slate-800 mb-2" x-text="service.name"></h3>
                            <p class="text-sm text-slate-600 line-clamp-2" x-text="service.description"></p>
                            <p class="text-sky-600 font-semibold mt-3" x-text="formatPrice(service.price)"></p>
                        </div>
                    </a>
                </template>
            </div>
        </div>
    </section>

    {{-- CTA Section --}}
    <section class="py-16 bg-gradient-to-r from-sky-600 to-emerald-600">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h2 class="text-3xl font-bold text-white mb-4">Siap Untuk Memulai Perawatan?</h2>
            <p class="text-white/90 mb-8">
                Jadwalkan kunjungan Anda sekarang dan dapatkan perawatan {{ $service['name'] }} terbaik.
            </p>
            <a href="{{ url('/patients/register') }}"
                class="inline-flex items-center px-8 py-4 bg-white text-sky-600 font-bold rounded-2xl shadow-xl hover:shadow-2xl hover:scale-105 transition-all">
                <i data-lucide="calendar-plus" class="w-5 h-5 mr-2"></i>
                Buat Janji Sekarang
            </a>
        </div>
    </section>

@endsection

@push('scripts')
    <script>
        function relatedServices() {
            return {
                services: [],

                async init() {
                    try {
                        const res = await fetch('/data/services.json');
                        const data = await res.json();
                        this.services = data.services || [];
                    } catch (error) {
                        console.error('Error loading services:', error);
                    }
                    setTimeout(() => lucide.createIcons(), 100);
                },

                formatPrice(price) {
                    return 'Rp ' + price.toLocaleString('id-ID');
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