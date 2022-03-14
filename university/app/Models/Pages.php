<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pages extends Model
{
    protected $table = 'web_pages';
    protected $primaryKey = 'id';
    protected $guarded = [];
    public $timestamps = false;
}
