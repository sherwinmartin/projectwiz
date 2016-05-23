<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    protected $table = 'clients';
    
    protected $fillable = ['client_name'];
    
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
