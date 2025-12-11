{{--
Admin Feedbacks Page
--------------------
Halaman untuk melihat dan mengelola feedback dari user.
--}}

@extends('layouts.admin')

@section('title', 'Feedback')
@section('page-title', 'Feedback Pengguna')

@section('content')

    <div x-data="feedbacksPage()" x-init="init()">

        {{-- Header --}}
        <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4 mb-6">
            <div>
                <p class="text-slate-600">Lihat semua feedback dari pengguna</p>
            </div>
            <div class="flex items-center gap-3">
                <button @click="exportFeedbacks()"
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
                        <p class="text-sm text-slate-500">Total Feedback</p>
                        <p class="text-2xl font-bold text-slate-800" x-text="feedbacks.length">0</p>
                    </div>
                    <div class="w-10 h-10 bg-sky-100 rounded-lg flex items-center justify-center">
                        <i data-lucide="message-square" class="w-5 h-5 text-sky-600"></i>
                    </div>
                </div>
            </div>
            <div class="bg-white rounded-xl p-4 shadow-sm border border-slate-100">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-slate-500">Rating Rata-rata</p>
                        <p class="text-2xl font-bold text-amber-600" x-text="avgRating">0</p>
                    </div>
                    <div class="w-10 h-10 bg-amber-100 rounded-lg flex items-center justify-center">
                        <i data-lucide="star" class="w-5 h-5 text-amber-600"></i>
                    </div>
                </div>
            </div>
            <div class="bg-white rounded-xl p-4 shadow-sm border border-slate-100">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-slate-500">Izinkan Publikasi</p>
                        <p class="text-2xl font-bold text-emerald-600"
                            x-text="feedbacks.filter(f => f.allowPublish).length">0</p>
                    </div>
                    <div class="w-10 h-10 bg-emerald-100 rounded-lg flex items-center justify-center">
                        <i data-lucide="check-circle" class="w-5 h-5 text-emerald-600"></i>
                    </div>
                </div>
            </div>
            <div class="bg-white rounded-xl p-4 shadow-sm border border-slate-100">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-slate-500">Bulan Ini</p>
                        <p class="text-2xl font-bold text-purple-600" x-text="thisMonthCount">0</p>
                    </div>
                    <div class="w-10 h-10 bg-purple-100 rounded-lg flex items-center justify-center">
                        <i data-lucide="calendar" class="w-5 h-5 text-purple-600"></i>
                    </div>
                </div>
            </div>
        </div>

        {{-- Filters --}}
        <div class="bg-white rounded-2xl p-4 shadow-sm border border-slate-100 mb-6">
            <div class="flex flex-col md:flex-row items-center gap-4">
                <div class="relative flex-1 w-full">
                    <i data-lucide="search" class="absolute left-4 top-1/2 -translate-y-1/2 w-5 h-5 text-slate-400"></i>
                    <input type="text" x-model="search" placeholder="Cari nama atau pesan..."
                        class="w-full pl-12 pr-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-sky-500 focus:border-sky-500 transition">
                </div>
                <select x-model="filterRating"
                    class="px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-sm focus:ring-2 focus:ring-sky-500">
                    <option value="">Semua Rating</option>
                    <option value="5">5 Bintang</option>
                    <option value="4">4 Bintang</option>
                    <option value="3">3 Bintang</option>
                    <option value="2">2 Bintang</option>
                    <option value="1">1 Bintang</option>
                </select>
                <select x-model="filterCategory"
                    class="px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-sm focus:ring-2 focus:ring-sky-500">
                    <option value="">Semua Kategori</option>
                    <option value="pelayanan">Pelayanan</option>
                    <option value="fasilitas">Fasilitas</option>
                    <option value="harga">Harga</option>
                    <option value="booking">Booking</option>
                </select>
            </div>
        </div>

        {{-- Empty State --}}
        <div x-show="feedbacks.length === 0"
            class="bg-white rounded-2xl shadow-sm border border-slate-100 p-12 text-center">
            <div class="w-20 h-20 bg-slate-100 rounded-full flex items-center justify-center mx-auto mb-4">
                <i data-lucide="message-square" class="w-10 h-10 text-slate-400"></i>
            </div>
            <h3 class="text-xl font-bold text-slate-800 mb-2">Belum Ada Feedback</h3>
            <p class="text-slate-500">Feedback dari pengguna akan muncul di sini.</p>
        </div>

        {{-- Feedbacks List --}}
        <div x-show="feedbacks.length > 0" class="space-y-4">
            <template x-for="feedback in filteredFeedbacks" :key="feedback.id">
                <div
                    class="bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden hover:shadow-lg transition">
                    <div class="p-6">
                        <div class="flex items-start justify-between mb-4">
                            <div class="flex items-center space-x-4">
                                <div class="w-12 h-12 rounded-full flex items-center justify-center text-white font-bold"
                                    :style="'background-color: #' + getColor(feedback.name)">
                                    <span x-text="feedback.name.charAt(0).toUpperCase()"></span>
                                </div>
                                <div>
                                    <h3 class="font-bold text-slate-800" x-text="feedback.name"></h3>
                                    <p class="text-sm text-slate-500" x-text="feedback.email"></p>
                                </div>
                            </div>
                            <div class="text-right">
                                <div class="flex items-center space-x-1 mb-1">
                                    <template x-for="star in 5" :key="star">
                                        <svg class="w-5 h-5"
                                            :class="star <= feedback.rating ? 'text-amber-400 fill-amber-400' : 'text-slate-200'"
                                            xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none"
                                            stroke="currentColor" stroke-width="2">
                                            <polygon
                                                points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2">
                                            </polygon>
                                        </svg>
                                    </template>
                                </div>
                                <p class="text-xs text-slate-400" x-text="formatDate(feedback.createdAt)"></p>
                            </div>
                        </div>

                        <div class="flex items-center gap-2 mb-3">
                            <span class="px-2.5 py-1 text-xs font-medium rounded-lg bg-sky-100 text-sky-700"
                                x-text="getCategoryLabel(feedback.category)"></span>
                            <span x-show="feedback.allowPublish"
                                class="px-2.5 py-1 text-xs font-medium rounded-lg bg-emerald-100 text-emerald-700">
                                <i data-lucide="check" class="w-3 h-3 inline"></i>
                                Izinkan Publikasi
                            </span>
                        </div>

                        <p class="text-slate-600 leading-relaxed" x-text="feedback.message"></p>
                    </div>

                    <div class="px-6 py-4 bg-slate-50 border-t border-slate-100 flex items-center justify-between">
                        <span class="text-xs text-slate-500" x-text="'ID: ' + feedback.id"></span>
                        <div class="flex items-center space-x-2">
                            <button x-show="feedback.allowPublish"
                                class="px-3 py-1.5 bg-emerald-500 hover:bg-emerald-600 text-white text-xs font-medium rounded-lg transition">
                                Tampilkan di Website
                            </button>
                            <button @click="deleteFeedback(feedback)"
                                class="px-3 py-1.5 bg-red-50 hover:bg-red-100 text-red-600 text-xs font-medium rounded-lg transition">
                                <i data-lucide="trash-2" class="w-4 h-4 inline"></i>
                                Hapus
                            </button>
                        </div>
                    </div>
                </div>
            </template>
        </div>

        {{-- Pagination Info --}}
        <div x-show="feedbacks.length > 0" class="mt-6 text-center">
            <p class="text-sm text-slate-500">
                Menampilkan <span class="font-medium" x-text="filteredFeedbacks.length"></span> dari <span
                    class="font-medium" x-text="feedbacks.length"></span> feedback
            </p>
        </div>
    </div>

@endsection

@push('scripts')
    <script>
        function feedbacksPage() {
            return {
                feedbacks: [],
                search: '',
                filterRating: '',
                filterCategory: '',
                avgRating: 0,
                thisMonthCount: 0,

                async init() {
                    await this.loadData();
                    this.calculateStats();
                    setTimeout(() => lucide.createIcons(), 100);
                },

                async loadData() {
                    try {
                        const res = await fetch('/api/feedbacks');
                        const data = await res.json();
                        this.feedbacks = data.feedbacks || [];
                    } catch (error) {
                        console.error('Error loading feedbacks:', error);
                    }
                },

                async saveData() {
                    try {
                        await fetch('/api/feedbacks', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                            },
                            body: JSON.stringify({ feedbacks: this.feedbacks })
                        });
                    } catch (error) {
                        console.error('Error saving feedbacks:', error);
                    }
                },

                calculateStats() {
                    if (this.feedbacks.length > 0) {
                        const totalRating = this.feedbacks.reduce((sum, f) => sum + (f.rating || 0), 0);
                        this.avgRating = (totalRating / this.feedbacks.length).toFixed(1);
                    }

                    const now = new Date();
                    this.thisMonthCount = this.feedbacks.filter(f => {
                        const created = new Date(f.createdAt);
                        return created.getMonth() === now.getMonth() && created.getFullYear() === now.getFullYear();
                    }).length;
                },

                get filteredFeedbacks() {
                    return this.feedbacks.filter(f => {
                        const matchSearch = !this.search ||
                            f.name.toLowerCase().includes(this.search.toLowerCase()) ||
                            f.message.toLowerCase().includes(this.search.toLowerCase());
                        const matchRating = !this.filterRating || f.rating === parseInt(this.filterRating);
                        const matchCategory = !this.filterCategory || f.category === this.filterCategory;
                        return matchSearch && matchRating && matchCategory;
                    }).sort((a, b) => new Date(b.createdAt) - new Date(a.createdAt));
                },

                getColor(name) {
                    const colors = ['0ea5e9', '10b981', '8b5cf6', 'f59e0b', 'ef4444', '06b6d4', 'ec4899'];
                    const index = name.charCodeAt(0) % colors.length;
                    return colors[index];
                },

                getCategoryLabel(category) {
                    const labels = {
                        'pelayanan': 'Pelayanan',
                        'fasilitas': 'Fasilitas',
                        'harga': 'Harga & Pembayaran',
                        'booking': 'Sistem Booking'
                    };
                    return labels[category] || category || 'Umum';
                },

                formatDate(dateStr) {
                    if (!dateStr) return '-';
                    const date = new Date(dateStr);
                    return date.toLocaleDateString('id-ID', {
                        day: 'numeric',
                        month: 'short',
                        year: 'numeric',
                        hour: '2-digit',
                        minute: '2-digit'
                    });
                },

                async deleteFeedback(feedback) {
                    if (confirm('Apakah Anda yakin ingin menghapus feedback ini?')) {
                        this.feedbacks = this.feedbacks.filter(f => f.id !== feedback.id);
                        await this.saveData();
                        this.calculateStats();
                    }
                },

                exportFeedbacks() {
                    const dataStr = JSON.stringify(this.feedbacks, null, 2);
                    const blob = new Blob([dataStr], { type: 'application/json' });
                    const url = URL.createObjectURL(blob);
                    const a = document.createElement('a');
                    a.href = url;
                    a.download = 'feedbacks_' + new Date().toISOString().split('T')[0] + '.json';
                    a.click();
                }
            }
        }
    </script>
@endpush