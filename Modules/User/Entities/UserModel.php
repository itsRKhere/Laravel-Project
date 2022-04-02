<?php

namespace Modules\User\Entities;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Modules\ToDo\Entities\TasksModel;
use Modules\User\Entities\RoleModel;

class UserModel extends Model
{
    use HasFactory;

    protected $fillable = [];

    protected static function newFactory()
    {
        return \Modules\User\Database\factories\UserModelFactory::new ();
    }

    protected $table = 'User_data';

    /**
     * Get the user that owns the RoleModel
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function roles()
    {
        return $this->belongsToMany(RoleModel::class, 'user_role', 'user_id', 'role_id', 'id', 'Role_id');
    }

    /**
     * Get the user that owns the TaskModel
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function tasks()
    {
        return $this->belongsToMany(TasksModel::class, 'User_Tasks', 'User_id', 'Task_id', 'id', 'Task_id');
    }

}
