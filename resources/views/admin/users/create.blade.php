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
                        <a style="display:inline;" href="{{ route('admin.products.index') }}">Users</a>
                    </li>
                    <li class="breadcrumb-item active">Create User</li>
                </ol>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div style="margin-top: 26px" class="card">
                    <div class="card-header">{{ __('Add User') }}</div>

                    <div class="card-body">
                        <form id="createUser" novalidate method="POST" action="{{ route('admin.users.store') }}">
                            @csrf

                            <div class="form-group row">
                                <label for="name"
                                    class="col-md-2 col-form-label text-md-center d-flex justify-content-center align-items-center">{{ __('Name') }}</label>

                                <div class="col-md-10">
                                    <input id="name" data-spry='username' type="text"
                                        class="spryValidation form-control input-default  @error('name') is-invalid @enderror"
                                        name="name" value="{{ old('name') }}" autofocus>

                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="email"
                                    class="col-md-2 col-form-label text-md-center d-flex justify-content-center align-items-center">{{ __('email') }}</label>

                                <div class="col-md-10">
                                    <input id="email" data-spry='email' type="email"
                                        class="spryValidation form-control input-default  @error('email') is-invalid @enderror"
                                        name="email" value="{{ old('email') }}">

                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="phone"
                                    class="col-md-2 col-form-label text-md-center d-flex justify-content-center align-items-center">{{ __('phone') }}</label>

                                <div class="col-md-10">
                                    <input id="phone" data-spry='phone' type="phone"
                                        class="spryValidation form-control input-default  @error('phone') is-invalid @enderror"
                                        name="phone" value="{{ old('phone') }}">

                                    @error('phone')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="name"
                                    class="col-md-2 col-form-label text-md-center d-flex justify-content-center align-items-center">{{ __('Expires at') }}</label>

                                <div class="col-md-10">
                                    <input id="expire_at" type="date"
                                        class="spryValidation form-control input-default  @error('expire_at') is-invalid @enderror"
                                        name="expire_at" value="{{ old('date') }}" autofocus>

                                    @error('expire_at')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="password"
                                    class="col-md-2 col-form-label text-md-center d-flex justify-content-center align-items-center">{{ __('password') }}</label>

                                <div class="col-md-10">
                                    <input id="password" data-spry='password' type="password"
                                        class="spryValidation form-control  @error('password') is-invalid @enderror"
                                        name="password">

                                    @error('password')
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
                                    <select id="role" data-spry='select'
                                        class="spryValidation form-control  @error('role') is-invalid @enderror"
                                        name="role">
                                        <option disabled selected>----- Select a role -----</option>
                                        <option value=3>User</option>
                                        <option value=2>Admin</option>
                                        <option value=1>Super Admin</option>

                                    </select>
                                    @error('role')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-10 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Add new user') }}
                                    </button>
                                </div>
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
