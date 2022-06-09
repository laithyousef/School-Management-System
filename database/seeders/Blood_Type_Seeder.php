<?php

namespace Database\Seeders;

use App\Models\Blood_Type;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class Blood_Type_Seeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('blood_types')->delete();

        $blood_types = ['O-', 'O+', 'A-', 'A+', 'B-', 'B+', 'AB-', 'AB+'];

        foreach($blood_types as $blode_type) {

            Blood_Type::create(['name' => $blode_type]);
        }
    }
}
