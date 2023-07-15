<?php

namespace App\Imports;

use App\Models\Quote;
use App\Models\Category;
use App\Models\Subcategory;
use Illuminate\Validation\Rule;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class QuoteImport implements ToModel, WithHeadingRow
{
    public function rules(): array
    {
        return [
            'name' => Rule::unique('quotes', 'name')
        ];
    }

    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        $category = Category::where('id', $row['category_id'])->first();
        $subcategory = Subcategory::where('id', $row['subcategory_id'])->first();
        return new Quote([
            'category_id' => $category ? $category->id : null,
            'subcategory_id' => $subcategory ? $subcategory->id : null,
            'name' => $row['name']
            // Add other fields as needed
        ]);
    }
}
