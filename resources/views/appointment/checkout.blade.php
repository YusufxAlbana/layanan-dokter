{{--
Checkout DP Page
----------------
Halaman pembayaran DP untuk janji temu.

Features:
- Ringkasan janji temu
- Pilihan metode pembayaran
- Form DP

TODO Backend:
- Integrasi payment gateway
- Kalkulasi biaya dinamis
- Generate invoice
--}}

@extends('layouts.app')

@section('title', 'Pembayaran DP - Klinik Gigi Sehat')

@section('content')

    {{-- Progress Steps --}}
    <section class="bg-white border-b border-slate-200 py-6">
        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between">
                {{-- Step 1 --}}
                <div class="flex items-center">
                    <div
                        class="w-10 h-10 bg-emerald-500 text-white rounded-full flex items-center justify-center font-bold">
                        <i data-lucide="check" class="w-5 h-5"></i>
                    </div>
                    <span class="ml-3 font-medium text-slate-500 hidden sm:block">Data Pasien</span>
                </div>

                <div class="flex-1 mx-4 h-1 bg-sky-500 rounded-full"></div>

                {{-- Step 2 --}}
                <div class="flex items-center">
                    <div
                        class="w-10 h-10 bg-sky-500 text-white rounded-full flex items-center justify-center font-bold shadow-lg shadow-sky-500/30">
                        2
                    </div>
                    <span class="ml-3 font-semibold text-slate-800 hidden sm:block">Pembayaran</span>
                </div>

                <div class="flex-1 mx-4 h-1 bg-slate-200 rounded-full"></div>

                {{-- Step 3 --}}
                <div class="flex items-center">
                    <div
                        class="w-10 h-10 bg-slate-200 text-slate-500 rounded-full flex items-center justify-center font-bold">
                        3
                    </div>
                    <span class="ml-3 font-medium text-slate-500 hidden sm:block">Konfirmasi</span>
                </div>
            </div>
        </div>
    </section>

    {{-- Checkout Section --}}
    <section class="py-12 bg-slate-50 min-h-screen">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid lg:grid-cols-5 gap-8">

                {{-- Left Column - Payment Methods --}}
                <div class="lg:col-span-3">
                    <div class="bg-white rounded-3xl shadow-xl shadow-slate-200/50 overflow-hidden">
                        {{-- Header --}}
                        <div class="bg-gradient-to-r from-sky-500 to-emerald-500 px-8 py-6">
                            <h1 class="text-2xl font-bold text-white flex items-center">
                                <i data-lucide="credit-card" class="w-7 h-7 mr-3"></i>
                                Pembayaran DP
                            </h1>
                            <p class="text-white/90 mt-1">Pilih metode pembayaran untuk melanjutkan</p>
                        </div>

                        {{-- Payment Methods --}}
                        <div class="p-8" x-data="{ selectedMethod: 'transfer' }">
                            <h2 class="text-lg font-semibold text-slate-800 mb-4">Metode Pembayaran</h2>

                            {{-- Bank Transfer --}}
                            <label class="block mb-4 cursor-pointer">
                                <div :class="selectedMethod === 'transfer' ? 'border-sky-500 bg-sky-50' : 'border-slate-200 hover:border-slate-300'"
                                    class="p-4 border-2 rounded-2xl transition">
                                    <div class="flex items-center">
                                        <input type="radio" name="payment_method" value="transfer" x-model="selectedMethod"
                                            class="w-5 h-5 text-sky-500 border-slate-300 focus:ring-sky-500">
                                        <div class="ml-4 flex-1">
                                            <div class="flex items-center justify-between">
                                                <span class="font-semibold text-slate-800">Transfer Bank</span>
                                                <div class="flex items-center space-x-2">
                                                    <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/5/5c/Bank_Central_Asia.svg/120px-Bank_Central_Asia.svg.png"
                                                        alt="BCA" class="h-6">
                                                    <img src="https://upload.wikimedia.org/wikipedia/id/thumb/5/55/BNI_logo.svg/120px-BNI_logo.svg.png"
                                                        alt="BNI" class="h-6">
                                                    <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/6/68/BANK_BRI_logo.svg/120px-BANK_BRI_logo.svg.png"
                                                        alt="BRI" class="h-6">
                                                </div>
                                            </div>
                                            <p class="text-sm text-slate-500 mt-1">Transfer manual ke rekening klinik</p>
                                        </div>
                                    </div>

                                    {{-- Transfer Details --}}
                                    <div x-show="selectedMethod === 'transfer'" x-transition
                                        class="mt-4 pt-4 border-t border-slate-200">
                                        <div class="grid sm:grid-cols-2 gap-4">
                                            <div class="p-4 bg-white rounded-xl border border-slate-200">
                                                <p class="text-sm text-slate-500">Bank BCA</p>
                                                <p class="font-mono font-bold text-slate-800">1234567890</p>
                                                <p class="text-sm text-slate-600">a.n. PT Klinik Gigi Sehat</p>
                                            </div>
                                            <div class="p-4 bg-white rounded-xl border border-slate-200">
                                                <p class="text-sm text-slate-500">Bank BNI</p>
                                                <p class="font-mono font-bold text-slate-800">0987654321</p>
                                                <p class="text-sm text-slate-600">a.n. PT Klinik Gigi Sehat</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </label>

                            {{-- E-Wallet --}}
                            <label class="block mb-4 cursor-pointer">
                                <div :class="selectedMethod === 'ewallet' ? 'border-sky-500 bg-sky-50' : 'border-slate-200 hover:border-slate-300'"
                                    class="p-4 border-2 rounded-2xl transition">
                                    <div class="flex items-center">
                                        <input type="radio" name="payment_method" value="ewallet" x-model="selectedMethod"
                                            class="w-5 h-5 text-sky-500 border-slate-300 focus:ring-sky-500">
                                        <div class="ml-4 flex-1">
                                            <div class="flex items-center justify-between">
                                                <span class="font-semibold text-slate-800">E-Wallet</span>
                                                <div class="flex items-center space-x-2">
                                                    <div
                                                        class="px-2 py-1 bg-green-100 rounded text-xs font-semibold text-green-700">
                                                        GoPay</div>
                                                    <div
                                                        class="px-2 py-1 bg-blue-100 rounded text-xs font-semibold text-blue-700">
                                                        OVO</div>
                                                    <div
                                                        class="px-2 py-1 bg-purple-100 rounded text-xs font-semibold text-purple-700">
                                                        DANA</div>
                                                </div>
                                            </div>
                                            <p class="text-sm text-slate-500 mt-1">Bayar menggunakan e-wallet favorit Anda
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </label>

                            {{-- QRIS --}}
                            <label class="block mb-4 cursor-pointer">
                                <div :class="selectedMethod === 'qris' ? 'border-sky-500 bg-sky-50' : 'border-slate-200 hover:border-slate-300'"
                                    class="p-4 border-2 rounded-2xl transition">
                                    <div class="flex items-center">
                                        <input type="radio" name="payment_method" value="qris" x-model="selectedMethod"
                                            class="w-5 h-5 text-sky-500 border-slate-300 focus:ring-sky-500">
                                        <div class="ml-4 flex-1">
                                            <div class="flex items-center justify-between">
                                                <span class="font-semibold text-slate-800">QRIS</span>
                                                <div
                                                    class="px-3 py-1 bg-red-100 rounded text-xs font-semibold text-red-700">
                                                    QRIS</div>
                                            </div>
                                            <p class="text-sm text-slate-500 mt-1">Scan QR code untuk pembayaran instan</p>
                                        </div>
                                    </div>

                                    {{-- QRIS QR Code --}}
                                    <div x-show="selectedMethod === 'qris'" x-transition
                                        class="mt-4 pt-4 border-t border-slate-200 text-center">
                                        <div class="inline-block p-4 bg-white rounded-xl border border-slate-200">
                                            <div class="w-48 h-48 bg-slate-100 rounded-lg flex items-center justify-center">
                                                <div class="text-center">
                                                    <i data-lucide="qr-code" class="w-24 h-24 text-slate-400 mx-auto"></i>
                                                    <p class="text-sm text-slate-500 mt-2">QR Code Placeholder</p>
                                                </div>
                                            </div>
                                        </div>
                                        <p class="text-sm text-slate-500 mt-3">Scan menggunakan aplikasi e-wallet atau
                                            mobile banking</p>
                                    </div>
                                </div>
                            </label>

                            {{-- Credit Card --}}
                            <label class="block cursor-pointer">
                                <div :class="selectedMethod === 'card' ? 'border-sky-500 bg-sky-50' : 'border-slate-200 hover:border-slate-300'"
                                    class="p-4 border-2 rounded-2xl transition">
                                    <div class="flex items-center">
                                        <input type="radio" name="payment_method" value="card" x-model="selectedMethod"
                                            class="w-5 h-5 text-sky-500 border-slate-300 focus:ring-sky-500">
                                        <div class="ml-4 flex-1">
                                            <div class="flex items-center justify-between">
                                                <span class="font-semibold text-slate-800">Kartu Kredit/Debit</span>
                                                <div class="flex items-center space-x-2">
                                                    <div
                                                        class="px-2 py-1 bg-blue-900 rounded text-xs font-semibold text-white">
                                                        VISA</div>
                                                    <div
                                                        class="px-2 py-1 bg-red-500 rounded text-xs font-semibold text-white">
                                                        MC</div>
                                                </div>
                                            </div>
                                            <p class="text-sm text-slate-500 mt-1">Pembayaran dengan kartu kredit atau debit
                                            </p>
                                        </div>
                                    </div>

                                    {{-- Card Form --}}
                                    <div x-show="selectedMethod === 'card'" x-transition
                                        class="mt-4 pt-4 border-t border-slate-200 space-y-4">
                                        <div>
                                            <label class="block text-sm font-medium text-slate-700 mb-2">Nomor Kartu</label>
                                            <input type="text" placeholder="1234 5678 9012 3456"
                                                class="w-full px-4 py-3 bg-white border border-slate-200 rounded-xl focus:ring-2 focus:ring-sky-500 focus:border-sky-500 transition">
                                        </div>
                                        <div class="grid grid-cols-2 gap-4">
                                            <div>
                                                <label class="block text-sm font-medium text-slate-700 mb-2">Masa
                                                    Berlaku</label>
                                                <input type="text" placeholder="MM/YY"
                                                    class="w-full px-4 py-3 bg-white border border-slate-200 rounded-xl focus:ring-2 focus:ring-sky-500 focus:border-sky-500 transition">
                                            </div>
                                            <div>
                                                <label class="block text-sm font-medium text-slate-700 mb-2">CVV</label>
                                                <input type="text" placeholder="123"
                                                    class="w-full px-4 py-3 bg-white border border-slate-200 rounded-xl focus:ring-2 focus:ring-sky-500 focus:border-sky-500 transition">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </label>
                        </div>
                    </div>
                </div>

                {{-- Right Column - Summary --}}
                <div class="lg:col-span-2">
                    <div class="bg-white rounded-3xl shadow-xl shadow-slate-200/50 overflow-hidden sticky top-28">
                        <div class="p-6 border-b border-slate-200">
                            <h2 class="text-lg font-semibold text-slate-800 flex items-center">
                                <i data-lucide="clipboard-list" class="w-5 h-5 mr-2 text-sky-500"></i>
                                Ringkasan Janji Temu
                            </h2>
                        </div>

                        <div class="p-6">
                            {{-- Doctor Info --}}
                            <div class="flex items-center space-x-4 mb-6 pb-6 border-b border-slate-200">
                                <img src="https://images.unsplash.com/photo-1612349317150-e413f6a5b16d?w=100&h=100&fit=crop"
                                    alt="Dr. Andi Pratama" class="w-16 h-16 rounded-xl object-cover">
                                <div>
                                    <p class="font-semibold text-slate-800">Dr. Andi Pratama, Sp.KG</p>
                                    <p class="text-sm text-slate-500">Dokter Gigi Konservasi</p>
                                </div>
                            </div>

                            {{-- Appointment Details --}}
                            <div class="space-y-3 mb-6 pb-6 border-b border-slate-200">
                                <div class="flex justify-between text-sm">
                                    <span class="text-slate-500">Tanggal</span>
                                    <span class="font-medium text-slate-800">Rabu, 11 Des 2024</span>
                                </div>
                                <div class="flex justify-between text-sm">
                                    <span class="text-slate-500">Waktu</span>
                                    <span class="font-medium text-slate-800">09:00 WIB</span>
                                </div>
                                <div class="flex justify-between text-sm">
                                    <span class="text-slate-500">Layanan</span>
                                    <span class="font-medium text-slate-800">Pemeriksaan Gigi</span>
                                </div>
                            </div>

                            {{-- Price Breakdown --}}
                            <div class="space-y-3 mb-6 pb-6 border-b border-slate-200">
                                <div class="flex justify-between text-sm">
                                    <span class="text-slate-500">Biaya Pemeriksaan</span>
                                    <span class="font-medium text-slate-800">Rp 150.000</span>
                                </div>
                                <div class="flex justify-between text-sm">
                                    <span class="text-slate-500">Biaya Admin</span>
                                    <span class="font-medium text-slate-800">Rp 5.000</span>
                                </div>
                            </div>

                            {{-- DP Info --}}
                            <div class="p-4 bg-amber-50 border border-amber-200 rounded-xl mb-6">
                                <div class="flex items-start space-x-2">
                                    <i data-lucide="info" class="w-5 h-5 text-amber-600 flex-shrink-0 mt-0.5"></i>
                                    <div>
                                        <p class="text-sm font-medium text-amber-800">Pembayaran DP 50%</p>
                                        <p class="text-xs text-amber-600 mt-1">Sisa pembayaran dapat dilunasi saat kunjungan
                                        </p>
                                    </div>
                                </div>
                            </div>

                            {{-- Total DP --}}
                            <div class="flex justify-between items-center mb-6">
                                <span class="text-lg font-semibold text-slate-800">Total DP</span>
                                <span class="text-2xl font-bold text-sky-600">Rp 77.500</span>
                            </div>

                            {{-- Pay Button --}}
                            <a href="{{ url('/appointment/confirmed') }}"
                                class="flex items-center justify-center w-full px-6 py-4 bg-gradient-to-r from-sky-500 to-emerald-500 text-white font-bold rounded-xl shadow-lg shadow-sky-500/30 hover:shadow-sky-500/50 hover:scale-105 transition-all duration-300">
                                <i data-lucide="lock" class="w-5 h-5 mr-2"></i>
                                Bayar DP Sekarang
                            </a>

                            {{-- Security Note --}}
                            <p class="text-xs text-center text-slate-500 mt-4 flex items-center justify-center">
                                <i data-lucide="shield-check" class="w-4 h-4 mr-1 text-emerald-500"></i>
                                Pembayaran aman & terenkripsi
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection