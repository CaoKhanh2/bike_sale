<?php

namespace Database\Seeders;

use App\Models\ThongTinXeDapDien;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as faker;

class XeDapDienSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $fake = faker::create();
        for ($i=1; $i <= 10; $i++) { 
            ThongTinXeDapDien::create([
                'maxedapdien'=> 'XD-000'.$i,
                'dongxe_id' => null,
                'hangxe_id' => null,
                'tenxe' => null,
                'trongluong' => $fake->randomFloat(1, 50, 90),
                'acquy' => $fake->randomElement(['48v - 20a', '60v - 20Ah', '48V – 20Ah']),
                'dongcodien' => $fake->randomElement(['Điện 3 pha']),
                'sacdien' =>$fake->randomElement(['8-10 tiếng']),
                'phamvisudung' => $fake->numberBetween(50, 100),
                'hinhanh' => null,
                'giaban' => $fake->randomFloat(2,10000000,20000000),
                'tinhtrang' => 1
 
            ]);
        }
    }
}
