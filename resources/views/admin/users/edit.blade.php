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
                        <a style="display:inline;" href="{{ route('admin.products.index') }}">Products</a>
                    </li>
                    <li class="breadcrumb-item active">Edit user -->> {{ $user->name }}</li>
                </ol>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div style="margin-top: 26px" class="card">
                    <div class="card-header">{{ __('Edit User') }}</div>

                    <div class="card-body">
                        <form id="createUser" novalidate method="POST" action="/dashboard/users/{{ $user->id }}">
                            @csrf
                            @method('PUT')
                            <div class="form-group row">
                                <label for="name"
                                    class="col-md-2 col-form-label text-md-center d-flex justify-content-center align-items-center">{{ __('Name') }}</label>

                                <div class="col-md-10">
                                    <input id="name" data-spry='username' value="{{ $user->name }}" type="text"
                                        class="spryValidation form-control input-default  @error('name') is-invalid @enderror"
                                        name="name" autofocus>

                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="expire_at"
                                    class="col-md-2 col-form-label text-md-center d-flex justify-content-center align-items-center">{{ __('Expires at') }}</label>

                                <div class="col-md-10">
                                    <input id="expire_at" value="{{ $user->expire_at }}" type="date"
                                        class="spryValidation form-control input-default  @error('expire_at') is-invalid @enderror"
                                        name="expire_at" autofocus>

                                    @error('expire_at')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="role"
                                    class="col-md-2 col-form-label text-md-center d-flex justify-content-center align-items-center">{{ __('role') }}</label>

                                <div class="col-md-10">
                                    <select id="role" data-spry='username'
                                        class="spryValidation form-control  @error('role') is-invalid @enderror"
                                        name="role">
                                        <option disabled selected>----- Select a role -----</option>
                                        <option {{ $user->getRoleNames()[0] == 'user' ? 'selected' : '' }} value=3>User
                                        </option>
                                        <option {{ $user->getRoleNames()[0] == 'admin' ? 'selected' : '' }} value=2>Admin
                                        </option>
                                        <option {{ $user->getRoleNames()[0] == 'super_admin' ? 'selected' : '' }} value=1>
                                            Super Admin</option>

                                    </select>
                                </div>
                            </div>

                            <div class="form-group d-flex justify-content-center mb-0">
                                <button style="width: 30%" type="submit" class="btn btn-primary">
                                    {{ __('Edit') }}
                                </button>
                            </div>

                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
