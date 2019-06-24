<?php

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
	    DB::table('users')->insert([
	    'role'    => 'dosen',
            'name'     => 'dwi',
            'email'    => 'dwi@its.ac.id',
            'idUser'   =>'1',
            'role'     =>'dosen',
            'has_finish_tour'   => '1',
            'password' => bcrypt('12345678'),
        ]);
    }
}
