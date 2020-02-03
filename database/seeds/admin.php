<?php

use Illuminate\Database\Seeder;

class admin extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         DB::table('users')->insert([
            'name' => 'Dhaval',
            'email' => 'dpithwa@codal.com',
            'password' => Hash::make('codal123'),
            'phone_no' => '9409057355',
            'type' => 0,
        ]);
    }
}
