{{--
Konfirmasi Janji Temu Page
--------------------------
Halaman konfirmasi setelah pembayaran berhasil.

Features:
- Status konfirmasi
- Detail janji temu
- Preview email
- Tombol kembali ke beranda

TODO Backend:
- Generate booking ID
- Send confirmation email
- Save appointment data
--}}

@extends('layouts.app')

@section('title', 'Konfirmasi Berhasil - Klinik Gigi Sehat')

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

                <div class="flex-1 mx-4 h-1 bg-emerald-500 rounded-full"></div>

                {{-- Step 2 --}}
                <div class="flex items-center">
                    <div
                        class="w-10 h-10 bg-emerald-500 text-white rounded-full flex items-center justify-center font-bold">
                        <i data-lucide="check" class="w-5 h-5"></i>
                    </div>
                    <span class="ml-3 font-medium text-slate-500 hidden sm:block">Pembayaran</span>
                </div>

                <div class="flex-1 mx-4 h-1 bg-emerald-500 rounded-full"></div>

                {{-- Step 3 --}}
                <div class="flex items-center">
                    <div
                        class="w-10 h-10 bg-emerald-500 text-white rounded-full flex items-center justify-center font-bold shadow-lg shadow-emerald-500/30">
                        <i data-lucide="check" class="w-5 h-5"></i>
                    </div>
                    <span class="ml-3 font-semibold text-slate-800 hidden sm:block">Konfirmasi</span>
                </div>
            </div>
        </div>
    </section>

    {{-- Confirmation Section --}}
    <section class="py-12 bg-slate-50 min-h-screen">
        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">

            {{-- Success Message --}}
            <div class="text-center mb-8">
                <div class="inline-flex items-center justify-center w-24 h-24 bg-emerald-100 rounded-full mb-6">
                    <i data-lucide="check-circle" class="w-12 h-12 text-emerald-600"></i>
                </div>
                <h1 class="text-3xl font-bold text-slate-800 mb-2">Pembayaran Berhasil!</h1>
                <p class="text-slate-600">Janji temu Anda telah dikonfirmasi. Detail telah dikirim ke email Anda.</p>
            </div>

            {{-- Booking Details Card --}}
            <div class="bg-white rounded-3xl shadow-xl shadow-slate-200/50 overflow-hidden mb-8">
                <div class="bg-gradient-to-r from-emerald-500 to-sky-500 px-8 py-6">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-emerald-100 text-sm">Nomor Booking</p>
                            <p class="text-2xl font-bold text-white font-mono">KGS-2024121101</p>
                        </div>
                        <div class="text-right">
                            <p class="text-emerald-100 text-sm">Status</p>
                            <span
                                class="inline-flex items-center px-3 py-1 bg-white/20 rounded-full text-white text-sm font-medium">
                                <span class="w-2 h-2 bg-white rounded-full mr-2 animate-pulse"></span>
                                Terkonfirmasi
                            </span>
                        </div>
                    </div>
                </div>

                <div class="p-8">
                    {{-- Doctor & Appointment Info --}}
                    <div
                        class="flex flex-col sm:flex-row items-start sm:items-center justify-between pb-6 mb-6 border-b border-slate-200">
                        <div class="flex items-center space-x-4 mb-4 sm:mb-0">
                            <img src="https://images.unsplash.com/photo-1612349317150-e413f6a5b16d?w=100&h=100&fit=crop"
                                alt="Dr. Andi Pratama" class="w-16 h-16 rounded-xl object-cover">
                            <div>
                                <p class="font-semibold text-slate-800">Dr. Andi Pratama, Sp.KG</p>
                                <p class="text-sm text-slate-500">Dokter Gigi Konservasi</p>
                            </div>
                        </div>
                        <div class="text-left sm:text-right">
                            <p class="font-semibold text-slate-800">Rabu, 11 Desember 2024</p>
                            <p class="text-sky-600 font-medium">09:00 WIB</p>
                        </div>
                    </div>

                    {{-- Appointment Details --}}
                    <div class="grid sm:grid-cols-2 gap-6 mb-6">
                        <div>
                            <p class="text-sm text-slate-500 mb-1">Nama Pasien</p>
                            <p class="font-medium text-slate-800">John Doe</p>
                        </div>
                        <div>
                            <p class="text-sm text-slate-500 mb-1">Email</p>
                            <p class="font-medium text-slate-800">johndoe@email.com</p>
                        </div>
                        <div>
                            <p class="text-sm text-slate-500 mb-1">Layanan</p>
                            <p class="font-medium text-slate-800">Pemeriksaan Gigi</p>
                        </div>
                        <div>
                            <p class="text-sm text-slate-500 mb-1">DP Dibayar</p>
                            <p class="font-medium text-emerald-600">Rp 77.500</p>
                        </div>
                    </div>

                    {{-- Important Notes --}}
                    <div class="p-4 bg-amber-50 border border-amber-200 rounded-xl">
                        <h3 class="font-semibold text-amber-800 mb-2 flex items-center">
                            <i data-lucide="alert-circle" class="w-5 h-5 mr-2"></i>
                            Catatan Penting
                        </h3>
                        <ul class="text-sm text-amber-700 space-y-1">
                            <li>• Harap datang 15 menit sebelum jadwal</li>
                            <li>• Bawa KTP dan bukti pembayaran</li>
                            <li>• Sisa pembayaran Rp 77.500 dilunasi saat kunjungan</li>
                            <li>• Pembatalan maksimal H-1 untuk refund penuh</li>
                        </ul>
                    </div>
                </div>
            </div>

            {{-- Email Preview --}}
            <div class="bg-white rounded-3xl shadow-xl shadow-slate-200/50 overflow-hidden mb-8">
                <div class="px-8 py-4 bg-slate-50 border-b border-slate-200">
                    <h2 class="font-semibold text-slate-800 flex items-center">
                        <i data-lucide="mail" class="w-5 h-5 mr-2 text-sky-500"></i>
                        Preview Email Konfirmasi
                    </h2>
                </div>

                <div class="p-8">
                    {{-- Email Header --}}
                    <div class="border border-slate-200 rounded-xl overflow-hidden">
                        {{-- Email Meta --}}
                        <div class="p-4 bg-slate-50 border-b border-slate-200 text-sm">
                            <div class="flex items-center justify-between mb-2">
                                <span class="text-slate-500">Dari:</span>
                                <span class="text-slate-800">Klinik Gigi Sehat &lt;noreply@klinikgigi.com&gt;</span>
                            </div>
                            <div class="flex items-center justify-between mb-2">
                                <span class="text-slate-500">Kepada:</span>
                                <span class="text-slate-800">johndoe@email.com</span>
                            </div>
                            <div class="flex items-center justify-between">
                                <span class="text-slate-500">Subjek:</span>
                                <span class="text-slate-800 font-medium">Konfirmasi Janji Temu - KGS-2024121101</span>
                            </div>
                        </div>

                        {{-- Email Body --}}
                        <div class="p-6">
                            <div class="text-center mb-6">
                                <div class="inline-flex items-center space-x-2 mb-4">
                                    <div
                                        class="w-10 h-10 bg-gradient-to-br from-sky-400 to-emerald-500 rounded-xl flex items-center justify-center">
                                        <i data-lucide="heart-pulse" class="w-6 h-6 text-white"></i>
                                    </div>
                                    <span class="text-xl font-bold text-slate-800">Klinik Gigi Sehat</span>
                                </div>
                                <h3 class="text-xl font-bold text-emerald-600">Janji Temu Anda Telah Dikonfirmasi!</h3>
                            </div>

                            <p class="text-slate-600 mb-4">Halo <strong>John Doe</strong>,</p>
                            <p class="text-slate-600 mb-4">Terima kasih telah membuat janji temu di Klinik Gigi Sehat.
                                Berikut adalah detail kunjungan Anda:</p>

                            <div class="bg-slate-50 p-4 rounded-xl mb-4">
                                <table class="w-full text-sm">
                                    <tr>
                                        <td class="py-1 text-slate-500">Nomor Booking</td>
                                        <td class="py-1 text-slate-800 font-medium text-right">KGS-2024121101</td>
                                    </tr>
                                    <tr>
                                        <td class="py-1 text-slate-500">Dokter</td>
                                        <td class="py-1 text-slate-800 font-medium text-right">Dr. Andi Pratama, Sp.KG</td>
                                    </tr>
                                    <tr>
                                        <td class="py-1 text-slate-500">Tanggal & Waktu</td>
                                        <td class="py-1 text-slate-800 font-medium text-right">11 Des 2024, 09:00 WIB</td>
                                    </tr>
                                    <tr>
                                        <td class="py-1 text-slate-500">Layanan</td>
                                        <td class="py-1 text-slate-800 font-medium text-right">Pemeriksaan Gigi</td>
                                    </tr>
                                </table>
                            </div>

                            <p class="text-slate-600 mb-4">Jika ada pertanyaan, silakan hubungi kami di (021) 1234-5678 atau
                                balas email ini.</p>

                            <p class="text-slate-600">
                                Salam hangat,<br>
                                <strong>Tim Klinik Gigi Sehat</strong>
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Action Buttons --}}
            <div class="flex flex-col sm:flex-row items-center justify-center gap-4">
                <button
                    class="inline-flex items-center px-6 py-3 bg-white text-slate-700 font-semibold rounded-xl shadow-lg border border-slate-200 hover:border-slate-300 transition">
                    <i data-lucide="download" class="w-5 h-5 mr-2"></i>
                    Download PDF
                </button>
                <button
                    class="inline-flex items-center px-6 py-3 bg-white text-slate-700 font-semibold rounded-xl shadow-lg border border-slate-200 hover:border-slate-300 transition">
                    <i data-lucide="calendar-plus" class="w-5 h-5 mr-2"></i>
                    Tambah ke Kalender
                </button>
                <a href="{{ url('/') }}"
                    class="inline-flex items-center px-8 py-3 bg-gradient-to-r from-sky-500 to-emerald-500 text-white font-semibold rounded-xl shadow-lg shadow-sky-500/30 hover:shadow-sky-500/50 transition">
                    <i data-lucide="home" class="w-5 h-5 mr-2"></i>
                    Kembali ke Beranda
                </a>
            </div>
        </div>
    </section>

@endsection