<?php

namespace App\Models;

use App\Traits\CustomAttributesTrait;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Solution extends Model
{
    use CustomAttributesTrait;

    const PERSONAL = 1;
    const BUSINESS = 2;

    protected $table = 'solutions';
    protected $perPage = 20;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $fillable = [
        'name',
        'image',
        'description',
        'status'
    ];

    protected $file_fields = [
        'image',
    ];

    /**
     * @param Builder $builder
     */
    public function scopeStatus(Builder $builder)
    {
        $builder->where('status', 1);
    }

    /**
     * @param Builder $builder
     * @param array $search
     * @return mixed
     */
    public function scopeSearch(Builder $builder, array $search)
    {
        foreach ($search as $column => $value) {
            switch ($column) {
                case 'name':
                    if ($value) {
                        $builder->where('name', "like", "%{$value}%");
                    }
                    break;
                case 'status':
                    if ($value !== null) {
                        $builder->where('status', $value);
                    }
                    break;
            }
        }
        return $builder->orderBy('name', 'ASC');
    }

    public function insurances()
    {
        return $this->hasMany(Insurance::class, 'solution_id');
    }

    public function getLowerNameAttribute()
    {
        return mb_strtolower($this->name);
    }

    public function insurance_types($id)
    {
        return $this->insurances()->where('solution_id', $id)->get();
    }
}
