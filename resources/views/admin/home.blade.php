@extends('layouts.admin-app')

@section('admin-content')
    {{-- {{ dd($notifications) }} --}}
    <div class="row">
        <div class="col-lg-8 p-r-0 title-margin-right">
            <div class="page-header">
                <div class="page-title">
                    <h1>Hello, <span>Welcome Here</span></h1>
                </div>
            </div>
        </div>
        <!-- /# column -->
        <div class="col-lg-4 p-l-0 title-margin-left">
            <div class="page-header">
                <div class="page-title">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                        <li class="breadcrumb-item active">Home</li>
                    </ol>
                </div>
            </div>
        </div>
        <!-- /# column -->
    </div>
    <!-- /# row -->
    <section id="main-content">
        <div class="row">
            <x-admin.welcome.total-users />
            <x-admin.welcome.total-admins />
            <x-admin.welcome.total-products />
            <x-admin.welcome.total-sold />
        </div>
        <div class="row">
            <x-admin.welcome.total-orders />
            <x-admin.welcome.total-orders-amount />
            <x-admin.welcome.total-likes />
            <x-admin.welcome.total-reviews />
        </div>
        <div class="row">
            <x-admin.welcome.total-mobiles />
            <x-admin.welcome.total-tvs />
            <x-admin.welcome.total-laptops />
        </div>
    </section>
@endsection
