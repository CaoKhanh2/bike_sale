<?php

namespace Database\Seeders;

use App\Models\DonHang;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as faker;


class DonHangSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $fake = faker::create();
        for ($i=4; $i < 10; $i++) { 
            DonHang::create([
                'madh'=> $fake -> numerify('DH-0000').$i,
                'ngaytaodon'=> $fake->dateTimeThisMonth('+12 days'),
                'tongtien' => $fake->randomElement(['15000000','20000000','25000000'])

            ]);
        }
    }
}
