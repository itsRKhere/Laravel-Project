<?php

namespace Modules\ToDo\Entities;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\User\Entities\UserModel;

class TasksModel extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'Tasks';

    protected static function newFactory()
    {
        return \Modules\ToDo\Database\factories\TasksModelFactory::new ();
    }

    public function users()
    {
        return $this->belongsToMany(UserModel::class, 'User_Tasks', 'Task_id', 'User_id');
    }
}
