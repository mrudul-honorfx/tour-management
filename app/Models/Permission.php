<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\PermissionMapping;

class Permission extends Model
{
    use HasFactory;
    protected $fillable = [
        'id','category_id','permission'
    ];

    public function mappings()
    {
        return $this->belongsToMany(Role::class, 'permission_mappings', 'permission_id', 'role_id');
    }
}
