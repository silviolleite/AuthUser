<?php

namespace AuthUser\Models;

use Bootstrapper\Interfaces\TableInterface;
use Illuminate\Database\Eloquent\SoftDeletes;
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
class User extends Authenticatable implements TableInterface
{
    use Notifiable;
    use SoftDeletes;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];
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

    public static function generatePassword($password = null){
        return !$password ? bcrypt(str_random(8)): bcrypt($password);
    }


    public function getTableHeaders()
    {
        return ['#', 'Nome', 'E-mail'];
    }

    public function getValueForHeader($header)
    {
        switch ($header){
            case '#':
                return $this->id;
            case 'Nome':
                return $this->name;
            case 'E-mail':
                return $this->email;
        }
    }


    public function books(){
        return $this->hasMany('CodeEduBook\Models\Book', 'user_id');
    }
}
