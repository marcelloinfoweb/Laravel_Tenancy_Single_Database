<?php

namespace App\Models;

use App\Traits\BelongsTenantScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShippingOption extends Model
{
    use HasFactory, BelongsTenantScope;

    protected $fillable = ['name', 'price'];

    public function setPriceAttribute($prop): void
    {
        $price = str_replace(['.', ','], ['', '.'], $prop);

        $this->attributes['price'] = $price * 100;
    }

    public function getPriceAttribute(): float|int
    {
        return $this->attributes['price'] / 100;
    }
}
