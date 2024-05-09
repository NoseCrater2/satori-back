<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Client extends User
{
    use HasFactory;
    public $timestamps = false;

    function sales() : HasMany {
        return $this->hasMany(Sale::class);
    }
}
