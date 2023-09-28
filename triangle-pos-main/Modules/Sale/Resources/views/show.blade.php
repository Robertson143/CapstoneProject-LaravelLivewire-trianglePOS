@extends('layouts.app')

@section('title', 'Sales Details')

@section('breadcrumb')

    <ol class="breadcrumb border-0 m-0">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
        <li class="breadcrumb-item"><a href="{{ route('sales.index') }}">Sales</a></li>
        <li class="breadcrumb-item active">Details</li>
    </ol>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header d-flex flex-wrap align-items-center">
                        <div class="reference" style="margin-left: 420px;">
                            Reference: <strong>{{ $sale->reference }}</strong>
                        </div>
                        <a target="_blank" class="btn btn-sm btn-secondary mfs-auto mfe-1 d-print-none" href="{{ route('sales.pdf', $sale->id) }}">
                            <i class="bi bi-printer"></i> Print
                        </a>
                        <a target="_blank" class="btn btn-sm btn-info mfe-1 d-print-none" href="{{ route('sales.pdf', $sale->id) }}">
                            <i class="bi bi-save"></i> Save
                        </a>
                    </div>
                    <div class="card-body">
                        <div class="row mb-4 text-center">
                            <div class="col-sm-4 mb-3 mb-md-0" style="margin-left: 335px;">
                                <h5 class="mb-2 border-bottom pb-2">Store information:</h5>
                                <div><strong>{{ settings()->company_name }}</strong></div>
                                <div>{{ settings()->company_address }}</div>
                                <div>Email: {{ settings()->company_email }}</div>
                                <div>Phone: {{ settings()->company_phone }}</div>
                            </div>

                          <!--  <div class="col-sm-4 mb-3 mb-md-0">
                                <h5 class="mb-2 border-bottom pb-2">Customer Info:</h5>
                                <div><strong>{{ $customer->customer_name }}</strong></div>
                                <div>{{ $customer->address }}</div>
                                <div>Email: {{ $customer->customer_email }}</div>
                                <div>Phone: {{ $customer->customer_phone }}</div>
                            </div> -->

                          <!--  <div class="col-sm-4 mb-3 mb-md-0">
                                <h5 class="mb-2 border-bottom pb-2">Invoice Info:</h5>
                                <div>Invoice: <strong>INV/{{ $sale->reference }}</strong></div>
                                <div>Date: {{ \Carbon\Carbon::parse($sale->date)->format('d M, Y') }}</div>
                                <div>
                                    Status: <strong>{{ $sale->status }}</strong>
                                </div>
                                <div>
                                    Payment Status: <strong>{{ $sale->payment_status }}</strong>
                                </div>
                            </div> -->

                        </div>

                        <div class="table-responsive-sm">
                            <table class="table table-striped">
                                <thead>
                               <!-- <tr>
                                    <th class="align-middle">Product</th>
                                    <th class="align-middle">Price</th>
                                    <th class="align-middle">Quantity</th>
                                    <th class="align-middle">Discount</th>
                                    <th class="align-middle">Tax</th>
                                    <th class="align-middle">Sub Total</th>
                                </tr> -->
                                </thead>
                                <tbody>
                                @foreach($sale->saleDetails as $item)
                                <!--    <tr>
                                        <td class="align-middle">
                                            {{ $item->product_name }} <br>
                                           <span class="badge badge-success">
                                                {{ $item->product_code }}
                                            </span> 
                                        </td>

                                        <td class="align-middle">{{ format_currency($item->unit_price) }}</td>

                                        <td class="align-middle">
                                            {{ $item->quantity }}
                                        </td>

                                        <td class="align-middle">
                                        {{ format_currency($sale->discount_amount) }}
                                        </td>

                                        <td class="align-middle">
                                            {{ format_currency($item->product_tax_amount) }}
                                        </td>

                                        <td class="align-middle">
                                            {{ format_currency($item->sub_total) }}
                                        </td>
                                    </tr> 
                                @endforeach
                                </tbody> -->
                            </table>
                        </div>
                        <div class="row">
                            <div class="col-lg-4 col-sm-5 ml-md-auto" style="margin-right: 330px;">
                                <table class="table">
                                    <tbody>
                                        <h5 style="margin-left: 10px;"><strong>Products</strong></h5>
                                        <h5 style="margin-left: 180px; margin-top: -30px;"><strong>Price</strong></h5>
                                        <h5 style="margin-left: 265px; margin-top: -30px;"><strong>Qty.</strong></h5>
                                    <tr>
                                    @foreach($sale->saleDetails as $item)
                                        <td class="left"><strong>{{ $item->product_name }}</strong></td>
                                        <td class="right">{{ format_currency($item->unit_price) }}</td>
                                        <td class="left">{{ $item->quantity }}</td>
                                    </tr>
                                    
                                    <tr>
                                    <td class="left"><strong>Sub Total:</strong></td>
                                        <td class="right">{{ format_currency($item->sub_total) }}</td>
                                        <td class="left"> {{ $item->quantity }}</td>
                                    </tr>
                                   
                                    <tr>
                                        <td class="left"><strong>Discount ({{ $sale->discount_percentage }}%)</strong></td>
                                        <td class="right">{{ format_currency($sale->discount_amount) }}</td>
                                        <td class="left"></td>
                                    </tr>
                                    <tr>
                                        <td class="left"><strong>Total VAT ({{ $sale->tax_percentage }}%)</strong></td>
                                        <td class="right">{{ format_currency($item->product_tax_amount) }}</td>
                                        <td class="left"></td>
                                    </tr>
                                   <!-- <tr>
                                        <td class="left"><strong>Shipping</strong></td>
                                        <td class="right">{{ format_currency($sale->shipping_amount) }}</td>
                                    </tr> -->
                                    <tr style="background:green; color: white;">
                                        <td class="left"><strong>Grand Total</strong></td>
                                        <td class="right"><strong>{{ format_currency($sale->total_amount) }}</strong></td>
                                        <td class="left">{{ $item->quantity }}</td>
                                    </tr>
                                    </tbody>
                                    @endforeach
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

