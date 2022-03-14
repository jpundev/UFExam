<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Domains extends Model
{
    protected $table = 'domains';
    protected $primaryKey = 'id';
    protected $guarded = [];
    public $timestamps = false;
}
