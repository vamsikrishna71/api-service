<x-base-layout>
    <div class="container col-4 float-left">
        <form method="POST" action="{{ route('quote.store') }}">
            @csrf
            <div class="mt-3">
                <div class="mb-3">
                    <label for="dropdown1">Choose category</label>
                    <select class="form-select mt-3" data-control="select2" data-placeholder="Select an option"
                        name="category_id" id="category">
                        @foreach ($categories as $category)
                            <option></option>
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <label for="dropdown2">Choose subcategory</label>
                    <select class="form-select mt-3" data-control="select2" data-placeholder="Select an option"
                        name="subcategory_id" id="subcategory">
                        <option></option>
                        <option value="">Select Subcategory</option>
                    </select>
                </div>
                <div class="mb-10">
                    <label for="exampleFormControlInput1" class="required form-label">Quote</label>
                    <input type="text" name="name" class="form-control form-control-solid" />
                </div>
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
            <button type="submit" class="mt-3 btn btn-primary">Submit</button>
        </form>
    </div>
    @section('scripts')
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script>
            $(document).ready(function() {
                $('#category').change(function() {
                    var categoryId = $(this).val();

                    // Clear previous subcategory options
                    $('#subcategory').html('<option value="">Select Subcategory</option>');

                    if (categoryId) {
                        // Fetch subcategories based on the selected category
                        $.get('{{ route('subcategory.getByCategory', '') }}/' + categoryId, function(data) {
                            $.each(data, function(index, subcategory) {
                                $('#subcategory').append('<option value="' + subcategory.id +
                                    '">' + subcategory.name + '</option>');
                            });
                        });
                    }
                });
            });
        </script>
    @endsection
</x-base-layout>
