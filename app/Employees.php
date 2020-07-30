<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Employees extends Model
{
    protected $fillable = ['name_first', 'name_last', 'company_id', 'email', 'telephone'];
}
