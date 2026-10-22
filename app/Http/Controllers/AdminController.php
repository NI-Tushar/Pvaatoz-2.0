<?php

namespace App\Http\Controllers;

use App\Action\File;
use App\Models\Admin;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    /**
     * Display a listing of Users (Customers) and Staff (Admins).
     */
    public function index(Request $request)
    {
        $tab = $request->get('tab', 'customers');
        $search = trim($request->get('search', ''));

        // Query Customers (Website Registered Users)
        $customersQuery = User::withCount('orders')->latest();
        if ($search !== '') {
            $customersQuery->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%")
                  ->orWhere('phone', 'like', "%{$search}%");
            });
        }
        $customers = $customersQuery->paginate(15, ['*'], 'customers_page')->withQueryString();

        // Query Staff / Admins
        $adminsQuery = Admin::latest();
        if ($search !== '') {
            $adminsQuery->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%")
                  ->orWhere('phone', 'like', "%{$search}%")
                  ->orWhere('role', 'like', "%{$search}%");
            });
        }
        $admins = $adminsQuery->get();

        // Metrics & KPI counts
        $totalCustomers = User::count();
        $verifiedCustomers = User::where('is_verified', 'Verified')->count();
        $totalAdmins = Admin::count();
        $newThisMonth = User::where('created_at', '>=', now()->startOfMonth())->count();

        return view('Backend.Pages.Admin.index', compact(
            'customers',
            'admins',
            'tab',
            'search',
            'totalCustomers',
            'verifiedCustomers',
            'totalAdmins',
            'newThisMonth'
        ));
    }

    /**
     * Show the form for creating a new user or staff member.
     */
    public function create()
    {
        $admin = Auth::guard('admin')->user();
        if (! $admin || strtolower($admin->role) !== 'admin') {
            abort(403, 'Unauthorized action.');
        }

        return view('Backend.Pages.Admin.create');
    }

    /**
     * Store a newly created user or staff admin in storage.
     */
    public function store(Request $request)
    {
        $admin = Auth::guard('admin')->user();
        if (! $admin || strtolower($admin->role) !== 'admin') {
            abort(403, 'Unauthorized action.');
        }

        $accountType = $request->input('account_type', 'customer');
        $role = $request->input('role', ($accountType === 'staff' ? 'Admin' : 'Customer'));
        $isStaff = ($accountType === 'staff') || in_array(strtolower($role), ['admin', 'editor', 'moderator']);

        $rules = [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', $isStaff ? 'unique:admins,email' : 'unique:users,email'],
            'phone' => ['nullable', 'string', 'max:50'],
            'role' => ['required', 'string'],
            'password' => ['required', 'string', 'min:6'],
            'repassword' => ['required', 'same:password'],
            'image' => ['nullable', 'image', 'mimes:png,jpg,jpeg,webp', 'max:2048'],
        ];

        $messages = [
            'repassword.same' => 'The password confirmation does not match.',
            'email.unique' => 'This email address is already registered in the system.',
        ];

        $request->validate($rules, $messages);

        // Upload Profile Image if provided
        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = File::upload($request->file('image'), $isStaff ? 'Admins' : 'Users');
        }

        if ($isStaff) {
            Admin::create([
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'role' => ucfirst($role),
                'password' => Hash::make($request->password),
                'image' => $imagePath,
            ]);

            $this->notificationMessage("New staff member '{$request->name}' added as {$role}!");
            return redirect()->route('admin.user.index', ['tab' => 'admins'])->with('success', "Staff member '{$request->name}' added successfully!");
        } else {
            User::create([
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'user_type' => 'customer',
                'is_verified' => $request->boolean('is_verified') ? 'Verified' : 'Pending',
                'password' => Hash::make($request->password),
                'image' => $imagePath,
            ]);

            $this->notificationMessage("Customer user '{$request->name}' created successfully!");
            return redirect()->route('admin.user.index', ['tab' => 'customers'])->with('success', "Customer '{$request->name}' created successfully!");
        }
    }

    /**
     * Show the form for editing the specified user or admin.
     */
    public function edit(Request $request, $id)
    {
        $admin = Auth::guard('admin')->user();
        if (! $admin || strtolower($admin->role) !== 'admin') {
            abort(403, 'Unauthorized action.');
        }

        $type = $request->get('type');
        if ($type === 'customer' || (!Admin::where('id', $id)->exists() && User::where('id', $id)->exists())) {
            $user = User::findOrFail($id);
            $accountType = 'customer';
        } else {
            $user = Admin::findOrFail($id);
            $accountType = 'staff';
        }

        return view('Backend.Pages.Admin.edit', compact('user', 'accountType'));
    }

    /**
     * Update the specified user or admin in storage.
     */
    public function update(Request $request, $id)
    {
        $admin = Auth::guard('admin')->user();
        if (! $admin || strtolower($admin->role) !== 'admin') {
            abort(403, 'Unauthorized action.');
        }

        $accountType = $request->input('account_type');
        $isCustomer = ($accountType === 'customer') || User::where('id', $id)->exists();

        if ($isCustomer) {
            $user = User::findOrFail($id);
            $request->validate([
                'name' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'email', 'max:255', "unique:users,email,{$user->id}"],
                'phone' => ['nullable', 'string', 'max:50'],
                'password' => ['nullable', 'string', 'min:6'],
                'repassword' => ['nullable', 'same:password'],
                'image' => ['nullable', 'image', 'mimes:png,jpg,jpeg,webp', 'max:2048'],
            ]);

            $user->name = $request->name;
            $user->email = $request->email;
            $user->phone = $request->phone;
            if ($request->has('is_verified')) {
                $user->is_verified = $request->boolean('is_verified') ? 'Verified' : 'Pending';
            }

            if ($request->hasFile('image')) {
                if ($user->image) {
                    File::deleteFile($user->image);
                }
                $user->image = File::upload($request->file('image'), 'Users');
            }

            if ($request->filled('password')) {
                $user->password = Hash::make($request->password);
            }

            $user->save();

            $this->notificationMessage("Customer '{$user->name}' updated successfully!");
            return redirect()->route('admin.user.index', ['tab' => 'customers'])->with('success', "Customer updated successfully!");
        } else {
            $admin = Admin::findOrFail($id);
            $request->validate([
                'name' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'email', 'max:255', "unique:admins,email,{$admin->id}"],
                'phone' => ['nullable', 'string', 'max:50'],
                'role' => ['required', 'string'],
                'password' => ['nullable', 'string', 'min:6'],
                'repassword' => ['nullable', 'same:password'],
                'image' => ['nullable', 'image', 'mimes:png,jpg,jpeg,webp', 'max:2048'],
            ]);

            $admin->name = $request->name;
            $admin->email = $request->email;
            $admin->phone = $request->phone;
            $admin->role = ucfirst($request->role);

            if ($request->hasFile('image')) {
                if ($admin->image) {
                    File::deleteFile($admin->image);
                }
                $admin->image = File::upload($request->file('image'), 'Admins');
            }

            if ($request->filled('password')) {
                $admin->password = Hash::make($request->password);
            }

            $admin->save();

            $this->notificationMessage("Staff member '{$admin->name}' updated successfully!");
            return redirect()->route('admin.user.index', ['tab' => 'admins'])->with('success', "Staff member updated successfully!");
        }
    }

    /**
     * Remove the specified user or admin.
     */
    public function destroy(Request $request, $id)
    {
        $admin = Auth::guard('admin')->user();
        if (! $admin || strtolower($admin->role) !== 'admin') {
            abort(403, 'Unauthorized action.');
        }

        $type = $request->input('type');

        if ($type === 'customer' || (!Admin::where('id', $id)->exists() && User::where('id', $id)->exists())) {
            $user = User::findOrFail($id);
            $userName = $user->name;
            if ($user->image) {
                File::deleteFile($user->image);
            }
            $user->delete();

            $this->notificationMessage("Customer '{$userName}' has been deleted.");
            return redirect()->route('admin.user.index', ['tab' => 'customers'])->with('success', "Customer deleted successfully.");
        } else {
            $admin = Admin::findOrFail($id);

            if ($admin->id === Auth::guard('admin')->id()) {
                $this->notificationMessage('You cannot delete your own logged-in admin account!', 'danger');
                return redirect()->back()->with('error', 'You cannot delete your own account.');
            }

            $firstAdmin = Admin::first();
            if ($admin->id === $firstAdmin?->id) {
                $this->notificationMessage('Root primary administrator cannot be deleted!', 'warning');
                return redirect()->back()->with('error', 'Cannot delete root primary administrator.');
            }

            $adminName = $admin->name;
            if ($admin->image) {
                File::deleteFile($admin->image);
            }
            $admin->delete();

            $this->notificationMessage("Staff member '{$adminName}' has been deleted.");
            return redirect()->route('admin.user.index', ['tab' => 'admins'])->with('success', "Staff member deleted successfully.");
        }
    }

    /**
     * Quick toggle customer email/account verification.
     */
    public function toggleVerify(Request $request, $id)
    {
        $admin = Auth::guard('admin')->user();
        if (! $admin || strtolower($admin->role) !== 'admin') {
            abort(403, 'Unauthorized action.');
        }

        $user = User::findOrFail($id);
        $user->is_verified = ($user->is_verified === 'Verified') ? 'Pending' : 'Verified';
        $user->save();

        if ($request->ajax() || $request->wantsJson()) {
            return response()->json([
                'success' => true,
                'status' => $user->is_verified,
                'message' => "Verification updated to {$user->is_verified}.",
            ]);
        }

        return redirect()->back()->with('success', "User '{$user->name}' verification is now {$user->is_verified}.");
    }
}
