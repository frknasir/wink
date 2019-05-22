<?php

use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::table('wink_roles')->insert([
            [
                'id' => Str::uuid(),
                'name' => 'Admin',
                'description' => 'An Admin'
            ],
            [
                'id' => Str::uuid(),
                'name' => 'Contributor',
                'description' => 'A Contributor'
            ]
        ]);
    }
}