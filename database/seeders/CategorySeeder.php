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
                'name' => 'teknokrat word',
                'image' => 'category/teknokratworld.jpg',
                'description' => 'Platform digital untuk pengalaman dunia virtual Teknokrat.',
            ],
            [
                'name' => 'metaschool',
                'image' => 'category/metaschool.jpg',
                'description' => 'Simulasi sekolah di dunia metaverse.',
            ],
            [
                'name' => 'education game',
                'image' => 'category/metaeducation.jpg',
                'description' => 'Permainan edukatif berbasis 3D dan interaktif.',
            ],
            [
                'name' => 'v-commerce',
                'image' => 'category/vcommerce.jpg',
                'description' => 'Platform belanja virtual dalam lingkungan 3D.',
            ],
            [
                'name' => 'tourism',
                'image' => 'category/tourism.jpg',
                'description' => 'Eksplorasi destinasi wisata secara virtual.',
            ],
        ];

        foreach ($categories as $category) {
            Category::firstOrCreate(
                ['name' => $category['name']],
                [
                    'image' => $category['image'],
                    'description' => $category['description'],
                ]
            );
        }
    }
}
