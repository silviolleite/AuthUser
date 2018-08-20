<?php

use AuthUser\Models\Role;
use AuthUser\Models\User;
use Illuminate\Database\Migrations\Migration;

class CreateAclData extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $roleAdmin = Role::create([
            'name' => config('authuser.acl.role_admin'),
            'description' => 'Papél de usuário master do sistema'
        ]);
        $user = User::where('email', config('authuser.user_default.email'))->first();
        $user->roles()->save($roleAdmin);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        $roleAdmin = Role::where('name', config('authuser.acl.role_admin'))->first();
        $user = User::where('email', config('authuser.user_default.email'))->first();
        $user->roles()->detach($roleAdmin->id);
        $roleAdmin->delete();
    }
}
