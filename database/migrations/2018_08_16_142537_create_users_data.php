<?php

use Illuminate\Database\Migrations\Migration;

class CreateUsersData extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        \AuthUser\Models\User::create([
            'name' => config('authuser.user_default.name'),
            'email' => config('authuser.user_default.email'),
            'password' => bcrypt(config('authuser.user_default.password')),
            'verified' => true
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::disableForeignKeyConstraints();
        $user = \AuthUser\Models\User::where('email', config('authuser.user_default.email'));
        $user->forceDelete();
        Schema::enableForeignKeyConstraints();
    }
}
