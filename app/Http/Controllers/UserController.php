<?php

namespace App\Http\Controllers;

use App\Models\User; //import this
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash; //import this for password hashing

class UserController extends Controller
{
    //here create all crud logic
    public function loadAllUsers(){
        $all_users = User::all();
        return view('users',compact('all_users'));
    }

    public function loadAddUserForm(){
        return view('add-user');
    }

    public function AddUser(Request $request){
        // perform form validation here
        $request->validate([
            'full_name' => 'required|string',
            'email' => 'required|email|unique:users',
            'phone_number' => 'required',
        ]);
        try {
             // register user here
            $new_user = new User;
            $new_user->name = $request->full_name;
            $new_user->email = $request->email;
            $new_user->phone_number = $request->phone_number;
            $new_user->save();

            return redirect('/users')->with('success','User Added Successfully');
        } catch (\Exception $e) {
            return redirect('/add/user')->with('fail',$e->getMessage());
        }
       
        
    }

    public function EditUser(Request $request){
        // perform form validation here
        $request->validate([
            'full_name' => 'required|string',
            'email' => 'required|email',
            'phone_number' => 'required',
        ]);
        try {
             // update user here
            $update_user = User::where('id',$request->user_id)->update([
                'name' => $request->full_name,
                'email' => $request->email,
                'phone_number' => $request->phone_number,
            ]);

            return redirect('/users')->with('success','User Updated Successfully');
        } catch (\Exception $e) {
            return redirect('/edit/user')->with('fail',$e->getMessage());
        }
    }

    public function loadEditForm($id){
        $user = User::find($id);

        return view('edit-user',compact('user'));
    }

    public function deleteUser($id){
        try {
            User::where('id',$id)->delete();
            return redirect('/users')->with('success','User Deleted successfully!');
        } catch (\Exception $e) {
            return redirect('/users')->with('fail',$e->getMessage());
            
        }
    }
}