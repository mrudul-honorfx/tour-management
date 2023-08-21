<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HViewType extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',  'view_type_name', 'description',
    ];
}
