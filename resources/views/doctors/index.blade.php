{{-- 
    Daftar Dokter Page
    ------------------
    Halaman untuk menampilkan semua dokter yang tersedia.
    
    Features:
    - Grid card dokter
    - Filter berdasarkan spesialisasi (placeholder)
    - Search dokter (placeholder)
    
    TODO Backend:
    - Fetch data dokter dari database
    - Implementasi filter dan search
    - Pagination
--}}

@extends('layouts.app')

@section('title', 'Daftar Dokter - Klinik Gigi Sehat')

@section('content')

{{-- Hero Section --}}
<section class="bg-gradient-to-br from-sky-50 via-white to-emerald-50 py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center">
            <span class="inline-flex items-center px-4 py-2 bg-sky-100 text-sky-700 rounded-full text-sm font-medium mb-4">
                <i data-lucide="stethoscope" class="w-4 h-4 mr-2"></i>
                Tim Dokter Profesional
            </span>
            <h1 class="text-4xl sm:text-5xl font-bold text-slate-800 mb-4">
                Temukan Dokter <span class="gradient-text">Terbaik</span> Kami
            </h1>
            <p class="text-lg text-slate-600 max-w-2xl mx-auto">
                Pilih dari tim dokter berpengalaman kami untuk perawatan gigi yang optimal sesuai kebutuhan Anda.
            </p>
        </div>
    </div>
</section>

{{-- Filter Section --}}
<section class="bg-white border-b border-slate-200 sticky top-20 z-30 shadow-sm">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4">
        <div class="flex flex-col md:flex-row items-center justify-between space-y-4 md:space-y-0">
            {{-- Search --}}
            <div class="relative w-full md:w-96">
                <i data-lucide="search" class="absolute left-4 top-1/2 -translate-y-1/2 w-5 h-5 text-slate-400"></i>
                <input 
                    type="text" 
                    placeholder="Cari nama dokter atau spesialisasi..."
                    class="w-full pl-12 pr-4 py-3 bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-sky-500 focus:border-sky-500 transition"
                >
            </div>
            
            {{-- Filter Buttons --}}
            <div class="flex items-center space-x-2 overflow-x-auto pb-2 md:pb-0">
                <button class="px-4 py-2 bg-sky-500 text-white rounded-xl font-medium whitespace-nowrap">
                    Semua
                </button>
                <button class="px-4 py-2 bg-slate-100 text-slate-700 hover:bg-slate-200 rounded-xl font-medium whitespace-nowrap transition">
                    Gigi Umum
                </button>
                <button class="px-4 py-2 bg-slate-100 text-slate-700 hover:bg-slate-200 rounded-xl font-medium whitespace-nowrap transition">
                    Ortodonti
                </button>
                <button class="px-4 py-2 bg-slate-100 text-slate-700 hover:bg-slate-200 rounded-xl font-medium whitespace-nowrap transition">
                    Bedah Mulut
                </button>
                <button class="px-4 py-2 bg-slate-100 text-slate-700 hover:bg-slate-200 rounded-xl font-medium whitespace-nowrap transition">
                    Anak
                </button>
            </div>
        </div>
    </div>
</section>

{{-- Doctors Grid --}}
<section class="py-12 bg-slate-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        {{-- Results Info --}}
        <div class="flex items-center justify-between mb-8">
            <p class="text-slate-600">
                Menampilkan <span class="font-semibold text-slate-800">6</span> dokter
            </p>
            <div class="flex items-center space-x-2">
                <span class="text-sm text-slate-500">Urutkan:</span>
                <select class="px-3 py-2 bg-white border border-slate-200 rounded-xl text-sm focus:ring-2 focus:ring-sky-500">
                    <option>Rating Tertinggi</option>
                    <option>Pengalaman Terbanyak</option>
                    <option>Nama A-Z</option>
                </select>
            </div>
        </div>
        
        {{-- Grid --}}
        <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-8">
            {{-- Doctor 1 --}}
            @include('components.card-doctor', [
                'name' => 'Dr. Andi Pratama, Sp.KG',
                'specialty' => 'Dokter Gigi Konservasi',
                'image' => 'https://images.unsplash.com/photo-1612349317150-e413f6a5b16d?w=400&h=400&fit=crop',
                'experience' => '12',
                'rating' => '4.9',
                'id' => 1
            ])
            
            {{-- Doctor 2 --}}
            @include('components.card-doctor', [
                'name' => 'Dr. Sarah Amanda, Sp.Ort',
                'specialty' => 'Dokter Gigi Ortodonti',
                'image' => 'https://images.unsplash.com/photo-1559839734-2b71ea197ec2?w=400&h=400&fit=crop',
                'experience' => '8',
                'rating' => '4.8',
                'id' => 2
            ])
            
            {{-- Doctor 3 --}}
            @include('components.card-doctor', [
                'name' => 'Dr. Rizki Hidayat, Sp.BM',
                'specialty' => 'Dokter Bedah Mulut',
                'image' => 'https://images.unsplash.com/photo-1622253692010-333f2da6031d?w=400&h=400&fit=crop',
                'experience' => '15',
                'rating' => '4.9',
                'id' => 3
            ])
            
            {{-- Doctor 4 --}}
            @include('components.card-doctor', [
                'name' => 'Dr. Maya Putri, Sp.KGA',
                'specialty' => 'Dokter Gigi Anak',
                'image' => 'https://images.unsplash.com/photo-1594824476967-48c8b964273f?w=400&h=400&fit=crop',
                'experience' => '6',
                'rating' => '4.7',
                'id' => 4
            ])
            
            {{-- Doctor 5 --}}
            @include('components.card-doctor', [
                'name' => 'Dr. Hendra Wijaya, Sp.Pros',
                'specialty' => 'Dokter Gigi Prosthodonti',
                'image' => 'https://images.unsplash.com/photo-1537368910025-700350fe46c7?w=400&h=400&fit=crop',
                'experience' => '10',
                'rating' => '4.8',
                'id' => 5
            ])
            
            {{-- Doctor 6 --}}
            @include('components.card-doctor', [
                'name' => 'Dr. Lisa Handayani',
                'specialty' => 'Dokter Gigi Umum',
                'image' => 'https://images.unsplash.com/photo-1551836022-d5d88e9218df?w=400&h=400&fit=crop',
                'experience' => '5',
                'rating' => '4.6',
                'id' => 6
            ])
        </div>
        
        {{-- Pagination --}}
        <div class="flex items-center justify-center mt-12 space-x-2">
            <button class="p-2 rounded-xl bg-white border border-slate-200 text-slate-400 hover:bg-slate-50 transition" disabled>
                <i data-lucide="chevron-left" class="w-5 h-5"></i>
            </button>
            <button class="w-10 h-10 rounded-xl bg-sky-500 text-white font-semibold">1</button>
            <button class="w-10 h-10 rounded-xl bg-white border border-slate-200 text-slate-700 hover:bg-slate-50 transition font-semibold">2</button>
            <button class="w-10 h-10 rounded-xl bg-white border border-slate-200 text-slate-700 hover:bg-slate-50 transition font-semibold">3</button>
            <button class="p-2 rounded-xl bg-white border border-slate-200 text-slate-700 hover:bg-slate-50 transition">
                <i data-lucide="chevron-right" class="w-5 h-5"></i>
            </button>
        </div>
    </div>
</section>

{{-- CTA Section --}}
<section class="py-16 bg-gradient-to-r from-sky-600 to-emerald-600">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <h2 class="text-2xl sm:text-3xl font-bold text-white mb-4">
            Tidak Menemukan Dokter yang Dicari?
        </h2>
        <p class="text-white/90 mb-6">
            Hubungi kami untuk bantuan dalam memilih dokter yang tepat untuk kebutuhan Anda.
        </p>
        <a href="tel:+6212345678" class="inline-flex items-center px-6 py-3 bg-white text-sky-600 font-semibold rounded-xl shadow-lg hover:shadow-xl transition">
            <i data-lucide="phone" class="w-5 h-5 mr-2"></i>
            Hubungi Kami
        </a>
    </div>
</section>

@endsection
