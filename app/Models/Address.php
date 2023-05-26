<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Address extends Model
{
    use HasFactory;

    protected $table = 'address';
    protected $fillable = [
        'id',
        'user_id',
        'city',
        'street',
        'house',
        'create_at',
        'update_at',
    ];

    public static function readUserAddress($userId){
        return Address::where('user_id', $userId)->get();
    }
}
