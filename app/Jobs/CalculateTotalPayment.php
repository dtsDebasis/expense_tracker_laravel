<?php

namespace App\Jobs;

use App\Models\Split;
use App\Models\Member;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Contracts\Queue\ShouldBeUnique;

class CalculateTotalPayment implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $transaction;
    protected $type;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($transaction,$type)
    {
        $this->transaction = $transaction;
        $this->type = $type;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        if ($this->type == 'increment') {
            $from_member = Member::find($this->transaction->from_member_id);
            $from_member->increment('total_amount_to_give',$this->transaction->amount);

            $to_member = Member::find($this->transaction->to_member_id);
            $to_member->increment('total_amount_to_receive',$this->transaction->amount);
        } else {
            $from_member = Member::find($this->transaction->from_member_id);
            $from_member->decrement('total_amount_to_give',$this->transaction->amount);

            $to_member = Member::find($this->transaction->to_member_id);
            $to_member->decrement('total_amount_to_receive',$this->transaction->amount);

            Split::find($this->transaction->id)->delete();
        }
    }
}
