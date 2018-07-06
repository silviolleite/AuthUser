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
        factory(\AuthUser\Models\User::class, 1)->create([
            'email' => 'admin@editora.com.br'
        ]);

        factory(\AuthUser\Models\User::class, 1)->create([
            'email' => 'contato@editora.com.br'
        ]);
    }
}
