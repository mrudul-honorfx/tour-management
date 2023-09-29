<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Role;
use App\Models\PermissionCategory;
use App\Models\Permission;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class StaffController extends Controller
{
    public function StaffList()
    {

        $staff_lists = User::leftJoin('roles as r', 'r.id', '=', 'users.role_id')
                            ->select('users.*', 'r.role_name','r.id as role_id')
                            ->get();
        $roles = Role::all(); 

        return view('pages.staff.staff_list',compact('staff_lists','roles'));
    }
    public function addStaff(Request $request)
    {

           
        $validator = Validator::make($request->all(), [
            'file' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:6', 'confirmed'],
            'role_id' => ['required'],
        ]);
        
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

             $imageUrl = '';

            if ($request->hasFile('file')) {
                
                   $image = $request->file('file');
                    $imageName = $image->getClientOriginalName();
                    $imagePath = 'uploads/profile_pic/' . $imageName; // Relative path within the storage disk
        
                    // Store the image in the specified folder within the storage disk
                    Storage::disk('public')->put($imagePath, file_get_contents($image));
                    $imageUrl = $imagePath ;
                
            }

            // Convert image URLs to JSON
           


            $user = User::create([
                'profile_pic' => $imageUrl ,
                'name' => $request->input('name'),
                'email' => $request->input('email'),
                'password' =>Hash::make($request->input('password')),
                'role_id'=>$request->input('role_id'),
               
            ]);

         return back()->with('success', 'Staff Added Successfully');

    }
    public function updateStaffUser(Request $request)
    {
            $staff_id = $request->input('staff_id');

            $rules =  [
                
                'name' => ['required', 'string', 'max:255'],
               
                'role_id' => 'required',
                
            ];
            if ($request->filled('password')) {
                $rules['password'] = ['required', 'string', 'min:6', 'confirmed'];
            }
            
            $validator = Validator::make($request->all(), $rules);
            
            if ($validator->fails()) {
                return redirect()->back()->with('custom_errors', $validator->errors());
            }
            
            

            $staff = User::find($staff_id);

            if (!$staff) {
                return redirect()->back()->with('error', 'Userle not found.');
            }

            
            $staff->name = $request->input('name');
            $staff->role_id = $request->input('role_id');
            if ($request->filled('password')) {
                $staff->password = Hash::make($request->input('password'));
            }


            // Convert image URLs to JSON
            
            $staff->save();

         return back()->with('success', 'User Updated Successfully');

        /* return back()->with('error',  'Something went wrong'); */

    }
    public function deleteStaffUser($id)
    {

        $user = User::find($id);
        
        if (!$user) {
            return redirect()->back()->with('error', 'User not found.');
        }
        $user->delete();
        return redirect()->back()->with('success', 'User deleted successfully.');


    }


    public function RoleList()
    {

        $roles = Role::all(); 
        return view('pages.staff.staff_role_list',compact('roles'));
    } 
    public function addRole(Request $request)
    {

           
        $validator = Validator::make($request->all(), [
                
                'role_name' => ['required', 'unique:roles'],
                
            ]);

            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }

            $role = Role::create([
                
                'role_name' => $request->input('role_name'),
                              
            ]);
         return back()->with('success', 'Role Added Successfully');

    }
    public function updateRoles(Request $request)
    {
            $role_id = $request->input('role_id');

            $validator = Validator::make($request->all(), [
                'role_name' => 'required',
                
            ]);
            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }

            $role = Role::find($role_id);

            if (!$role) {
                return redirect()->back()->with('error', 'Role not found.');
            }

            
            $role->role_name = $request->input('role_name');
            $role->status = $request->input('status');



            // Convert image URLs to JSON
            
            $role->save();

         return back()->with('success', 'Role Updated Successfully');

        /* return back()->with('error',  'Something went wrong'); */

    }
    public function deleteRole($id)
    {

        $role = Role::find($id);
        
        if (!$role) {
            return redirect()->back()->with('error', 'Role not found.');
        }
        $role->delete();
        return redirect()->back()->with('success', 'Role deleted successfully.');


    }
    public function permissionList()
    {

        $category = PermissionCategory::all(); 
        return view('pages.permission.permission_list',compact('category'));
    }

    public function addPcategory(Request $request)
    {

           
        $validator = Validator::make($request->all(), [
                
                'p_cat_name' => ['required'],
                
            ]);

            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }

            $role = PermissionCategory::create([
                
                'category_name' => $request->input('p_cat_name'),
                              
            ]);
         return back()->with('success', 'Category  Added Successfully');

    }
    public function updatePcategory(Request $request)
    {
            $cat_id = $request->input('cat_id');

            $validator = Validator::make($request->all(), [
                'p_cat_name' => 'required',
                
            ]);
            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }

            $cat = PermissionCategory::find($cat_id);

            if (!$cat) {
                return redirect()->back()->with('error', 'Category not found.');
            }

            
            $cat->category_name = $request->input('p_cat_name');
            
            
            $cat->save();

         return back()->with('success', 'Category Updated Successfully');

        
    }
    public function deletePcategory($id)
    {

        $cat = PermissionCategory::find($id);
        
        if (!$cat) {
            return redirect()->back()->with('error', 'Category not found.');
        }
        $cat->delete();
        return redirect()->back()->with('success', 'Category deleted successfully.');


    }
    public function permissions($id)
    {
     
        $permission = DB::table('permissions as p')
            ->select('p.*')
            ->where('p.category_id', '=', $id)
            ->get();
     
            return response()->json($permission);
    }
    public function addPermission(Request $request)
    {

           
        $validator = Validator::make($request->all(), [
                
                'permission' => ['required', 'unique:permissions'],
                'cat_id' => ['required'],
                
            ]);

            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }
            $permission = Permission::create([
                
                
                'permission' => $request->input('permission'),
                'category_id' => $request->input('cat_id'),

                              
            ]);
            return response()->json(['message' => 'Permission Added Successfully']);
         

    }

 public function permissionMapping()
    {

        $roles = Role::all(); 
        return view('pages.permission.permission_mapping',compact('roles'));
    } 
    public function RolePermissions($role_id)
    {
        
       /*  $category = PermissionCategory::all(); 

        $permissions = DB::table('permissions as p')
        ->select('p.*', DB::raw('CASE WHEN pm.permission_id IS NOT NULL THEN 1 ELSE 0 END as selected'))
        ->leftJoin('permission_mappings as pm', function ($join) {
            $join->on('p.permission_id', '=', 'pm.permission_id')
                ->where('pm.role_id', '=', $role_id);
        })
        ->get(); */
        $categories = PermissionCategory::all();

        // Use map to fetch permissions for each category and map them by category_id
        $permissionsByCategory = $categories->map(function ($category) use ($role_id) {
            // Fetch permissions for the current category
            $permissions = DB::table('permissions as p')
                ->select('p.*', DB::raw('CASE WHEN pm.permission_id IS NOT NULL THEN 1 ELSE 0 END as selected'))
                ->leftJoin('permission_mappings as pm', function ($join) use ($category, $role_id) {
                    $join->on('p.id', '=', 'pm.permission_id')
                        ->where('pm.role_id', '=', $role_id)
                        ->where('p.category_id', '=', $category->id);
                })
                ->get();

            // Return permissions with additional selected property
            return [
                'category_id' => $category->id,
                'permissions' => $permissions,
            ];
        });

    return($permissionsByCategory);
     
            
    }


}
