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
        // Add new tenant
        DB::table('saas_tenants')->insert([
            ['name' => 'Smackcoders', 'organisation_name' => 'Smackcoders', 'organisation_unique_name' => 'smackcoders', 'email' => 'info@smackcoders.com', 'status' => 2, 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')]
        ]);

        // Add new user for that tenant
        DB::table('saas_users')->insert([
            ['name' => 'Smackcoders', 'password' => bcrypt('smack5403'), 'is_admin' => 1, 'is_super_admin' => 1, 'organisation_id' => 1, 'email' => 'info@smackcoders.com', 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')]
        ]);

        DB::table('saas_reserved_keywords')->insert([
            ['name' => 'smackcoders'],
            ['name' => 'google'],
            ['name' => 'facebook'],
            ['name' => 'manohara'],
            ['name' => 'twitter'],
            ['name' => 'oracle'],
            ['name' => 'microsoft'],
            ['name' => 'linkedin']
        ]);
    }
}
