<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kost extends Model
{
    use HasFactory;
    protected $table = 'kosts';
    protected $fillable = [
        'user_id',
        'name',
        'address',
        'city',
        'detail',
        'room_amount',
        'availability',
        'price'
    ];

    public function user(){
        return $this->hasOne(User::class);
    }



}
