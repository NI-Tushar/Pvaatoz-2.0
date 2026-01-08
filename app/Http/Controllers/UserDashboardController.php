<?php

namespace App\Http\Controllers;

use App\Action\File;
use App\Models\Assessment;
use App\Models\Configer;
use App\Models\Order;
use App\Models\Student_infos;
use App\Models\Post_graduate_info;
use App\Models\User;
use App\Models\Qualification;
use App\Models\Experience;
use App\Models\Country;
use App\Models\Student_choice;
use App\Models\Services;
use App\Models\Agency;
use App\Models\Review;
use App\Models\Training;
use App\Models\ConsultancyService;
use App\Models\Transaction;
use App\Models\StudentPost;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserDashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function index(){
        $user = auth()->guard('web')->user();
        $data = [];

        if ($user->user_type === 'Consultant') {
            $action = '';
            $data['action'] = $action;
            // Consultant-specific data
            $data['balance'] = $user->balance;

            // Get assessments for the consultant
            $assessments = Assessment::where('consultant_id', $user->id)
                ->orderBy('created_at', 'desc')
                ->get();

            // Total requests: Pending, Accepted, Rejected
            $data['total_request'] = $assessments->whereIn('status', ['Pending', 'Accepted', 'Rejected'])->count();
            // Completed requests: Completed
            $data['complete_request'] = $assessments->where('status', 'Completed')->count();

            // Get reviews for the consultant
            $data['total_review'] = Review::where('consultant_id', $user->id)->count();

            // Get new requests (Pending assessments)
            $data['new_requests'] = Assessment::where('consultant_id', $user->id)
                ->where('status', 'Pending')
                ->with('student')
                ->latest()
                ->take(3)
                ->get();

            // Get new requests (Accepted assessments)
            $data['accepted_requests'] = Assessment::where('consultant_id', $user->id)
                ->where('status', 'Accepted')
                ->with('student')
                ->latest()
                ->take(3)
                ->get();

            $data['posts'] = StudentPost::where('status', 'Active')->latest()->take(10)->get();

            return view("Frontend.Dashboard.Consultants.dashboard", $data);

        } elseif($user->user_type === 'Student') {
            $action = '';
            $data['action'] = $action;
            // Student-specific data
            // Consultant available on the platform
            $data['total_consultants'] = User::where('user_type', 'Consultant')->count();
            // Total requests: Pending, Accepted, Rejected
            $data['total_request'] = Assessment::where('student_id', $user->id)
                ->whereIn('status', ['Pending', 'Accepted', 'Rejected', 'Completed'])
                ->count();
            // Completed requests: Completed
            $data['complete_request'] = Assessment::where('student_id', $user->id)
                ->where('status', 'Completed')
                ->count();

            $data['last_deposite'] = Transaction::where('user_id', Auth()->id())
                ->latest()
                ->value('amount');

            $data['pro_consultancyService'] = ConsultancyService::join('users', 'consultancy_services.user_id', '=', 'users.id')
            ->where('consultancy_services.status', 'active')
            ->where('users.user_type', 'Consultant')
            ->where('users.is_pro_user', 'pro')
            ->take(5)->get();

            $data['verified_consultancyService'] = ConsultancyService::join('users', 'consultancy_services.user_id', '=', 'users.id')
            ->where('consultancy_services.status', 'active')
            ->where('users.user_type', 'Consultant')
            ->where('users.is_verified', 'Verified')
            ->take(5)->get();

            $data['reguler_consultancyService'] = ConsultancyService::join('users', 'consultancy_services.user_id', '=', 'users.id')
            ->where('consultancy_services.status', 'active')
            ->where('users.user_type', 'Consultant')
            ->orderBy('users.completion_percentage', 'desc')
            ->take(5)->get();

            return view("Frontend.Dashboard.Student.dashboard", $data);
        } elseif($user->user_type === 'Agency') {
            $data = [];
            // Get assessments for the consultant
            $agency = Agency::where('user_id', Auth::guard('web')->user()->id)->first();
            $data['agency'] = $agency;
            return view("Frontend.Dashboard.Agency.dashboard", $data);
        }
    }

    public function dashboardAction($action){
        $user = auth()->guard('web')->user();
        $data = [];
        $data['action'] = $action;
        // Student-specific data
        // Consultant available on the platform
        $data['total_consultants'] = User::where('user_type', 'Consultant')->count();
        // Total requests: Pending, Accepted, Rejected
        $data['total_request'] = Assessment::where('student_id', $user->id)
            ->whereIn('status', ['Pending', 'Accepted', 'Rejected', 'Completed'])
            ->count();
        // Completed requests: Completed
        $data['complete_request'] = Assessment::where('student_id', $user->id)
            ->where('status', 'Completed')
            ->count();

        $data['last_deposite'] = Transaction::where('user_id', Auth()->id())
            ->latest()
            ->value('amount');
        
        $data['countries'] = Country::pluck('name');

        $data['pro_consultancyService'] = ConsultancyService::join('users', 'consultancy_services.user_id', '=', 'users.id')
        ->where('consultancy_services.status', 'active')
        ->where('users.user_type', 'Consultant')
        ->where('users.is_pro_user', 'pro')
        ->take(5)->get();

        $data['verified_consultancyService'] = ConsultancyService::join('users', 'consultancy_services.user_id', '=', 'users.id')
        ->where('consultancy_services.status', 'active')
        ->where('users.user_type', 'Consultant')
        ->where('users.is_verified', 'Verified')
        ->take(5)->get();

        $data['reguler_consultancyService'] = ConsultancyService::join('users', 'consultancy_services.user_id', '=', 'users.id')
        ->where('consultancy_services.status', 'active')
        ->where('users.user_type', 'Consultant')
        ->orderBy('users.completion_percentage', 'desc')
        ->take(5)->get();

        // action for last-education
        if($action == 'last-education'){
            $user_id = Auth::guard('web')->user()->id;
            $last_edu = Student_infos::where('user_id', $user_id)
            ->select('last_edu_title', 'last_edu_department', 'last_edu_result', 'last_edu_certificate',
            'last_edu_startDate', 'last_edu_endDate', 'last_edu_Duration')->first();
            
            $data['last_edu'] = $last_edu;
        }

        // action for choice create
        if($action == 'choice-create'){
            $user_id = Auth::guard('web')->user()->id;

            $data['services'] = Services::get();

            // Fetch last education record
            $last_edu = Student_infos::where('user_id', $user_id)
                ->select(
                    'last_edu_title', 
                    'last_edu_department', 
                    'last_edu_result', 
                    'last_edu_certificate',
                    'last_edu_startDate', 
                    'last_edu_endDate', 
                    'last_edu_Duration'
                )->first();

                    
            if ($last_edu) {
                $all_empty = empty($last_edu->last_edu_title)
                    && empty($last_edu->last_edu_department)
                    && empty($last_edu->last_edu_result)
                    && empty($last_edu->last_edu_certificate)
                    && empty($last_edu->last_edu_startDate)
                    && empty($last_edu->last_edu_endDate)
                    && empty($last_edu->last_edu_Duration);

                if ($all_empty) {
                    return redirect()->route('student.profile.action', 'last-education');
                }
            } else {
                // If there's no record at all, also redirect
                return redirect()->route('student.profile.action', 'last-education');
            }


            // Otherwise continue normally
            $data['last_edu'] = $last_edu;
                        
            // choice data
            $choices = Student_choice::where('user_id', $user_id)->first();
            $data['choices'] = $choices;
        }
        return view("Frontend.Dashboard.Student.dashboard", $data);
    }

    public function updateUserInformation(Request $request,  User $user){
        // info(count($request->newpassword));
        $hashedPassword = Auth::guard('web')->user()->getAuthPassword();
        if ($request->oldpassword && $request->newpassword && $request->renewpassword) {
            if (Hash::check($request->oldpassword, $hashedPassword)) {
                // if(strlen($request->newpassword) >= 8){
                if ($request->newpassword === $request->renewpassword) {
                    $user->update([
                        'password' => $request->newpassword,
                    ]);
                }
                // }
            } else {
                return response()->json([
                    'icon' => 'error',
                    'title' => 'Password Miss match!',
                ]);
            }
        }
        $user->update([
            'name' => $request->name,
            'email' => $request->email,
        ]);
        return response()->json([
            'icon' => 'success',
            'title' => 'User Information Update Successfully!',
        ]);
    }

    public function showAllOrder(){
        $orders = Order::where('user_id', Auth::guard('web')->user()->id)->latest()->get();
        return view("Frontend.Pages.Dashboard.order", compact('orders'));
    }

    public function showInvoice($id){
        $order = Order::with('orderPackages')->find($id);
        $config = Configer::first();
        return view('Backend.Pages.Order.invoice', compact('order', 'config'));
    }

    public function profileEdit(){
        $user_id = auth()->guard('web')->id();
        // Fetch existing student info and postgraduate info
        $student_info_data = Student_infos::where('user_id', $user_id)->first();
        $post_graduate_data = Post_graduate_info::where('user_id', $user_id)->first();

        return view("Frontend.Dashboard.Student.Profile.edit", compact('student_info_data', 'post_graduate_data'));
    }

    public function updateInformation(Request $request){
        // Validate the request (all fields nullable)
        $validated = $request->validate([
            'name' => ['nullable', 'string', 'max:255'],
            // 'email' => ['nullable', 'string', 'email', 'max:255'], // Uncomment if needed
            'phone' => ['nullable', 'string', 'max:20'],
            'gender' => ['nullable', 'string', 'max:20'],
            'present_address' => ['nullable', 'string', 'max:255'],
            'present_city' => ['nullable', 'string', 'max:100'],
            'present_country' => ['nullable', 'string', 'max:100'],
            'date_of_birth' => ['nullable', 'date'],
            'nationality' => ['nullable', 'string', 'max:100'],
            'passport_or_nid' => ['nullable', 'string', 'max:50'],
            'passport_issue_date' => ['nullable', 'date'],
            'passport_expiry_date' => ['nullable', 'date'],
            'experience' => ['nullable', 'string'],
        ]);

        // Update the authenticated user
        $request->user()->update($validated);

        // Notification & redirect
        $this->notificationMessage('Profile Information Updated Successfully!');
        return redirect()->back();
    }

    public function updatePassword(Request $request){

        $validate = $request->validate([
            'current_password' => ['required', 'string', 'max:255'],
            'password' => ['required', 'string', 'max:255'],
            'password_confirmation' => ['required', 'string', 'max:255']
        ]);

        $enteredPassword = request('current_password');
        $hashedPassword = $request->user()->password;

        if (Hash::check($enteredPassword, $hashedPassword)) {
            if ($request->password === $request->password_confirmation) {
                $request->user()->update([
                    'password' => Hash::make($validate['password']),
                ]);
                $this->notificationMessage('Passwords Update Successfully!');
                return redirect()->back();
            } else {
                $this->notificationMessage('Passwords do not match!', 'danger');
                return redirect()->back();
            }
        } else {
            $this->notificationMessage('Your Current Passwords do not match!', 'danger');
            return redirect()->back();
        }
    }

    public function updateImage(Request $request){
        $validate = $request->validate([
            'image' => ['nullable', 'image', 'mimes:jpeg,png,jpg'],
            'name' => ['nullable', 'string', 'max:255'],
        ]);

        $data = [];

        if ($request->hasFile('image')) {
            $old_image = $request->user()->image;
            File::deleteFile($old_image);
            $data['image'] = File::upload($request->file('image'), 'Users');
        }

        if ($request->filled('name')) {
            $data['name'] = $request->name;
        }

        if (!empty($data)) {
            $request->user()->update($data);
            $this->notificationMessage('Profile updated successfully!');
        }

        // ✅ Return JSON if it's an AJAX request (like fetch)
        if ($request->expectsJson()) {
            return response()->json(['success' => true]);
        }

        return redirect()->back();
    }


}
