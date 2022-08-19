<?php

namespace App\Models;

use App\PList;
use App\Traits\CustomAttributesTrait;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use CustomAttributesTrait;

    protected $table = 'posts';
    protected $perPage = 20;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $fillable = [
        'title',
        'slug',
        'description',
        'content',
        'image',
        'category_id',
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
        $builder->where('status', 1)->orderBy('title', 'ASC');
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
                case 'title':
                    if ($value) {
                        $builder->where('title', "like", "%{$value}%");
                    }
                    break;

                case 'category_id':
                    if ($value) {
                        $builder->where('category_id', $value);
                    }
                    break;
                case 'created_at':
                    if ($value && $date = parse_date($value, config('app.date_format'))) {
                        $builder->whereDate('created_at', $date);
                    }
                    break;
                case 'status':
                    if ($value !== null) {
                        $builder->where('status', $value);
                    }
                    break;
            }
        }
        return $builder->orderBy('title', 'ASC');
    }

    public static function getArrayList()
    {
        $lists = [
            'categories' => PList::status()->Options('categories')->get(),
        ];

        return $lists;
    }

    public function category()
    {
        return $this->belongsTo(Plist::class, 'category_id');
    }

    public function similar()
    {
        return $this->where('category_id', $this->category_id)
            ->where('id', '!=', $this->id)
            ->take(2)
            ->get();
    }
}
