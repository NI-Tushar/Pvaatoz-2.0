<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderTakingSetting extends Model
{
    use HasFactory;

    protected $fillable = [
        'telegram_address',
        'telegram_bot_token',
        'telegram_chat_id',
        'is_telegram_enabled',
        'discord_address',
        'discord_webhook_url',
        'is_discord_enabled',
        'email_address',
        'is_email_enabled',
    ];

    protected $casts = [
        'is_telegram_enabled' => 'boolean',
        'is_discord_enabled' => 'boolean',
        'is_email_enabled' => 'boolean',
    ];

    /**
     * Get or create singleton instance of settings.
     */
    public static function current(): self
    {
        $setting = self::first();
        if (!$setting) {
            $setting = self::create([
                'telegram_address' => '@licytm',
                'discord_address' => 'lucytm1',
                'email_address' => 'nitushar06@gmail.com',
                'is_telegram_enabled' => true,
                'is_discord_enabled' => true,
                'is_email_enabled' => true,
            ]);
        }
        return $setting;
    }
}
