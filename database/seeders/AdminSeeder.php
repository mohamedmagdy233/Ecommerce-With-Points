<?php

namespace Database\Seeders;

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
        // Create an admin user
        $admin = Admin::create([
            'name' => 'admin',
            'user_name' => 'admin',
            'code' => Str::random(11),
            'email' => 'admin@admin.com',
            'phone' => '1234567890',
            'password' => bcrypt('admin'),
        ]);

        // Ensure all permissions are created
        $permissions = [
            'view_home',
            'view_admins',
            'view_customers',
            'view_categories',
            'view_products',
            'view_wastes_section',
            'view_wastes',
            'view_transfer_points',
            'view_orders',
            'view_invite_links',
            'view_settings',
            'logout',
            'manage_invoices',
            'view_invoice_list',
            'view_paid_invoices',
            'view_partially_paid_invoices',
            'view_unpaid_invoices',
            'view_invoice_archive',
            'manage_reports',
            'view_invoice_report',
            'view_client_report',
            'manage_users',
            'view_user_list',
            'manage_user_permissions',
            'manage_settings',
            'manage_products',
            'manage_categories',
            'add_invoice',
            'delete_invoice',
            'export_excel',
            'change_payment_status',
            'edit_invoice',
            'archive_invoice',
            'print_invoice',
            'add_attachment',
            'delete_attachment',
            'add_user',
            'edit_user',
            'delete_user',
            'view_permissions',
            'add_permission',
            'edit_permission',
            'delete_permission',
            'add_product',
            'edit_product',
            'delete_product',
            'add_category',
            'edit_category',
            'delete_category',
            'manage_notifications',
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission, 'guard_name' => 'admin']);
        }

        // Assign all permissions to the admin user
        $admin->givePermissionTo(Permission::all());
    }
}
