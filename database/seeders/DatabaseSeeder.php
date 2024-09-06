<?php

namespace Database\Seeders;

use App\Models\Admin;
use App\Models\Category;
use App\Models\Customer;
use App\Models\Fav;
use App\Models\Product;
use App\Models\Waste;
use App\Models\WasteSection;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(PermissionTableSeeder::class);
        $this->call(AdminSeeder::class);
        $this->call(SettingsSeeder::class);


        Admin::factory(10)->create();
        Customer::factory(100)->create();

        WasteSection::factory(5)->create();
        Category::factory(20)->create();

        Product::factory(100)->create();

        Fav::factory(15)->create();

        Waste::factory(10)->create();


    }
}
