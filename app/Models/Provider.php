<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Provider extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = [
        'name',
        'phone',
    ];

    function incomes() : HasMany {
        return $this->hasMany(Income::class);
    }


}
