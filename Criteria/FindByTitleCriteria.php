<?php
/**
 * Created by PhpStorm.
 * User: Silvio Leite
 * Date: 05/06/2018
 * Time: 10:50
 */

namespace AuthUser\Criteria;


use Prettus\Repository\Contracts\CriteriaInterface;
use Prettus\Repository\Contracts\RepositoryInterface;

class FindByTitleCriteria implements CriteriaInterface
{
    private $title;

    /**
     * FindByTitle constructor.
     * @param $title
     */
    public function __construct($title)
    {
        $this->title = $title;
    }

    /**
     * Apply criteria in query repository
     *
     * @param                     $model
     * @param RepositoryInterface $repository
     *
     * @return mixed
     */
    public function apply($model, RepositoryInterface $repository)
    {
        return $model->where('title', 'LIKE', '%'.$this->title.'%');
    }
}