<?php

namespace App\Http\Requests;

use App\Holiday;

class HolidayRequest extends Request
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
        $rules['name']      = 'required';

        switch ($this->method())
        {
            case 'PUT':
            case 'POST':
                $rules['holiday_date']       = 'required|unique:holidays,holiday_date';
            break;

            case 'PATCH':
                $holiday = Holiday::find(request()->id);
                $rules['holiday_date']       = 'required|unique:holidays,holiday_date,'.$holiday->id;
            break;
        }
        return $rules;
    }
}
