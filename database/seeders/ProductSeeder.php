<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        Product::query()->delete();

        $products = [
            // Komedo
            [
                'nama'         => 'Salicylic Acid 2% BHA',
                'merek'        => 'Some By Mi',
                'kategori'     => 'toner',
                'deskripsi'    => 'Toner eksfoliasi dengan BHA 2% untuk membersihkan pori tersumbat dan komedo secara efektif.',
                'harga'        => 89000,
                'jenis_jerawat'=> json_encode(['komedo']),
                'is_active'    => true,
            ],
            [
                'nama'         => 'BHA Blackhead Power Liquid',
                'merek'        => 'COSRX',
                'kategori'     => 'toner',
                'deskripsi'    => 'Liquid eksfoliasi dengan 4% betaine salicylate untuk mengangkat komedo hitam dan putih.',
                'harga'        => 145000,
                'jenis_jerawat'=> json_encode(['komedo']),
                'is_active'    => true,
            ],
            [
                'nama'         => 'Retinol 0.1% Serum',
                'merek'        => 'The Ordinary',
                'kategori'     => 'serum',
                'deskripsi'    => 'Serum retinol konsentrasi rendah untuk pemula, membantu mengecilkan pori dan mencegah komedo.',
                'harga'        => 120000,
                'jenis_jerawat'=> json_encode(['komedo']),
                'is_active'    => true,
            ],
            // Papula
            [
                'nama'         => 'Niacinamide 10% + Zinc 1%',
                'merek'        => 'The Ordinary',
                'kategori'     => 'serum',
                'deskripsi'    => 'Serum niacinamide untuk mengurangi kemerahan, mengontrol sebum, dan menenangkan papula.',
                'harga'        => 95000,
                'jenis_jerawat'=> json_encode(['papula','pustula']),
                'is_active'    => true,
            ],
            [
                'nama'         => 'AC Collection Blemish Spot Cream',
                'merek'        => 'Some By Mi',
                'kategori'     => 'spot_treatment',
                'deskripsi'    => 'Spot treatment untuk menenangkan benjolan merah papula dan mengurangi inflamasi.',
                'harga'        => 75000,
                'jenis_jerawat'=> json_encode(['papula']),
                'is_active'    => true,
            ],
            [
                'nama'         => 'Centella Asiatica Serum',
                'merek'        => 'Somethinc',
                'kategori'     => 'serum',
                'deskripsi'    => 'Serum centella untuk menenangkan kulit meradang dan mempercepat penyembuhan papula.',
                'harga'        => 89000,
                'jenis_jerawat'=> json_encode(['papula']),
                'is_active'    => true,
            ],
            // Pustula
            [
                'nama'         => 'Benzoyl Peroxide 5% Gel',
                'merek'        => 'Benzolac',
                'kategori'     => 'spot_treatment',
                'deskripsi'    => 'Gel spot treatment dengan benzoyl peroxide 5% untuk membasmi bakteri penyebab pustula.',
                'harga'        => 35000,
                'jenis_jerawat'=> json_encode(['pustula']),
                'is_active'    => true,
            ],
            [
                'nama'         => 'AHA 30% + BHA 2% Peeling Solution',
                'merek'        => 'The Ordinary',
                'kategori'     => 'mask',
                'deskripsi'    => 'Peeling solution untuk eksfoliasi mendalam dan membantu mengeringkan pustula.',
                'harga'        => 135000,
                'jenis_jerawat'=> json_encode(['pustula','komedo']),
                'is_active'    => true,
            ],
            // Nodul
            [
                'nama'         => 'Acne Patch Hydrocolloid',
                'merek'        => 'COSRX',
                'kategori'     => 'spot_treatment',
                'deskripsi'    => 'Patch hydrocolloid untuk melindungi nodul dari kontaminasi dan menyerap cairan inflamasi.',
                'harga'        => 55000,
                'jenis_jerawat'=> json_encode(['nodul','pustula']),
                'is_active'    => true,
            ],
            [
                'nama'         => 'Gentle Cleanser for Acne',
                'merek'        => 'CeraVe',
                'kategori'     => 'cleanser',
                'deskripsi'    => 'Pembersih wajah lembut dengan ceramide untuk kulit berjerawat parah, tidak mengiritasi.',
                'harga'        => 185000,
                'jenis_jerawat'=> json_encode(['nodul','papula','pustula']),
                'is_active'    => true,
            ],
            [
                'nama'         => 'SPF 50 PA++++ Sunscreen',
                'merek'        => 'Skin1004',
                'kategori'     => 'sunscreen',
                'deskripsi'    => 'Sunscreen ringan non-comedogenic untuk melindungi kulit berjerawat dari paparan UV.',
                'harga'        => 165000,
                'jenis_jerawat'=> json_encode(['komedo','papula','pustula','nodul']),
                'is_active'    => true,
            ],
        ];

        foreach ($products as $p) {
            Product::create($p);
        }
    }
}