<?php

namespace App\Models;

use App\Events\ContactFormSaved;
use App\Traits\CustomAttributesTrait;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ContactForm extends Model
{
    use CustomAttributesTrait, SoftDeletes;

    protected $table = 'contact_forms';
    protected $perPage = 20;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'phone',
        'email',
        'insurance_id',
        'message',
    ];

    protected $dispatchesEvents = [
        'saved' => ContactFormSaved::class
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
                case 'insurance_id':
                    if ($value) {
                        $builder->where('insurance_id', $value);
                    }
                    break;
            }
        }
        return $builder->orderBy('created_at', 'DESC');
    }

    public function insurance()
    {
        return $this->belongsTo(Insurance::class, 'insurance_id');
    }
}
