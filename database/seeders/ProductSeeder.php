<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $products = [
            // Sản phẩm thuộc danh mục Pizza
            [
                'name' => 'Pizza Hải Sản',
                'slug' => 'seafood-pizza',
                'thumb_image' => 'https://png.pngtree.com/png-vector/20240124/ourmid/pngtree-seafood-pizza-with-shrimp-squid-shellfish-png-image_11484457.png',
                'category_id' => 1, // ID của danh mục Pizza
                'view' => 100,
                'short_description' => 'Pizza với topping hải sản tươi ngon.',
                'long_description' => 'Pizza Hải Sản với phô mai béo ngậy, hải sản tươi, rau củ giòn và đế bánh giòn rụm.',
                'price' => 199000,
                'offer_price' => 179000,
                'qty' => 50,
                'sku' => 'PIZZA001',
                'show_at_home' => 1,
                'status' => 1
            ],
            [
                'name' => 'Pizza Phô Mai',
                'slug' => 'cheese-pizza',
                'thumb_image' => 'https://static.vecteezy.com/system/resources/thumbnails/041/326/141/small_2x/ai-generated-cheese-pizza-isolated-on-transparent-background-png.png',
                'category_id' => 1,
                'view' => 80,
                'short_description' => 'Pizza với nhiều lớp phô mai.',
                'long_description' => 'Pizza Phô Mai với các lớp phô mai tan chảy và đế bánh thơm ngon.',
                'price' => 159000,
                'offer_price' => 139000,
                'qty' => 30,
                'sku' => 'PIZZA002',
                'show_at_home' => 1,
                'status' => 1
            ],
            [
                'name' => 'Pizza Thịt Bò',
                'slug' => 'beef-pizza',
                'thumb_image' => 'https://png.pngtree.com/png-clipart/20210926/ourlarge/pngtree-beef-delight-pizza-png-image_3958016.png',
                'category_id' => 1,
                'view' => 120,
                'short_description' => 'Pizza với thịt bò thơm ngon.',
                'long_description' => 'Pizza Thịt Bò cùng với các nguyên liệu tươi ngon và nước sốt đậm đà.',
                'price' => 179000,
                'offer_price' => 159000,
                'qty' => 40,
                'sku' => 'PIZZA003',
                'show_at_home' => 1,
                'status' => 1
            ],

            // Sản phẩm thuộc danh mục Nước uống
            [
                'name' => 'Coca-Cola',
                'slug' => 'coca-cola',
                'thumb_image' => 'https://w7.pngwing.com/pngs/742/816/png-transparent-coke-coke-drink-soft-drink-thumbnail.png',
                'category_id' => 2, // ID của danh mục Nước uống
                'view' => 200,
                'short_description' => 'Nước giải khát có ga.',
                'long_description' => 'Coca-Cola, nước giải khát có ga, sảng khoái cho mọi bữa ăn.',
                'price' => 15000,
                'offer_price' => 13000,
                'qty' => 200,
                'sku' => 'DRINK001',
                'show_at_home' => 1,
                'status' => 1
            ],
            [
                'name' => 'Pepsi',
                'slug' => 'pepsi',
                'thumb_image' => 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcS3mLSN2iLluwNwOfEV0hVCRCzd1jqQRI0PyQ&s',
                'category_id' => 2,
                'view' => 180,
                'short_description' => 'Nước giải khát có ga mát lạnh.',
                'long_description' => 'Pepsi, hương vị tuyệt vời, mát lạnh, sảng khoái.',
                'price' => 14000,
                'offer_price' => 12000,
                'qty' => 150,
                'sku' => 'DRINK002',
                'show_at_home' => 1,
                'status' => 1
            ],
            [
                'name' => 'Nước Cam Ép',
                'slug' => 'fresh-orange-juice',
                'thumb_image' => 'https://w7.pngwing.com/pngs/767/129/png-transparent-orange-juice-breakfast-juicer-juice-food-breakfast-citrus-thumbnail.png',
                'category_id' => 2,
                'view' => 90,
                'short_description' => 'Nước cam tươi mát.',
                'long_description' => 'Nước cam ép từ cam tươi, giàu vitamin C, giúp bổ sung năng lượng.',
                'price' => 25000,
                'offer_price' => 20000,
                'qty' => 80,
                'sku' => 'DRINK003',
                'show_at_home' => 1,
                'status' => 1
            ],

            // Sản phẩm thuộc danh mục Món khai vị
            [
                'name' => 'Phô Mai Que',
                'slug' => 'cheese-sticks',
                'thumb_image' => 'https://img.freepik.com/premium-psd/mozzarella-sticks-png-image-transparent-background_1022554-34.jpg',
                'category_id' => 3, // ID của danh mục Món khai vị
                'view' => 50,
                'short_description' => 'Phô mai chiên giòn.',
                'long_description' => 'Những que phô mai chiên giòn với lớp vỏ ngoài giòn tan, bên trong phô mai tan chảy.',
                'price' => 35000,
                'offer_price' => 30000,
                'qty' => 60,
                'sku' => 'STARTER001',
                'show_at_home' => 1,
                'status' => 1
            ],
            [
                'name' => 'Bánh Mì Bơ Tỏi',
                'slug' => 'garlic-bread',
                'thumb_image' => 'https://w7.pngwing.com/pngs/732/341/png-transparent-pizza-garlic-bread-barbecue-sauce-cheese-pan-food-recipe-bread.png',
                'category_id' => 3,
                'view' => 70,
                'short_description' => 'Bánh mì thơm ngon.',
                'long_description' => 'Bánh mì bơ tỏi, thơm lừng với bơ và tỏi, giòn rụm khi thưởng thức.',
                'price' => 30000,
                'offer_price' => 25000,
                'qty' => 100,
                'sku' => 'STARTER002',
                'show_at_home' => 1,
                'status' => 1
            ],
            [
                'name' => 'Salad Caesar',
                'slug' => 'caesar-salad',
                'thumb_image' => 'https://images.rawpixel.com/image_png_800/cHJpdmF0ZS9sci9pbWFnZXMvd2Vic2l0ZS8yMDI0LTAzL2ZyZWVpbWFnZXNjb21wYW55X3RvcF9kb3duX3Bob3RvX29mX2FfY2VzYXJfc2FsYWRfaXNvbGF0ZWRfb25fd18zYWMwODZhNS00MWZhLTQwNTctYmY4Zi0zNDQyMjZhMjg4MjEucG5n.png',
                'category_id' => 3,
                'view' => 40,
                'short_description' => 'Salad rau xanh tươi ngon.',
                'long_description' => 'Salad Caesar với rau xanh, gà, phô mai, và nước sốt đặc biệt.',
                'price' => 45000,
                'offer_price' => 40000,
                'qty' => 50,
                'sku' => 'STARTER003',
                'show_at_home' => 1,
                'status' => 1
            ],

            // Sản phẩm thuộc danh mục Món tráng miệng
            [
                'name' => 'Tiramisu',
                'slug' => 'tiramisu',
                'thumb_image' => 'https://png.pngtree.com/png-vector/20230902/ourmid/pngtree-tiramisu-cake-isolated-png-image_9242463.png',
                'category_id' => 4, // ID của danh mục Món tráng miệng
                'view' => 100,
                'short_description' => 'Món tráng miệng Ý nổi tiếng.',
                'long_description' => 'Tiramisu với hương vị cà phê đặc trưng, lớp kem mềm mịn.',
                'price' => 60000,
                'offer_price' => 55000,
                'qty' => 30,
                'sku' => 'DESSERT001',
                'show_at_home' => 1,
                'status' => 1
            ],
            [
                'name' => 'Bánh Flan',
                'slug' => 'flan-cake',
                'thumb_image' => 'https://img.lovepik.com/free-png/20220304/lovepik-sweet-and-delicious-cold-cake-png-image_wh1200.png',
                'category_id' => 4,
                'view' => 85,
                'short_description' => 'Bánh mềm mịn, ngọt ngào.',
                'long_description' => 'Bánh Flan được làm từ trứng, sữa, và caramel, hương vị béo ngậy.',
                'price' => 30000,
                'offer_price' => 25000,
                'qty' => 70,
                'sku' => 'DESSERT002',
                'show_at_home' => 1,
                'status' => 1
            ],
            [
                'name' => 'Kem Vanilla',
                'slug' => 'vanilla-ice-cream',
                'thumb_image' => 'https://png.pngtree.com/png-vector/20240318/ourlarge/pngtree-vanilla-beige-vanilla-flavored-ice-cream-with-chocolate-and-sprinkles-png-image_12005994.png',
                'category_id' => 4,
                'view' => 120,
                'short_description' => 'Kem lạnh mát, hương vanilla.',
                'long_description' => 'Kem Vanilla với hương vị ngọt ngào, mát lạnh, tan chảy trong miệng.',
                'price' => 40000,
                'offer_price' => 35000,
                'qty' => 60,
                'sku' => 'DESSERT003',
                'show_at_home' => 1,
                'status' => 1
            ],

            // Sản phẩm thuộc danh mục Combo
            [
                'name' => 'Combo Gia Đình',
                'slug' => 'family-combo',
                'thumb_image' => 'https://5.imimg.com/data5/VE/GG/MY-53040683/combo-for-family-28just-499-2f-29.jpg',
                'category_id' => 5, // ID của danh mục Combo
                'view' => 150,
                'short_description' => 'Combo dành cho gia đình.',
                'long_description' => 'Combo bao gồm 2 pizza, nước uống và món tráng miệng cho gia đình.',
                'price' => 399000,
                'offer_price' => 359000,
                'qty' => 20,
                'sku' => 'COMBO001',
                'show_at_home' => 1,
                'status' => 1
            ],
            [
                'name' => 'Combo Nhóm Bạn',
                'slug' => 'friends-combo',
                'thumb_image' => 'https://e7.pngegg.com/pngimages/236/921/png-clipart-sicilian-pizza-buffalo-wing-pizza-margherita-fast-food-pizza-food-cheese.png',
                'category_id' => 5,
                'view' => 200,
                'short_description' => 'Combo cho nhóm bạn.',
                'long_description' => 'Combo gồm 3 pizza, nước uống và món khai vị cho nhóm bạn.',
                'price' => 499000,
                'offer_price' => 459000,
                'qty' => 15,
                'sku' => 'COMBO002',
                'show_at_home' => 1,
                'status' => 1
            ],
            [
                'name' => 'Combo Đặc Biệt',
                'slug' => 'special-combo',
                'thumb_image' => 'https://thepizzacompany.vn/images/thumbs/000/0003604_combo-tet-la-sum-vay_500.png',
                'category_id' => 5,
                'view' => 250,
                'short_description' => 'Combo đặc biệt theo mùa.',
                'long_description' => 'Combo đặc biệt với nhiều món ăn hấp dẫn và khuyến mãi theo mùa.',
                'price' => 599000,
                'offer_price' => 549000,
                'qty' => 10,
                'sku' => 'COMBO003',
                'show_at_home' => 1,
                'status' => 1
            ],
        ];

        foreach ($products as $product) {
            Product::create($product);
        }
    }
}
