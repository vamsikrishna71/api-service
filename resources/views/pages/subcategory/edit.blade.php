<x-base-layout>
    <!-- Add Category Form -->
    <div class="container col-4 mt-5">
        <form method="POST" action="{{ route('subcategory.update', ['subcategory' => $subcategory->id]) }}">
            @csrf
            @method('PUT')
            <div class="form-group">
                <div class="mb-3">
                    <label for="dropdown1">Choose category</label>
                    <select class="form-select mt-3" data-control="select2" data-placeholder="Select an option"
                        name="category_id">
                        @foreach ($categories as $category)
                            <option></option>
                            <option @selected($category->id == $subcategory->category->id) value="{{ $subcategory->id }}"
                                @class([
                                    'bg-purple-600 text-white' => $category->id == $subcategory->category_id,
                                ])>{{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <label for="category_name">Subcategory:</label>
                <input type="text" id="category_name" name="name" class="form-control mt-3"
                    value="{{ $subcategory->name }}" required>
            </div>
            <button type="submit" class="btn btn-primary mt-3">Update</button>
        </form>
    </div>
</x-base-layout>
