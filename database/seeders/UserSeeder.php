<?php

namespace Database\Seeders;

use App\Models\Municipality;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;
use App\Services\ActivityLogsService;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(ActivityLogsService $service)
    {
        $total_municipalities = Municipality::count();

        $users = array(
            // generate sample admin
             [
                'id' => 1,
                'first_name' => 'Admin',
                'middle_name' => 'P',
                'last_name' => 'Admin',
                'sex' => 'male',
                'birth_date' => '1998/01/01',
                'address' => 'Sample Address',
                'municipality_id' => mt_rand(1, $total_municipalities),
                'contact' => '09659312005',
                'email' => 'admin@gmail.com', 
                'password' => bcrypt('test1234'),
                'email_verified_at' => now(),
                'is_activated' => true, 
                'role_id' => Role::ADMIN,
                'gasoline_station_id' => null,
                'created_at' => now()
             ],
 
           // generate sample gasoline staff
            [
                'id' => 2,
                'first_name' => 'John',
                'middle_name' => 'D',
                'last_name' => 'Doe',
                'sex' => 'male',
                'birth_date' => '1998/01/01',
                'address' => 'Sample Address',
                'municipality_id' => mt_rand(1, $total_municipalities),
                'contact' => '09659312005',
                'email' => 'staff@gmail.com', 
                'password' => bcrypt('test1234'),
                'email_verified_at' => now(),
                'is_activated' => true, 
                'role_id' => Role::STAFF,
                'gasoline_station_id' => 1,
                'created_at' => now()
            ],

            // generate sample user
            [
                'id' => 3,
                'first_name' => 'Dev',
                'middle_name' => 'Dummy',
                'last_name' => 'Dev',
                'sex' => 'male',
                'birth_date' => '1998/01/01',
                'address' => 'Sample Address',
                'municipality_id' => mt_rand(1, $total_municipalities),
                'contact' => '09659312005',
                'email' => 'imdevaes@gmail.com', 
                'password' => bcrypt('test1234'),
                'email_verified_at' => now(),
                'is_activated' => true, 
                'role_id' => Role::USER,
                'gasoline_station_id' => null,
                'created_at' => now()
            ],
            [
                'id' => 4,
                'first_name' => 'Benedict ',
                'middle_name' => 'R',
                'last_name' => 'Reyes',
                'sex' => 'male',
                'birth_date' => '2001/01/01',
                'address' => 'Sample Address',
                'municipality_id' => mt_rand(1, $total_municipalities),
                'contact' => '09488787896',
                'email' => 'hanzbndctreyes18@gmail.com', 
                'password' => bcrypt('test1234'),
                'email_verified_at' => now(),
                'is_activated' => true, 
                'role_id' => Role::USER,
                'gasoline_station_id' => null,
                'created_at' => now()
            ],
            [
                'id' => 5,
                'first_name' => 'Rofel',
                'middle_name' => 'M',
                'last_name' => 'Manchete',
                'sex' => 'male',
                'birth_date' => '2001/01/01',
                'address' => 'Sample Address',
                'municipality_id' => mt_rand(1, $total_municipalities),
                'contact' => '09763669766',
                'email' => 'rmanchete96@gmail.com', 
                'password' => bcrypt('test1234'),
                'email_verified_at' => now(),
                'is_activated' => true, 
                'role_id' => Role::USER,
                'gasoline_station_id' => null,
                'created_at' => now()
            ],
            [
                'id' => 6,
                'first_name' => 'Delerose',
                'middle_name' => 'M',
                'last_name' => 'Mortega',
                'sex' => 'female',
                'birth_date' => '2001/01/01',
                'address' => 'Sample Address',
                'municipality_id' => mt_rand(1, $total_municipalities),
                'contact' => '09487185592',
                'email' => 'mdelerose18@gmail.com', 
                'password' => bcrypt('test1234'),
                'email_verified_at' => now(),
                'is_activated' => true, 
                'role_id' => Role::USER,
                'gasoline_station_id' => null,
                'created_at' => now()
            ],
        );
 
          User::insert($users);

          User::all()->each(function($user) use($service){
            $user
            ->addMedia(public_path("/img/tmp_files/avatars/$user->id.png"))
            ->preservingOriginal()
            ->toMediaCollection('avatar_image');

            $service->log_activity(model:User::find(1), event:'added', model_name: 'User', model_property_name: $user->name ?? 'Administrator');
        });
    }
}