<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use \BinaryCabin\LaravelUUID\Traits\HasUUID;

class DurianTree extends Model
{
	use HasUUID;

	protected $uuidFieldName = 'api_key';

    protected $fillable = [
    	'name', 'description', 'api_key', 'user_id'
    ];


}
