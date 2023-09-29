@extends('layouts.master')
@section('title')
   Staff Permission Mapping
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
        @slot('title') Permission Mapping @endslot 
    @endcomponent

    <div class="row">
       
      
       
       
        <div class="col-12">
            <div class="card">
                <h4 class="card-title m-3">Permission Category</h4>    
                <div class="card-body">
                    <div class="row">
                        <div class="col-3">
                            <div class="card">
                                <div class="card-body">
                                    <ul class="list-group" id="role-list">
                                        @foreach($roles as $index => $role)
                                            <li class="list-group-item cursor-pointer" data-category-id="{{ $role->id }}">
                                                {{$index+1}}. {{ $role->role_name }}
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
        $('#role-list li:first-child').addClass('active');
      
        // Use event delegation to handle category item clicks
        $('#role-list').on('click', 'li', function() {
            // Remove 'active' class from all categories
            $('#role-list li').removeClass('active');
            // Add 'active' class to the clicked category
            $(this).addClass('active');
            var role_id = $(this).data('category-id');
            fetchPermissions(role_id);
        });

        // Fetch permissions for the selected category
        function fetchPermissions(role_id) {
            if (role_id !== undefined) {
    $.ajax({
        type: 'GET',
        url: '/permission/role-permission/' + role_id,
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