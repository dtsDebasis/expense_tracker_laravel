@extends('layouts.web')

@section('content')
  <div class="container" style="margin: 2em auto">
    <div class="row">
      <div class="col-lg-6">
        <h1>Team</h1>
      </div>
      <div class="col-lg-6" style="text-align: right">
        <button class="btn btn-primary add_btn" type="button" data-toggle="collapse" data-target="#team" aria-expanded="false"
          aria-controls="collapseExample">
          Add Teammate
        </button>
      </div>
    </div>
    <div class="collapse" id="team" style="margin-top: 1em">
      <div class="card card-body">
      <div class="alert alert-danger error-msg" role="alert">
         This email is already taken or you entered some wrong data
       </div>
        <form id="team_mate" name="team_mate_form" method="POST" action="">
          <input type="hidden" class="form-control" name="id" id="edit_id">

          <div class="row">
            <div class="col-lg-3">
              <div class="form-group">
                <label for="first_name">First Name</label>
                <input type="text" class="form-control" name="first_name" id="first_name" aria-describedby="emailHelp" required>
              </div>
            </div>
            <div class="col-lg-3">
              <div class="form-group">
                <label for="last_name">Last Name</label>
                <input type="text" class="form-control" name="last_name" id="last_name" required>
              </div>
            </div>
            <div class="col-lg-3">
              <div class="form-group">
                <label for="email">Email</label>
                <input type="email" class="form-control" name="email" id="email" required>
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
        <div class="list-group team-list">

          {{-- <a href="#" class="list-group-item list-group-item-action flex-column align-items-start">
            <div class="d-flex w-100 justify-content-between">
              <h5 class="mb-1">Amit Sharma</h5>
              <small>last expense: 3 days ago</small>
            </div>
            <small>Kunal has to pay Rs.250</small>
            <small>Amit should receive Rs.400</small>
          </a> --}}

        </div>
      </div>
    </div>
  </div>
@endsection

@push('scripts')
<script src="{{asset('js/team.js')}}"></script>
@endpush
