<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
        [
            'name' => 'Teknokrat World',
            'image' => 'category/teknokratworld.jpg',
            'description' => 'Platform digital untuk pengalaman dunia virtual Teknokrat.',
        ],
        [
            'name' => 'Metaschool',
            'image' => 'category/metaschool.jpg',
            'description' => 'Simulasi sekolah di dunia metaverse.',
        ],
        [
            'name' => 'Educational Game',
            'image' => 'category/metaeducation.jpg',
            'description' => 'Permainan edukatif berbasis 3D dan interaktif.',
        ],
        [
            'name' => 'V-Commerce',
            'image' => 'category/vcommerce.jpg',
            'description' => 'Platform belanja virtual dalam lingkungan 3D.',
        ],
        [
            'name' => 'Tourism',
            'image' => 'category/tourism.jpg',
            'description' => 'Eksplorasi destinasi wisata secara virtual.',
        ],
    ];

    foreach ($categories as $category) {
        Category::create($category);
    }
    }
}
