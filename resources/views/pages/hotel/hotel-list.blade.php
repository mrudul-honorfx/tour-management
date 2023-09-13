@extends('layouts.master')
@section('title')
@lang('translation.Invoice_List')
@endsection
@section('css')
<!-- DataTables -->
<link href="{{ URL::asset('/assets/libs/datatables/datatables.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ URL::asset('/assets/libs/bootstrap-datepicker/bootstrap-datepicker.min.css') }}" rel="stylesheet" type="text/css" />
@endsection

@section('content')
@component('common-components.breadcrumb')
@slot('pagetitle') Hotels @endslot
@slot('title') Hotels List @endslot
@endcomponent

<div class="row">
    <div class="col-md-4">
        <div>
            <button type="button" class="btn btn-success waves-effect waves-light mb-3"><i class="mdi mdi-plus me-1"></i> Add Hotel</button>
        </div>
    </div>
    
</div>

<div class="row">
    <div class="col-lg-12">

        <div class="table-responsive mb-4">
            <table class="table table-centered  dt-responsive nowrap table-card-list" style="border-collapse: collapse; border-spacing: 0 12px; width: 100%;">
                <thead>
                    <tr class="bg-transparent">
                        
                        <th>Hotel ID</th>
                        <th>Name</th>
                        <th>Address</th>
                        <th>Rating</th>
                        <th>Contact</th>
                        <th style="width: 120px;">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($hotels as $index => $hotel)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{$hotel->hotel_name}}</td>
                        <td>{{$hotel->address}}</td>
                        <td>{{$hotel->rating}} Star</td>
                        <td>{{$hotel->contact_number}}</td>
                        <td>
                            <a href="javascript:void(0);" class="px-3 text-primary"><i class="uil uil-pen font-size-18"></i></a>
                            <a href="javascript:void(0);" class="px-3 text-danger"><i class="uil uil-trash-alt font-size-18"></i></a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
<!-- end row -->

@endsection
@section('script')
<script src="{{ URL::asset('/assets/libs/datatables/datatables.min.js') }}"></script>
<script src="{{ URL::asset('/assets/libs/bootstrap-datepicker/bootstrap-datepicker.min.js') }}"></script>
<script src="{{ URL::asset('/assets/js/pages/ecommerce-datatables.init.js') }}"></script>
@endsection
