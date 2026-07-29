@extends('layout.admin')

@section('title', 'Admin Dashboard')

@section('content')
<!-- Main Content -->
<main class="flex-1 overflow-y-auto">
    <!-- Header -->
    <header class="flex justify-between items-center px-10 pt-8 pb-6">
        <div>
            <h1 class="text-3xl font-black">Dashboard Ringkasan</h1>
            <p class="text-slate-500 font-medium">Selamat datang kembali, {{ explode(' ', auth()->user()->name)[0] }}!</p>
        </div>
        <div class="flex items-center gap-4">
            <div class="text-right hidden md:block">
                <p class="font-bold">{{ auth()->user()->name }}</p>
                <p class="text-xs text-slate-400">{{ auth()->user()->role === 'admin' ? 'Penyelenggara Utama' : 'Tenant Organizer' }}</p>
            </div>
            <div class="w-12 h-12 bg-white rounded-2xl shadow-sm border flex items-center justify-center p-1 overflow-hidden">
                @if(auth()->user()->avatar)
                    <img src="{{ asset('storage/' . auth()->user()->avatar) }}" class="rounded-xl w-full h-full object-cover">
                @else
                    <div class="w-full h-full bg-indigo-100 text-indigo-600 rounded-xl flex items-center justify-center font-bold text-sm">
                        {{ strtoupper(substr(auth()->user()->name, 0, 2)) }}
                    </div>
                @endif
            </div>
        </div>
    </header>

    <!-- Stats Grid -->
     <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 px-10 mb-10">
         <div class="bg-white p-6 rounded-3xl border border-slate-100 shadow-sm">
             <div class="w-12 h-12 bg-indigo-50 text-indigo-600 rounded-2xl flex items-center justify-center mb-4">
                 <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                     <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                         d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z">
                     </path>
                 </svg>
             </div>
             <p class="text-slate-400 text-sm font-bold uppercase mb-1">Total Pendapatan</p>
             <h3 class="text-2xl font-black">Rp {{ number_format($totalRevenue, 0, ',', '.') }}</h3>
         </div>
         <div class="bg-white p-6 rounded-3xl border border-slate-100 shadow-sm">
             <div class="w-12 h-12 bg-green-50 text-green-600 rounded-2xl flex items-center justify-center mb-4">
                 <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                     <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                         d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z">
                     </path>
                 </svg>
             </div>
             <p class="text-slate-400 text-sm font-bold uppercase mb-1">Tiket Terjual</p>
             <h3 class="text-2xl font-black">{{ number_format($ticketsSold, 0, ',', '.') }}</h3>
         </div>
         <div class="bg-white p-6 rounded-3xl border border-slate-100 shadow-sm">
             <div class="w-12 h-12 bg-orange-50 text-orange-600 rounded-2xl flex items-center justify-center mb-4">
                 <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                     <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                         d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                 </svg>
             </div>
             <p class="text-slate-400 text-sm font-bold uppercase mb-1">Event Aktif</p>
             <h3 class="text-2xl font-black">{{ $activeEvents }} Event</h3>
         </div>
         <div class="bg-white p-6 rounded-3xl border border-slate-100 shadow-sm">
             <div class="w-12 h-12 bg-rose-50 text-rose-600 rounded-2xl flex items-center justify-center mb-4">
                 <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                     <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                         d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                 </svg>
             </div>
             <p class="text-slate-400 text-sm font-bold uppercase mb-1">Pesanan Pending</p>
             <h3 class="text-2xl font-black">{{ $pendingOrders }} Pesanan</h3>
         </div>
     </div>

     @if(auth()->user()->role === 'admin')
     <!-- Tenant Growth Chart Section -->
     <div class="px-10 mb-10">
         <div class="bg-white p-6 rounded-3xl border border-slate-100 shadow-sm w-full">
             <div class="mb-4">
                 <h3 class="font-black text-xl">Pertumbuhan Tenant Baru</h3>
                 <p class="text-sm text-slate-500">Statistik jumlah pendaftaran akun penyelenggara setiap bulannya pada tahun ini</p>
             </div>
             <div class="relative h-[220px] w-full">
                 <canvas id="tenantChart"></canvas>
             </div>
         </div>
     </div>
     @endif

     <!-- Chart Section -->
     <div class="px-10 mb-10">
         <div class="bg-white p-6 rounded-3xl border border-slate-100 shadow-sm w-full">
             <div class="mb-6 flex justify-between items-center">
                 <div>
                     <h3 class="font-black text-xl">Statistik Event</h3>
                     <p class="text-sm text-slate-500">Performa event berdasarkan kriteria pilihan</p>
                 </div>
                 <div class="relative min-w-[200px]" id="custom-chart-filter">
                     <input type="hidden" id="chartFilterInput" value="sales">
                     <button type="button" onclick="toggleChartDropdown()" id="chart-dropdown-button"
                         class="w-full flex justify-between items-center px-4 py-2 rounded-xl border border-slate-200 bg-white text-slate-700 hover:border-indigo-300 focus:ring-2 focus:ring-indigo-100 focus:border-indigo-400 outline-none transition-all text-sm">
                         <span id="chart-dropdown-selected-text" class="truncate font-bold">Banyak Pembeli</span>
                         <svg id="chart-dropdown-icon" class="w-4 h-4 text-slate-400 transition-transform duration-300 ml-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                             <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                         </svg>
                     </button>
                     <div id="chart-dropdown-menu"
                         class="absolute z-50 right-0 w-full mt-2 bg-white border border-slate-100 rounded-xl shadow-2xl opacity-0 invisible -translate-y-2 transition-all duration-300 overflow-hidden origin-top">
                         <ul class="py-1 divide-y divide-slate-50 text-sm">
                             <li onclick="selectChartFilter('sales', 'Banyak Pembeli')" class="px-5 py-3 hover:bg-indigo-50 hover:text-indigo-600 cursor-pointer transition-colors text-slate-600 font-bold">Banyak Pembeli</li>
                             <li onclick="selectChartFilter('revenue', 'Total Omzet (Rp)')" class="px-5 py-3 hover:bg-indigo-50 hover:text-indigo-600 cursor-pointer transition-colors text-slate-600 font-bold">Total Omzet (Rp)</li>
                         </ul>
                     </div>
                 </div>
             </div>
             <div class="relative h-[220px] w-full">
                 <canvas id="salesChart"></canvas>
             </div>
         </div>
     </div>

     <!-- Latest Sales Table -->
     <div class="bg-white border-y border-slate-200 overflow-hidden">
         <div class="px-10 py-8 border-b flex justify-between items-center bg-white">
             <h3 class="font-black text-xl">Transaksi Terakhir</h3>
             <a href="{{ route('admin.transactions.index') }}" class="text-indigo-600 font-bold hover:underline">Lihat Semua</a>
         </div>
         <table class="w-full text-left border-collapse">
                 <thead class="bg-slate-50 text-slate-400 uppercase text-[10px] font-black tracking-widest">
                     <tr>
                         <th class="px-8 py-4 w-1/4">Tgl Transaksi</th>
                         <th class="px-8 py-4 w-1/4">Pembeli</th>
                         <th class="px-8 py-4 w-1/4">Event</th>
                         <th class="px-8 py-4 w-[10%]">Status</th>
                         <th class="px-8 py-4 text-right">Total</th>
                     </tr>
                 </thead>
                 <tbody class="divide-y border-t">
                     @forelse($recentTransactions as $trx)
                     <tr class="hover:bg-slate-50 transition">
                         <td class="px-8 py-6 text-sm text-slate-600 max-w-xs break-all">{{ $trx->created_at->format('d M y') }}<br />{{ $trx->created_at->format('H:i') }}</td>
                         <td class="px-8 py-6">
                             <p class="font-bold uppercase tracking-wide text-sm truncate max-w-[150px]">{{ $trx->customer_name }}</p>
                             <p class="text-xs text-slate-400 truncate max-w-[150px]">{{ $trx->customer_email }}</p>
                         </td>
                         <td class="px-8 py-6">
                             <p class="font-medium text-slate-600 max-w-xs truncate max-w-[150px]">{{ $trx->event->title ?? '-' }}</p>
                             <p class="text-xs text-slate-400 truncate max-w-[150px]">{{ $trx->order_id }}</p>
                         </td>
                         <td class="px-8 py-6 whitespace-nowrap">
                             @if($trx->status === 'settlement' || $trx->status === 'success')
                                 <span class="px-3 py-1 bg-green-100 text-green-700 rounded-lg text-xs font-bold uppercase">Success</span>
                             @elseif($trx->status === 'pending')
                                 <span class="px-3 py-1 bg-orange-100 text-orange-700 rounded-lg text-xs font-bold uppercase">Pending</span>
                             @else
                                 <span class="px-3 py-1 bg-rose-100 text-rose-700 rounded-lg text-xs font-bold uppercase">{{ $trx->status }}</span>
                             @endif
                         </td>
                         <td class="px-8 py-6 font-black text-indigo-600 whitespace-nowrap text-right">Rp {{ number_format($trx->total_price, 0, ',', '.') }}</td>
                     </tr>
                     @empty
                     <tr>
                         <td colspan="5" class="px-8 py-10 text-center text-slate-500">Belum ada transaksi</td>
                     </tr>
                     @endforelse
                 </tbody>
             </table>
     </div>
</main>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        @if(auth()->user()->role === 'admin')
        const tenantStats = @json($tenantStats);
        const tenantLabels = tenantStats.map(stat => stat.month);
        const tenantData = tenantStats.map(stat => stat.total);
        
        const tenantCtx = document.getElementById('tenantChart').getContext('2d');
        new Chart(tenantCtx, {
            type: 'line',
            data: {
                labels: tenantLabels,
                datasets: [{
                    label: 'Tenant Baru',
                    data: tenantData,
                    borderColor: 'rgb(249, 115, 22)', // orange-500
                    backgroundColor: 'rgba(249, 115, 22, 0.1)',
                    borderWidth: 3,
                    fill: true,
                    tension: 0.4,
                    pointBackgroundColor: 'rgb(249, 115, 22)',
                    pointBorderColor: '#fff',
                    pointBorderWidth: 2,
                    pointRadius: 4,
                    pointHoverRadius: 6
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            stepSize: 1,
                            precision: 0
                        },
                        grid: {
                            color: '#f1f5f9', // slate-100
                            drawBorder: false
                        }
                    },
                    x: {
                        grid: {
                            display: false,
                            drawBorder: false
                        }
                    }
                },
                plugins: {
                    legend: {
                        display: false
                    },
                    tooltip: {
                        backgroundColor: 'rgba(30, 41, 59, 0.9)', // slate-800
                        titleFont: { family: "'Plus Jakarta Sans', sans-serif", size: 13 },
                        bodyFont: { family: "'Plus Jakarta Sans', sans-serif", size: 14, weight: 'bold' },
                        padding: 12,
                        cornerRadius: 12,
                        displayColors: false,
                        callbacks: {
                            label: function(context) {
                                return context.parsed.y + ' Tenant Baru';
                            }
                        }
                    }
                }
            }
        });
        @endif

        const eventStats = @json($eventStats);
        
        const labels = eventStats.map(stat => stat.title);
        const dataSales = eventStats.map(stat => stat.sales);
        const dataRevenue = eventStats.map(stat => stat.revenue);
        
        const ctx = document.getElementById('salesChart').getContext('2d');
        
        const formatRupiah = (number) => {
            return new Intl.NumberFormat('id-ID', {
                style: 'currency',
                currency: 'IDR',
                minimumFractionDigits: 0,
                maximumFractionDigits: 0
            }).format(number);
        };

        const chart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Tiket Terjual',
                    data: dataSales,
                    backgroundColor: 'rgba(99, 102, 241, 0.8)', // Indigo-500
                    borderColor: 'rgb(79, 70, 229)', // Indigo-600
                    borderWidth: 1,
                    borderRadius: 8,
                    barPercentage: 0.6,
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            precision: 0,
                            callback: function(value, index, values) {
                                if (document.getElementById('chartFilterInput').value === 'revenue') {
                                    if (value >= 1000000) {
                                        return 'Rp ' + (value / 1000000) + ' Jt';
                                    } else if (value >= 1000) {
                                        return 'Rp ' + (value / 1000) + ' Rb';
                                    }
                                    return 'Rp ' + value;
                                }
                                return value;
                            }
                        },
                        grid: {
                            color: '#f1f5f9', // slate-100
                            drawBorder: false
                        }
                    },
                    x: {
                        grid: {
                            display: false,
                            drawBorder: false
                        }
                    }
                },
                plugins: {
                    legend: {
                        display: false
                    },
                    tooltip: {
                        backgroundColor: 'rgba(30, 41, 59, 0.9)', // slate-800
                        titleFont: { family: "'Plus Jakarta Sans', sans-serif", size: 13 },
                        bodyFont: { family: "'Plus Jakarta Sans', sans-serif", size: 14, weight: 'bold' },
                        padding: 12,
                        cornerRadius: 12,
                        displayColors: false,
                        callbacks: {
                            label: function(context) {
                                let label = context.dataset.label || '';
                                if (label) {
                                    label += ': ';
                                }
                                if (context.parsed.y !== null) {
                                    if (document.getElementById('chartFilterInput').value === 'revenue') {
                                        label += formatRupiah(context.parsed.y);
                                    } else {
                                        label += context.parsed.y + ' tiket';
                                    }
                                }
                                return label;
                            }
                        }
                    }
                }
            }
        });

        // Handle dropdown change
        document.getElementById('chartFilterInput').addEventListener('change', function(e) {
            const type = e.target.value;
            
            if (type === 'sales') {
                chart.data.datasets[0].data = dataSales;
                chart.data.datasets[0].label = 'Tiket Terjual';
                chart.data.datasets[0].backgroundColor = 'rgba(99, 102, 241, 0.8)';
                chart.data.datasets[0].borderColor = 'rgb(79, 70, 229)';
            } else {
                chart.data.datasets[0].data = dataRevenue;
                chart.data.datasets[0].label = 'Total Omzet';
                chart.data.datasets[0].backgroundColor = 'rgba(34, 197, 94, 0.8)'; // green-500
                chart.data.datasets[0].borderColor = 'rgb(22, 163, 74)'; // green-600
            }
            
            chart.update();
        });
    });

    // Custom Dropdown Script
    const chartDropdownMenu = document.getElementById('chart-dropdown-menu');
    const chartDropdownIcon = document.getElementById('chart-dropdown-icon');
    const chartDropdownText = document.getElementById('chart-dropdown-selected-text');
    const chartFilterInput = document.getElementById('chartFilterInput');

    function toggleChartDropdown() {
        chartDropdownMenu.classList.toggle('opacity-0');
        chartDropdownMenu.classList.toggle('invisible');
        chartDropdownMenu.classList.toggle('-translate-y-2');
        chartDropdownIcon.classList.toggle('rotate-180');
    }

    function selectChartFilter(value, text) {
        chartFilterInput.value = value;
        chartDropdownText.textContent = text;
        toggleChartDropdown();
        chartFilterInput.dispatchEvent(new Event('change'));
    }

    document.addEventListener('click', function(event) {
        const selectContainer = document.getElementById('custom-chart-filter');
        if (!selectContainer.contains(event.target) && !chartDropdownMenu.classList.contains('invisible')) {
            toggleChartDropdown();
        }
    });
</script>
@endsection
