<?php

use Illuminate\Database\Seeder;
use App\Models\Kebutuhan;

class KebutuhanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	$kebutuhan = Kebutuhan::count();
    	$date = date("Ymd");
    	$kode = sprintf("KE".$date."%'.04d\n", $kebutuhan+1);
        Kebutuhan::create([
        	'kode_kebutuhan' => $kode,
        	'id_enduser' => 1,
        	'role' => 'enduser',
        	'id_jenis' => 1,
        	'jumlah' => 10
        ]);

        $kebutuhan = Kebutuhan::count();
    	$date = date("Ymd");
    	$kode = sprintf("KR".$date."%'.04d\n", $kebutuhan+1);
        Kebutuhan::create([
        	'kode_kebutuhan' => $kode,
        	'id_retailer' => 1,
        	'role' => 'retailer',
        	'id_jenis' => 1,
        	'jumlah' => 100
        ]);
    }
}
