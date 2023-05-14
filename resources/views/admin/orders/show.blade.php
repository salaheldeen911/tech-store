@extends('layouts.admin-app')

@section('admin-content')
    <!-- Page Content -->
    <div class="unix-invoice">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    @if ($order)
                        <div id="invoice" class="effect2 m-t-30">
                            <div id="invoice-top">
                                <div class="invoice-logo"></div>
                                <div class="invoice-info">
                                    <h2>{{ $order->user->name }}</h2>
                                    <p>{{ $order->user->email }}</p>
                                </div>
                                <!--End Info-->
                                <div class="title">
                                    <h4>Oeder #{{ $order->id }}</h4>
                                    <p>Ordered At: {{ $order->created_at->format('M d, Y') }}</p>
                                </div>
                                <!--End Title-->
                            </div>

                            <div id="invoice-bot">

                                <div id="invoice-table" class="pt-0">
                                    <div class="table-responsive">
                                        <h1>Products</h1>
                                        <table class="table text-center">
                                            <tr class="tabletitle">
                                                <td style="width:20%" class="table-item">
                                                    <h2>Image</h2>
                                                </td>
                                                <td class="Hours">
                                                    <h2>Price</h2>
                                                </td>
                                                <td class="Rate">
                                                    <h2>Discount</h2>
                                                </td>
                                                <td class="subtotal">
                                                    <h2>Final Price</h2>
                                                </td>
                                                <td class="subtotal">
                                                    <h2>Quantity</h2>
                                                </td>
                                                <td class="subtotal">
                                                    <h2>Sub-total</h2>
                                                </td>
                                            </tr>
                                            @foreach ($order->products as $product)
                                                <tr class="service">
                                                    <td class="tableitem">
                                                        <a href="/dashboard/products/{{ $product->id }}">
                                                            <img style="width:100%;height:100%;"
                                                                src="{{ asset($product->main_image) }}" alt="">
                                                        </a>
                                                    </td>
                                                    <td class="tableitem">
                                                        <p style="width:100%;height:120px;display:flex;justify-content:center;align-items:center;"
                                                            class="h3">{{ $product->price }}$</p>
                                                    </td>
                                                    <td class="tableitem">
                                                        <p style="width:100%;height:120px;display:flex;justify-content:center;align-items:center;"
                                                            class="h3">{{ $product->discount_percent }}%</p>
                                                    </td>
                                                    <td class="tableitem">
                                                        <p style="width:100%;height:120px;display:flex;justify-content:center;align-items:center;"
                                                            class="h3">{{ $product->final_price }}$</p>
                                                    </td>

                                                    <td class="tableitem">
                                                        <p style="width:100%;height:120px;display:flex;justify-content:center;align-items:center;"
                                                            class="h3">{{ $product->pivot->count }}</p>
                                                    </td>
                                                    <td class="tableitem">
                                                        <p style="width:100%;height:120px;display:flex;justify-content:center;align-items:center;"
                                                            class="h1">
                                                            <strong>{{ $product->pivot->count * $product->final_price }}$</strong>
                                                        </p>
                                                    </td>
                                                </tr>
                                            @endforeach

                                            <tr class="tabletitle" style="height:15px">
                                                <td style="display:flex;justify-content:center;" class="Rate">
                                                    <h1 class="h3">Total</h1>
                                                </td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>

                                                <td class="payment">
                                                    <h1 style="display:flex;justify-content:center;align-items:center;">
                                                        {{ $order->total }}$</h1>
                                                </td>
                                            </tr>

                                        </table>
                                    </div>
                                </div>
                                <!--End Table-->
                                <h1>Address Details</h1>

                                <p><strong>Name: </strong>{{ $order->address->name }}</p>

                                <p><strong>Phone: </strong>{{ $order->address->phone }}</p>

                                <p><strong>City: </strong>{{ $order->address->city }}</p>

                                <p><strong>Address: </strong>{{ $order->address->address }}</p>

                                @if ($order->address->note)
                                    <p><strong>Note: </strong>{{ $order->address->note }}</p>
                                @endif
                                <div id="legalcopy">
                                    <p class="legal"><strong>Thank you for your business!</strong>  Payment is expected
                                        within
                                        31 days; please process this invoice within that time. There will be a 5% interest
                                        charge per month on late invoices.
                                    </p>
                                </div>

                            </div>
                            <!--End InvoiceBot-->
                        </div>
                    @else
                        <div class="container mt-5 mb-5">
                            <div class="row justify-content-center">
                                <div class="col-md-8">
                                    <div class="card">
                                        <div class="card-header">{{ __('Order Deletation') }}</div>

                                        <div class="card-body">
                                            {{-- @if (session('resent')) --}}
                                            <div class="alert alert-danger" role="alert">
                                                {{ __('Unfortionatly, this order has been deleted. Please contact site administrator for more details.') }}
                                            </div>
                                            <hr>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif

                    <!--End Invoice-->
                </div>
            </div>
        </div>
    </div>
@endsection
