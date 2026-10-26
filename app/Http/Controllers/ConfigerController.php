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
            'name'               => $request->name,
            'phone'              => $request->phone,
            'whatsapp'           => $request->whatsapp,
            'email'              => $request->email,
            'app_password'       => $request->app_password,
            'address'            => $request->address,
            'companydetail'      => $request->companydetail,
            'facebook'           => $request->facebook,
            'twitter'            => $request->twitter,
            'youtube'            => $request->youtube,
            'instagram'          => $request->instagram,
            'telegram'           => $request->telegram,
            'telegram_bot_token' => $request->telegram_bot_token,
            'telegram_chat_id'   => $request->telegram_chat_id,
            'discord'            => $request->discord,
            'video'              => $request->video,
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
            'name'               => $request->name,
            'phone'              => $request->phone,
            'whatsapp'           => $request->whatsapp,
            'email'              => $request->email,
            'app_password'       => $request->app_password,
            'address'            => $request->address,
            'companydetail'      => $request->companydetail,
            'facebook'           => $request->facebook,
            'twitter'            => $request->twitter,
            'youtube'            => $request->youtube,
            'instagram'          => $request->instagram,
            'telegram'           => $request->telegram,
            'telegram_bot_token' => $request->telegram_bot_token,
            'telegram_chat_id'   => $request->telegram_chat_id,
            'discord'            => $request->discord,
            'video'              => $request->video,
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
     * Send a test order notification for Email or Telegram.
     */
    public function testNotification(Request $request, \App\Services\OrderNotificationService $notificationService)
    {
        if (! Gate::any(['isAdmin'], Auth::guard('admin')->user())) {
            abort(403);
        }

        $channel = $request->input('channel', 'email');
        $configer = Configer::latest()->first();

        // Create in-memory mock order for testing
        $mockOrder = new \App\Models\Order([
            'order_number'   => 'TEST-' . strtoupper(substr(uniqid(), -6)),
            'customer_name'  => 'John Doe (Test Customer)',
            'customer_email' => 'customer.test@example.com',
            'customer_phone' => '+1 (555) 019-2834',
            'payment_method' => 'usdt_trc20',
            'payment_status' => 'paid',
            'total_quantity' => 5,
            'total_price'    => 45.00,
            'notes'          => 'This is a test notification generated from the Admin Website Configurations page.',
            'created_at'     => now(),
        ]);
        $mockOrder->id = 999999;

        $item1 = new \App\Models\OrderItem([
            'product_name' => 'Gmail Aged Accounts (2020-2023)',
            'quantity'     => 5,
            'unit_price'   => 9.00,
            'subtotal'     => 45.00,
        ]);
        $mockOrder->setRelation('items', collect([$item1]));

        if ($channel === 'telegram') {
            $res = $notificationService->sendTelegramNotification($mockOrder, $configer);
        } else {
            $res = $notificationService->sendEmailNotification($mockOrder, $configer);
        }

        if ($res['success']) {
            return redirect()->back()->with('success', '✅ ' . $res['message']);
        } else {
            return redirect()->back()->with('error', '⚠️ ' . $res['message']);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Configer $configer)
    {
        //
    }
}

