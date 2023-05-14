@extends('layouts.admin-app')

@push('styles')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">

    <style>
        .image_holder {
            height: 400px;
            width: 100%;
            border-radius: 10px;
            margin-bottom: 20px
        }

        .image_holder img {
            height: 100%;
            width: 100%;
        }

        .dropdown.bootstrap-select {
            width: 100% !important;
        }

        .buttons_holder {
            display: flex;
            align-items: center;
            justify-content: space-around;
            margin-top: 20px;
        }
    </style>
@endpush

@section('admin-content')
    <div class="container">
        <div class="row">
            <div class="col-lg-8 p-0">
                <div class="page-header p-0">
                    <div class="page-title">
                        <h1>Site Slider Settings</h1>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 p-l-0 title-margin-left">
                <div class="page-header">
                    <div class="page-title">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active">Site Slider Settings</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">{{ __('Sliders Settings') }}</div>
                    <div class="card-body">
                        @foreach ($sliders as $slider)
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="slider">
                                        <div class="slider-title">
                                            <h6>Slider {{ $slider->id }}</h6>
                                        </div>
                                        <div class="slider-body">
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <div class="image_holder">
                                                        <img src="{{ asset($slider->path) }}" alt=""
                                                            class="img-fluid">
                                                    </div>

                                                    {{-- <form action="{{ route('admin.update.slider') }}" method="post"  enctype="multipart/form-data"> --}}
                                                    <form id="{{ $slider->id }}">
                                                        @csrf

                                                        <input type="text" style="display: none" name="id"
                                                            value="{{ $slider->id }}">
                                                        {{-- <div class="phone">
                                                            <select name="product" class="selectpicker"
                                                                onchange="GetSelectedTextValue(this)">

                                                                <option value=null selected class="text-center">
                                                                    <-- Select a mobile to link it with the slider -->
                                                                </option>
                                                                @foreach ($products as $product)
                                                                    <option value="{{ $product->id }}"
                                                                        {{ $slider->product_id == $product->id ? 'selected' : '' }}>
                                                                        {{ 'Name: ' .
                                                                            $product->brand->name .
                                                                            ' ' .
                                                                            $product->name .
                                                                            ' | Category: ' .
                                                                            $product->category->name .
                                                                            ' | Price: ' .
                                                                            $product->final_price .
                                                                            '$ | Color: ' .
                                                                            $product->color->name }}
                                                                        {{ $product->used ? '| ---->Used' : '| ---->New' }}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                        </div> --}}
                                                        <div class="buttons_holder">
                                                            <label style="width: 250px;" for="slider-{{ $slider->id }}"
                                                                type="button" class="btn btn-primary edit-btn">Edit</label>
                                                            <input id='slider-{{ $slider->id }}' type='file'
                                                                name='file' style='display:none' accept="image/*"
                                                                onchange="Checkfiles(this)" />
                                                            <a class="btn btn-primary save-btn" href="javascript:void(0)"
                                                                onclick="save(this)" style='width: 250px; display:none;'>
                                                                save</a>
                                                            <a href="javascript:void(0)" class="btn btn-primary cancel-btn"
                                                                onclick='cancel(this)'
                                                                style='width: 250px; display:none;'>Cancel
                                                            </a>
                                                        </div>
                                                    </form>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <hr>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
    @push('scripts')
        <script src="{{ asset('js/bootstrap-select.min.js') }}"></script>
        <script>
            let oldData = [];
            $(document).ready(function() {
                oldData[1] = $("form#1").find("select option:selected").val();
                oldData[2] = $("form#2").find("select option:selected").val();
                oldData[3] = $("form#3").find("select option:selected").val();
            });

            function Checkfiles(input) {
                var fileName = input.value;
                var ext = fileName.substring(fileName.lastIndexOf('.') + 1);
                let container = $(input.parentElement.parentElement.parentElement);
                if (ext == "jpg" || ext == "jpeg" || ext == "png") {
                    attachImg(input, container);
                } else {
                    alert("The image extintion must be one of those : jpg, jpeg or png");
                    input.val(null);
                    return false;
                }
            }

            function attachImg(input, container) {
                if (input.files && input.files[0]) {
                    let reader = new FileReader();
                    let img = container.find('img');
                    img.attr('data-oldSrc', img.attr('src'));
                    reader.onload = function(e) {
                        img.attr('src', e.target.result);
                    }
                    reader.readAsDataURL(input.files[0]);
                } else {
                    img.attr('src', '');
                }

                container.find('.edit-btn').hide();
                container.find('.save-btn').show();
                container.find('.cancel-btn').show();
            }

            function cancel(btn) {
                let container = $(btn.parentElement.parentElement.parentElement);
                let formId = $(btn).closest("form").attr("id");;

                let img = container.find('img');
                let input = container.find('input[type="file"]');
                let select = container.find('select')
                console.log(select.val());
                select.val(null);
                console.log(select.val());

                input.val(null);
                img.attr('src', img.attr("data-oldSrc"));

                container.find('.edit-btn').show();
                container.find('.save-btn').hide();
                container.find('.cancel-btn').hide();
            }

            function save(btn) {
                let container = $(btn).parents('div.row').first();
                let forms = $(btn).parents('form').first();
                let token = forms.find('input[name="_token"]').val();
                let inputName = forms.find('input[name="id"]');
                let inputFile = forms.find('input[type="file"]');

                var myFormData = new FormData();

                if (inputFile[0].files[0]) {
                    myFormData.append('file', inputFile[0].files[0]);
                }

                myFormData.append('id', inputName.val());
                console.log(inputName.val());

                $.ajax({
                    type: "POST",
                    url: "{{ route('admin.update.slider') }}",
                    headers: {
                        'X-CSRF-TOKEN': token
                    },
                    dataType: "json",
                    data: myFormData,
                    processData: false,
                    contentType: false,
                    success: function(data) {
                        // console.log(data);
                        alert('Successfully Updated');
                    },
                    error: function(data) {
                        // console.log(data);
                        alert('Sorry, only super admin can take this action.');

                    }
                });

                forms.find('.edit-btn').show();
                forms.find('.save-btn').hide();
                forms.find('.cancel-btn').hide();
                return true;
            }

            function GetSelectedTextValue(selectElement) {
                let container = $(selectElement).closest("form");
                console.log($(selectElement).val());
                container.find('.edit-btn').hide();
                container.find('.save-btn').show();
                container.find('.cancel-btn').show();
                // var sleTex = selectElement.options[education.selectedIndex].innerHTML;
                // var selVal = selectElement.value;
                // alert("Selected Text: " + sleTex + " Value: " + selVal);
            }
        </script>
    @endpush
@endsection
