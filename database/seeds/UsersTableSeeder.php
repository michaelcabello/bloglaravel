<?php
use App\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::truncate();
        $user = new User;
        $user->name = 'Michael Cabello';
        $user->email = 'mcaal@hotmail.com';
        $user->password = bcrypt('123456');
        $user->save();
    }
}
