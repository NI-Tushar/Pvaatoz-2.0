<?php

namespace App\Http\Controllers;

use App\Action\File;
use App\Models\Admin;
use App\Http\Requests\StoreAdminRequest;
use App\Http\Requests\UpdateAdminRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        $admins = Admin::latest()->get();
        return view('Backend.Pages.Admin.index', compact('admins'));
    }

    public function create()
    {
        if (! Gate::any(['isAdmin'], Auth::guard('admin')->user())) {
            abort(403);
        }
        $admins = Admin::latest()->get();
        return view('Backend.Pages.Admin.create', compact('admins'));
    }

    public function store(Request $request)
    {
        if (! Gate::any(['isAdmin'], Auth::guard('admin')->user())) {
            abort(403);
        }
        $request->validate([
            'name' => ['required', 'string'],
            'email' => ['required', 'unique:users,email'],
            'phone' => ['nullable', 'numeric'],
            'role' => ['required', 'string'],
            'password' => ['required', 'string'],
            'repassword' => ['required', 'string'],
            'image' => ['nullable','mimes:png,jpg, jpeg']
        ]);

        $file = $request->file('image');

        if($request->password === $request->repassword) {
            if($request->hasFile('image')){
                $user = Admin::create([
                    'name' => $request->name,
                    'email' => $request->email,
                    'phone' => $request->phone,
                    'password' => Hash::make($request->password),
                    'role' =>  $request->role,
                    'image' => File::upload($file, 'Admins')
                ]);
            }else{
                $user = Admin::create([
                    'name' => $request->name,
                    'email' => $request->email,
                    'phone' => $request->phone,
                    'password' => Hash::make($request->password),
                    'role' =>  $request->role
                ]);
            }

            $this->notificationMessage('New User Added Successfully!');
            return redirect()->route('admin.user.index');
        } else {
            $this->notificationMessage('Passwords do not match', 'danger');
            return back();
        }
    }

    public function edit(Admin $user)
    {
        $admin = $user;

        if (! Gate::any(['isAdmin'], Auth::guard('admin')->user())) {
            abort(403);
        }
        return view('Backend.Pages.Admin.edit', compact('admin'));
    }

    public function update(Admin $user, Request $request)
    {
        if (! Gate::any(['isAdmin'], Auth::guard('admin')->user())) {
            abort(403);
        }
        $request->validate([
            'name' => ['required', 'string'],
            'email' => ['required', "unique:users,email, $user->id"],
            'phone' => ['nullable', 'numeric'],
            'role' => ['required', 'string'],
            'password' => ['nullable', 'string'],
            'repassword' => ['nullable', 'string'],
            'image' => ['nullable','mimes:png,jpg, jpeg']
        ]);



        if ($request->hasFile('image')) {

            $old_image = $user->image;
            File::deleteFile($old_image);

            $imagePath = File::upload($request->file('image'), 'Admins');
            $user->image = $imagePath;
            $user->save();
        }

        if($request->password){
            if($request->password === $request->repassword){
                $user->password = $request->password;
                $user->name = $request->name;
                $user->email = $request->email;
                $user->phone = $request->phone;
                $user->role = $request->role;
                $user->save();

                $this->notificationMessage('User Update Successfully!');
                return redirect()->route('admin.user.index');

            }else{
                $this->notificationMessage('Passwords does not match', 'danger');
                return redirect()->route('admin.user.index');
            }
        }else{
            $user->name = $request->name;
            $user->email = $request->email;
            $user->phone = $request->phone;
            $user->role = $request->role;
            $user->save();

            $this->notificationMessage('User Update Successfully!');
            return redirect()->route('admin.user.index');
        }


    }

    public function destroy(Admin $user)
    {
        if (! Gate::any(['isAdmin'], Auth::guard('admin')->user())) {
            abort(403);
        }
        $FirstUser = Admin::first();
        if($user->id !== $FirstUser->id){
            $deleteUser = $user->delete();
            if($deleteUser){
                $this->notificationMessage('User Deleted Successfully!');
                return redirect()->route('admin.user.index');
            }

        }else{
            $this->notificationMessage('Create a new user then you will able to delete that', 'warning');
            return redirect()->route('admin.user.index');
        }
    }
}
