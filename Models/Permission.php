<?php

namespace AuthUser\Models;

use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    protected $fillable = ['name', 'descriprion'];

    public function roles(){
        return $this->belongsToMany(Role::class);
    }
}
