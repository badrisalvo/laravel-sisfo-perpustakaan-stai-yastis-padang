<?php

namespace Database\Seeders;

use App\models\Buku;
use App\models\User;
use App\Models\Profile;
use App\models\Kategori;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the Application's database.
     *
     * @return void
     */
    public function run()
    {
     //App\models\User::factory(10)->create();

     User::create([
        'name'=> 'admin',
        'email'=>'admin@stai.com',
        'password' => Hash::make('admin123'),
        'isAdmin' => '1',
     ]);
     

     Profile::create([
    'npm'=>'admin',
    'prodi'=>'admin',
    'alamat'=>'kampus',
    'noTelp'=>'admin',
    'users_id'=>'1',
    ]);

     
    }
}
