<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $table = 'tasks';

    protected $fillable = [
        'milestone_id',
        'task_name',
        'task_description',
        'start_date',
        'due_date',
        'completion_status',
        'notes',
        'predecessor_task_id'
    ];

    /**
     * Relationship to tasks table.
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function milestone()
    {
        return $this->belongsTo('App\Models\Milestone');
    }

    /**
     * Relationship to task_users table.
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function taskUser()
    {
        return $this->hasMany('App\Models\TaskUser');
    }

    /**
     * Check if user is assigned to this task.
     * @param $task_id
     * @return bool
     */
    public static function hasTaskUser($task_id)
    {
        if (TaskUser::where('task_id', $task_id)->first())
        {
            return true;
        }

        return false;
    }

    /**
     * Check if predecessor task exists.
     * @param $task_id
     * @return bool
     */
    public static function hasPredecessorTask($task_id)
    {
        if (Task::where('predecessor_task_id', $task_id)->first())
        {
            return true;
        }

        return false;
    }

    /**
     * Store new record for task.
     * @param $request
     * @return bool
     */
    public static function storeRecord($request)
    {
        $task = new Task;

        if ($task::create($request->all()))
        {
            return true;
        }

        return false;
    }

    /**
     * Update task record.
     * @param $request
     * @return bool
     */
    public static function updateRecord($request)
    {
        $task = Task::find($request['id']);

        if ($task->update($request->all()))
        {
            return true;
        }

        return false;
    }
}
