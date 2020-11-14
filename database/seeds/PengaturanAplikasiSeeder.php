<?php

use Illuminate\Database\Seeder;

class PengaturanAplikasiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $input = [
        	'nama_app' => 'TaniQuy',
        	'nama_tab' => 'TaniQuy',
        	'copyright_text' => 'PT Telkom Sigma'
        ];

        \DB::table('pengaturan_aplikasis')->insert($input);
    }
}
