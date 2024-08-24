<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $json =  File::get('database/seeders/user.json');
        DB::table('users')->insert([
            'name' => 'Admin',
            'username' => 'admin',
            'role_id' => 1,
            'password' => Hash::make('admin')
        ]);

        $result = [];
        foreach (json_decode($json, true) as $data) {
            $result[] = [
                'name' => $data['nama'],
                'username' => $data['nim'],
                'role_id' => 2,
                'password' => Hash::make($data['nim'])
            ];
        }

        DB::table('users')->insert($result);
    }
}
