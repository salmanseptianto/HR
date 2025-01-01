<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    @vite('resources/css/app.css')
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="icon" href="{{ asset('foto/logo.png') }}" type="image/x-icon">
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@2.8.2/dist/alpine.min.js" defer></script>

</head>

<body class="flex min-h-screen bg-gray-100">
    <!-- Sidebar -->
    <div id="sidebar"
        class="w-64 bg-primary text-white p-6 space-y-6 fixed inset-y-0 left-0 transform -translate-x-full transition-transform duration-300 lg:translate-x-0 lg:relative">
        <div class="flex items-center justify-center p-4 text-center text-2xl font-bold">
            <img src="{{ asset('foto/logo.png') }}" alt="Logo" class="w-10 h-10 mr-2" />
            HR GROUP
        </div>
        <nav>
            <ul class="space-y-4">
                <li>
                    <a href="{{ url('manager-hrd') }}" class="block py-2 px-4 rounded hover:bg-secondary">Home</a>
                </li>
                <!-- Dropdown for Report Marketing -->
                <li>
                    <a href="{{ url('manager-hrd/kpi') }}" class="block py-2 px-4 rounded hover:bg-secondary">KPI</a>
                </li>
                <li>
                    <a href="{{ url('manager-hrd/print') }}"
                        class="block py-2 px-4 rounded hover:bg-secondary">Print</a>
                </li>
                <li>
                    <a href="{{ url('manager-hrd/add-user') }}"
                        class="block py-2 px-4 rounded hover:bg-secondary">Tambah Bawahan</a>
                </li>
            </ul>
        </nav>
    </div>

    <!-- Main Content -->
    <div class="flex-1 flex flex-col">

        <!-- Header -->
        <header class="bg-white shadow-md p-4 flex justify-between items-center">
            <button id="sidebarToggle" class="lg:hidden bg-primary text-white p-2 rounded focus:outline-none">
                ☰
            </button>
            <h2 class="text-2xl font-semibold">Dashboard Manager HRD</h2>
            <div x-data="{ open: false }" class="relative">
                <!-- Profile icon or user name -->
                <button @click="open = !open"
                    class="flex items-center space-x-2 p-2 rounded hover:bg-gray-100 focus:outline-none">
                    <span class="text-lg">Menu</span>
                    <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"
                        aria-hidden="true">
                        <path fill-rule="evenodd"
                            d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                            clip-rule="evenodd" />
                    </svg>
                </button>

                <!-- Dropdown Menu -->
                <div x-show="open" x-transition
                    class="absolute right-0 mt-2 w-32 bg-white border rounded-lg shadow-lg z-10">
                    <div class="py-2">
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button type="submit"
                                class="block w-full px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Profile</button>
                        </form>
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button type="submit"
                                class="block w-full px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Logout</button>
                        </form>
                    </div>
                </div>

            </div>
        </header>

        <!-- Main Content Area -->
        <main class="p-6">
            @yield('page-mh')
        </main>
        <footer class="mt-6 bg-white p-4 rounded-lg shadow-lg">
            <p class="text-gray-500 text-center">© 2024 HR Group. All rights reserved.</p>
        </footer>
    </div>

    <!-- JavaScript for Dropdowns and Sidebar -->
    <script>
        // Sidebar toggle for mobile
        const sidebar = document.getElementById("sidebar");
        const sidebarToggle = document.getElementById("sidebarToggle");

        sidebarToggle.addEventListener("click", function() {
            sidebar.classList.toggle("-translate-x-full");
        });

        // Dropdown toggle for Report Marketing
        const reportMarketingBtn = document.getElementById("reportMarketingBtn");
        const reportMarketinmhenu = document.getElementById("reportMarketinmhenu");

        reportMarketingBtn.addEventListener("click", function() {
            reportMarketinmhenu.classList.toggle("hidden");
        });

        // Sub-dropdown toggle for Report Harian
        const reportHarianBtn = document.getElementById("reportHarianBtn");
        const reportHarianMenu = document.getElementById("reportHarianMenu");

        reportHarianBtn.addEventListener("click", function() {
            reportHarianMenu.classList.toggle("hidden");
        });

        // Sub-dropdown toggle for Report Mingguan
        const reportMingguanBtn = document.getElementById("reportMingguanBtn");
        const reportMingguanMenu = document.getElementById("reportMingguanMenu");

        reportMingguanBtn.addEventListener("click", function() {
            reportMingguanMenu.classList.toggle("hidden");
        });

        // Dropdown toggle for Report Manager
        const reportManagerBtn = document.getElementById("reportManagerBtn");
        const reportManagerMenu = document.getElementById("reportManagerMenu");

        reportManagerBtn.addEventListener("click", function() {
            reportManagerMenu.classList.toggle("hidden");
        });
    </script>

</body>

</html>
