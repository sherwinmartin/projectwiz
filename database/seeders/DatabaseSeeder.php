<?php
namespace Database\Seeders;

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
                    #'id'        => 1,
                    'role_name'      => 'admin'
                ],
                [
                    #'id'        => 2,
                    'role_name'      => 'staff'
                ],
                [
                    #'id'        => 3,
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
                    #'id'        => 1,
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
                    #'id'        => 2,
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
                    #'id'        => 3,
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
                    #'id'            => 1,
                    'client_name'   => $faker->company,
                    'created_at'    => $now,
                    'updated_at'    => $now
                ],
                [
                    #'id'            => 2,
                    'client_name'   => $faker->company,
                    'created_at'    => $now,
                    'updated_at'    => $now
                ],
                [
                    #'id'            => 3,
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
                    #'id'            => 1,
                    'name'          => 'New Year\'s Day',
                    'holiday_date'  => '2016-01-01',
                    'created_at'    => $now,
                    'updated_at'    => $now
                ],
                [
                    #'id'            => 2,
                    'name'          => 'Valentines Day',
                    'holiday_date'  => '2016-02-14',
                    'created_at'    => $now,
                    'updated_at'    => $now
                ]
            ]
        );

        /**
         * Projects table seed.
         */
        for ($i=1; $i<10; $i++)
        {
            $random_days = rand(1,1000);
            DB::table('projects')->insert(
                [
                    #'id'            => $i,
                    'client_id'     => rand(1,3),
                    'project_name'  => $faker->company.' Project',
                    'project_lead_name' => $faker->name,
                    'project_lead_email_address'    => $faker->companyEmail,
                    'project_lead_phone_number'     => $faker->phoneNumber,
                    'project_description'           => $faker->paragraph(),
                    'start_date'    => date('Y-m-d', strtotime('-'.$random_days.' days')),
                    'due_date'      => date('Y-m-d', strtotime($random_days.' days')),
                    'created_at'    => $now,
                    'updated_at'    => $now
                ]
            );
        }

        /**
         * Milestone table seed. Note that the start and due dates are not being check to see if they are within
         * the date range of the project's start and due dates.
         */
        for ($i=1; $i<20; $i++)
        {
            $random_days = rand(1, 900);
            DB::table('milestones')->insert(
                [
                    #'id'            => $i,
                    'project_id'    => rand(1,3),
                    'milestone_name'    => $faker->company.' Milestone',
                    'start_date'    => date('Y-m-d', strtotime('-'.$random_days.' days')),
                    'due_date'      => date('Y-m-d', strtotime($random_days.' days')),
                    'created_at'    => $now,
                    'updated_at'    => $now
                ]
            );
        }

        /**
         * Tasks table seed.
         */
        for ($i=1; $i<20; $i++)
        {
            $random_days = rand(1, 800);
            DB::table('tasks')->insert(
                [
                    'milestone_id'      => rand(1, 5),
                    'task_name'         => $faker->jobTitle.' Task',
                    'task_description'  => $faker->sentence,
                    'start_date'        => date('Y-m-d', strtotime('-'.$random_days.' days')),
                    'due_date'          => date('Y-m-d', strtotime($random_days.' days')),
                    'completion_status' => rand(1, 100),
                    'notes'             => $faker->sentence,
                    'created_at'    => $now,
                    'updated_at'    => $now
                ]
            );
        }
    }
}
