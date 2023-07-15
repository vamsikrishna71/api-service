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
                        <strong class="me-auto mx-2">Quote</strong>
                        <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                    </div>
                    <div class="toast-body">
                        {{ session('status') }}
                    </div>
                </div>
            @endif
        </div>
        <h3 class="mt-3">Quote Management</h3>
        <hr>
        {{-- Table --}}
        <div class="table-responsive col-8">
            <table id="kt_datatable_dom_positioning"
                class="table table-striped table-row-gray-{100-900} gy-8 gs-8 border rounded">
                <a href="{{ route('quote.create') }}" class="btn btn-sm btn-primary mt-3 mb-5 mx-4"><i
                        class="la la-plus"></i>Add</a>
                <a href="{{ url('/admin/quote/import') }}" class="btn btn-sm btn-success mt-3 mb-5"><i
                        class="la la-cloud-upload-alt"></i>Import</a>
                <thead class="text-center">
                    <tr class="fw-bold fs- text-gray-800 px-8">
                        <th>S.No</th>
                        <th>Quote</th>
                        <th>Category</th>
                        <th>Subcategory</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody class="text-center">
                    @foreach ($quotes as $quote)
                        <tr class="font-bold text-center disable-row" id="tr_{{ $quote->id }}">
                            <td scope="row">{{ ++$i }}</td>
                            <td>{{ $quote->name }}</td>
                            <td>{{ $quote->category->name }}</td>
                            <td>{{ $quote->subcategory->name }}</td>
                            <td class="flex">
                                <a href="{{ route('quote.edit', $quote->id) }}"
                                    class="btn btn-sm btn-secondary align-self-center mx-2 flex"><i
                                        class="la la-pencil-alt"></i>Edit</a>
                                <form class="d-inline mb-10"
                                    action="{{ route('quote.destroy', ['quote' => $quote->id]) }}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger align-self-center p-3 mt-3"><i
                                            class="la la-trash-alt"></i>Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            {{-- {!! $quotes->links() !!} --}}
        </div>
    </div>
    @section('scripts')
        <!-- Include jQuery library -->
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.js"></script>
        <script>
            $(document).ready(function() {
                $("#kt_datatable_dom_positioning").DataTable({
                    "language": {
                        "lengthMenu": "Show _MENU_",
                    },
                    "pageLength": 5,
                    "dom": 'lfrtip'
                });
                $('.disable-btn').on('click', function() {
                    var row = $(this).closest('tr');
                    row.addClass('disabled');
                    row.find(':a').attr('disabled', true);
                });
            });

            var allVals = [];
            $.each(allVals, function(index, value) {
                $('table tr').filter("[data-row-id='" + value + "']").remove();
            });
        </script>
    @endsection
</x-base-layout>
