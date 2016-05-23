<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

use App\Models\Client;

class ClientRequest extends Request
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
        $client = Client::find($this->request['id']);
        switch ($this->method())
        {
            case 'PUT':
            case 'POST':
                $rules['client_name']       = 'required|unique:clients,client_name';
            break;

            case 'PATCH':
                $rules['client_name']       = 'required|unique:clients,client_name,'.$client->id;
            break;
        }
        return $rules;
    }
}
