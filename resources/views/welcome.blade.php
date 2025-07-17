<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>WWII</title>

    <link rel="icon" href="/favicon.ico" sizes="any">
    <link rel="icon" href="/favicon.svg" type="image/svg+xml">
    <link rel="apple-touch-icon" href="/apple-touch-icon.png">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />

    <!-- Styles -->
    <style>
        html, body {
            max-width: 100vw;
            overflow-x: hidden;
        }
        body {
            font-family: 'Instrument Sans', sans-serif;
            background-image: url('https://i.ibb.co/0jKmKB0R/premium-photo-1661901234139-d833950e05e0.jpg');
            background-size: cover;
            background-position: center center;
            background-repeat: no-repeat;
            background-attachment: fixed;
            color: #fff !important;
            transition: background 0.3s, color 0.3s;
            margin: 0;
            padding: 0;
            min-height: 100vh;
        }

        a {
            transition: color 0.2s, border-color 0.2s, background 0.2s, box-shadow 0.2s, transform 0.2s;
            text-decoration: none;
        }
        .rounded-2xl, .rounded-3xl, .rounded-full, .rounded-sm { border-radius: 1rem !important; }
        .shadow-2xl { box-shadow: 0 10px 40px 0 rgba(0,0,0,0.6); }
        .backdrop-blur-sm { backdrop-filter: blur(4px); }
        .transition-all, .transition-colors, .transition-opacity { transition: all 0.3s; }
        .hover\:scale-105:hover { transform: scale(1.05); }
        .hover\:shadow-2xl:hover { box-shadow: 0 10px 40px 0 rgba(0,0,0,0.8); }

        /* WWII Arsenal Title Styles */
        .arsenal-title {
            color: #000000 !important;
            font-family: 'Times New Roman', Times, serif !important;
            font-size: 12rem !important;
            font-weight: bold;
            text-shadow: 2px 2px 4px rgba(255,255,255,0.3);
            margin-bottom: 3rem;
            line-height: 1.2;
        }

        @media (max-width: 768px) {
            .arsenal-title {
                font-size: 8rem !important;
            }
        }

        @media (max-width: 480px) {
            .arsenal-title {
                font-size: 6rem !important;
            }
        }

        /* Fix England flag background */
        .england-flag {
            background: url('https://upload.wikimedia.org/wikipedia/en/a/ae/Flag_of_the_United_Kingdom.svg') !important;
            background-size: cover !important;
            background-position: center !important;
            background-repeat: no-repeat !important;
        }
        .group:hover .group-hover\:text-white { color: #fff !important; }
        .group:hover .group-hover\:opacity-10 { opacity: 0.1 !important; }
        .starting\:opacity-0 { opacity: 0; }
        .opacity-100 { opacity: 1; }
        .duration-750 { transition-duration: 750ms; }
        .bg-black { background-color: #000000; }
        .text-white { color: #ffffff; }
        .text-gray-300 { color: #d1d5db; }
        .text-gray-400 { color: #9ca3af; }
        .text-blue-200 { color: #bfdbfe; }
        .text-red-200 { color: #fecaca; }
        .text-yellow-100 { color: #fef3c7; }
        .text-green-400 { color: #4ade80; }
        .text-blue-400 { color: #60a5fa; }
        .text-purple-400 { color: #c084fc; }
        .text-orange-400 { color: #fb923c; }
        .border-gray-600 { border-color: #4b5563; }
        .border-gray-700 { border-color: #374151; }
        .border-blue-600 { border-color: #2563eb; }
        .border-red-600 { border-color: #dc2626; }
        .border-yellow-500 { border-color: #eab308; }
        .bg-gradient-to-r { background-image: linear-gradient(to right, var(--tw-gradient-stops)); }
        .bg-gradient-to-br { background-image: linear-gradient(to bottom right, var(--tw-gradient-stops)); }
        .from-gray-800 { --tw-gradient-from: #1f2937; --tw-gradient-to: rgba(31, 41, 55, 0); --tw-gradient-stops: var(--tw-gradient-from), var(--tw-gradient-to); }
        .via-gray-700 { --tw-gradient-to: rgba(55, 65, 81, 0); --tw-gradient-stops: var(--tw-gradient-from), #374151, var(--tw-gradient-to); }
        .to-gray-800 { --tw-gradient-to: #1f2937; }
        /* Main theme color */
        .theme-color { background: #1e3a8a; }
        .theme-border { border-color: #1e3a8a; }
        .theme-text { color: #fff; }

        /* Nation flag backgrounds */
        .england-flag {
            background: url('https://upload.wikimedia.org/wikipedia/commons/a/ae/Flag_of_the_United_Kingdom.svg');
            background-size: cover;
            background-position: center;
        }
        .soviet-flag {
            background: url('https://upload.wikimedia.org/wikipedia/commons/a/a9/Flag_of_the_Soviet_Union.svg');
            background-size: cover;
            background-position: center;
        }
        .germany-flag {
            background: url('https://upload.wikimedia.org/wikipedia/commons/7/77/Flag_of_Germany_%281935%E2%80%931945%29.svg');
            background-size: cover;
            background-position: center;
        }
        .switzerland-flag {
            background: url('https://upload.wikimedia.org/wikipedia/commons/f/f3/Flag_of_Switzerland.svg');
            background-size: cover;
            background-position: center;
        }

        @media (min-width: 1024px) {
            .lg\:p-8 { padding: 2rem !important; }
            .lg\:max-w-4xl { max-width: 56rem !important; }
            .lg\:grow { flex-grow: 1 !important; }
            .lg\:justify-center { justify-content: center !important; }
            .lg\:block { display: block !important; }
            .lg\:hidden { display: none !important; }
            .lg\:flex-col { flex-direction: column !important; }
            .lg\:grid-cols-4 { grid-template-columns: repeat(4, minmax(0, 1fr)) !important; }
        }
        @media (max-width: 1023px) {
            .max-w-\[335px\] { max-width: 335px !important; }
        }
        @media (min-width: 640px) {
            .sm\:grid-cols-2 { grid-template-columns: repeat(2, minmax(0, 1fr)) !important; }
        }
        @media (min-width: 768px) {
            .md\:grid-cols-4 { grid-template-columns: repeat(4, minmax(0, 1fr)) !important; }
        }
        .flex { display: flex; }
        .grid { display: grid; }
        .items-center { align-items: center; }
        .justify-center { justify-content: center; }
        .justify-end { justify-content: flex-end; }
        .text-center { text-align: center; }
        .w-full { width: 100%; }
        .w-16 { width: 4rem; }
        .h-16 { height: 4rem; }
        .h-1 { height: 0.25rem; }
        .min-h-screen { min-height: 100vh; }
        .max-w-4xl { max-width: 100vw; }
        .max-w-2xl { max-width: 100vw; }
        .mx-auto { margin-left: auto; margin-right: auto; }
        .mb-2 { margin-bottom: 0.5rem; }
        .mb-3 { margin-bottom: 0.75rem; }
        .mb-4 { margin-bottom: 1rem; }
        .mb-6 { margin-bottom: 1.5rem; }
        .mb-8 { margin-bottom: 2rem; }
        .mt-4 { margin-top: 1rem; }
        .mt-6 { margin-top: 1.5rem; }
        .mt-8 { margin-top: 2rem; }
        .p-6 { padding: 1.5rem; }
        .p-8 { padding: 2rem; }
        .pt-6 { padding-top: 1.5rem; }
        .px-5 { padding-left: 1.25rem; padding-right: 1.25rem; }
        .py-1\.5 { padding-top: 0.375rem; padding-bottom: 0.375rem; }
        .gap-4 { gap: 1rem; }
        .gap-6 { gap: 1.5rem; }
        .text-sm { font-size: 0.875rem; }
        .text-lg { font-size: 1.125rem; }
        .text-xl { font-size: 1.25rem; }
        .text-2xl { font-size: 1.5rem; }
        .text-3xl { font-size: 1.875rem; }
        .text-xs { font-size: 0.75rem; }
        .font-bold { font-weight: 700; }
        .font-medium { font-weight: 500; }
        .border { border-width: 1px; }
        .border-t { border-top-width: 1px; }
        .relative { position: relative; }
        .absolute { position: absolute; }
        .inset-0 { top: 0; right: 0; bottom: 0; left: 0; }
        .z-10 { z-index: 10; }
        .overflow-hidden { overflow: hidden; }
        .object-cover { object-fit: cover; }
        .opacity-0 { opacity: 0; }
        .opacity-10 { opacity: 0.1; }
        .flex-col { flex-direction: column; }
        .grid-cols-1 { grid-template-columns: repeat(1, minmax(0, 1fr)); }
        .grid-cols-2 { grid-template-columns: repeat(2, minmax(0, 1fr)); }
        .inline-block { display: inline-block; }
        .leading-normal { line-height: 1.5; }
        .duration-200 { transition-duration: 200ms; }
        .duration-300 { transition-duration: 300ms; }
        .transform { transform: translateX(0) translateY(0) rotate(0) skewX(0) skewY(0) scaleX(1) scaleY(1); }
        .border-transparent { border-color: transparent; }
        .hidden { display: none; }
        /* Make cards and nav responsive and prevent overflow */
        .nation-card {
            min-width: 0;
            max-width: 100%;
            box-sizing: border-box;
            padding: 1rem !important;
            height: 150px;
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
        }
        .nation-card h3 {
            font-size: 1.5rem;
            text-shadow: 0 0 10px rgba(0,0,0,0.8), 0 0 5px rgba(0,0,0,0.9);
            z-index: 5;
            font-weight: bold;
        }
        /* Make the nation table smaller */
        .nation-table-container {
            max-width: 700px;
            margin: 0 auto;
            padding: 0.5rem;
        }
        .nation-table-inner {
            padding: 1.2rem 0.5rem;
        }
        @media (max-width: 900px) {
            .p-8, .lg\:p-8 { padding: 0.5rem !important; }
            .mb-8 { margin-bottom: 0.5rem; }
            .nation-card { padding: 0.5rem !important; }
            .nation-table-container { max-width: 98vw; }
        }
        @media (max-width: 600px) {
            .grid { grid-template-columns: 1fr !important; }
            .gap-6 { gap: 0.5rem; }
            .p-6, .p-8 { padding: 0.5rem !important; }
            .nation-card { padding: 0.4rem !important; }
            .nation-table-container { max-width: 100vw; }
        }
        /* Login/Register button styles */
        .big-btn {
            font-size: 1.1rem !important;
            padding: 0.75rem 2.2rem !important;
            border-radius: 0.7rem !important;
            font-weight: 700 !important;
            border-width: 2px !important;
            box-shadow: 0 2px 16px 0 rgba(0,0,0,0.18);
            transition: background 0.2s, color 0.2s, border 0.2s;
            background: #1e3a8a;
            color: #fff !important;
            border-color: #1e3a8a !important;
        }
        .big-btn:hover {
            background: #fff;
            color: #1e3a8a !important;
            border-color: #1e3a8a !important;
        }
        .arsenal-title {
            color: #fff;
            text-shadow: 0 0 15px rgba(30, 58, 138, 0.7);
            margin-bottom: 1.5rem;
            background: linear-gradient(to right, #1e3a8a, #3b82f6, #1e3a8a);
            -webkit-background-clip: text;
            background-clip: text;
            -webkit-text-fill-color: transparent;
            font-size: 2.5rem;
            font-weight: bold;
        }
        .card-overlay {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0,0,0,0.3);
            z-index: 1;
        }
    </style>
</head>
<body class="bg-[#FDFDFC] dark:bg-[#0a0a0a] text-[#1b1b18] flex p-6 lg:p-8 items-center lg:justify-center min-h-screen flex-col" style="box-sizing:border-box;">
<header class="w-full max-w-4xl mx-auto text-sm mb-6 not-has-[nav]:hidden" style="box-sizing:border-box;">
    @if (Route::has('login'))
        <nav class="flex items-center justify-end gap-4">
            @auth
                <a
                    href="{{ route('weapons.index') }}"
                    class="big-btn"
                >
                    Marketplace
                </a>
            @else
                <a
                    href="{{ route('login') }}"
                    class="big-btn"
                >
                    Log in
                </a>
                @if (Route::has('register'))
                    <a
                        href="{{ route('register') }}"
                        class="big-btn">
                        Register
                    </a>
                @endif
            @endauth
        </nav>
    @endif
</header>
<div class="flex items-center justify-center w-full transition-opacity opacity-100 duration-750 lg:grow starting:opacity-0">
    <!-- Main content area -->
</div>

<!-- WWII Arsenal Title -->
<div class="text-center mb-6">
    <h1 class="arsenal-title">WWII Arsenal</h1>
    <div class="w-24 h-1 bg-gradient-to-r from-blue-500 to-blue-700 mx-auto rounded-full"></div>
</div>

<nav class="nation-table-container" style="box-sizing:border-box;">
    <div class="nation-table-inner theme-color rounded-3xl shadow-2xl border theme-border backdrop-blur-sm" style="box-sizing:border-box;">
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6" style="width:100%;box-sizing:border-box;">
            <!-- England -->
            <a href="{{ route('England') }}" class="nation-card england-flag rounded-2xl transition-all duration-300 transform hover:scale-105 hover:shadow-2xl border border-white/30">
                <div class="card-overlay rounded-2xl"></div>
                <h3 class="text-white">England</h3>
            </a>
            <!-- Soviet Union -->
            <a href="{{ route('Soviet_Union') }}" class="nation-card soviet-flag rounded-2xl transition-all duration-300 transform hover:scale-105 hover:shadow-2xl border border-white/30">
                <div class="card-overlay rounded-2xl"></div>
                <h3 class="text-white">Soviet Union</h3>
            </a>
            <!-- Germany -->
            <a href="{{ route('Germany') }}" class="nation-card germany-flag rounded-2xl transition-all duration-300 transform hover:scale-105 hover:shadow-2xl border border-white/30">
                <div class="card-overlay rounded-2xl"></div>
                <h3 class="text-white">Germany</h3>
            </a>
            <!-- Switzerland -->
            <a href="{{ route('Switzerland') }}" class="nation-card switzerland-flag rounded-2xl transition-all duration-300 transform hover:scale-105 hover:shadow-2xl border border-white/30">
                <div class="card-overlay rounded-2xl"></div>
                <h3 class="text-white">Switzerland</h3>
            </a>
        </div>
        <!-- Historical Note -->
        <div class="mt-8 pt-6 border-t border-gray-600/50">
            <div class="text-center">
                <p class="text-gray-400 text-sm max-w-2xl mx-auto" style="max-width:100vw;">
                    🏛 <strong>Historical Note:</strong> Each nation represents authentic WWII-era military equipment and specifications.
                    Explore historically accurate arsenals from one of history's most significant conflicts.
                </p>
            </div>
            <!-- Quick Stats -->
            <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mt-6">
                <div class="text-center">
                    <div class="text-2xl font-bold text-white">1939-1945</div>
                    <div class="text-xs text-gray-400">War Period</div>
                </div>
                <div class="text-center">
                    <div class="text-2xl font-bold text-white">4</div>
                    <div class="text-xs text-gray-400">Nations</div>
                </div>
                <div class="text-center">
                    <div class="text-2xl font-bold text-white">100+</div>
                    <div class="text-xs text-gray-400">Weapons</div>
                </div>
                <div class="text-center">
                    <div class="text-2xl font-bold text-white">⚡</div>
                    <div class="text-xs text-gray-400">Authentic</div>
                </div>
            </div>
        </div>
    </div>
</nav>
</body>
</html>
