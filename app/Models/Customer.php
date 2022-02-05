<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    protected $fillable = ['bvn', 'phone', 'email', 'referralCode', 'signature', 'avatar', 'accountNo', 'accountName', 'created_by', 'creator_uuid'];
}
