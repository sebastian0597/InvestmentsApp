<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Omar Yesid Ibanez Ortiz',
            'email' => 'oibanez30@unab.edu.co',
            'password' => bcrypt('OMARibanez9704'),
            'personal_code' => 'OIBA4511',
            'ind_first_login' => 1,
            'start_sesion_date' => date('Y-m-d H:i:s')
        ])->assignRole('ADMINISTRADOR');
    }
}
