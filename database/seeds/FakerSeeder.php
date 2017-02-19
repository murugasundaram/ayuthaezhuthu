<?php

use Illuminate\Database\Seeder;

class FakerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();

        // Create Tenant/Organisation/Instance
        for($i = 0; $i < 50; $i ++)
        {
            App\Tenant::create([
                'name' => $faker->name,
                'organisation_name' => $faker->company,
                'organisation_unique_name' => $faker->domainWord,
                'email' => $faker->companyEmail,
                'status' => 2,
                'created_at' => $faker->dateTime,
                'updated_at' => $faker->dateTime
            ]);
        }

        // Create Users
        for($i = 0; $i < 100; $i++) {
            $name = $faker->name;
            App\User::create([
                'name' => $name,
                'email' => $faker->email,
                'password' => bcrypt($name),
                'is_admin' => $faker->boolean,
                'organisation_id' => $faker->numberBetween(1, 50),
                'created_at' => $faker->dateTime,
                'updated_at' => $faker->dateTime
            ]);
        }

        $roles = array('admin', 'sales', 'support', 'guest');
        foreach($roles as $role) {
            // Create Roles
            \Spatie\Permission\Models\Role::create([
                'name' => $role, 'organisation_id' => 1, 'created_at' => $faker->dateTime, 'updated_at' => $faker->dateTime
            ]);
        }

        $permissions = array('edit user', 'delete user', 'edit contact', 'delete contact');
        foreach($permissions as $permission) {
            // Create permission
            \Spatie\Permission\Models\Permission::create([
                'name' => $permission, 'organisation_id' => 1, 'created_at' => $faker->dateTime, 'updated_at' => $faker->dateTime
            ]);
        }
    }
}
