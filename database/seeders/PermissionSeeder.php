<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Permission;


class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Permission::create(
            ['type_user' => 'AD','type_permission' => 'M'],
            ['type_user' => 'P','type_permission' => 'M'],
            ['type_user' => 'A','type_permission' => 'M'],
        );
        
    }
}
