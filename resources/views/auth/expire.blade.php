@extends('layouts.admin-app')

@section('admin-content')
    <div class="container mt-5 mb-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Account Expiration') }}</div>

                    <div class="card-body">
                        {{-- @if (session('resent')) --}}
                        <div class="alert alert-danger" role="alert">
                            {{ __('Unfortionatly, this account has been expired.') }}
                        </div>
                        {{-- @endif --}}
                        {{ __('If you need more time, please contact the administrator.') }}
                        <hr>
                        <strong>Email: </strong> salah.eldeen.mail@gmail.com <br>
                        <strong>Phone: </strong> +0201273542801
                        {{-- {{ __('If you did not receive the email') }},
                        <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                            @csrf
                            <button type="submit"
                                class="btn btn-link p-0 m-0 align-baseline">{{ __('click here to request another') }}</button>.
                        </form> --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
