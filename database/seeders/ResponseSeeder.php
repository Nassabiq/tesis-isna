<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;

class ResponseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // $kuesioner = DB::table('kuesioner')->select('id')->get();
        $json =  File::get('database/seeders/kuesioner.json');
        $countData = 1;

        foreach (json_decode($json, true) as $value) {
            $count = 1;
            foreach ($value as $key => $item) {
                if ($count > 10) {
                    $item = $this->reverseValue($item);
                }

                $response[] = [
                    'kuesioner_id' => $countData,
                    'pernyataan_kuesioner_id' => $count,
                    'value_kuesioner' => $item,
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
                $count++;
            }
            $countData++;
        }

        DB::table('responses')->insert($response);
    }


    function reverseValue($value)
    {
        $mapping = [
            1 => 5,
            2 => 4,
            3 => 3,
            4 => 2,
            5 => 1
        ];

        return $mapping[$value];
    }
}
