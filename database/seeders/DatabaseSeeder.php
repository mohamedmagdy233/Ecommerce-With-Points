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
        Customer::factory(20)->create();

        WasteSection::factory(2)->create();
        Category::factory(5)->create();

        Product::factory(30)->create();

        Fav::factory(5)->create();

        Waste::factory(5)->create();


    }
}
