<?php

namespace App\Models;

use App\Models\Split;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Member extends Model
{
    use HasFactory;

    protected $fillable = [
        'first_name',
        'last_name',
        'email'
    ];

    protected $appends = [
        'full_name'
    ];

    function getFullNameAttribute(){
        return $this->first_name.' '.$this->last_name;
    }

    function getSplitsAttribute(){
        $member = $this->id;
        $splits =  Split::where(function($query) use($member) {
            $query->orWhere('from_member_id', $member)
                  ->orWhere('to_member_id',$member);
        })->get()->groupBy(['to_member_id','from_member_id']);

        $data = [];
        $i = 0;
        foreach ($splits as $to_user => $d1) {
            foreach ($d1 as $from_user => $transactions) {
                $m1 = Member::find($to_user);
                $data[$i]['to_user'] = $m1->first_name;

                $m2 = Member::find($from_user);
                $data[$i]['from_user'] = $m2->first_name;
                $total = 0;
                foreach ($transactions as $key => $transaction) {
                    $total = $total + $transaction->amount;
                }
                $data[$i]['amount'] = $total;
                if ($member == $to_user) {
                    $data[$i]['type'] = 'take';
                    $data[$i]['display_text'] = $m2->first_name.' '.$m2->last_name.' will pay '.$m1->first_name.' Rs.'.$total;
                } else {
                    $data[$i]['type'] = 'give';
                    $data[$i]['display_text'] =$m1->first_name.' '.$m1->last_name.' will receive Rs.'.$total.' from '.$m2->first_name;
                }

                $i++;
            }
        }

        return $data;
    }
}
