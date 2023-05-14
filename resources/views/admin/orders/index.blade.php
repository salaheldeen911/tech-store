@extends('layouts.admin-app')

@section('admin-content')
    <div class="container">
        <div class="row">
            <div class="col-lg-8 p-0">
                <div class="page-header p-0">
                    <div class="page-title">
                        <h1>All Orders</h1>
                    </div>
                </div>
            </div>
            <!-- /# column -->
            <div class="col-lg-4 p-l-0 title-margin-left">
                <div class="page-header">
                    <div class="page-title">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active">All Orders</li>
                        </ol>
                    </div>
                </div>
            </div>
            <!-- /# column -->
        </div>
        <div class="row">
            {{-- <a class="btn btn-primary" href="{{ route('admin.products.create') }}">Add Product</a> --}}
            <div class="card w-100">
                <table id="orders" class="display table table-borderd table-hover w-100">
                    <thead>
                        <tr>
                            <th>Index</th>
                            <th>Created at</th>
                            <th>Total Amount</th>
                            <th>Total Items</th>
                            <th>User Email</th>
                            <th>City</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
    @endsection
    @push('scripts')
        <script type="text/javascript">
            $(function() {
                var table = $('#orders').DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: "{{ route('admin.show.orders.show') }}",
                    columns: [{
                            data: 'DT_RowIndex',
                            'orderable': false,
                            'searchable': false
                        },
                        {
                            data: 'created_at',
                            name: 'created_at'
                        },
                        {
                            data: 'total',
                            name: 'total'
                        },
                        {
                            data: 'total_items',
                            name: 'total_items'
                        },
                        {
                            data: 'user_email',
                            name: 'user_email'
                        },
                        {
                            data: 'city',
                            name: 'city'
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

            function deleteOrder(a) {
                if (confirm("Do you want to delete this order?")) {
                    $(a).next('form').submit();
                } else {
                    return false;
                }
            }
        </script>
    @endpush
