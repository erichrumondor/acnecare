<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Article;
use App\Models\SkinJournal;

class DashboardAdminController extends Controller
{
    public function index()
    {
        $totalUser      = User::where('role', 'user')->count();
        $totalArtikel   = Article::count();
        $totalJurnal    = SkinJournal::count();

        $userTerbaru = User::where('role', 'user')
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();

        $artikelTerbaru = Article::orderBy('created_at', 'desc')
            ->take(5)
            ->get();

        return view('admin.dashboard', compact(
            'totalUser', 'totalArtikel', 'totalJurnal',
            'userTerbaru', 'artikelTerbaru'
        ));
    }
}