<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class University extends Model
{
    protected $table = 'university';
    protected $primaryKey = 'id';
    protected $guarded = [];
    public $timestamps = false;
}
