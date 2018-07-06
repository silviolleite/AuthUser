<?php

namespace AuthUser\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

/**
 * AuthUser\Models\User
 *
 * @property int $id
 * @property string $name
 * @property string $email
 * @property string $password
 * @property string|null $remember_token
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @method static \Illuminate\Database\Eloquent\Builder|\AuthUser\Models\User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\AuthUser\Models\User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\AuthUser\Models\User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\AuthUser\Models\User whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\AuthUser\Models\User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\AuthUser\Models\User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\AuthUser\Models\User whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property-read \Illuminate\Database\Eloquent\Collection|\CodeEduBook\Models\Book[] $books
 */
class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function books(){
        return $this->hasMany('CodeEduBook\Models\Book', 'user_id');
    }
}
