<?php

namespace App\Models;

use App\Traits\CustomAttributesTrait;
use Illuminate\Database\Eloquent\Builder;
use Spatie\Permission\Models\Role;

class RoleBase extends Role
{
    use CustomAttributesTrait;

    const ADMIN = 'Administrador';
    const GUEST = 'Invitado';

    protected $fillable = [
        'name'
    ];

    protected $uc_fields = [
        'name'
    ];

    /**
     * @param $query
     * @param $name
     * @return Builder
     */
    public function scopeName(Builder $query, $name)
    {
        if (trim($name)) {
            $query->where('name', "LIKE", "%$name%");
        }

        return $query;
    }

    public function scopeAdmin(Builder $query)
    {
        $query->where('name', '!=', 'Administrador');

        return $query;
    }
}
