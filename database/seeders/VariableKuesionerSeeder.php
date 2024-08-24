<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class VariableKuesionerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $variable = ['Optimism', 'Innovative', 'Discomfort', 'Insecurity'];
        $result = [];
        foreach ($variable as $value) {
            $result[] = [
                'variable_nama' => $value,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        DB::table('variable_kuesioner')->insert($result);
    }
}
