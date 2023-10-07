<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\PermissionMapping;
use App\Models\Permission;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'profile_pic',
        'role_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    public function permissions()
    {
        // Fetch permission IDs associated with the user's role
        $rolePermissions = PermissionMapping::where('role_id', $this->role_id)
        ->pluck('permission_id');

        // Fetch permission details based on the IDs
        $userPermissions = Permission::select('permission')->whereIn('id', $rolePermissions)->get();

        return $userPermissions;
    }
    public function hasPermission($permission)
    {
        // Check if the user has the permission based on their role
        return $this->role->permissions->contains('name', $permission);
    }
}
