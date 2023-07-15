<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
    use HasFactory;
    protected $fillable = ['name'];

    /**
    * Get the quote of the relationship. This is a many - to - many relationship. If you want to know the quote of a relationship you can use the quote property.
    *
    * @return hasmany relationship of the quote of the relationship to the entity ( s ) that belong to this
    */
    public function quotes(): HasMany{
        return $this->hasMany(Quote::class);
    }

    /**
     * subcategories
     *
     * @return HasMany
     * Returns a subcategory selector. This selector is used to select subcategories that are part of the category
     */
    public function subcategories(): HasMany{
    return $this->hasMany(Subcategory::class);
    }
}
