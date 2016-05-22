<?php namespace App\Helpers;

use Carbon\Carbon;
use Auth;
use App\User;
use App\Models\Holiday;

class ProjectwizHelper
{
    /**
     * Convert local timezone to UTC
     * @return static
     */
    public static function localToUtc()
    {
        $now = Carbon::createFromFormat('Y-m-d', date('Y-m-d'), getenv('LOCAL_TIMEZONE'));
        $now->setTimezone('UTC');

        return $now;
    }

    /**
     * Convert UTC time to local timezone
     * @param null $value
     * @return static
     */
    public static function utcToLocal($value=NULL)
    {
        if ($value) {
            $utc = new Carbon($value);
            return $utc->timezone(getenv('LOCAL_TIMEZONE'))->format('Y-m-d');
        } else {
            $utc = Carbon::now(getenv('LOCAL_TIMEZONE'));
        }

        return Carbon::createFromFormat('Y-m-d H:i:s', $utc)->format('Y-m-d');
    }

    /**
     * Check to see if role matches current logged in user.
     * @param $role_name
     * @return bool
     */
    public static function isRole($role_name)
    {
        if (!$role_name)
        {
            return false;
        }

        if (Auth::guest())
        {
            return false;
        }

        $user_id = Auth::User()->id;

        // get logged in user role_name
        $result = User::where('users.id', '=', $user_id)
            ->join('roles', 'roles.id', '=', 'users.role_id')
            ->select('roles.role_name')->first();

        if (!$result)
        {
            return false;
        }

        if ($result->role_name != $role_name)
        {
            return false;
        }
        return true;
    }

    /**
     * Get holidays records from database.
     * @return mixed|string
     */
    public static function getHolidays()
    {
        $holidays = Holiday::all();

        if (!$holidays->isEmpty())
        {
            foreach ($holidays as $holiday)
            {
                $result_array[] = date('n-j-Y', strtotime($holiday->holiday_date));
            }

            return json_encode($result_array);
        }
        return with('error', 'ERROR: No holiday found.');
    }

    /**
     * Generate random password based on arrays.
     * @return string
     */
    public static function generatePassword()
    {
        $arrImals[1] = "tiger";
        $arrImals[2] = "bear";
        $arrImals[3] = "dog";
        $arrImals[4] = "cat";
        $arrImals[5] = "iguana";
        $arrImals[6] = "penguin";
        $arrImals[7] = "falcon";
        $arrImals[8] = "mole";
        $arrImals[9] = "elephant";

        $arrColors[1] = "white";
        $arrColors[2] = "blue";
        $arrColors[3] = "black";
        $arrColors[4] = "purple";
        $arrColors[5] = "indigo";
        $arrColors[6] = "pink";
        $arrColors[7] = "grey";
        $arrColors[8] = "yellow";
        $arrColors[9] = "orange";

        $arrNum[1] = "1";
        $arrNum[2] = "2";
        $arrNum[3] = "3";
        $arrNum[4] = "4";
        $arrNum[5] = "5";
        $arrNum[6] = "6";
        $arrNum[7] = "7";
        $arrNum[8] = "8";
        $arrNum[9] = "9";

        $temp_password = $arrColors[array_rand($arrColors)].$arrImals[array_rand($arrImals)].$arrNum[array_rand($arrNum)];

        return $temp_password;
    }
}