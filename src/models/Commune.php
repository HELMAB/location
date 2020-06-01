<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Commune extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'admin_level',
        'code',
        'parent_code',
        'district_id',
        'name_en',
        'name_km',
        'type_km',
        'type_en',
    ];

    public function district()
    {
        return $this->belongsTo(District::class);
    }

    public function villages()
    {
        return $this->hasMany(Village::class);
    }
}
