<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       //permission for posts
       Permission::create(['name' => 'permissions.index']);
       Permission::create(['name' => 'permissions.create']);
       Permission::create(['name' => 'permissions.edit']);
       Permission::create(['name' => 'permissions.delete']);
    }
}
