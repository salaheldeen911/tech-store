@extends('layouts.admin-app')

@push('styles')
    <style>
        #createProduct input,
        select {
            border: none;
            border-bottom: 1px solid gray;
            border-radius: 20px !important;
        }

        #createProduct input {
            padding-left: 14px !important;
        }

        #createProduct input.is-invalid {
            border-bottom: 1px solid red !important;
        }

        @media (min-width: 768px) {
            .left_side {
                box-shadow: unset;
            }
        }

        .row {
            display: flex;
            position: relative;
        }

        textarea {
            height: 85px !important;
        }

        .description {
            padding: 15px;
        }

        .left_side {
            box-shadow: 2px 0 3px -2px grey;
        }

        .w-100 {
            width: 100%;
        }

        .form-group {
            display: flex;
            align-items: center;
            position: relative;
            height: 55px;
        }

        label {
            width: 30%;
            margin-left: 3px
        }

        .input_holder {
            width: 70%;
            height: 50px;
        }

        .identifier {
            position: absolute;
            right: 40px;
        }

        #AdditionalDetails {
            display: flex;
            justify-content: space-between;
            /* align-items: flex-start; */
            padding: 10px 10px;
            border: 1px solid;
            margin: 10px;
            border-top: none;
            border-radius: 30px;
            background: #d7c6c6;
            width: 100%;
            height: fit-content;
            flex-wrap: wrap;
        }

        .button-21 {
            align-items: center;
            appearance: none;
            background-color: #3EB2FD;
            background-image: linear-gradient(1deg, #4F58FD, #149BF3 99%);
            background-size: calc(100% + 20px) calc(100% + 20px);
            border-radius: 100px;
            border-width: 0;
            box-shadow: none;
            box-sizing: border-box;
            color: #FFFFFF;
            cursor: pointer;
            display: inline-flex;
            font-family: CircularStd, sans-serif;
            font-size: .8rem;
            height: auto;
            justify-content: center;
            line-height: 1.5;
            padding: 6px 30px 6px 20px;
            position: relative;
            text-align: center;
            text-decoration: none;
            transition: background-color .2s, background-position .2s;
            user-select: none;
            -webkit-user-select: none;
            touch-action: manipulation;
            vertical-align: top;
            white-space: nowrap;
            margin: 5px;
        }

        .button-21:active,
        .button-21:focus {
            outline: none;
        }

        .button-21:hover {
            background-position: -20px -20px;
        }

        .button-21:focus:not(:active) {
            box-shadow: rgba(40, 170, 255, 0.25) 0 0 0 .125em;
        }

        #AdditionalDetails .button-21 i {
            position: absolute;
            right: 8px;
            font-size: 16px;
        }

        #AdditionalDetails .addition_holder {
            width: 100%;
            height: 100%;
            position: relative;
        }

        #AdditionalDetails .addition_holder input {
            width: 100%;
            height: 100%;
            border: none;
            caret-color: #4F58FD;
            background: transparent;
            font-size: 1.8rem
        }

        #AdditionalDetails .addition_holder input::-webkit-input-placeholder {
            text-align: center;
            color: #2020ad;
            font-weight: 600;
            font-size: 1.2rem;
        }

        #AdditionalDetails .addition_holder .addition_actions {
            position: absolute;
            display: flex;
            width: 50px;
            right: 20px;
            top: 0;
            justify-content: space-between;
            align-items: center;
            bottom: 0;
        }

        #AdditionalDetails .addition_holder .addition_actions .ti-close,
        .ti-check {
            font-size: 18px;
            font-weight: 600;
            cursor: pointer;
        }

        #AdditionalDetails .addition_holder .addition_actions .ti-close:hover,
        .ti-check:hover {
            font-size: 21px;
            font-weight: 800;
        }

        #title,
        #name {
            border: none;
            border-top: 1px solid gray;
            border-bottom: 1px solid gray;
            border-radius: 15px !important;
            color: #183A4C;
            font: 1rem/2.4rem Georgia, serif;
            width: 100%;
            resize: none;
            line-height: 1.3;
        }
    </style>
@endpush

@section('admin-content')
    <div class="col-lg-4 p-l-0 title-margin-left">
        <div class="page-header">
            <div class="page-title">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="{{ route('admin.home') }}">Dashboard</a>
                    </li>
                    <li class="breadcrumb-item active">
                        <a style="display:inline;" href="{{ route('admin.products.index') }}">Products</a>
                    </li>
                    <li class="breadcrumb-item active">Create product</li>
                </ol>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div style="margin-top: 26px" class="card">
                    <div class="card-header">{{ __('Add Product') }}</div>
                    @livewire('admin.product.add-details')
                    <div class="card-body">
                        @livewire('admin.product.create-product')
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        var textarea = document.getElementById("title");

        textarea.oninput = function() {
            textarea.style.height = "";
            /* textarea.style.height = Math.min(textarea.scrollHeight, 300) + "px"; */
            textarea.style.height = textarea.scrollHeight + "px"
        };
    </script>
@endpush
