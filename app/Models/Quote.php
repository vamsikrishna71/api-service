<?php

namespace App\Models;

use App\Models\Category;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Quote extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $dates = ['deleted_at'];
    protected $fillable = ['category_id','subcategory_id','name'];

    /**
    * A relationship to categories. This is an alias for belongsToMany (). The relationship must be associated with a Category class otherwise an exception will be thrown.
    *
    * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
    */
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    /**
    * The Sub Categories that belong to the quote
    * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
    *
    * A sub category is a child of another. The children are not saved to the database until they are saved.
    */
    public function subcategory(): BelongsTo
    {
        return $this->belongsTo(Subcategory::class);
    }

    /**
     * getQuotesByMonth
     * Returns quotes by month and year. This is useful for getting a list of quotations
     * @param  mixed $year
     * @param  mixed $month
     * @return eloquent
     */
    public function getQuotesByMonth(int $year, int $month){
        return $this->whereYear('created_at', $year)
                    ->whereMonth('created_at', $month)
                    ->get();
    }

    public function getQuotesDay(string $date){
        return $this->whereDay('created_at',$date)
                    ->get();
    }

    public function getTimeLine(){
        $this->whereDay('created_at', '=', date('d'));
        $this->whereMonth('created_at', '=', date('m'));
        $this->whereYear('created_at', '=', date('Y'));
        $this->whereTime('created_at', '=', date('H:m:s'));
    }
}
