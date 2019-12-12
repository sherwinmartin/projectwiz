<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Holiday extends Model
{
    protected $table = 'holidays';

    /**
     * Create new holiday record.
     * @param $request
     * @return bool
     */
    public static function storeRecord($request)
    {
        $holiday = new Holiday;
        $holiday->name = $request->name;
        $holiday->holiday_date = $request->holiday_date;

        if ($holiday->save())
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
        $holiday = Holiday::find($request->id);

        $holiday->name = $request->name;
        $holiday->holiday_date = $request->holiday_date;

        if ($holiday->save())
        {
            return true;
        }

        return false;
    }
}
