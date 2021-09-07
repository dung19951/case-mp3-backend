<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = new User();
        $user->name = 'Justin timbersaw';
        $user->gender ='male';
        $user->address = 'New York';
        $user->password = Hash::make('123456');
        $user->email = 'justin@gmail.com';
        $user->phone = 123123132;
        $user->save();
    }
}
