<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class UserDemografiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $json =  File::get('database/seeders/demografi.json');
        $countData = 2;

        foreach (json_decode($json, true) as $value) {
            $count = 1;
            foreach ($value as $key => $item) {
                $response[] = [
                    'user_id' => $countData,
                    'demografi_id' => $count,
                    'value_answer' => $item,
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
                $count++;
            }
            $countData++;
        }

        DB::table('user_demografi')->insert($response);
    }
}
