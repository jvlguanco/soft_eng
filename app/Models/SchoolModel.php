<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SchoolModel extends Model
{
    use HasFactory;

    protected $table = 'app_form_school';
    protected $guarded = [];
}
