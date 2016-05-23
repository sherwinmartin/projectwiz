<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);

        // get now in utc
        $now = \Carbon\Carbon::now();

        // initialize faker
        $faker = Faker\Factory::create();

        /**
         * Roles table seed.
         */
        DB::table('roles')->insert(
            [
                [
                    'id'        => 1,
                    'role_name'      => 'admin'
                ],
                [
                    'id'        => 2,
                    'role_name'      => 'staff'
                ],
                [
                    'id'        => 3,
                    'role_name'      => 'manager'
                ]
            ]
        );

        /**
         * Users table seed.
         */
        DB::table('users')->insert(
            [
                [
                    'id'        => 1,
                    'role_id'   => 1,
                    'first_name'    => 'admin',
                    'last_name'     => 'admin',
                    'username'      => 'admin',
                    'email'         => 'admin@projectwiz.net',
                    'password'      => Hash::make('password'),
                    'created_at'    => $now,
                    'updated_at'    => $now
                ],
                [
                    'id'        => 2,
                    'role_id'   => 2,
                    'first_name'    => 'user',
                    'last_name'     => 'user',
                    'username'      => 'user',
                    'email'         => 'user@projectwiz.net',
                    'password'      => Hash::make('password'),
                    'created_at'    => $now,
                    'updated_at'    => $now
                ],
                [
                    'id'        => 3,
                    'role_id'   => 3,
                    'first_name'    => 'manager',
                    'last_name'     => 'manager',
                    'username'      => 'manager',
                    'email'         => 'manager@projectwiz.net',
                    'password'      => Hash::make('password'),
                    'created_at'    => $now,
                    'updated_at'    => $now
                ]
            ]
        );

        /**
         * Clients table seed.
         */
        DB::table('clients')->insert(
            [
                [
                    'id'            => 1,
                    'client_name'   => $faker->company,
                    'created_at'    => $now,
                    'updated_at'    => $now
                ],
                [
                    'id'            => 2,
                    'client_name'   => $faker->company,
                    'created_at'    => $now,
                    'updated_at'    => $now
                ],
                [
                    'id'            => 3,
                    'client_name'   => $faker->company,
                    'created_at'    => $now,
                    'updated_at'    => $now
                ]
            ]
        );

        /**
         * Holidays table seed.
         */
        DB::table('holidays')->insert(
            [
                [
                    'id'            => 1,
                    'holiday_name'  => 'New Year\'s Day',
                    'holiday_date'  => '2016-01-01',
                    'created_at'    => $now,
                    'updated_at'    => $now
                ],
                [
                    'id'            => 2,
                    'holiday_name'  => 'Valentines Day',
                    'holiday_date'  => '2016-02-14',
                    'created_at'    => $now,
                    'updated_at'    => $now
                ]
            ]
        );
    }
}
