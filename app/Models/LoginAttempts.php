<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LoginAttempts extends Model
{
    use HasFactory; 
    
    public $timestamps = false;

    protected $fillable = [
        'user_id',
        'email',
        'ip_address',
        'attempt_type',
        'successful',
        'risk_score',
    ];
}
