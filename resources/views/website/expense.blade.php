@extends('layouts.web')

@section('content')
  <div class="container" style="margin:2em auto">
    <div class="row">
      <div class="col-lg-6">
        <h1>Team Expenses</h1>
      </div>
      <div class="col-lg-6" style="text-align: right">
        <button class="btn btn-primary add_btn" type="button" data-toggle="collapse" data-target="#expense"
          aria-expanded="false" aria-controls="collapseExample">
          Add an Expense
        </button>
      </div>
    </div>
    <div class="collapse" id="expense" style="margin-top: 1em">
      <div class="card card-body">
        <form name="expense_form" id="expense_form" method="POST" action="">
          <input type="hidden" class="form-control" name="id" id="edit_id">
          <div class="row">
            <div class="col-lg-4">
              <div class="form-group">
                <label for="exampleInputEmail1">Select User</label>
                <select class="form-control" name="member_id" id="member_id" required>
                  <option value="">Select user</option>
                   @foreach ($members as $member)

                     <option value="{{$member->id}}">{{$member->full_name}}</option>
                   @endforeach
                </select>
              </div>
            </div>
            <div class="col-lg-4">
              <div class="form-group">
                <label for="amount">Expense Amount</label>
                <input type="number" name="amount" class="form-control" id="amount" placeholder="Amount" required>
              </div>
            </div>
            <div class="col-lg-4">
              <label for="exampleInputPassword1">&nbsp;</label>
              <button type="submit" class="btn btn-primary btn-block">Submit</button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
  <div class="container">
    <table class="table table-hover">
      <thead>
        <tr>
          <th scope="col">#</th>
          <th scope="col">Expense by</th>
          {{-- <th scope="col">Date</th> --}}
          <th scope="col">Amount</th>
          <th scope="col">Actions</th>
        </tr>
      </thead>
      <tbody class="team-list">

      </tbody>
    </table>
  </div>
@endsection

@push('scripts')
<script src="{{asset('js/expense.js')}}"></script>
@endpush
