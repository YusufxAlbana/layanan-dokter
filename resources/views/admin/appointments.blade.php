{{--
Admin Appointments Page
-----------------------
Halaman manajemen janji temu dengan data real dari JSON.
--}}

@extends('layouts.admin')

@section('title', 'Data Janji Temu')
@section('page-title', 'Data Janji Temu')

@section('content')

    <div x-data="appointmentsPage()" x-init="init()">

        {{-- Header Actions --}}
        <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4 mb-6">
            <div>
                <p class="text-slate-600">Kelola semua janji temu pasien</p>
                <p class="text-xs text-slate-400 mt-1">Janji temu dibuat oleh pasien melalui website</p>
            </div>
            <div class="flex items-center gap-3">
                <button
                    class="inline-flex items-center px-4 py-2 bg-white border border-slate-200 text-slate-700 font-medium rounded-xl hover:bg-slate-50 transition">
                    <i data-lucide="calendar" class="w-5 h-5 mr-2"></i>
                    Tampilan Kalender
                </button>
            </div>
        </div>

        {{-- Stats Cards --}}
        <div class="grid sm:grid-cols-5 gap-4 mb-6">
            <div class="bg-white rounded-xl p-4 shadow-sm border border-slate-100">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-slate-500">Total</p>
                        <p class="text-2xl font-bold text-slate-800" x-text="appointments.length">0</p>
                    </div>
                    <div class="w-10 h-10 bg-slate-100 rounded-lg flex items-center justify-center">
                        <i data-lucide="calendar" class="w-5 h-5 text-slate-600"></i>
                    </div>
                </div>
            </div>
            <div class="bg-white rounded-xl p-4 shadow-sm border border-slate-100">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-slate-500">Pending</p>
                        <p class="text-2xl font-bold text-amber-600" x-text="statusCounts.pending">0</p>
                    </div>
                    <div class="w-10 h-10 bg-amber-100 rounded-lg flex items-center justify-center">
                        <i data-lucide="clock" class="w-5 h-5 text-amber-600"></i>
                    </div>
                </div>
            </div>
            <div class="bg-white rounded-xl p-4 shadow-sm border border-slate-100">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-slate-500">Confirmed</p>
                        <p class="text-2xl font-bold text-emerald-600" x-text="statusCounts.confirmed">0</p>
                    </div>
                    <div class="w-10 h-10 bg-emerald-100 rounded-lg flex items-center justify-center">
                        <i data-lucide="check-circle" class="w-5 h-5 text-emerald-600"></i>
                    </div>
                </div>
            </div>
            <div class="bg-white rounded-xl p-4 shadow-sm border border-slate-100">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-slate-500">Completed</p>
                        <p class="text-2xl font-bold text-slate-600" x-text="statusCounts.completed">0</p>
                    </div>
                    <div class="w-10 h-10 bg-slate-100 rounded-lg flex items-center justify-center">
                        <i data-lucide="check-check" class="w-5 h-5 text-slate-600"></i>
                    </div>
                </div>
            </div>
            <div class="bg-white rounded-xl p-4 shadow-sm border border-slate-100">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-slate-500">Cancelled</p>
                        <p class="text-2xl font-bold text-red-600" x-text="statusCounts.cancelled">0</p>
                    </div>
                    <div class="w-10 h-10 bg-red-100 rounded-lg flex items-center justify-center">
                        <i data-lucide="x-circle" class="w-5 h-5 text-red-600"></i>
                    </div>
                </div>
            </div>
        </div>

        {{-- Filters --}}
        <div class="bg-white rounded-2xl p-4 shadow-sm border border-slate-100 mb-6">
            <div class="flex flex-col md:flex-row items-center gap-4">
                <div class="relative flex-1 w-full">
                    <i data-lucide="search" class="absolute left-4 top-1/2 -translate-y-1/2 w-5 h-5 text-slate-400"></i>
                    <input type="text" x-model="search" placeholder="Cari pasien atau dokter..."
                        class="w-full pl-12 pr-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-sky-500 focus:border-sky-500 transition">
                </div>
                <input type="date" x-model="filterDate"
                    class="px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-sm focus:ring-2 focus:ring-sky-500">
                <select x-model="filterStatus"
                    class="px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-sm focus:ring-2 focus:ring-sky-500">
                    <option value="">Semua Status</option>
                    <option value="pending">Pending</option>
                    <option value="confirmed">Confirmed</option>
                    <option value="in_progress">In Progress</option>
                    <option value="completed">Completed</option>
                    <option value="cancelled">Cancelled</option>
                </select>
            </div>
        </div>

        {{-- Table --}}
        <div class="bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="bg-slate-50 border-b border-slate-200">
                        <tr>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider">ID
                            </th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider">
                                Pasien</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider">
                                Dokter</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider">
                                Layanan</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider">
                                Jadwal</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider">
                                Status</th>
                            <th class="px-6 py-4 text-center text-xs font-semibold text-slate-500 uppercase tracking-wider">
                                Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-200">
                        <template x-for="apt in filteredAppointments" :key="apt.id">
                            <tr class="hover:bg-slate-50 transition" :class="apt.status === 'cancelled' && 'opacity-60'">
                                <td class="px-6 py-4">
                                    <span class="font-mono text-sm text-slate-600" x-text="apt.id"></span>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="flex items-center space-x-3">
                                        <div class="w-8 h-8 rounded-full flex items-center justify-center text-white font-bold text-sm"
                                            :style="'background-color: #' + getColor(apt.patientName)">
                                            <span x-text="apt.patientName.charAt(0)"></span>
                                        </div>
                                        <span class="font-medium text-slate-800" x-text="apt.patientName"></span>
                                    </div>
                                </td>
                                <td class="px-6 py-4 text-sm text-slate-600" x-text="apt.doctorName"></td>
                                <td class="px-6 py-4 text-sm text-slate-600" x-text="apt.service"></td>
                                <td class="px-6 py-4">
                                    <p class="text-sm font-medium text-slate-800" x-text="formatDate(apt.date)"></p>
                                    <p class="text-sm text-slate-500" x-text="apt.time + ' WIB'"></p>
                                </td>
                                <td class="px-6 py-4">
                                    <span class="px-2.5 py-1 text-xs font-medium rounded-lg"
                                        :class="getStatusClass(apt.status)" x-text="getStatusText(apt.status)"></span>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="flex items-center justify-center space-x-2">
                                        <button class="p-2 hover:bg-slate-100 rounded-lg transition" title="Detail">
                                            <i data-lucide="eye" class="w-4 h-4 text-slate-500"></i>
                                        </button>
                                        <template x-if="apt.status !== 'completed' && apt.status !== 'cancelled'">
                                            <button class="p-2 hover:bg-sky-50 rounded-lg transition" title="Edit">
                                                <i data-lucide="pencil" class="w-4 h-4 text-sky-500"></i>
                                            </button>
                                        </template>
                                        <template x-if="apt.status === 'pending'">
                                            <button class="p-2 hover:bg-emerald-50 rounded-lg transition" title="Confirm">
                                                <i data-lucide="check" class="w-4 h-4 text-emerald-500"></i>
                                            </button>
                                        </template>
                                        <template x-if="apt.status !== 'completed' && apt.status !== 'cancelled'">
                                            <button class="p-2 hover:bg-red-50 rounded-lg transition" title="Cancel">
                                                <i data-lucide="x" class="w-4 h-4 text-red-500"></i>
                                            </button>
                                        </template>
                                        <template x-if="apt.status === 'completed'">
                                            <button class="p-2 hover:bg-emerald-50 rounded-lg transition"
                                                title="Rekam Medis">
                                                <i data-lucide="file-text" class="w-4 h-4 text-emerald-500"></i>
                                            </button>
                                        </template>
                                    </div>
                                </td>
                            </tr>
                        </template>
                    </tbody>
                </table>
            </div>

            {{-- Pagination --}}
            <div class="px-6 py-4 bg-slate-50 border-t border-slate-200">
                <p class="text-sm text-slate-600">
                    Menampilkan <span class="font-medium" x-text="filteredAppointments.length"></span> dari <span
                        class="font-medium" x-text="appointments.length"></span> janji temu
                </p>
            </div>
        </div>
    </div>

@endsection

@push('scripts')
    <script>
        function appointmentsPage() {
            return {
                appointments: [],
                search: '',
                filterDate: '',
                filterStatus: '',
                statusCounts: {
                    pending: 0,
                    confirmed: 0,
                    in_progress: 0,
                    completed: 0,
                    cancelled: 0
                },

                async init() {
                    await this.loadData();
                    this.calculateCounts();
                    setTimeout(() => lucide.createIcons(), 100);
                },

                async loadData() {
                    try {
                        const res = await fetch('/data/appointments.json');
                        const data = await res.json();
                        this.appointments = data.appointments || [];
                    } catch (error) {
                        console.error('Error loading appointments:', error);
                    }
                },

                calculateCounts() {
                    this.statusCounts.pending = this.appointments.filter(a => a.status === 'pending').length;
                    this.statusCounts.confirmed = this.appointments.filter(a => a.status === 'confirmed').length;
                    this.statusCounts.in_progress = this.appointments.filter(a => a.status === 'in_progress').length;
                    this.statusCounts.completed = this.appointments.filter(a => a.status === 'completed').length;
                    this.statusCounts.cancelled = this.appointments.filter(a => a.status === 'cancelled').length;
                },

                get filteredAppointments() {
                    return this.appointments.filter(a => {
                        const matchSearch = !this.search ||
                            a.patientName.toLowerCase().includes(this.search.toLowerCase()) ||
                            a.doctorName.toLowerCase().includes(this.search.toLowerCase());
                        const matchDate = !this.filterDate || a.date === this.filterDate;
                        const matchStatus = !this.filterStatus || a.status === this.filterStatus;
                        return matchSearch && matchDate && matchStatus;
                    });
                },

                getColor(name) {
                    const colors = ['0ea5e9', '10b981', '8b5cf6', 'f59e0b', 'ef4444', '06b6d4'];
                    const index = name.charCodeAt(0) % colors.length;
                    return colors[index];
                },

                getStatusClass(status) {
                    const classes = {
                        'confirmed': 'bg-emerald-100 text-emerald-700',
                        'pending': 'bg-amber-100 text-amber-700',
                        'in_progress': 'bg-sky-100 text-sky-700',
                        'completed': 'bg-slate-100 text-slate-600',
                        'cancelled': 'bg-red-100 text-red-700'
                    };
                    return classes[status] || 'bg-slate-100 text-slate-600';
                },

                getStatusText(status) {
                    const texts = {
                        'confirmed': 'Confirmed',
                        'pending': 'Pending',
                        'in_progress': 'In Progress',
                        'completed': 'Completed',
                        'cancelled': 'Cancelled'
                    };
                    return texts[status] || status;
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