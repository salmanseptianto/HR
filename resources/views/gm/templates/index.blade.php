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
                    <a href="{{ url('general-manager') }}" class="block py-2 px-4 rounded hover:bg-secondary">Home</a>
                </li>
                <!-- Dropdown for Report Marketing -->
                <li>
                    <a href="{{ url('general-manager/kpi') }}" class="block py-2 px-4 rounded hover:bg-secondary">KPI</a>
                </li>
                <li>
                    <a href="{{ url('general-manager/print') }}" class="block py-2 px-4 rounded hover:bg-secondary">Print</a>
                </li>
                <li>
                    <a href="{{ url('general-manager/add-user') }}" class="block py-2 px-4 rounded hover:bg-secondary">Tambah Manager</a>
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
            <h2 class="text-2xl font-semibold">Dashboard General Manager</h2>
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
            @yield('page-kpi')
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
        const reportMarketingMenu = document.getElementById("reportMarketingMenu");

        reportMarketingBtn.addEventListener("click", function() {
            reportMarketingMenu.classList.toggle("hidden");
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
