<?php

namespace App\Http\Controllers\Api;

use Exception;
use Validator;
use App\Models\Member;
use App\Helpers\Helper;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MemberApiController extends Controller
{
    /*
      Route : http://127.0.0.1:8000/api/v1/member_list
      Details : Get All Member List
      Author : Debasis Chaktaborty
      Last Modified By : Debasis Chaktaborty
      Created On : 7th June,2021
      Last Work : 7th June,2021
    */
    public function member_list(Request $request)
    {
        try {
           $members = Member::orderBy('id','desc')->get()->makeHidden(['splits']);
           return Helper::rj('members', 200, $members);
        } catch (Exception $e) {
			return Helper::rj($e->getMessage(), 500);
		}
    }
    /*
      Route : http://127.0.0.1:8000/api/v1/member_add
      Details : Add new member
      Author : Debasis Chaktaborty
      Last Modified By : Debasis Chaktaborty
      Created On : 7th June,2021
      Last Work : 7th June,2021
    */
    public function member_add(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'first_name'=> 'required',
                'last_name'=> 'required',
                'email'=> 'required|email|unique:members',
            ]);

            if ($validator->fails()) {
                return Helper::rj('Validation Error', 422, $validator->errors());
            }

            $member = Member::create($request->all());

            if ($member) {
                return Helper::rj('New Member Created', 201, $member);
            }

            return Helper::rj('Something Bad happened', 400, []);
        } catch (Exception $e) {
			return Helper::rj($e->getMessage(), 500);
		}
    }
    /*
      Route : http://127.0.0.1:8000/api/v1/member_update
      Details : Update member
      Author : Debasis Chaktaborty
      Last Modified By : Debasis Chaktaborty
      Created On : 7th June,2021
      Last Work : 7th June,2021
    */
    public function member_update(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'id'=> 'required',
                'first_name'=> 'required',
                'last_name'=> 'required',
                'email'=> 'required|email|unique:members,email,'.$request->id
            ]);

            if ($validator->fails()) {
                return Helper::rj('Validation Error', 422, $validator->errors());
            }

            $member = Member::find($request->id)->update($request->all());

            if ($member) {
                return Helper::rj('Member Updated', 200, $member);
            }

            return Helper::rj('Something Bad happened', 400, []);
        } catch (Exception $e) {
			return Helper::rj($e->getMessage(), 500);
		}
    }
}
