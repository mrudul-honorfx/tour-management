<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Storage;
use App\Models\HRoomType;
use App\Models\HFoodType;
use App\Models\HFoodItems;
use App\Models\HViewType;


use Illuminate\Http\Request;

class HotelController extends Controller
{
    
    public function HotelRoomType()
    {

        $room_types = HRoomType::all(); 
        return view('pages.hotel.room_type_list',compact('room_types'));
    }
    public function addRoomTypes(Request $request)
    {

           
            $validatedData = $request->validate([
                'images.*' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
                'room_type_code' => 'required',
                'room_type_name' => 'required',
                'description' => 'required',
            ]);

             $imageUrls = [];

            if ($request->hasFile('images')) {
                foreach ($request->file('images') as $image) {

                    $imageName = $image->getClientOriginalName();
                    $imagePath = 'uploads/room_types/' . $imageName; // Relative path within the storage disk
        
                    // Store the image in the specified folder within the storage disk
                    Storage::disk('public')->put($imagePath, file_get_contents($image));
                    $imageUrls[] = $imagePath ;
                }
            }

            // Convert image URLs to JSON
            $imageUrlsJson = json_encode($imageUrls);


            $room = HRoomType::create([
                'images' => $imageUrlsJson ,
                'room_type_code' => $request->input('room_type_code'),
                'room_type_name' => $request->input('room_type_name'),
                'description' =>$request->input('description'),
               
            ]);

         return back()->with('success', 'Hotel Room Type Added Successfully');



    }
    public function updateRoomType(Request $request)
    {

            $room_typeTd = $request->input('type_id');

            $validatedData = $request->validate([
                'files.*' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
                'room_type_code' => 'required',
                'room_type_name' => 'required',
                'description' => 'required',
            ]);

            $type = HRoomType::find($room_typeTd);

            if (!$type) {
                return redirect()->back()->with('error', 'Brand not found.');
            }

            $type->room_type_code = $request->input('room_type_code');
            $type->room_type_name = $request->input('room_type_name');
            $type->description = $request->input('description');


            $imageUrls = [];

            if ($request->hasFile('files')) {
                foreach ($request->file('files') as $image) {

                    $imageName = $image->getClientOriginalName();
                    $imagePath = 'uploads/room_types/' . $imageName; // Relative path within the storage disk
        
                    // Store the image in the specified folder within the storage disk
                    Storage::disk('public')->put($imagePath, file_get_contents($image));
                    $imageUrls[] = $imagePath ;
                }
                $imageUrlsJson = json_encode($imageUrls);
                $type->images = $imageUrlsJson;
            }

            // Convert image URLs to JSON
            
            $type->save();

         return back()->with('success', 'Room Type Updated Successfully');

        /* return back()->with('error',  'Something went wrong'); */

    }
    public function deleteRoomType($id)
    {

        $type = HRoomType::find($id);
        if (!$type) {
            return redirect()->back()->with('error', 'Room Type not found.');
        }
        $type->delete();
        return redirect()->back()->with('success', 'Room Type deleted successfully.');


    }
    public function HotelFoodType()
    {

        $food_types = HFoodType::all(); 
        return view('pages.hotel.food_type_list',compact('food_types'));
    }
    public function addFoodTypes(Request $request)
    {

           
            $validatedData = $request->validate([
                'images.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
                'food_type_name' => 'required',
                'description' => 'required',
            ]);

             $imageUrls = [];

            if ($request->hasFile('images')) {
                foreach ($request->file('images') as $image) {

                    $imageName = $image->getClientOriginalName();
                    $imagePath = 'uploads/food_types/' . $imageName; // Relative path within the storage disk
        
                    // Store the image in the specified folder within the storage disk
                    Storage::disk('public')->put($imagePath, file_get_contents($image));
                    $imageUrls[] = $imagePath ;
                }
            }

            // Convert image URLs to JSON
            $imageUrlsJson = json_encode($imageUrls);


            $room = HFoodType::create([
                'images' => $imageUrlsJson ,
                'food_type_name' => $request->input('food_type_name'),
                'description' =>$request->input('description'),
               
            ]);

         return back()->with('success', 'Hotel Food Type Added Successfully');

    }
    public function updateFoodType(Request $request)
    {

            $food_typeTd = $request->input('type_id');

            $validatedData = $request->validate([
                'files.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
                'food_type_name' => 'required',
                'description' => 'required',
            ]);

            $type = HFoodType::find($food_typeTd);

            if (!$type) {
                return redirect()->back()->with('error', 'Brand not found.');
            }

           
            $type->food_type_name = $request->input('food_type_name');
            $type->description = $request->input('description');


            $imageUrls = [];

            if ($request->hasFile('files')) {
                foreach ($request->file('files') as $image) {

                    $imageName = $image->getClientOriginalName();
                    $imagePath = 'uploads/food_types/' . $imageName; // Relative path within the storage disk
        
                    // Store the image in the specified folder within the storage disk
                    Storage::disk('public')->put($imagePath, file_get_contents($image));
                    $imageUrls[] = $imagePath ;
                }
                $imageUrlsJson = json_encode($imageUrls);
                $type->images = $imageUrlsJson;
            }

           
            $type->save();

         return back()->with('success', 'Room Type Updated Successfully');
    }
    public function deleteFoodType($id)
    {

        $type = HFoodType::find($id);
        if (!$type) {
            return redirect()->back()->with('error', 'Food Type not found.');
        }
        $type->delete();
        return redirect()->back()->with('success', 'Food Type deleted successfully.');


    }
    public function GetFoodItems(Request $request) 
    {

       
        $foodType = $request->input('food_type');
       
        $foodItems = HFoodItems::where('food_type_id', $foodType)->get();
        return response()->json($foodItems);
       
    }
    public function editFoodItem($id) {
        $foodItem = HFoodItems::find($id); // Replace with your model and logic
        return response()->json($foodItem);
    }
    public function updateFoodItem(Request $request) {


        $foodItem = HFoodItems::find($request->input('food_item_id'));
        
        $foodItem->name = $request->input('name');
        $foodItem->category = $request->input('category');
        $foodItem->description = $request->input('description');
        $foodItem->save();
    
        return redirect()->back()->with('success', 'Food item updated successfully.');
    }
    public function addFoodItem(Request $request) {


        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'category' => 'required|in:0,1', // Assuming you're using 0 for Veg and 1 for Non-Veg
            'description' => 'required',
            // Add validation rules for other fields if needed
        ]);

        // Create a new FoodItem instance and save it to the database
        $item = HFoodItems::create([
            
            'name' => $request->input('name'),
            'food_type_id'=> $request->input('food_type_id'),
            'category' => $request->input('category'),
            'description' =>$request->input('description'),
           
        ]);
       
      
    
        return response()->json(['message' => 'Food item added successfully']);
    }
    public function deleteFoodItem($id)
    {
       
        try {

            // Find the food item
            $foodItem = HFoodItems::findOrFail($id);
            
            // Delete the food item
            $foodItem->delete();
            
            return response()->json(['message' => 'Food item deleted successfully']);
        } catch (\Exception $e) {
            return response()->json(['error' => 'An error occurred while deleting the food item'], 500);
        }
    }
    public function HotelViewType()
    {

        $view_types = HViewType::all(); 
        return view('pages.hotel.hotel_view_type_listing',compact('view_types'));
    }
    public function addViewTypes(Request $request)
    {

           
            $validatedData = $request->validate([
                
                'view_type_name' => 'required',
                'description' => 'required',
            ]);


            $view = HViewType::create([
             
                'view_type_name' => $request->input('view_type_name'),
                'description' =>$request->input('description'),
               
            ]);

         return back()->with('success', 'Hotel Room Type Added Successfully');



    }
    public function updateViewType(Request $request)
    {

            $view_typeTd = $request->input('view_id');

            $validatedData = $request->validate([
                'view_type_name' => 'required',
                'description' => 'required',
            ]);

            $view = HViewType::find($view_typeTd);

            if (!$view) {
                return redirect()->back()->with('error', 'View not found.');
            }

            
            $view->view_type_name = $request->input('view_type_name');
            $view->description = $request->input('description');



            // Convert image URLs to JSON
            
            $view->save();

         return back()->with('success', 'View Type Updated Successfully');

        /* return back()->with('error',  'Something went wrong'); */

    }
    public function deleteViewType($id)
    {

        $view = HViewType::find($id);
        if (!$view) {
            return redirect()->back()->with('error', 'View Type not found.');
        }
        $view->delete();
        return redirect()->back()->with('success', 'View Type deleted successfully.');


    }
    public function HotelList()
    {

       
        return view('pages.hotel.hotel_listing');
    }


}
