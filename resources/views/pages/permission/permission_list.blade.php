@extends('layouts.master')
@section('title')
   Staff Permission
@endsection
<style>
    /* Style for the image preview */
    #image-preview img {
        max-width: 200px;
        max-height: 200px;
        margin: 10px;
    }
    .list-group-item.active {
        background-color: #007bff;
        color: #fff;
    }
</style>

@section('content')
    @component('common-components.breadcrumb')
        @slot('pagetitle') Staff @endslot
        @slot('title') Permission @endslot 
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
                    <h4 class="card-title mb-3">Add Permission Category</h4>
                   
                    <form class="needs-validation " novalidate action="{{ route('pCategory.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label class="form-label" for="validationCustom01">Permission Category Name</label>
                                    <input type="text" class="form-control" name="p_cat_name" id="validationCustom01" placeholder="Permission Category Name"
                                         required>
                                    <div class="valid-feedback">
                                        Looks good!
                                    </div>
                                </div>
                            </div>
                           
                        </div>
                        
                           
                            </div>
                           
                            <div class="col-md-3">
                                <div class="m-3">
                        <button class="btn btn-primary" type="submit">Add Category</button>
                                </div>
                            </div>
                    </form>
                   
                </div>
            </div>
            <!-- end card -->
        
        <div class="col-6">
            <div class="card">
                <div class="card-body">

                    <h4 class="card-title">Permission Category</h4>
                   
                    <div class="table-responsive">
                        <table class="table table-editable table-nowrap align-middle table-edits">
                            <thead>
                                <tr>
                                    <th>Sl no</th>
                                    <th>Category Name</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($category as $index => $cat)
                                <tr >
                                    <td  style="width: 80px">{{ $index + 1 }}</td>
                                    <td >{{ $cat->category_name }}</td>
                                   
                                    
                                    <td >
                                        
                                        <button type="button" class="btn btn-outline-secondary btn-sm" data-bs-toggle="modal" data-bs-target="#editModal{{ $cat->id }}">
                                            <i class="fas fa-pencil-alt"></i>
                                          </button>
                                          <button type="button" class="btn btn-outline-secondary btn-sm" data-bs-toggle="modal" data-bs-target="#delteModal{{ $cat->id }}">
                                            <i class="fas fa-trash-alt"></i>
                                          </button>
                                        
                                    </td>
                                </tr>
                                <div class="modal fade" id="delteModal{{ $cat->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                      <div class="modal-content">
                
                                        <div class="modal-header">
                                          <h5 class="modal-title" id="exampleModalLabel">Delete Category</h5>
                                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="btn-close"></button>
                                        </div>
                                        <div class="modal-body">
                
                                         Are You Sure You Want To Delete This.
                                        </div>
                                        <div class="modal-footer">
                                          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                          <form action="{{ route('deletePcategory', ['id' => $cat->id]) }}" method="POST">
                                              @csrf
                                              @method('DELETE')
                                              <button type="submit" class="btn btn-danger">Yes</button>
                                          </form>
                
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                                <div class="modal fade bs-example-modal-lg" id="editModal{{ $cat->id }}" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true" >
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="editModalLabel">Edit Category</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="btn-close"></button>
                  
                                            </div>
                                            <div class="modal-body">
                                                <form class="forms-sample" action="{{ route('updatePcategory') }}" method="POST" enctype="multipart/form-data">
                                                    @csrf
                                                    <input type="hidden" name="cat_id" value="{{ $cat->id }}">
                                                    <div class="row">
                                                      <div class="col-md-12">
                                                          <div class="mb-3">
                                                              <label for="editBrandCode" class="form-label">Category Name</label>
                                                              <input type="text" name="p_cat_name" class="form-control" id="editBrandCode" value="{{ $cat->category_name }}" required>
                                                          </div>
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
       
       
        <div class="col-12">
            <div class="card">
                <h4 class="card-title m-3">Permission Category</h4>    
                <div class="card-body">
                    <div class="row">
                        <div class="col-3">
                            <div class="card">
                                <div class="card-body">
                                    <ul class="list-group" id="category-list">
                                        @foreach($category as $index => $cat)
                                            <li class="list-group-item cursor-pointer" data-category-id="{{ $cat->id }}">
                                                {{$index+1}}. {{ $cat->category_name }}
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-9">
                            <div class="card">
                                <div class="card-body">
                                    <button type="button" class="btn btn-primary mt-3 float-end" id="addPermission1" onclick="openModal()">
                                        Add Permission
                                    </button>
                                    <div class="row" id="p_items">
                                        <!-- Permissions will be dynamically added here in three columns -->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
       
        
      
        
       
        
       
    </div> 
    <div class="modal fade" id="addPermission" tabindex="-1" aria-labelledby="addPermission" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addPermission">Add Permission</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="btn-close"></button>
                </div>
                <div class="modal-body">
                  
                        <form id="addFoodItemForm"  class="needs-validation " novalidate >
                            @csrf
                      
                           
                        <div class="mb-3">
                            <label class="form-label" for="addName">Permission Name</label>
                            <input type="text" class="form-control" name="permission" id="addName" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="role_id">Permission Category</label>
                            <select name="cat_id" id="role_id" class="form-select">
                                <option value="">Select</option>
                                @foreach($category as $index => $cat)
                                    <option value="{{ $cat->id }}" >
                                        {{ $cat->category_name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        
                        <!-- Add more input fields as needed -->
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary" id="saveAddBtn">Add Permission</button>
                </div>
            </div>
        </div>
    </div><!-- end row -->
   {{--  <div class="modal fade bs-example-modal-lg" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true" >
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel">Edit Food Item</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="btn-close"></button>
                </div>
                <div class="modal-body">
                    <form id="editForm">
                        @csrf
                        <input type="hidden" name="food_item_id" id="foodItemId">
                        <input type="hidden" name="food_type_id" id="foodTypeId">
                        <div class="mb-3">
                            <label class="form-label" for="editName">Name</label>
                            <input type="text" class="form-control" name="name" id="editName" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="editCategory">Category</label>
                            <select class="form-select" name="category" id="editCategory" required>
                                <option value="" disabled>Select Category</option>
                                <option value="0">Veg</option>
                                <option value="1">Non-Veg</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="editDescription">Description</label>
                            <textarea class="form-control" name="description" id="editDescription" rows="3" required></textarea>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-primary" id="saveEditBtn">Save Changes</button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="deleteConfirmationModal" tabindex="-1" aria-labelledby="deleteConfirmationModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteConfirmationModalLabel">Confirm Delete</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="btn-close"></button>
                </div>
                <input type="hidden" name="food_type_id" id="delfoodTypeId">
                <div class="modal-body">
                    Are you sure you want to delete this food item?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-danger" id="confirmDeleteBtn">Delete</button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="addFoodItemModal" tabindex="-1" aria-labelledby="addFoodItemModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addFoodItemModalLabel">Add Food Item</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="btn-close"></button>
                </div>
                <div class="modal-body">
                  
                        <form id="addFoodItemForm"  class="needs-validation " novalidate >
                            @csrf
                      
                            <input type="hidden" name="food_type_id" id="addfoodTypeId">
                        <div class="mb-3">
                            <label class="form-label" for="addName">Item Name</label>
                            <input type="text" class="form-control" name="name" id="addName" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="addCategory">Category</label>
                            <select class="form-select" name="category" id="addCategory" required>
                                <option value="" >Select Category</option>
                                <option value="0">Veg</option>
                                <option value="1">Non-Veg</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="addDescription">Description</label>
                            <textarea class="form-control" name="description" id="addDescription" rows="3" required></textarea>
                        </div>
                        <!-- Add more input fields as needed -->
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary" id="saveAddBtn">Add Food Item</button>
                </div>
            </div>
        </div>
    </div> --}}
   

@endsection


@section('script')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    function openModal() {
        $('#addPermission').modal('show');
    }
    $(document).ready(function() {
        // Initially select the first category and make it active
        $('#category-list li:first-child').addClass('active');
      
        // Use event delegation to handle category item clicks
        $('#category-list').on('click', 'li', function() {
            // Remove 'active' class from all categories
            $('#category-list li').removeClass('active');
            // Add 'active' class to the clicked category
            $(this).addClass('active');
            var categoryId = $(this).data('category-id');
            fetchPermissions(categoryId);
        });

        // Fetch permissions for the selected category
        function fetchPermissions(categoryId) {
            if (categoryId !== undefined) {
    $.ajax({
        type: 'GET',
        url: '/permission/permissions/' + categoryId,
        success: function(data) {
            $('#p_items').empty();
            var permissions = data;
            if (permissions.length > 0) {
                // Create a row to hold the permission items
                var row = $('<div class="row"></div>');
                permissions.forEach(function(permission) {
                    // Create a column (col-4) for each permission item
                    var col = $('<div class="col-4"></div>');
                    // Create a div to hold the checkbox and text
                    var permissionItem = $('<div class="d-flex align-items-center"></div>');
                    // Create a disabled and checked checkbox
                    var checkbox = $('<input type="checkbox" disabled checked>');
                    // Add the checkbox and permission text to the permissionItem div
                    permissionItem.append(checkbox);
                    permissionItem.append('<p class="mb-0 m-2">' + permission.permission + '</p>');
                    col.append(permissionItem);
                    row.append(col);
                });
                $('#p_items').append(row);
                // Show the "Add Permission" button
            } else {
                // Handle the case where there are no permissions for the selected category
                $('#p_items').html('<p>No permissions available for this category.</p>');
                $('#addPermission').modal('hide'); // Hide the "Add Permission" button
            }
        },
        error: function() {
            console.log('Error fetching permissions');
        }
    });
}



        }
        $('#category-list li:first-child').trigger('click');

        // Attach a click event listener to the "Add Permission" button
        $('#saveAddBtn').click(function(e) {
            e.preventDefault();
            var formData = $('#addFoodItemForm').serialize();
            $.ajax({
                type: 'POST',
                url: '{{ route("permissions.store") }}',
                data: formData,
                success: function(response) {
                    // Fetch permissions again for the currently selected category
                    var categoryId = $('.list-group-item.active').data('category-id');
                    $('#addPermission').modal('hide');
                    fetchPermissions(categoryId);

                    // Optionally, display a success message
                },
                error: function(error) {
                    console.log(error);
                }
            });
        });
    });
</script>

<!-- Include your other script tags here -->



<script src="{{ URL::asset('/assets/libs/table-edits/table-edits.min.js') }}"></script>
<script src="{{ URL::asset('/assets/js/pages/table-editable.init.js') }}"></script>
<script src="{{ URL::asset('/assets/libs/parsleyjs/parsleyjs.min.js') }}"></script>
<script src="{{ URL::asset('/assets/js/pages/form-validation.init.js') }}"></script>
<script src="{{ URL::asset('/assets/libs/dropzone/dropzone.min.js') }}"></script>
@endsection