<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Province extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'admin_level',
        'code',
        'parent_code',
        'name_en',
        'name_km',
        'type_km',
        'type_en',
    ];

    public function districts()
    {
        return $this->hasMany(District::class);
    }
}
