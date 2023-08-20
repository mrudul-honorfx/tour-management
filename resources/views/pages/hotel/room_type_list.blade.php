@extends('layouts.master')
@section('title')
   Room Type
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
        @slot('title')Room Type  @endslot 
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
                    <h4 class="card-title mb-3">Add Room Types</h4>
                   
                    <form class="needs-validation " novalidate action="{{ route('addRoomTypes.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
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
                                   
                                    <label class="form-label" for="images">Images</label>
                                    <input type="file" class="form-control" name="images[]" id="images" multiple accept=".jpeg, .jpg, .png, .gif">
                                </div>
                                <div id="image-previews"></div>
                            </div>
                            
                            
                        
                        
                        <button class="btn btn-primary" type="submit">Add Room Types</button>
                    </form>
                   
                </div>
            </div>
            <!-- end card -->
        </div>
        <div class="col-10">
            <div class="card">
                <div class="card-body">

                    <h4 class="card-title">Room Types</h4>
                   
                    <div class="table-responsive">
                        <table class="table table-editable table-nowrap align-middle table-edits">
                            <thead>
                                <tr>
                                    <th>Sl no</th>
                                    <th>Room Type</th>
                                    <th>Room Type Code</th>
                                    <th>Description</th>
                                    <th>Images</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($room_types as $index => $room_type)
                                <tr data-id="{{ $index + 1 }}">
                                    <td  style="width: 80px">{{ $index + 1 }}</td>
                                    <td >{{ $room_type->room_type_name }}</td>
                                    <td >{{ $room_type->room_type_code }}</td>
                                    <td >{{ $room_type->description }}</td>
                                    <td > 
                                     @foreach (json_decode($room_type->images) as $image)
                                        <img src="{{ asset('storage/' .$image) }}" alt="Image" class="img-thumbnail"  style="max-width: 200px; max-height: 150px;">
                                    @endforeach</td>
                                    <td >
                                        
                                        <button type="button" class="btn btn-outline-secondary btn-sm" data-bs-toggle="modal" data-bs-target="#editModal{{ $room_type->id }}">
                                            <i class="fas fa-pencil-alt"></i>
                                          </button>
                                          <button type="button" class="btn btn-outline-secondary btn-sm" data-bs-toggle="modal" data-bs-target="#delteModal{{ $room_type->id }}">
                                            <i class="fas fa-trash-alt"></i>
                                          </button>
                                        
                                    </td>
                                </tr>
                                <div class="modal fade" id="delteModal{{ $room_type->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                      <div class="modal-content">
                
                                        <div class="modal-header">
                                          <h5 class="modal-title" id="exampleModalLabel">Delete Room Type</h5>
                                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="btn-close"></button>
                                        </div>
                                        <div class="modal-body">
                
                                         Are You Sure You Want To Delete This.
                                        </div>
                                        <div class="modal-footer">
                                          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                          <form action="{{ route('deleteRoomType', ['id' => $room_type->id]) }}" method="POST">
                                              @csrf
                                              @method('DELETE')
                                              <button type="submit" class="btn btn-danger">Yes</button>
                                          </form>
                
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                                <div class="modal fade bs-example-modal-lg" id="editModal{{ $room_type->id }}" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true" >
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="editModalLabel">Edit Room Types</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="btn-close"></button>
                  
                                            </div>
                                            <div class="modal-body">
                                                <form class="forms-sample" action="{{ route('updateRoomType') }}" method="POST" enctype="multipart/form-data">
                                                    @csrf
                                                    <input type="hidden" name="type_id" value="{{ $room_type->id }}">
                                                    <div class="row">
                                                      <div class="col-md-6">
                                                          <div class="mb-3">
                                                              <label for="editBrandCode" class="form-label">Room Type</label>
                                                              <input type="text" name="room_type_name" class="form-control" id="editBrandCode" value="{{ $room_type->room_type_name }}" required>
                                                          </div>
                                                          <div class="valid-feedback">
                                                            Looks good!
                                                        </div>
                                                      </div>
                                                      <div class="col-md-6">
                                                          <div class="mb-3">
                                                              <label for="editBrandName" class="form-label">Room Type Code</label>
                                                              <input type="text" name="room_type_code" class="form-control" id="editBrandName" value="{{ $room_type->room_type_code }}" required>
                                                          </div>
                                                          <div class="valid-feedback">
                                                            Looks good!
                                                        </div>
                                                      </div>
                                                  </div>
                                                  <div class="mb-3">
                                                      <label  for="validationCustom03" class="form-label">Description</label>
                                                      <textarea class="form-control" name="description" id="validationCustom03" rows="3" placeholder="RoomType Description" required>{{ $room_type->description }}</textarea>
                                                      <div class="valid-feedback">
                                                        Looks good!
                                                    </div>
                                                  </div>
                                                  <label class="form-label" for="editBrandLogo">Current Images</label>
                                                     <div class="mb-3">
                                                      
                                                      @foreach (json_decode($room_type->images) as $image)
                                                      <img src="{{ asset('storage/' .$image) }}" alt="Image" class="img-thumbnail"  style="max-width: 200px; max-height: 150px;">
                                                      @endforeach
                                                  </div> 
                  
                                                   <div class="mb-3">
                                                      <label class="form-label" for="editNewBrandLogo">Upload New Images</label>
                                                      <div class="mb-3">
                                                        <input type="file" class="form-control" name="files[]" id="files" multiple accept=".jpeg, .jpg, .png, .gif">
                                                    </div>
                                                    <div id="image-preview"></div>
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
<script>
    document.getElementById('images').addEventListener('change', function (event) {
        var imagePreviews = document.getElementById('image-previews');
        imagePreviews.innerHTML = ''; // Clear existing previews

        for (var i = 0; i < event.target.files.length; i++) {
            var img = document.createElement('img');
            img.src = URL.createObjectURL(event.target.files[i]);
            img.className = 'img-thumbnail mr-2 mb-2';
            img.style.maxWidth = '200px';
            img.style.maxHeight = '200px';
            imagePreviews.appendChild(img);
        }
    });
</script>
<script>
    document.getElementById('files').addEventListener('change', function (event) {
        var imagePreviews = document.getElementById('image-preview');
        imagePreviews.innerHTML = ''; // Clear existing previews

        for (var i = 0; i < event.target.files.length; i++) {
            var img = document.createElement('img');
            img.src = URL.createObjectURL(event.target.files[i]);
            img.className = 'img-thumbnail mr-2 mb-2';
            img.style.maxWidth = '200px';
            img.style.maxHeight = '200px';
            imagePreviews.appendChild(img);
        }
    });
</script>


    <script src="{{ URL::asset('/assets/libs/table-edits/table-edits.min.js') }}"></script>
    <script src="{{ URL::asset('/assets/js/pages/table-editable.init.js') }}"></script>
    <script src="{{ URL::asset('/assets/libs/parsleyjs/parsleyjs.min.js') }}"></script>
    <script src="{{ URL::asset('/assets/js/pages/form-validation.init.js') }}"></script>
    <script src="{{ URL::asset('/assets/libs/dropzone/dropzone.min.js') }}"></script>
    
@endsection
