<?php

use Illuminate\Database\Seeder;
use App\Models\KelompokTani;

class KelompokTaniSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	$kelompok = KelompokTani::count();
    	$date = date("Ymd");
    	$kode = sprintf("KT".$date."%'.04d", $kelompok+1);
		KelompokTani::create([
			'kode_kelompok' => $kode,
			'id_desa' => 1101010001,
			'nama' => 'Kelompok Tani Makmur',
			'ketua' => 'Wawan Sudrajat',
			'kontak' => '084543422323',
			'alamat' => 'Kebon Kalapa',
			'latitude' => '-1.205328',
			'longitude' => '113.451067'
		]);
    }
}
