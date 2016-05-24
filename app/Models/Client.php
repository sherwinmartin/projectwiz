<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use App\Models\Project;

class Client extends Model
{
    protected $table = 'clients';
    
    protected $fillable = ['client_name'];

    /**
     * Relationship to projects.
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function projects()
    {
        return $this->hasMany('App\Models\Project');
    }

    /**
     * Find out if client has projects.
     * @param $client_id
     * @return bool
     */
    public static function hasProjects($client_id)
    {
        if (Project::where('client_id', $client_id)->first())
        {
            return true;
        }

        return false;
    }

    /**
     * Create new client record.
     * @param $request
     * @return bool
     */
    public static function storeRecord($request)
    {
        $client = new Client;

        if ($client::create($request->all()))
        {
            return true;
        }

        return false;
    }

    /**
     * Update client record.
     * @param $request
     * @return bool
     */
    public static function updateRecord($request)
    {
        $client = Client::where('id', $request['id'])->first();

        if ($client->update($request->all()))
        {
            return true;
        }

        return false;
    }
}
