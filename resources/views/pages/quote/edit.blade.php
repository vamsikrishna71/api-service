<x-base-layout>
    <!-- Add Category Form -->
    <div class="container col-4 float-left">
        <form method="POST" action="{{ route('quote.update', ['quote' => $quote->id]) }}">
            @csrf
            @method('PUT')
            <div class="form-group">
                <div class="mb-3">
                    <label for="dropdown1">Choose category</label>
                    <select class="form-select mt-3" data-control="select2" data-placeholder="Select an option"
                        name="category_id">
                        @foreach ($categories as $category)
                            <option></option>
                            <option @selected($category->id == $quote->category->id) value="{{ $category->id }}"
                                @class([
                                    'bg-purple-600 text-white' => $category->id == $quote->category_id,
                                ])>{{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <label for="dropdown2">Choose subcategory</label>
                    <select class="form-select mt-3" data-control="select2" data-placeholder="Select an option"
                        name="subcategory_id">
                        @foreach ($subcategories as $subcategory)
                            <option></option>
                            <option @selected($subcategory->id == $quote->subcategory->id) value="{{ $subcategory->id }}"
                                @class([
                                    'bg-purple-600 text-white' => $subcategory->id == $quote->subcategory_id,
                                ])>
                                {{ $subcategory->name }}</option>
                        @endforeach
                    </select>
                </div>
                <label for="category_name">Quote</label>
                <input type="text" id="quote_name" name="name" class="form-control mt-3"
                    value="{{ $quote->name }}" required>
            </div>
            <button type="submit" class="mt-3 btn btn-primary">Update</button>
        </form>
    </div>
</x-base-layout>
