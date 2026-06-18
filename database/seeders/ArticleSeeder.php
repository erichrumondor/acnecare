<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Article;
use Illuminate\Support\Str;

class ArticleSeeder extends Seeder
{
    public function run(): void
    {
        Article::query()->delete();

        $articles = [
            [
                'user_id'      => 1,
                'judul'        => 'Mengenal 5 Jenis Jerawat dan Cara Mengatasinya',
                'slug'         => 'mengenal-5-jenis-jerawat',
                'konten'       => 'Jerawat adalah kondisi kulit yang terjadi ketika folikel rambut tersumbat oleh minyak dan sel kulit mati. Ada beberapa jenis jerawat yang perlu kamu ketahui.

**1. Komedo Hitam (Blackhead)**
Komedo hitam terbentuk ketika pori-pori tersumbat terbuka di permukaan kulit. Paparan udara menyebabkan oksidasi yang membuat sumbatan berwarna hitam. Cara mengatasinya: gunakan pembersih dengan salicylic acid dan eksfoliasi rutin.

**2. Komedo Putih (Whitehead)**
Berbeda dengan komedo hitam, komedo putih terbentuk ketika pori-pori tersumbat tertutup. Tampak sebagai benjolan putih kecil. Gunakan retinol dan BHA untuk mengatasinya.

**3. Papula**
Papula adalah benjolan merah kecil yang terjadi akibat inflamasi. Tidak berisi nanah dan terasa nyeri saat disentuh. Hindari memencet dan gunakan niacinamide untuk mengurangi kemerahan.

**4. Pustula**
Pustula mirip dengan papula tetapi berisi nanah berwarna putih atau kuning. Gunakan benzoyl peroxide sebagai spot treatment.

**5. Nodul**
Nodul adalah jerawat paling parah — benjolan keras yang terbentuk jauh di bawah kulit. Sangat nyeri dan memerlukan penanganan dokter kulit.',
                'kategori'     => 'edukasi',
                'is_published' => true,
            ],
            [
                'user_id'      => 1,
                'judul'        => '7 Kebiasaan Harian yang Memperparah Jerawat',
                'slug'         => '7-kebiasaan-yang-memperparah-jerawat',
                'konten'       => 'Tanpa disadari, banyak kebiasaan sehari-hari yang bisa memperparah kondisi jerawat. Berikut 7 kebiasaan yang perlu kamu hindari.

**1. Sering Menyentuh Wajah**
Tangan kita mengandung banyak bakteri. Setiap kali menyentuh wajah, bakteri berpindah ke kulit dan bisa memicu jerawat baru.

**2. Tidak Mengganti Sarung Bantal**
Sarung bantal menyerap minyak, keringat, dan bakteri dari wajah. Ganti minimal 2x seminggu.

**3. Memencet Jerawat**
Memencet jerawat dapat menyebabkan infeksi lebih dalam, bekas luka, dan penyebaran bakteri ke area sekitarnya.

**4. Skip Sunscreen**
UV dapat memperparah inflamasi dan meninggalkan bekas jerawat lebih gelap. Gunakan sunscreen setiap hari.

**5. Konsumsi Makanan Tinggi Gula**
Makanan dengan indeks glikemik tinggi dapat meningkatkan produksi sebum dan memicu jerawat.

**6. Stres Berlebihan**
Stres meningkatkan hormon kortisol yang dapat merangsang kelenjar minyak berlebihan.

**7. Tidak Membersihkan Makeup**
Sisa makeup yang tertinggal dapat menyumbat pori-pori. Selalu double cleanse sebelum tidur.',
                'kategori'     => 'tips',
                'is_published' => true,
            ],
            [
                'user_id'      => 1,
                'judul'        => 'Mitos vs Fakta Seputar Jerawat yang Perlu Kamu Tahu',
                'slug'         => 'mitos-vs-fakta-jerawat',
                'konten'       => 'Banyak mitos seputar jerawat yang beredar di masyarakat. Yuk kita luruskan!

**Mitos 1: Coklat menyebabkan jerawat**
Fakta: Tidak ada bukti ilmiah langsung bahwa coklat menyebabkan jerawat. Yang berpengaruh adalah gula dan lemak jenuh dalam coklat olahan.

**Mitos 2: Jerawat hanya muncul di masa remaja**
Fakta: Jerawat bisa muncul di usia berapa pun. Jerawat dewasa (adult acne) sangat umum, terutama pada wanita akibat perubahan hormonal.

**Mitos 3: Kulit berminyak tidak perlu moisturizer**
Fakta: Kulit berminyak tetap butuh hidrasi. Tanpa moisturizer, kulit justru memproduksi lebih banyak minyak sebagai kompensasi.

**Mitos 4: Sering cuci muka dapat menghilangkan jerawat**
Fakta: Mencuci muka terlalu sering justru merusak skin barrier dan memperparah jerawat. Cukup 2x sehari.

**Mitos 5: Pasta gigi bisa menghilangkan jerawat**
Fakta: Pasta gigi mengandung bahan yang dapat mengiritasi kulit. Gunakan spot treatment yang diformulasikan khusus untuk jerawat.',
                'kategori'     => 'mitos_fakta',
                'is_published' => true,
            ],
            [
                'user_id'      => 1,
                'judul'        => 'Skincare Routine untuk Kulit Berjerawat — Panduan Lengkap',
                'slug'         => 'skincare-routine-kulit-berjerawat',
                'konten'       => 'Membangun rutinitas skincare yang tepat adalah kunci mengatasi jerawat secara efektif. Berikut panduan lengkapnya.

**Rutinitas Pagi:**
1. Pembersih wajah gentle (pH balanced)
2. Toner dengan niacinamide atau BHA
3. Serum (vitamin C atau niacinamide)
4. Moisturizer non-comedogenic
5. Sunscreen SPF 30+

**Rutinitas Malam:**
1. Oil cleanser / micellar water (untuk hapus makeup)
2. Pembersih wajah dengan salicylic acid
3. Toner eksfoliasi (BHA, 2-3x seminggu)
4. Serum treatment (retinol atau benzoyl peroxide)
5. Moisturizer
6. Spot treatment pada jerawat aktif

**Bahan Aktif yang Direkomendasikan:**
- Salicylic Acid (BHA): membersihkan pori
- Niacinamide: mengurangi kemerahan
- Benzoyl Peroxide: membunuh bakteri
- Retinol: mencegah penyumbatan pori
- Centella Asiatica: menenangkan inflamasi

**Yang Perlu Dihindari:**
- Alkohol denat dalam konsentrasi tinggi
- Fragrance/parfum
- Coconut oil (comedogenic tinggi)',
                'kategori'     => 'tips',
                'is_published' => true,
            ],
            [
                'user_id'      => 1,
                'judul'        => 'Mengenal Bahan Aktif Skincare untuk Jerawat',
                'slug'         => 'bahan-aktif-skincare-jerawat',
                'konten'       => 'Memahami bahan aktif skincare membantu kamu memilih produk yang tepat untuk jenis jerawatmu.

**Salicylic Acid (BHA)**
BHA larut dalam minyak sehingga bisa masuk ke dalam pori dan membersihkan sumbatan dari dalam. Efektif untuk komedo dan jerawat ringan. Gunakan konsentrasi 0.5-2%.

**Niacinamide (Vitamin B3)**
Niacinamide memiliki banyak manfaat: mengurangi produksi sebum, meminimalkan tampilan pori, mengurangi kemerahan, dan mencerahkan bekas jerawat. Aman untuk semua jenis kulit.

**Benzoyl Peroxide**
Bekerja dengan membunuh bakteri P. acnes penyebab jerawat. Efektif untuk pustula dan papula. Mulai dari konsentrasi rendah (2.5%) untuk meminimalkan iritasi.

**Retinol (Vitamin A)**
Mempercepat pergantian sel kulit, mencegah penyumbatan pori, dan memudarkan bekas jerawat. Gunakan di malam hari dan mulai dari konsentrasi rendah.

**AHA (Glycolic Acid, Lactic Acid)**
Eksfoliasi permukaan kulit untuk mengangkat sel mati dan memudarkan bekas jerawat. Tidak seefektif BHA untuk jerawat aktif tapi bagus untuk tekstur kulit.

**Centella Asiatica**
Bahan alami dengan sifat anti-inflamasi yang kuat. Ideal untuk menenangkan jerawat yang meradang dan mempercepat penyembuhan.',
                'kategori'     => 'edukasi',
                'is_published' => true,
            ],
            [
                'user_id'      => 1,
                'judul'        => 'Kapan Harus ke Dokter Kulit untuk Jerawat?',
                'slug'         => 'kapan-harus-ke-dokter-kulit',
                'konten'       => 'Tidak semua jerawat bisa diatasi dengan skincare over-the-counter. Ketahui kapan kamu perlu berkonsultasi dengan dokter kulit.

**Tanda-tanda Kamu Perlu ke Dokter:**
1. Jerawat nodul atau kistik yang besar dan nyeri
2. Jerawat tidak membaik setelah 2-3 bulan perawatan mandiri
3. Jerawat meninggalkan bekas luka permanen
4. Jerawat mempengaruhi kepercayaan diri secara signifikan
5. Jerawat muncul tiba-tiba parah di usia dewasa

**Perawatan yang Tersedia di Dokter:**
- Antibiotik topikal atau oral
- Retinoid resep (tretinoin, adapalene)
- Isotretinoin (untuk kasus parah)
- Chemical peeling
- Injeksi kortikosteroid untuk nodul
- Laser treatment

**Tips Persiapan ke Dokter:**
- Foto dokumentasi kondisi jerawat
- Catat produk skincare yang sedang digunakan
- Informasikan obat-obatan yang sedang dikonsumsi
- Jelaskan riwayat jerawat dan perawatan sebelumnya

Ingat: dokter kulit adalah ahlinya. Jangan ragu untuk meminta bantuan profesional.',
                'kategori'     => 'edukasi',
                'is_published' => true,
            ],
        ];

        foreach ($articles as $article) {
            Article::create($article);
        }
    }
}