<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Client extends Model
{
    /** @use HasFactory<\Database\Factories\ClientFactory> */
    use HasFactory;

    protected $table = 'clients';

    protected $fillable = [
        'code',
        'name',
        'business_reg_number',
        'business_type',
        'billing_address',
    ];


     public static function generateClientCode()
    {
       do {
            $code= 'CL-' . strtoupper(Str::random(4));
        } while (self::where('code', $code)->exists());
        return $code;
    }
}
