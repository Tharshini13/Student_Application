<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash; 
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    public function loadAllUsers(){
        $all_users = User::all();
        return view('users', compact('all_users'));
    }

    public function loadAddUserForm(){
        return view('add-user');
    }

    public function AddUser(Request $request){
        $request->validate([
            'full_name' => 'required|string',
            'email' => 'required|email|unique:users',
            'phone_number' => 'required',
            'gender' => 'required',
            'course' => 'required|string',
            'profile_picture' => 'nullable|image|mimes:jpg,png,jpeg|max:2048', // File validation
        ]);

        try {
            $new_user = new User;
            $new_user->name = $request->full_name;
            $new_user->email = $request->email;
            $new_user->phone_number = $request->phone_number;
            $new_user->gender = $request->gender;
            $new_user->course = $request->course;

            // Handle file upload
            if ($request->hasFile('profile_picture')) {
                $file = $request->file('profile_picture');
                $filePath = $file->store('uploads', 'public'); // Store in storage/app/public/uploads
                $new_user->profile_picture = $filePath;
            }

            $new_user->save();

            return redirect('/users')->with('success', 'User Added Successfully');
        } catch (\Exception $e) {
            return redirect('/add/user')->with('fail', $e->getMessage());
        }
    }

    public function EditUser(Request $request){
        $request->validate([
            'full_name' => 'required|string',
            'email' => 'required|email',
            'phone_number' => 'required',
            'gender' => 'required',
            'course' => 'required|string',
            'profile_picture' => 'nullable|image|mimes:jpg,png,jpeg|max:2048', // File validation
        ]);

        try {
            $updateData = [
                'name' => $request->full_name,
                'email' => $request->email,
                'phone_number' => $request->phone_number,
                'gender' => $request->gender,
                'course' => $request->course,
            ];

            // Handle file upload if a new file is uploaded
            if ($request->hasFile('profile_picture')) {
                $file = $request->file('profile_picture');
                $filePath = $file->store('uploads', 'public'); // Store in storage/app/public/uploads
                $updateData['profile_picture'] = $filePath;
            }

            User::where('id', $request->user_id)->update($updateData);

            return redirect('/users')->with('success', 'User Updated Successfully');
        } catch (\Exception $e) {
            return redirect('/edit/user')->with('fail', $e->getMessage());
        }
    }

    public function loadEditForm($id){
        $user = User::find($id);
    
        if (!$user) {
            return redirect('/users')->with('fail', 'User not found!');
        }
    
        return view('edit-user', compact('user'));
    }



    public function deleteUser($id){
        try {
            $user = User::find($id);
            if ($user->profile_picture) {
                Storage::disk('public')->delete($user->profile_picture); // Delete stored file
            }
            $user->delete();
            return redirect('/users')->with('success', 'User Deleted Successfully!');
        } catch (\Exception $e) {
            return redirect('/users')->with('fail', $e->getMessage());
        }
    }
}
