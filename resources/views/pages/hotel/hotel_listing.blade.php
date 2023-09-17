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
                                <h5 class="font-size-16 mb-1">Hotel Info</h5>
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
                        <form>
                            
                            <div class="row">
                                <div class="col-lg-6">
                            <div class="mb-3">
                                <label class="form-label" for="productname">Hotel Name</label>
                                <input id="hotelname" name="hotel_name" type="text" class="form-control" placeholder="Enter Hotel Name">
                            </div>
                                </div>
                                <div class="col-lg-6">

                                    <div class="mb-3">
                                        <label class="form-label" for="manufacturername">Address</label>
                                        <input id="address" name="address" type="text" class="form-control" placeholder="Enter Hotel Address">
                                    </div>
                                </div>
                                <div class="col-lg-6">

                                    <div class="mb-3">
                                        <label class="form-label" for="manufacturerbrand">Contact Number</label>
                                        <input id="manufacturerbrand" name="contact_number" type="text" class="form-control" placeholder="Enter Contact Number">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <label class="form-label" for="price">Rating</label>
                                        <select id="rating" name="rating" type="text" class="form-control" >
                                            {{-- // set hotel sar rating values from one star to 5 star --}}
                                            <option value="1">1 Star</option>
                                            <option value="2">2 Star</option>
                                            <option value="3">3 Star</option>
                                            <option value="4">4 Star</option>
                                            <option value="5">5 Star</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="mb-3">
                                        <label class="form-label" for="productdesc">Hotel Description</label>
                                        <textarea class="form-control" id="productdesc" name="description" rows="4" placeholder="Enter Hotel Description"></textarea>
                                    </div>
                                </div>
                            </div>

                           <div class="row">
                                
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label" class="control-label">Room Types</label>

                                        <select class="select2 form-control select2-multiple" name="room_types[]" multiple="multiple" data-placeholder="Choose ...">
                                            @foreach($room_types as $index => $room_type)
                                            <option value="{{ $room_type->id }}" >{{ $room_type->room_type_name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div> 

                            
                        </form>
                    </div>
                </div>
            </div>

            <div class="card">
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
                                <h5 class="font-size-16 mb-1">Hotel Images</h5>
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
                        

                        
                        <div class="row">
                            
                        <div class="col-lg-6">
                            <div class="mb-3">
                                   
                                <label class="form-label" for="images">Images</label>
                                <input type="file" class="form-control" name="images[]" id="images" multiple accept=".jpeg, .jpg, .png, .gif">
                            </div>
                            <div id="image-previews"></div>
                        </div>
                        </div> 
                    
                    </div>
                </div>
            </div> 
            {{-- <div class="card">
                <a href="#addproduct-billinginfo-collapse1" class="text-dark" data-bs-toggle="collapse" aria-expanded="true" aria-controls="addproduct-billinginfo-collapse1">
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
                                <h5 class="font-size-16 mb-1">Hotel Mapping</h5>
                                <p class="text-muted text-truncate mb-0">Fill all information below</p>
                            </div>
                            <div class="flex-shrink-0">
                                <i class="mdi mdi-chevron-up accor-down-icon font-size-24"></i>
                            </div>

                        </div>

                    </div>
                </a>

                <div id="addproduct-billinginfo-collapse1" class="collapse" data-bs-parent="#addproduct-accordion1">
                    <div class="p-4 border-top">
                        <form>
                            
                            <div class="row">
                                <div class="col-lg-6">
                            <div class="mb-3">
                                <label class="form-label" for="productname">Hotel Name</label>
                                <input id="hotelname" name="hotel_name" type="text" class="form-control" placeholder="Enter Hotel Name">
                            </div>
                                </div>
                                <div class="col-lg-6">

                                    <div class="mb-3">
                                        <label class="form-label" for="manufacturername">Address</label>
                                        <input id="address" name="address" type="text" class="form-control" placeholder="Enter Hotel Address">
                                    </div>
                                </div>
                                <div class="col-lg-6">

                                    <div class="mb-3">
                                        <label class="form-label" for="manufacturerbrand">Contact Number</label>
                                        <input id="manufacturerbrand" name="contact_number" type="text" class="form-control" placeholder="Enter Contact Number">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <label class="form-label" for="price">Rating</label>
                                        <input id="price" name="rating" type="text" class="form-control" placeholder="Enter Rating">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label" class="control-label">Room Types</label>

                                        <select class="select2 form-control select2-multiple" name="room_types[]" multiple="multiple" data-placeholder="Choose ...">
                                            @foreach($room_types as $index => $room_type)
                                            <option value="{{ $room_type->id }}" >{{ $room_type->room_type_name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                
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
            <a href="#" class="btn btn-danger"> <i class="uil uil-times"></i> Cancel </a>
            <a href="#" class="btn btn-success"> <i class="uil uil-file-alt"></i> Save </a>
        </div>
    </div> <!-- end col -->
</div> <!-- end row-->


@endsection

@section('script')
<script>
    document.getElementById('images').addEventListener('change', function (event) {
        var imagePreviews = document.getElementById('image-previews');
        imagePreviews.innerHTML = ''; // Clear existing previews

        for (var i = 0; i < event.target.files.length; i++) {
            var img = document.createElement('img');
            img.src = URL.createObjectURL(event.target.files[i]);
            img.className = 'img-thumbnail mr-2 mb-2';
            img.style.maxWidth = '300px';
            img.style.maxHeight = '300px';
            imagePreviews.appendChild(img);
        }
    });
</script>
<script src="{{ URL::asset('/assets/libs/select2/select2.min.js') }}"></script>
<script src="{{ URL::asset('/assets/libs/dropzone/dropzone.min.js') }}"></script>
<script src="{{ URL::asset('/assets/js/pages/ecommerce-add-product.init.js') }}"></script>
@endsection
