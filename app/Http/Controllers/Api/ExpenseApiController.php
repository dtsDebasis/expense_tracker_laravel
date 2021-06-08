<?php

namespace App\Http\Controllers\Api;

use Exception;
use Validator;
use Carbon\Carbon;
use App\Models\Split;
use App\Models\Member;
use App\Helpers\Helper;
use App\Models\Expense;
use App\Jobs\SplitPayment;
use Illuminate\Http\Request;
use App\Jobs\CalculateTotalPayment;
use App\Http\Controllers\Controller;

class ExpenseApiController extends Controller
{
    /*
      Route : http://127.0.0.1:8000/api/v1/add_expense
      Details : API to add new expense
      Author : Debasis Chaktaborty
      Last Modified By : Debasis Chaktaborty
      Created On : 7th June,2021
      Last Work : 8th June,2021
    */
    public function add_expense(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'member_id'=> 'required',
                'amount'=> 'required | regex:/^\d*(\.\d{2})?$/'
            ]);

            if ($validator->fails()) {
                return Helper::rj('Validation Error', 422, $validator->errors());
            }

            $member = Member::findOrFail($request->member_id);

            $expense = Expense::create($request->all());

            if ($expense) {
                SplitPayment::dispatch($expense,$request->member_id);
                return Helper::rj('Expense Created', 201, $expense);
            }

            return Helper::rj('Something Bad happened', 400, []);
        } catch (Exception $e) {
			return Helper::rj($e->getMessage(), 500);
		}
    }

    /*
      Route : http://127.0.0.1:8000/api/v1/update_expense
      Details : API to update expense | For now we can't update member directly
      Author : Debasis Chaktaborty
      Last Modified By : Debasis Chaktaborty
      Created On : 7th June,2021
      Last Work : 7th June,2021
    */
    public function update_expense(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'expense_id'=> 'required',
                'amount'=> 'required | regex:/^\d*(\.\d{2})?$/'
            ]);

            if ($validator->fails()) {
                return Helper::rj('Validation Error', 422, $validator->errors());
            }

            $expense = Expense::findOrFail($request->expense_id);
            $member = Member::findOrFail($expense->member_id);

            if ($expense) {
                $splits = Split::where('expense_id',$expense->id)->get();
                foreach ($splits as $key => $split) {
                    CalculateTotalPayment::dispatch($split,'decrement');
                }
                if ($request->amount > 0) {
                    $expense->amount = $request->amount;
                    $expense->save();

                    $newExpense = Expense::findOrFail($expense->id);

                    SplitPayment::dispatch($newExpense,$newExpense->member_id);
                    return Helper::rj('Expense Updated', 200, $newExpense);
                } else {
                    $expense->delete();
                    return Helper::rj('Expense Deleted', 200, []);
                }
            }

            return Helper::rj('Something Bad happened', 400, []);
        } catch (Exception $e) {
			return Helper::rj($e->getMessage(), 500);
		}
    }

    /*
      Route : http://127.0.0.1:8000/api/v1/get_all_member_splits
      Details : Get Member Wise Split Details
      Author : Debasis Chaktaborty
      Last Modified By : Debasis Chaktaborty
      Created On : 8th June,2021
      Last Work : 8th June,2021
    */
    public function get_all_member_splits(Request $request)
    {
        try {
            $members = Member::get();
            $members->each(function ($member) {
                $member->setAppends(['splits']);
            });
            return Helper::rj('Splits', 200, $members);
        } catch (Exception $e) {
			return Helper::rj($e->getMessage(), 500);
		}
    }

    /*
      Route : http://127.0.0.1:8000/api/v1/get_summary
      Details : Get Day wise Summery for Home Page
      Author : Debasis Chaktaborty
      Last Modified By : Debasis Chaktaborty
      Created On : 8th June,2021
      Last Work : 8th June,2021
    */
    public function get_summary(Request $request)
    {
        try {

            $summary_of = $request->summary_of ? $request->summary_of : 365; //Default : Last 365 days data
            $data = [];

            $getHighestExpenseMember = Expense::with(['member'])->groupBy('member_id')
            ->selectRaw('*, sum(amount) as total_expense')
            ->whereDate('created_at', '>', Carbon::now()->subDays($summary_of))
            ->orderBy('total_expense','desc')
            ->first();

            $total_spent = Expense::whereDate('created_at', '>', Carbon::now()->subDays($summary_of))->sum('amount');
            $total_no_transaction = Expense::whereDate('created_at', '>', Carbon::now()->subDays($summary_of))->count();
            $total_no_member = Expense::whereDate('created_at', '>', Carbon::now()->subDays($summary_of))->groupBy('member_id')->get()->count();

            $data['summary_of'] = $summary_of;
            $data['total_spent'] = $total_spent;
            $data['total_no_transaction'] = $total_no_transaction;
            $data['total_no_member'] = $total_no_member;
            $data['highest_expense_by'] = $getHighestExpenseMember->member ? $getHighestExpenseMember->member->full_name : null;
            $data['highest_expense_amount'] = $getHighestExpenseMember->member ? $getHighestExpenseMember->total_expense : null;
            return Helper::rj('Summary', 200, $data);
        } catch (Exception $e) {
			return Helper::rj($e->getMessage(), 500);
		}
    }
}
