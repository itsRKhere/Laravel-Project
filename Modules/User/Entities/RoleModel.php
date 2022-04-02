<?php

namespace Modules\User\Entities;

use App\Modules\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Modules\User\Entities\PrivilegeModel;
use Modules\User\Entities\UserModel;

class RoleModel extends Model
{
    use HasFactory;

    protected $fillable = [];

    protected static function newFactory()
    {
        return \Modules\User\Database\factories\RoleModelFactory::new ();
    }

    protected $table = 'Role';

    /**
     * Get all of the comments for the RoleModel
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function users()
    {
        return $this->belongsToMany(UserModel::class, 'user_role', 'role_id', 'user_id', 'Role_id', 'id');
    }

    /**
     * Get all of the comments for the PrivilegeModel
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function privileges()
    {
        return $this->belongsToMany(PrivilegeModel::class, 'role_privilege', 'role_id', 'privilege_id');
    }

    /**
     * Get all of the comments for the PrivilegeModel
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function user()
    {
        return $this->belongsToMany(User::class, 'user_role', 'role_id', 'user_id', 'Role_id', 'id');
    }

}
