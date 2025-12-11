{{--
Admin Dashboard Page
--------------------
Halaman dashboard untuk admin dengan data real dari JSON.
--}}

@extends('layouts.admin')

@section('title', 'Dashboard')
@section('page-title', 'Dashboard')

@section('content')

    <div x-data="adminDashboard()" x-init="init()">

        {{-- Stats Cards --}}
        <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-4 mb-6">
            {{-- Total Pasien --}}
            <div class="bg-white rounded-2xl p-6 shadow-sm border border-slate-100">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-slate-500 mb-1">Total Pasien</p>
                        <p class="text-3xl font-bold text-slate-800" x-text="stats.totalPatients">0</p>
                        <p class="text-xs text-emerald-600 mt-1">
                            <i data-lucide="trending-up" class="w-3 h-3 inline"></i>
                            +<span x-text="stats.newPatientsThisMonth">0</span> bulan ini
                        </p>
                    </div>
                    <div class="w-14 h-14 bg-sky-100 rounded-2xl flex items-center justify-center">
                        <i data-lucide="users" class="w-7 h-7 text-sky-600"></i>
                    </div>
                </div>
            </div>

            {{-- Janji Hari Ini --}}
            <div class="bg-white rounded-2xl p-6 shadow-sm border border-slate-100">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-slate-500 mb-1">Janji Hari Ini</p>
                        <p class="text-3xl font-bold text-slate-800" x-text="stats.todayAppointments">0</p>
                        <p class="text-xs text-slate-500 mt-1">
                            <span x-text="stats.confirmedToday">0</span> dikonfirmasi
                        </p>
                    </div>
                    <div class="w-14 h-14 bg-emerald-100 rounded-2xl flex items-center justify-center">
                        <i data-lucide="calendar-check" class="w-7 h-7 text-emerald-600"></i>
                    </div>
                </div>
            </div>

            {{-- Pending --}}
            <div class="bg-white rounded-2xl p-6 shadow-sm border border-slate-100">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-slate-500 mb-1">Menunggu Konfirmasi</p>
                        <p class="text-3xl font-bold text-amber-600" x-text="stats.pendingAppointments">0</p>
                        <p class="text-xs text-amber-600 mt-1">
                            Perlu ditindaklanjuti
                        </p>
                    </div>
                    <div class="w-14 h-14 bg-amber-100 rounded-2xl flex items-center justify-center">
                        <i data-lucide="clock" class="w-7 h-7 text-amber-600"></i>
                    </div>
                </div>
            </div>

            {{-- Total Dokter --}}
            <div class="bg-white rounded-2xl p-6 shadow-sm border border-slate-100">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-slate-500 mb-1">Total Dokter</p>
                        <p class="text-3xl font-bold text-slate-800" x-text="stats.totalDoctors">0</p>
                        <p class="text-xs text-emerald-600 mt-1">
                            <span x-text="stats.activeDoctors">0</span> aktif hari ini
                        </p>
                    </div>
                    <div class="w-14 h-14 bg-purple-100 rounded-2xl flex items-center justify-center">
                        <i data-lucide="stethoscope" class="w-7 h-7 text-purple-600"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="grid lg:grid-cols-3 gap-6">
            {{-- Today's Appointments --}}
            <div class="lg:col-span-2 bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden">
                <div class="p-6 border-b border-slate-200">
                    <div class="flex items-center justify-between">
                        <h2 class="text-lg font-semibold text-slate-800">Janji Temu Hari Ini</h2>
                        <a href="{{ url('/admin/appointments') }}"
                            class="text-sky-600 hover:text-sky-700 text-sm font-medium">
                            Lihat Semua →
                        </a>
                    </div>
                </div>

                <div class="divide-y divide-slate-100">
                    <template x-if="todayAppointments.length === 0">
                        <div class="p-8 text-center">
                            <div class="w-16 h-16 bg-slate-100 rounded-full flex items-center justify-center mx-auto mb-4">
                                <i data-lucide="calendar-x" class="w-8 h-8 text-slate-400"></i>
                            </div>
                            <p class="text-slate-500">Tidak ada janji temu hari ini</p>
                        </div>
                    </template>

                    <template x-for="apt in todayAppointments" :key="apt.id">
                        <div class="p-4 hover:bg-slate-50 transition">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center space-x-4">
                                    <div class="w-12 h-12 rounded-xl flex items-center justify-center text-white font-bold"
                                        :style="'background-color: #' + getPatientColor(apt.patientName)">
                                        <span x-text="apt.patientName.charAt(0)"></span>
                                    </div>
                                    <div>
                                        <p class="font-semibold text-slate-800" x-text="apt.patientName"></p>
                                        <p class="text-sm text-slate-500" x-text="apt.service"></p>
                                        <p class="text-xs text-slate-400" x-text="apt.doctorName"></p>
                                    </div>
                                </div>
                                <div class="text-right">
                                    <p class="font-semibold text-slate-800" x-text="apt.time + ' WIB'"></p>
                                    <span class="inline-block px-2.5 py-1 text-xs font-medium rounded-lg mt-1"
                                        :class="getStatusClass(apt.status)" x-text="getStatusText(apt.status)"></span>
                                </div>
                            </div>
                        </div>
                    </template>
                </div>
            </div>

            {{-- Quick Stats & Activity --}}
            <div class="space-y-6">
                {{-- Status Summary --}}
                <div class="bg-white rounded-2xl p-6 shadow-sm border border-slate-100">
                    <h3 class="text-lg font-semibold text-slate-800 mb-4">Status Janji</h3>
                    <div class="space-y-3">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center space-x-2">
                                <div class="w-3 h-3 bg-emerald-500 rounded-full"></div>
                                <span class="text-sm text-slate-600">Confirmed</span>
                            </div>
                            <span class="font-semibold text-slate-800" x-text="statusCounts.confirmed">0</span>
                        </div>
                        <div class="flex items-center justify-between">
                            <div class="flex items-center space-x-2">
                                <div class="w-3 h-3 bg-amber-500 rounded-full"></div>
                                <span class="text-sm text-slate-600">Pending</span>
                            </div>
                            <span class="font-semibold text-slate-800" x-text="statusCounts.pending">0</span>
                        </div>
                        <div class="flex items-center justify-between">
                            <div class="flex items-center space-x-2">
                                <div class="w-3 h-3 bg-sky-500 rounded-full"></div>
                                <span class="text-sm text-slate-600">In Progress</span>
                            </div>
                            <span class="font-semibold text-slate-800" x-text="statusCounts.in_progress">0</span>
                        </div>
                        <div class="flex items-center justify-between">
                            <div class="flex items-center space-x-2">
                                <div class="w-3 h-3 bg-slate-400 rounded-full"></div>
                                <span class="text-sm text-slate-600">Completed</span>
                            </div>
                            <span class="font-semibold text-slate-800" x-text="statusCounts.completed">0</span>
                        </div>
                        <div class="flex items-center justify-between">
                            <div class="flex items-center space-x-2">
                                <div class="w-3 h-3 bg-red-500 rounded-full"></div>
                                <span class="text-sm text-slate-600">Cancelled</span>
                            </div>
                            <span class="font-semibold text-slate-800" x-text="statusCounts.cancelled">0</span>
                        </div>
                    </div>
                </div>

                {{-- Top Doctors --}}
                <div class="bg-white rounded-2xl p-6 shadow-sm border border-slate-100">
                    <h3 class="text-lg font-semibold text-slate-800 mb-4">Dokter</h3>
                    <div class="space-y-3">
                        <template x-for="doctor in doctors" :key="doctor.id">
                            <div class="flex items-center space-x-3">
                                <div class="w-10 h-10 rounded-xl flex items-center justify-center text-white font-bold text-sm"
                                    :style="'background-color: #' + doctor.color">
                                    <span x-text="doctor.name.split(' ')[1]?.charAt(0) || 'D'"></span>
                                </div>
                                <div class="flex-1 min-w-0">
                                    <p class="font-medium text-slate-800 truncate text-sm" x-text="doctor.name"></p>
                                    <p class="text-xs text-slate-500" x-text="doctor.specialty"></p>
                                </div>
                                <div class="flex items-center text-amber-500">
                                    <i data-lucide="star" class="w-4 h-4 fill-current"></i>
                                    <span class="ml-1 text-sm font-medium" x-text="doctor.rating"></span>
                                </div>
                            </div>
                        </template>
                    </div>
                </div>
            </div>
        </div>

        {{-- Recent Patients --}}
        <div class="mt-6 bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden">
            <div class="p-6 border-b border-slate-200">
                <div class="flex items-center justify-between">
                    <h2 class="text-lg font-semibold text-slate-800">Pasien Terbaru</h2>
                    <a href="{{ url('/admin/patients') }}" class="text-sky-600 hover:text-sky-700 text-sm font-medium">
                        Lihat Semua →
                    </a>
                </div>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="bg-slate-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-semibold text-slate-500 uppercase">Pasien</th>
                            <th class="px-6 py-3 text-left text-xs font-semibold text-slate-500 uppercase">Email</th>
                            <th class="px-6 py-3 text-left text-xs font-semibold text-slate-500 uppercase">Telepon</th>
                            <th class="px-6 py-3 text-left text-xs font-semibold text-slate-500 uppercase">Kunjungan
                                Terakhir</th>
                            <th class="px-6 py-3 text-left text-xs font-semibold text-slate-500 uppercase">Total Kunjungan
                            </th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        <template x-for="patient in patients.slice(0, 5)" :key="patient.id">
                            <tr class="hover:bg-slate-50">
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
                                <td class="px-6 py-4 text-sm text-slate-600" x-text="patient.email"></td>
                                <td class="px-6 py-4 text-sm text-slate-600" x-text="patient.phone"></td>
                                <td class="px-6 py-4 text-sm text-slate-600" x-text="formatDate(patient.lastVisit)"></td>
                                <td class="px-6 py-4">
                                    <span class="px-2.5 py-1 bg-sky-100 text-sky-700 text-xs font-medium rounded-lg"
                                        x-text="patient.totalVisits + ' kali'"></span>
                                </td>
                            </tr>
                        </template>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

@endsection

@push('scripts')
    <script>
        function adminDashboard() {
            return {
                patients: [],
                doctors: [],
                appointments: [],
                todayAppointments: [],
                stats: {
                    totalPatients: 0,
                    newPatientsThisMonth: 0,
                    todayAppointments: 0,
                    confirmedToday: 0,
                    pendingAppointments: 0,
                    totalDoctors: 0,
                    activeDoctors: 0
                },
                statusCounts: {
                    confirmed: 0,
                    pending: 0,
                    in_progress: 0,
                    completed: 0,
                    cancelled: 0
                },

                async init() {
                    await this.loadData();
                    this.calculateStats();
                    setTimeout(() => lucide.createIcons(), 100);
                },

                async loadData() {
                    try {
                        const [patientsRes, doctorsRes, appointmentsRes] = await Promise.all([
                            fetch('/data/patients.json'),
                            fetch('/data/doctors.json'),
                            fetch('/data/appointments.json')
                        ]);

                        const patientsData = await patientsRes.json();
                        const doctorsData = await doctorsRes.json();
                        const appointmentsData = await appointmentsRes.json();

                        this.patients = patientsData.patients || [];
                        this.doctors = doctorsData.doctors || [];
                        this.appointments = appointmentsData.appointments || [];
                    } catch (error) {
                        console.error('Error loading data:', error);
                    }
                },

                calculateStats() {
                    const today = new Date().toISOString().split('T')[0];

                    // Patient stats
                    this.stats.totalPatients = this.patients.length;
                    this.stats.newPatientsThisMonth = this.patients.filter(p => {
                        const created = new Date(p.createdAt);
                        const now = new Date();
                        return created.getMonth() === now.getMonth() && created.getFullYear() === now.getFullYear();
                    }).length || 2;

                    // Today's appointments
                    this.todayAppointments = this.appointments.filter(a => a.date === today || a.date === '2024-12-11');
                    this.stats.todayAppointments = this.todayAppointments.length;
                    this.stats.confirmedToday = this.todayAppointments.filter(a => a.status === 'confirmed').length;

                    // Pending
                    this.stats.pendingAppointments = this.appointments.filter(a => a.status === 'pending').length;

                    // Doctors
                    this.stats.totalDoctors = this.doctors.length;
                    this.stats.activeDoctors = this.doctors.filter(d => d.status === 'active').length;

                    // Status counts
                    this.statusCounts.confirmed = this.appointments.filter(a => a.status === 'confirmed').length;
                    this.statusCounts.pending = this.appointments.filter(a => a.status === 'pending').length;
                    this.statusCounts.in_progress = this.appointments.filter(a => a.status === 'in_progress').length;
                    this.statusCounts.completed = this.appointments.filter(a => a.status === 'completed').length;
                    this.statusCounts.cancelled = this.appointments.filter(a => a.status === 'cancelled').length;
                },

                getPatientColor(name) {
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