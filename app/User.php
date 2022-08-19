<?php

namespace App;

use App\Events\UserSaved;
use App\Notifications\ResetPasswordNotification;
use App\Traits\CustomAttributesTrait;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Lang;
use Spatie\Permission\Traits\HasRoles;
use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable implements JWTSubject
{
    use Notifiable, HasRoles, CustomAttributesTrait;

    const ADMIN = 'Administrador';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'last_name',
        'email',
        'username',
        'password',
        'remember_token',
        'active',
        'is_admin'
    ];

    protected $uc_fields = [
        'name', 'last_name'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $table = 'users';
    protected $perPage = 20;

    protected $dispatchesEvents = [
        'saved' => UserSaved::class
    ];

    /**
     * @param Builder $builder
     * @param array $search
     * @return mixed
     */
    public function scopeSearch(Builder $builder, array $search)
    {
        foreach ($search as $column => $value) {
            switch ($column) {
                case 'full_name':
                    if ($value) {
                        $builder->where("name", "like", "%{$value}%")->orWhere("last_name", "like", "%{$value}%");
                    }
                    break;
                case 'email':
                    if ($value) {
                        $builder->where("email", "like", "%{$value}%");
                    }
                    break;
                case 'username':
                    if ($value) {
                        $builder->where("username", "like", "%{$value}%");
                    }
                    break;
                case 'role':
                    if ($value) {
                        $builder->whereHas('roles', function (Builder $query) use ($value) {
                            return $query->where('role_id', $value);
                        });
                    }
                    break;
                case 'active':
                    if ($value !== null) {
                        $builder->where('active', $value);
                    }
                    break;
            }
        }
        return $builder->orderBy('name', 'ASC')->orderBy('last_name', 'ASC');
    }

    /**
     * @return bool
     */
    public static function isAdmin()
    {
        return Auth::user() && Auth::user()->is_admin;
    }

    /**
     * @param Builder $query
     * @return Builder
     */
    public function scopeActive(Builder $query)
    {
        return $query->where('active', 1);
    }

    /**
     * Send the password reset notification.
     *
     * @param string $token
     * @return void
     */
    public function sendPasswordResetNotification($token)
    {
        $this->notify(new ResetPasswordNotification($token));
    }

    /**
     * @param $value
     */
    public function setPasswordAttribute(?string $value)
    {
        $this->attributes['password'] = Hash::make($value);
    }

    /**
     * @param string $password
     * @return bool
     */
    public function checkPassword(?string $password): bool
    {
        return $password && Hash::check($password, $this->password);
    }

    /**
     * @return string
     */
    public function getFullNameAttribute()
    {
        return $this->name . ' ' . $this->last_name ?? '';
    }

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }
    public function getJWTCustomClaims()
    {
        return [];
    }
}
