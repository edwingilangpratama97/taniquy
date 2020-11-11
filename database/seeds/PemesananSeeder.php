<?php

use Illuminate\Database\Seeder;
use App\Models\Pemesanan;

class PemesananSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	$pemesanan = Pemesanan::count();
    	$date = date("Ymd");
    	$kode = sprintf("PEE".$date."%'.04d\n", $pemesanan+1);
        Pemesanan::create([
        	'kode_pemesanan' => $kode,
        	'id_postingan' => 2,
        	'id_enduser' => 1,
        	'role' => 'enduser',
        	'jumlah' => 100
        ]);

        $pemesanan = Pemesanan::count();
    	$date = date("Ymd");
    	$kode = sprintf("PER".$date."%'.04d\n", $pemesanan+1);
        Pemesanan::create([
        	'kode_pemesanan' => $kode,
        	'id_postingan' => 1,
        	'id_retailer' => 1,
        	'role' => 'retailer',
        	'jumlah' => 100
        ]);
    }
}
