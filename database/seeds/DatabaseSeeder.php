<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(ProvinsiSeeder::class);
        // $this->call(KabupatenSeeder::class);
        // $this->call(KecamatanSeeder::class);
        // $this->call(DesaSeeder::class);
        $this->call(KelompokTaniSeeder::class);
        $this->call(RetailerSeeder::class);
        $this->call(EnduserSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(GradeSeeder::class);
        $this->call(JenisManggaSeeder::class);
        $this->call(ManggaSeeder::class);
        $this->call(PostinganSeeder::class);
        $this->call(PemesananSeeder::class);
        $this->call(KebutuhanSeeder::class);
        $this->call(PenawaranSeeder::class);
    }
}
