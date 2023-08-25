<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Users extends Model
{
    use HasFactory;
    protected $table = "users";
    protected $primaryKey = "id";
    protected $fillable = ["name", "mobile", "email","password", "token", "isActive", "added_datetime"];
}  
