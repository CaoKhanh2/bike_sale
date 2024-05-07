<?php

namespace Database\Seeders;


use App\Models\XeDangKyThuMua;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as faker;


class DkBanXeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $fake = faker::create();
        for ($i=0; $i < 5; $i++) { 
            XeDangKyThuMua::create([
                'madkbanxe'=> $fake -> numerify('MDKBX-######'),
                'maxedapdien'=>$fake -> randomElement(['XE-003', 'XE-004', 'XE-005']),
                'maxemay' => null,
                'makh' => $fake -> randomElement(['MKH-1017','MKH-2697','MKH-3212']),
                'namdk' => 2020,
                'xuatxu' => 'Đài Loan',
                'giaban' => 18000000,
                'motachitiet'=> null
            ]);
        }
    }
}
