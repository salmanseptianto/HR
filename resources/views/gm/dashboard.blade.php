@extends('gm.templates.index')

@section('page-dashboard')
    <!-- Chart Section -->
    <div class="mt-8 bg-white shadow-md rounded p-6 chart-container">
        <h3 class="text-xl font-semibold mb-4">Chart Diagram</h3>
        <select id="userSelect" class="block w-full mb-4 p-2 border border-gray-300 rounded">
            @foreach ($marketingUsers as $user)
                <option value="{{ $user->id }}">{{ $user->name }}</option>
            @endforeach
        </select>
        <div class="relative h-64">
            <canvas id="performanceChart"></canvas>
        </div>
    </div>
    <!-- Card Section -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mt-8">
        <div class="bg-white p-6 rounded shadow-md border border-gray-200 hover:bg-gray-50 transition">
            <h3 class="text-xl font-semibold">Total Users</h3>
            <p class="text-3xl mt-4">{{ $totalUsers }}</p>
        </div>
        <div class="bg-white p-6 rounded shadow-md border border-gray-200 hover:bg-gray-50 transition">
            <h3 class="text-xl font-semibold">Reports Submitted</h3>
            <p class="text-3xl mt-4">{{ $reportsSubmitted }}</p>
        </div>
        <div class="bg-white p-6 rounded shadow-md border border-gray-200 hover:bg-gray-50 transition">
            <h3 class="text-xl font-semibold">Pending Tasks</h3>
            <p class="text-3xl mt-4">{{ $pendingTasks }}</p>
        </div>
    </div>

    <!-- Table Section -->
    <div class="mt-8 bg-white shadow-md rounded">
        <div class="p-4 border-b">
            <h3 class="text-xl font-semibold">Recent Activities</h3>
        </div>
        <table class="min-w-full text-left table-auto">
            <thead>
                <tr class="bg-gray-100">
                    <th class="py-2 px-4">Date</th>
                    <th class="py-2 px-4">User</th>
                    <th class="py-2 px-4">Action</th>
                    <th class="py-2 px-4">Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($recentActivities as $activity)
                    <tr class="border-t hover:bg-gray-50 transition">
                        <td class="py-2 px-4">
                            {{ \Carbon\Carbon::parse($activity->date)->format('Y-m-d') }}
                        </td>
                        <td class="py-2 px-4">{{ $activity->user_name }}</td>
                        <td class="py-2 px-4">
                            {{ $uploadedStatus[$activity->user_id] ?? $activity->action }}
                        </td>
                        <td
                            class="py-2 px-4 {{ $activity->status == 0 ? 'text-yellow-600' : ($activity->status == 1 ? 'text-green-600' : 'text-red-600') }}">
                            {{ $activity->status == 0 ? 'Pending' : ($activity->status == 1 ? 'Diterima' : 'Ditolak') }}
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Chart.js CDN -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <!-- Chart.js Script -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const ctx = document.getElementById('performanceChart').getContext('2d');
            const allPerformanceData = @json($performanceData); // All data

            let chart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: [],
                    datasets: [{
                            label: 'Diterima',
                            data: [],
                            backgroundColor: getGradient(ctx, 'rgba(54, 162, 235, 0.5)',
                                'rgba(54, 162, 235, 0.2)'),
                            borderColor: 'rgba(54, 162, 235, 1)',
                            borderWidth: 2,
                            borderRadius: 5
                        },
                        {
                            label: 'Ditolak',
                            data: [],
                            backgroundColor: getGradient(ctx, 'rgba(255, 99, 132, 0.5)',
                                'rgba(255, 99, 132, 0.2)'),
                            borderColor: 'rgba(255, 99, 132, 1)',
                            borderWidth: 2,
                            borderRadius: 5
                        },
                        {
                            label: 'Total Uploads',
                            data: [],
                            backgroundColor: getGradient(ctx, 'rgba(75, 192, 192, 0.5)',
                                'rgba(75, 192, 192, 0.2)'),
                            borderColor: 'rgba(75, 192, 192, 1)',
                            borderWidth: 2,
                            borderRadius: 5
                        }
                    ]
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: {
                            position: 'top',
                            labels: {
                                color: '#333'
                            }
                        },
                        tooltip: {
                            callbacks: {
                                label: function(tooltipItem) {
                                    return tooltipItem.dataset.label + ': ' + tooltipItem.raw;
                                }
                            }
                        },
                        datalabels: {
                            display: true,
                            color: '#333',
                            anchor: 'end',
                            align: 'top',
                            formatter: function(value) {
                                return value;
                            }
                        }
                    },
                    scales: {
                        x: {
                            beginAtZero: true,
                            grid: {
                                display: false
                            },
                            ticks: {
                                color: '#333'
                            }
                        },
                        y: {
                            beginAtZero: true,
                            grid: {
                                borderDash: [5, 5]
                            },
                            ticks: {
                                color: '#333'
                            }
                        }
                    }
                }
            });

            function updateChart(userId) {
                const userData = allPerformanceData.find(user => user.id === userId);

                if (userData) {
                    chart.data.labels = [userData.name];
                    chart.data.datasets[0].data = [userData.accepted];
                    chart.data.datasets[1].data = [userData.rejected];
                    chart.data.datasets[2].data = [userData.total];
                    chart.update();
                }
            }

            document.getElementById('userSelect').addEventListener('change', function() {
                const selectedUserId = this.value;
                updateChart(parseInt(selectedUserId));
            });

            // Initialize chart with the first user
            if (allPerformanceData.length > 0) {
                updateChart(allPerformanceData[0].id);
            }

            function getGradient(ctx, color1, color2) {
                const gradient = ctx.createLinearGradient(0, 0, 0, 400);
                gradient.addColorStop(0, color1);
                gradient.addColorStop(1, color2);
                return gradient;
            }
        });
    </script>
@endsection
