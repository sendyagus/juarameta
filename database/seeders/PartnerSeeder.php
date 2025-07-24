<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class PartnerSeeder extends Seeder
{
    public function run(): void
    {
        $partners = [
            [
                'name' => 'Meta Tekno',
                'logo' => 'partner/Logo-Meta.png',
            ],
            [
                'name' => 'Kominfo',
                'logo' => 'partner/kominfo.png',
            ],
            [
                'name' => 'Al-Kautsar',
                'logo' => 'partner/al-kautsar.png',
            ],
            [
                'name' => 'Universitas Islam Indonesia',
                'logo' => 'partner/umi.png',
            ],
            [
                'name' => 'SMAN 2 Metro',
                'logo' => 'partner/metro.png',
            ],
            [
                'name' => 'Askha Jaya',
                'logo' => 'partner/askhajaya.png',
            ],
        ];

        foreach ($partners as $partner) {
            DB::table('partners')->insert([
                'name' => $partner['name'],
                'logo' => $partner['logo'],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
