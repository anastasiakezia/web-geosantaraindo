<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Http;
use App\Models\City;

class CitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $provinces = Http::get('https://www.emsifa.com/api-wilayah-indonesia/api/provinces.json')->json();

        foreach ($provinces as $province) {
            $cities = Http::get("https://www.emsifa.com/api-wilayah-indonesia/api/regencies/{$province['id']}.json")->json();

            foreach ($cities as $city) {
                City::updateOrCreate([
                    'city_name' => $city['name'],
                ], [
                    'province' => $province['name'],
                ]);
            }
        }
    }
}
