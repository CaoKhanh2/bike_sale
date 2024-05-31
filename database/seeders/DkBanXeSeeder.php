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
        for ($i=0; $i < 100 ; $i++) { 
            XeDangKyThuMua::create([
                'madkthumua'=> $fake -> numerify('MDKBX-######'),
                'mand' => $fake -> randomElement(['2062363','2108262','2674374','2674374', '9119430']),
                'manv' => $fake -> randomElement(['MNV-0001','MNV-0002','MNV-0003']),
                'ngaydk' => $fake->dateTimeThisDecade('+3 years'),
                'giaban' => '12000000',
                'ghichu' => 'Loại xe: Xe đạp điện',
                'trangthaipheduyet' => 'Duyệt'
            ]);
        }
    }
}
