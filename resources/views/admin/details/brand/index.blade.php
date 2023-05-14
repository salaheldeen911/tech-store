@extends('layouts.admin-app')

@section('admin-content')
    <div class="container">
        <div class="row">
            <div class="col-lg-8 p-0">
                <div class="page-header p-0">
                    <div class="page-title">
                        <h1>All Brands</h1>
                    </div>
                </div>
            </div>
            <!-- /# column -->
            <div class="col-lg-4 p-l-0 title-margin-left">
                <div class="page-header">
                    <div class="page-title">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active">All Brands</li>
                        </ol>
                    </div>
                </div>
            </div>
            <!-- /# column -->
        </div>

        <div class="row">
            <div class="card w-100">
                <table id="brands" class="display table table-borderd table-hover w-100">
                    <thead>
                        <tr>
                            <th>Index</th>
                            <th>Name</th>
                            <th>Publisher Email</th>
                            <th>Created at</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $(function() {
            var table = $('#brands').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('admin.show.brands') }}",
                columns: [{
                        data: 'DT_RowIndex',
                        'orderable': false,
                        'searchable': false
                    },
                    {
                        data: 'name',
                        name: 'name'
                    },
                    {
                        data: 'publisher_email',
                        name: 'publisher_email',
                    },
                    {
                        data: 'created_at',
                        name: 'created_at'
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    },
                ]
            });
        });

        function deleteBrand(a) {
            if (confirm("Do you want to delete this brand?")) {
                console.log($(a).next('form'));
                $(a).next('form').submit();
            } else {
                return false;
            }
        }
    </script>
@endpush
