<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class CreateAdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::create([
            'name' => 'Admin User',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('12345678'),
            'phone' => '0324567890',
            'email_verified_at' => now(),
            'remember_token' => Str::random(10),
        ]);

        $role = Role::create(['name' => 'Admin']);

        $permissions = Permission::pluck('id', 'id')->all();

        $role->syncPermissions($permissions);

        $user->assignRole([$role->id]);

        // role: Business User
        $managerRole = Role::create(['name' => 'Business User']);
        // $managerPermissions = Permission::where('name', 'like', 'product%')->pluck('id','id')->all();
        $managerPermissions = Permission::where('name', 'like', 'product%')->orWhere('name', 'like', 'role%')->pluck('id', 'id')->all();
        $managerRole->syncPermissions($managerPermissions);

        // role: client
        $clientRole = Role::create(['name' => 'Client']);
        $clientPermissions = Permission::where('name', 'like', 'product%')->pluck('id', 'id')->all();
        $clientRole->syncPermissions($clientPermissions);



        // // role: Vendor
        // $managerRole = Role::create(['name' => 'Vendor']);
        // $managerPermissions = Permission::where('name', 'like', 'product%')->orWhere('name', 'like', 'role%')->pluck('id','id')->all();
        // $managerRole->syncPermissions($managerPermissions);
        // // role: Warehouse
        // $warehouseRole = Role::create(['name' => 'Warehouse']);
        // $warehousePermissions = Permission::where('name', 'like', 'product%')->orWhere('name', 'like', 'role%')->pluck('id','id')->all();
        // $warehouseRole->syncPermissions($warehousePermissions);

    }
}
