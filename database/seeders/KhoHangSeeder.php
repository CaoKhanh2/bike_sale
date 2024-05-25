<?php

namespace Database\Seeders;

use App\Models\ChiTietKhoHang;
use App\Models\KhoHang;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as faker;

class KhoHangSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function generateRandomNumberString($length) {
        $randomNumbers = '';
    
        for ($i = 0; $i < $length; $i++) {
            $randomNumbers .= rand(0, 9);
        }
    
        return $randomNumbers;
    }
    
    
    public function run()
    {
        //$randomID = $this->generateRandomNumberString(10);
        $fake = faker::create();
        // for ($i=0; $i < 5; $i++) { 
        //     KhoHang::create([
        //         'makho'=> $fake -> numerify('KHG##'),
        //         'tenkhohang' => $fake->randomElement(['Kho số 1', 'Kho số 2', 'Kho số 3', 'Kho số 4', 'Kho số 5']),
        //         'diachi' => $fake->address
        //     ]);
        // }

        for ($i=0; $i < 50; $i++) { 
            ChiTietKhoHang::create([
                'machitietkho' => $fake->unique()->numerify('##########'),
                'makho'=> $fake -> randomElement(['KHG42', 'KHG57', 'KHG69', 'KHG91', 'KHG95']),
                'gianhapkho' => $fake->randomElement(['15000000', '25000000', '30000000', '35000000', '5000000']),
                'ngaynhapkho' => $fake->dateTimeThisMonth('+5 days'),
            ]);
        }
    }
}
