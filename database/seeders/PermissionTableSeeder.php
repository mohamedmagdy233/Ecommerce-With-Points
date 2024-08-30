<?php

namespace Database\Seeders;  // Update this to use the correct namespace

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = [
            'view_home',             // Permission to view the home/dashboard page
            'view_admins',           // Permission to view the admins list
            'view_customers',        // Permission to view the customers list
            'view_categories',       // Permission to view categories
            'view_products',         // Permission to view products
            'view_wastes_section',   // Permission to view waste sections
            'view_wastes',           // Permission to view wastes
            'view_transfer_points',  // Permission to view transfer points
            'view_orders',           // Permission to view orders
            'view_invite_links',     // Permission to view invitation links
            'view_settings',         // Permission to view settings
            'logout',                // Permission to logout (not typically used for permission checking)

            // Additional permissions that correspond to actions in your application
            'add_customer',          // Permission to add a customer
            'edit_customer',         // Permission to edit a customer
            'delete_customer',       // Permission to delete a customer
            'add_category',          // Permission to add a category
            'edit_category',         // Permission to edit a category
            'delete_category',       // Permission to delete a category
            'add_product',           // Permission to add a product
            'edit_product',          // Permission to edit a product
            'delete_product',        // Permission to delete a product
            'add_wastes_section',    // Permission to add a waste section
            'edit_wastes_section',   // Permission to edit a waste section
            'delete_wastes_section', // Permission to delete a waste section
            'add_waste',             // Permission to add a waste
            'edit_waste',            // Permission to edit a waste
            'delete_waste',          // Permission to delete a waste
            'add_order',             // Permission to add an order
            'edit_order',            // Permission to edit an order
            'delete_order',          // Permission to delete an order
            'add_setting',           // Permission to add a setting
            'edit_setting',          // Permission to edit a setting
            'delete_setting',        // Permission to delete a setting
            'add_admin',        // Permission to delete a setting
            'edit_admin',        // Permission to delete a setting
            'delete_admin',        // Permission to delete a setting
        ];

        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission, 'guard_name' => 'admin']);  // Include guard_name if necessary
        }
    }
}
