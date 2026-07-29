<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\Transaction;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = auth()->user();

         // 1. Menjumlahkan semua nominal total_price dari kolom Transaksi Lunas
        $totalRevenueQuery = Transaction::whereIn('status', ['settlement', 'success']);
        
        // 2. Menghitung Berapa orang tamu yang tiketnya sudah Lunas
        $ticketsSoldQuery = Transaction::whereIn('status', ['settlement', 'success']);
        
        // 3. Menghitung Jumlah Acara Mendatang yang aktif diselenggarakan
        $activeEventsQuery = Event::where('date', '>=', now());
        
        // 4. Menghitung Transaksi Ngadat (Status belum dibayar pelanggan / Expired)
        $pendingOrdersQuery = Transaction::where('status', 'pending');
        
        // 5. Menyertakan 5 daftar riwayat pesanan (History) paling mutakhir di panel
        $recentTransactionsQuery = Transaction::with('event')->latest()->take(5);

        if ($user->role === 'organizer') {
            $totalRevenueQuery->whereHas('event', fn($q) => $q->where('organizer_id', $user->id));
            $ticketsSoldQuery->whereHas('event', fn($q) => $q->where('organizer_id', $user->id));
            $activeEventsQuery->where('organizer_id', $user->id);
            $pendingOrdersQuery->whereHas('event', fn($q) => $q->where('organizer_id', $user->id));
            $recentTransactionsQuery->whereHas('event', fn($q) => $q->where('organizer_id', $user->id));
        }

        $totalRevenue = $totalRevenueQuery->sum('total_price');
        $ticketsSold = $ticketsSoldQuery->count();
        $activeEvents = $activeEventsQuery->count();
        $pendingOrders = $pendingOrdersQuery->count();
        $recentTransactions = $recentTransactionsQuery->get();

        // 6. Data Statistik Penjualan Tiap Event (Untuk Grafik)
        $eventStatsQuery = Event::withCount(['transactions as total_sales' => function($query) {
            $query->whereIn('status', ['settlement', 'success']);
        }])->withSum(['transactions as total_revenue' => function($query) {
            $query->whereIn('status', ['settlement', 'success']);
        }], 'total_price');

        if ($user->role === 'organizer') {
            $eventStatsQuery->where('organizer_id', $user->id);
        }

        $eventStats = $eventStatsQuery->get()->map(function($event) {
            return [
                'title' => strlen($event->title) > 20 ? substr($event->title, 0, 20) . '...' : $event->title,
                'sales' => $event->total_sales ?? 0,
                'revenue' => $event->total_revenue ?? 0,
            ];
        });

        // 7. Data Pertumbuhan Tenant (Hanya untuk Admin)
        $tenantStats = [];
        if ($user->role === 'admin') {
            $tenantStatsQuery = \App\Models\User::where('role', 'organizer')
                ->selectRaw('MONTH(created_at) as month, COUNT(*) as total')
                ->whereYear('created_at', date('Y'))
                ->groupBy('month')
                ->orderBy('month')
                ->get();

            $months = ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'];
            foreach ($months as $index => $monthName) {
                $monthNum = $index + 1;
                $stat = $tenantStatsQuery->firstWhere('month', $monthNum);
                $tenantStats[] = [
                    'month' => $monthName,
                    'total' => $stat ? $stat->total : 0
                ];
            }
        }

        return view('admin.dashboard', compact('totalRevenue', 'ticketsSold', 'activeEvents', 'pendingOrders', 'recentTransactions', 'eventStats', 'tenantStats'));
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
