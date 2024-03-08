<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = Role::create(["name" => 'admin']);
        $organisateur = Role::create(["name" => 'organisateur']);
        $user = Role::create(["name" => 'user']);

        //user
        Permission::create(['name' => 'reserver event']);
        Permission::create(['name' => 'generer un ticket']);

        $user->givePermissionTo(['reserver event', 'generer un ticket']);

        //organisateur
        Permission::create(['name' => 'gerer event']);
        Permission::create(['name' => 'statiques of event']);
        Permission::create(['name' => 'confirm reservation']);

        $organisateur->givePermissionTo(['gerer event', 'statiques of event', 'confirm reservation']);

        //admin
        Permission::create(['name' => 'gerer users']);
        Permission::create(['name' => 'gerer category']);
        Permission::create(['name' => 'confirm event']);
        Permission::create(['name' => 'admin statiques']);

        $admin->givePermissionTo(['gerer users', 'gerer category', 'confirm event', 'admin statiques']);
    }
}
