@extends('layouts.app')
@section('content')
    <div class="container-fluid">
        <div class="col-lg-12">
            <div class="row">
                <div class="col-md-12">
                    <div class="card" style="background-color: aliceblue">
                        <div class="card-header" style="background-color: rgb(63, 11, 112); color:white">
                            <h4 style="float: left">Products Barcode</h4>
                            
                        </div>
                        <div class="card-body">
                            <div id="print">
                                <div class="row">

                                    @forelse ($productsBarcode as $barcode)
                                    <div class="col-lg-3 col-md-4 col-sm-12 mt-3 text-center0">
                                        <div class="card">
                                            <div class="card-body">
                                                <img src="{{ asset('product/barcodes/'. $barcode->barcode) }}" alt=" ">
                                                <h4 class="text-center" style="padding: 1em; margin-top:0.5em">{{ $barcode->product_code }}</h4>
                                            </div>
                                        </div>
                                    </div>
                                        
                                    @empty
                                        <h2 align="center">No Data</h2>
                                    @endforelse

                                </div>
                            </div>
                            <div class="row">
                                {{-- $products::links('pagination::bootstrap-4') --}}
                                {{-- $products->onEachSide(5)->links() --}}
                            </div>{{-- Pagiantion end --}}
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
