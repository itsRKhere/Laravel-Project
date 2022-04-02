<?php

namespace Modules\ToDo\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class UserTasksModel extends Model
{
    use HasFactory;

    protected $table = 'User_Tasks';
    protected $fillable = [];
    
    protected static function newFactory()
    {
        return \Modules\ToDo\Database\factories\UserTasksModelFactory::new();
    }

}
