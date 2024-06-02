<?php

namespace Database\Seeders;

use App\Models\NhanVien;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as faker;

class NhanVienSeeder extends Seeder
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
            NhanVien::create([
                'manv'=> $fake -> numerify('MNV-000').$i,
                'macv'=> $fake -> randomElement(['CV-01']),
                'hovaten' => $fake -> name(),
                'ngaysinh' => $fake->date($format = 'Y-m-d', $max = 'now'),
                'gioitinh' => $fake->randomElement(['Nam', 'Nữ']),
                'sodienthoai' => $fake->numerify('0##########'),
                'diachi' => $fake->unique()->streetAddress(),
                'ghichu' => $fake -> sentence(4)

            ]);
        }
    }
}
