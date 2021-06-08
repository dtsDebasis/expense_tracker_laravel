@extends('layouts.web')

@section('content')
  <div class="container" style="margin: 2em auto">
    <div class="row">
      <div class="col-lg-6">
        <h1>Team</h1>
      </div>
      <div class="col-lg-6" style="text-align: right">
        <button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#team" aria-expanded="false"
          aria-controls="collapseExample">
          Add Teammate
        </button>
      </div>
    </div>
    <div class="collapse" id="team" style="margin-top: 1em">
      <div class="card card-body">
        <form>
          <div class="row">
            <div class="col-lg-3">
              <div class="form-group">
                <label for="exampleInputEmail1">First Name</label>
                <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
              </div>
            </div>
            <div class="col-lg-3">
              <div class="form-group">
                <label for="exampleInputPassword1">Last Name</label>
                <input type="text" class="form-control" id="exampleInputPassword1">
              </div>
            </div>
            <div class="col-lg-3">
              <div class="form-group">
                <label for="exampleInputPassword1">Email</label>
                <input type="email" class="form-control" id="exampleInputPassword1">
              </div>
            </div>
            <div class="col-lg-3">
              <label for="exampleInputPassword1">&nbsp;</label>
              <button type="submit" class="btn btn-primary btn-block">Add</button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>



  <div class="container">
    <div class="row">
      <div class="col-lg-12">
        <div class="list-group">
          <a href="#" class="list-group-item list-group-item-action flex-column align-items-start">
            <div class="d-flex w-100 justify-content-between">
              <h5 class="mb-1">Amit Sharma</h5>
              <small>last expense: 3 days ago</small>
            </div>
            <small>Amit should receive Rs.400</small>
          </a>

          <a href="#" class="list-group-item list-group-item-action flex-column align-items-start">
            <div class="d-flex w-100 justify-content-between">
              <h5 class="mb-1">Kunal Tiwari</h5>
              <small>last expense: 6 days ago</small>
            </div>
            <small>Kunal has to pay Rs.250</small>
          </a>

          <a href="#" class="list-group-item list-group-item-action flex-column align-items-start">
            <div class="d-flex w-100 justify-content-between">
              <h5 class="mb-1">Raman Mishra</h5>
              <small>last expense: 6 days ago</small>
            </div>
            <small>Raman has to pay Rs.150</small>
          </a>

        </div>
      </div>
    </div>
  </div>
@endsection

@push('scripts')
<script src="{{asset('js/team.js')}}"></script>
@endpush
