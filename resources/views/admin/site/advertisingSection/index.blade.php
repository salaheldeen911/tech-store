@extends('layouts.admin-app')

@push('styles')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">

    <style>
        .showcase-block {
            margin-bottom: 20px;
            padding-bottom: 10px;
            display: flex;
            flex-direction: column;
            align-items: center;
            width: 100%;
            height: 300px;
        }

        .bottons_holder {
            display: flex;
            align-items: center;
            justify-content: space-around;
            margin: 20px 0;
        }

        .main_bottons_holder,
        .lable_bottons_holder {
            display: flex;
            width: 100%;
            justify-content: space-around;
            margin-bottom: 10px;
        }

        .dropdown.bootstrap-select {
            width: 100% !important;
        }

        .showcase-img {
            padding: 18px 0 0;
            max-width: 100%;
            flex-grow: 10;
            height: 80%;
        }

        .showcase-img img {
            max-width: 100%;
            height: 100%;
        }

        /* .big_brand {
                                                                                                                                                                                                                                                                                                                                                                                                display: flex;
                                                                                                                                                                                                                                                                                                                                                                                                flex-direction: row;
                                                                                                                                                                                                                                                                                                                                                                                                justify-content: space-around;
                                                                                                                                                                                                                                                                                                                                                                                                align-items: start;
                                                                                                                                                                                                                                                                                                                                                                                            } */

        .big_brand .showcase-img {
            height: 100%;
        }

        .editImage,
        .editLable {
            display: flex;
            flex-grow: 1;
            justify-content: center;
        }

        .display-logo {
            max-height: 15%;
            min-width: 25%;
            max-width: 50%;
            height: 15%;
            margin: 0 !important;
            display: flex;
            flex-direction: column;
        }

        .lable_image {
            min-height: 65%;
            max-height: 100%;
            max-width: 100%;
        }

        .save-btn {
            display: block;
            width: 70%;
            margin: 10px auto 0 auto;
            font-family: sans-serif;
            font-weight: 700;
        }
    </style>
@endpush

@section('admin-content')
    <div class="container">
        <div class="row">
            <div class="col-lg-8 p-0">
                <div class="page-header p-0">
                    <div class="page-title">
                        <h1>Advertising Section</h1>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 p-l-0 title-margin-left">
                <div class="page-header">
                    <div class="page-title">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active">Advertising Section</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div style="margin-top: 26px" class="card">
                    <div class="card-header">{{ __('Advertising Section') }}</div>
                    <div class="card-body">
                        <!-- mobile showcase -->
                        <div class="space-medium">
                            <div class="container w-100">
                                <div class="row">
                                    @foreach ($advertisingSections as $advertisingSection)
                                        <div
                                            class="{{ $advertisingSection->id == 2 ? 'col-lg-6 col-md-6' : 'col-lg-3 col-md-3' }} col-sm-12 col-xs-12 mb-4">
                                            <div class="con">
                                                <input type="text" style="display: none" name="id"
                                                    value="{{ $advertisingSection->id }}">

                                                <div
                                                    class="showcase-block {{ $advertisingSection->id == 2 ? '.big_brand' : '' }}">
                                                    @if ($loop->index > 2)
                                                        <div class="display-logo mb-4">
                                                            <img class="lable_image"
                                                                src="{{ asset($advertisingSection->brand_lable_image_path) }}"
                                                                alt="phone-image">
                                                        </div>
                                                    @else
                                                        <h4
                                                            style="text-align:center;font-family:'Hurricane',cursive;font-size:21px;margin:0;font-weight:900;">
                                                            {{ $advertisingSection->category->name }}</h4>
                                                    @endif
                                                    <div class="showcase-img" style="flex-grow:10;">
                                                        <img class="main_image" style="width:100%;height:100%"
                                                            src="{{ asset($advertisingSection->brand_main_image_path) }}"
                                                            alt="phone-image">
                                                    </div>
                                                </div>

                                                <div class="bottons_holder">
                                                    <div class="editImage">
                                                        <div class="img-input">
                                                            <label for="brand-{{ $advertisingSection->id }}"
                                                                style="font-size:13px" class="btn btn-primary edit-btn">Edit
                                                                image</label>
                                                            <input id='brand-{{ $advertisingSection->id }}' type='file'
                                                                name='image' style='display:none' accept="image/*"
                                                                onchange="CheckImage(this)" />
                                                        </div>

                                                        <div class="main_bottons_holder" style="display:none;">
                                                            <span style="font-size:13px" onclick="cancelMain(this)"
                                                                class="btn btn-danger save-btn-image edit-btn">Cancel
                                                                image</span>

                                                        </div>
                                                    </div>
                                                    @if ($loop->index > 2)
                                                        <div class="editLable">
                                                            <div class="lable-input">
                                                                <label style="font-size:13px"
                                                                    for="lable-{{ $advertisingSection->id }}"
                                                                    class="btn btn-primary edit-btn">Edit
                                                                    lable</label>
                                                                <input id='lable-{{ $advertisingSection->id }}'
                                                                    type='file' name='lable' style='display:none'
                                                                    accept="image/*" onchange="CheckLable(this)" />
                                                            </div>

                                                            <div class="lable_bottons_holder" style="display:none;">
                                                                <span style="font-size:13px" onclick="cancelLable(this)"
                                                                    class="btn btn-danger save-btn-image edit-btn">Cancel
                                                                    lable</span>
                                                            </div>
                                                        </div>
                                                    @endif
                                                </div>
                                                @if ($loop->index <= 2)
                                                    <div class="category mb-2">
                                                        <select name="category" class="selectpicker">
                                                            @foreach ($categoreis as $category)
                                                                <option
                                                                    {{ $category->id == $advertisingSection->category_id ? 'selected' : '' }}
                                                                    value="{{ $category->id }}">{{ $category->name }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                @endif
                                                @if ($loop->index > 2)
                                                    <div class="brand">
                                                        <select name="brand" class="selectpicker">
                                                            @foreach ($brands as $brand)
                                                                <option
                                                                    {{ $brand->id == $advertisingSection->brand_id ? 'selected' : '' }}
                                                                    value="{{ $brand->id }}">{{ $brand->name }}
                                                                </option>
                                                            @endforeach

                                                        </select>
                                                    </div>
                                                @endif
                                                {{-- <div class="category mb-2">
                                                    <select name="category" class="selectpicker">
                                                        @foreach ($categoreis as $category)
                                                            <option
                                                                {{ $category->id == $advertisingSection->category_id ? 'selected' : '' }}
                                                                value="{{ $category->id }}">{{ $category->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div> --}}
                                                {{-- <div class="brand">
                                                    <select name="brand" class="selectpicker">
                                                        @foreach ($brands as $brand)
                                                            <option
                                                                {{ $brand->id == $advertisingSection->brand_id ? 'selected' : '' }}
                                                                value="{{ $brand->id }}">{{ $brand->name }}</option>
                                                        @endforeach

                                                    </select>
                                                </div> --}}

                                                <span onclick="save(this)" class="btn btn-success save-btn-image save-btn">S
                                                    a v e</span>
                                            </div>

                                        </div>
                                    @endforeach
                                </div>

                            </div>
                        </div>
                        <!-- /.mobile showcase -->
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <!-- Latest compiled and minified JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/bootstrap-select.min.js"></script>

    <script>
        function CheckImage(input) {
            var fileName = input.value;
            var ext = fileName.substring(fileName.lastIndexOf('.') + 1);
            let container = $(input).parents('.con').first();
            if (ext == "jpg" || ext == "jpeg" || ext == "png") {
                attachImg(input, container);
            } else {
                alert("The image extintion must be one of those : jpg, jpeg or png");
                input.val(null);
                return false;
            }
        }

        function CheckLable(input) {
            var fileName = input.value;
            var ext = fileName.substring(fileName.lastIndexOf('.') + 1);
            let container = $(input).parents('.con').first();
            if (ext == "jpg" || ext == "jpeg" || ext == "png") {
                attachLable(input, container);
            } else {
                alert("The image extintion must be one of those : jpg, jpeg or png");
                input.val(null);
                return false;
            }
        }

        function attachImg(input, container) {
            if (input.files && input.files[0]) {
                let reader = new FileReader();
                let img = container.find('.main_image');
                img.attr('data-oldSrc', img.attr('src'));
                reader.onload = function(e) {
                    img.attr('src', e.target.result);
                }
                reader.readAsDataURL(input.files[0]);
            } else {
                img.attr('src', '');
            }

            // container.find('.editLable').hide();
            container.find('.img-input').hide();
            container.find('.main_bottons_holder').show();
        }

        function attachLable(input, container) {
            if (input.files && input.files[0]) {
                let reader = new FileReader();
                let img = container.find('.lable_image');
                img.attr('data-oldSrc', img.attr('src'));
                reader.onload = function(e) {
                    img.attr('src', e.target.result);
                }
                reader.readAsDataURL(input.files[0]);
            } else {
                img.attr('src', '');
            }

            // container.find('.editImage').hide();
            container.find('.lable-input').hide();
            container.find('.lable_bottons_holder').show();

        }

        function cancelMain(btn) {
            let container = $(btn).parents('.con').first();
            let img = container.find('.main_image');
            let input = container.find('input[type="file"][name="image"]');
            input.val(null);
            img.attr('src', img.attr("data-oldSrc"));

            container.find('.editLable').show();
            container.find('.img-input').show();
            container.find('.main_bottons_holder').hide();
        }

        function cancelLable(btn) {
            let container = $(btn).parents('.con').first();
            let img = container.find('.lable_image');
            let input = container.find('input[type="file"][name="lable"]');
            input.val(null);
            img.attr('src', img.attr("data-oldSrc"));

            container.find('.editImage').show();
            container.find('.lable-input').show();
            container.find('.lable_bottons_holder').hide();
        }

        function save(btn) {
            let container = $(btn).parent('div.con');
            let token = $('meta[name="csrf-token"]').attr('content');
            let id = container.find('input[name="id"]').val();
            let mainImage = container.find('input[type="file"][name="image"]');
            let brand = container.find('select[name="brand"]')[0];
            let category = container.find('select[name="category"]')[0];

            var myFormData = new FormData();
            myFormData.append('_token', token);

            if (brand) {
                let brand_id = brand.options[brand.selectedIndex].value;
                myFormData.append('brand_id', brand_id);
                console.log(brand_id);
            }

            if (category) {
                let category_id = category.options[category.selectedIndex].value;

                myFormData.append('category_id', category_id);
            }
            myFormData.append('id', id);

            if (mainImage[0].files[0]) {
                myFormData.append('image', mainImage[0].files[0]);
            }
            if (brand) {
                let lableImage = container.find('input[type="file"][name="lable"]');
                if (lableImage[0].files[0]) {
                    myFormData.append('lable', lableImage[0].files[0]);
                }
            }

            $.ajax({
                type: "POST",
                url: "{{ route('admin.update.advertisingSections') }}",
                dataType: "json",
                data: myFormData,
                processData: false,
                contentType: false,
                success: function(data) {
                    alert('Successfully Updated');
                },
                error: function(d, c, responde) {
                    // console.log(responde);
                    alert('Sorry, only super admin can take this action.');
                }
            });

            container.find('.editLable').show();
            container.find('.img-input').show();
            container.find('.main_bottons_holder').hide();
            container.find('.editImage').show();
            container.find('.lable-input').show();
            container.find('.lable_bottons_holder').hide();
            return true;
        }
    </script>
@endpush
