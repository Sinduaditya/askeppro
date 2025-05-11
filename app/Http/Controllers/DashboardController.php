<?php

namespace App\Http\Controllers;

use App\Models\AskepCase;
use App\Models\Patient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class DashboardController extends Controller
{
    public function index()
    {
        $totalPatients = Patient::count();
        $totalCases = AskepCase::count(); // Tambahkan ini

        // Ambil aktivitas terbaru (AskepCase)
        $recentActivities = AskepCase::with('patient')
            ->orderBy('created_at', 'desc')
            ->take(5) // Batasi 5 aktivitas terbaru
            ->get();

        // Cek aktivitas
        if ($recentActivities->isEmpty()) {
            Log::info('Tidak ada recent activities yang ditemukan');
        } else {
            Log::info('Recent activities ditemukan: ' . $recentActivities->count());
            Log::info('Status dari activities: ' . $recentActivities->pluck('status'));
        }

        // Statistik lainnya yang mungkin diperlukan
        $completedCases = AskepCase::where('status', 'selesai')->count();
        $ongoingCases = AskepCase::where('status', 'proses')->count();

        return view(
            'dashboard',
            compact(
                'totalPatients',
                'totalCases', // Tambahkan ini
                'recentActivities',
                'completedCases',
                'ongoingCases',
            ),
        );
    }
}
