{{--
Admin Medical Records Page
--------------------------
Halaman manajemen rekam medis untuk admin.

Features:
- List pasien dengan rekam medis (dari Data Pasien)
- Form tambah pasien baru langsung dari sini
- Form catatan medis
- Riwayat kunjungan

TODO Backend:
- CRUD operations untuk pasien dan rekam medis
- File attachments
- Print functionality
- Integrasi dengan Data Pasien
--}}

@extends('layouts.admin')

@section('title', 'Rekam Medis')
@section('page-title', 'Rekam Medis')

@section('content')

    <div x-data="{ 
        showAddPatientModal: false,
        showAddRecordModal: false,
        selectedPatient: null,
        patients: [],

        init() {
            // Load patients from localStorage atau gunakan array kosong
            const stored = localStorage.getItem('klinik_patients');
            if (stored) {
                this.patients = JSON.parse(stored);
            }
            // Select first patient if exists
            if (this.patients.length > 0) {
                this.selectedPatient = this.patients[0];
            }
        },

        addPatient(patient) {
            patient.id = 'P' + String(this.patients.length + 1).padStart(3, '0');
            patient.visits = [];
            patient.createdAt = new Date().toLocaleDateString('id-ID');
            this.patients.push(patient);
            this.savePatients();
            this.selectedPatient = patient;
            this.showAddPatientModal = false;
        },

        addMedicalRecord(record) {
            if (this.selectedPatient) {
                record.id = this.selectedPatient.visits.length + 1;
                record.date = new Date().toLocaleDateString('id-ID', { day: 'numeric', month: 'long', year: 'numeric' });
                this.selectedPatient.visits.unshift(record);
                this.savePatients();
                this.showAddRecordModal = false;
            }
        },

        deletePatient(patient) {
            if (confirm('Apakah Anda yakin ingin menghapus pasien ini?')) {
                this.patients = this.patients.filter(p => p.id !== patient.id);
                this.savePatients();
                this.selectedPatient = this.patients.length > 0 ? this.patients[0] : null;
            }
        },

        savePatients() {
            localStorage.setItem('klinik_patients', JSON.stringify(this.patients));
        },

        getInitials(name) {
            return name.split(' ').map(n => n[0]).join('').toUpperCase().substring(0, 2);
        },

        getRandomColor() {
            const colors = ['0ea5e9', '10b981', '8b5cf6', 'f59e0b', 'ef4444', '06b6d4', 'ec4899'];
            return colors[Math.floor(Math.random() * colors.length)];
        }
    }">

        {{-- Header Actions --}}
        <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4 mb-6">
            <div>
                <p class="text-slate-600">Kelola rekam medis pasien klinik</p>
            </div>
            <button @click="showAddPatientModal = true"
                class="inline-flex items-center px-4 py-2 bg-sky-500 hover:bg-sky-600 text-white font-medium rounded-xl shadow-lg shadow-sky-500/30 transition">
                <i data-lucide="user-plus" class="w-5 h-5 mr-2"></i>
                Tambah Pasien Baru
            </button>
        </div>

        <div class="grid lg:grid-cols-3 gap-6">
            {{-- Left Column - Patient List --}}
            <div class="lg:col-span-1">
                <div class="bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden">
                    <div class="p-4 border-b border-slate-200">
                        <h2 class="font-semibold text-slate-800 flex items-center justify-between">
                            <span>Daftar Pasien</span>
                            <span class="text-sm font-normal text-slate-500" x-text="patients.length + ' pasien'"></span>
                        </h2>
                        <div class="relative mt-3">
                            <i data-lucide="search"
                                class="absolute left-3 top-1/2 -translate-y-1/2 w-4 h-4 text-slate-400"></i>
                            <input type="text" placeholder="Cari pasien..."
                                class="w-full pl-9 pr-4 py-2 bg-slate-50 border border-slate-200 rounded-xl text-sm focus:ring-2 focus:ring-sky-500 focus:border-sky-500 transition">
                        </div>
                    </div>

                    {{-- Empty State --}}
                    <div x-show="patients.length === 0" class="p-8 text-center">
                        <div class="w-16 h-16 bg-slate-100 rounded-full flex items-center justify-center mx-auto mb-4">
                            <i data-lucide="users" class="w-8 h-8 text-slate-400"></i>
                        </div>
                        <h3 class="font-medium text-slate-800 mb-2">Belum Ada Pasien</h3>
                        <p class="text-sm text-slate-500 mb-4">Tambahkan pasien baru untuk mulai mencatat rekam medis.</p>
                        <button @click="showAddPatientModal = true"
                            class="inline-flex items-center px-4 py-2 bg-sky-500 hover:bg-sky-600 text-white text-sm font-medium rounded-xl transition">
                            <i data-lucide="plus" class="w-4 h-4 mr-2"></i>
                            Tambah Pasien
                        </button>
                    </div>

                    {{-- Patient List --}}
                    <div x-show="patients.length > 0" class="divide-y divide-slate-100 max-h-[600px] overflow-y-auto">
                        <template x-for="patient in patients" :key="patient.id">
                            <div @click="selectedPatient = patient"
                                :class="selectedPatient && selectedPatient.id === patient.id ? 'bg-sky-50 border-l-4 border-sky-500' : 'hover:bg-slate-50 border-l-4 border-transparent'"
                                class="p-4 cursor-pointer transition">
                                <div class="flex items-center space-x-3">
                                    <div class="w-10 h-10 rounded-full flex items-center justify-center text-white font-medium text-sm"
                                        :style="'background-color: #' + (patient.color || '0ea5e9')">
                                        <span x-text="getInitials(patient.name)"></span>
                                    </div>
                                    <div class="flex-1 min-w-0">
                                        <p class="font-medium text-slate-800 truncate" x-text="patient.name"></p>
                                        <p class="text-xs text-slate-500">
                                            <span x-text="'ID: ' + patient.id"></span> •
                                            <span x-text="(patient.visits?.length || 0) + ' kunjungan'"></span>
                                        </p>
                                    </div>
                                    <i data-lucide="chevron-right" class="w-4 h-4 text-slate-400"></i>
                                </div>
                            </div>
                        </template>
                    </div>
                </div>
            </div>

            {{-- Right Column - Medical Record Detail --}}
            <div class="lg:col-span-2 space-y-6">

                {{-- Empty State when no patient selected --}}
                <div x-show="!selectedPatient"
                    class="bg-white rounded-2xl shadow-sm border border-slate-100 p-12 text-center">
                    <div class="w-20 h-20 bg-slate-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i data-lucide="file-text" class="w-10 h-10 text-slate-400"></i>
                    </div>
                    <h3 class="text-lg font-medium text-slate-800 mb-2">Pilih Pasien</h3>
                    <p class="text-slate-500 mb-4">Pilih pasien dari daftar untuk melihat rekam medis atau tambah pasien
                        baru.</p>
                    <button @click="showAddPatientModal = true"
                        class="inline-flex items-center px-4 py-2 bg-sky-500 hover:bg-sky-600 text-white font-medium rounded-xl transition">
                        <i data-lucide="user-plus" class="w-4 h-4 mr-2"></i>
                        Tambah Pasien Baru
                    </button>
                </div>

                {{-- Patient Info Card --}}
                <div x-show="selectedPatient" class="bg-white rounded-2xl shadow-sm border border-slate-100 p-6">
                    <div class="flex items-start justify-between mb-6">
                        <div class="flex items-center space-x-4">
                            <div class="w-16 h-16 rounded-xl flex items-center justify-center text-white font-bold text-xl"
                                :style="'background-color: #' + (selectedPatient?.color || '0ea5e9')">
                                <span x-text="selectedPatient ? getInitials(selectedPatient.name) : ''"></span>
                            </div>
                            <div>
                                <h2 class="text-xl font-bold text-slate-800" x-text="selectedPatient?.name"></h2>
                                <p class="text-slate-500">
                                    <span x-text="'ID: ' + (selectedPatient?.id || '')"></span> •
                                    <span x-text="(selectedPatient?.gender === 'L' ? 'Laki-laki' : 'Perempuan')"></span> •
                                    <span x-text="selectedPatient?.age + ' tahun'"></span>
                                </p>
                                <p class="text-sm text-slate-400"
                                    x-text="'Terdaftar: ' + (selectedPatient?.createdAt || '')"></p>
                            </div>
                        </div>
                        <div class="flex items-center space-x-2">
                            <button
                                class="inline-flex items-center px-3 py-2 bg-slate-100 hover:bg-slate-200 text-slate-700 font-medium rounded-xl transition">
                                <i data-lucide="printer" class="w-4 h-4 mr-2"></i>
                                Cetak
                            </button>
                            <button @click="deletePatient(selectedPatient)"
                                class="p-2 bg-red-50 hover:bg-red-100 text-red-600 rounded-xl transition"
                                title="Hapus Pasien">
                                <i data-lucide="trash-2" class="w-4 h-4"></i>
                            </button>
                        </div>
                    </div>

                    <div class="grid sm:grid-cols-3 gap-4">
                        <div class="p-3 bg-slate-50 rounded-xl">
                            <p class="text-xs text-slate-500 mb-1">Telepon</p>
                            <p class="font-medium text-slate-800" x-text="selectedPatient?.phone || '-'"></p>
                        </div>
                        <div class="p-3 bg-slate-50 rounded-xl">
                            <p class="text-xs text-slate-500 mb-1">Email</p>
                            <p class="font-medium text-slate-800" x-text="selectedPatient?.email || '-'"></p>
                        </div>
                        <div class="p-3 bg-slate-50 rounded-xl">
                            <p class="text-xs text-slate-500 mb-1">Alergi</p>
                            <p class="font-medium" :class="selectedPatient?.allergy ? 'text-red-600' : 'text-slate-800'"
                                x-text="selectedPatient?.allergy || 'Tidak ada'"></p>
                        </div>
                    </div>
                </div>

                {{-- Add New Record Button --}}
                <div x-show="selectedPatient">
                    <button @click="showAddRecordModal = true"
                        class="w-full p-4 bg-gradient-to-r from-sky-500 to-emerald-500 hover:from-sky-600 hover:to-emerald-600 text-white font-medium rounded-2xl shadow-lg shadow-sky-500/30 transition flex items-center justify-center">
                        <i data-lucide="plus-circle" class="w-5 h-5 mr-2"></i>
                        Tambah Catatan Rekam Medis
                    </button>
                </div>

                {{-- Visit History --}}
                <div x-show="selectedPatient" class="bg-white rounded-2xl shadow-sm border border-slate-100 p-6">
                    <h3 class="text-lg font-semibold text-slate-800 mb-6 flex items-center">
                        <i data-lucide="history" class="w-5 h-5 mr-2 text-sky-500"></i>
                        Riwayat Kunjungan
                    </h3>

                    {{-- Empty visits --}}
                    <div x-show="!selectedPatient?.visits || selectedPatient?.visits.length === 0" class="text-center py-8">
                        <div class="w-16 h-16 bg-slate-100 rounded-full flex items-center justify-center mx-auto mb-4">
                            <i data-lucide="clipboard" class="w-8 h-8 text-slate-400"></i>
                        </div>
                        <p class="text-slate-500">Belum ada riwayat kunjungan.</p>
                        <button @click="showAddRecordModal = true" class="mt-4 text-sky-600 hover:text-sky-700 font-medium">
                            + Tambah Catatan Pertama
                        </button>
                    </div>

                    {{-- Visit records --}}
                    <div x-show="selectedPatient?.visits && selectedPatient?.visits.length > 0" class="space-y-4">
                        <template x-for="record in selectedPatient?.visits" :key="record.id">
                            <div class="p-4 bg-slate-50 rounded-xl border border-slate-200">
                                <div class="flex items-start justify-between mb-3">
                                    <div>
                                        <p class="font-semibold text-slate-800" x-text="record.date"></p>
                                        <p class="text-sm text-slate-500" x-text="record.doctor"></p>
                                    </div>
                                    <span
                                        class="px-2.5 py-1 bg-emerald-100 text-emerald-700 text-xs font-medium rounded-lg">Selesai</span>
                                </div>
                                <div class="space-y-2 text-sm">
                                    <div x-show="record.complaint">
                                        <span class="font-medium text-slate-700">Keluhan:</span>
                                        <span class="text-slate-600" x-text="record.complaint"></span>
                                    </div>
                                    <div x-show="record.diagnosis">
                                        <span class="font-medium text-slate-700">Diagnosis:</span>
                                        <span class="text-slate-600" x-text="record.diagnosis"></span>
                                    </div>
                                    <div x-show="record.treatment">
                                        <span class="font-medium text-slate-700">Tindakan:</span>
                                        <span class="text-slate-600" x-text="record.treatment"></span>
                                    </div>
                                    <div x-show="record.prescription">
                                        <span class="font-medium text-slate-700">Resep:</span>
                                        <span class="text-slate-600" x-text="record.prescription"></span>
                                    </div>
                                    <div x-show="record.notes">
                                        <span class="font-medium text-slate-700">Catatan:</span>
                                        <span class="text-slate-600" x-text="record.notes"></span>
                                    </div>
                                </div>
                            </div>
                        </template>
                    </div>
                </div>
            </div>
        </div>

        {{-- Add Patient Modal --}}
        <div x-show="showAddPatientModal" x-transition:enter="transition ease-out duration-200"
            x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
            x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100"
            x-transition:leave-end="opacity-0" class="fixed inset-0 z-50 flex items-center justify-center p-4"
            style="display: none;">
            <div class="fixed inset-0 bg-slate-900/50" @click="showAddPatientModal = false"></div>

            <div x-show="showAddPatientModal" x-transition:enter="transition ease-out duration-200"
                x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100"
                class="relative bg-white rounded-2xl shadow-2xl max-w-lg w-full max-h-[90vh] overflow-y-auto">
                <div class="p-6 border-b border-slate-200">
                    <h2 class="text-xl font-bold text-slate-800 flex items-center">
                        <i data-lucide="user-plus" class="w-6 h-6 mr-2 text-sky-500"></i>
                        Tambah Pasien Baru
                    </h2>
                </div>

                <form @submit.prevent="
                        addPatient({
                            name: $refs.patientName.value,
                            email: $refs.patientEmail.value,
                            phone: $refs.patientPhone.value,
                            age: $refs.patientAge.value,
                            gender: $refs.patientGender.value,
                            allergy: $refs.patientAllergy.value,
                            color: getRandomColor()
                        });
                        $refs.patientForm.reset();
                    " x-ref="patientForm" class="p-6 space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-2">Nama Lengkap <span
                                class="text-red-500">*</span></label>
                        <input type="text" x-ref="patientName" required placeholder="Masukkan nama lengkap"
                            class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-sky-500 focus:border-sky-500 transition">
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-slate-700 mb-2">Umur <span
                                    class="text-red-500">*</span></label>
                            <input type="number" x-ref="patientAge" required min="0" max="150" placeholder="Tahun"
                                class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-sky-500 focus:border-sky-500 transition">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-slate-700 mb-2">Jenis Kelamin <span
                                    class="text-red-500">*</span></label>
                            <select x-ref="patientGender" required
                                class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-sky-500 focus:border-sky-500 transition">
                                <option value="">Pilih</option>
                                <option value="L">Laki-laki</option>
                                <option value="P">Perempuan</option>
                            </select>
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-2">Email</label>
                        <input type="email" x-ref="patientEmail" placeholder="contoh@email.com"
                            class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-sky-500 focus:border-sky-500 transition">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-2">No. Telepon</label>
                        <input type="tel" x-ref="patientPhone" placeholder="08xxxxxxxxxx"
                            class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-sky-500 focus:border-sky-500 transition">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-2">Alergi (jika ada)</label>
                        <input type="text" x-ref="patientAllergy" placeholder="Contoh: Penisilin, Ibuprofen"
                            class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-sky-500 focus:border-sky-500 transition">
                    </div>

                    <div class="flex justify-end space-x-3 pt-4 border-t border-slate-200">
                        <button type="button" @click="showAddPatientModal = false"
                            class="px-4 py-2 bg-slate-100 hover:bg-slate-200 text-slate-700 font-medium rounded-xl transition">
                            Batal
                        </button>
                        <button type="submit"
                            class="px-4 py-2 bg-sky-500 hover:bg-sky-600 text-white font-medium rounded-xl shadow-lg shadow-sky-500/30 transition">
                            <i data-lucide="save" class="w-4 h-4 inline mr-2"></i>
                            Simpan Pasien
                        </button>
                    </div>
                </form>
            </div>
        </div>

        {{-- Add Medical Record Modal --}}
        <div x-show="showAddRecordModal" x-transition:enter="transition ease-out duration-200"
            x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
            x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100"
            x-transition:leave-end="opacity-0" class="fixed inset-0 z-50 flex items-center justify-center p-4"
            style="display: none;">
            <div class="fixed inset-0 bg-slate-900/50" @click="showAddRecordModal = false"></div>

            <div x-show="showAddRecordModal" x-transition:enter="transition ease-out duration-200"
                x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100"
                class="relative bg-white rounded-2xl shadow-2xl max-w-lg w-full max-h-[90vh] overflow-y-auto">
                <div class="p-6 border-b border-slate-200">
                    <h2 class="text-xl font-bold text-slate-800 flex items-center">
                        <i data-lucide="plus-circle" class="w-6 h-6 mr-2 text-sky-500"></i>
                        Tambah Catatan Rekam Medis
                    </h2>
                    <p class="text-sm text-slate-500 mt-1">Pasien: <span class="font-medium text-slate-700"
                            x-text="selectedPatient?.name"></span></p>
                </div>

                <form @submit.prevent="
                        addMedicalRecord({
                            doctor: $refs.recordDoctor.value,
                            complaint: $refs.recordComplaint.value,
                            diagnosis: $refs.recordDiagnosis.value,
                            treatment: $refs.recordTreatment.value,
                            prescription: $refs.recordPrescription.value,
                            notes: $refs.recordNotes.value
                        });
                        $refs.recordForm.reset();
                    " x-ref="recordForm" class="p-6 space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-2">Dokter <span
                                class="text-red-500">*</span></label>
                        <select x-ref="recordDoctor" required
                            class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-sky-500 focus:border-sky-500 transition">
                            <option value="">Pilih Dokter</option>
                            <option value="Dr. Andi Pratama, Sp.KG">Dr. Andi Pratama, Sp.KG</option>
                            <option value="Dr. Sarah Amanda, Sp.Ort">Dr. Sarah Amanda, Sp.Ort</option>
                            <option value="Dr. Rizki Hidayat, Sp.BM">Dr. Rizki Hidayat, Sp.BM</option>
                            <option value="Dr. Maya Putri, Sp.KGA">Dr. Maya Putri, Sp.KGA</option>
                            <option value="Dr. Hendra Wijaya, Sp.Pros">Dr. Hendra Wijaya, Sp.Pros</option>
                        </select>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-2">Keluhan <span
                                class="text-red-500">*</span></label>
                        <textarea x-ref="recordComplaint" required rows="2" placeholder="Keluhan pasien..."
                            class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-sky-500 focus:border-sky-500 transition resize-none"></textarea>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-2">Diagnosis <span
                                class="text-red-500">*</span></label>
                        <textarea x-ref="recordDiagnosis" required rows="2" placeholder="Diagnosis dokter..."
                            class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-sky-500 focus:border-sky-500 transition resize-none"></textarea>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-2">Tindakan</label>
                        <textarea x-ref="recordTreatment" rows="2" placeholder="Tindakan yang dilakukan..."
                            class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-sky-500 focus:border-sky-500 transition resize-none"></textarea>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-2">Resep Obat</label>
                        <textarea x-ref="recordPrescription" rows="2" placeholder="Obat yang diresepkan..."
                            class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-sky-500 focus:border-sky-500 transition resize-none"></textarea>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-2">Catatan Tambahan</label>
                        <textarea x-ref="recordNotes" rows="2" placeholder="Catatan lainnya..."
                            class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-sky-500 focus:border-sky-500 transition resize-none"></textarea>
                    </div>

                    <div class="flex justify-end space-x-3 pt-4 border-t border-slate-200">
                        <button type="button" @click="showAddRecordModal = false"
                            class="px-4 py-2 bg-slate-100 hover:bg-slate-200 text-slate-700 font-medium rounded-xl transition">
                            Batal
                        </button>
                        <button type="submit"
                            class="px-4 py-2 bg-sky-500 hover:bg-sky-600 text-white font-medium rounded-xl shadow-lg shadow-sky-500/30 transition">
                            <i data-lucide="save" class="w-4 h-4 inline mr-2"></i>
                            Simpan Catatan
                        </button>
                    </div>
                </form>
            </div>
        </div>

    </div>

@endsection

@push('scripts')
    <script>
        // Re-initialize Lucide icons after Alpine updates
        document.addEventListener('alpine:initialized', () => {
            Alpine.effect(() => {
                setTimeout(() => lucide.createIcons(), 100);
            });
        });
    </script>
@endpush