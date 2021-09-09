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
        $user->id = 1;
        $user->name = 'khoi123';
        $user->gender = 'male';
        $user->address = 'Lang son';
        $user->password = Hash::make('123456');
        $user->email = 'khoi123@gmail.com';
        $user->avatar = 'https://i.pinimg.com/600x315/1e/d3/0d/1ed30d98f49be532ae58c62f33677b16.jpg';
        $user->hobby = 'xem phim';
        $user->phone = '098778344';
        $user->save();

    }
}
