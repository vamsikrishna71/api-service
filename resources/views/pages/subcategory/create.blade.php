<x-base-layout>
    <!-- Add Sub Category Form -->
    <div class="container col-4 mt-6">
        <form method="POST" action="{{ route('subcategory.store') }}">
            @csrf
            <div class="mb-10">
                <div class="mb-3">
                    <label for="dropdown1">Choose category</label>
                    <select class="form-select mt-3" data-control="select2" data-placeholder="Select an option"
                        name="category_id">
                        @foreach ($categories as $category)
                            <option></option>
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>
                <label for="exampleFormControlInput1" class="required form-label">Name</label>
                <input type="text" name="name" class="form-control form-control-solid"
                    placeholder="subcategory name" />
            </div>
            @if (count($errors) > 0)
                <div class="alert alert-danger col-span-2">
                    <strong>Whoops!</strong> There were some problems with your input.
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <button type="submit" class="mt-3 btn btn-primary">Add</button>
        </form>
    </div>
</x-base-layout>
