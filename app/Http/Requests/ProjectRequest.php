<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

use App\Models\Project;

class ProjectRequest extends Request
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
        $project = Project::find(Request::get('id'));

        $rules = [
            'client_id'             => 'required',
            'project_name'          => 'required',
            'project_lead_email_address'    => 'email'

        ];

        /*switch($this->method())
        {
            case 'POST':
            case 'PUT':

            break;

            case 'PATCH':

            break;
        }*/
        return $rules;
    }
}
