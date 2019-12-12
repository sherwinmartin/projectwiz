<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

use Auth;

class User extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * Relationship to role.
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function role()
    {
        return $this->belongsTo('App\Models\Role');
    }

    /**
     * Check the role of authenticated user.
     * @param $role_names
     * @return bool
     */
    public static function hasRoles($role_names)
    {
        if (Auth::check())
        {
            $role_names = explode(',', $role_names);
            // check the authenticated user's role against the database
            $check_role = User::select('roles.role_name')
                ->join('roles', 'roles.id', '=', 'users.role_id')
                ->where('users.id', Auth::User()->id)
                ->whereIn('roles.role_name', $role_names)
                ->first();

            return $check_role;
        }

        return false;
    }
}
