<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Holiday extends Model
{
    protected $table = 'holidays';

    protected $fillable = [
        'holiday_name', 'holiday_date'
    ];

    /**
     * Create new holiday record.
     * @param $request
     * @return bool
     */
    public static function storeRecord($request)
    {
        $holiday = new Holiday;

        if ($holiday::create($request->all()))
        {
            return true;
        }

        return false;
    }

    /**
     * Update holiday record.
     * @param $request
     * @return bool
     */
    public static function updateRecord($request)
    {
        $holiday = Holiday::find($request['id']);

        if ($holiday->update($request->all()))
        {
            return true;
        }

        return false;
    }
}
