<?php

namespace App\Jobs;

use App\Models\Split;
use App\Models\Member;
use Illuminate\Bus\Queueable;
use App\Jobs\CalculateTotalPayment;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Contracts\Queue\ShouldBeUnique;

class SplitPayment implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $expense;
    protected $member_id;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($expense,$member_id)
    {
        $this->expense = $expense;
        $this->member_id = $member_id;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
       $getOtherTeamMembers = Member::where('id','!=',$this->expense->member_id);
       if ($getOtherTeamMembers->count() > 0 && $this->expense->amount > 0) {
            $totalMember = Member::count();
            $shared_amount = round( (float)$this->expense->amount/$totalMember, 2);
            $members = $getOtherTeamMembers->get();
            foreach ($members as $key => $member) {
                $split = Split::create([
                    'expense_id' => $this->expense->id,
                    'from_member_id' => $member->id,
                    'to_member_id' => $this->member_id,
                    'amount' => $shared_amount,
                ]);
                CalculateTotalPayment::dispatch($split,'increment');
            }
       }
    }
}
