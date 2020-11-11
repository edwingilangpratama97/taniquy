<?php

use Illuminate\Database\Seeder;
use App\Models\Grade;

class GradeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Grade::create(
        	[
        		'nama' => 'Terbaik'
	        ]
	    );
		Grade::create(	    	
	        [
	        	'nama' => 'Bagus'
	        ]
	    );
		Grade::create(	
	        [
	        	'nama' => 'Standar'
	        ]
	    );
		Grade::create(	
	        [
	        	'nama' => 'Buruk'
	        ]
	    );
    }
}
