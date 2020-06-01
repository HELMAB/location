<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Village extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'admin_level',
        'code',
        'parent_code',
        'commune_id',
        'name_en',
        'name_km',
        'type_km',
        'type_en',
    ];

    public function commune()
    {
        return $this->belongsTo(Commune::class);
    }
}
