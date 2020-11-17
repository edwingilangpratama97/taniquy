<?php

use Illuminate\Database\Seeder;
use App\Models\Enduser;

class EnduserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
		$enduser = Enduser::count();
    	$date = date("Ymd");
    	$kode = sprintf("EU".$date."%'.04d", $enduser+1);
		Enduser::create([
			'kode_enduser' => $kode,
			'id_desa' => 1101010001,
			'nama' => 'Pak Wawan',
			'tgl_lahir' => date("1995-03-15"),
			'jenis_kelamin' => 'L',
			'kontak' => '084543422323',
			'alamat' => 'Kebon Kalapa',
			'latitude' => '-1.905328',
			'longitude' => '113.851067'
		]);
    }
}
