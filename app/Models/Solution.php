<?php

namespace App\Models;

use App\Traits\CustomAttributesTrait;
use App\Traits\CreatedUpdatedBy;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;

class Solution extends Model implements Auditable
{
    use CustomAttributesTrait, SoftDeletes, CreatedUpdatedBy;
    use \OwenIt\Auditing\Auditable;

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
        $builder->where('status', 1)->orderBy('name', 'ASC');
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

    public function created_by()
    {
        return $this->belongsTo(User::class, 'created_by_id');
    }

    public function updated_by()
    {
        return $this->belongsTo(User::class, 'updated_by_id');
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
