<?php

namespace Database\Seeders;

use App\Models\Post;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'admin',
            'email' => 'admin@admin.com',
            'password' => Hash::make('admin'),
        ]);
        User::factory()
            ->count(5)
            ->create();
        Role::create([
            'name' => 'Admin'
        ]);
        Role::create([
            'name' => 'Moderator'
        ]);
        Db::table('user_roles')->insert([
            'user_id' => 1,
            'role_id' => 1
        ]);
        Db::table('user_roles')->insert([
            'user_id' => 2,
            'role_id' => 2
        ]);
        Db::table('user_roles')->insert([
            'user_id' => 3,
            'role_id' => 2
        ]);
    }
}
