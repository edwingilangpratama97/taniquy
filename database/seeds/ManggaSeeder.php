<?php

use Illuminate\Database\Seeder;
use App\Models\Mangga;

class ManggaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	$mangga = Mangga::count();
    	$date = date("Ymd");
    	$kode = sprintf("MK".$date."%'.04d\n", $mangga+1);
        Mangga::create([
        	'id_kelompok' => 1,
        	'id_jenis' => 1,
        	'id_grade' => 1,
        	'kode_mangga' => $kode,
        	// 'role' => 'kelompok',
        	'harga' => 10000,
        	'stok' => 100
        ]);

        $mangga = Mangga::count();
    	$date = date("Ymd");
    	$kode = sprintf("MR".$date."%'.04d\n", $mangga+1);
        Mangga::create([
        	'id_retailer' => 1,
        	'id_jenis' => 1,
        	'id_grade' => 1,
        	'kode_mangga' => $kode,
        	// 'role' => 'retailer',
        	'harga' => 10000,
        	'stok' => 100
        ]);
    }
}
