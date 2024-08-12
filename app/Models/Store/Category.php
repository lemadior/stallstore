<?php

namespace App\Models\Store;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $guarded = false;

    protected $fillable = [
        'name'
    ];

    public function products(): HasMany
    {
        return $this->hasMany(Product::class);
    }
}
