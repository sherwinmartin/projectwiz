<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use App\User;
use DB;

class TaskUser extends Model
{
    protected $table = 'task_user';

    protected $fillable = [
        'task_id', 'user_id'
    ];

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
        $sql = "
        SELECT `users`.`id`, `users`.`first_name`
        FROM `users`
        WHERE NOT EXISTS(
          SELECT `task_user`.`id`
          FROM `task_user`
          WHERE `task_user`.`user_id` = `users`.`id`
            AND `task_user`.`task_id` = ?
        )
        ";
        $result = DB::select(DB::raw($sql), [$task_id]);
        
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


    public static function add($user_id, $task_id)
    {
        $task_user = new TaskUser;
        $task_user->task_id         = $task_id;
        $task_user->user_id         = $user_id;

        if ($task_user->save())
        {
            return true;
        }

        return false;
    }
}
