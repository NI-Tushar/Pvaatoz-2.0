<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentMethod extends Model
{
    use HasFactory;

    protected $fillable = [
        'slug',
        'name',
        'currency',
        'network',
        'icon',
        'wallet_address',
        'api_key',
        'api_secret',
        'merchant_id',
        'ipn_secret',
        'qr_code',
        'instructions',
        'exchange_rate',
        'is_enabled',
        'extra_settings',
        'sort_order',
    ];

    protected $casts = [
        'is_enabled' => 'boolean',
        'extra_settings' => 'array',
        'exchange_rate' => 'decimal:8',
        'sort_order' => 'integer',
    ];

    /**
     * Pre-populate default methods if they do not exist
     */
    public static function seedDefaults(): void
    {
        $defaults = [
            [
                'slug' => 'usdt_trc20',
                'name' => 'USDT (TRC20)',
                'currency' => 'USDT',
                'network' => 'TRON (TRC20)',
                'icon' => 'fa-solid fa-coins',
                'wallet_address' => '',
                'api_key' => '',
                'api_secret' => '',
                'merchant_id' => '',
                'ipn_secret' => '',
                'instructions' => 'Send exact amount in USDT via TRC20 network. Double check your TRC20 destination wallet address before sending.',
                'is_enabled' => true,
                'sort_order' => 1,
            ],
            [
                'slug' => 'usdc_erc20',
                'name' => 'USDC (ERC20)',
                'currency' => 'USDC',
                'network' => 'Ethereum (ERC20)',
                'icon' => 'fa-solid fa-circle-dollar-to-slot',
                'wallet_address' => '',
                'api_key' => '',
                'api_secret' => '',
                'merchant_id' => '',
                'ipn_secret' => '',
                'instructions' => 'Send exact amount in USDC via Ethereum (ERC20) network. Ensure you cover standard network gas fees.',
                'is_enabled' => true,
                'sort_order' => 2,
            ],
            [
                'slug' => 'solana',
                'name' => 'Solana (SOL)',
                'currency' => 'SOL',
                'network' => 'Solana Mainnet',
                'icon' => 'fa-solid fa-bolt',
                'wallet_address' => '',
                'api_key' => '',
                'api_secret' => '',
                'merchant_id' => '',
                'ipn_secret' => '',
                'instructions' => 'Send payment in SOL via Solana Mainnet. Transfers are confirmed in under 15 seconds.',
                'is_enabled' => true,
                'sort_order' => 3,
            ],
            [
                'slug' => 'btc',
                'name' => 'Bitcoin (BTC)',
                'currency' => 'BTC',
                'network' => 'Bitcoin Mainnet',
                'icon' => 'fa-brands fa-bitcoin',
                'wallet_address' => '',
                'api_key' => '',
                'api_secret' => '',
                'merchant_id' => '',
                'ipn_secret' => '',
                'instructions' => 'Send exact BTC amount to the Bitcoin address below. Requires 1 network confirmation for instant credential dispatch.',
                'is_enabled' => true,
                'sort_order' => 4,
            ],
        ];

        foreach ($defaults as $item) {
            self::firstOrCreate(['slug' => $item['slug']], $item);
        }
    }
}
