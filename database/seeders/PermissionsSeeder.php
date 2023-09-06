<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Managers
        Permission::updateOrCreate(['name' => 'employees_index', /*'guard_name' => 'web',*/ 'slug' => 'employees.index']);
        Permission::updateOrCreate(['name' => 'employees_create', /*'guard_name' => 'web',*/ 'slug' => 'employees.create']);
        Permission::updateOrCreate(['name' => 'employees_update', /*'guard_name' => 'web',*/ 'slug' => 'employees.update']);
        Permission::updateOrCreate(['name' => 'employees_delete', /*'guard_name' => 'web',*/ 'slug' => 'employees.delete']);

        // Settings
        Permission::updateOrCreate(['name' => 'settings_update', /*'guard_name' => 'web',*/ 'slug' => 'settings.update']);

        // Countries
        Permission::updateOrCreate(['name' => 'countries_index', /*'guard_name' => 'web',*/ 'slug' => 'countries.index']);
        Permission::updateOrCreate(['name' => 'countries_create', /*'guard_name' => 'web',*/ 'slug' => 'countries.create']);
        Permission::updateOrCreate(['name' => 'countries_update', /*'guard_name' => 'web',*/ 'slug' => 'countries.update']);
        Permission::updateOrCreate(['name' => 'countries_delete', /*'guard_name' => 'web',*/ 'slug' => 'countries.delete']);

        // Cities
        Permission::updateOrCreate(['name' => 'cities_index', /*'guard_name' => 'web',*/ 'slug' => 'cities.index']);
        Permission::updateOrCreate(['name' => 'cities_create', /*'guard_name' => 'web',*/ 'slug' => 'cities.create']);
        Permission::updateOrCreate(['name' => 'cities_update', /*'guard_name' => 'web',*/ 'slug' => 'cities.update']);
        Permission::updateOrCreate(['name' => 'cities_delete', /*'guard_name' => 'web',*/ 'slug' => 'cities.delete']);

        // FAQ
        Permission::updateOrCreate(['name' => 'faq_index', /*'guard_name' => 'web',*/ 'slug' => 'faq.index']);
        Permission::updateOrCreate(['name' => 'faq_create', /*'guard_name' => 'web',*/ 'slug' => 'faq.create']);
        Permission::updateOrCreate(['name' => 'faq_update', /*'guard_name' => 'web',*/ 'slug' => 'faq.update']);
        Permission::updateOrCreate(['name' => 'faq_delete', /*'guard_name' => 'web',*/ 'slug' => 'faq.delete']);

        // Pages
        Permission::updateOrCreate(['name' => 'pages_index', /*'guard_name' => 'web',*/ 'slug' => 'pages.index']);
        Permission::updateOrCreate(['name' => 'pages_update', /*'guard_name' => 'web',*/ 'slug' => 'pages.update']);

        // Banners
        Permission::updateOrCreate(['name' => 'banners_index', /*'guard_name' => 'web',*/ 'slug' => 'banners.index']);
        Permission::updateOrCreate(['name' => 'banners_create', /*'guard_name' => 'web',*/ 'slug' => 'banners.create']);
        Permission::updateOrCreate(['name' => 'banners_update', /*'guard_name' => 'web',*/ 'slug' => 'banners.update']);
        Permission::updateOrCreate(['name' => 'banners_delete', /*'guard_name' => 'web',*/ 'slug' => 'banners.delete']);

        // Users
        Permission::updateOrCreate(['name' => 'users_index', /*'guard_name' => 'web',*/ 'slug' => 'users.index']);
        Permission::updateOrCreate(['name' => 'users_create', /*'guard_name' => 'web',*/ 'slug' => 'users.create']);
        Permission::updateOrCreate(['name' => 'users_update', /*'guard_name' => 'web',*/ 'slug' => 'users.update']);
        Permission::updateOrCreate(['name' => 'users_delete', /*'guard_name' => 'web',*/ 'slug' => 'users.delete']);

        // Notifications
        Permission::updateOrCreate(['name' => 'notifications_create', /*'guard_name' => 'web',*/ 'slug' => 'notifications.create']);

        // Contact Us
        Permission::updateOrCreate(['name' => 'contactUs_index', /*'guard_name' => 'web',*/ 'slug' => 'contactUs.index']);
        Permission::updateOrCreate(['name' => 'contactUs_delete', /*'guard_name' => 'web',*/ 'slug' => 'contactUs.delete']);
    }
}
