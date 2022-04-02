<?php

namespace Modules\User\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\User\Entities\RoleModel; 

class PrivilegeModel extends Model
{
    use HasFactory;

    protected $fillable = [];
    
    protected static function newFactory()
    {
        return \Modules\User\Database\factories\PrivilegeModelFactory::new();
    }

    /**
     * Get all of the comments for the RoleModel
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function roles(){
        return $this->belongsToMany(RoleModel::class,'role_privilege','role_id','privilege_id');
    }
}
