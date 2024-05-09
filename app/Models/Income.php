<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Income extends Model
{
    use HasFactory;

    protected $fillable = [
        'folio',
        'date',
    ];

    function provider() : BelongsTo {
        return $this->belongsTo(Provider::class);
    }

    function user() : BelongsTo {
        return $this->belongsTo(User::class);
    }

    function products() : BelongsToMany {
        return $this->belongsToMany(Product::class);
    }
}
