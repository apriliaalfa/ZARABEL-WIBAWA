<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Payment;
use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database with complete template data.
     */
    public function run(): void
    {
        // 1. DATA USER (Customer & Admin)
        $admin = User::updateOrCreate(
            ['email' => 'admin@zarabel.com'],
            [
                'name' => 'Administrator Zarabel',
                'phone' => '081298765432',
                'role' => 'admin',
                'password' => 'Password123!',
                'email_verified_at' => now(),
            ]
        );

        $customer = User::updateOrCreate(
            ['email' => 'sarah@zarabel.com'],
            [
                'name' => 'Sarah Amberi',
                'phone' => '081234567890',
                'role' => 'customer',
                'address' => 'Jl. Kebaya Indah No. 18, Jakarta Selatan',
                'password' => 'Password123!',
                'email_verified_at' => now(),
            ]
        );

        // 2. DATA KATEGORI (5 Kategori: Pleats, Pashmina, Shirt, Outer, Dress)
        $categoriesData = [
            ['name' => 'Pleats', 'slug' => 'pleats', 'image' => 'assets/img/cat1.jpg', 'description' => 'Koleksi busana lipit artistik khas Zarabel'],
            ['name' => 'Pashmina', 'slug' => 'pashmina', 'image' => 'assets/img/cat2.jpg', 'description' => 'Pashmina bermotif mewah nan lembut'],
            ['name' => 'Shirt', 'slug' => 'shirt', 'image' => 'assets/img/cat3.jpg', 'description' => 'Kemeja dan atasan elegan untuk tampilan formal & casual'],
            ['name' => 'Outer', 'slug' => 'outer', 'image' => 'assets/img/cat4.jpg', 'description' => 'Outerwear dan cardigan berkelas untuk segala acara'],
            ['name' => 'Dress', 'slug' => 'dress', 'image' => 'assets/img/cat5.jpg', 'description' => 'Gaun pesta dan busana formal bernuansa kemewahan'],
        ];

        $categories = [];
        foreach ($categoriesData as $c) {
            $categories[$c['slug']] = Category::updateOrCreate(['slug' => $c['slug']], $c);
        }

        // 3. DATA PRODUK LENGKAP DENGAN KODE BARANG, FOTO, DESKRIPSI & INFO TAMBAHAN
        $productsData = [
            [
                'code' => 'ZRB-TOP-001',
                'name' => 'White casual t-shirt',
                'slug' => 'white-casual-t-shirt',
                'category_id' => $categories['pleats']->id ?? null,
                'category_name' => 'Pleats',
                'price' => 100000,
                'discount_price' => 200000,
                'stock' => 9,
                'main_image' => 'assets/img/bg35.png',
                'gallery_images' => [
                    'assets/img/bg35.png',
                    'assets/img/bg36.png',
                    'assets/img/bg37.png',
                    'assets/img/bg38.png',
                    'assets/img/bg39.png',
                ],
                'short_description' => 'The CELIA Shirt is made from premium cotton that is soft, lightweight, and exceptionally comfortable for everyday wear.',
                'description' => "Celia Shirt - Premium Cotton Material\n\nThe CELIA Shirt is made from premium cotton that is soft, lightweight, and exceptionally comfortable for everyday wear. This breathable cotton fabric absorbs moisture well, feels cool on the skin, and has a smooth, neat drape.\n\nSize Chart:\nBust: 120 cm\nUpper Arm: 50 cm\nLength: 68 cm\nSleeve Length: 51 cm",
                'additional_information' => "Perfect For:\n- Comfortable and effortless daily outfits\n- Work or meetings, thanks to its clean and polished look\n- Hangouts, casual dinners, or brunch\n- Hotel/travel scenes such as gatherings or office activities\n\nCare Instructions:\nMachine washable at low temperature. Iron on medium heat. Avoid bleach.",
                'sizes' => ['xxs', 'xs', 's', 'm', 'l', 'xl'],
                'rating' => 4.95,
                'reviews_count' => 5,
                'is_active' => true,
            ],
            [
                'code' => 'ZRB-KBY-001',
                'name' => 'Zarabel Royal Kebaya Gold',
                'slug' => 'zarabel-royal-kebaya-gold',
                'category_id' => $categories['dress']->id ?? null,
                'category_name' => 'Dress',
                'price' => 2450000,
                'discount_price' => 2800000,
                'stock' => 5,
                'main_image' => 'assets/img/d6b1e.png',
                'gallery_images' => ['assets/img/d6b1e.png'],
                'short_description' => 'Sentuhan klasik warisan nusantara dengan detail bordir benang emas dan kristal Swarovski.',
                'description' => "Zarabel Royal Kebaya Gold menghadirkan perpaduan keanggunan siluet kebaya kartini dengan sentuhan modern mewah berbahan lace perancis bordir tangan emas.",
                'additional_information' => "Bahan: French Lace & Silk Organza\nUkuran Tersedia: S, M, L, Custom Fitting\nDry Clean Only.",
                'sizes' => ['s', 'm', 'l', 'xl'],
                'rating' => 5.00,
                'reviews_count' => 12,
                'is_active' => true,
            ],
            [
                'code' => 'ZRB-GWN-001',
                'name' => 'Emerald Grace Silk Gown',
                'slug' => 'emerald-grace-silk-gown',
                'category_id' => $categories['dress']->id ?? null,
                'category_name' => 'Dress',
                'price' => 3100000,
                'discount_price' => null,
                'stock' => 4,
                'main_image' => 'assets/img/f33d5.png',
                'gallery_images' => ['assets/img/f33d5.png'],
                'short_description' => 'Gaun malam sutra kontemporer berwarna zamrud dengan drape flowy yang memukau.',
                'description' => "Dibuat dari 100% Sutra Dobi Makassar dengan kilau mewah alami, sangat cocok untuk resepsi malam hari dan gala dinner formal.",
                'additional_information' => "Bahan: Pure Dobi Silk\nWarna: Emerald Green\nPerawatan: Khusus Dry Clean.",
                'sizes' => ['xs', 's', 'm', 'l'],
                'rating' => 4.90,
                'reviews_count' => 8,
                'is_active' => true,
            ],
            [
                'code' => 'ZRB-ABY-001',
                'name' => 'Zarabel Modest Abaya Beige',
                'slug' => 'zarabel-modest-abaya-beige',
                'category_id' => $categories['outer']->id ?? null,
                'category_name' => 'Outer',
                'price' => 750000,
                'discount_price' => 950000,
                'stock' => 15,
                'main_image' => 'assets/img/88c06.png',
                'gallery_images' => ['assets/img/88c06.png'],
                'short_description' => 'Abaya minimalis warna beige hangat dengan bahan crinkle premium yang tidak mudah kusut.',
                'description' => "Zarabel Modest Abaya Beige memberikan tampilan bersahaja yang tetap mewah dan anggun. Potongan longgar wudhu-friendly dengan kancing tersembunyi.",
                'additional_information' => "Material: Premium Crinkle Airflow\nUkuran: All Size fit to XL (LD 120cm, PB 140cm).",
                'sizes' => ['s', 'm', 'l', 'xl', 'xxl'],
                'rating' => 4.88,
                'reviews_count' => 16,
                'is_active' => true,
            ],
            [
                'code' => 'ZRB-HJB-001',
                'name' => 'Elegant Floral Hijab Silk',
                'slug' => 'elegant-floral-hijab-silk',
                'category_id' => $categories['pashmina']->id ?? null,
                'category_name' => 'Pashmina',
                'price' => 250000,
                'discount_price' => 300000,
                'stock' => 30,
                'main_image' => 'assets/img/4d82e.png',
                'gallery_images' => ['assets/img/4d82e.png'],
                'short_description' => 'Hijab segi empat motif floral khas batik modern dengan bahan voal silk premium.',
                'description' => "Tegak di dahi, mudah dibentuk, tidak kedap di telinga, dan memiliki kilau satin lembut yang tidak licin saat dikenakan.",
                'additional_information' => "Ukuran: 115 x 115 cm\nFinishing: Laser Cut Presisi.",
                'sizes' => ['All Size'],
                'rating' => 4.96,
                'reviews_count' => 24,
                'is_active' => true,
            ],
        ];

        foreach ($productsData as $prod) {
            Product::updateOrCreate(['code' => $prod['code']], $prod);
        }

        // 4. CONTOH DATA TRANSAKSI (ORDER & PAYMENT)
        $order = Order::updateOrCreate(
            ['order_number' => 'ZRB-202611-0001'],
            [
                'user_id' => $customer->id,
                'customer_name' => 'Sarah Amberi',
                'customer_email' => 'sarah@zarabel.com',
                'customer_phone' => '081234567890',
                'shipping_address' => 'Jl. Kebaya Indah No. 18, Jakarta Selatan 12340',
                'courier' => 'JNE Express (Reguler)',
                'shipping_cost' => 20000,
                'subtotal' => 200000,
                'discount' => 50000,
                'total_amount' => 170000,
                'notes' => 'Tolong diperiksa kembali kancing cadangannya ya.',
                'status' => 'paid',
            ]
        );

        OrderItem::updateOrCreate(
            [
                'order_id' => $order->id,
                'product_code' => 'ZRB-TOP-001',
            ],
            [
                'product_name' => 'White casual t-shirt',
                'product_image' => 'assets/img/bg35.png',
                'price' => 100000,
                'quantity' => 2,
                'size' => 'M',
                'notes' => 'Please recheck the size before send to me :)',
                'subtotal' => 200000,
            ]
        );

        Payment::updateOrCreate(
            ['order_id' => $order->id],
            [
                'payment_method' => 'bank_transfer',
                'payment_channel' => 'BCA Virtual Account',
                'account_number' => '8271081234567890',
                'amount' => 170000,
                'payment_status' => 'paid',
                'paid_at' => now(),
                'verified_at' => now(),
            ]
        );
    }
}
