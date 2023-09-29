@extends('layouts.master')
@section('title')
   Staff List
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
        @slot('pagetitle') Staff @endslot
        @slot('title')Staff List @endslot 
    @endcomponent

    <div class="row">
        <div class="col-12">
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
                    <h4 class="card-title mb-3">Add Staff</h4>
                   
                    <form class="needs-validation "  action="{{ route('addStaff.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label" for="validationCustom01">Staff Name</label>
                                    <input type="text" class="form-control" name="name" id="validationCustom01" placeholder="Staff Name"
                                         required>
                                         @error('name')
                                         <span class="invalid-feedback" role="alert">
                                             <strong>{{ $message }}</strong>
                                         </span>
                                     @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label" for="validationCustom02">Staff Email</label>
                                    <input type="email" class="form-control" name="email" id="validationCustom02" placeholder="Staff Email"
                                        required>
                                        @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label" for="userpassword">Password</label>
                                    <input type="password" class="form-control @error('password') is-invalid @enderror"
                                        name="password" id="userpassword" placeholder="Enter password">
                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label" for="password_confirmation">Confirm Password</label>
                                    <input type="password"
                                        class="form-control @error('password_confirmation') is-invalid @enderror"
                                        name="password_confirmation" id="password_confirmation"
                                        placeholder="Enter confirm password">
                                    @error('password_confirmation')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label" for="metatitle">Staff Role</label>
                                <select name="role_id" id="role_id" class="form-select">
                                    <option>Select</option>
                                    @foreach ($roles as $index => $role)
                                        <option value={{ $role->id }}>{{ $role->role_name }}</option>
                                    @endforeach
                                </select>
                            </div>

                        </div>
                           
                        <div class="col-md-6">
                                <div class="mb-3">
                                   
                                    <label class="form-label" for="images">Profile Image</label>
                                    <input type="file" class="form-control" name="file" id="images"  accept=".jpeg, .jpg, .png, .gif">
                                </div>
                                <div id="image-previews"></div>
                                @error('file')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
    @enderror
                            </div>
                            
                        </div>
                        
                        
                        <button class="btn btn-primary" type="submit">Add Staff</button>
                    </form>
                   
                </div>
            </div>
            <!-- end card -->
        </div>
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    @if(session('custom_errors'))
                    <div class="alert alert-danger">
                        <ul>
                            @foreach(session('custom_errors')->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                    <h4 class="card-title">Staff List</h4>
                   
                    <div class="table-responsive">
                        <table class="table table-editable table-nowrap align-middle table-edits">
                            <thead>
                                <tr>
                                    <th>Sl no</th>
                                    <th>Staff Name</th>
                                    <th>Email</th>
                                    <th>Role</th>
                                    <th>Profile Image</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($staff_lists as $index => $staff_list)
                                <tr data-id="{{ $index + 1 }}">
                                    <td  style="width: 80px">{{ $index + 1 }}</td>
                                    <td >{{ $staff_list->name }}</td>
                                    <td >{{ $staff_list->email }}</td>
                                    <td >{{ $staff_list->role_name }}</td>
                                    <td > 
                                    @if($staff_list->profile_pic)
                                        <img src="{{ asset('storage/' .$staff_list->profile_pic) }}" alt="Image" class="img-thumbnail"  style="max-width: 200px; max-height: 150px;">
                                   @endif
                                    <td >
                                        
                                        <button type="button" class="btn btn-outline-secondary btn-sm" data-bs-toggle="modal" data-bs-target="#editModal{{ $staff_list->id }}">
                                            <i class="fas fa-pencil-alt"></i>
                                          </button>
                                          <button type="button" class="btn btn-outline-secondary btn-sm" data-bs-toggle="modal" data-bs-target="#delteModal{{ $staff_list->id }}">
                                            <i class="fas fa-trash-alt"></i>
                                          </button>
                                        
                                    </td>
                                </tr>
                                <div class="modal fade" id="delteModal{{ $staff_list->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                      <div class="modal-content">
                
                                        <div class="modal-header">
                                          <h5 class="modal-title" id="exampleModalLabel">Delete Staff User</h5>
                                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="btn-close"></button>
                                        </div>
                                        <div class="modal-body">
                
                                         Are You Sure You Want To Delete This.
                                        </div>
                                        <div class="modal-footer">
                                          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                          <form action="{{ route('deleteStaffUser', ['id' => $staff_list->id]) }}" method="POST">
                                              @csrf
                                              @method('DELETE')
                                              <button type="submit" class="btn btn-danger">Yes</button>
                                          </form>
                
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                                <div class="modal fade bs-example-modal-lg" id="editModal{{ $staff_list->id }}" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true" >
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="editModalLabel">Edit Staff User</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="btn-close"></button>
                  
                                            </div>
                                            <div class="modal-body">
                                                <form class="forms-sample" action="{{ route('updateStaffUser') }}" method="POST" enctype="multipart/form-data">
                                                    @csrf
                                                    <input type="hidden" name="staff_id" value="{{ $staff_list->id }}">
                                                    <div class="row">
                                                      <div class="col-md-6">
                                                          <div class="mb-3">
                                                              <label for="editBrandCode" class="form-label">Staff Name</label>
                                                              <input type="text" name="name" class="form-control" id="editBrandCode" value="{{ $staff_list->name }}" required>
                                                          </div>
                                                          <div class="valid-feedback">
                                                            Looks good!
                                                        </div>
                                                      </div>
                                                      <div class="col-md-6">
                                                          <div class="mb-3">
                                                              <label for="editBrandName" class="form-label">Staff Email</label>
                                                              <input type="text" name="email" class="form-control" disabled id="editBrandName" value="{{ $staff_list->email }}" required>
                                                          </div>
                                                          <div class="valid-feedback">
                                                            Looks good!
                                                        </div>
                                                      </div>
                                                  
                                                  <div class="col-md-6">
                                                    <div class="mb-3">
                                                        <label class="form-label" for="userpassword">Password</label>
                                                        <input type="password" class="form-control @error('password') is-invalid @enderror"
                                                            name="password" id="userpassword" placeholder="Enter password" value="">
                                                        @error('password')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="mb-3">
                                                        <label class="form-label" for="password_confirmation">Confirm Password</label>
                                                        <input type="password"
                                                            class="form-control @error('password_confirmation') is-invalid @enderror"
                                                            name="password_confirmation" id="password_confirmation"
                                                            placeholder="Enter confirm password">
                                                        @error('password_confirmation')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                  
                                               <div class="col-md-6">
                                                        <div class="mb-3">
                                                            <label class="form-label" for="role_id">Staff Role</label>
                                                            <select name="role_id" id="role_id" class="form-select">
                                                                <option value="">Select</option>
                                                                @foreach ($roles as $role)
                                                                    <option value="{{ $role->id }}" {{ $role->id == $staff_list->role_id ? 'selected' : '' }}>
                                                                        {{ $role->role_name }}
                                                                    </option>
                                                                @endforeach
                                                            </select>
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
