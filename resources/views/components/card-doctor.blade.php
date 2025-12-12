{{-- 
    Card Doctor Component
    ---------------------
    Komponen card untuk menampilkan informasi dokter.
    
    Props yang tersedia:
    - $name: Nama dokter
    - $specialty: Spesialisasi dokter
    - $image: URL foto dokter
    - $experience: Pengalaman (tahun)
    - $rating: Rating dokter
    - $id: ID dokter untuk link ke jadwal
    
    Contoh penggunaan:
    @include('components.card-doctor', [
        'name' => 'Dr. Andi Pratama',
        'specialty' => 'Dokter Gigi Umum',
        'image' => '/images/doctor1.jpg',
        'experience' => '10',
        'rating' => '4.9',
        'id' => 1
    ])
    
    TODO Backend:
    - Replace dummy data dengan data dari database
    - Tambahkan logic untuk menampilkan jadwal available
--}}

@props([
    'name' => 'Dr. Nama Dokter',
    'specialty' => 'Spesialisasi',
    'image' => 'https://ui-avatars.com/api/?name=Doctor&background=0ea5e9&color=fff&size=200',
    'experience' => '5',
    'id' => 1
])

<div class="group bg-white rounded-3xl shadow-lg shadow-slate-200/50 overflow-hidden hover:shadow-xl hover:shadow-sky-500/10 transition-all duration-300 hover:-translate-y-2">
    {{-- Image Container --}}
    <div class="relative h-64 overflow-hidden">
        <img 
            src="{{ $image }}" 
            alt="Foto {{ $name }}"
            class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500"
        >
        {{-- Gradient Overlay --}}
        <div class="absolute inset-0 bg-gradient-to-t from-slate-900/80 via-transparent to-transparent"></div>
        
        {{-- Experience Badge --}}
        <div class="absolute bottom-4 left-4">
            <span class="px-3 py-1.5 bg-sky-500/90 backdrop-blur-sm text-white text-sm font-medium rounded-xl">
                {{ $experience }} Tahun Pengalaman
            </span>
        </div>
    </div>
    
    {{-- Content --}}
    <div class="p-6">
        {{-- Name & Specialty --}}
        <h3 class="text-xl font-bold text-slate-800 mb-1 group-hover:text-sky-600 transition-colors">
            {{ $name }}
        </h3>
        <p class="text-slate-500 flex items-center mb-4">
            <i data-lucide="stethoscope" class="w-4 h-4 mr-2 text-sky-500"></i>
            {{ $specialty }}
        </p>
        
        {{-- Availability Indicator --}}
        <div class="flex items-center mb-4">
            <span class="w-2.5 h-2.5 bg-emerald-500 rounded-full mr-2 animate-pulse"></span>
            <span class="text-sm text-emerald-600 font-medium">Tersedia Hari Ini</span>
        </div>
        
        {{-- Action Button --}}
        <a 
            href="{{ url('/doctors/' . $id . '/schedule') }}" 
            class="flex items-center justify-center w-full px-6 py-3 bg-gradient-to-r from-sky-500 to-sky-600 text-white font-semibold rounded-xl shadow-lg shadow-sky-500/25 hover:shadow-sky-500/40 hover:from-sky-600 hover:to-sky-700 transition-all duration-200 group/btn"
        >
            <i data-lucide="calendar-search" class="w-5 h-5 mr-2 group-hover/btn:scale-110 transition-transform"></i>
            Lihat Jadwal
        </a>
    </div>
</div>
