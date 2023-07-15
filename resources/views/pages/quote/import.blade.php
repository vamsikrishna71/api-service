<x-base-layout>
    <div class="container mt-5">
        <form action="{{ url('/admin/quote/import') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="file" name="file" class="form-control-sm" accept=".csv">
            <input type="submit" class="btn btn-sm btn-primary">
        </form>
        <div class="row mt-10">
            <div class="col-6">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Upload a <code>.csv </code>file from your computer</h4>
                        <p class="card-title-desc">
                        <ul class="text-left -ml-6 mt-8 mb-4 list-disc pl-10">
                            <li>Your CSV must list one record per row.</li>
                            <li>Required columns:</li>
                        </ul>
                        </p>

                        <div>
                            <div class="dz-message needsclick">
                                <code class="bg-carbon-5 text-carbon-50 py-2 px-4">category_id,subcategory_id,name
                                </code>
                            </div>
                        </div>
                    </div>
                </div>
            </div> <!-- end col -->
        </div> <!-- end row -->
        <div class="container col-4 mt-4">
            @if (count($errors) > 0)
                <div class="alert alert-danger col-span-2">
                    <strong>Whoops!</strong> Upload CSV with required fields.
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
        </div>
    </div>

</x-base-layout>
