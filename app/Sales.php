<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sales extends Model
{
    //
    protected $table ='sales';
    protected $primaryKey='salesId';
    public $timestamps = false;
}
