<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Faker;
use DB;

class InvoiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();

        DB::table('invoices')->insert([
            'id' => 1,
            'nama' => 'Faiz Azmi Rekatama',
            'no_hp' => '082282817744',
            'invoice_number' => Str::random(10),
            'jatuh_tempo' => 29,
        ]);

        $mulai_tagihan = '2020-09-29';
        $akhir_tagihan = '2020-11-29';

        for($i = 0; $i < 100; $i++) {
            $tarif = $faker->randomNumber(5);
            $bulan = 2;
            $jumlah = $tarif * $bulan;
            DB::table('invoice_details')->insert([
                'invoice_id' => 1,
                'nopol' => 'BE-'.mt_rand(1000, 9999).'-AA',
                'tarif' => $faker->randomNumber(5),
                'mulai_tagihan' => $mulai_tagihan,
                'akhir_tagihan' => $akhir_tagihan,
                'bulan' => $bulan,
                'jumlah' => $jumlah,
                'keterangan' => '',
            ]);
        }

        DB::table('invoices')->insert([
            'id' => 2,
            'nama' => 'Eindita Septiara',
            'no_hp' => '082282843355',
            'invoice_number' => Str::random(10),
            'jatuh_tempo' => 29,
        ]);

        $mulai_tagihan = '2020-09-29';
        $akhir_tagihan = '2020-11-29';

        for($i = 0; $i < 55; $i++) {
            $tarif = $faker->randomNumber(5);
            $bulan = 2;
            $jumlah = $tarif * $bulan;
            DB::table('invoice_details')->insert([
                'invoice_id' => 2,
                'nopol' => 'D-'.mt_rand(1000, 9999).'-ABC',
                'tarif' => $faker->randomNumber(5),
                'mulai_tagihan' => $mulai_tagihan,
                'akhir_tagihan' => $akhir_tagihan,
                'bulan' => $bulan,
                'jumlah' => $jumlah,
                'keterangan' => '',
            ]);
        }
    }
}
