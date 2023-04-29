<?php

namespace App\Models;

use App\Traits\CustomAttributesTrait;
use App\Traits\CreatedUpdatedBy;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;

class Insurance extends Model implements Auditable
{
    use CustomAttributesTrait, SoftDeletes, CreatedUpdatedBy;
    use \OwenIt\Auditing\Auditable;

    protected $table = 'insurances';
    protected $perPage = 20;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'slug',
        'solution_id',
        'image',
        'icon',
        'description',
        'content',
        'status',
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

        /**
     * @param Builder $builder
     */
    public function scopeSolution(Builder $builder, $solution_id)
    {
        $builder->where('solution_id', $solution_id)->orderBy('name', 'ASC');
    }

    public static function getArrayList()
    {
        $lists = [
            'solutions' => Solution::status()->get(),
        ];

        return $lists;
    }

    public function similar()
    {
        return $this->where('solution_id', $this->solution_id)
            ->where('id', '!=', $this->id)
            ->take(4)
            ->get();
    }

    public function created_by()
    {
        return $this->belongsTo(User::class, 'created_by_id');
    }

    public function updated_by()
    {
        return $this->belongsTo(User::class, 'updated_by_id');
    }

    public function solution()
    {
        return $this->belongsTo(Solution::class, 'solution_id');
    }
}
