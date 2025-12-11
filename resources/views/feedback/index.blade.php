{{--
Feedback Page
-------------
Halaman form feedback untuk user.
--}}

@extends('layouts.app')

@section('title', 'Feedback')

@section('content')

    <div x-data="feedbackForm()" x-init="init()">

        {{-- Hero Section --}}
        <section class="relative py-20 bg-gradient-to-br from-amber-50 via-white to-sky-50 overflow-hidden">
            <div class="absolute inset-0">
                <div class="absolute -top-40 -right-40 w-96 h-96 bg-amber-200 rounded-full opacity-30 blur-3xl"></div>
                <div class="absolute -bottom-40 -left-40 w-80 h-80 bg-sky-200 rounded-full opacity-30 blur-3xl"></div>
            </div>

            <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
                <div class="text-center max-w-2xl mx-auto mb-12">
                    <span
                        class="inline-flex items-center px-4 py-2 bg-amber-100 text-amber-700 rounded-full text-sm font-medium mb-6">
                        <i data-lucide="message-square" class="w-4 h-4 mr-2"></i>
                        Feedback
                    </span>
                    <h1 class="text-4xl sm:text-5xl font-extrabold text-slate-800 mb-6">
                        Berikan <span class="gradient-text">Masukan</span> Anda
                    </h1>
                    <p class="text-lg text-slate-600">
                        Pendapat Anda sangat berarti bagi kami untuk terus meningkatkan kualitas layanan.
                        Silakan isi form di bawah ini.
                    </p>
                </div>

                {{-- Feedback Form Card --}}
                <div class="bg-white rounded-3xl shadow-xl border border-slate-100 overflow-hidden">

                    {{-- Success Message --}}
                    <div x-show="submitted" x-transition class="p-12 text-center">
                        <div class="w-20 h-20 bg-emerald-100 rounded-full flex items-center justify-center mx-auto mb-6">
                            <i data-lucide="check-circle" class="w-10 h-10 text-emerald-600"></i>
                        </div>
                        <h2 class="text-2xl font-bold text-slate-800 mb-2">Terima Kasih!</h2>
                        <p class="text-slate-600 mb-6">Feedback Anda telah kami terima. Masukan Anda sangat berharga untuk
                            kemajuan kami.</p>
                        <button @click="resetForm()"
                            class="inline-flex items-center px-6 py-3 bg-sky-500 hover:bg-sky-600 text-white font-medium rounded-xl shadow-lg transition">
                            <i data-lucide="plus" class="w-5 h-5 mr-2"></i>
                            Kirim Feedback Lain
                        </button>
                    </div>

                    {{-- Form --}}
                    <form x-show="!submitted" @submit.prevent="submitFeedback" class="p-8 space-y-6">

                        {{-- Rating --}}
                        <div class="text-center">
                            <label class="block text-sm font-medium text-slate-700 mb-4">Bagaimana pengalaman Anda dengan
                                layanan kami?</label>
                            <div class="flex items-center justify-center space-x-2">
                                <template x-for="star in 5" :key="star">
                                    <button type="button" @click="form.rating = star"
                                        class="p-1 transition-transform hover:scale-110">
                                        <svg class="w-10 h-10 transition-colors"
                                            :class="star <= form.rating ? 'text-amber-400 fill-amber-400' : 'text-slate-300'"
                                            xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none"
                                            stroke="currentColor" stroke-width="2">
                                            <polygon
                                                points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2">
                                            </polygon>
                                        </svg>
                                    </button>
                                </template>
                            </div>
                            <p class="text-sm text-slate-500 mt-2" x-text="getRatingText()"></p>
                        </div>

                        <hr class="border-slate-200">

                        <div class="grid sm:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-slate-700 mb-2">Nama <span
                                        class="text-red-500">*</span></label>
                                <input type="text" x-model="form.name" required placeholder="Nama lengkap Anda"
                                    class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-sky-500 focus:border-sky-500 transition">
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-slate-700 mb-2">Email <span
                                        class="text-red-500">*</span></label>
                                <input type="email" x-model="form.email" required placeholder="nama@email.com"
                                    class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-sky-500 focus:border-sky-500 transition">
                            </div>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-slate-700 mb-2">Kategori</label>
                            <select x-model="form.category"
                                class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-sky-500 focus:border-sky-500 transition">
                                <option value="">Pilih Kategori</option>
                                <option value="pelayanan">Pelayanan Dokter & Staff</option>
                                <option value="fasilitas">Fasilitas Klinik</option>
                                <option value="harga">Harga & Pembayaran</option>
                                <option value="booking">Sistem Booking Online</option>
                                <option value="lainnya">Lainnya</option>
                            </select>
                        </div>

                        {{-- Custom Category Input --}}
                        <div x-show="form.category === 'lainnya'" x-transition>
                            <label class="block text-sm font-medium text-slate-700 mb-2">Kategori Lainnya <span
                                    class="text-red-500">*</span></label>
                            <input type="text" x-model="form.customCategory" :required="form.category === 'lainnya'"
                                placeholder="Ketik kategori feedback Anda..."
                                class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-sky-500 focus:border-sky-500 transition">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-slate-700 mb-2">Pesan Feedback <span
                                    class="text-red-500">*</span></label>
                            <textarea x-model="form.message" required rows="5"
                                placeholder="Ceritakan pengalaman atau masukan Anda..."
                                class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-sky-500 focus:border-sky-500 transition resize-none"></textarea>
                        </div>

                        <div>
                            <label class="flex items-start">
                                <input type="checkbox" x-model="form.allowPublish"
                                    class="w-5 h-5 mt-0.5 rounded border-slate-300 text-sky-500 focus:ring-sky-500">
                                <span class="ml-3 text-sm text-slate-600">
                                    Saya bersedia feedback ini ditampilkan sebagai testimoni di website (opsional)
                                </span>
                            </label>
                        </div>

                        <div class="pt-4">
                            <button type="submit" :disabled="loading"
                                class="w-full py-4 bg-gradient-to-r from-sky-500 to-emerald-500 text-white font-bold rounded-xl shadow-lg shadow-sky-500/30 hover:shadow-sky-500/50 hover:scale-[1.02] transition-all disabled:opacity-50">
                                <span x-show="!loading" class="flex items-center justify-center">
                                    <i data-lucide="send" class="w-5 h-5 mr-2"></i>
                                    Kirim Feedback
                                </span>
                                <span x-show="loading" class="flex items-center justify-center">
                                    <svg class="animate-spin w-5 h-5 mr-2" fill="none" viewBox="0 0 24 24">
                                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor"
                                            stroke-width="4"></circle>
                                        <path class="opacity-75" fill="currentColor"
                                            d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z"></path>
                                    </svg>
                                    Mengirim...
                                </span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </section>

        {{-- Contact Info --}}
        <section class="py-16 bg-white">
            <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center mb-12">
                    <h2 class="text-2xl font-bold text-slate-800 mb-4">Butuh Bantuan Langsung?</h2>
                    <p class="text-slate-600">Tim kami siap membantu Anda melalui berbagai channel komunikasi.</p>
                </div>

                <div class="grid sm:grid-cols-3 gap-6">
                    <a href="tel:+6212345678"
                        class="p-6 bg-slate-50 rounded-2xl text-center hover:bg-sky-50 transition group">
                        <div
                            class="w-14 h-14 bg-sky-100 rounded-xl flex items-center justify-center mx-auto mb-4 group-hover:bg-sky-200 transition">
                            <i data-lucide="phone" class="w-7 h-7 text-sky-600"></i>
                        </div>
                        <h3 class="font-bold text-slate-800 mb-1">Telepon</h3>
                        <p class="text-sm text-slate-600">(021) 1234-5678</p>
                    </a>

                    <a href="https://wa.me/6281234567890"
                        class="p-6 bg-slate-50 rounded-2xl text-center hover:bg-emerald-50 transition group">
                        <div
                            class="w-14 h-14 bg-emerald-100 rounded-xl flex items-center justify-center mx-auto mb-4 group-hover:bg-emerald-200 transition">
                            <i data-lucide="message-circle" class="w-7 h-7 text-emerald-600"></i>
                        </div>
                        <h3 class="font-bold text-slate-800 mb-1">WhatsApp</h3>
                        <p class="text-sm text-slate-600">+62 812-3456-7890</p>
                    </a>

                    <a href="mailto:info@klinikgigi.com"
                        class="p-6 bg-slate-50 rounded-2xl text-center hover:bg-amber-50 transition group">
                        <div
                            class="w-14 h-14 bg-amber-100 rounded-xl flex items-center justify-center mx-auto mb-4 group-hover:bg-amber-200 transition">
                            <i data-lucide="mail" class="w-7 h-7 text-amber-600"></i>
                        </div>
                        <h3 class="font-bold text-slate-800 mb-1">Email</h3>
                        <p class="text-sm text-slate-600">info@klinikgigi.com</p>
                    </a>
                </div>
            </div>
        </section>

    </div>

@endsection

@push('scripts')
    <script>
        function feedbackForm() {
            return {
                loading: false,
                submitted: false,
                form: {
                    name: '',
                    email: '',
                    rating: 0,
                    category: '',
                    customCategory: '',
                    message: '',
                    allowPublish: false
                },

                init() {
                    // Check if user is logged in and pre-fill
                    const user = localStorage.getItem('klinik_current_user');
                    if (user) {
                        const userData = JSON.parse(user);
                        this.form.name = userData.name || '';
                        this.form.email = userData.email || '';
                    }
                },

                getRatingText() {
                    const texts = ['', 'Sangat Buruk', 'Buruk', 'Cukup', 'Baik', 'Sangat Baik'];
                    return this.form.rating > 0 ? texts[this.form.rating] : 'Klik bintang untuk memberi rating';
                },

                async submitFeedback() {
                    this.loading = true;

                    try {
                        // Determine final category
                        const finalCategory = this.form.category === 'lainnya'
                            ? this.form.customCategory
                            : this.form.category;

                        // Get existing feedbacks
                        const res = await fetch('/api/feedbacks');
                        const data = await res.json();
                        const feedbacks = data.feedbacks || [];

                        // Add new feedback
                        const newFeedback = {
                            id: 'F' + String(Date.now()),
                            name: this.form.name,
                            email: this.form.email,
                            rating: this.form.rating,
                            category: finalCategory,
                            message: this.form.message,
                            allowPublish: this.form.allowPublish,
                            createdAt: new Date().toISOString()
                        };
                        feedbacks.push(newFeedback);

                        // Save to API
                        await fetch('/api/feedbacks', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                            },
                            body: JSON.stringify({ feedbacks: feedbacks })
                        });

                        this.loading = false;
                        this.submitted = true;
                    } catch (error) {
                        console.error('Error saving feedback:', error);
                        this.loading = false;
                        alert('Terjadi kesalahan. Silakan coba lagi.');
                    }
                },

                resetForm() {
                    this.form = {
                        name: '',
                        email: '',
                        rating: 0,
                        category: '',
                        customCategory: '',
                        message: '',
                        allowPublish: false
                    };
                    this.submitted = false;

                    // Re-fill if logged in
                    const user = localStorage.getItem('klinik_current_user');
                    if (user) {
                        const userData = JSON.parse(user);
                        this.form.name = userData.name || '';
                        this.form.email = userData.email || '';
                    }
                }
            }
        }
    </script>
@endpush