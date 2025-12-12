{{-- 
    Daftar Dokter Page
    ------------------
    Halaman untuk menampilkan semua dokter yang tersedia.
    
    Features:
    - Grid card dokter
    - Filter berdasarkan spesialisasi
    - Search dokter
--}}

@extends('layouts.app')

@section('title', 'Daftar Dokter - Klinik Gigi Sehat')

@section('content')

{{-- Hero Section --}}
<section class="bg-gradient-to-br from-sky-50 via-white to-emerald-50 py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center">
            <span class="inline-flex items-center px-4 py-2 bg-sky-100 text-sky-700 rounded-full text-sm font-medium mb-4 animate-pulse">
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
            <div class="relative w-full md:w-96 group">
                <i data-lucide="search" class="absolute left-4 top-1/2 -translate-y-1/2 w-5 h-5 text-slate-400 group-focus-within:text-sky-500 transition-colors"></i>
                <input 
                    type="text" 
                    id="searchInput"
                    placeholder="Cari nama dokter atau spesialisasi..."
                    class="w-full pl-12 pr-4 py-3 bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-sky-500 focus:border-sky-500 focus:bg-white transition-all duration-300"
                >
            </div>
            
            {{-- Filter Buttons --}}
            <div class="flex items-center space-x-2 overflow-x-auto pb-2 md:pb-0" id="filterButtons">
                @php
                    // Get unique specialties from doctors
                    $specialties = collect($doctors)->pluck('specialty')->unique()->filter()->values()->toArray();
                @endphp
                
                <button 
                    data-filter="all" 
                    class="filter-btn active px-5 py-2.5 rounded-xl font-medium whitespace-nowrap transition-all duration-300 transform hover:scale-105 hover:shadow-lg bg-gradient-to-r from-sky-500 to-sky-600 text-white shadow-lg shadow-sky-500/25"
                >
                    <i data-lucide="users" class="w-4 h-4 inline mr-1.5"></i>
                    Semua
                </button>
                
                @foreach($specialties as $specialty)
                <button 
                    data-filter="{{ $specialty }}" 
                    class="filter-btn px-5 py-2.5 bg-white border-2 border-slate-200 text-slate-700 hover:border-sky-400 hover:text-sky-600 hover:bg-sky-50 rounded-xl font-medium whitespace-nowrap transition-all duration-300 transform hover:scale-105 hover:shadow-md"
                >
                    {{ $specialty }}
                </button>
                @endforeach
            </div>
        </div>
    </div>
</section>

{{-- Doctors Grid --}}
<section class="py-12 bg-slate-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        {{-- Results Info --}}
        <div class="flex items-center justify-between mb-8">
            <p class="text-slate-600" id="resultsInfo">
                Menampilkan <span class="font-semibold text-slate-800" id="doctorCount">{{ count($doctors) }}</span> dokter
            </p>
        </div>
        
        {{-- Grid --}}
        <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-8" id="doctorsGrid">
            @forelse($doctors as $index => $doctor)
                <div class="doctor-card" data-specialty="{{ $doctor['specialty'] ?? '' }}" data-name="{{ strtolower($doctor['name'] ?? '') }}" style="animation-delay: {{ $index * 100 }}ms">
                    @include('components.card-doctor', [
                        'name' => $doctor['name'] ?? 'Nama Dokter',
                        'specialty' => $doctor['specialty'] ?? 'Spesialisasi',
                        'image' => $doctor['photo'] ?? 'https://ui-avatars.com/api/?name=' . urlencode($doctor['name'] ?? 'Doctor') . '&background=0ea5e9&color=fff&size=400',
                        'experience' => $doctor['experience'] ?? '0',
                        'id' => $doctor['id'] ?? ''
                    ])
                </div>
            @empty
                <div class="col-span-3 text-center py-12" id="emptyState">
                    <i data-lucide="user-x" class="w-16 h-16 text-slate-300 mx-auto mb-4"></i>
                    <h3 class="text-xl font-semibold text-slate-600 mb-2">Belum Ada Dokter</h3>
                    <p class="text-slate-500">Data dokter belum tersedia. Silakan tambahkan dokter melalui panel admin.</p>
                </div>
            @endforelse
        </div>
        
        {{-- No Results Message (Hidden by default) --}}
        <div class="hidden text-center py-12" id="noResults">
            <i data-lucide="search-x" class="w-16 h-16 text-slate-300 mx-auto mb-4"></i>
            <h3 class="text-xl font-semibold text-slate-600 mb-2">Tidak Ditemukan</h3>
            <p class="text-slate-500">Tidak ada dokter yang sesuai dengan pencarian Anda.</p>
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
        <a href="tel:+6212345678" class="inline-flex items-center px-6 py-3 bg-white text-sky-600 font-semibold rounded-xl shadow-lg hover:shadow-xl hover:scale-105 transition-all duration-300">
            <i data-lucide="phone" class="w-5 h-5 mr-2"></i>
            Hubungi Kami
        </a>
    </div>
</section>

@endsection

@push('styles')
<style>
    .doctor-card {
        animation: fadeInUp 0.5s ease-out forwards;
        opacity: 0;
    }
    
    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
    
    .doctor-card.hidden {
        display: none;
    }
    
    .filter-btn.active {
        background: linear-gradient(to right, #0ea5e9, #0284c7);
        color: white;
        border-color: transparent;
        box-shadow: 0 10px 15px -3px rgba(14, 165, 233, 0.25);
    }
    
    .filter-btn:not(.active):hover {
        transform: scale(1.05);
    }
</style>
@endpush

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const filterButtons = document.querySelectorAll('.filter-btn');
    const doctorCards = document.querySelectorAll('.doctor-card');
    const searchInput = document.getElementById('searchInput');
    const doctorCount = document.getElementById('doctorCount');
    const noResults = document.getElementById('noResults');
    const doctorsGrid = document.getElementById('doctorsGrid');
    
    let currentFilter = 'all';
    let currentSearch = '';
    
    // Filter function
    function filterDoctors() {
        let visibleCount = 0;
        
        doctorCards.forEach((card, index) => {
            const specialty = card.dataset.specialty;
            const name = card.dataset.name;
            
            const matchesFilter = currentFilter === 'all' || specialty === currentFilter;
            const matchesSearch = currentSearch === '' || 
                name.includes(currentSearch.toLowerCase()) || 
                specialty.toLowerCase().includes(currentSearch.toLowerCase());
            
            if (matchesFilter && matchesSearch) {
                card.classList.remove('hidden');
                card.style.animationDelay = `${visibleCount * 100}ms`;
                card.style.animation = 'none';
                card.offsetHeight; // Trigger reflow
                card.style.animation = 'fadeInUp 0.5s ease-out forwards';
                visibleCount++;
            } else {
                card.classList.add('hidden');
            }
        });
        
        // Update count
        doctorCount.textContent = visibleCount;
        
        // Show/hide no results message
        if (visibleCount === 0 && doctorCards.length > 0) {
            noResults.classList.remove('hidden');
            doctorsGrid.classList.add('hidden');
        } else {
            noResults.classList.add('hidden');
            doctorsGrid.classList.remove('hidden');
        }
    }
    
    // Filter button click handler
    filterButtons.forEach(btn => {
        btn.addEventListener('click', function() {
            // Update active state
            filterButtons.forEach(b => {
                b.classList.remove('active');
                b.classList.remove('bg-gradient-to-r', 'from-sky-500', 'to-sky-600', 'text-white', 'shadow-lg', 'shadow-sky-500/25');
                b.classList.add('bg-white', 'border-2', 'border-slate-200', 'text-slate-700');
            });
            
            this.classList.add('active');
            this.classList.remove('bg-white', 'border-2', 'border-slate-200', 'text-slate-700');
            this.classList.add('bg-gradient-to-r', 'from-sky-500', 'to-sky-600', 'text-white', 'shadow-lg', 'shadow-sky-500/25');
            
            currentFilter = this.dataset.filter;
            filterDoctors();
        });
    });
    
    // Search input handler
    searchInput.addEventListener('input', function() {
        currentSearch = this.value;
        filterDoctors();
    });
});
</script>
@endpush
