<?php

namespace App\Models;

use App\Models\Member;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Split extends Model
{
    use HasFactory;

    protected $fillable = [
        'expense_id',
        'from_member_id',
        'to_member_id',
        'amount'
    ];

    function from_user(){
        return $this->hasOne(Member::class,'id','from_member_id');
    }

    function to_user(){
        return $this->hasOne(Member::class,'id','to_member_id');
    }
}
