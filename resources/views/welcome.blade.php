<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>WMS - Warehouse Management System</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700,800&display=swap" rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased text-slate-800 bg-white selection:bg-indigo-500 selection:text-white">

    <!-- Navigation -->
    <nav class="fixed w-full z-50 bg-white/90 backdrop-blur-md border-b border-slate-100 transition-all duration-300"
        x-data="{ scrolled: false }" @scroll.window="scrolled = (window.pageYOffset > 20)">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-20">
                <!-- Logo -->
                <div class="flex-shrink-0 flex items-center gap-3">
                    <div class="w-14 h-14 bg-white rounded-xl overflow-hidden flex items-center justify-center border border-slate-100 shadow-sm transition-transform duration-300 hover:scale-105">
                        <img src="{{ asset('img/logo.png') }}" alt="Logo" class="max-h-full max-w-full object-contain p-1">
                    </div>
                    <div>
                        <span class="block text-xl font-bold text-slate-900 leading-none">PT Rekayasa </span>
                        <span class="block text-xs text-indigo-600 font-semibold tracking-wider uppercase">Manufaktur 
                            dan Jasa</span>
                    </div>
                </div>

                <!-- Desktop Menu -->
                <div class="hidden md:flex items-center space-x-8">
                    <a href="#features"
                        class="text-sm font-medium text-slate-600 hover:text-indigo-600 transition-colors">Features</a>
                    <a href="#about"
                        class="text-sm font-medium text-slate-600 hover:text-indigo-600 transition-colors">About</a>
                    <a href="#contact"
                        class="text-sm font-medium text-slate-600 hover:text-indigo-600 transition-colors">Contact</a>

                    @if (Route::has('login'))
                        <div class="flex items-center gap-4 ml-6 pl-6 border-l border-slate-200">
                            @auth
                                <a href="{{ url('/dashboard') }}"
                                    class="text-sm font-semibold text-slate-900 hover:text-indigo-600">Dashboard</a>
                            @else
                                <a href="{{ route('login') }}"
                                    class="text-sm font-semibold text-slate-900 hover:text-indigo-600">Log in</a>
                                <!-- Remove Register if not needed publicly -->
                                <!-- <a href="{{ route('register') }}" class="px-5 py-2.5 text-sm font-semibold text-white bg-indigo-600 rounded-full hover:bg-indigo-700 transition-all shadow-lg shadow-indigo-200">Get Started</a> -->
                            @endauth
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="relative pt-32 pb-20 lg:pt-48 lg:pb-32 overflow-hidden">
        <div class="absolute inset-0 -z-10">
            <div class="absolute inset-0 bg-gradient-to-br from-indigo-50 via-white to-slate-50"></div>
            <!-- Decorative blobs -->
            <div
                class="absolute top-0 right-0 -translate-y-12 translate-x-12 w-96 h-96 bg-indigo-100 rounded-full blur-3xl opacity-50">
            </div>
            <div
                class="absolute bottom-0 left-0 translate-y-12 -translate-x-12 w-96 h-96 bg-blue-100 rounded-full blur-3xl opacity-50">
            </div>
        </div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h1 class="text-5xl md:text-6xl lg:text-7xl font-extrabold text-slate-900 tracking-tight mb-8">
                Warehouse Management System 
            </h1>
            <p class="mt-6 max-w-2xl mx-auto text-xl text-slate-600 leading-relaxed">
                Selamat datang di portal logistik internal. Platform terpusat untuk pengelolaan material produksi, 
                stok suku cadang, dan distribusi unit mesin espresso secara real time dan akurat.
            </p>
            <div class="mt-10 flex flex-col sm:flex-row gap-4 justify-center">
                <a href="{{ route('login') }}"
                    class="inline-flex items-center justify-center px-8 py-4 text-base font-bold text-white bg-indigo-600 rounded-full hover:bg-indigo-700 transition-all shadow-xl shadow-indigo-200 hover:shadow-2xl hover:-translate-y-1">
                    Access Portal
                    <svg class="ml-2 -mr-1 w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M13 7l5 5m0 0l-5 5m5-5H6" />
                    </svg>
                </a>
                <a href="#features"
                    class="inline-flex items-center justify-center px-8 py-4 text-base font-bold text-slate-700 bg-white border border-slate-200 rounded-full hover:bg-slate-50 hover:border-slate-300 transition-all shadow-sm">
                    Learn More
                </a>
            </div>

            <!-- Hero Stats -->
            <div class="mt-20 grid grid-cols-2 lg:grid-cols-4 gap-8 max-w-4xl mx-auto">
                <div class="p-6 bg-white rounded-2xl shadow-sm border border-slate-100">
                    <div class="text-3xl font-bold text-indigo-600 mb-1">99.9%</div>
                    <div class="text-sm font-medium text-slate-500 uppercase tracking-wide">Uptime</div>
                </div>
                <div class="p-6 bg-white rounded-2xl shadow-sm border border-slate-100">
                    <div class="text-3xl font-bold text-indigo-600 mb-1">24/7</div>
                    <div class="text-sm font-medium text-slate-500 uppercase tracking-wide">Monitoring</div>
                </div>
                <div class="p-6 bg-white rounded-2xl shadow-sm border border-slate-100">
                    <div class="text-3xl font-bold text-indigo-600 mb-1">10k+</div>
                    <div class="text-sm font-medium text-slate-500 uppercase tracking-wide">SKUs Managed</div>
                </div>
                <div class="p-6 bg-white rounded-2xl shadow-sm border border-slate-100">
                    <div class="text-3xl font-bold text-indigo-600 mb-1">Zero</div>
                    <div class="text-sm font-medium text-slate-500 uppercase tracking-wide">Data Loss</div>
                </div>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section id="features" class="py-24 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-sm font-bold text-indigo-600 uppercase tracking-widest mb-2">Key Capabilities</h2>
                <h3 class="text-3xl md:text-4xl font-bold text-slate-900">Why choose PT Rekayasa Manufaktur dan Jasa</h3>
            </div>

            <div class="grid md:grid-cols-3 gap-12">
                <!-- Feature 1 -->
                <div
                    class="group p-8 rounded-3xl bg-slate-50 hover:bg-white border border-transparent hover:border-slate-100 hover:shadow-xl transition-all duration-300">
                    <div
                        class="w-14 h-14 bg-indigo-100 text-indigo-600 rounded-2xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform">
                        <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01" />
                        </svg>
                    </div>
                    <h4 class="text-xl font-bold text-slate-900 mb-3">Real-time Inventory</h4>
                    <p class="text-slate-600 leading-relaxed">
                        Monitoring ketersediaan bahan baku logam dan komponen mesin espresso. Notifikasi otomatis untuk stok limit (Safety Stock).
                    </p>
                </div>

                <!-- Feature 2 -->
                <div
                    class="group p-8 rounded-3xl bg-slate-50 hover:bg-white border border-transparent hover:border-slate-100 hover:shadow-xl transition-all duration-300">
                    <div
                        class="w-14 h-14 bg-blue-100 text-blue-600 rounded-2xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform">
                        <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4" />
                        </svg>
                    </div>
                    <h4 class="text-xl font-bold text-slate-900 mb-3">Inbound & Outbound</h4>
                    <p class="text-slate-600 leading-relaxed">
                        Pencatatan barang masuk dari supplier dan penjadwalan pengiriman unit mesin jadi ke klien atau distributor.
                    </p>
                </div>

                <!-- Feature 3 -->
                <div
                    class="group p-8 rounded-3xl bg-slate-50 hover:bg-white border border-transparent hover:border-slate-100 hover:shadow-xl transition-all duration-300">
                    <div
                        class="w-14 h-14 bg-emerald-100 text-emerald-600 rounded-2xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform">
                        <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 002 2h2a2 2 0 002-2z" />
                        </svg>
                    </div>
                    <h4 class="text-xl font-bold text-slate-900 mb-3">Smart Analytics</h4>
                    <p class="text-slate-600 leading-relaxed">
                        Rekapitulasi pergerakan barang dan laporan stok opname (harian, mingguan, bulanan, dan tahunan) yang dapat diunduh.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- About Company Section -->
    <section id="about" class="py-24 bg-slate-900 text-white relative overflow-hidden">
        <!-- Background elements -->
        <div class="absolute top-0 right-0 opacity-10">
            <svg width="400" height="400" fill="none" viewBox="0 0 24 24">
                <path stroke="currentColor" stroke-width="0.5"
                    d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
            </svg>
        </div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="grid lg:grid-cols-2 gap-16 items-center">
                <div>
                    <h2 class="text-sm font-bold text-indigo-400 uppercase tracking-widest mb-2">About Us</h2>
                    <h3 class="text-3xl md:text-4xl font-bold mb-6">PT REMAJA :  <br>Warehouse 
                        Management System.
                    </h3>
                    <p class="text-slate-300 text-lg leading-relaxed mb-6">
                        Sistem ini dibangun untuk mendukung penuh lini produksi PT REMAJA. 
                        Kami percaya bahwa mesin espresso terbaik lahir dari manajemen material yang rapi, 
                        akurat, dan efisien—mulai dari penerimaan bahan baku logam hingga perakitan akhir.

                    </p>
                    <p class="text-slate-300 text-lg leading-relaxed mb-8">
                        Dengan pelacakan real-time, kita meminimalisir kesalahan stok komponen vital 
                        (seperti boiler, pompa, dan group head).

                    </p>

                    <div class="flex gap-8">
                        <div>
                            <div class="text-4xl font-bold text-white mb-1">5+</div>
                            <div class="text-sm text-slate-400 uppercase tracking-wider">Years Experience</div>
                        </div>
                        <div>
                            <div class="text-4xl font-bold text-white mb-1">2M+</div>
                            <div class="text-sm text-slate-400 uppercase tracking-wider">Items Processed</div>
                        </div>
                    </div>
                </div>
                <div class="relative">
                    <div
                        class="absolute inset-0 bg-gradient-to-tr from-indigo-600 to-blue-600 rounded-3xl rotate-3 opacity-50">
                    </div>
                    <img src="https://images.unsplash.com/photo-1586528116311-ad8dd3c8310d?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80"
                        alt="Warehouse Internal" class="relative rounded-3xl shadow-2xl border-4 border-slate-800">
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer id="contact" class="bg-white border-t border-slate-100 pt-16 pb-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid md:grid-cols-4 gap-12 mb-12">
                <div class="col-span-1 md:col-span-2">
                    <div class="flex items-center gap-3 mb-6">
                        <div class="w-10 h-10 bg-white rounded-lg flex items-center justify-center overflow-hidden border border-slate-200 shadow-sm">
                            <img src="{{ asset('img/logo.png') }}" alt="Logo" class="max-h-full max-w-full object-contain p-0.5">
                        </div>
                        <span class="text-lg font-bold text-slate-900 leading-tight uppercase tracking-tight">PT Rekayasa  <br> <span class="text-xs text-indigo-600">Manufaktur dan Jasa</span></span>
                    </div>
                </div>

                <div>
                    <h4 class="font-bold text-slate-900 mb-4">Quick Links</h4>
                    <ul class="space-y-3 text-sm text-slate-600">
                        <li><a href="#" class="hover:text-indigo-600 transition-colors">Home</a></li>
                        <li><a href="#features" class="hover:text-indigo-600 transition-colors">Features</a></li>
                        <li><a href="#about" class="hover:text-indigo-600 transition-colors">About Company</a></li>
                        <li><a href="{{ route('login') }}" class="hover:text-indigo-600 transition-colors">Login
                                Portal</a></li>
                    </ul>
                </div>

                <div>
                    <h4 class="font-bold text-slate-900 mb-4">Contact Us</h4>
                    <ul class="space-y-3 text-sm text-slate-600">
                        <li class="flex items-start gap-3">
                            <svg class="w-5 h-5 text-indigo-600 mt-0.5" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                            <span>123 Logistics Way, Industrial Park,<br>Jakarta, Indonesia 12000</span>
                        </li>
                        <li class="flex items-center gap-3">
                            <svg class="w-5 h-5 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                            </svg>
                            <a href="mailto:info@wms-pro.com" class="hover:text-indigo-600">info@wms-pro.com</a>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="border-t border-slate-100 pt-8 text-center text-sm text-slate-400">
                <p>&copy; {{ date('Y') }} PT Rekayasa Manufaktur dan Jasa. All rights reserved.</p>
            </div>
        </div>
    </footer>
</body>

</html>