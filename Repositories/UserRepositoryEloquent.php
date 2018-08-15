<?php

namespace AuthUser\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use AuthUser\Models\User;

/**
 * Class UserRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class UserRepositoryEloquent extends BaseRepository implements UserRepository
{
    public function create(array $attributes)
    {
        $attributes['password'] = User::generatePassword();
        $model = parent::create($attributes);
        \UserVerification::generate($model);
        $subject = config('authuser.email.user_created.subject');
        \UserVerification::emailView('authuser::emails.user-created');
        \UserVerification::send($model, $subject);
        return $model;
    }

    public function update(array $attributes, $id)
    {
        if (isset($attributes['password'])){
            $attributes['password'] = User::generatePassword($attributes['password']);
        }
        return parent::update($attributes, $id);
    }

    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return User::class;
    }



    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

}
