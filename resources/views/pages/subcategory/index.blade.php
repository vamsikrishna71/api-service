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
                        <strong class="me-auto mx-2">Subcategory</strong>
                        <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                    </div>
                    <div class="toast-body">
                        {{ session('status') }}
                    </div>
                </div>
            @endif
        </div>
        <h3 class="mt-3">Sub Category Management</h3>
        <hr>
        <a href="{{ route('subcategory.create') }}" class="btn btn-sm btn-primary mt-3 mb-5"><i
                class="la la-plus"></i>Add</a>
        {{-- Table -yajra --}}
        <div class="table-responsive col-6 float-left">
            <table id="kt_datatable_dom_positioning"
                class="table border rounded table-striped table-row-bordered gy-5 gs-7">
                <thead class="text-center">
                    <tr class="text-gray-800 fw-bold fs-6 px-7">
                        <th>S.No</th>
                        <th>Category</th>
                        <th>Subcategory</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody class="text-center">
                    @foreach ($subcategories as $subcategory)
                        <tr class="font-bold text-center" id="tr_{{ $subcategory->id }}">
                            <td scope="row">{{ ++$i }}</td>
                            <td>{{ $subcategory->category->name }}</td>
                            <td>{{ $subcategory->name }}</td>
                            <td>
                                <a href="{{ route('subcategory.edit', $subcategory->id) }}"
                                    class="btn btn-sm btn-secondary align-self-center mx-2"><i
                                        class="la la-pencil-alt"></i>Edit</a>
                                <form class="d-inline"
                                    action="{{ route('subcategory.destroy', ['subcategory' => $subcategory->id]) }}"
                                    method="post">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger align-self-center p-3 mt-3"><i
                                            class="la la-trash-alt"></i>Disable</button>
                                </form>
                                {{-- <a href="#" class="btn btn-sm btn-danger">Disable</a> --}}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            {!! $subcategories->links() !!}
        </div>
    </div>
    @section('scripts')
        <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.js"></script>
        <script>
            $("#kt_datatable_dom_positioning").DataTable({
                "language": {
                    "lengthMenu": "Show _MENU_",
                },
                "pageLength": 5,
                "dom": 'lfrtip'
            });
            var allVals = [];
            $.each(allVals, function(index, value) {
                $('table tr').filter("[data-row-id='" + value + "']").remove();
            });
        </script>
    @endsection
</x-base-layout>
