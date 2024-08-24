<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserDemografiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $json =  File::get('database/seeders/demografi.json');
        $countData = 1;

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
    }
}
