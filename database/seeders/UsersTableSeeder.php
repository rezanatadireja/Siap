<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // !$user = User::where('email','admin@gmail.com')->first()
        if (!$user = User::whereEmailAndUsername('admin@gmail.com', 'administrator')->first()) {
            $user = User::create([
                'username' => 'administrator',
                'email' => 'admin@gmail.com',
                'password' => bcrypt('admin'),
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s"),
            ]);
        }
    }
}
