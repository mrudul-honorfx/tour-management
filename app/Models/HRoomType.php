<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HRoomType extends Model
{
    use HasFactory;
    protected $fillable = [
        'id', 'room_type_code', 'room_type_name', 'description', 'images'
    ];
}
