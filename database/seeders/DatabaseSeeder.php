<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Database\Seeders\UsersTableSeeder;
use Database\Seeders\PermissionsTableSeeder;
use Database\Seeders\SyaratSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        $this->call([
            UsersTableSeeder::class,
            PermissionsTableSeeder::class,
            JenisPelayananSeeder::class,
            IndoRegionSeeder::class,
            // SyaratSeeder::class,
            // RoleTableSeeder::class,
            
            // JenisTableSeeder::class,
            // SettingTableSeeder::class,
        ]);
    }
}
