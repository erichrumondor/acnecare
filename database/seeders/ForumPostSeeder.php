<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ForumPost;

class ForumPostSeeder extends Seeder
{
    public function run(): void
    {
        ForumPost::query()->delete();

        $posts = [
            [
                'user_id' => 1,
                'judul'   => 'Tips mengatasi komedo di hidung yang membandel',
                'konten'  => 'Halo semua! Saya sudah 3 bulan berjuang melawan komedo hitam di hidung. Sudah coba banyak produk tapi belum ada yang benar-benar efektif. Ada yang punya pengalaman serupa? Produk apa yang berhasil untuk kalian?',
                'topik'   => 'komedo',
                'views'   => 45,
            ],
            [
                'user_id' => 1,
                'judul'   => 'Pengalaman pakai benzoyl peroxide untuk pustula',
                'konten'  => 'Mau sharing pengalaman pakai benzoyl peroxide 5% untuk pustula yang saya alami. Minggu pertama kulit saya justru tambah kering dan mengelupas. Tapi setelah 3 minggu, pustula mulai berkurang signifikan. Siapa yang punya pengalaman serupa?',
                'topik'   => 'pustula',
                'views'   => 32,
            ],
            [
                'user_id' => 1,
                'judul'   => 'Rekomendasi sunscreen non-comedogenic untuk kulit berjerawat',
                'konten'  => 'Teman-teman, saya lagi cari sunscreen yang ringan dan tidak menyumbat pori. Kulit saya cenderung berminyak dan mudah jerawatan. Budget sekitar 100-200ribu. Ada rekomendasi?',
                'topik'   => 'produk',
                'views'   => 78,
            ],
            [
                'user_id' => 1,
                'judul'   => 'Berapa lama jerawat papula biasanya sembuh?',
                'konten'  => 'Saya baru pertama kali dapat papula yang cukup besar di pipi. Sudah pakai spot treatment niacinamide dan salicylic acid. Kira-kira berapa lama biasanya bisa sembuh? Saya ada acara penting minggu depan 😅',
                'topik'   => 'papula',
                'views'   => 56,
            ],
            [
                'user_id' => 1,
                'judul'   => 'Skincare routine malam yang efektif untuk jerawat',
                'konten'  => 'Share dong rutinitas malam kalian! Saya masih bingung urutan yang benar. Sekarang saya pakai: cleanser → toner BHA → niacinamide serum → moisturizer. Apakah urutannya sudah benar?',
                'topik'   => 'tips',
                'views'   => 91,
            ],
        ];

        foreach ($posts as $post) {
            ForumPost::create($post);
        }
    }
}