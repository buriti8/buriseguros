<?php

namespace App\Models;

use App\Traits\CreatedUpdatedBy;
use App\Traits\CustomAttributesTrait;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;

class PList extends Model implements Auditable
{
    use CustomAttributesTrait, SoftDeletes;
    use \OwenIt\Auditing\Auditable;

    protected $table = 'lists';
    protected $perPage = 20;

    protected $fillable = ['list', 'list_name', 'option_key', 'option', 'status'];

    public static function getArrayList()
    {
        $lists = [
            "lists" => config('lists.lists', []),
            'protected' => config('lists.protected', []),
        ];

        return $lists;
    }

    /**
     * @param $query
     * @return Builder
     */
    public function scopeStatus(Builder $query)
    {
        return $query->where('status', 1);
    }

    /**
     * @param Builder $builder
     * @param array $search
     * @return Builder
     */
    public function scopeSearch(Builder $builder, array $search)
    {
        foreach ($search as $column => $value) {
            switch ($column) {
                case 'list':
                    if ($value) {
                        $builder->Options($value);
                    }
                    break;
                case 'option_key':
                    if ($value) {
                        $builder->where('option_key', 'like', "%{$value}%");
                    }
                    break;
                case 'option':
                    if ($value) {
                        $builder->where('option', 'like', "%{$value}%");
                    }
                    break;
            }
        }

        return $builder->orderBy('list');
    }

    /**
     * @param $search
     * @param $list_search
     * @return mixed
     */
    public static function search_list($search, $list_search)
    {
        if ($list_search) {
            $lists = PList::search($search)
                ->where('list', $list_search)
                ->OrderBy('list', 'ASC')->OrderBy('option', 'ASC')->paginate(20);
        } else {
            $lists = PList::search($search)
                ->OrderBy('list', 'ASC')->OrderBy('option', 'ASC')->paginate(20);
        }

        return $lists;
    }


    /**
     * @param Builder $builder
     * @param string $list_name
     * @return Builder
     */
    public function scopeOptions(Builder $builder, $list_name)
    {
        return $builder->where('list', $list_name)->OrderBy('option', 'ASC');
    }

    /**
     * @param Builder $builder
     * @param string|array $option_key
     * @return Builder
     */
    public function scopeOption(Builder $builder, $option_key)
    {
        if (is_string($option_key)) {
            $option_key = [$option_key];
        }

        return $builder->whereIn('option_key', $option_key);
    }

    /**
     * @param Builder $builder
     * @param string $option_name
     * @return Builder
     */
    public function scopeOptionName(Builder $builder, $option_name)
    {
        return $builder->where('option', $option_name);
    }

    /**
     * @param $value
     */
    public function setListNameAttribute($value)
    {
        $this->attributes['list'] = $value;
    }

    public static function getAccountTypes()
    {
        return PList::options('account_type')->get();
    }

    public static function getDocumentTypes()
    {
        return PList::options('document_type')->get();
    }
}
