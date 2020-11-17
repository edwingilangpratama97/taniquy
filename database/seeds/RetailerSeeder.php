<?php

use Illuminate\Database\Seeder;
use App\Models\Retailer;

class RetailerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
		$retailer = Retailer::count();
    	$date = date("Ymd");
    	$kode = sprintf("RT".$date."%'.04d", $retailer+1);
		Retailer::create([
			'kode_retailer' => $kode,
			'id_desa' => 1101010001,
			'nama' => 'Bu Yati',
			'jenis_usaha' => 'Perorangan',
			'kontak' => '084543422323',
			'alamat' => 'Kebon Kalapa',
			'latitude' => '-1.705328',
			'longitude' => '114.451067'
		]);
    }
}
