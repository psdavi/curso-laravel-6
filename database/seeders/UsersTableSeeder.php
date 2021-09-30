<?php

namespace Database\Seeders;

use App\Models\User;
use Faker\Factory;
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

        //cria 10 usuarios aleatórios
        User::factory()->count(10)->create();

        /* CRIA ESSE REGISTRO NO BANCO
        DEVE SER CHAMADO NO DATABASE SEEDER E FILLABLE NO MODEL
        User::create([
            'name' => 'Davi Pires',
            'email' => 'davi@gmail.com',
            'password' => bcrypt('12345678'),
        ]);
        */
    }
}
