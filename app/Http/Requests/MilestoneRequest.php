<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

use App\Models\Project;

class MilestoneRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $project = Project::find(Request::get('project_id'));
        $rules = [
            'project_id'            => 'required',
            'milestone_name'        => 'required',
            'start_date'            => 'after:'.$project->start_date.'|before:due_date',
            'due_date'              => 'before:'.$project->due_date.'|after:start_date'
        ];
        return $rules;
    }
}
