<?php

namespace App\Models;

use App\Notifications\ResetPasswordNotification;
use App\Traits\CreatedUpdatedBy;
use App\Traits\CustomAttributesTrait;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Traits\HasRoles;
use OwenIt\Auditing\Contracts\Auditable;

class User extends Authenticatable implements Auditable
{
    use Notifiable, HasRoles, CustomAttributesTrait, SoftDeletes;
    use \OwenIt\Auditing\Auditable;

    const ADMIN = 'Administrador';
    const CLIENT = 'Cliente';

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

    protected $file_fields = [
        'image',
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
    protected $perPage = 30;

    /**
     * @return \Illuminate\Database\Eloquent\Relations\MorphTo
     */
    public function parentModule()
    {
        return $this->morphTo('parentModule', 'module', 'module_id');
    }

    /**
     * @param Builder $query
     * @param array $search
     * @return Builder
     */
    public function scopeSearch(Builder $builder, array $search)
    {

        foreach ($search as $column => $value) {
            switch ($column) {
                case 'role':
                    if ($value) {
                        $builder->whereHas('roles', function (Builder $query) use ($value) {
                            return $query->where('role_id', $value);
                        });
                    }
                    break;
                case 'entry':
                    if ($value) {
                        $builder->where(function ($query) use ($value) {
                            $query->where(DB::raw("CONCAT(`name`, ' ', `last_name`)"), "like", "%{$value}%")
                                ->orwhere("username", "like", "%{$value}%");
                        });
                    }
                    break;
                case 'status':
                    if ($value !== null) {
                        $builder->where('active', $value);
                    }
                    break;
            }
        }

        return $builder->orderBy('is_admin', 'DESC')->orderBy('name', 'ASC');
    }

    /**
     * @return bool
     */
    public static function isAdmin()
    {
        return Auth::user() && Auth::user()->is_admin;
    }

    public function saveWithoutEvents(array $options = [])
    {
        return static::withoutEvents(function () use ($options) {
            return $this->save($options);
        });
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
     * @param string $username
     * @return User|null
     */
    public function findForPassport(string $username): ?User
    {
        return self::where('username', $username)->active()->first();
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

    public static function find_documentNumber($document_number)
    {
        $user = User::where('document_number', '=', $document_number)->first();

        return $user;
    }

    public static function find_username($username)
    {
        $user = User::where('username', '=', $username)->first();

        return $user;
    }
}
