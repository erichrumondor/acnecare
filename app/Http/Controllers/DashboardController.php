<?php
namespace App\Http\Controllers;

use App\Models\SkinJournal;
use App\Models\KonsultasiHasil;
use App\Models\Treatment;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $userId = Auth::id();

        // Stats
        $totalJurnal = SkinJournal::where('user_id', $userId)->count();
        $totalKonsultasi = KonsultasiHasil::where('user_id', $userId)->count();
        $totalProduk = Treatment::where('user_id', $userId)->where('is_active', true)->count();

        // Konsultasi terakhir
        $konsultasiTerakhir = KonsultasiHasil::where('user_id', $userId)
            ->orderBy('created_at', 'desc')
            ->first();

        // Jurnal terbaru
        $jurnalTerbaru = SkinJournal::where('user_id', $userId)
            ->orderBy('tanggal', 'desc')
            ->take(3)
            ->get();

        // Produk aktif
        $produkAktif = Treatment::where('user_id', $userId)
            ->where('is_active', true)
            ->orderBy('created_at', 'desc')
            ->take(4)
            ->get();

        // Data grafik 7 hari terakhir
        $grafik = [];
        $labels = [];
        for ($i = 6; $i >= 0; $i--) {
            $tanggal = Carbon::now()->subDays($i);
            $labels[] = $tanggal->translatedFormat('D');
            $jurnal = SkinJournal::where('user_id', $userId)
                ->whereDate('tanggal', $tanggal->format('Y-m-d'))
                ->first();
            $grafik[] = $jurnal ? $jurnal->rating : null;
        }

        // Hitung persentase kondisi
        $jurnalMingguIni = SkinJournal::where('user_id', $userId)
            ->whereBetween('tanggal', [
                Carbon::now()->startOfWeek(),
                Carbon::now()->endOfWeek()
            ])->get();

        $rataRating = $jurnalMingguIni->count() > 0
            ? round($jurnalMingguIni->avg('rating'), 1)
            : 0;

        return view('pages.dashboard', compact(
            'totalJurnal',
            'totalKonsultasi',
            'totalProduk',
            'konsultasiTerakhir',
            'jurnalTerbaru',
            'produkAktif',
            'grafik',
            'labels',
            'rataRating'
        ));
    }
}