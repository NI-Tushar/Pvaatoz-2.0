<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use App\Action\File;
use App\Models\Configer;
use App\Http\Requests\StoreConfigerRequest;
use App\Http\Requests\UpdateConfigerRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class ConfigerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $configer = Configer::latest()->first();
        return view('Backend.Pages.Configure.index', compact('configer'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function store(UpdateConfigerRequest $request)
    {
        if (! Gate::any(['isAdmin'], Auth::guard('admin')->user())) {
            abort(403);
        }

        $data = [
            'name'          => $request->name,
            'phone'         => $request->phone,
            'email'         => $request->email,
            'address'       => $request->address,
            'companydetail' => $request->companydetail,
            'facebook'      => $request->facebook,
            'twitter'       => $request->twitter,
            'youtube'       => $request->youtube,
            'instagram'     => $request->instagram,
            'video'         => $request->video,
        ];

        /* Upload Logo */
        if ($request->hasFile('logo')) {
            $data['logo'] = File::fleUpload(
                $request->file('logo'),
                'Configuration'
            );
        }

        /* Upload Logo Two / Favicon */
        if ($request->hasFile('logo_two')) {
            $data['logo_two'] = File::fleUpload(
                $request->file('logo_two'),
                'Configuration'
            );
        }

        Configer::create($data);

        $this->notificationMessage('Website Configuration Created Successfully!');
        return redirect()->route('admin.configer.index');
    }


    public function update(UpdateConfigerRequest $request, Configer $configer)
    {
        if (! Gate::any(['isAdmin'], Auth::guard('admin')->user())) {
            abort(403);
        }

        $data = [
            'name'          => $request->name,
            'phone'         => $request->phone,
            'email'         => $request->email,
            'address'       => $request->address,
            'companydetail' => $request->companydetail,
            'facebook'      => $request->facebook,
            'twitter'       => $request->twitter,
            'youtube'       => $request->youtube,
            'instagram'     => $request->instagram,
            'video'         => $request->video,
        ];

        /* Update Logo */
        if ($request->hasFile('logo')) {
            if ($configer->logo) {
                File::deleteFile($configer->logo);
            }
            $data['logo'] = File::fleUpload($request->file('logo'), 'Configuration');
        }

        /* Update Logo Two / Favicon */
        if ($request->hasFile('logo_two')) {
            if ($configer->logo_two) {
                File::deleteFile($configer->logo_two);
            }
            $data['logo_two'] = File::fleUpload($request->file('logo_two'), 'Configuration');
        }

        $configer->update($data);

        $this->notificationMessage('Website Configuration Update Successfully!');
        return redirect()->route('admin.configer.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Configer $configer)
    {
        //
    }
}
