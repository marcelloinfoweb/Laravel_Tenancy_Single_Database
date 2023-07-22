<?php

namespace App\Models;

use App\Traits\BelongsTenantScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Product extends Model
{
    use HasFactory, BelongsTenantScope;

    protected $fillable = ['name', 'description', 'body', 'price', 'slug'];

    public function setNameAttribute($prop): void
    {
        $this->attributes['name'] = $prop;
        $this->attributes['slug'] = Str::slug($prop);
    }

    public function setPriceAttribute($prop): void
    {
        $price = str_replace(['.', ','], ['', '.'], $prop);

        $this->attributes['price'] = $price * 100;
    }

    public function getPriceAttribute(): float|int
    {
        return $this->attributes['price'] / 100;
    }

    public function categories(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(Category::class);
    }
}
