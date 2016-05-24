<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    protected $table = 'clients';
    
    protected $fillable = ['client_name'];

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
