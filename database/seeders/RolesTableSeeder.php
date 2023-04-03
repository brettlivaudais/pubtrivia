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
            ],
            [
                'name' => 'host',
            ],
            [
                'name' => 'admin',
            ],
            [
                'name' => 'author',
            ],
        ];

        DB::table('roles')->insert($roles);
    }
}
