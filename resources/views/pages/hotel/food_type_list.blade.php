@extends('layouts.master')
@section('title')
   Food Type
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
        @slot('pagetitle') Hotel @endslot
        @slot('title') Food Type @endslot 
    @endcomponent

    <div class="row">
        <div class="col-5">
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
                    <h4 class="card-title mb-3">Add Food Types</h4>
                   
                    <form class="needs-validation " novalidate action="{{ route('addFoodTypes.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label class="form-label" for="validationCustom01">Food Type Name</label>
                                    <input type="text" class="form-control" name="food_type_name" id="validationCustom01" placeholder="Food Type Name"
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
                            
                            
                        
                        
                        <button class="btn btn-primary" type="submit">Add Food Types</button>
                    </form>
                   
                </div>
            </div>
            <!-- end card -->
        </div>
        <div class="col-7">
            <div class="card">
                <div class="card-body">

                    <h4 class="card-title">Food Types</h4>
                   
                    <div class="table-responsive">
                        <table class="table table-editable table-nowrap align-middle table-edits">
                            <thead>
                                <tr>
                                    <th>Sl no</th>
                                    <th>Food Type</th>
                                    <th>Description</th>
                                    <th>Images</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($food_types as $index => $food_type)
                                <tr >
                                    <td  style="width: 80px">{{ $index + 1 }}</td>
                                    <td >{{ $food_type->food_type_name }}</td>
                                   
                                    <td >{{ $food_type->description }}</td>
                                    <td > 
                                     @foreach (json_decode($food_type->images) as $image)
                                        <img src="{{ asset('storage/' .$image) }}" alt="Image" class="img-thumbnail"  style="max-width: 200px; max-height: 150px;">
                                    @endforeach</td>
                                    <td >
                                        
                                        <button type="button" class="btn btn-outline-secondary btn-sm" data-bs-toggle="modal" data-bs-target="#editModal{{ $food_type->id }}">
                                            <i class="fas fa-pencil-alt"></i>
                                          </button>
                                          <button type="button" class="btn btn-outline-secondary btn-sm" data-bs-toggle="modal" data-bs-target="#delteModal{{ $food_type->id }}">
                                            <i class="fas fa-trash-alt"></i>
                                          </button>
                                        
                                    </td>
                                </tr>
                                <div class="modal fade" id="delteModal{{ $food_type->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                      <div class="modal-content">
                
                                        <div class="modal-header">
                                          <h5 class="modal-title" id="exampleModalLabel">Delete Food Type</h5>
                                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="btn-close"></button>
                                        </div>
                                        <div class="modal-body">
                
                                         Are You Sure You Want To Delete This.
                                        </div>
                                        <div class="modal-footer">
                                          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                          <form action="{{ route('deleteFoodType', ['id' => $food_type->id]) }}" method="POST">
                                              @csrf
                                              @method('DELETE')
                                              <button type="submit" class="btn btn-danger">Yes</button>
                                          </form>
                
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                                <div class="modal fade bs-example-modal-lg" id="editModal{{ $food_type->id }}" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true" >
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="editModalLabel">Edit Food Types</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="btn-close"></button>
                  
                                            </div>
                                            <div class="modal-body">
                                                <form class="forms-sample" action="{{ route('updateFoodType') }}" method="POST" enctype="multipart/form-data">
                                                    @csrf
                                                    <input type="hidden" name="type_id" value="{{ $food_type->id }}">
                                                    <div class="row">
                                                      <div class="col-md-12">
                                                          <div class="mb-3">
                                                              <label for="editBrandCode" class="form-label">Food Type</label>
                                                              <input type="text" name="food_type_name" class="form-control" id="editBrandCode" value="{{ $food_type->food_type_name }}" required>
                                                          </div>
                                                          <div class="valid-feedback">
                                                            Looks good!
                                                        </div>
                                                      </div>
                                                      
                                                  </div>
                                                  <div class="mb-3">
                                                      <label  for="validationCustom03" class="form-label">Description</label>
                                                      <textarea class="form-control" name="description" id="validationCustom03" rows="3" placeholder="RoomType Description" required>{{ $food_type->description }}</textarea>
                                                      <div class="valid-feedback">
                                                        Looks good!
                                                    </div>
                                                  </div>
                                                  <label class="form-label" for="editBrandLogo">Current Images</label>
                                                     <div class="mb-3">
                                                      
                                                      @foreach (json_decode($food_type->images) as $image)
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
       
        <div class="col-12">
            
            <div class="card">
                <h4 class="card-title m-3">Food Items</h4>    
                <div class="card-body">
                    <div class="row">
                        <div class="col-3">
                            <div class="card">
                                <div class="card-body">
                                    <ul class="list-group">
                                        @foreach ($food_types as $index => $foodType)
                                            <li class="list-group-item cursor-pointer @if($index === 0) active @endif" data-food-type="{{ $foodType->id }}">{{$index+1}}.
                                                {{ $foodType->food_type_name }}
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>
                <div class="col-9">
                    <div class="card">
                        
                        <div class="card-body">
                            <button type="button" class="btn btn-primary mt-3 float-end" id="addFoodItemButton" style="display: none;" data-bs-toggle="modal" data-bs-target="#addFoodItemModal">
                                Add Food Item
                            </button>
                            <div id="food-items-table">
                            
                            </div>
                            
                        </div>
                    </div>
                </div>
    </div>
                </div>
            </div>
        </div>
       
        
       
    </div> <!-- end row -->
    <div class="modal fade bs-example-modal-lg" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true" >
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
    </div>
    

@endsection
@section('script')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
   
        
   $(document).ready(function () {
    $('.list-group-item').click(function () {
        $('.list-group-item').removeClass('active'); // Remove active class from all items
        $(this).addClass('active'); // Add active class to the clicked item

        const foodTypeId = $(this).data('food-type');
        $('#addfoodTypeId').val(foodTypeId);
        
          
// Show the "Add Food Item" button
      $('#addFoodItemButton').show();
        
        $.ajax({
            url: `/hotel/get_food_items?food_type=${foodTypeId}`,
            method: 'GET',
            success: function (data) {
                const tableHtml = data.map((item, index) => `
                    <tr>
                        <td>${index + 1}</td>
                        <td>${item.name}</td>
                        <td>${item.description}</td>
                        <td>${item.category == 0 ? 'Veg' : 'Non-Veg'}</td>
                        <td>
                                <button type="button" class="btn btn-outline-secondary btn-sm"  data-food-item-id="${item.id}" onclick="editFoodItem(${item.id})">
                                    <i class="fas fa-pencil-alt"></i>
                                </button>
                                <button ctype="button" class="btn btn-outline-secondary btn-sm"  data-food-item-id="${item.id}" onclick="deleteFoodItem(${item.id},${item.food_type_id})">
                                    <i class="fas fa-trash"></i>
                                </button>

                                
                            </td>
                          
                        <!-- Add more columns here -->
                    </tr>
                `).join('');
                $('#food-items-table').html(`
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Sl No</th>
                                <th>Name</th>
                                <th>Description</th>
                                <th>Category</th>
                                <th>Action</th>
                                <!-- Add more headers here -->
                            </tr>
                        </thead>
                        <tbody>
                            ${tableHtml}
                        </tbody>
                    </table>
                `);
            },
            error: function (error) {
                console.error(error);
            }
        });
    });

    // Trigger the click event on the first food type to load its food items initially
    $('.list-group-item.active').trigger('click');

    $('#saveAddBtn').click(function (e) {
            e.preventDefault();

            var form = $('#addFoodItemForm');
            var formData = form.serialize();

            $.ajax({
                url: '{{ route('addFoodItem.store') }}',
                type: 'POST',
                data: formData,
                success: function (response) {
                    // Handle success, e.g., show a success message
                   
                    // Close the modal if needed
                    $('#addFoodItemModal').modal('hide');
                    // Clear the form fields
                    form[0].reset();
                    const foodTypeId = $('#addfoodTypeId').val();
                     refreshFoodItemsTable(foodTypeId);

                },
                error: function (error) {
                    // Handle error, e.g., show validation errors
                    var errors = error.responseJSON.errors;
                    $.each(errors, function (key, value) {
                        alert(value[0]);
                    });
                }
            });
        });
});
function editFoodItem(foodItemId) {
            
    $.ajax({
        url: `/hotel/edit_food_item/${foodItemId}`,
        method: 'GET',
        success: function (data) {
            $('#foodItemId').val(data.id);
            $('#foodTypeId').val(data.food_type_id);
            $('#editName').val(data.name);
            $('#editCategory').val(data.category).change();
            $('#editCategory').val(data.category);

// Manually mark the selected option
            $('#editCategory option').each(function() {
                if ($(this).val() == data.category) {
                    $(this).prop('selected', true);
                } else {
                    $(this).prop('selected', false);
                }
            });
            $('#editDescription').val(data.description);
            $('#editModal').modal('show');
        },
        error: function (error) {
            console.error(error);
        }
    });
        }
        function deleteFoodItem(foodItemId,typeId) {
    // Store the food item id to be deleted in the variable
    deleteFoodItemId = foodItemId;
        $('#delfoodTypeId').val(typeId);


    // Show the delete confirmation modal
    $('#deleteConfirmationModal').modal('show');
}

// Handle confirm delete button click
$('#confirmDeleteBtn').click(function () {
    if (deleteFoodItemId !== null) {
        // Perform the delete request using Ajax
        $.ajax({
            url: `/hotel/deleteFoodItem/${deleteFoodItemId}`,
            method: 'GET',
            
            success: function () {
                // Hide the delete confirmation modal
                $('#deleteConfirmationModal').modal('hide');

                // Refresh the food items table for the current food type
                const foodTypeId = $('#delfoodTypeId').val();
                
                refreshFoodItemsTable(foodTypeId);
                
            },
            error: function (error) {
                console.error(error);
            }
        });

        // Reset the deleteFoodItemId variable
        deleteFoodItemId = null;
    }
});

        $(document).ready(function () {
    

    $('#saveEditBtn').click(function () {
        $.ajax({
            url: '/hotel/update_food_item',
            method: 'POST',
            data: $('#editForm').serialize(),
            success: function (response) {
                $('#editModal').modal('hide');
                const foodTypeId = $('#foodTypeId').val();
                refreshFoodItemsTable(foodTypeId);
                
            },
            error: function (error) {
                console.error(error);
                // Display error message if needed
            }
        });
    });

   
});
function refreshFoodItemsTable(foodTypeId) {
    $.ajax({
        url: `/hotel/get_food_items?food_type=${foodTypeId}`,
        method: 'GET',
        success: function (data) {
            const tableHtml = data.map((item, index) => `
                <tr>
                    <td>${index + 1}</td>
                    <td>${item.name}</td>
                    <td>${item.description}</td>
                    <td>${item.category == 0 ? 'Veg' : 'Non-Veg'}</td>
                    <td>
                        <button type="button" class="btn btn-outline-secondary btn-sm"  data-food-item-id="${item.id}" onclick="editFoodItem(${item.id})">
                            <i class="fas fa-pencil-alt"></i>
                        </button>
                        <button ctype="button" class="btn btn-outline-secondary btn-sm"  data-food-item-id="${item.id}" onclick="deleteFoodItem(${item.id})">
                            <i class="fas fa-trash"></i>
                        </button>
                    </td>
                </tr>
            `).join('');
            
            $('#food-items-table tbody').html(tableHtml); // Update the table body content
        },
        error: function (error) {
            console.error(error);
        }
    });
}
</script>

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
