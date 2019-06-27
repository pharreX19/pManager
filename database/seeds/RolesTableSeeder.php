<?php

use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->insert([
            'role'=>'Guest',
            'created_at'=>'2019-01-01',
            'updated_at'=>'2019-01-01'
        ]);
    }
}
