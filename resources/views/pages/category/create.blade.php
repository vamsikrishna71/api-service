<x-base-layout>
    <!-- Add Category Form -->
    <div class="container col-4 mt-6">
        <form method="POST" action="{{ route('category.store') }}">
            @csrf
            <div class="mb-10">

                <label for="exampleFormControlInput1" class="required form-label">Name</label>
                <input type="text" name="name" class="form-control form-control-solid" placeholder="Category name" />
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
            </div>
            <button type="submit" class="mt-3 btn btn-primary">Add</button>
        </form>
    </div>
    @section('scripts')
        <script>
            $(document).ready(function() {
                toastr.options.timeOut = 10000;
                @if (Session::has('error'))
                    toastr.error('{{ Session::get('error') }}');
                @elseif (Session::has('success'))
                    toastr.success('{{ Session::get('success') }}');
                @endif
            });
        </script>
    @endsection
</x-base-layout>
