<?php

namespace Database\Seeders;

use App\Models\Kuesioner;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class KuesionerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = User::select(['id', 'name'])->where('role_id', 2)->get();
        $kuesioner = [];

        foreach ($users as $user) {
            $kuesioner[] = [
                'user_id' => $user->id,
                'created_by' => $user->id,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        DB::table('kuesioner')->insert($kuesioner);
    }
}
