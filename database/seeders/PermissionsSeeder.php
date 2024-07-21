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
        // Employees
        Permission::updateOrCreate(['name' => 'employees_index', /*'guard_name' => 'web',*/ 'slug' => 'employees.index','status' => true ]);
        Permission::updateOrCreate(['name' => 'employees_create', /*'guard_name' => 'web',*/ 'slug' => 'employees.create','status' => true ]);
        Permission::updateOrCreate(['name' => 'employees_update', /*'guard_name' => 'web',*/ 'slug' => 'employees.update','status' => true ]);
        Permission::updateOrCreate(['name' => 'employees_delete', /*'guard_name' => 'web',*/ 'slug' => 'employees.delete','status' => true ]);

        // Settings
        Permission::updateOrCreate(['name' => 'settings_update', /*'guard_name' => 'web',*/ 'slug' => 'settings.update','status' => true ]);

        // Countries
        Permission::updateOrCreate(['name' => 'countries_index', /*'guard_name' => 'web',*/ 'slug' => 'countries.index','status' => true ]);
        Permission::updateOrCreate(['name' => 'countries_create', /*'guard_name' => 'web',*/ 'slug' => 'countries.create','status' => true ]);
        Permission::updateOrCreate(['name' => 'countries_update', /*'guard_name' => 'web',*/ 'slug' => 'countries.update','status' => true ]);
        Permission::updateOrCreate(['name' => 'countries_delete', /*'guard_name' => 'web',*/ 'slug' => 'countries.delete','status' => true ]);

        // Cities
        Permission::updateOrCreate(['name' => 'cities_index', /*'guard_name' => 'web',*/ 'slug' => 'cities.index','status' => true ]);
        Permission::updateOrCreate(['name' => 'cities_create', /*'guard_name' => 'web',*/ 'slug' => 'cities.create','status' => true ]);
        Permission::updateOrCreate(['name' => 'cities_update', /*'guard_name' => 'web',*/ 'slug' => 'cities.update','status' => true ]);
        Permission::updateOrCreate(['name' => 'cities_delete', /*'guard_name' => 'web',*/ 'slug' => 'cities.delete','status' => true ]);

        // FAQ
        Permission::updateOrCreate(['name' => 'faq_index', /*'guard_name' => 'web',*/ 'slug' => 'faq.index','status' => true ]);
        Permission::updateOrCreate(['name' => 'faq_create', /*'guard_name' => 'web',*/ 'slug' => 'faq.create','status' => true ]);
        Permission::updateOrCreate(['name' => 'faq_update', /*'guard_name' => 'web',*/ 'slug' => 'faq.update','status' => true ]);
        Permission::updateOrCreate(['name' => 'faq_delete', /*'guard_name' => 'web',*/ 'slug' => 'faq.delete','status' => true ]);

        // Pages
        Permission::updateOrCreate(['name' => 'pages_index', /*'guard_name' => 'web',*/ 'slug' => 'pages.index','status' => true ]);
        Permission::updateOrCreate(['name' => 'pages_update', /*'guard_name' => 'web',*/ 'slug' => 'pages.update','status' => true ]);

        // Banners
        Permission::updateOrCreate(['name' => 'banners_index', /*'guard_name' => 'web',*/ 'slug' => 'banners.index','status' => true ]);
        Permission::updateOrCreate(['name' => 'banners_create', /*'guard_name' => 'web',*/ 'slug' => 'banners.create','status' => true ]);
        Permission::updateOrCreate(['name' => 'banners_update', /*'guard_name' => 'web',*/ 'slug' => 'banners.update','status' => true ]);
        Permission::updateOrCreate(['name' => 'banners_delete', /*'guard_name' => 'web',*/ 'slug' => 'banners.delete','status' => true ]);

        // Users
        Permission::updateOrCreate(['name' => 'users_index', /*'guard_name' => 'web',*/ 'slug' => 'users.index','status' => true ]);
        Permission::updateOrCreate(['name' => 'users_create', /*'guard_name' => 'web',*/ 'slug' => 'users.create','status' => true ]);
        Permission::updateOrCreate(['name' => 'users_update', /*'guard_name' => 'web',*/ 'slug' => 'users.update','status' => true ]);
        Permission::updateOrCreate(['name' => 'users_delete', /*'guard_name' => 'web',*/ 'slug' => 'users.delete','status' => true ]);

        // Providers
        Permission::updateOrCreate(['name' => 'providers_index', /*'guard_name' => 'web',*/ 'slug' => 'providers.index','status' => true ]);
        Permission::updateOrCreate(['name' => 'providers_create', /*'guard_name' => 'web',*/ 'slug' => 'providers.create','status' => true ]);
        Permission::updateOrCreate(['name' => 'providers_update', /*'guard_name' => 'web',*/ 'slug' => 'providers.update','status' => true ]);
        Permission::updateOrCreate(['name' => 'providers_delete', /*'guard_name' => 'web',*/ 'slug' => 'providers.delete','status' => true ]);

        // Notifications
        Permission::updateOrCreate(['name' => 'notifications_create', /*'guard_name' => 'web',*/ 'slug' => 'notifications.create','status' => true ]);

        // Contact Us
        Permission::updateOrCreate(['name' => 'contactUs_index', /*'guard_name' => 'web',*/ 'slug' => 'contactUs.index','status' => true ]);
        Permission::updateOrCreate(['name' => 'contactUs_delete', /*'guard_name' => 'web',*/ 'slug' => 'contactUs.delete','status' => true ]);

        // Yachts
        Permission::updateOrCreate(['name' => 'yachts_index', /*'guard_name' => 'web',*/ 'slug' => 'yachts.index','status' => true ]);
        Permission::updateOrCreate(['name' => 'yachts_create', /*'guard_name' => 'web',*/ 'slug' => 'yachts.create','status' => true ]);
        Permission::updateOrCreate(['name' => 'yachts_update', /*'guard_name' => 'web',*/ 'slug' => 'yachts.update','status' => true ]);
        Permission::updateOrCreate(['name' => 'yachts_delete', /*'guard_name' => 'web',*/ 'slug' => 'yachts.delete','status' => true ]);

        // Reservations
        Permission::updateOrCreate(['name' => 'reservations_index', /*'guard_name' => 'web',*/ 'slug' => 'reservations.index','status' => true ]);

        // Marasi
        Permission::updateOrCreate(['name' => 'marasi_index', /*'guard_name' => 'web',*/ 'slug' => 'marasi.index','status' => true ]);
        Permission::updateOrCreate(['name' => 'marasi_create', /*'guard_name' => 'web',*/ 'slug' => 'marasi.create','status' => true ]);
        Permission::updateOrCreate(['name' => 'marasi_update', /*'guard_name' => 'web',*/ 'slug' => 'marasi.update','status' => true ]);
        Permission::updateOrCreate(['name' => 'marasi_delete', /*'guard_name' => 'web',*/ 'slug' => 'marasi.delete','status' => true ]);

        // Marasi Owners
        Permission::updateOrCreate(['name' => 'marasi_owners_index', /*'guard_name' => 'web',*/ 'slug' => 'marasi owners.index','status' => true ]);
        Permission::updateOrCreate(['name' => 'marasi_owners_create', /*'guard_name' => 'web',*/ 'slug' => 'marasi owners.create','status' => true ]);
        Permission::updateOrCreate(['name' => 'marasi_owners_update', /*'guard_name' => 'web',*/ 'slug' => 'marasi owners.update','status' => true ]);
        Permission::updateOrCreate(['name' => 'marasi_owners_delete', /*'guard_name' => 'web',*/ 'slug' => 'marasi owners.delete','status' => true ]);

        //Marasi Reservations
        Permission::updateOrCreate(['name' => 'marasi_reservations_index', /*'guard_name' => 'web',*/ 'slug' => 'marasi reservations.index','status' => true ]);
        Permission::updateOrCreate(['name' => 'marasi_reservations_update', /*'guard_name' => 'web',*/ 'slug' => 'marasi reservations.update','status' => true ]);
        Permission::updateOrCreate(['name' => 'marasi_reservations_delete', /*'guard_name' => 'web',*/ 'slug' => 'marasi reservations.delete','status' => true ]);

        // Specifications
        Permission::updateOrCreate(['name' => 'specifications_index', /*'guard_name' => 'web',*/ 'slug' => 'specifications.index','status' => true ]);
        Permission::updateOrCreate(['name' => 'specifications_create', /*'guard_name' => 'web',*/ 'slug' => 'specifications.create','status' => true ]);
        Permission::updateOrCreate(['name' => 'specifications_update', /*'guard_name' => 'web',*/ 'slug' => 'specifications.update','status' => true ]);
        Permission::updateOrCreate(['name' => 'specifications_delete', /*'guard_name' => 'web',*/ 'slug' => 'specifications.delete','status' => true ]);

        // Gas Stations
        Permission::updateOrCreate(['name' => 'gas_stations_index', /*'guard_name' => 'web',*/ 'slug' => 'gas stations.index','status' => true ]);
        Permission::updateOrCreate(['name' => 'gas_stations_create', /*'guard_name' => 'web',*/ 'slug' => 'gas stations.create','status' => true ]);
        Permission::updateOrCreate(['name' => 'gas_stations_update', /*'guard_name' => 'web',*/ 'slug' => 'gas stations.update','status' => true ]);
        Permission::updateOrCreate(['name' => 'gas_stations_delete', /*'guard_name' => 'web',*/ 'slug' => 'gas stations.delete','status' => true ]);

        // Ratings
        Permission::updateOrCreate(['name' => 'ratings_index', /*'guard_name' => 'web',*/ 'slug' => 'ratings.index','status' => false ]);

        // Reports
        Permission::updateOrCreate(['name' => 'reports_index', /*'guard_name' => 'web',*/ 'slug' => 'reports.reservations','status' => true ]);
        Permission::updateOrCreate(['name' => 'reports_update', /*'guard_name' => 'web',*/ 'slug' => 'reports.search','status' => true ]);
    }
}
