<x-base-layout>
    @section('styles')
        <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.css" />
    @endsection
    <div class="container">
        <div class="text-center">
            @if (session('status'))
                <div class="toast show alert-success" role="alert" aria-live="assertive" aria-atomic="true">
                    <div class="toast-header">
                        <i class="fa-solid fa-envelope"></i>
                        <strong class="me-auto mx-2">Category</strong>
                        <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                    </div>
                    <div class="toast-body">
                        {{ session('status') }}
                    </div>
                </div>
            @endif
        </div>
        <h3 class="mt-3">Category Management</h3>
        <hr>
        {{-- Table --}}
        <div class="table-responsive col-6 float-left">
            <table id="kt_datatable_dom_positioning"
                class="table table-striped table-row-bordered gy-5 gs-7 border rounded wrapper">
                <a href="{{ route('category.create') }}" class="btn btn-sm btn-primary mt-3 mb-5"><i
                        class="la la-plus"></i>Add</a>
                <thead class="text-center">
                    <tr class="fw-bold fs-6 text-gray-800 px-7">
                        <th>S.No</th>
                        <th>Name</th>
                        <th>Action</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody class="text-center">
                    @foreach ($categories as $category)
                        <tr class="font-bold text-center disable-row" id="tr_{{ $category->id }}">
                            <td scope="row">{{ ++$i }}</td>
                            <td>{{ $category->name }}</td>
                            <td>
                                <a href="{{ route('category.edit', $category->id) }}"
                                    class="btn btn-sm btn-secondary align-self-center mx-2"><i
                                        class="la la-pencil-alt"></i>Edit</a>
                                <form class="d-inline"
                                    action="{{ route('category.destroy', ['category' => $category->id]) }}"
                                    method="post">
                                    @csrf
                                    @method('DELETE')
                                    <input type="submit" class="btn btn-sm btn-danger align-self-center p-3"
                                        value="Disable" />
                                </form>
                            </td>
                            <td>
                                <form action="{{ route('categories.toggleStatus', $category->id) }}" method="POST">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit"
                                        class="btn {{ $category->status ? ' btn-light-success' : 'btn-light-danger' }}">
                                        {{ $category->status ? 'Active' : 'Inactive' }}
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            {{-- {!! $categories->links() !!} --}}
        </div>
    </div>
    @section('scripts')
        <!-- Include jQuery library -->
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.js"></script>
        <script>
            $(document).ready(function() {
                $("#kt_datatable_dom_positioning").DataTable({
                    "pageLength": 5,
                    "dom": 'lfrtip',
                });
                $('.disable-btn').on('click', function() {
                    var row = $(this).closest('tr');
                    row.addClass('disabled');
                    row.find(':input').attr('disabled', true);
                });
            });
            var allVals = [];
            $.each(allVals, function(index, value) {
                $('table tr').filter("[data-row-id='" + value + "']").remove();
            });
        </script>
    @endsection
</x-base-layout>
