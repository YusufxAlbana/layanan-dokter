{{--
Footer Component
----------------
Komponen footer lengkap untuk halaman publik.

TODO Backend:
- Tambahkan dynamic content untuk info klinik
- Tambahkan newsletter subscription functionality
--}}

<footer id="kontak" class="bg-gradient-to-b from-slate-900 to-slate-950 text-white">
    {{-- Main Footer --}}
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-12">

            {{-- Brand Info --}}
            <div class="lg:col-span-1">
                <a href="{{ url('/') }}" class="flex items-center space-x-3 mb-6">
                    <img src="{{ asset('logo.png') }}" alt="Klinik Gigi Sehat" class="w-12 h-12 object-contain">
                    <div>
                        <span class="block text-xl font-bold">Klinik Gigi</span>
                        <span class="block text-xs text-slate-400">Sehat & Profesional</span>
                    </div>
                </a>
                <p class="text-slate-400 text-sm leading-relaxed mb-6">
                    Memberikan pelayanan kesehatan gigi terbaik dengan teknologi modern dan tenaga medis profesional.
                    Kesehatan gigi Anda adalah prioritas kami.
                </p>
                <div class="flex space-x-3">
                    <a href="#"
                        class="w-10 h-10 bg-slate-800 hover:bg-sky-500 rounded-xl flex items-center justify-center transition-colors">
                        <i data-lucide="facebook" class="w-5 h-5"></i>
                    </a>
                    <a href="#"
                        class="w-10 h-10 bg-slate-800 hover:bg-pink-500 rounded-xl flex items-center justify-center transition-colors">
                        <i data-lucide="instagram" class="w-5 h-5"></i>
                    </a>
                    <a href="#"
                        class="w-10 h-10 bg-slate-800 hover:bg-sky-400 rounded-xl flex items-center justify-center transition-colors">
                        <i data-lucide="twitter" class="w-5 h-5"></i>
                    </a>
                    <a href="#"
                        class="w-10 h-10 bg-slate-800 hover:bg-green-500 rounded-xl flex items-center justify-center transition-colors">
                        <i data-lucide="message-circle" class="w-5 h-5"></i>
                    </a>
                </div>
            </div>

            {{-- Quick Links --}}
            <div>
                <h4 class="text-lg font-semibold mb-6">Link Cepat</h4>
                <ul class="space-y-3">
                    <li>
                        <a href="{{ url('/') }}"
                            class="text-slate-400 hover:text-white flex items-center group transition">
                            <i data-lucide="chevron-right"
                                class="w-4 h-4 mr-2 group-hover:translate-x-1 transition-transform"></i>
                            Beranda
                        </a>
                    </li>
                    <li>
                        <a href="{{ url('/doctors') }}"
                            class="text-slate-400 hover:text-white flex items-center group transition">
                            <i data-lucide="chevron-right"
                                class="w-4 h-4 mr-2 group-hover:translate-x-1 transition-transform"></i>
                            Dokter Kami
                        </a>
                    </li>
                    <li>
                        <a href="{{ url('/patients/register') }}"
                            class="text-slate-400 hover:text-white flex items-center group transition">
                            <i data-lucide="chevron-right"
                                class="w-4 h-4 mr-2 group-hover:translate-x-1 transition-transform"></i>
                            Buat Janji
                        </a>
                    </li>
                    <li>
                        <a href="#" class="text-slate-400 hover:text-white flex items-center group transition">
                            <i data-lucide="chevron-right"
                                class="w-4 h-4 mr-2 group-hover:translate-x-1 transition-transform"></i>
                            Tentang Kami
                        </a>
                    </li>
                    <li>
                        <a href="#" class="text-slate-400 hover:text-white flex items-center group transition">
                            <i data-lucide="chevron-right"
                                class="w-4 h-4 mr-2 group-hover:translate-x-1 transition-transform"></i>
                            Kebijakan Privasi
                        </a>
                    </li>
                </ul>
            </div>

            {{-- Services --}}
            <div>
                <h4 class="text-lg font-semibold mb-6">Layanan Kami</h4>
                <ul class="space-y-3">
                    <li>
                        <a href="#" class="text-slate-400 hover:text-white flex items-center group transition">
                            <i data-lucide="chevron-right"
                                class="w-4 h-4 mr-2 group-hover:translate-x-1 transition-transform"></i>
                            Pemeriksaan Gigi
                        </a>
                    </li>
                    <li>
                        <a href="#" class="text-slate-400 hover:text-white flex items-center group transition">
                            <i data-lucide="chevron-right"
                                class="w-4 h-4 mr-2 group-hover:translate-x-1 transition-transform"></i>
                            Pembersihan Karang
                        </a>
                    </li>
                    <li>
                        <a href="#" class="text-slate-400 hover:text-white flex items-center group transition">
                            <i data-lucide="chevron-right"
                                class="w-4 h-4 mr-2 group-hover:translate-x-1 transition-transform"></i>
                            Pemasangan Kawat Gigi
                        </a>
                    </li>
                    <li>
                        <a href="#" class="text-slate-400 hover:text-white flex items-center group transition">
                            <i data-lucide="chevron-right"
                                class="w-4 h-4 mr-2 group-hover:translate-x-1 transition-transform"></i>
                            Bleaching Gigi
                        </a>
                    </li>
                    <li>
                        <a href="#" class="text-slate-400 hover:text-white flex items-center group transition">
                            <i data-lucide="chevron-right"
                                class="w-4 h-4 mr-2 group-hover:translate-x-1 transition-transform"></i>
                            Cabut Gigi
                        </a>
                    </li>
                </ul>
            </div>

            {{-- Contact Info --}}
            <div>
                <h4 class="text-lg font-semibold mb-6">Hubungi Kami</h4>
                <ul class="space-y-4">
                    <li class="flex items-start space-x-3">
                        <div class="w-10 h-10 bg-slate-800 rounded-xl flex items-center justify-center flex-shrink-0">
                            <i data-lucide="map-pin" class="w-5 h-5 text-sky-400"></i>
                        </div>
                        <div>
                            <p class="text-white font-medium">Alamat</p>
                            <p class="text-slate-400 text-sm">Jl. Kesehatan No. 123, Jakarta Selatan 12345</p>
                        </div>
                    </li>
                    <li class="flex items-start space-x-3">
                        <div class="w-10 h-10 bg-slate-800 rounded-xl flex items-center justify-center flex-shrink-0">
                            <i data-lucide="phone" class="w-5 h-5 text-emerald-400"></i>
                        </div>
                        <div>
                            <p class="text-white font-medium">Telepon</p>
                            <p class="text-slate-400 text-sm">(021) 1234-5678</p>
                        </div>
                    </li>
                    <li class="flex items-start space-x-3">
                        <div class="w-10 h-10 bg-slate-800 rounded-xl flex items-center justify-center flex-shrink-0">
                            <i data-lucide="mail" class="w-5 h-5 text-amber-400"></i>
                        </div>
                        <div>
                            <p class="text-white font-medium">Email</p>
                            <p class="text-slate-400 text-sm">info@klinikgigi.com</p>
                        </div>
                    </li>
                    <li class="flex items-start space-x-3">
                        <div class="w-10 h-10 bg-slate-800 rounded-xl flex items-center justify-center flex-shrink-0">
                            <i data-lucide="clock" class="w-5 h-5 text-purple-400"></i>
                        </div>
                        <div>
                            <p class="text-white font-medium">Jam Operasional</p>
                            <p class="text-slate-400 text-sm">Senin - Sabtu: 08:00 - 20:00</p>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>

    {{-- Bottom Footer --}}
    <div class="border-t border-slate-800">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
            <div class="flex flex-col md:flex-row items-center justify-between space-y-4 md:space-y-0">
                <p class="text-slate-400 text-sm text-center md:text-left">
                    © {{ date('Y') }} Klinik Gigi Sehat. Hak Cipta Dilindungi.
                </p>
                <div class="flex items-center space-x-6">
                    <a href="#" class="text-slate-400 hover:text-white text-sm transition">Syarat & Ketentuan</a>
                    <a href="#" class="text-slate-400 hover:text-white text-sm transition">Kebijakan Privasi</a>
                </div>
            </div>
        </div>
    </div>
</footer>