<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use App\Models\Task;

class Milestone extends Model
{
    protected $table = 'milestones';

    protected $fillable = [
        'project_id', 'milestone_name', 'start_date', 'due_date'
    ];

    /**
     * Relationship to projects.
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function project()
    {
        return $this->belongsTo('App\Models\Project');
    }

    /**
     * Relationship to tasks.
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function tasks()
    {
        return $this->hasMany('App\Models\Task');
    }

    /**
     * Check if milestone has tasks.
     * @param $milestone_id
     * @return bool
     */
    public static function hasTask($milestone_id)
    {
        if (Task::where('milestone_id', $milestone_id)->first())
        {
            return true;
        }

        return false;
    }

    /**
     * Create new milestone record.
     * @param $request
     * @return bool
     */
    public static function storeRecord($request)
    {
        $milestone = new Milestone;

        if ($milestone::create($request->all()))
        {
            return true;
        }

        return false;
    }

    /**
     * Update milestone record.
     * @param $request
     * @return bool
     */
    public static function updateRecord($request)
    {
        $milestone = Milestone::find($request['id']);

        if ($milestone->update($request->all()))
        {
            return true;
        }

        return false;
    }
}
