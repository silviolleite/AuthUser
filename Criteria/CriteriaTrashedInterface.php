<?php
/**
 * Created by PhpStorm.
 * User: Silvio Leite
 * Date: 19/06/2018
 * Time: 09:56
 */
namespace AuthUser\Criteria;

interface CriteriaTrashedInterface {
    public function onlyTrashed();
    public function withTrashed();
}