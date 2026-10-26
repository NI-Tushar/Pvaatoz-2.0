<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Configer extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'logo',
        'logo_two',
        'video',
        'companydetail',
        'phone',
        'whatsapp',
        'email',
        'app_password',
        'address',
        'facebook',
        'twitter',
        'youtube',
        'instagram',
        'telegram',
        'telegram_bot_token',
        'telegram_chat_id',
        'discord',
    ];
}

