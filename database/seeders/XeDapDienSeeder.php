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
        for ($i=0; $i < 15; $i++) { 
            ThongTinXeDapDien::create([
                'maxedapdien'=> $fake -> numerify('XD-######'),
                'trongluong' => $fake -> randomNumber(2, true),
                'acquy' => $fake->randomElement(['48v - 20a', '60v - 20Ah', '48V – 20Ah']),
                'dongcodien' => $fake->randomElement(['Điện 3 pha']),
                'sacdien' =>$fake->randomElement(['8- 10 tiếng']),
                'ngaynhan' => $fake->dateTimeThisMonth('+12 days'),
                'diachigiaohang' => $fake->unique()->address(),
                'ghichu' => $fake->sentence()
            ]);
        }
    }
}
