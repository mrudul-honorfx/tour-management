<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Permission;

class PermissionMapping extends Model
{
    use HasFactory;

    protected $fillable = [
        'id', 'role_id','permission_id'
    ];

    public function permission()
    {
        return $this->belongsTo(Permission::class);
    }
    
}
