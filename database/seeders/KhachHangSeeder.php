<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as faker;
use App\Models\NguoiDung;

class KhachHangSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $fake = faker::create();
        for ($i=0; $i < 20; $i++) { 
            KhachHang::create([
                'makh'=> $fake -> numerify('MKH-####'),
                'hovaten' => $fake -> name(),
                'ngaysinh' => $fake->date($format = 'Y-m-d', $max = 'now'),
                'gioitinh' => $fake->randomElement(['Nam', 'Nữ', 'Other']),
                'sodienthoai' => $fake->numerify('0##########'),
                'email' => $fake->unique()->safeEmail,
                'diachi' => $fake->unique()->streetAddress(),
                'tentk' => null,
                'password'=> null,
                'tinhtrang' => $fake -> numberBetween(0, 1)
            ]);
        }
    }
}
