<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Session;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;


class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */

    protected $table = "users";
    protected $fillable = [
        'name','username','password','email', 'id'];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    // public function routeNotificationForTwilio()
    // {
    //     return $this->penduduk()->no_hp;
    // }

    public function checkPermission($permission_name)
    {
        $all_permissions = Session::get('permissions' . $this->id);
        if (empty($all_permissions)) {
            $all_permissions = $this->getAllPermissions()->pluck('name');
            $all_permissions = $all_permissions->toArray();
            Session::put('permissions' . $this->id, $all_permissions);
        }
        if (in_array($permission_name, $all_permissions)) {
            return true;
        }
        return false;
    }

    public function getAll($opt = null, $search = null)
    {
        $results = $this->with('roles')->latest();
        $per_page = !empty($search['per_page']) ? $search['per_page'] : 10;
        if (!empty($search)) {
            if (!empty($search['search'])) {
                $results = $results->where('name', 'LIKE', '%' . $search['search'] . '%')
                    ->orWhere('email', 'LIKE', '%' . $search['search'] . '%');
            }
        }
        if ($opt == 'paginate') {
            return $results->paginate($per_page);
        }
        return $results->get();
    }

    public function penduduk()
    {
        return $this->hasOne(Penduduk::class, 'user_id', 'id');
    }
}
