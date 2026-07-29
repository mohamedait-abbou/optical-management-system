<?php

namespace Database\Seeders;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\PurchaseOrder;
use App\Models\PurchaseOrderItem;
use App\Models\Supplier;
use Illuminate\Database\Seeder;

class SupplierPurchaseOrderSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Categories
        $categories = ['Montures', 'Verres', 'Lunettes de Soleil', 'Lentilles', 'Accessoires', 'Solutions'];
        foreach ($categories as $cat) {
            Category::firstOrCreate(['name' => $cat]);
        }

        // 2. Brands
        $brands = ['Ray-Ban', 'Oakley', 'Polaroid', 'Persol', 'Vogue', 'Carrera', 'Dior', 'Gucci', 'Prada', 'Arnette'];
        foreach ($brands as $brand) {
            Brand::firstOrCreate(['name' => $brand]);
        }

        // 3. Products (50)
        $categoryIds = Category::pluck('id')->toArray();
        $brandIds = Brand::pluck('id')->toArray();
        $productNames = [
            'Monture classique noire', 'Monture tortoise', 'Verres anti-lumière bleue',
            'Verres progressifs', 'Lunettes aviateur dorées', 'Lunettes wayfarer noires',
            'Lentilles journalières', 'Lentilles mensuelles', 'Étui rigide noir',
            'Chiffon microfiber', 'Solution nettoyante 200ml', 'Branches de rechange',
            'Monture ronde métal', 'Monture carrée rouge', 'Verres photochromiques',
            'Lunettes sport Oakley', 'Lunettes clubmaster', 'Lentilles toriques',
            'Solution multifonction 350ml', 'Gouttes hydratantes', 'Monture demi-cercle',
            'Monture papillon', 'Verres polarisants', 'Lunettes bouclier',
            'Étui souple bleu', 'Lanyard porte-lunettes', 'Kit de réparation',
            'Monture enfantine', 'Verres bifocaux', 'Lunettes rondes métal doré',
            'Lunettes carrées écaille', 'Monture transparente', 'Verres anti-rayures',
            'Lentilles colorées', 'Spray anti-buée', 'Monture oversize',
            'Monture geisha', 'Verres haute index', 'Lunettes cat-eye',
            'Clip-on solaire', 'Monture en acétate', 'Verres dégressifs',
            'Lunettes nautiques', 'Bande porte-lunettes', 'Monture titane',
            'Verres minéraux', 'Lunettes rectangulaires', 'Étui cuir marron',
            'Nez de rechange', 'Vis de rechange',
        ];
        foreach ($productNames as $name) {
            Product::firstOrCreate(
                ['name' => $name],
                [
                    'category_id' => fake()->randomElement($categoryIds),
                    'brand_id' => fake()->optional(0.7)->randomElement($brandIds),
                    'price' => fake()->randomFloat(2, 50, 2000),
                    'cost_price' => fake()->randomFloat(2, 20, 1000),
                    'quantity' => fake()->numberBetween(5, 150),
                    'alert_threshold' => fake()->numberBetween(2, 15),
                    'description' => fake()->optional(0.5)->sentence(),
                ]
            );
        }

        // 4. Suppliers (15)
        $suppliersData = [
            ['name' => 'Optique Distribution Maroc', 'contact_name' => 'Karim Benali'],
            ['name' => 'Lunetterie Méditerranée', 'contact_name' => 'Sophie Lefevre'],
            ['name' => 'Verres & Co Casablanca', 'contact_name' => 'Hassan Ouazzani'],
            ['name' => 'Solaris Import', 'contact_name' => 'Nadia Fassi'],
            ['name' => 'EuroLens France', 'contact_name' => 'Jean-Pierre Dubois'],
            ['name' => 'Vision Plus Rabat', 'contact_name' => 'Mohammed Alaoui'],
            ['name' => 'OptiTech Solutions', 'contact_name' => 'Youssef El Amrani'],
            ['name' => 'Lentilles Direct', 'contact_name' => 'Fatima Zahra'],
            ['name' => 'Montures du Monde', 'contact_name' => 'Pierre Moreau'],
            ['name' => 'DistriOptique Tanger', 'contact_name' => 'Hicham Bennani'],
            ['name' => 'SunGlass Pro', 'contact_name' => 'Amine Chraibi'],
            ['name' => 'Optica Italia', 'contact_name' => 'Marco Rossi'],
            ['name' => 'Lunettes Premium', 'contact_name' => 'Salma Bennis'],
            ['name' => 'Accessoires Optiques', 'contact_name' => 'Omar Kadiri'],
            ['name' => 'Vision 2000 Marrakech', 'contact_name' => 'Imane El Bakkali'],
        ];

        foreach ($suppliersData as $index => $data) {
            Supplier::firstOrCreate(
                ['name' => $data['name']],
                [
                    'contact_name' => $data['contact_name'],
                    'email' => strtolower(str_replace(' ', '', fake()->unique()->userName())).'@'.fake()->freeEmailDomain(),
                    'phone' => '0'.fake()->numerify('6########'),
                    'address' => fake()->streetAddress().', '.fake()->city(),
                    'notes' => $index % 3 === 0 ? 'Fournisseur principal' : null,
                ]
            );
        }

        // 5. Purchase Orders (25)
        $supplierIds = Supplier::pluck('id')->toArray();
        $productIds = Product::pluck('id')->toArray();
        $statuses = ['pending', 'pending', 'pending', 'received', 'received'];

        for ($i = 0; $i < 25; $i++) {
            $orderDate = fake()->dateTimeBetween('-3 months', 'now');
            $status = fake()->randomElement($statuses);
            $expectedDate = $status === 'received'
                ? fake()->dateTimeBetween($orderDate, 'now')
                : fake()->optional(0.6)->dateTimeBetween('now', '+2 months');

            $order = PurchaseOrder::create([
                'supplier_id' => fake()->randomElement($supplierIds),
                'order_number' => 'PO-'.$orderDate->format('Ymd').'-'.str_pad(fake()->unique()->randomNumber(4), 4, '0', STR_PAD_LEFT),
                'order_date' => $orderDate,
                'expected_date' => $expectedDate,
                'status' => $status,
                'total_amount' => 0,
                'notes' => fake()->optional(0.4)->sentence(),
            ]);

            // Items (1-4 per order)
            $itemsCount = fake()->numberBetween(1, 4);
            $total = 0;
            $usedProductIds = [];
            for ($j = 0; $j < $itemsCount; $j++) {
                $productId = fake()->randomElement($productIds);
                while (in_array($productId, $usedProductIds)) {
                    $productId = fake()->randomElement($productIds);
                }
                $usedProductIds[] = $productId;

                $quantity = fake()->numberBetween(5, 60);
                $unitCost = fake()->randomFloat(2, 15, 400);
                $subtotal = round($quantity * $unitCost, 2);
                $total += $subtotal;

                PurchaseOrderItem::create([
                    'purchase_order_id' => $order->id,
                    'product_id' => $productId,
                    'quantity' => $quantity,
                    'unit_cost' => $unitCost,
                    'subtotal' => $subtotal,
                ]);
            }
            $order->update(['total_amount' => round($total, 2)]);
        }
    }
}
