<?php

namespace Database\Seeders;

use App\Models\Project;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $projects = [
            [
                'title' => 'META-TEKNO',
                'description' => 'Learning space for future education',
                'image' => 'projects/tekno.png',
                'model_path' => 'assets/3d/teknokrat.glb',
                'spatial_link' => 'https://www.spatial.io/s/META-TEKNO-68259e59f734432bbfb0ad1e?share=647189754963369920',
                'category_id' => 1,
            ],
            [
                'title' => 'Presentation Room Teknokrat',
                'description' => 'Learning space for future education',
                'image' => 'projects/presentation-room.jpg',
                'model_path' => '',
                'spatial_link' => 'https://www.spatial.io/s/Presentation-Room-Teknokrat-646ad4f8a21fe86ca02df02f?share=4480046784380611478',
                'category_id' => 1,
            ],
            [
                'title' => 'Universitas Muslim Indonesia',
                'description' => 'Learning space for future education',
                'image' => 'projects/universitas-muslim.jpg',
                'model_path' => '',
                'spatial_link' => 'https://www.spatial.io/s/Universitas-Muslim-Indonesia-682b0a457096556e2726a6ee?share=346264815127952182',
                'category_id' => 2,
            ],
            [
                'title' => 'Mall Teknokrat Indonesia',
                'description' => 'Learning space for future education',
                'image' => 'projects/mall-tekno.jpg',
                'model_path' => '',
                'spatial_link' => 'https://www.spatial.io/s/Mall-Teknokrat-Indonesia-645e4ba7b39e26680851e75e?share=1944802212461214638',
                'category_id' => 2,
            ],
            [
                'title' => 'Ruang Informasi UTI',
                'description' => 'Learning space for future education',
                'image' => 'projects/ruang-informasi.jpg',
                'model_path' => '',
                'spatial_link' => 'https://www.spatial.io/s/Metaverse-Ruang-Informasi-UTI-65f5374c1a175fbb3aeb6354?share=2604339570336923574',
                'category_id' => 1,
            ],
            [
                'title' => 'SMK AL-KAUTSAR',
                'description' => 'Metaschool virtual learning environment',
                'image' => 'projects/smk-alkautsar.jpg',
                'model_path' => '',
                'spatial_link' => 'https://www.spatial.io/s/SEKOLAH-SMA-AL-KAUTSAR-664496de680289231ac6ada2?share=2143212505836071532',
                'category_id' => 2,
            ],
            [
                'title' => 'SMK 1 Merbau Mataram',
                'description' => 'Metaschool virtual learning environment',
                'image' => 'projects/smk1-merbau.jpg',
                'model_path' => '',
                'spatial_link' => 'https://www.spatial.io/s/SMK-1-Merbau-Mataram-66c74c75138624891ac07863?share=2155565741352133027',
                'category_id' => 2,
            ],
            [
                'title' => 'SMKN SPP LAMPUNG',
                'description' => 'Metaschool virtual learning environment',
                'image' => 'projects/smkn-spp.jpg',
                'model_path' => '',
                'spatial_link' => 'https://www.spatial.io/s/SMKN-SPP-LAMPUNG-66abb85e5a4bd3cf6f86339d?share=3679409962158378043',
                'category_id' => 2,
            ],
            [
                'title' => 'SMP Azzahra',
                'description' => 'Metaschool virtual learning environment',
                'image' => 'projects/smp-azzahra.jpg',
                'model_path' => '',
                'spatial_link' => 'https://www.spatial.io/s/SMP-Azzahra-66e5273fd9a79a340962518a?share=8831437309303499832',
                'category_id' => 2,
            ],
            [
                'title' => 'SMA Lab School UPI',
                'description' => 'Metaschool virtual learning environment',
                'image' => 'projects/sma-labschool.jpg',
                'model_path' => '',
                'spatial_link' => 'https://www.spatial.io/s/SMA-Lab-School-UPI-66f56b1dc23d0d0c2a3d5302?share=2713573888761638795',
                'category_id' => 2,
            ],
            [
                'title' => 'SMKN 1 Negara Batin',
                'description' => 'Metaschool virtual learning environment',
                'image' => 'projects/smkn1-negarabatin.jpg',
                'model_path' => '',
                'spatial_link' => 'https://www.spatial.io/s/SMKN-1-Negara-Batin-674bb4f17ae0d2e9ea74d9cc?share=4378193410158788043',
                'category_id' => 2,
            ],// Metaschool
            [
                'title' => 'SMAN 2 Metro',
                'description' => 'Metaschool virtual learning environment',
                'image' => 'projects/sman2-metro.jpg',
                'model_path' => '',
                'spatial_link' => 'https://www.spatial.io/s/SMAN-2-Metro-6757f3c424d89ee715720d89?share=4150804468430241838',
                'category_id' => 2,
            ],
        
            // Metaeducation
            [
                'title' => 'Working Space',
                'description' => 'Metaeducation exploration zone',
                'image' => 'projects/working-space.jpg',
                'model_path' => '',
                'spatial_link' => 'https://www.spatial.io/s/WorkingSpace-64619e40f568057a578070f3?share=1220612384119031668',
                'category_id' => 3,
            ],
            [
                'title' => 'Math Bridge',
                'description' => 'Metaeducation exploration zone',
                'image' => 'projects/math-bridge.jpg',
                'model_path' => '',
                'spatial_link' => 'https://www.spatial.io/s/Math-Bridge-66637fc9e4fe3927852def33?share=6070907678572552654',
                'category_id' => 3,
            ],
            [
                'title' => 'Teknokrat Racing Circuit',
                'description' => 'Metaeducation exploration zone',
                'image' => 'projects/racing-circuit.jpg',
                'model_path' => '',
                'spatial_link' => 'https://www.spatial.io/s/Teknokrat-Racing-Circuit-657533fb59d29d0853dca78a?share=7930475562745588531',
                'category_id' => 3,
            ],
        
            // Tourism
            [
                'title' => 'Museum Serambi Malapura',
                'description' => 'Metaeducation exploration zone',
                'image' => 'projects/museum-serambi.jpg',
                'model_path' => '',
                'spatial_link' => 'https://www.spatial.io/s/Pasar-Kreatif-dan-Seni-67569629bce99bc7f7b9241a?share=1789966570546314383',
                'category_id' => 4,
            ],
             // Tourism
    [
        'title' => 'Museum Lampung',
        'description' => 'V-Commerce exploration zone',
        'image' => 'projects/museum-lampung.jpg',
        'model_path' => '',
        'spatial_link' => 'https://www.spatial.io/s/Museum-Lampung-2024-66666a9e6f9abd268c6346d0?share=432555706488230980',
        'category_id' => 4,
    ],
    [
        'title' => 'Rumah Adat Lampung',
        'description' => 'V-Commerce exploration zone',
        'image' => 'projects/rumah-adat.jpg',
        'model_path' => '',
        'spatial_link' => 'https://www.spatial.io/s/Rumah-Adat-Lampung-Pepadun-66bf59f20da08901e7e066bc',
        'category_id' => 4,
    ],
    // V-Commerce
    [
        'title' => 'Pasar Kreatif & seni',
        'description' => 'V-Commerce exploration zone',
        'image' => 'projects/pasar-seni.jpg',
        'model_path' => '',
        'spatial_link' => 'https://www.spatial.io/s/Pasar-Kreatif-dan-Seni-67569629bce99bc7f7b9241a?share=1789966570546314383',
        'category_id' => 5,
    ],
    [
        'title' => 'Askha Jaya',
        'description' => 'V-Commerce exploration zone',
        'image' => 'projects/askha-jaya.jpg',
        'model_path' => '',
        'spatial_link' => 'https://www.spatial.io/s/Askha-Jaya-66e95768c23d0d0c2a3d5120?share=3170076146270750205',
        'category_id' => 5,
    ],
        ];

        foreach ($projects as $project) {
            Project::create($project);
        }
        
    }
}
