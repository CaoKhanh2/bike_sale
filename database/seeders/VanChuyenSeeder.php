<?php

namespace Database\Seeders;

use App\Models\VanChuyen;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as faker;

class VanChuyenSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $fake = faker::create();
        for ($i=10; $i <= 20; $i++) { 
            VanChuyen::create([
                'mavanchuyen'=> $fake -> numerify('DVC-00').$i,
                'makh' => $fake -> numerify('MKH-').$fake->randomElement(['0001', '0851', '1017', '1306', '2697', '3212', '3300', '3559', '3940', '4061', '4346', '4558', '4636', '4793', '7191', '8547', '9902', '9958']),
                'trangthaivanchuyen' => $fake->randomElement(['Đang giao', 'Đã giao', 'Chưa được giao']),
                'ngaygui' => $fake->dateTimeThisMonth(),
                'ngaynhan' => $fake->dateTimeThisMonth('+12 days'),
                'diachigiaohang' => $fake->unique()->address(),
                'ghichu' => $fake->sentence()
            ]);
        }
    }
}
