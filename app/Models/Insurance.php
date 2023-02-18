<?php

namespace App\Models;

use App\Traits\CustomAttributesTrait;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class Insurance extends Model
{
    use CustomAttributesTrait;

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
                case 'solution_id':
                    if ($value) {
                        $builder->where('solution_id', $value);
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

    public function solution()
    {
        return $this->belongsTo(Solution::class, 'solution_id');
    }
}
