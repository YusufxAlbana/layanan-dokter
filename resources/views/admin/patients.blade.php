{{--
Admin Patients Page
-------------------
Halaman manajemen data pasien dengan data real dari JSON.
--}}

@extends('layouts.admin')

@section('title', 'Data Pasien')
@section('page-title', 'Data Pasien')

@section('content')

    <div x-data="patientsPage()" x-init="init()">

        {{-- Header --}}
        <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4 mb-6">
            <div>
                <p class="text-slate-600">Kelola data semua pasien klinik</p>
                <p class="text-xs text-slate-400 mt-1">Data pasien otomatis ditambahkan saat booking janji</p>
            </div>
            <div class="flex items-center gap-3">
                <button
                    class="inline-flex items-center px-4 py-2 bg-white border border-slate-200 text-slate-700 font-medium rounded-xl hover:bg-slate-50 transition">
                    <i data-lucide="download" class="w-5 h-5 mr-2"></i>
                    Export
                </button>
            </div>
        </div>

        {{-- Stats --}}
        <div class="grid sm:grid-cols-4 gap-4 mb-6">
            <div class="bg-white rounded-xl p-4 shadow-sm border border-slate-100">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-slate-500">Total Pasien</p>
                        <p class="text-2xl font-bold text-slate-800" x-text="patients.length">0</p>
                    </div>
                    <div class="w-10 h-10 bg-sky-100 rounded-lg flex items-center justify-center">
                        <i data-lucide="users" class="w-5 h-5 text-sky-600"></i>
                    </div>
                </div>
            </div>
            <div class="bg-white rounded-xl p-4 shadow-sm border border-slate-100">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-slate-500">Laki-laki</p>
                        <p class="text-2xl font-bold text-slate-800" x-text="patients.filter(p => p.gender === 'L').length">
                            0</p>
                    </div>
                    <div class="w-10 h-10 bg-blue-100 rounded-lg flex items-center justify-center">
                        <i data-lucide="user" class="w-5 h-5 text-blue-600"></i>
                    </div>
                </div>
            </div>
            <div class="bg-white rounded-xl p-4 shadow-sm border border-slate-100">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-slate-500">Perempuan</p>
                        <p class="text-2xl font-bold text-slate-800" x-text="patients.filter(p => p.gender === 'P').length">
                            0</p>
                    </div>
                    <div class="w-10 h-10 bg-pink-100 rounded-lg flex items-center justify-center">
                        <i data-lucide="user" class="w-5 h-5 text-pink-600"></i>
                    </div>
                </div>
            </div>
            <div class="bg-white rounded-xl p-4 shadow-sm border border-slate-100">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-slate-500">Dengan Alergi</p>
                        <p class="text-2xl font-bold text-red-600" x-text="patients.filter(p => p.allergy).length">0</p>
                    </div>
                    <div class="w-10 h-10 bg-red-100 rounded-lg flex items-center justify-center">
                        <i data-lucide="alert-triangle" class="w-5 h-5 text-red-600"></i>
                    </div>
                </div>
            </div>
        </div>

        {{-- Filters --}}
        <div class="bg-white rounded-2xl p-4 shadow-sm border border-slate-100 mb-6">
            <div class="flex flex-col md:flex-row items-center gap-4">
                <div class="relative flex-1 w-full">
                    <i data-lucide="search" class="absolute left-4 top-1/2 -translate-y-1/2 w-5 h-5 text-slate-400"></i>
                    <input type="text" x-model="search" placeholder="Cari nama, email, atau telepon..."
                        class="w-full pl-12 pr-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-sky-500 focus:border-sky-500 transition">
                </div>
                <select x-model="filterGender"
                    class="px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-sm focus:ring-2 focus:ring-sky-500">
                    <option value="">Semua Gender</option>
                    <option value="L">Laki-laki</option>
                    <option value="P">Perempuan</option>
                </select>
            </div>
        </div>

        {{-- Table --}}
        <div class="bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="bg-slate-50 border-b border-slate-200">
                        <tr>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider">
                                Pasien</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider">
                                Kontak</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider">
                                Gender</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider">
                                Alergi</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider">
                                Kunjungan Terakhir</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider">
                                Total</th>
                            <th class="px-6 py-4 text-center text-xs font-semibold text-slate-500 uppercase tracking-wider">
                                Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-200">
                        <template x-for="patient in filteredPatients" :key="patient.id">
                            <tr class="hover:bg-slate-50 transition">
                                <td class="px-6 py-4">
                                    <div class="flex items-center space-x-3">
                                        <div class="w-10 h-10 rounded-full flex items-center justify-center text-white font-bold"
                                            :style="'background-color: #' + patient.color">
                                            <span x-text="patient.name.charAt(0)"></span>
                                        </div>
                                        <div>
                                            <p class="font-medium text-slate-800" x-text="patient.name"></p>
                                            <p class="text-xs text-slate-500" x-text="'ID: ' + patient.id"></p>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    <p class="text-sm text-slate-800" x-text="patient.email"></p>
                                    <p class="text-xs text-slate-500" x-text="patient.phone"></p>
                                </td>
                                <td class="px-6 py-4">
                                    <span class="px-2.5 py-1 text-xs font-medium rounded-lg"
                                        :class="patient.gender === 'L' ? 'bg-blue-100 text-blue-700' : 'bg-pink-100 text-pink-700'"
                                        x-text="patient.gender === 'L' ? 'Laki-laki' : 'Perempuan'"></span>
                                </td>
                                <td class="px-6 py-4">
                                    <span x-show="patient.allergy"
                                        class="px-2.5 py-1 bg-red-100 text-red-700 text-xs font-medium rounded-lg"
                                        x-text="patient.allergy"></span>
                                    <span x-show="!patient.allergy" class="text-sm text-slate-400">-</span>
                                </td>
                                <td class="px-6 py-4">
                                    <p class="text-sm text-slate-800" x-text="formatDate(patient.lastVisit)"></p>
                                </td>
                                <td class="px-6 py-4">
                                    <span class="px-2.5 py-1 bg-sky-100 text-sky-700 text-xs font-medium rounded-lg"
                                        x-text="patient.totalVisits + ' kali'"></span>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="flex items-center justify-center space-x-2">
                                        <button class="p-2 hover:bg-slate-100 rounded-lg transition" title="Detail">
                                            <i data-lucide="eye" class="w-4 h-4 text-slate-500"></i>
                                        </button>
                                        <button class="p-2 hover:bg-sky-50 rounded-lg transition" title="Edit">
                                            <i data-lucide="pencil" class="w-4 h-4 text-sky-500"></i>
                                        </button>
                                        <a href="{{ url('/admin/medical-records') }}"
                                            class="p-2 hover:bg-emerald-50 rounded-lg transition" title="Rekam Medis">
                                            <i data-lucide="file-text" class="w-4 h-4 text-emerald-500"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        </template>
                    </tbody>
                </table>
            </div>

            {{-- Pagination Info --}}
            <div class="px-6 py-4 bg-slate-50 border-t border-slate-200">
                <p class="text-sm text-slate-600">
                    Menampilkan <span class="font-medium" x-text="filteredPatients.length"></span> dari <span
                        class="font-medium" x-text="patients.length"></span> pasien
                </p>
            </div>
        </div>
    </div>

@endsection

@push('scripts')
    <script>
        function patientsPage() {
            return {
                patients: [],
                search: '',
                filterGender: '',

                async init() {
                    await this.loadData();
                    setTimeout(() => lucide.createIcons(), 100);
                },

                async loadData() {
                    try {
                        const res = await fetch('/data/patients.json');
                        const data = await res.json();
                        this.patients = data.patients || [];
                    } catch (error) {
                        console.error('Error loading patients:', error);
                    }
                },

                get filteredPatients() {
                    return this.patients.filter(p => {
                        const matchSearch = !this.search ||
                            p.name.toLowerCase().includes(this.search.toLowerCase()) ||
                            p.email.toLowerCase().includes(this.search.toLowerCase()) ||
                            p.phone.includes(this.search);
                        const matchGender = !this.filterGender || p.gender === this.filterGender;
                        return matchSearch && matchGender;
                    });
                },

                formatDate(dateStr) {
                    if (!dateStr) return '-';
                    const date = new Date(dateStr);
                    return date.toLocaleDateString('id-ID', { day: 'numeric', month: 'short', year: 'numeric' });
                }
            }
        }
    </script>
@endpush