<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use App\User;

class TaskUser extends Model
{
    protected $table = 'task_user';

    /**
     * Relationship to tasks.
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function task()
    {
        return $this->belongsTo('App\Models\Task');
    }

    /**
     * Relationship to users.
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    /**
     * Get users that have not yet been assigned to the task.
     * @param $task_id
     * @return mixed
     */
    public static function getAvailableUser($task_id)
    {
        $result = User::select('users.id', 'users.first_name')
            ->whereNotExists(function ($query) use ($task_id)
            {
                $query->select('task_user.id')
                    ->from('task_user')
                    ->where('task_user.user_id', 'users.id')
                    ->where('task_user.task_id', $task_id);
            })->get();

        return $result;
    }

    /**
     * Get users assigned to task.
     * @param $task_id
     * @return mixed
     */
    public static function getAssignedUser($task_id)
    {
        return TaskUser::where('task_id', $task_id)
            ->get();
    }
}
