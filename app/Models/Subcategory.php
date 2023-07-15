<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Subcategory extends Model
{
    use HasFactory;
    protected $fillable = ['category_id','name'];


    /**
    * Get the quote of the relationship. This is a many - to - many relationship. If you want to know the quote of a relationship you can use the quote property.
    *
    *
    * @return The has many relationship of the quote of the relationship to the entity ( s ) that belong to this
    */
    public function quotes(): HasMany{
        return  $this->hasMany(Quote::class);
    }

    /**
    * Represents the category to which this entity belongs. This is a shortcut for $this - > belongsTo ( Category :: class ).
    *
    *
    * @return the relationship to the category being represented by this entity ( it's a child of Category ) or null if it doesn't
    */
    public function category(): BelongsTo{
    return $this->belongsTo(Category::class);
    }

}
