<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Caves extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = ['cave_Number', 'cave_name', 'site_type', 'country_id', 'province_id', 'cave_description'];
}
