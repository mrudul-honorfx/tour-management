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
                                <h4 class="card-title m-3">Permission Category</h4>
                                <div class="card-body">
                                    <form id="permissions-form" method="POST" action="/permission/updateRolePermission">
                                        @csrf <!-- CSRF token -->
                
                                        <!-- Hidden input fields for selected permissions -->
                                        <input type="hidden" name="role_id" id="role_id">
                                        <input type="hidden" name="selected_permissions[]" id="selected_permissions">
                
                                        <!-- Permission items -->
                                        <div class="row" id="p_items">
                                            <!-- Permissions will be dynamically added here in three columns -->
                                        </div>
                
                                        <!-- Submit button -->
                                        <button type="button" class="btn btn-primary mt-3 float-end" id="submitBtn">
                                            Update Permissions
                                        </button>
                                    </form>
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
        var firstRoleId = $('#role-list li:first-child').data('category-id');
           fetchPermissions(firstRoleId);
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
                var permissionsByCategory = data;
                if (permissionsByCategory.length > 0) {
                    permissionsByCategory.forEach(function(category) {
                        // Create a heading for the category
                        var categoryHeading = $('<h5>' + category.category_name + '</h5>');
                        $('#p_items').append(categoryHeading);

                        if (category.permissions.length > 0) {
                        // Create a row to hold the permission items for this category
                        var row = $('<div class="row"></div>');
                        category.permissions.forEach(function(permission) {
                        // Create a column (col-4) for each permission item
                        var col = $('<div class="col-4"></div>');
                        // Create a div to hold the checkbox, text, and hidden input
                        var permissionItem = $('<div class="form-check"></div>');
                        // Create a hidden input to store permission ID
                        var hiddenInput = $('<input type="hidden" name="permission_ids[]" value="' + permission.id + '">');
                        // Create a checkbox with appropriate checked state
                        var checkbox = $('<input class="form-check-input" type="checkbox">');

                        // Set checkbox checked state based on permission selected value
                        checkbox.prop('checked', permission.selected == 1);
                        // Add the checkbox, hidden input, and permission text to the permissionItem div
                        permissionItem.append(hiddenInput);
                        permissionItem.append(checkbox);
                        permissionItem.append('<label class="form-check-label mb-0">' + permission.permission + '</label>');
                        col.append(permissionItem);
                        row.append(col);
                    });



    // Append the row of permissions to the container
    $('#p_items').append(row);
} else {
    // Handle the case where there are no permissions for the selected category
    $('#p_items').append('<p>No permissions available for this category.</p>');
}
                    });
                    // Show the "Add Permission" button
                } else {
                    // Handle the case where there are no categories
                    $('#p_items').html('<p>No categories available.</p>');
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
      
        $('#submitBtn').click(function() {
    var roleId = $('.list-group-item.active').data('category-id');
    $('#role_id').val(roleId);

    // Prepare selected permissions array and update the hidden input value
    var selectedPermissionIds = [];
    // Logic to populate selectedPermissionIds array based on checkbox selection
    $('#p_items input[type="checkbox"]:checked').each(function() {
        var permissionId = $(this).siblings('input[type="hidden"]').val(); // Get permission ID from hidden input
        selectedPermissionIds.push(permissionId);
    });

    // Set the selected permission IDs as a comma-separated string to the hidden input field
    $('#selected_permissions').val(selectedPermissionIds.join(','));

    // Submit the form
    $('#permissions-form').submit();
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