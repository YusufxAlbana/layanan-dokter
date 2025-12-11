{{--
Admin Doctors Page
------------------
Halaman manajemen data dokter dengan form tambah dokter termasuk foto.
--}}

@extends('layouts.admin')

@section('title', 'Data Dokter')
@section('page-title', 'Data Dokter')

@section('content')

    <div x-data="doctorsPage()" x-init="init()">

        {{-- Header --}}
        <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4 mb-6">
            <div>
                <p class="text-slate-600">Kelola data dokter dan jadwal praktik</p>
            </div>
            <button @click="showAddModal = true"
                class="inline-flex items-center px-4 py-2 bg-sky-500 hover:bg-sky-600 text-white font-medium rounded-xl shadow-lg shadow-sky-500/30 transition">
                <i data-lucide="plus" class="w-5 h-5 mr-2"></i>
                Tambah Dokter
            </button>
        </div>

        {{-- Stats --}}
        <div class="grid sm:grid-cols-3 gap-4 mb-6">
            <div class="bg-white rounded-xl p-4 shadow-sm border border-slate-100">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-slate-500">Total Dokter</p>
                        <p class="text-2xl font-bold text-slate-800" x-text="doctors.length">0</p>
                    </div>
                    <div class="w-10 h-10 bg-purple-100 rounded-lg flex items-center justify-center">
                        <i data-lucide="stethoscope" class="w-5 h-5 text-purple-600"></i>
                    </div>
                </div>
            </div>
            <div class="bg-white rounded-xl p-4 shadow-sm border border-slate-100">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-slate-500">Aktif</p>
                        <p class="text-2xl font-bold text-emerald-600"
                            x-text="doctors.filter(d => d.status === 'active').length">0</p>
                    </div>
                    <div class="w-10 h-10 bg-emerald-100 rounded-lg flex items-center justify-center">
                        <i data-lucide="check-circle" class="w-5 h-5 text-emerald-600"></i>
                    </div>
                </div>
            </div>
            <div class="bg-white rounded-xl p-4 shadow-sm border border-slate-100">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-slate-500">Total Pasien Ditangani</p>
                        <p class="text-2xl font-bold text-sky-600" x-text="totalPatients.toLocaleString()">0</p>
                    </div>
                    <div class="w-10 h-10 bg-sky-100 rounded-lg flex items-center justify-center">
                        <i data-lucide="users" class="w-5 h-5 text-sky-600"></i>
                    </div>
                </div>
            </div>
        </div>

        {{-- Empty State --}}
        <div x-show="doctors.length === 0" class="bg-white rounded-2xl shadow-sm border border-slate-100 p-12 text-center">
            <div class="w-20 h-20 bg-slate-100 rounded-full flex items-center justify-center mx-auto mb-4">
                <i data-lucide="stethoscope" class="w-10 h-10 text-slate-400"></i>
            </div>
            <h3 class="text-xl font-bold text-slate-800 mb-2">Belum Ada Data Dokter</h3>
            <p class="text-slate-500 mb-6">Tambahkan dokter untuk mulai mengelola jadwal dan janji temu.</p>
            <button @click="showAddModal = true"
                class="inline-flex items-center px-6 py-3 bg-sky-500 hover:bg-sky-600 text-white font-medium rounded-xl shadow-lg shadow-sky-500/30 transition">
                <i data-lucide="plus" class="w-5 h-5 mr-2"></i>
                Tambah Dokter Pertama
            </button>
        </div>

        {{-- Doctors Grid --}}
        <div x-show="doctors.length > 0" class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
            <template x-for="doctor in doctors" :key="doctor.id">
                <div
                    class="bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden hover:shadow-lg transition-shadow">
                    {{-- Header with Photo --}}
                    <div class="p-6 border-b border-slate-100">
                        <div class="flex items-start space-x-4">
                            <template x-if="doctor.photo">
                                <img :src="doctor.photo" :alt="doctor.name" class="w-16 h-16 rounded-xl object-cover">
                            </template>
                            <template x-if="!doctor.photo">
                                <div class="w-16 h-16 rounded-xl flex items-center justify-center text-white font-bold text-xl"
                                    :style="'background-color: #' + doctor.color">
                                    <span x-text="doctor.name.split(' ')[1]?.charAt(0) || doctor.name.charAt(0)"></span>
                                </div>
                            </template>
                            <div class="flex-1 min-w-0">
                                <h3 class="font-bold text-slate-800" x-text="doctor.name"></h3>
                                <p class="text-sm text-sky-600 font-medium" x-text="doctor.specialty"></p>
                                <span class="inline-block mt-2 px-2 py-0.5 text-xs font-medium rounded-full"
                                    :class="doctor.status === 'active' ? 'bg-emerald-100 text-emerald-700' : 'bg-slate-100 text-slate-600'"
                                    x-text="doctor.status === 'active' ? 'Aktif' : 'Tidak Aktif'"></span>
                            </div>
                        </div>
                    </div>

                    {{-- Info --}}
                    <div class="p-6 space-y-3">
                        <div class="flex items-center text-sm">
                            <i data-lucide="briefcase" class="w-4 h-4 text-slate-400 mr-3"></i>
                            <span class="text-slate-600" x-text="doctor.experience + ' tahun pengalaman'"></span>
                        </div>
                        <div class="flex items-center text-sm">
                            <i data-lucide="graduation-cap" class="w-4 h-4 text-slate-400 mr-3"></i>
                            <span class="text-slate-600" x-text="doctor.education"></span>
                        </div>
                        <div class="flex items-center text-sm">
                            <i data-lucide="mail" class="w-4 h-4 text-slate-400 mr-3"></i>
                            <span class="text-slate-600" x-text="doctor.email"></span>
                        </div>
                        <div class="flex items-center text-sm">
                            <i data-lucide="phone" class="w-4 h-4 text-slate-400 mr-3"></i>
                            <span class="text-slate-600" x-text="doctor.phone"></span>
                        </div>
                    </div>

                    {{-- Schedule --}}
                    <div class="px-6 pb-6">
                        <p class="text-xs font-semibold text-slate-500 uppercase mb-2">Jadwal Praktik</p>
                        <div class="grid grid-cols-3 gap-2 text-xs">
                            <template x-for="(time, day) in doctor.schedule" :key="day">
                                <div class="text-center">
                                    <p class="font-medium text-slate-700 capitalize" x-text="day.substring(0, 3)"></p>
                                    <p class="text-slate-500" x-text="time === '-' ? 'Libur' : time.split(' - ')[0]"></p>
                                </div>
                            </template>
                        </div>
                    </div>

                    {{-- Actions --}}
                    <div class="px-6 pb-6 flex space-x-2">
                        <button @click="editDoctor(doctor)"
                            class="flex-1 py-2 bg-sky-50 hover:bg-sky-100 text-sky-600 font-medium rounded-xl text-sm transition">
                            <i data-lucide="pencil" class="w-4 h-4 inline mr-1"></i>
                            Edit
                        </button>
                        <button @click="deleteDoctor(doctor)"
                            class="flex-1 py-2 bg-red-50 hover:bg-red-100 text-red-600 font-medium rounded-xl text-sm transition">
                            <i data-lucide="trash-2" class="w-4 h-4 inline mr-1"></i>
                            Hapus
                        </button>
                    </div>
                </div>
            </template>
        </div>

        {{-- Add/Edit Doctor Modal --}}
        <div x-show="showAddModal" x-transition:enter="transition ease-out duration-200"
            x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
            x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100"
            x-transition:leave-end="opacity-0" class="fixed inset-0 z-50 flex items-center justify-center p-4"
            style="display: none;">
            <div class="fixed inset-0 bg-slate-900/50" @click="closeModal()"></div>

            <div x-show="showAddModal" x-transition:enter="transition ease-out duration-200"
                x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100"
                class="relative bg-white rounded-2xl shadow-2xl max-w-2xl w-full max-h-[90vh] overflow-y-auto">
                <div class="p-6 border-b border-slate-200">
                    <h2 class="text-xl font-bold text-slate-800 flex items-center">
                        <i data-lucide="stethoscope" class="w-6 h-6 mr-2 text-sky-500"></i>
                        <span x-text="isEditing ? 'Edit Dokter' : 'Tambah Dokter Baru'"></span>
                    </h2>
                </div>

                <form @submit.prevent="saveDoctor" class="p-6 space-y-4">
                    {{-- Photo Upload --}}
                    <div class="text-center">
                        <label class="block text-sm font-medium text-slate-700 mb-3">Foto Dokter</label>
                        <div @click="$refs.photoInput.click()" class="relative w-32 h-32 mx-auto cursor-pointer group">
                            <template x-if="photoPreview">
                                <img :src="photoPreview"
                                    class="w-32 h-32 rounded-2xl object-cover border-4 border-sky-200 group-hover:border-sky-400 transition">
                            </template>
                            <template x-if="!photoPreview">
                                <div
                                    class="w-32 h-32 rounded-2xl bg-gradient-to-br from-slate-100 to-slate-200 flex flex-col items-center justify-center border-4 border-dashed border-slate-300 group-hover:border-sky-400 group-hover:bg-sky-50 transition">
                                    <i data-lucide="camera"
                                        class="w-10 h-10 text-slate-400 group-hover:text-sky-500 transition"></i>
                                    <span class="text-xs text-slate-500 mt-2 group-hover:text-sky-600">Klik untuk
                                        upload</span>
                                </div>
                            </template>

                            {{-- Overlay on hover --}}
                            <div x-show="photoPreview"
                                class="absolute inset-0 rounded-2xl bg-black/50 flex items-center justify-center opacity-0 group-hover:opacity-100 transition">
                                <div class="text-center text-white">
                                    <i data-lucide="camera" class="w-8 h-8 mx-auto"></i>
                                    <span class="text-xs mt-1 block">Ganti Foto</span>
                                </div>
                            </div>
                        </div>

                        <input type="file" x-ref="photoInput" accept="image/*" @change="handlePhotoUpload($event)"
                            class="hidden">
                        <p class="text-xs text-slate-400 mt-3">Format: JPG, PNG. Maks 2MB</p>

                        {{-- Remove photo button --}}
                        <button type="button" x-show="photoPreview" @click="photoPreview = null; form.photo = ''"
                            class="mt-2 text-xs text-red-500 hover:text-red-600 font-medium">
                            <i data-lucide="x" class="w-3 h-3 inline"></i>
                            Hapus Foto
                        </button>
                    </div>

                    <div class="grid sm:grid-cols-2 gap-4">
                        <div class="sm:col-span-2">
                            <label class="block text-sm font-medium text-slate-700 mb-2">Nama Lengkap <span
                                    class="text-red-500">*</span></label>
                            <input type="text" x-model="form.name" required placeholder="Contoh: Dr. Andi Pratama, Sp.KG"
                                class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-sky-500 focus:border-sky-500 transition">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-slate-700 mb-2">Spesialisasi <span
                                    class="text-red-500">*</span></label>
                            <select x-model="form.specialty" required
                                class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-sky-500 focus:border-sky-500 transition">
                                <option value="">Pilih Spesialisasi</option>
                                <option value="Dokter Gigi Umum">Dokter Gigi Umum</option>
                                <option value="Konservasi Gigi">Konservasi Gigi</option>
                                <option value="Ortodonti">Ortodonti</option>
                                <option value="Bedah Mulut">Bedah Mulut</option>
                                <option value="Kedokteran Gigi Anak">Kedokteran Gigi Anak</option>
                                <option value="Prostodonti">Prostodonti</option>
                                <option value="Periodonti">Periodonti</option>
                                <option value="Endodonti">Endodonti</option>
                            </select>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-slate-700 mb-2">Pengalaman (Tahun) <span
                                    class="text-red-500">*</span></label>
                            <input type="number" x-model="form.experience" required min="0" placeholder="0"
                                class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-sky-500 focus:border-sky-500 transition">
                        </div>

                        <div class="sm:col-span-2">
                            <label class="block text-sm font-medium text-slate-700 mb-2">Pendidikan <span
                                    class="text-red-500">*</span></label>
                            <input type="text" x-model="form.education" required placeholder="Contoh: Universitas Indonesia"
                                class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-sky-500 focus:border-sky-500 transition">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-slate-700 mb-2">Email <span
                                    class="text-red-500">*</span></label>
                            <input type="email" x-model="form.email" required placeholder="dokter@klinikgigi.com"
                                class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-sky-500 focus:border-sky-500 transition">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-slate-700 mb-2">No. Telepon <span
                                    class="text-red-500">*</span></label>
                            <input type="tel" x-model="form.phone" required placeholder="08xxxxxxxxxx"
                                class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-sky-500 focus:border-sky-500 transition">
                        </div>

                        <div class="sm:col-span-2">
                            <label class="block text-sm font-medium text-slate-700 mb-2">Bio Singkat</label>
                            <textarea x-model="form.bio" rows="2" placeholder="Deskripsi singkat tentang dokter..."
                                class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-sky-500 focus:border-sky-500 transition resize-none"></textarea>
                        </div>

                        <div class="sm:col-span-2">
                            <label class="block text-sm font-medium text-slate-700 mb-2">Status</label>
                            <div class="flex items-center space-x-4">
                                <label class="flex items-center">
                                    <input type="radio" x-model="form.status" value="active"
                                        class="w-4 h-4 text-sky-500 focus:ring-sky-500">
                                    <span class="ml-2 text-sm text-slate-700">Aktif</span>
                                </label>
                                <label class="flex items-center">
                                    <input type="radio" x-model="form.status" value="inactive"
                                        class="w-4 h-4 text-sky-500 focus:ring-sky-500">
                                    <span class="ml-2 text-sm text-slate-700">Tidak Aktif</span>
                                </label>
                            </div>
                        </div>
                    </div>

                    {{-- Schedule --}}
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-3">Jadwal Praktik</label>
                        <div class="grid grid-cols-2 sm:grid-cols-3 gap-3">
                            <template x-for="day in ['senin', 'selasa', 'rabu', 'kamis', 'jumat', 'sabtu']" :key="day">
                                <div class="p-3 bg-slate-50 rounded-xl">
                                    <p class="text-xs font-semibold text-slate-700 capitalize mb-2" x-text="day"></p>
                                    <input type="text" x-model="form.schedule[day]" placeholder="09:00 - 15:00"
                                        class="w-full px-3 py-1.5 bg-white border border-slate-200 rounded-lg text-sm focus:ring-2 focus:ring-sky-500 focus:border-sky-500 transition">
                                </div>
                            </template>
                        </div>
                        <p class="text-xs text-slate-400 mt-2">Isi dengan "-" jika hari libur</p>
                    </div>

                    <div class="flex justify-end space-x-3 pt-4 border-t border-slate-200">
                        <button type="button" @click="closeModal()"
                            class="px-4 py-2 bg-slate-100 hover:bg-slate-200 text-slate-700 font-medium rounded-xl transition">
                            Batal
                        </button>
                        <button type="submit"
                            class="px-4 py-2 bg-sky-500 hover:bg-sky-600 text-white font-medium rounded-xl shadow-lg shadow-sky-500/30 transition">
                            <i data-lucide="save" class="w-4 h-4 inline mr-2"></i>
                            <span x-text="isEditing ? 'Simpan Perubahan' : 'Tambah Dokter'"></span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection

@push('scripts')
    <script>
        function doctorsPage() {
            return {
                doctors: [],
                totalPatients: 0,
                showAddModal: false,
                isEditing: false,
                editingId: null,
                photoPreview: null,
                form: {
                    name: '',
                    specialty: '',
                    experience: '',
                    education: '',
                    email: '',
                    phone: '',
                    bio: '',
                    photo: '',
                    status: 'active',
                    schedule: {
                        senin: '09:00 - 15:00',
                        selasa: '09:00 - 15:00',
                        rabu: '09:00 - 15:00',
                        kamis: '09:00 - 15:00',
                        jumat: '09:00 - 15:00',
                        sabtu: '09:00 - 13:00'
                    }
                },

                async init() {
                    await this.loadData();
                    this.calculateStats();
                    setTimeout(() => lucide.createIcons(), 100);
                },

                async loadData() {
                    try {
                        const res = await fetch('/api/doctors');
                        const data = await res.json();
                        this.doctors = data.doctors || [];
                    } catch (error) {
                        console.error('Error loading doctors:', error);
                    }
                },

                async saveData() {
                    try {
                        await fetch('/api/doctors', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                            },
                            body: JSON.stringify({ doctors: this.doctors })
                        });
                    } catch (error) {
                        console.error('Error saving doctors:', error);
                    }
                },

                calculateStats() {
                    this.totalPatients = this.doctors.reduce((sum, d) => sum + (d.totalPatients || 0), 0);
                },

                getRandomColor() {
                    const colors = ['0ea5e9', '10b981', '8b5cf6', 'f59e0b', '06b6d4', 'ec4899', 'ef4444'];
                    return colors[Math.floor(Math.random() * colors.length)];
                },

                handlePhotoUpload(event) {
                    const file = event.target.files[0];
                    if (file) {
                        if (file.size > 2 * 1024 * 1024) {
                            alert('Ukuran file terlalu besar. Maksimal 2MB.');
                            return;
                        }
                        const reader = new FileReader();
                        reader.onload = (e) => {
                            this.photoPreview = e.target.result;
                            this.form.photo = e.target.result;
                        };
                        reader.readAsDataURL(file);
                    }
                },

                resetForm() {
                    this.form = {
                        name: '',
                        specialty: '',
                        experience: '',
                        education: '',
                        email: '',
                        phone: '',
                        bio: '',
                        photo: '',
                        status: 'active',
                        schedule: {
                            senin: '09:00 - 15:00',
                            selasa: '09:00 - 15:00',
                            rabu: '09:00 - 15:00',
                            kamis: '09:00 - 15:00',
                            jumat: '09:00 - 15:00',
                            sabtu: '09:00 - 13:00'
                        }
                    };
                    this.photoPreview = null;
                    this.isEditing = false;
                    this.editingId = null;
                },

                closeModal() {
                    this.showAddModal = false;
                    this.resetForm();
                },

                async saveDoctor() {
                    if (this.isEditing) {
                        // Update existing doctor
                        const index = this.doctors.findIndex(d => d.id === this.editingId);
                        if (index !== -1) {
                            this.doctors[index] = {
                                ...this.doctors[index],
                                ...this.form,
                                experience: parseInt(this.form.experience)
                            };
                        }
                    } else {
                        // Add new doctor
                        const newDoctor = {
                            id: 'D' + String(Date.now()),
                            ...this.form,
                            experience: parseInt(this.form.experience),
                            totalPatients: 0,
                            color: this.getRandomColor(),
                            createdAt: new Date().toISOString()
                        };
                        this.doctors.push(newDoctor);
                    }

                    await this.saveData();
                    this.calculateStats();
                    this.closeModal();
                    setTimeout(() => lucide.createIcons(), 100);
                },

                editDoctor(doctor) {
                    this.isEditing = true;
                    this.editingId = doctor.id;
                    this.form = {
                        name: doctor.name,
                        specialty: doctor.specialty,
                        experience: doctor.experience,
                        education: doctor.education,
                        email: doctor.email,
                        phone: doctor.phone,
                        bio: doctor.bio || '',
                        photo: doctor.photo || '',
                        status: doctor.status,
                        schedule: { ...doctor.schedule }
                    };
                    this.photoPreview = doctor.photo || null;
                    this.showAddModal = true;
                },

                async deleteDoctor(doctor) {
                    if (confirm('Apakah Anda yakin ingin menghapus dokter ini?')) {
                        this.doctors = this.doctors.filter(d => d.id !== doctor.id);
                        await this.saveData();
                        this.calculateStats();
                    }
                }
            }
        }
    </script>
@endpush