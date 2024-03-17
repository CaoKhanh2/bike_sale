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
        for ($i=0; $i < 10; $i++) { 
            NhanVien::create([
                'manv'=> $fake -> numerify('MNV-###'),
                'chucvu_id'=> $fake -> randomElement(['CV-01']),
                'hovaten' => $fake -> name(),
                'ngaysinh' => $fake->date($format = 'Y-m-d', $max = 'now'),
                'gioitinh' => $fake->randomElement(['Nam', 'Nữ', 'Other']),
                'sodienthoai' => $fake->numerify('0##########'),
                'email' => $fake->unique()->safeEmail,
                'diachi' => $fake->unique()->streetAddress(),
                'ghichu' => $fake -> sentence(4)

            ]);
        }
    }
}
