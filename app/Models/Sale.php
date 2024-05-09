<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Sale extends Model
{
    use HasFactory;


    protected $fillable = [
        'folio',
        'state',
        'date',
        'client_id'
    ];

    protected $appends = ['total','tax', 'total_products'];

    public function getTotalAttribute(){

        return $this->products()->sum('unitary_price') + $this->tax;
    }

    public function getTaxAttribute(){

        return $this->products()->sum('unitary_price') * 0.16;
    }

    public function getTotalProductsAttribute(){

        return $this->products()->count();
    }

    function client() : BelongsTo {
        return $this->belongsTo(Client::class);
    }

    function products() : BelongsToMany {
        return $this->belongsToMany(Product::class);
    }
}
