@extends('layout.app')

<style>
    .nav-link {
        colour: yellow !important;
    }
</style>

@section('content')
    <!-- MAIN CONTENT -->
    <div class="main-content">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-12">
                    <!-- Tab content -->
                    <div class="tab-content">
                        <div class="tab-pane fade show active" id="companiesListPane" role="tabpanel"
                            aria-labelledby="companiesListTab">

                            <div class="card">
                                <div class="pl-3">
                                    <div class="tableHeadr">

                                        <div class="row align-items-center">
                                            <div class="col">
                                                <!-- Title -->
                                                <div class="d-flex flex-wrap justify-content-around">
                                                    <div class="mr-2">
                                                        <h4 class="header-pretitle ml-3">
                                                            Employee Name
                                                        </h4>
                                                        <h3 class="header-title text-truncate ml-3">
                                                            {{ auth()->user()->name }}
                                                        </h3>
                                                    </div>
                                                    <div class="mr-2">
                                                        <h4 class="header-pretitle ml-3">
                                                            Employment
                                                        </h4>
                                                        <h3 class="header-title text-truncate ml-3">
                                                            {{ $employee->emp_type }}
                                                        </h3>
                                                    </div>
                                                    <div class="mr-2">
                                                        <h4 class="header-pretitle ml-3">
                                                            Date of Hire
                                                        </h4>
                                                        <h3 class="header-title text-truncate ml-3">
                                                            {{ $employee->date }}
                                                        </h3>
                                                    </div>
                                                    <div class="mr-2">
                                                        <h4 class="header-pretitle ml-3">
                                                            Rates
                                                        </h4>
                                                        <select class="form-select text-truncate ml-3">
                                                            @php
                                                                $visits = \App\Models\Rate::get();
                                                            @endphp
                                                            @foreach (json_decode($employee->visit_rate) as $visit)
                                                                @foreach ($visits as $item)
                                                                    @if ($item->id == $visit)
                                                                        <option value="">{{ $item->name }}</option>
                                                                    @endif
                                                                @endforeach
                                                            @endforeach

                                                        </select>
                                                    </div>
                                                    <div class="mr-2">
                                                        <a class="btn btn-primary employeeBtn mt-3"
                                                            href="{{ route('auth.employee.enter.pay') }}">
                                                            Enter pay summary
                                                        </a>
                                                    </div>
                                                </div>


                                            </div>

                                        </div> <!-- / .row -->
                                    </div>
                                </div>
                            </div>
                            <!-- Card -->
                            <div class="card" id="companiesList">
                                <!-- Header -->
                                @if (session('statusreg'))
                                    <div class="text-light border border-success bg-success my-3 p-3 rounded text-center">
                                        {{ session('statusreg') }}
                                    </div>
                                    <br>
                                @endif

                                <div class="tabs">

                                    <div class="row align-items-center">
                                        <div class="col" id="employeeProfile1">
                                            <ul class="nav nav-tabs  ml-4 mr-4" id="tabSwitch">
                                                <li class="nav-item">
                                                    <a href="#Submitted" class="nav-link ">
                                                        <span>
                                                            Submitted
                                                        </span>
                                                    </a>
                                                </li>
                                                <li class="nav-item">
                                                    <a href="#Returned" class="nav-link ">
                                                        <span>
                                                            Returned
                                                        </span>
                                                    </a>
                                                </li>
                                                <li class="nav-item">
                                                    <a href="#Approved" class="nav-link">
                                                        <span>
                                                            Approved
                                                        </span>
                                                    </a>
                                                </li>

                                            </ul>
                                        </div>
                                        <div class="col-auto">
                                            <form action="" method="GET">
                                                @csrf
                                                <div class="d-flex my-3">

                                                    <div class="mx-3">
                                                        <select class="form-select mb-3" data-choices name="status">
                                                            <option value="Pending"
                                                                {{ $status == 'Pending' ? 'selected' : '' }}>Pending
                                                            </option>
                                                            <option value="Approved"
                                                                {{ $status == 'Approved' ? 'selected' : '' }}>
                                                                Approved
                                                            </option>
                                                            <option value="Returned"
                                                                {{ $status == 'Returned' ? 'selected' : '' }}>
                                                                Returned
                                                            </option>
                                                        </select>
                                                    </div>
                                                    <div class="mx-3">
                                                        @php
                                                            $years = \App\Models\PayReport::select('year')
                                                                ->where('emp_id', $employee->id)
                                                                ->distinct()
                                                                ->get();
                                                            $yr = date('Y');
                                                        @endphp
                                                        <select class="form-select mb-3" name="year" data-choices>
                                                            <option
                                                                value="{{ $yr }} {{ $yr == $year ? 'selected' : '' }}">
                                                                {{ $yr }}
                                                            </option>
                                                            @foreach ($years as $item)
                                                                @if ($item->year != $yr)
                                                                    <option value="{{ $item->year }}"
                                                                        {{ $item->year == $year ? 'selected' : '' }}>
                                                                        {{ $item->year }}</option>
                                                                @endif
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="mx-3">
                                                        <button id="filter" class="btn btn-primary "
                                                            type="submit">Filter</button>

                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>

                                    <div id="Approved" class="tab active">

                                        <div class="table-responsive">
                                            <table class="table table-sm  table-nowrap card-table" id="approvedTable">
                                                <thead>
                                                    <tr>
                                                        <th>
                                                            <a class=" text-muted" href="#">Invoice #</a>
                                                        </th>
                                                        <th>
                                                            <a href="#" class="text-muted">Date</a>
                                                        </th>
                                                        <th>
                                                            <a class="text-muted">Pay Period</a>
                                                        </th>
                                                        <th>
                                                            <a class="text-muted">Total Miles</a>
                                                        </th>
                                                        <th>
                                                            <a class="text-muted">Total $miles</a>
                                                        </th>
                                                        <th>
                                                            <a class="text-muted">Total Visit Rate</a>
                                                        </th>
                                                        <th>
                                                            <a class="text-muted">Total Patients</a>
                                                        </th>
                                                        <th>
                                                            <a class="text-muted">Total Visit </a>
                                                        </th>
                                                        <th>
                                                            <a class="text-muted">Status</a>
                                                        </th>
                                                        <th></th>
                                                    </tr>
                                                </thead>
                                                <tbody class="list font-size-base">
                                                    @if ($paysummaries->count() == 0)
                                                        <div class="mx-4">
                                                            <h3>No data available</h3>
                                                        </div>
                                                    @else
                                                        @foreach ($paysummaries->where('status', 'Approved') as $key => $pay)
                                                            @php
                                                                $totals = \App\Models\DailyPay::select('user_rate_id')
                                                                    ->where('emp_id', $pay->emp_id)
                                                                    ->where('pay_period_id', $pay->pay_period)
                                                                    ->get();
                                                                $rates = \App\Models\UserRate::where('emp_id', $pay->emp_id)->get();
                                                                $visit = [];
                                                                foreach ($rates as $key => $rate) {
                                                                    foreach ($totals as $key => $total) {
                                                                        if ($rate->id == $total->user_rate_id) {
                                                                            $visit[] = $rate->amount;
                                                                        }
                                                                    }
                                                                }
                                                                $visit = array_sum($visit);
                                                            @endphp
                                                            <tr>
                                                                <td>
                                                                    <!-- Text -->
                                                                    <span>{{ $pay->invoice }}</span>

                                                                </td>
                                                                <td>
                                                                    <span>{{ $pay->date }}</span>
                                                                </td>

                                                                <td>
                                                                    <span>{{ $pay->payperiod->period }}</span>
                                                                </td>
                                                                <td>
                                                                    <span>{{ round($pay->total_miles, 2) }}</span>
                                                                </td>
                                                                <td>
                                                                    <span>${{ round($pay->total_amount, 2) }}</span>
                                                                </td>
                                                                <td>
                                                                    <span>${{ round($visit, 2) }}</span>
                                                                </td>
                                                                <td>
                                                                    <span>{{ $pay->no_patients }}</span>
                                                                </td>
                                                                <td>
                                                                    <span>{{ $pay->no_visits }}</span>
                                                                </td>
                                                                <td>
                                                                    <span>
                                                                        <button
                                                                            class="@if ($pay->status == 'Approved') btn btn-outline-success @elseif ($pay->status == 'Declined') btn btn-outline-danger @else btn btn-outline-warning @endif">{{ $pay->status }}</button>
                                                                    </span>
                                                                </td>
                                                                <td>
                                                                    <a href="{{ url('invoice', $pay->id) }}">
                                                                        <i class="fe fe-eye"></i></a>
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                    @endif
                                                </tbody>

                                            </table>
                                            {!! $paysummaries->links() !!}
                                        </div>

                                        <div class="card-footer ">

                                            <!-- Pagination (prev) -->
                                            <div class="d-flex justify-content-between">
                                                <ul class="list-pagination-prev pagination pagination-tabs card-pagination">
                                                    <li class="page-item">
                                                        <a class="page-link pl-0 pr-4 border-right" href="#">
                                                            <i class="fe fe-arrow-left mr-1"></i> Prev
                                                        </a>
                                                    </li>
                                                </ul>

                                                <!-- Pagination -->
                                                <ul class="list-pagination pagination pagination-tabs card-pagination">
                                                </ul>

                                                <!-- Pagination (next) -->
                                                <ul class="list-pagination-next pagination pagination-tabs card-pagination">
                                                    <li class="page-item">
                                                        <a class="page-link pl-4 pr-0 border-left" href="#">
                                                            Next <i class="fe fe-arrow-right ml-1"></i>
                                                        </a>
                                                    </li>
                                                </ul>
                                            </div>

                                        </div>
                                    </div>
                                    <div id="Returned" class="tab">
                                        <div class="table-responsive">
                                            <table class="table table-sm  table-nowrap card-table" id="returnedTable">
                                                <thead>
                                                    <tr>
                                                        <th>
                                                            <a class=" text-muted" href="#">Invoice #</a>
                                                        </th>
                                                        <th>
                                                            <a href="#" class="text-muted">Date</a>
                                                        </th>
                                                        <th>
                                                            <a class="text-muted">Pay Period</a>
                                                        </th>
                                                        <th>
                                                            <a class="text-muted">Total Miles</a>
                                                        </th>
                                                        <th>
                                                            <a class="text-muted">Total $miles</a>
                                                        </th>
                                                        <th>
                                                            <a class="text-muted">Total Visit Rate</a>
                                                        </th>
                                                        <th>
                                                            <a class="text-muted">Total Patients</a>
                                                        </th>
                                                        <th>
                                                            <a class="text-muted">Total Visit </a>
                                                        </th>
                                                        <th>
                                                            <a class="text-muted">Status</a>
                                                        </th>
                                                        <th></th>
                                                    </tr>
                                                </thead>
                                                <tbody class="list font-size-base">
                                                    @if ($paysummaries->count() == 0)
                                                        <div class="mx-4">
                                                            <h3>No data available</h3>
                                                        </div>
                                                    @else
                                                        @foreach ($paysummaries->where('status', 'Returned') as $key => $pay)
                                                            @php
                                                                $totals = \App\Models\DailyPay::select('user_rate_id')
                                                                    ->where('emp_id', $pay->emp_id)
                                                                    ->where('pay_period_id', $pay->pay_period)
                                                                    ->get();
                                                                $rates = \App\Models\UserRate::where('emp_id', $pay->emp_id)->get();
                                                                $visit = [];
                                                                foreach ($rates as $key => $rate) {
                                                                    foreach ($totals as $key => $total) {
                                                                        if ($rate->id == $total->user_rate_id) {
                                                                            $visit[] = $rate->amount;
                                                                        }
                                                                    }
                                                                }
                                                                $visit = array_sum($visit);
                                                            @endphp
                                                            <tr>
                                                                <td>
                                                                    <!-- Text -->
                                                                    <span>{{ $pay->invoice }}</span>

                                                                </td>
                                                                <td>
                                                                    <span>{{ $pay->date }}</span>
                                                                </td>

                                                                <td>
                                                                    <span>{{ $pay->payperiod->period }}</span>
                                                                </td>
                                                                <td>
                                                                    <span>{{ round($pay->total_miles, 2) }}</span>
                                                                </td>
                                                                <td>
                                                                    <span>${{ round($pay->total_amount, 2) }}</span>
                                                                </td>
                                                                <td>
                                                                    <span>${{ round($visit, 2) }}</span>
                                                                </td>
                                                                <td>
                                                                    <span>{{ $pay->no_patients }}</span>
                                                                </td>
                                                                <td>
                                                                    <span>{{ $pay->no_visits }}</span>
                                                                </td>
                                                                <td>
                                                                    <span>
                                                                        <button
                                                                            class="@if ($pay->status == 'Approved') btn btn-outline-success @elseif ($pay->status == 'Declined') btn btn-outline-danger @else btn btn-outline-warning @endif">{{ $pay->status }}</button>
                                                                    </span>
                                                                </td>
                                                                <td>
                                                                    <span>
                                                                        <a href="{{ url('invoice', $pay->id) }}">
                                                                            <i class="fe fe-eye"></i></a>
                                                                    </span>
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                    @endif
                                                </tbody>

                                            </table>
                                            {!! $paysummaries->links() !!}
                                        </div>

                                        <div class="card-footer ">

                                            <!-- Pagination (prev) -->
                                            <div class="d-flex justify-content-between">
                                                <ul
                                                    class="list-pagination-prev pagination pagination-tabs card-pagination">
                                                    <li class="page-item">
                                                        <a class="page-link pl-0 pr-4 border-right" href="#">
                                                            <i class="fe fe-arrow-left mr-1"></i> Prev
                                                        </a>
                                                    </li>
                                                </ul>

                                                <!-- Pagination -->
                                                <ul class="list-pagination pagination pagination-tabs card-pagination">
                                                </ul>

                                                <!-- Pagination (next) -->
                                                <ul
                                                    class="list-pagination-next pagination pagination-tabs card-pagination">
                                                    <li class="page-item">
                                                        <a class="page-link pl-4 pr-0 border-left" href="#">
                                                            Next <i class="fe fe-arrow-right ml-1"></i>
                                                        </a>
                                                    </li>
                                                </ul>
                                            </div>


                                        </div>

                                    </div>

                                    <div id="Submitted" class="tab">
                                        <div class="table-responsive">
                                            <table class="table table-sm  table-nowrap card-table" id="submittedTable">
                                                <thead>
                                                    <tr>
                                                        <th>
                                                            <a class=" text-muted" href="#">Invoice #</a>
                                                        </th>
                                                        <th>
                                                            <a href="#" class="text-muted">Date</a>
                                                        </th>
                                                        <th>
                                                            <a href="#" class="text-muted">Year</a>
                                                        </th>
                                                        <th>
                                                            <a class="text-muted">Pay Period</a>
                                                        </th>
                                                        <th>
                                                            <a class="text-muted">Total Miles</a>
                                                        </th>
                                                        <th>
                                                            <a class="text-muted">Total $miles</a>
                                                        </th>
                                                        <th>
                                                            <a class="text-muted">Total Visit Rate</a>
                                                        </th>
                                                        <th>
                                                            <a class="text-muted">Total Patients</a>
                                                        </th>
                                                        <th>
                                                            <a class="text-muted">Total Visit </a>
                                                        </th>
                                                        <th>
                                                            <a class="text-muted">Status</a>
                                                        </th>
                                                        <th></th>
                                                    </tr>
                                                </thead>
                                                <tbody class="list font-size-base">
                                                    @if ($paysummaries->count() == 0)
                                                        <div class="mx-4">
                                                            <h3>No data available</h3>
                                                        </div>
                                                    @else
                                                        @foreach ($paysummaries->where('status', 'Pending') as $key => $pay)
                                                            @php
                                                                $totals = \App\Models\DailyPay::select('user_rate_id')
                                                                    ->where('emp_id', $pay->emp_id)
                                                                    ->where('pay_period_id', $pay->pay_period)
                                                                    ->get();
                                                                $rates = \App\Models\UserRate::where('emp_id', $pay->emp_id)->get();
                                                                $visit = [];
                                                                foreach ($rates as $key => $rate) {
                                                                    foreach ($totals as $key => $total) {
                                                                        if ($rate->id == $total->user_rate_id) {
                                                                            $visit[] = $rate->amount;
                                                                        }
                                                                    }
                                                                }
                                                                $visit = array_sum($visit);
                                                            @endphp
                                                            <tr>
                                                                <td>
                                                                    <!-- Text -->
                                                                    <span>{{ $pay->invoice }}</span>

                                                                </td>
                                                                <td>
                                                                    <span>{{ $pay->date }}</span>
                                                                </td>
                                                                <td>
                                                                    <span>{{ $pay->year }}</span>
                                                                </td>

                                                                <td>
                                                                    <span>{{ $pay->payperiod->period }}</span>
                                                                </td>
                                                                <td>
                                                                    <span>{{ round($pay->total_miles, 2) }}</span>
                                                                </td>
                                                                <td>
                                                                    <span>${{ round($pay->total_amount, 2) }}</span>
                                                                </td>
                                                                <td>
                                                                    <span>${{ round($visit, 2) }}</span>
                                                                </td>
                                                                <td>
                                                                    <span>{{ $pay->no_patients }}</span>
                                                                </td>
                                                                <td>
                                                                    <span>{{ $pay->no_visits }}</span>
                                                                </td>
                                                                <td>
                                                                    <span>
                                                                        <button
                                                                            class="@if ($pay->status == 'Approved') btn btn-outline-success @elseif ($pay->status == 'Declined') btn btn-outline-danger @else btn btn-outline-warning @endif">{{ $pay->status }}</button>
                                                                    </span>
                                                                </td>
                                                                <td>
                                                                    <span>
                                                                        <a href="{{ url('invoice', $pay->id) }}">
                                                                            <i class="fe fe-eye"></i></a>
                                                                    </span>
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                    @endif
                                                </tbody>

                                            </table>
                                            {!! $paysummaries->links() !!}
                                        </div>

                                        <div class="card-footer ">

                                            <!-- Pagination (prev) -->
                                            <div class="d-flex justify-content-between">
                                                <ul
                                                    class="list-pagination-prev pagination pagination-tabs card-pagination">
                                                    <li class="page-item">
                                                        <a class="page-link pl-0 pr-4 border-right" href="#">
                                                            <i class="fe fe-arrow-left mr-1"></i> Prev
                                                        </a>
                                                    </li>
                                                </ul>

                                                <!-- Pagination -->
                                                <ul class="list-pagination pagination pagination-tabs card-pagination">
                                                </ul>

                                                <!-- Pagination (next) -->
                                                <ul
                                                    class="list-pagination-next pagination pagination-tabs card-pagination">
                                                    <li class="page-item">
                                                        <a class="page-link pl-4 pr-0 border-left" href="#">
                                                            Next <i class="fe fe-arrow-right ml-1"></i>
                                                        </a>
                                                    </li>
                                                </ul>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>


                        </div>

                    </div>

                </div>
            </div> <!-- / .row -->
            <div class="modal fade " id="modalPaySummary" tabindex="-1" role="dialog" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modalReportSummaryLeft" role="document">
                    <div class="modal-content modalMembers">
                        <div class="card-header">

                            <!-- Title -->
                            <h2 class="card-header-title">
                                Pay Summary
                            </h2>

                            <!-- Close -->
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>

                        </div>
                        <div class="card-body modalMembers">
                            <div class="row mb-4">
                                <div class="col">
                                    <span class="registryName">Registry Name: {{ auth()->user()->name }} </span>
                                </div>
                                <div class="col-auto">
                                    <span class="registryDate">{{ $employee->date }} </span>
                                </div>
                            </div>

                            <form action="{{ url('daily-pay') }}" id="form-daily-pay" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-4">
                                        <label for="">Pay period</label>
                                        <select name="period" class="form-select mb-3" id="" class="">
                                            <option>Select Pay Period</option>
                                            @foreach ($periods as $period)
                                                <option value="{{ $period->id }}">{{ $period->period }}
                                                </option>
                                            @endforeach

                                        </select>
                                    </div>
                                </div>
                                <div class="period">
                                    <div>
                                        <div class="row">
                                            <div class="col-12 col-md-4 mb-3">
                                                <label for="form-label">Patient </label>
                                                <select class="form-select mb-3" data-choices id="patient"
                                                    onchange="myPatient()" name="patient[]" required>
                                                    <option>Select Patient</option>
                                                    @foreach ($patients as $patient)
                                                        <option value="{{ $patient->id }}">{{ $patient->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            @php
                                                $visits = \App\Models\UserRate::with('rate')
                                                    ->where('emp_id', $employee->id)
                                                    ->get();
                                            @endphp
                                            <div class="col-12 col-md-4 mb-3">
                                                <label for="form-label">Visit Type </label>
                                                <select class="form-select mb-3" data-choices name="visit_type[]"
                                                    onchange="myRate()" required>
                                                    <option>Select Visit Type</option>
                                                    @foreach (json_decode($employee->visit_rate) as $key => $item)
                                                        @foreach ($visits as $visit)
                                                            @if ($visit->id == $item)
                                                                <option value="{{ $visit->id }}">
                                                                    {{ $visit->rate->name }}</option>
                                                            @endif
                                                        @endforeach
                                                    @endforeach
                                                </select>

                                            </div>
                                            <div class="col-12 col-md-4 mb-3">
                                                <label for="form-label">Visit Rate </label>
                                                <input type="text" class="form-control" id="rate">

                                            </div>
                                        </div>

                                        <input type="text" name="employee" class="d-none"
                                            value="{{ $employee->id }}">
                                        <div class="row">
                                            <div class="col-12 col-md-4 mb-3">
                                                <label class="form-label">Date</label>
                                                <input type="date" class="form-control" name="date[]" required>
                                            </div>
                                            <div class="col-12 col-md-4 mb-3">
                                                <label class="form-label">Time</label>
                                                <div class="input-group input-group-merge mb-3">
                                                    <input type="time" class="form-control" name="time[]" required>
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-4 mb-3">
                                                <label class="form-label">Comment</label>
                                                <input type="text" class="form-control " placeholder=""
                                                    name="comment[]">
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-12 col-md-6 mb-3">
                                                <label class="form-label">Patient Signature</label>
                                                <input type="file" class="form-control " placeholder=""
                                                    name="signature[]">
                                            </div>
                                            <div class="col-12 col-md-3 my-5">
                                                <input type="checkbox" class="form-check-input " placeholder=""
                                                    name="sign[]">
                                                <label class="form-check-label">Check to Sign</label>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12 col-md-12 mb-3">
                                        <div class="row ">
                                            <div class="col-12 col-md-3">
                                                <iconify-icon icon="material-symbols:add-circle-rounded"
                                                    class="add_period" width="40" height="40">
                                                </iconify-icon>
                                            </div>
                                            <div class="col-auto">
                                                <button type="submit" id="addBtn"
                                                    class="btn btn-primary mt-3 p-2 addemployeModalBtn employeeBtn">
                                                    Submit
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    </div> <!-- / .main-content -->
@endsection
<script>
    function myPatient() {
        var patient = document.getElementById('patient').value;
        document.getElementById('patient_id').value = patient;
    }
</script>
<script>
    $(document).ready(function() {
        $('#submittedTable').DataTable();
        $('#returnedTable').DataTable();
        $('#approvedTable').DataTable();
    });
</script>
