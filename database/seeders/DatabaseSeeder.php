<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Profile;
use App\Models\Mbarang;
use App\Models\Tpembelian;
use App\Models\Tpembelianbarang;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

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
        
        //Users
        $password = 'password';
        User::create([
            'name' => 'Admin',
            // 'username' => 'Admin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make($password),
            'chain' => 'password',
            'role' => 'Admin',
        ]);

        User::create([
            'name' => 'Dara Rangga',
            // 'username' => 'Dara',
            'email' => 'dara@gmail.com',
            'password' => Hash::make($password),
            'chain' => 'password',
            'role' => 'Staff',
        ]);
        //Users

    }
}