@extends('layouts.admin-app')

@section('admin-content')
    <div class="col-lg-12 p-l-0 title-margin-right">
        <div class="page-header">
            <div class="page-title">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="{{ route('admin.home') }}">Dashboard</a>
                    </li>
                    <li class="breadcrumb-item active">
                        <a style="display:inline;" href="{{ route('admin.products.index') }}">Brands</a>
                    </li>
                    <li class="breadcrumb-item active">Edit Brand -->> {{ $brand->name }}</li>
                </ol>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div style="margin-top: 26px" class="card">
                    <div class="card-header">{{ __('Edit Brand') }}</div>

                    <div class="card-body">
                        <form id="createUser" novalidate method="POST" action="/dashboard/brands/{{ $brand->id }}">
                            @csrf
                            @method('PUT')
                            <div class="form-group row">
                                <label for="name"
                                    class="col-md-2 col-form-label text-md-center d-flex justify-content-center align-items-center">{{ __('Name') }}</label>

                                <div class="col-md-10">
                                    <input id="name" value="{{ $brand->name }}" type="text"
                                        class="form-control input-default  @error('name') is-invalid @enderror"
                                        name="name" autofocus>

                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group d-flex justify-content-center mb-0">
                                <button style="width: 30%" type="submit" class="btn btn-primary">
                                    {{ __('Edit') }}
                                </button>
                            </div>

                            {{-- @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif --}}

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
