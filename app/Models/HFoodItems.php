<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HFoodItems extends Model
{
    use HasFactory;
    protected $fillable = [
        'id', 'name', 'category', 'description', 'food_type_id'
    ];
}
