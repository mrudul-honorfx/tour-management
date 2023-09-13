@extends('layouts.master')
@section('title')
Hotel List
@endsection
@section('css')
<!-- DataTables -->
<link href="{{ URL::asset('/assets/libs/select2/select2.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ URL::asset('/assets/libs/dropzone/dropzone.min.css') }}" rel="stylesheet" type="text/css" />
@endsection

@section('content')
@component('common-components.breadcrumb')
@slot('pagetitle') Hotel @endslot
@slot('title') Add Hotel @endslot
@endcomponent

<div class="row">
    <div class="col-lg-12">
        <div id="addproduct-accordion" class="custom-accordion">
            <div class="card">
                <a href="#addproduct-billinginfo-collapse" class="text-dark" data-bs-toggle="collapse" aria-expanded="true" aria-controls="addproduct-billinginfo-collapse">
                    <div class="p-4">

                        <div class="d-flex align-items-center">
                            <div class="flex-shrink-0 me-3">
                                <div class="avatar-xs">
                                    <div class="avatar-title rounded-circle bg-soft-primary text-primary">
                                        01
                                    </div>
                                </div>
                            </div>
                            <div class="flex-grow-1 overflow-hidden">
                                <h5 class="font-size-16 mb-1">Basic Hotel Info</h5>
                                <p class="text-muted text-truncate mb-0">Fill all information below</p>
                            </div>
                            <div class="flex-shrink-0">
                                <i class="mdi mdi-chevron-up accor-down-icon font-size-24"></i>
                            </div>

                        </div>

                    </div>
                </a>

                <div id="addproduct-billinginfo-collapse" class="collapse show" data-bs-parent="#addproduct-accordion">
                    <div class="p-4 border-top">
                        @if(session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif
                
                        @if(session('error'))
                            <div class="alert alert-danger">
                                {{ session('error') }}
                            </div>
                        @endif
                        <form class="needs-validation " novalidate action="{{ route('addHotel.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-lg-6">

                                    <div class="mb-3">
                                         <label class="form-label" for="productname">Hotel Name</label>
                                <input id="hotel_name" name="hotel_name" type="text" class="form-control" placeholder="Enter your Hotel Name">
                                    </div>
                                </div>
                                <div class="col-lg-6">

                                    <div class="mb-3">
                                        <label class="form-label" for="productname">Address</label>
                                        <input id="address" name="address" type="text" class="form-control" placeholder="address">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-6">

                                    <div class="mb-3">
                                        <label class="form-label" for="manufacturername">Contact Number</label>
                                        <input id="contact_number" name="contact_number" type="text" class="form-control" placeholder="Enter Contact">
                                    </div>
                                </div>
                                <div class="col-lg-6">

                                    <div class="mb-3">
                                        <label class="form-label" for="manufacturerbrand">Rating</label>
                                        <select name="rating" id="rating" class="form-select">
                                            <option>Select</option>
                                            <option value="1">1 Star</option>
                                            <option value="2">2 Star</option>
                                            <option value="3">3 Star</option>
                                            <option value="4">4 Star</option>
                                            <option value="5">5 Star</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            

                            <div class="mb-0">
                                <label class="form-label" for="description">Hotel Description</label>
                                <textarea class="form-control" id="description" name="description" rows="4" placeholder="Enter Hotel Description"></textarea>
                            </div>

                            <div class="d-flex flex-reverse flex-wrap gap-2 py-5">
                                <button class="btn btn-success" type="submit"> <i class="uil uil-file-alt"></i>Add Hotel</button>
                            </div>

                        </form>
                    </div>
                </div>
            </div>

            {{-- <div class="card">
                <a href="#addproduct-img-collapse" class="text-dark collapsed" data-bs-toggle="collapse" aria-haspopup="true" aria-expanded="false" aria-haspopup="true" aria-controls="addproduct-img-collapse">
                    <div class="p-4">

                        <div class="d-flex align-items-center">
                            <div class="flex-shrink-0 me-3">
                                <div class="avatar-xs">
                                    <div class="avatar-title rounded-circle bg-soft-primary text-primary">
                                        02
                                    </div>
                                </div>
                            </div>
                            <div class="flex-grow-1 overflow-hidden">
                                <h5 class="font-size-16 mb-1">Hotel Specifications</h5>
                                <p class="text-muted text-truncate mb-0">Fill all information below</p>
                            </div>
                            <div class="flex-shrink-0">
                                <i class="mdi mdi-chevron-up accor-down-icon font-size-24"></i>
                            </div>

                        </div>

                    </div>
                </a>

                <div id="addproduct-img-collapse" class="collapse" data-bs-parent="#addproduct-accordion">
                    <div class="p-4 border-top">
                        <form action="#" class="dropzone">
                            <div class="fallback">
                                <input name="file" type="file" multiple="multiple">
                            </div>
                            <div class="dz-message needsclick">
                                <div class="mb-3">
                                    <i class="display-4 text-muted uil uil-cloud-upload"></i>
                                </div>

                                <h4>Drop files here or click to upload.</h4>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="card">
                <a href="#addproduct-metadata-collapse" class="text-dark collapsed" data-bs-toggle="collapse" aria-haspopup="true" aria-expanded="false" aria-haspopup="true" aria-controls="addproduct-metadata-collapse">
                    <div class="p-4">

                        <div class="d-flex align-items-center">
                            <div class="flex-shrink-0 me-3">
                                <div class="avatar-xs">
                                    <div class="avatar-title rounded-circle bg-soft-primary text-primary">
                                        03
                                    </div>
                                </div>
                            </div>
                            <div class="flex-grow-1 overflow-hidden">
                                <h5 class="font-size-16 mb-1">Food Details</h5>
                                <p class="text-muted text-truncate mb-0">Fill all information below</p>
                            </div>
                            <div class="flex-shrink-0">
                                <i class="mdi mdi-chevron-up accor-down-icon font-size-24"></i>
                            </div>

                        </div>

                    </div>
                </a>

                <div id="addproduct-metadata-collapse" class="collapse" data-bs-parent="#addproduct-accordion">
                    <div class="p-4 border-top">
                        <form>
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="mb-3">
                                        <label class="form-label" for="metatitle">Meta title</label>
                                        <input id="metatitle" name="metatitle" type="text" class="form-control" placeholder="Enter your Meta title">
                                    </div>

                                </div>

                                <div class="col-sm-6">
                                    <div class="mb-3">
                                        <label class="form-label" for="metakeywords">Meta Keywords</label>
                                        <input id="metakeywords" name="metakeywords" type="text" class="form-control" placeholder="Enter your Meta Keywords">
                                    </div>
                                </div>
                            </div>

                            <div class="mb-0">
                                <label class="form-label" for="metadescription">Meta Description</label>
                                <textarea class="form-control" id="metadescription" rows="4" placeholder="Enter your Meta Description"></textarea>
                            </div>
                        </form>
                    </div>
                </div>
            </div> --}}
        </div>
    </div>
</div>
<!-- end row -->

<div class="row mb-4">
    <div class="col ms-auto">
        <div class="d-flex flex-reverse flex-wrap gap-2">
            <button class="btn btn-success" type="submit"> <i class="uil uil-file-alt"></i>Add Hotel</button>
        </div>
    </div> <!-- end col -->
</div> <!-- end row-->


@endsection
@section('script')
<script src="{{ URL::asset('/assets/libs/select2/select2.min.js') }}"></script>
<script src="{{ URL::asset('/assets/libs/dropzone/dropzone.min.js') }}"></script>
<script src="{{ URL::asset('/assets/js/pages/ecommerce-add-product.init.js') }}"></script>
@endsection
