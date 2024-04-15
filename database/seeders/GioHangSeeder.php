<?php

namespace Database\Seeders;

use App\Models\GioHang;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as faker;


class GioHangSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $fake = faker::create();
        for ($i=1; $i <= 9; $i++) { 
            GioHang::create([
                'magh'=> $fake -> numerify('MGH-000').$i,
                'makh' => $fake -> numerify('MKH-').$fake->randomElement(['0001', '0851', '1017', '2697', '3212', '3300', '3559', '3940', '4061', '4346', '4558', '4636', '4793', '7191', '8547', '9902', '9958']),
                'mavanchuyen' => $fake -> numerify('DVC-000').$fake->randomDigitNot(0),
                'mathanhtoan' => null,
                'ngaytao' => date("Y-m-d H:i:s"),
                'tonggiatien' => $fake->randomElement(['15000000','20000000','25000000']),
                'ghichu' => null
            ]);
        }
    }
}
