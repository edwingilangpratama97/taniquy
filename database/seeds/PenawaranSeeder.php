<?php

use Illuminate\Database\Seeder;
use App\Models\Penawaran;

class PenawaranSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $penawaran = Penawaran::count();
    	$date = date("Ymd");
    	$kode = sprintf("PNR".$date."%'.04d\n", $penawaran+1);
    	Penawaran::create([
    		'kode_penawaran' => $kode,
    		'id_kebutuhan' => 1,
    		'id_mangga' => 2,
    		'id_retailer' => 1,
    		'role' => 'retailer'
    	]);

    	$penawaran = Penawaran::count();
    	$date = date("Ymd");
    	$kode = sprintf("PNK".$date."%'.04d\n", $penawaran+1);
    	Penawaran::create([
    		'kode_penawaran' => $kode,
    		'id_kebutuhan' => 2,
    		'id_mangga' => 1,
    		'id_kelompok' => 1,
    		'role' => 'kelompok'
    	]);

    }
}
