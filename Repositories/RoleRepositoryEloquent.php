<?php

namespace AuthUser\Repositories;

use AuthUser\Criteria\CriteriaTrashedTrait;
use App\Repositories\RepositoryRestoreTrait;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use AuthUser\Models\Role;

/**
 * Class UserRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class RoleRepositoryEloquent extends BaseRepository implements RoleRepository
{
    use CriteriaTrashedTrait;
    use RepositoryRestoreTrait;

    protected $fieldSearchable = [
        'name' => 'like'
    ];
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Role::class;
    }



    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

    public function listsWithMutators($column, $key = null)
    {
        $collection = $this->all();
        return $collection->pluck($column, $key);
    }

}
