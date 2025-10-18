<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use App\Models\Service;
use App\Models\Stock;
use App\Models\Cashflow;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $today = Carbon::today();
        $thisMonth = Carbon::now();

        // Agendamentos de hoje
        $todayAppointments = Appointment::whereDate('appointment_date', $today)
            ->with('service')
            ->orderBy('appointment_time')
            ->get();

        // Próximos agendamentos (próximos 7 dias)
        $upcomingAppointments = Appointment::whereBetween('appointment_date', [
                $today,
                $today->copy()->addDays(7)
            ])
            ->whereIn('status', ['pendente', 'confirmado'])
            ->with('service')
            ->orderBy('appointment_date')
            ->orderBy('appointment_time')
            ->take(10)
            ->get();

        // Estatísticas financeiras
        $todayRevenue = Cashflow::entrada()
            ->byDate($today)
            ->sum('amount');

        $todayExpenses = Cashflow::saida()
            ->byDate($today)
            ->sum('amount');

        $monthRevenue = Cashflow::entradaByMonth($thisMonth->year, $thisMonth->month)
            ->sum('amount');

        $monthExpenses = Cashflow::saidaByMonth($thisMonth->year, $thisMonth->month)
            ->sum('amount');

        $monthBalance = $monthRevenue - $monthExpenses;

        // Produtos com estoque baixo
        $lowStockItems = Stock::lowStock()->get();

        // Estatísticas gerais
        $totalServices = Service::active()->count();
        $pendingAppointments = Appointment::where('status', 'pendente')->count();

        return view('admin.dashboard', compact(
            'todayAppointments',
            'upcomingAppointments',
            'todayRevenue',
            'todayExpenses',
            'monthRevenue',
            'monthExpenses',
            'monthBalance',
            'lowStockItems',
            'totalServices',
            'pendingAppointments'
        ));
    }
}



