<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use RuntimeException;

class ProductImageFixSeeder extends Seeder
{
    /**
     * Run the database seeds to fix product images (main_image and gallery_images)
     * using unique product codes.
     */
    public function run(): void
    {
        $mappings = [
            [
                'code' => 'ZRB-PLE-001',
                'name' => 'Kirana Pleats',
                'main_image' => 'uploads/products/MYczA6dhyBqmmcGDvvG9dKnaeQSRfXOV6lCfv0Pd.jpeg',
                'gallery_images' => [
                    'uploads/products/MYczA6dhyBqmmcGDvvG9dKnaeQSRfXOV6lCfv0Pd.jpeg',
                    'uploads/products/HW3FMQsYCvrVJRlWovsmN1jIbgtIeYStsptjuj7Q.jpeg',
                ],
            ],
            [
                'code' => 'ZRB-PLE-002',
                'name' => 'Nara Pleats',
                'main_image' => 'uploads/products/5Ndqhegh0PsyX0ujVCDWYbzaeDr2ffpvP5fZpUVa.jpg',
                'gallery_images' => [
                    'uploads/products/5Ndqhegh0PsyX0ujVCDWYbzaeDr2ffpvP5fZpUVa.jpg',
                    'uploads/products/c82bPu71gx1bynrF8UUvSOBU45AfBRnoFRjwi7H8.jpeg',
                ],
            ],
            [
                'code' => 'ZRB-PLE-003',
                'name' => 'Sena Pleats',
                'main_image' => 'uploads/products/GdpoaZEUzOO7OM62x6mw9tbiSx11pMUinwYRn5lU.jpeg',
                'gallery_images' => [
                    'uploads/products/GdpoaZEUzOO7OM62x6mw9tbiSx11pMUinwYRn5lU.jpeg',
                    'uploads/products/5aB720V8wJQ1Q9Fom8gUY2YObWVsx4DPJzSH9GC6.jpeg',
                ],
            ],
            [
                'code' => 'ZRB-PLE-004',
                'name' => 'Pink Bella Pleats',
                'main_image' => 'uploads/products/yT5ny6ImFV2oMs6PayFM7ju9PJA4QeuKAP5DQF1q.jpeg',
                'gallery_images' => [
                    'uploads/products/yT5ny6ImFV2oMs6PayFM7ju9PJA4QeuKAP5DQF1q.jpeg',
                ],
            ],
            [
                'code' => 'ZRB-PLE-005',
                'name' => 'Polkadot Pleats',
                'main_image' => 'uploads/products/tQ9r3xyoP1GiAQKMVpjjynzTowJM481pC05BiUUY.jpeg',
                'gallery_images' => [
                    'uploads/products/tQ9r3xyoP1GiAQKMVpjjynzTowJM481pC05BiUUY.jpeg',
                ],
            ],
            [
                'code' => 'ZRB-PLE-006',
                'name' => 'Luna Pleats',
                'main_image' => 'uploads/products/IMPEUV4od0kvPJ1ekNXPMM7ZNWhtoeCz9u4BSxr3.jpeg',
                'gallery_images' => [
                    'uploads/products/IMPEUV4od0kvPJ1ekNXPMM7ZNWhtoeCz9u4BSxr3.jpeg',
                ],
            ],
            [
                'code' => 'ZRB-PLE-007',
                'name' => 'Cita pleats',
                'main_image' => 'uploads/products/JSZWbApwTmasckNGzeHbhEb0pZjBkrEy0UZBtWD8.jpeg',
                'gallery_images' => [
                    'uploads/products/JSZWbApwTmasckNGzeHbhEb0pZjBkrEy0UZBtWD8.jpeg',
                ],
            ],
            [
                'code' => 'ZRB-PLE-008',
                'name' => 'Mahogany Pleats',
                'main_image' => 'uploads/products/HPpzhEmYJYaRgH5yNSAJvgajfRghWeZoH1AoOcrC.jpeg',
                'gallery_images' => [
                    'uploads/products/HPpzhEmYJYaRgH5yNSAJvgajfRghWeZoH1AoOcrC.jpeg',
                ],
            ],
            [
                'code' => 'ZRB-PLE-009',
                'name' => 'Artic Pleats',
                'main_image' => 'uploads/products/fBLqpmPk5avh7XCXPUg8OTpF5421nt5h8g1WdQGd.jpeg',
                'gallery_images' => [
                    'uploads/products/fBLqpmPk5avh7XCXPUg8OTpF5421nt5h8g1WdQGd.jpeg',
                    'uploads/products/vLP2VGic3CChCgqSNH9Kb4IotIUmqnHv2jJhPgZQ.jpeg',
                ],
            ],
            [
                'code' => 'ZRB-PLE-010',
                'name' => 'Matcha Pleats',
                'main_image' => 'uploads/products/CpX4WqCej7803Q9W0Tq1lfPKrMTRFXlbTSMDRfE2.jpeg',
                'gallery_images' => [
                    'uploads/products/CpX4WqCej7803Q9W0Tq1lfPKrMTRFXlbTSMDRfE2.jpeg',
                ],
            ],
        ];

        // 1. Verifikasi ketersediaan seluruh 10 product code sebelum melakukan update
        $requiredCodes = array_column($mappings, 'code');
        $existingProducts = Product::whereIn('code', $requiredCodes)->get()->keyBy('code');
        $missingCodes = array_diff($requiredCodes, $existingProducts->keys()->all());

        if (!empty($missingCodes)) {
            $missingList = implode(', ', $missingCodes);
            if ($this->command) {
                $this->command->error("Update dibatalkan! Produk dengan code berikut tidak ditemukan di database: {$missingList}");
            }
            throw new RuntimeException("Update dibatalkan! Seluruh 10 product code harus tersedia sebelum update dilakukan. Kode tidak ditemukan: {$missingList}");
        }

        // 2. Jalankan update dalam DB Transaction (atomic)
        DB::transaction(function () use ($mappings, $existingProducts) {
            foreach ($mappings as $item) {
                $product = $existingProducts->get($item['code']);

                // Perbarui HANYA kolom main_image dan gallery_images berdasarkan product code
                $product->main_image = $item['main_image'];
                $product->gallery_images = $item['gallery_images'];
                $product->save();

                if ($this->command) {
                    $this->command->info("Updated images for: [{$product->code}] {$product->name}");
                }
            }
        });

        if ($this->command) {
            $this->command->info("Sukses! Seluruh 10 produk berhasil diperbarui menggunakan DB transaction tanpa mengubah atribut lainnya.");
        }
    }
}
