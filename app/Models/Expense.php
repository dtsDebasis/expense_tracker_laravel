<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Expense extends Model
{
    use HasFactory;

    protected $fillable = [
        'member_id',
        'amount'
    ];

    function member(){
        return $this->hasOne(Member::class,'id','member_id');
    }
}
