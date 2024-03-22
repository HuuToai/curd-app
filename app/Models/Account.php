<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Account extends Model
{
    use HasFactory;
    use SoftDeletes; // Sử dụng trait SoftDeletes

    protected $fillable = ['username', 'fullname', 'age', 'address', 'avatar'];

    protected $dates = ['deleted_at']; // Định dạng trường deleted_at
}
