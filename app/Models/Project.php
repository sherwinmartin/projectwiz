<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $table = 'projects';

    protected $fillable = [
        'client_id',
        'project_name',
        'project_lead_name',
        'project_lead_email_address',
        'project_lead_phone_number',
        'project_description',
        'start_date',
        'due_date'
    ];

    /**
     * Relationship to client.
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function client()
    {
        return $this->belongsTo('App\Models\Client');
    }

    /**
     * Relationship to milestones.
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function milestones()
    {
        return $this->hasMany('App\Models\Milestone');
    }

    /**
     * Check if project has milestones.
     * @param $project_id
     * @return bool
     */
    public static function hasMilestones($project_id)
    {
        if (Milestone::where('project_id', $project_id)->first())
        {
            return true;
        }

        return false;
    }

    /**
     * Create new project record.
     * @param $request
     * @return bool
     */
    public static function storeRecord($request)
    {
        $project = new Project;

        if ($project::create($request->all()))
        {
            return true;
        }

        return false;
    }

    /**
     * Update project record.
     * @param $request
     * @return bool
     */
    public static function updateRecord($request)
    {
        $project = Project::find($request['id']);

        if ($project->update($request->all()))
        {
            return true;
        }

        return false;
    }
}
