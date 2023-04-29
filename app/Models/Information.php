<?php

namespace App\Models;

use App\Traits\CustomAttributesTrait;
use App\Traits\CreatedUpdatedBy;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;

class Information extends Model implements Auditable
{
    use CustomAttributesTrait, SoftDeletes, CreatedUpdatedBy;
    use \OwenIt\Auditing\Auditable;

    protected $table = 'information';
    protected $perPage = 20;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'description',
        'phone',
        'mobile',
        'email',
        'address',
    ];

    protected $file_fields = [
        'image',
    ];

    public function created_by()
    {
        return $this->belongsTo(User::class, 'created_by_id');
    }

    public function updated_by()
    {
        return $this->belongsTo(User::class, 'updated_by_id');
    }
}
