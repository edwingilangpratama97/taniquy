<?php

use Illuminate\Database\Seeder;
use App\Models\Postingan;

class PostinganSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	$postingan = Postingan::count();
    	$date = date("Ymd");
    	$kode = sprintf("POK".$date."%'.04d", $postingan+1);
        Postingan::create([
        	'kode_postingan' => $kode,
        	'id_mangga' => 1,
        	'id_kelompok' => 1,
        	// 'role' => 'kelompok',
        	'keterangan' => 'Buah Asli dari Bandung'
        ]);

        $postingan = Postingan::count();
    	$date = date("Ymd");
    	$kode = sprintf("POR".$date."%'.04d", $postingan+1);
        Postingan::create([
        	'kode_postingan' => $kode,
        	'id_mangga' => 2,
        	'id_retailer' => 1,
        	// 'role' => 'retailer',
        	'keterangan' => 'Buah Asli dari Retailer'
        ]);
    }
}
