<?php

use Illuminate\Database\Seeder;

class ReservedKeywordsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
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
