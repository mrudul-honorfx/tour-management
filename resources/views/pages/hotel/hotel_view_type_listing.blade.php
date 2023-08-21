@extends('layouts.master')
@section('title')
   View Type
@endsection
<style>
    /* Style for the image preview */
    #image-preview img {
        max-width: 200px;
        max-height: 200px;
        margin: 10px;
    }
</style>
@section('content')
    @component('common-components.breadcrumb')
        @slot('pagetitle') Hotel @endslot
        @slot('title')View Type  @endslot 
    @endcomponent

    <div class="row">
        <div class="col-6">
            <div class="card">
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
                <div class="card-body">
                    <h4 class="card-title mb-3">Add View Types</h4>
                   
                    <form class="needs-validation " novalidate action="{{ route('addViewTypes.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label class="form-label" for="validationCustom01">View Type Name</label>
                                    <input type="text" class="form-control" name="view_type_name" id="validationCustom01" placeholder="View Type Name"
                                         required>
                                    <div class="valid-feedback">
                                        Looks good!
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
                        </div>
                            
                            
                        
                        
                        <button class="btn btn-primary" type="submit">Add View Types</button>
                    </form>
                   
                </div>
            </div>
            <!-- end card -->
        </div>
        <div class="col-6">
            <div class="card">
                <div class="card-body">

                    <h4 class="card-title">View Types</h4>
                   
                    <div class="table-responsive">
                        <table class="table table-editable table-nowrap align-middle table-edits">
                            <thead>
                                <tr>
                                    <th>Sl no</th>
                                    <th>View Type</th>
                                  
                                    <th>Description</th>
                                   
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($view_types as $index => $view)
                                <tr data-id="{{ $index + 1 }}">
                                    <td  style="width: 80px">{{ $index + 1 }}</td>
                                    <td >{{ $view->view_type_name }}</td>
                                   
                                    <td >{{ $view->description }}</td>
                                   
                                    <td >
                                        
                                        <button type="button" class="btn btn-outline-secondary btn-sm" data-bs-toggle="modal" data-bs-target="#editModal{{ $view->id }}">
                                            <i class="fas fa-pencil-alt"></i>
                                          </button>
                                          <button type="button" class="btn btn-outline-secondary btn-sm" data-bs-toggle="modal" data-bs-target="#delteModal{{ $view->id }}">
                                            <i class="fas fa-trash-alt"></i>
                                          </button>
                                        
                                    </td>
                                </tr>
                                <div class="modal fade" id="delteModal{{ $view->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                      <div class="modal-content">
                
                                        <div class="modal-header">
                                          <h5 class="modal-title" id="exampleModalLabel">Delete View Type</h5>
                                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="btn-close"></button>
                                        </div>
                                        <div class="modal-body">
                
                                         Are You Sure You Want To Delete This.
                                        </div>
                                        <div class="modal-footer">
                                          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                          <form action="{{ route('deleteViewType', ['id' => $view->id]) }}" method="POST">
                                              @csrf
                                              @method('DELETE')
                                              <button type="submit" class="btn btn-danger">Yes</button>
                                          </form>
                
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                                <div class="modal fade bs-example-modal-lg" id="editModal{{ $view->id }}" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true" >
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="editModalLabel">Edit View Types</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="btn-close"></button>
                  
                                            </div>
                                            <div class="modal-body">
                                                <form class="forms-sample" action="{{ route('updateViewType') }}" method="POST" enctype="multipart/form-data">
                                                    @csrf
                                                    <input type="hidden" name="view_id" value="{{ $view->id }}">
                                                    <div class="row">
                                                      <div class="col-md-12">
                                                          <div class="mb-3">
                                                              <label for="editBrandCode" class="form-label">View Type</label>
                                                              <input type="text" name="view_type_name" class="form-control" id="editBrandCode" value="{{ $view->view_type_name }}" required>
                                                          </div>
                                                          <div class="valid-feedback">
                                                            Looks good!
                                                        </div>
                                                      </div>
                                                      
                                                  
                                                  <div class="mb-3">
                                                      <label  for="validationCustom03" class="form-label">Description</label>
                                                      <textarea class="form-control" name="description" id="validationCustom03" rows="3" placeholder="ViewType Description" required>{{ $view->description }}</textarea>
                                                      <div class="valid-feedback">
                                                        Looks good!
                                                    </div>
                                                  </div>
                                                </div>
                                                 
                                                    <button type="submit" class="btn btn-primary">Update Changes</button>
                  
                                                    <button type="button" class="btn btn-secondary"data-bs-dismiss="modal">Cancel</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div> <!-- end col -->
       
    </div> <!-- end row -->

@endsection
@section('script')



    <script src="{{ URL::asset('/assets/libs/table-edits/table-edits.min.js') }}"></script>
    <script src="{{ URL::asset('/assets/js/pages/table-editable.init.js') }}"></script>
    <script src="{{ URL::asset('/assets/libs/parsleyjs/parsleyjs.min.js') }}"></script>
    <script src="{{ URL::asset('/assets/js/pages/form-validation.init.js') }}"></script>
    <script src="{{ URL::asset('/assets/libs/dropzone/dropzone.min.js') }}"></script>
    
@endsection
