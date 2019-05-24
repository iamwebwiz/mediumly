<?php

use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'Administrator',
            'email' => 'admin@mediumly.com',
            'is_admin' => true,
            'password' => bcrypt('securepass'),
            'remember_token' => Str::random(10),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $user_count = (int) $this->command->ask('How many users would you like to generate?', 5);

        $this->command->info("Creating {$user_count} users...");

        $users = factory(User::class, $user_count)->create();

        $this->command->info('Users created!');
    }
}
