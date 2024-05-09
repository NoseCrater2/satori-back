<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Product extends Model
{
    use HasFactory;
    public $timestamps = false;

    protected $fillable = [
        'image',
        'name',
        'stock',
        'rating',
        'unitary_price',
        'category_id'
    ];

    function category() : BelongsTo {
        return $this->belongsTo(Category::class);
    }

    function sales() : BelongsToMany {
        return $this->belongsToMany(Sale::class);
    }

    function incomes() : BelongsToMany {
        return $this->belongsToMany(Income::class);
    }



}
