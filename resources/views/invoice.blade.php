@extends('layout.app')

@section('content')
    <!-- MAIN CONTENT -->
    <div class="main-content">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-12">
                    <!-- Tab content -->
                    <div class="tab-content">
                        <div class="tab-pane fade show active" role="tabpanel" aria-labelledby="companiesListTab">

                            <div class="card">
                                <div class="pl-3">
                                    <div class="tableHeadr">

                                        <div class="row align-items-center">
                                            <div class="col">
                                                <form action="{{ url('pay-approval', $pay->id) }}" method="POST">
                                                    @csrf
                                                    <div class="d-flex flex-wrap justify-content-around mx-3">
                                                        <div class="mr-2">
                                                            <h4 class="header-pretitle ml-3">
                                                                Employee Name
                                                            </h4>
                                                            <h3 class="header-title text-truncate ml-3">
                                                                {{ $pay->employee->name }}
                                                            </h3>
                                                        </div>
                                                        <div class="mr-2">
                                                            <h4 class="header-pretitle ml-3">
                                                                Pay Period
                                                            </h4>
                                                            <h3 class="header-title text-truncate ml-3">
                                                                {{ $pay->payperiod->period }}
                                                            </h3>
                                                        </div>
                                                        <div class="mr-2">
                                                            <h4 class="header-pretitle ml-3">
                                                                Date
                                                            </h4>
                                                            <h3 class="header-title text-truncate ml-3">

                                                                {{ $pay->date }}
                                                            </h3>
                                                        </div>
                                                        <div class="mr-2">
                                                            <h4 class="header-pretitle ml-3">
                                                                Year
                                                            </h4>
                                                            <h3 class="header-title text-truncate ml-3">

                                                                {{ $pay->year }}
                                                            </h3>
                                                        </div>
                                                        @if (auth()->user()->role == 'admin')
                                                            <div class="mr-2">
                                                                <h4 class="header-pretitle ml-3">
                                                                    Status
                                                                </h4>
                                                                <select name="status" id="" class="form-select">
                                                                    @if ($pay->status == 'Pending')
                                                                        <option>Select Status</option>
                                                                        <option value="Approved">Approve</option>
                                                                        <option value="Returned">Decline</option>
                                                                    @elseif($pay->status == 'Approved')
                                                                        <option value="Approved">Approved</option>
                                                                        <option value="Returned">Decline</option>
                                                                    @else
                                                                        <option value="Returned">Declined</option>
                                                                        <option value="Approved">Approve</option>
                                                                    @endif

                                                                </select>

                                                            </div>
                                                            <div class="mr-2">
                                                                <h4 class="header-pretitle ml-3">
                                                                    `
                                                                </h4>
                                                                <button class="btn btn-primary"
                                                                    type="submit">Submit</button>

                                                            </div>
                                                        @endif
                                                    </div>
                                                    <div class="d-flex flex-wrap justify-content-start mx-5">
                                                        <h4 class="header-pretitle ml-3"> Total Selected: <span
                                                                id="total"></span></h4>
                                                    </div>


                                            </div>

                                        </div> <!-- / .row -->
                                    </div>
                                </div>
                            </div>
                            <!-- Card -->
                            <div class="card" id="companiesList">
                                <!-- Header -->
                                @if (session('status'))
                                    <div class="text-light border border-success bg-success my-3 p-3 rounded text-center">
                                        {{ session('status') }}
                                    </div>
                                    <br>
                                @endif
                                @if (session('error'))
                                    <div class="text-light border border-danger bg-danger my-3 p-3 rounded text-center">
                                        {{ session('error') }}
                                    </div>
                                    <br>
                                @endif

                                <div class="tabs">
                                    <div class=" active">

                                        <div class="table-responsive">
                                            <table class="table table-sm  table-nowrap card-table" id="myTable">
                                                <thead>
                                                    <tr>
                                                        @if (auth()->user()->role == 'admin')
                                                            <th>
                                                                <input type="checkbox" id="checkAll"> Check All
                                                            </th>
                                                        @endif
                                                        <th>
                                                            <a href="#" class="text-muted">Date</a>
                                                        </th>
                                                        <th>
                                                            <a class=" text-muted" href="#">Time</a>
                                                        </th>
                                                        <th>
                                                            <a class="text-muted">Patient</a>
                                                        </th>
                                                        <th>
                                                            <a class="text-muted">Visit Type</a>
                                                        </th>
                                                        <th>
                                                            <a class="text-muted">Visit Rate</a>
                                                        </th>
                                                        <th>
                                                            <a class="text-muted">Miles</a>
                                                        </th>
                                                        <th>
                                                            <a class="text-muted">Adj. Miles</a>
                                                        </th>
                                                        <th>
                                                            <a class="text-muted">$Service</a>
                                                        </th>

                                                        <th><a class="text-muted">Signature</a></th>
                                                        <th>
                                                            <a class="text-muted">Status</a>
                                                        </th>
                                                        <th>
                                                            <a class="text-muted">Date Created</a>
                                                        </th>
                                                        <th></th>
                                                    </tr>
                                                </thead>
                                                <tbody class="list font-size-base">
                                                    <input type="text" name="pid" id="payId" hidden>
                                                    @foreach ($pays as $key => $paid)
                                                        <tr
                                                            @if ($paid->status == 'Pending') style="background-color: rgb(201, 199, 199);" @endif>
                                                            @if (auth()->user()->role == 'admin')
                                                                <td>
                                                                    <input type="checkbox" id="checkItem"
                                                                        value="{{ $paid->amount }}"
                                                                        placeholder="{{ $paid->id }}"
                                                                        onchange='handleChange(this);'>
                                                                </td>
                                                            @endif

                                                            <td>
                                                                <!-- Text -->
                                                                <span>{{ $paid->visit_date }}</span>

                                                            </td>
                                                            <td>
                                                                <span>{{ $paid->time }}</span>
                                                            </td>

                                                            <td>
                                                                <span>{{ $paid->patient->name }}</span>
                                                            </td>
                                                            <td>
                                                                <span>{{ $paid->userRate->rate->name }}</span>
                                                            </td>
                                                            <td>
                                                                <span>${{ $paid->userRate->amount }}</span>
                                                            </td>
                                                            <td>
                                                                <span>{{ round($paid->miles, 2) }}</span>
                                                            </td>
                                                            <td>
                                                                <span>{{ round($paid->adj_miles, 2) }}</span>
                                                            </td>
                                                            <td>
                                                                <span>${{ $paid->amount }}</span>
                                                            </td>
                                                            <td>
                                                                @if ($paid->signature)
                                                                    <a href="uploads/{{ $paid->signature }}">Uploaded</a>
                                                                @else
                                                                    <span>Digital</span>
                                                                @endif
                                                            </td>
                                                            <td>
                                                                <span>{{ $paid->status }}</span>
                                                            </td>
                                                            <td>
                                                                <span>{{ $paid->updated_at->format('M d Y') }}</span>
                                                            </td>

                                                            <td>
                                                                <span>
                                                                    <a href="#"
                                                                        data-target="#edit_partner{{ $key }}"
                                                                        data-toggle="modal">
                                                                        <i class="fe fe-edit-3"></i>
                                                                    </a>
                                                                </span>
                                                            </td>
                                                            <td>
                                                                <span>
                                                                    <a href="{{ url('delete-pay-record', $paid->id) }}">
                                                                        <button type="button" class="editbtn"><i
                                                                                class="fe fe-trash"></i></button></a>
                                                                </span>
                                                            </td>
                                                            </form>

                                                            <div class="modal fade " id="edit_partner{{ $key }}"
                                                                tabindex="-1" role="dialog" aria-hidden="true">
                                                                <div class="modal-dialog modal-dialog-centered editMembers"
                                                                    role="document">
                                                                    <div class="modal-content editMembers">
                                                                        <div class="card-header">

                                                                            <!-- Title -->
                                                                            <h2 class="card-header-title">
                                                                                Edit Pay Record
                                                                            </h2>

                                                                            <!-- Close -->
                                                                            <button type="button" class="close"
                                                                                data-dismiss="modal" aria-label="Close">
                                                                                <span aria-hidden="true">&times;</span>
                                                                            </button>

                                                                        </div>
                                                                        <div class="card-body editMembers">
                                                                            <form method="POST"
                                                                                action="{{ url('update-pay-record', $paid->id) }}">
                                                                                @csrf
                                                                                <div class="row g-3">
                                                                                    <div class="col-12 col-md-6 mb-3">
                                                                                        <label class="form-label">Patient
                                                                                            Name</label>
                                                                                        <input type="text"
                                                                                            class="form-control"
                                                                                            name="patient" id="patient"
                                                                                            value="{{ $paid->patient->name }}"
                                                                                            readonly>
                                                                                        <input type="text"
                                                                                            name="id" id="id"
                                                                                            value="{{ $paid->id }}"
                                                                                            hidden>

                                                                                    </div>
                                                                                    <div class="col-12 col-md-6 mb-3">
                                                                                        <label
                                                                                            class="form-label">Date</label>
                                                                                        <input type="date"
                                                                                            class="form-control "
                                                                                            name="visit_date"
                                                                                            id="visit_date"
                                                                                            value="{{ $paid->visit_date }}"
                                                                                            required>

                                                                                    </div>
                                                                                    <div class="col-12 col-md-6 mb-3">
                                                                                        <label
                                                                                            class="form-label">Time</label>
                                                                                        <input type="time"
                                                                                            class="form-control "
                                                                                            name="time" id="time"
                                                                                            value="{{ $paid->time }}"
                                                                                            required>

                                                                                    </div>
                                                                                    @php
                                                                                        $visits = \App\Models\UserRate::with('rate')
                                                                                            ->where('emp_id', $emp_id)
                                                                                            ->get();
                                                                                        $rate = \App\Models\UserRate::findOrFail($paid->user_rate_id);
                                                                                    @endphp
                                                                                    <div class="col-12 col-md-6 mb-3">
                                                                                        <label class="form-label">Visit
                                                                                            Type</label>
                                                                                        <select name="user_rate_id"
                                                                                            class="form-select"
                                                                                            data-choices name="emp_visit"
                                                                                            id="visit_types">

                                                                                            @foreach ($visits as $item)
                                                                                                <option
                                                                                                    value="{{ $item->id }}"
                                                                                                    {{ $paid->user_rate_id == $item->id ? 'selected' : '' }}
                                                                                                    data-price="{{ $item->amount }}">
                                                                                                    {{ $item->rate->name }}
                                                                                                </option>
                                                                                            @endforeach
                                                                                        </select>

                                                                                    </div>
                                                                                    <div class="col-12 col-md-6 mb-3">
                                                                                        <label class="form-label">Visit
                                                                                            Rate</label>
                                                                                        <input type="text"
                                                                                            name="visit_rate"
                                                                                            class="form-control"
                                                                                            id="visitRates"
                                                                                            value="{{ $rate->amount }}"
                                                                                            readonly>

                                                                                    </div>
                                                                                    <div class="col-12 col-md-6 mb-3">
                                                                                        <label
                                                                                            class="form-label">Adjustment
                                                                                            Miles</label>
                                                                                        <input type="text"
                                                                                            name="adj_miles"
                                                                                            value="{{ $paid->adj_miles }}"
                                                                                            class="form-control">

                                                                                    </div>
                                                                                </div>


                                                                                <button type="submit" id='save'
                                                                                    class="btn btn-primary d-none">
                                                                                    Save
                                                                                </button>

                                                                                <div class="col-auto">
                                                                                    <!-- Button -->
                                                                                    <button type="submit" id='saveBtn'
                                                                                        class="btn btn-primary ml-2 addemployeModalBtn employeeBtn">
                                                                                        Save
                                                                                    </button>
                                                                                </div>


                                                                            </form>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                            {!! $pays->links() !!}
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <div class="row">
                                        <div class="col">Total Approved Patients: {{ $app_pat }}<br>
                                            $Total Approved Service: ${{ $app_rates }}<br>
                                            $Total Approved Mileage: ${{ round($app_miles, 2) }}</div>

                                        <div class="col">Total Pending Patients: {{ $pen_pat }}<br>
                                            $Total Pending Service: ${{ $pen_rates }}<br>
                                            $Total Pending Mileage: ${{ round($pen_miles, 2) }}</div>


                                        <div class="col">Overall Patients: {{ $pay->no_patients }}<br>
                                            Overall Visits: {{ $pay->no_visits }}<br>
                                            $Overall Mileage: ${{ round($pay->total_amount, 2) }}</div>
                                    </div>
                                </div>
                            </div>


                        </div>

                    </div>

                </div>
            </div> <!-- / .row -->

        </div>

    </div>

    </div> <!-- / .main-content -->
@endsection
<script>
    function handleChange(checkbox) {
        var arr = [];

        const checkedInputs = document.querySelectorAll("#myTable input:checked");
        const total = Array.from(checkedInputs).reduce(function(total, cb) {

            return total + +cb.value;
        }, 0);
        for (var i = 0; i < checkedInputs.length; i++) {
            arr.push(checkedInputs[i].getAttribute('placeholder'));
        }
        // console.log(arr);
        document.getElementById('payId').value = arr;

        document.getElementById("total").innerHTML = total.toFixed(2);
    }
</script>
