<?php

namespace Database\Seeders;

use App\Enums\RoleEnum;
use App\Models\Admin;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = Admin::create([
            'name' => 'admin',
            'user_name' => 'admin',
            'code' => Str::random(11),
            'email' => 'admin@admin.com',
            'password' => bcrypt('admin'),
        ]);

        foreach (RoleEnum::cases() as $role) {
            if (in_array($role->value, [RoleEnum::ADMIN_FINANCE->value, RoleEnum::SUPER_ADMIN->value, RoleEnum::ADMIN_MARKETING->value, RoleEnum::ADMIN_SUPPORT->value])) {
                Role::create(['name' => $role->label(), 'guard_name' => 'admin']);
            } else {
                Role::create(['name' => $role->label(), 'guard_name' => 'web']);
            }
        }

        $admin->assignRole([1]);
    }

}
