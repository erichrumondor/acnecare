<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\KonsultasiRule;

class KonsultasiRuleSeeder extends Seeder
{
    public function run(): void
    {
        KonsultasiRule::truncate();

        $pertanyaan = [
            [
                'nomor_pertanyaan' => 1,
                'pertanyaan'       => 'Apakah kamu melihat adanya perubahan atau kelainan pada permukaan kulitmu saat ini?',
                'jawaban_ya'       => 'lanjut',
                'jawaban_tidak'    => 'tidak_terdeteksi',
            ],
            [
                'nomor_pertanyaan' => 2,
                'pertanyaan'       => 'Apakah kamu melihat pori-pori tersumbat berupa titik hitam atau putih di permukaan kulit, tanpa disertai benjolan merah?',
                'jawaban_ya'       => 'komedo',
                'jawaban_tidak'    => 'lanjut',
            ],
            [
                'nomor_pertanyaan' => 3,
                'pertanyaan'       => 'Jika ada titik tersebut, apakah warnanya hitam (terbuka) bukan putih tertutup?',
                'jawaban_ya'       => 'komedo_hitam',
                'jawaban_tidak'    => 'komedo_putih',
            ],
            [
                'nomor_pertanyaan' => 4,
                'pertanyaan'       => 'Apakah terdapat benjolan merah di permukaan kulitmu?',
                'jawaban_ya'       => 'lanjut',
                'jawaban_tidak'    => 'tidak_terdeteksi',
            ],
            [
                'nomor_pertanyaan' => 5,
                'pertanyaan'       => 'Apakah benjolan tersebut berisi cairan nanah berwarna putih atau kuning di bagian atasnya?',
                'jawaban_ya'       => 'pustula',
                'jawaban_tidak'    => 'lanjut',
            ],
            [
                'nomor_pertanyaan' => 6,
                'pertanyaan'       => 'Apakah benjolan terasa keras dan berada jauh di bawah permukaan kulit (tidak ada kepala/puncak)?',
                'jawaban_ya'       => 'lanjut_nodul',
                'jawaban_tidak'    => 'papula',
            ],
            [
                'nomor_pertanyaan' => 7,
                'pertanyaan'       => 'Apakah ukuran benjolan lebih besar dari biji jagung (sekitar 5mm atau lebih)?',
                'jawaban_ya'       => 'lanjut_nodul',
                'jawaban_tidak'    => 'papula',
            ],
            [
                'nomor_pertanyaan' => 8,
                'pertanyaan'       => 'Apakah benjolan terasa sangat nyeri bahkan tanpa disentuh sekalipun?',
                'jawaban_ya'       => 'nodul',
                'jawaban_tidak'    => 'papula',
            ],
        ];

        foreach ($pertanyaan as $item) {
            KonsultasiRule::create($item);
        }
    }
}