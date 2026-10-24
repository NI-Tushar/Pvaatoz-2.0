<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Configer extends Model
{
    use HasFactory;

    protected $fillable = ['name','logo', 'logo_two', 'video', 'companydetail', 'phone', 'whatsapp', 'email', 'address', 'facebook', 'twitter', 'youtube', 'instagram', 'telegram'];
}
