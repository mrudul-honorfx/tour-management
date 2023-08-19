@extends('layouts.master')
@section('title')
   Room Type
@endsection

@section('content')
    @component('common-components.breadcrumb')
        @slot('pagetitle') Room Type @endslot
        @slot('title') Hotel @endslot 
    @endcomponent

    <div class="row">
        <div class="col-6">
            <div class="card">
                <div class="card-body">

                    <h4 class="card-title">Room Types</h4>
                   
                    <div class="table-responsive">
                        <table class="table table-editable table-nowrap align-middle table-edits">
                            <thead>
                                <tr>
                                    
                                    <th>Room Type</th>
                                    <th>Room Type Code</th>
                                    <th>Description</th>
                                    <th>Image</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr data-id="1">
                                    <td data-field="id" style="width: 80px">1</td>
                                    <td data-field="name">David McHenry</td>
                                    <td data-field="age">24</td>
                                    <td data-field="gender">Male</td>
                                    <td style="width: 100px">
                                        <a class="btn btn-outline-secondary btn-sm edit" title="Edit">
                                            <i class="fas fa-pencil-alt"></i>
                                        </a>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div> <!-- end col -->
        <div class="col-xl-6">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Add Room Types</h4>
                   
                    <form class="needs-validation" novalidate>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label" for="validationCustom01">Room Type Name</label>
                                    <input type="text" class="form-control" name="room_type_name" id="validationCustom01" placeholder="Room Type Name"
                                         required>
                                    <div class="valid-feedback">
                                        Looks good!
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label" for="validationCustom02">Room Type Code</label>
                                    <input type="text" class="form-control" name="room_type_code" id="validationCustom02" placeholder="Room Type Code"
                                        required>
                                    <div class="valid-feedback">
                                        Looks good!
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                            <div class="col-12">
                                <div class="mb-3">
                                    <label class="form-label" for="validationCustom03">Description</label>
                                    <textarea required class="form-control" name="description" id="validationCustom03" placeholder="Description" rows="3"></textarea>
                                    
                                    <div class="invalid-feedback">
                                        Please provide a valid description.
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="mb-3">
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
                            
                            
                        
                        
                        <button class="btn btn-primary" type="submit">Submit form</button>
                    </form>
                </div>
            </div>
            <!-- end card -->
        </div>
    </div> <!-- end row -->

@endsection
@section('script')
    <script src="{{ URL::asset('/assets/libs/table-edits/table-edits.min.js') }}"></script>
    <script src="{{ URL::asset('/assets/js/pages/table-editable.init.js') }}"></script>
    <script src="{{ URL::asset('/assets/libs/parsleyjs/parsleyjs.min.js') }}"></script>
    <script src="{{ URL::asset('/assets/js/pages/form-validation.init.js') }}"></script>
    <script src="{{ URL::asset('/assets/libs/dropzone/dropzone.min.js') }}"></script>
@endsection
