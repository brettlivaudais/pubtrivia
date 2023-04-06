<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roles = [
            [
                'name' => 'player',
                'registerable' => '1'
            ],
            [
                'name' => 'host',
                'registerable' => '1'
            ],
            [
                'name' => 'admin',
                'registerable' => '0'
            ],
            [
                'name' => 'author',
                'registerable' => '0'
            ],
        ];

        DB::table('roles')->insert($roles);
    }
}
