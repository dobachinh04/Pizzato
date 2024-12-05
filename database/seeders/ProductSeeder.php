<?php

namespace Database\Seeders;

use App\Models\Category;
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
        // Lấy danh sách category_id có sẵn trong bảng categories
        $categoryIds = Category::pluck('id')->toArray();
        $products = [
            // Sản phẩm thuộc danh mục Pizza
            [
                'name' => 'Margherita Pizza',
                'slug' => 'margherita-pizza',
                'thumb_image' => 'https://media.istockphoto.com/id/1168754685/photo/pizza-margarita-with-cheese-top-view-isolated-on-white-background.jpg?s=612x612&w=0&k=20&c=psLRwd-hX9R-S_iYU-sihB4Jx2aUlUr26fkVrxGDfNg=',
                'category_id' => 1,
                'view' => 100,
                'short_description' => 'Pizza đơn giản với phô mai và cà chua.',
                'long_description' => 'Margherita Pizza với phô mai mozzarella và sốt cà chua tươi.',
                'price' => 150000,
                'offer_price' => 130000,
                'qty' => 30,
                'sku' => 'PIZZA001',
                'show_at_home' => 1,
                'status' => 1
            ],
            [
                'name' => 'Quattro Formaggi Pizza',
                'slug' => 'quattro-formaggi',
                'thumb_image' => 'https://img.freepik.com/premium-photo/quattro-formaggi-italian-pizza-with-four-sorts-cheese-isolated-white-background-mozzarella-blue-cheese-chedder-parmesan-top-view_136401-3860.jpg?w=360',
                'category_id' => 1,
                'view' => 80,
                'short_description' => 'Pizza với bốn loại phô mai.',
                'long_description' => 'Quattro Formaggi bao gồm mozzarella, parmesan, gorgonzola và fontina.',
                'price' => 170000,
                'offer_price' => 150000,
                'qty' => 25,
                'sku' => 'PIZZA002',
                'show_at_home' => 1,
                'status' => 1
            ],
            [
                'name' => 'Capricciosa Pizza',
                'slug' => 'capricciosa-pizza',
                'thumb_image' => 'https://img.freepik.com/premium-photo/fresh-tasty-capricciosa-pizza-with-mozzarella-cheese-tomatoes-ham-champignons-isolated-white-background_136401-4314.jpg',
                'category_id' => 1,
                'view' => 90,
                'short_description' => 'Pizza với giăm bông, nấm, và ô liu.',
                'long_description' => 'Capricciosa kết hợp giăm bông, nấm, ô liu và sốt cà chua.',
                'price' => 180000,
                'offer_price' => 160000,
                'qty' => 35,
                'sku' => 'PIZZA003',
                'show_at_home' => 1,
                'status' => 1
            ],
            [
                'name' => 'Pizza Rau Củ',
                'slug' => 'veggie-pizza',
                'thumb_image' => 'https://media.istockphoto.com/id/621596750/photo/delicious-vegetarian-pizza-isolated.jpg?s=612x612&w=0&k=20&c=0TG4ldjDswZmBgno8Pifsbnxxh8bJO3hW_bT23-UPwQ=',
                'category_id' => 1,
                'view' => 110,
                'short_description' => 'Pizza với rau củ tươi ngon.',
                'long_description' => 'Veggie Pizza với cà chua, ớt chuông, hành tây và ô liu.',
                'price' => 160000,
                'offer_price' => 140000,
                'qty' => 40,
                'sku' => 'PIZZA004',
                'show_at_home' => 1,
                'status' => 1
            ],
            [
                'name' => 'Pepperoni Pizza',
                'slug' => 'pepperoni-pizza',
                'thumb_image' => 'https://media02.stockfood.com/previews/MTQ3NTA4MDIw/12292335.jpg',
                'category_id' => 1,
                'view' => 150,
                'short_description' => 'Pizza với xúc xích pepperoni.',
                'long_description' => 'Pepperoni Pizza với sốt cà chua và xúc xích pepperoni.',
                'price' => 190000,
                'offer_price' => 170000,
                'qty' => 50,
                'sku' => 'PIZZA005',
                'show_at_home' => 1,
                'status' => 1
            ],
            [
                'name' => 'Pizza Thịt Hầm',
                'slug' => 'meat-pizza',
                'thumb_image' => 'https://img.freepik.com/premium-photo/delicious-thin-crust-meat-pizza-white-background_899449-101598.jpg',
                'category_id' => 1,
                'view' => 130,
                'short_description' => 'Pizza với nhiều loại thịt.',
                'long_description' => 'Meat Pizza với xúc xích, giăm bông, và thịt bò.',
                'price' => 200000,
                'offer_price' => 180000,
                'qty' => 40,
                'sku' => 'PIZZA006',
                'show_at_home' => 1,
                'status' => 1
            ],
            [
                'name' => 'Margherita Pizza',
                'slug' => 'margherita-pizza-duplicate',
                'thumb_image' => 'https://media.istockphoto.com/id/1168754685/photo/pizza-margarita-with-cheese-top-view-isolated-on-white-background.jpg?s=612x612&w=0&k=20&c=psLRwd-hX9R-S_iYU-sihB4Jx2aUlUr26fkVrxGDfNg=',
                'category_id' => 1,
                'view' => 70,
                'short_description' => 'Margherita Pizza phiên bản thứ hai.',
                'long_description' => 'Pizza đơn giản với phô mai và sốt cà chua tươi ngon.',
                'price' => 150000,
                'offer_price' => 130000,
                'qty' => 20,
                'sku' => 'PIZZA007',
                'show_at_home' => 1,
                'status' => 1
            ],
            [
                'name' => ' Gà BBQ Pizza',
                'slug' => 'bbq-chicken-pizza',
                'thumb_image' => 'https://img.freepik.com/premium-photo/bbq-chicken-pizza-round-wooden-board-plate-white-background-directly-view_864588-26437.jpg',
                'category_id' => 1,
                'view' => 140,
                'short_description' => 'Pizza gà nướng BBQ.',
                'long_description' => 'BBQ Chicken Pizza với thịt gà nướng và sốt BBQ đặc biệt.',
                'price' => 210000,
                'offer_price' => 190000,
                'qty' => 30,
                'sku' => 'PIZZA008',
                'show_at_home' => 1,
                'status' => 1
            ],
            [
                'name' => 'Hawaiian Pizza',
                'slug' => 'hawaiian-pizza',
                'thumb_image' => 'https://media.istockphoto.com/id/479293070/photo/pizza.jpg?s=612x612&w=0&k=20&c=6_FFHbieV8R1VPc7fehj5K6s3vlPt15xk6MeN6rSN_E=',
                'category_id' => 1,
                'view' => 120,
                'short_description' => 'Pizza với giăm bông và dứa.',
                'long_description' => 'Hawaiian Pizza kết hợp giữa vị ngọt của dứa và giăm bông.',
                'price' => 175000,
                'offer_price' => 155000,
                'qty' => 30,
                'sku' => 'PIZZA009',
                'show_at_home' => 1,
                'status' => 1
            ],
            [
                'name' => 'Buffalo Pizza',
                'slug' => 'buffalo-pizza',
                'thumb_image' => 'https://img.freepik.com/premium-photo/buffalo-chicken-pizza-white-plate-white-background-directly-view_864588-26468.jpg',
                'category_id' => 1,
                'view' => 100,
                'short_description' => 'Pizza với thịt gà và sốt buffalo.',
                'long_description' => 'Buffalo Pizza với sốt cay buffalo và thịt gà giòn.',
                'price' => 185000,
                'offer_price' => 165000,
                'qty' => 25,
                'sku' => 'PIZZA010',
                'show_at_home' => 1,
                'status' => 1
            ],
            [
                'name' => 'Supreme Pizza',
                'slug' => 'supreme-pizza',
                'thumb_image' => 'https://img.freepik.com/premium-photo/supreme-pizza-white-stone-white-background_1028857-3846.jpg',
                'category_id' => 1,
                'view' => 170,
                'short_description' => 'Pizza với nhiều loại topping đặc biệt.',
                'long_description' => 'Supreme Pizza với xúc xích, rau củ và các nguyên liệu đa dạng.',
                'price' => 220000,
                'offer_price' => 200000,
                'qty' => 40,
                'sku' => 'PIZZA011',
                'show_at_home' => 1,
                'status' => 1
            ],
            [
                'name' => 'The Works Pizza',
                'slug' => 'the-works-pizza',
                'thumb_image' => 'https://img.freepik.com/premium-photo/pizza-white-background_1057389-450.jpg',
                'category_id' => 1,
                'view' => 160,
                'short_description' => 'Pizza với mọi loại topping.',
                'long_description' => 'The Works Pizza với xúc xích, giăm bông, rau củ và phô mai.',
                'price' => 230000,
                'offer_price' => 210000,
                'qty' => 20,
                'sku' => 'PIZZA012',
                'show_at_home' => 1,
                'status' => 1
            ],
            [
                'name' => 'Pizza Hải Sản',
                'slug' => 'seafood-pizza',
                'thumb_image' => 'https://img.freepik.com/premium-photo/seafood-pizza-white-background_1205-8221.jpg',
                'category_id' => 1,
                'view' => 100,
                'short_description' => 'Pizza với topping hải sản tươi ngon.',
                'long_description' => 'Pizza Hải Sản với phô mai béo ngậy, hải sản tươi, rau củ giòn và đế bánh giòn rụm.',
                'price' => 199000,
                'offer_price' => 179000,
                'qty' => 50,
                'sku' => 'PIZZA013',
                'show_at_home' => 1,
                'status' => 1
            ],
            [
                'name' => 'Pizza Phô Mai',
                'slug' => 'cheese-pizza',
                'thumb_image' => 'https://media.istockphoto.com/id/1295773428/photo/pizza-with-cheese-isolated-on-white-background-clipping-path-full-depth-of-field.jpg?s=612x612&w=0&k=20&c=Oomq20XpoHKvkMROs5doC26BSWxrZH8Gs6sYIEPMtKs=',
                'category_id' => 1,
                'view' => 80,
                'short_description' => 'Pizza với nhiều lớp phô mai.',
                'long_description' => 'Pizza Phô Mai với các lớp phô mai tan chảy và đế bánh thơm ngon.',
                'price' => 159000,
                'offer_price' => 139000,
                'qty' => 30,
                'sku' => 'PIZZA014',
                'show_at_home' => 1,
                'status' => 1
            ],
            [
                'name' => 'Pizza Thịt Bò',
                'slug' => 'beef-pizza',
                'thumb_image' => 'https://i.pinimg.com/736x/bc/09/02/bc090242552bf050a2d9314f3e883c53.jpg',
                'category_id' => 1,
                'view' => 120,
                'short_description' => 'Pizza với thịt bò thơm ngon.',
                'long_description' => 'Pizza Thịt Bò cùng với các nguyên liệu tươi ngon và nước sốt đậm đà.',
                'price' => 179000,
                'offer_price' => 159000,
                'qty' => 40,
                'sku' => 'PIZZA015',
                'show_at_home' => 1,
                'status' => 1
            ],

            // Sản phẩm thuộc danh mục Nước uống
            [
                'name' => 'Coca-Cola',
                'slug' => 'coca-cola',
                'thumb_image' => 'https://www.shutterstock.com/image-photo/ankara-turkey-may-17-2014-600nw-193222430.jpg',
                'category_id' => 2,
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
                'thumb_image' => 'https://i.pinimg.com/736x/3d/c5/4e/3dc54e8f5df2eaa53ca93758d080b2f0.jpg',
                'category_id' => 2,
                'view' => 180,
                'short_description' => 'Nước giải khát có ga mát lạnh.',
                'long_description' => 'Pepsi, hương vị tuyệt vời, mát lạnh, sảng khoái.',
                'price' => 14000,
                'offer_price' => 12000,
                'qty' => 4,
                'sku' => 'DRINK002',
                'show_at_home' => 1,
                'status' => 1
            ],
            [
                'name' => 'Nước Cam Ép',
                'slug' => 'fresh-orange-juice',
                'thumb_image' => 'https://thumbs.dreamstime.com/b/orange-juice-white-background-glass-fresh-isolated-130657037.jpg',
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
                'thumb_image' => 'https://img.freepik.com/premium-photo/fried-cheese-sticks-isolated-white-background_185193-58591.jpg',
                'category_id' => 3,
                'view' => 50,
                'short_description' => 'Phô mai chiên giòn.',
                'long_description' => 'Những que phô mai chiên giòn với lớp vỏ ngoài giòn tan, bên trong phô mai tan chảy.',
                'price' => 35000,
                'offer_price' => 30000,
                'qty' => 5,
                'sku' => 'STARTER001',
                'show_at_home' => 1,
                'status' => 1
            ],
            [
                'name' => 'Bánh Mì Bơ Tỏi',
                'slug' => 'garlic-bread',
                'thumb_image' => 'https://media.istockphoto.com/id/507681635/photo/garlic-and-herb-bread-slices.jpg?s=612x612&w=0&k=20&c=sRSGiM5TKwJPFkXNCKwvx7z_doAAom07dEhrBxEmmZc=',
                'category_id' => 3,
                'view' => 70,
                'short_description' => 'Bánh mì thơm ngon.',
                'long_description' => 'Bánh mì bơ tỏi, thơm lừng với bơ và tỏi, giòn rụm khi thưởng thức.',
                'price' => 30000,
                'offer_price' => 25000,
                'qty' => 8,
                'sku' => 'STARTER002',
                'show_at_home' => 1,
                'status' => 1
            ],
            [
                'name' => 'Salad Caesar',
                'slug' => 'caesar-salad',
                'thumb_image' => 'https://img.freepik.com/premium-photo/caesar-salad-white-background_238683-51.jpg',
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
                'category_id' => 4,
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
                'thumb_image' => 'https://img.freepik.com/premium-photo/plate-flan-with-plate-flan-it-isolated-white-background-illustration-images_796580-1371.jpg',
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
                'thumb_image' => 'https://img.freepik.com/premium-photo/bowl-vanilla-ice-cream-isolated-white-background-from-top-view_875825-119329.jpg',
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
            // [
            //     'name' => 'Combo Gia Đình',
            //     'slug' => 'family-combo',
            //     'thumb_image' => 'https://5.imimg.com/data5/VE/GG/MY-53040683/combo-for-family-28just-499-2f-29.jpg',
            //     'category_id' => $categoryIds[array_rand($categoryIds)], // Lấy ngẫu nhiên category_id hợp lệ // ID của danh mục Combo
            //     'view' => 150,
            //     'short_description' => 'Combo dành cho gia đình.',
            //     'long_description' => 'Combo bao gồm 2 pizza, nước uống và món tráng miệng cho gia đình.',
            //     'price' => 399000,
            //     'offer_price' => 359000,
            //     'qty' => 20,
            //     'sku' => 'COMBO001',
            //     'show_at_home' => 1,
            //     'status' => 1
            // ],
            // [
            //     'name' => 'Combo Nhóm Bạn',
            //     'slug' => 'friends-combo',
            //     'thumb_image' => 'https://e7.pngegg.com/pngimages/236/921/png-clipart-sicilian-pizza-buffalo-wing-pizza-margherita-fast-food-pizza-food-cheese.png',
            //     'category_id' => $categoryIds[array_rand($categoryIds)], // Lấy ngẫu nhiên category_id hợp lệ
            //     'view' => 200,
            //     'short_description' => 'Combo cho nhóm bạn.',
            //     'long_description' => 'Combo gồm 3 pizza, nước uống và món khai vị cho nhóm bạn.',
            //     'price' => 499000,
            //     'offer_price' => 459000,
            //     'qty' => 15,
            //     'sku' => 'COMBO002',
            //     'show_at_home' => 1,
            //     'status' => 1
            // ],
            // [
            //     'name' => 'Combo Đặc Biệt',
            //     'slug' => 'special-combo',
            //     'thumb_image' => 'https://thepizzacompany.vn/images/thumbs/000/0003604_combo-tet-la-sum-vay_500.png',
            //     'category_id' => $categoryIds[array_rand($categoryIds)], // Lấy ngẫu nhiên category_id hợp lệ
            //     'view' => 250,
            //     'short_description' => 'Combo đặc biệt theo mùa.',
            //     'long_description' => 'Combo đặc biệt với nhiều món ăn hấp dẫn và khuyến mãi theo mùa.',
            //     'price' => 599000,
            //     'offer_price' => 549000,
            //     'qty' => 10,
            //     'sku' => 'COMBO003',
            //     'show_at_home' => 1,
            //     'status' => 1
            // ],
        ];

        foreach ($products as $product) {
            Product::create($product);
        }
    }
}
