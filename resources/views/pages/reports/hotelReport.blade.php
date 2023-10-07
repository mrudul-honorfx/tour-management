@extends('layouts.master')
@section('title')
    @lang('translation.Starter_Page')
@endsection
@section('css')
<!-- plugin css -->
<link href="{{ URL::asset('/assets/libs/select2/select2.min.css') }}" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="{{ URL::asset('/assets/libs/datepicker/datepicker.min.css') }}">
@endsection
@section('content')
    @component('common-components.breadcrumb')
        @slot('pagetitle') Report @endslot
        @slot('title') Hotel Report @endslot
    @endcomponent
    <div class="row">
        <div class="card">
            <div class="card-body">
                <form enctype="multipart/form-data" action="{{ route('generateHotelReport') }}"
                method="POST">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label class="form-label">Select Hotel</label>
                                <select class="select2 form-control select2-multiple"  data-placeholder="Choose ...">
                                    @foreach($hotelList as $hotel)
                                        <option value="{{$hotel->id}}">{{$hotel->hotel_name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label class="form-label">Date Range</label>
                                <div class="input-daterange input-group" id="datepicker6" data-date-format="dd M, yyyy" data-date-autoclose="true" data-provide="datepicker" data-date-container='#datepicker6'>
                                    <input type="text" class="form-control" name="start" placeholder="Start Date" />
                                    <input type="text" class="form-control" name="end" placeholder="End Date" />
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12 text-center">
                                <input type="submit" class="btn btn-primary" value="Get Report" />
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@section('script')
<script src="{{ URL::asset('/assets/libs/select2/select2.min.js') }}"></script>
<script src="{{ URL::asset('/assets/libs/spectrum-colorpicker/spectrum-colorpicker.min.js') }}"></script>
<script src="{{ URL::asset('/assets/libs/bootstrap-datepicker/bootstrap-datepicker.min.js') }}"></script>
<script src="{{ URL::asset('/assets/libs/bootstrap-touchspin/bootstrap-touchspin.min.js') }}"></script>
<script src="{{ URL::asset('/assets/libs/bootstrap-maxlength/bootstrap-maxlength.min.js') }}"></script>
<script src="{{ URL::asset('/assets/libs/datepicker/datepicker.min.js') }}"></script>
<script src="{{ URL::asset('/assets/libs/flatpickr/flatpickr.min.js') }}"></script>
<script src="{{ URL::asset('/assets/js/pages/form-advanced.init.js') }}"></script>
@endsection