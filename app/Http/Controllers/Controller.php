<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    // Notifacition message
    public function notificationMessage($message = 'Data Save Successfully!', $type = 'success')
    {
        session()->flash('type' , $type);
        session()->flash('message' , $message);
    }
}
