<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

use App\Models\Milestone;

class TaskRequest extends Request
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
        $milestone = Milestone::find(Request::get('milestone_id'));
        $rules = [
            'milestone_id'          => 'required',
            'task_name'             => 'required',
            'start_date'            => 'after:'.$milestone->start_date.'|before:due_date',
            'due_date'              => 'before:'.$milestone->due_date.'|after:start_date',
            'completion_status'     => 'required|numeric',
            'predecessor_task_id'   => 'numeric'
        ];
        return $rules;
    }
}
