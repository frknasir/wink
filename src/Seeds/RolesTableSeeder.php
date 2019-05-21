<?php
use Illuminate\Database\Seeder;
use Wink\WinkRole;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role = new WinkRole();
        $role->name = "Admin";
        $role->description = "An Admin";
        $role->save();

        $role = new WinkRole();
        $role->name = "Contributor";
        $role->description = "A Contributor";
        $role->save();
    }
}