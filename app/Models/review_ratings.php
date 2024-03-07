<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class review_ratings extends Model
{
    
    use HasFactory;
    
    protected $fillable=
    ['appartment_id',
     'comment','star_rating','owner'];
}
