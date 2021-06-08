@extends('layouts.web')

@section('content')
  <div class="container" style="margin:2em auto">
    <div class="row">
      <div class="col-lg-6">
        <h1>Team Expenses</h1>
      </div>
      <div class="col-lg-6" style="text-align: right">
        <button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#expense"
          aria-expanded="false" aria-controls="collapseExample">
          Add an Expense
        </button>
      </div>
    </div>
    <div class="collapse" id="expense" style="margin-top: 1em">
      <div class="card card-body">
        <form>
          <div class="row">
            <div class="col-lg-3">
              <div class="form-group">
                <label for="exampleInputEmail1">Select User</label>
                <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"
                  placeholder="Enter email">
              </div>
            </div>
            <div class="col-lg-3">
              <div class="form-group">
                <label for="exampleInputPassword1">Expense Date</label>
                <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
              </div>
            </div>
            <div class="col-lg-3">
              <div class="form-group">
                <label for="exampleInputPassword1">Expense Amount</label>
                <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
              </div>
            </div>
            <div class="col-lg-3">
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
          <th scope="col">Date</th>
          <th scope="col">Amount</th>
          <th scope="col">Actions</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <th scope="row">1</th>
          <td>Amit Sharma</td>
          <td>28/11/2020 8:32pm</td>
          <td>Rs.120</td>
          <td><button type="button" class="btn btn-light">Edit</button></td>
        </tr>
        <tr>
          <th scope="row">2</th>
          <td>Kunal Tiwari</td>
          <td>30/11/2020 9:30am</td>
          <td>Rs.240</td>
          <td><button type="button" class="btn btn-light">Edit</button></td>
        </tr>
        <tr>
          <th scope="row">3</th>
          <td>Raman Mishra</td>
          <td>30/11/2020 1:40pm</td>
          <td>Rs.560</td>
          <td><button type="button" class="btn btn-light">Edit</button></td>

        </tr>
        <tr>
          <th scope="row">4</th>
          <td>Amit Sharma</td>
          <td>28/11/2020 8:32pm</td>
          <td>Rs.120</td>
          <td><button type="button" class="btn btn-light">Edit</button></td>

        </tr>
        <tr>
          <th scope="row">5</th>
          <td>Kunal Tiwari</td>
          <td>30/11/2020 9:30am</td>
          <td>Rs.240</td>
          <td><button type="button" class="btn btn-light">Edit</button></td>

        </tr>
        <tr>
          <th scope="row">6</th>
          <td>Raman Mishra</td>
          <td>30/11/2020 1:40pm</td>
          <td>Rs.560</td>
          <td><button type="button" class="btn btn-light">Edit</button></td>
        </tr>
      </tbody>
    </table>
  </div>
@endsection

@push('scripts')
<script src="{{asset('js/expense.js')}}"></script>
@endpush
