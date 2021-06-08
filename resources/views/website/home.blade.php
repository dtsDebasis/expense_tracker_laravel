@extends('layouts.web')

@section('content')

<div class="jumbotron jumbotron-fluid">
    <div class="container" style="text-align: center">
        <h1 class="display-4">Rs.4,500 spent in 42 transactions</h1>
        <p class="lead" style="max-width: 650px; margin: 1.5em auto 0">3 team mates have spend Rs.4,500 in the last
            31 days with 42 transactions. Team mate with most spending is Amit Sharma with Rs.1,250 spent.</p>
    </div>
</div>
<div class="container">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="card-title">
                        <h3>Cobold's Laravel Assignment</h3>
                    </div>
                    <div class="card-text">
                        <p>
                            The assignment is pretty straightforward. You need to make these three html pages
                            dynamic. On the Team page, user should be able to add and edit team members. Edit team
                            member form should show like add team member when clicking on the list item.
                        </p>
                        <p>
                            In Expenses, user should be able to add and edit expenses made by team members. If the
                            amount entered is 0 in any transaction while editing, the row should be removed from the
                            ledger. The ledger should be shown Chronologically, in descending order.
                        </p>
                        <p>
                            On the index.html page, the system should show who owes what amount based on the number
                            of users. We can assume that all expenses are to be equally divided among all team
                            mates.
                        </p>
                        <p>
                            <b>
                                Bonus, Optional: Special Use Case. Think of what happens when some expenses are
                                added in the system but a new team mate is added. It is not fair to divide the older
                                transactions with the new team mate. What will you do to ensure we get the right
                                amount for all teammates fairly.
                            </b>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="container" style="margin: 2em auto">
    <div class="row">
        <div class="col-lg-12" style="margin: 1em 0;">
            <h2>Amit Sharma</h2>
            <ul class="list-group">
                <li class="list-group-item bg-success text-white">Raman Mishra will pay Amit Rs.150</li>
                <li class="list-group-item bg-success text-white">Kunal Tiwari will pay Amit Rs.250</li>
            </ul>
        </div>
        <div class="col-lg-12" style="margin: 1em 0;">
            <h2>Raman Mishra</h2>
            <ul class="list-group">
                <li class="list-group-item bg-danger text-white">Amit Sharma will receive Rs.150 from Raman</li>
                <li class="list-group-item bg-success text-white">Kunal Tiwari will pay Raman Rs.180</li>
            </ul>
        </div>
        <div class="col-lg-12" style="margin: 1em 0;">
            <h2>Kunal Tiwari</h2>
            <ul class="list-group">
                <li class="list-group-item bg-danger text-white">Raman Mishra will receive Rs.180 from Kunal</li>
                <li class="list-group-item bg-danger text-white">Amit Mishra will receive Rs.250 from Kunal</li>
            </ul>
        </div>
    </div>
</div>

@endsection

@push('scripts')

@endpush
