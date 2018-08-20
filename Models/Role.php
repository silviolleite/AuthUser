<?php

namespace AuthUser\Models;

use Bootstrapper\Interfaces\TableInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Role extends Model implements TableInterface
{
    use SoftDeletes;

    protected $fillable = ['name', 'description'];
    protected $dates = ['deleted_at'];


    public function getNameTrashedAttribute(){
        return $this->trashed() ? "{$this->name} (Inativa)": $this->name;
    }

    public function getTableHeaders()
    {
        return ['#', 'Nome', 'Descrição'];
    }

    public function getValueForHeader($header)
    {
        switch ($header){
            case '#':
                return $this->id;
            case 'Nome':
                return $this->name;
            case 'Descrição':
                return $this->description;
        }
    }

    public function permissions(){
        return $this->belongsToMany(Permission::class);
    }

    public function users(){
        return $this->belongsToMany(User::class);
    }

}
