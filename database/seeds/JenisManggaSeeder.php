<?php

use Illuminate\Database\Seeder;
use App\Models\JenisMangga;

class JenisManggaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        JenisMangga::create([
        	'nama' => 'Harumanis'
        ]);

        JenisMangga::create([
        	'nama' => 'Cengkir'
        ]);
    }
}
