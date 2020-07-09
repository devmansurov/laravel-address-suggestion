<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use danielme85\LaravelLogToDB\Models\LogToDbCreateObject;

class Log extends Model
{
    use LogToDbCreateObject;

    protected $table = 'log';
    
    protected $connection = 'sqlite';

    protected $casts = [
    	"extra" => "array",
    	"message" => "array"
    ];
}
