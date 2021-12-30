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
        User::factory()->count(50)->create();
        $user = User::find(1);
        $user->name = 'MoonShadow2333';
        $user->email = '1815265375@qq.com';
        $user->save();
    }
}
