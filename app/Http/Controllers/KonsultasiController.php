<?php
namespace App\Http\Controllers;

use App\Models\KonsultasiRule;
use App\Models\KonsultasiHasil;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class KonsultasiController extends Controller
{
    // Halaman peringatan sebelum mulai
    public function index()
    {
        $riwayat = KonsultasiHasil::where('user_id', Auth::id())
            ->orderBy('created_at', 'desc')
            ->take(3)
            ->get();

        return view('pages.konsultasi.index', compact('riwayat'));
    }

    // Mulai konsultasi — pertanyaan pertama
    public function mulai()
    {
        $pertanyaan = KonsultasiRule::where('nomor_pertanyaan', 1)->first();
        return view('pages.konsultasi.tanya', [
            'pertanyaan' => $pertanyaan,
            'nomor'      => 1,
            'jawaban'    => [],
            'total'      => KonsultasiRule::count(),
        ]);
    }

    // Proses jawaban dan lanjut ke pertanyaan berikutnya
    public function jawab(Request $request)
    {
        $request->validate([
            'nomor'   => 'required|integer',
            'jawaban' => 'required|in:ya,tidak',
            'history' => 'nullable|string',
        ]);

        $nomor   = $request->nomor;
        $jawaban = $request->jawaban;
        $history = $request->history ? json_decode($request->history, true) : [];

        // Simpan jawaban
        $history[$nomor] = $jawaban;

        // Ambil rule saat ini
        $rule = KonsultasiRule::where('nomor_pertanyaan', $nomor)->first();
        $kode = $jawaban === 'ya' ? $rule->jawaban_ya : $rule->jawaban_tidak;

        // Tentukan langkah berikutnya
        $nomorBerikut = $this->tentukanNomor($nomor, $kode, $history);

        if ($nomorBerikut === null) {
            // Selesai — simpan hasil
            return $this->simpanHasil($kode, $history);
        }

        $pertanyaanBerikut = KonsultasiRule::where('nomor_pertanyaan', $nomorBerikut)->first();

        return view('pages.konsultasi.tanya', [
            'pertanyaan' => $pertanyaanBerikut,
            'nomor'      => $nomorBerikut,
            'jawaban'    => $history,
            'total'      => KonsultasiRule::count(),
            'history'    => json_encode($history),
        ]);
    }

    // Logika alur pertanyaan
    private function tentukanNomor($nomor, $kode, $history)
    {
        // Kode final — langsung ke hasil
        $kodeFinal = ['komedo_hitam','komedo_putih','papula','pustula','nodul','tidak_terdeteksi'];
        if (in_array($kode, $kodeFinal)) return null;

        // Alur pertanyaan
        switch ($nomor) {
            case 1: return $kode === 'lanjut' ? 2 : null;
            case 2: return $kode === 'komedo' ? 3 : 4;
            case 3: return null; // komedo_hitam atau komedo_putih
            case 4: return $kode === 'lanjut' ? 5 : null;
            case 5: return $kode === 'pustula' ? null : 6;
            case 6: return $kode === 'lanjut_nodul' ? 7 : null;
            case 7: return $kode === 'lanjut_nodul' ? 8 : null;
            case 8: return null;
            default: return null;
        }
    }

    // Simpan hasil dan redirect ke halaman hasil
    private function simpanHasil($kode, $history)
    {
        // Tentukan keparahan
        $keparahan = 'ringan';
        if (in_array($kode, ['pustula'])) $keparahan = 'sedang';
        if (in_array($kode, ['nodul']))   $keparahan = 'berat';

        $hasil = KonsultasiHasil::create([
            'user_id'   => Auth::id(),
            'hasil'     => $kode === 'tidak_terdeteksi' ? 'tidak_terdeteksi' : $kode,
            'jawaban'   => $history,
            'keparahan' => $keparahan,
        ]);

        return redirect()->route('konsultasi.hasil', $hasil->id);
    }

    // Halaman hasil konsultasi
    public function hasil($id)
    {
        $hasil = KonsultasiHasil::where('user_id', Auth::id())
            ->findOrFail($id);

        // Ambil rekomendasi produk berdasarkan hasil
        $jenisMap = [
            'komedo_hitam' => 'komedo',
            'komedo_putih' => 'komedo',
            'papula'       => 'papula',
            'pustula'      => 'pustula',
            'nodul'        => 'nodul',
        ];

        $jenis = $jenisMap[$hasil->hasil] ?? null;
        $produk = $jenis
            ? Product::whereJsonContains('jenis_jerawat', $jenis)
                ->where('is_active', true)
                ->take(4)
                ->get()
            : collect();

        return view('pages.konsultasi.hasil', compact('hasil', 'produk'));
    }

    // Riwayat konsultasi
    public function riwayat()
    {
        $riwayat = KonsultasiHasil::where('user_id', Auth::id())
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('pages.konsultasi.riwayat', compact('riwayat'));
    }
}