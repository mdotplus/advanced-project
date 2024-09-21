<?php

namespace Database\Seeders;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $now = Carbon::now();

        $user = [
            'name' => 'admin',
            'authority_id' => 1,
            'email' => 'admin@rese.com',
            'email_verified_at' => $now,
            'password' => bcrypt('adminatrese')
        ];
        if (!UsersTableSeeder::isExist($user)) {
            DB::table('users')->insert($user);
        }

        if (App::environment('local')) {
            $user = [
                'name' => 'testManager',
                'authority_id' => 2,
                'email' => 'test.manager@rese.com',
                'email_verified_at' => $now,
                'password' => bcrypt('testmanageratrese')
            ];
            if (!UsersTableSeeder::isExist($user)) {
                DB::table('users')->insert($user);
            }

            $user = [
                'name' => 'testUser1',
                'authority_id' => 3,
                'email' => 'test.user.1@rese.com',
                'email_verified_at' => $now,
                'password' => bcrypt('testuser1atrese')
            ];
            if (!UsersTableSeeder::isExist($user)) {
                DB::table('users')->insert($user);
            }

            $user = [
                'name' => 'testUser2',
                'authority_id' => 3,
                'email' => 'test.user.2@rese.com',
                'email_verified_at' => $now,
                'password' => bcrypt('testuser2atrese')
            ];
            if (!UsersTableSeeder::isExist($user)) {
                DB::table('users')->insert($user);
            }

            $user = [
                'name' => 'testUser3',
                'authority_id' => 3,
                'email' => 'test.user.3@rese.com',
                'email_verified_at' => $now,
                'password' => bcrypt('testuser3atrese')
            ];
            if (!UsersTableSeeder::isExist($user)) {
                DB::table('users')->insert($user);
            }
        }
    }

    private function isExist($user)
    {
        if (
            User::where('name', $user['name'])
                ->where('email', $user['email'])
                ->first()
        ) {
            return true;
        }

        return false;
    }
}
