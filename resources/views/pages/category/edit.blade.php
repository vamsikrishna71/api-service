<x-base-layout>
    <!-- Edit Category Form -->
    <div class="container col-4 float-left">
        <form method="POST" action="{{ route('category.update', ['category' => $category->id]) }}">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="category_name">Category Name</label>
                <input type="text" id="category_name" name="name" class="form-control mt-3"
                    value="{{ $category->name }}" required>
            </div>
            <button type="submit" class="mt-3 btn btn-primary">Update</button>
        </form>
    </div>
</x-base-layout>
