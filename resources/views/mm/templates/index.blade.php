<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    @vite('resources/css/app.css')
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="icon" href="{{ asset('foto/logo.png') }}" type="image/x-icon">
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
                    <a href="{{ url('manager-marketing', []) }}"
                        class="block py-2 px-4 rounded hover:bg-secondary">Home</a>
                </li>
                <li>
                    <a href="{{ url('manager-marketing/marketing', []) }}"
                        class="block py-2 px-4 rounded hover:bg-secondary">Marketing</a>
                </li>

                <li class="relative">
                    <button id="PrintReportBtn"
                        class="w-full flex items-center justify-between py-2 px-4 rounded hover:bg-secondary focus:outline-none">
                        Print Report
                        <!-- Dropdown Icon -->
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>
                    <!-- Dropdown Menu -->
                    <ul id="PrintReportMenu" class="hidden space-y-2 pl-6 mt-2">
                        <li class="relative">
                            <button id="PrintHarianBtn"
                                class="w-full flex items-center justify-between py-2 px-4 rounded hover:bg-secondary focus:outline-none">
                                Report Harian
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                                </svg>
                            </button>
                            <!-- Sub-dropdown for Report Harian -->
                            <ul id="PrintHarianMenu" class="hidden space-y-2 pl-6 mt-2">
                                <li>
                                    <a href="{{ route('ReportHarian', ['type' => 'approve']) }}"
                                        class="block py-2 px-4 rounded hover:bg-secondary">Diterima</a>
                                </li>
                                <li>
                                    <a href="{{ route('ReportHarian', ['type' => 'reject']) }}"
                                        class="block py-2 px-4 rounded hover:bg-secondary">Ditolak</a>
                                </li>
                            </ul>
                        </li>
                        <li class="relative">
                            <button id="PrintMingguanBtn"
                                class="w-full flex items-center justify-between py-2 px-4 rounded hover:bg-secondary focus:outline-none">
                                Report Mingguan
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                                </svg>
                            </button>
                            <!-- Sub-dropdown for Report Mingguan -->
                            <ul id="PrintMingguanMenu" class="hidden space-y-2 pl-6 mt-2">
                                <li>
                                    <a href="{{ route('ReportMingguan', ['type' => 'approve']) }}"
                                        class="block py-2 px-4 rounded hover:bg-secondary">Diterima</a>
                                </li>
                                <li>
                                    <a href="{{ route('ReportMingguan', ['type' => 'reject']) }}"
                                        class="block py-2 px-4 rounded hover:bg-secondary">Ditolak</a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </li>

                <!-- Dropdown for Report Marketing -->
                <li class="relative">
                    <button id="reportMarketingBtn"
                        class="w-full flex items-center justify-between py-2 px-4 rounded hover:bg-secondary focus:outline-none">
                        Report Harian
                        <!-- Dropdown Icon -->
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>
                    <!-- Dropdown Menu -->
                    <ul id="reportMarketingMenu" class="hidden space-y-2 pl-6 mt-2">
                        <li class="relative">
                            <a href="{{ url('manager-marketing/laporan-harian-marketing/sakinah', []) }}"
                                class="block py-2 px-4 rounded hover:bg-secondary">Griya Sakinah</a>
                        </li>
                        <li>
                            <a href="{{ url('manager-marketing/laporan-harian-marketing/savill') }}"
                                class="block py-2 px-4 rounded hover:bg-secondary">Sakinah Village</a>
                        </li>
                        <li>
                            <a href="{{ url('manager-marketing/laporan-harian-marketing/triehans') }}"
                                class="block py-2 px-4 rounded hover:bg-secondary">Triehans Village Tanjung</a>
                        </li>
                    </ul>
                </li>

                <!-- Dropdown for Report Manager -->
                <li class="relative">
                    <button id="reportManagerBtn"
                        class="w-full flex items-center justify-between py-2 px-4 rounded hover:bg-secondary focus:outline-none">
                        Report Mingguan
                        <!-- Dropdown Icon -->
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>
                    <!-- Dropdown Menu -->
                    <ul id="reportManagerMenu" class="hidden space-y-2 pl-6 mt-2">
                        <li class="relative">
                            <a href="{{ url('manager-marketing/laporan-mingguan-marketing/sakinah', []) }}"
                                class="block py-2 px-4 rounded hover:bg-secondary">Griya Sakinah</a>
                        </li>
                        <li>
                            <a href="{{ url('manager-marketing/laporan-mingguan-marketing/savill') }}"
                                class="block py-2 px-4 rounded hover:bg-secondary">Sakinah Village</a>
                        </li>
                        <li>
                            <a href="{{ url('manager-marketing/laporan-mingguan-marketing/triehans') }}"
                                class="block py-2 px-4 rounded hover:bg-secondary">Triehans Village Tanjung</a>
                        </li>
                    </ul>
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
            <h2 class="text-2xl font-semibold">Dashboard Manager Marketing</h2>
            <div>
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded">Logout</button>
                </form>
            </div>

        </header>

        <!-- Main Content Area -->
        <main class="p-6">
            @yield('page-dashboard')
        </main>
        <footer class="mt-6 bg-white p-4 rounded-lg shadow-lg">
            <p class="text-gray-500 text-center">© 2024 HR Group. All rights reserved.</p>
        </footer>
    </div>

    <!-- JavaScript for Dropdowns and Sidebar -->
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
        const reportMarketingMenu = document.getElementById("reportMarketingMenu");

        reportMarketingBtn.addEventListener("click", function() {
            reportMarketingMenu.classList.toggle("hidden");
        });

        // Dropdown toggle for Print Report
        const printReportBtn = document.getElementById("PrintReportBtn");
        const printReportMenu = document.getElementById("PrintReportMenu");

        printReportBtn.addEventListener("click", function() {
            printReportMenu.classList.toggle("hidden");
        });

        // Dropdown toggle for Print Harian
        const printHarianBtn = document.getElementById("PrintHarianBtn");
        const printHarianMenu = document.getElementById("PrintHarianMenu");

        printHarianBtn.addEventListener("click", function() {
            printHarianMenu.classList.toggle("hidden");
        });

        // Dropdown toggle for Report Mingguan under Print Report
        const printMingguanBtn = document.getElementById("PrintMingguanBtn");
        const printMingguanMenu = document.getElementById("PrintMingguanMenu");

        printMingguanBtn.addEventListener("click", function() {
            printMingguanMenu.classList.toggle("hidden");
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
