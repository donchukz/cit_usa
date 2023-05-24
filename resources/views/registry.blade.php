@extends('layout.app')

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

                            <!-- Card -->
                            <div class="card" id="companiesList">
                                <!-- Header -->
                                <div class="p-3">
                                    <div class="tableHeadr">

                                        <div class="row align-items-center">
                                            <div class="col">


                                                <!-- Title -->
                                                <h1 class="header-title text-truncate">
                                                    Registry List
                                                </h1>

                                            </div>
                                            <div class="col-auto">


                                                <!-- Buttons -->
                                                <button type="button" data-toggle="modal" data-target="#modalReportSummary"
                                                    class="btn btn-outline-primary ml-2 employeeBtnOut">
                                                    Pay Summary Report
                                                </button>
                                                <button type="button" data-toggle="modal" data-target="#modalPaySummary"
                                                    class="btn btn-primary ml-2 employeeBtn">
                                                    Enter Pay Summary
                                                </button>

                                            </div>
                                        </div> <!-- / .row -->
                                    </div>
                                </div>
                                @if (session('statusreg'))
                                    <center class="text-light border border-success bg-success">
                                        {{ session('statusreg') }}
                                    </center>
                                    <br>
                                @endif
                                <div class="table-responsive">
                                    <table class="table table-sm  table-nowrap card-table">
                                        <thead>
                                            <tr>
                                                <th>
                                                    <a class=" text-muted" href="#">Ref</a>
                                                </th>
                                                <th>
                                                    <a class="text-muted" href="#">Full Name</a>
                                                </th>
                                                <th>
                                                    <a class="text-muted" href="#">Type of Employment</a>
                                                </th>
                                                <th>
                                                    <a class="text-muted">Registry Type</a>
                                                </th>
                                                <th>
                                                    <a class="text-muted">Discpline</a>
                                                </th>
                                                <th>
                                                    <a class="text-muted">Status</a>
                                                </th>
                                                <th>Pay Report</th>
                                            </tr>
                                        </thead>

                                        @if ($registries)
                                            <tbody class="list font-size-base">
                                                @foreach ($registries as $key => $registry)
                                                    <tr>

                                                        <td>

                                                            <!-- Text -->
                                                            <span>{{ $key + 1 }}</span>

                                                        </td>
                                                        <td>

                                                            <!-- Text -->
                                                            <span>{{ $registry->employ->name }}</span>

                                                        </td>
                                                        <td>
                                                            <span> {{ $registry->typeofemployment }}</span>
                                                        </td>
                                                        <td>
                                                            <span>{{ $registry->registrytype }}</span>
                                                        </td>
                                                        <td>
                                                            <span>{{ $registry->employ->discipline }}</span>
                                                        </td>
                                                        <td>
                                                            <span>
                                                                <button
                                                                    class="btn btn-outline-success">{{ $registry->employ->status }}</button>
                                                            </span>
                                                        </td>
                                                        {{-- <td>
                                                            <span>
                                                                <button type="button" data-toggle="modal"
                                                                    data-target="#modalReportSummary-{{ $key }}"
                                                                    class="btn btn-outline-primary ml-2 employeeBtnOut">Report</button>
                                                            </span>
                                                        </td> --}}
                                                        <td>
                                                            <span>


                                                                <button type="button" class="editbtn" data-toggle="modal"
                                                                    data-target="#ReditMembers-{{ $registry->employ->id }}"><i
                                                                        class="fe fe-edit-3"></i></button>


                                                            </span>
                                                        </td>
                                                        <div class="modal fade "
                                                            id="ReditMembers-{{ $registry->employ->id }}" tabindex="-1"
                                                            role="dialog" aria-hidden="true">
                                                            <div class="modal-dialog modal-dialog-centered editMembers"
                                                                role="document">
                                                                <div class="modal-content editMembers">
                                                                    <div class="card-header">

                                                                        <!-- Title -->
                                                                        <h2 class="card-header-title">
                                                                            Edit Registry Detail
                                                                            {{ $registry->employ->name }}
                                                                        </h2>

                                                                        <!-- Close -->
                                                                        <button type="button" class="close"
                                                                            data-dismiss="modal" aria-label="Close">
                                                                            <span aria-hidden="true">&times;</span>
                                                                        </button>

                                                                    </div>
                                                                    <div class="card-body editMembers">
                                                                        <form method="post"
                                                                            action="update-registry/{{ $registry->employ->id }}">
                                                                            @csrf
                                                                            @method('PUT')
                                                                            <div class="row g-3">
                                                                                <div class="col-12 col-md-6 mb-3">
                                                                                    <label class="form-label">Full
                                                                                        Name</label>
                                                                                    <input name="name" type="text"
                                                                                        class="form-control "
                                                                                        placeholder="Full Name"
                                                                                        value="{{ $registry->employ->name }}">
                                                                                </div>
                                                                                <div class="col-12 col-md-6 mb-3">
                                                                                    <label class="form-label">Type Of
                                                                                        Employment</label>
                                                                                    <select name="typeofemployment"
                                                                                        class="form-select mb-3">
                                                                                        <option>Select Employment Type
                                                                                        </option>
                                                                                        <option value="Full time">Full Time
                                                                                        </option>
                                                                                        <option value="Part time">Part Time
                                                                                        </option>
                                                                                    </select>
                                                                                </div>
                                                                            </div>

                                                                            <div class="row g-3">
                                                                                <div class="col-12 col-md-6 mb-3">
                                                                                    <label
                                                                                        class="form-label">Registry</label>
                                                                                    <select name="registrytype"
                                                                                        class="form-select mb-3">
                                                                                        <option>Select Registry</option>
                                                                                        <option value="Registry">Registry
                                                                                        </option>
                                                                                        <option value="Non-Registry">
                                                                                            Non-Registry </option>
                                                                                    </select>
                                                                                </div>
                                                                                <div class="col-12 col-md-6 mb-3">
                                                                                    <label
                                                                                        class="form-label">Position</label>
                                                                                    <select name="status"
                                                                                        class="form-select mb-3">
                                                                                        <option>Select Status</option>
                                                                                        <option value="Active">Active
                                                                                        </option>
                                                                                        <option value="InActive">In-Active
                                                                                        </option>
                                                                                    </select>
                                                                                </div>
                                                                            </div>

                                                                            <div class="col-auto">
                                                                                <!-- Button -->
                                                                                <button type="submit"
                                                                                    class="btn btn-primary ml-2 addemployeModalBtn employeeBtn">
                                                                                    Save
                                                                                </button>
                                                                            </div>


                                                                        </form>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="modal fade " id="modalPaySummary" tabindex="-1"
                                                            role="dialog" aria-hidden="true">
                                                            <div class="modal-dialog modal-dialog-centered modal-lg modalReportSummaryLeft"
                                                                role="document">
                                                                <div class="modal-content modalReportSummary">
                                                                    <div class="card-header">

                                                                        <!-- Title -->
                                                                        <h2 class="card-header-title">
                                                                            Pay Summary
                                                                        </h2>

                                                                        <!-- Close -->
                                                                        <button type="button" class="close"
                                                                            data-dismiss="modal" aria-label="Close">
                                                                            <span aria-hidden="true">&times;</span>
                                                                        </button>

                                                                    </div>
                                                                    <div class="card-body ">
                                                                        <form method="POST"
                                                                            action="{{ route('paysummary') }}">
                                                                            @csrf

                                                                            <div class="row mb-4">
                                                                                <div class="col">
                                                                                    <span class="registryName">Registry
                                                                                        Name: {{ auth()->user()->name }}
                                                                                    </span>
                                                                                </div>
                                                                                <div class="col-auto">
                                                                                    <span
                                                                                        class="registryDate">{{ //current date
                                                                                            $date = date('m/d/Y', time()) }}</span>
                                                                                </div>
                                                                            </div>
                                                                            <div class="row">
                                                                                <div class="col-12 col-md-3 mb-3">
                                                                                    <select class="form-select mb-3">
                                                                                        <option>Select Pay Period</option>
                                                                                        <option>Pay Period </option>
                                                                                    </select>
                                                                                </div>
                                                                                <div class="col-12 col-md-3 mb-3">
                                                                                    <input type="text"
                                                                                        class="form-control"
                                                                                        name="patientname"
                                                                                        placeholder="Patient Name">
                                                                                </div>

                                                                                <div class="col-12 col-md-3 mb-3">
                                                                                    <select class="form-select mb-3"
                                                                                        name="employee_id" required>
                                                                                        <option value="" selected
                                                                                            disabled>Select employee/
                                                                                            clinician</option>
                                                                                        @foreach ($raw_employees as $emp)
                                                                                            <option
                                                                                                value="{{ $emp->id }}">
                                                                                                {{ $emp->name }}
                                                                                            </option>
                                                                                        @endforeach
                                                                                    </select>
                                                                                </div>

                                                                            </div>

                                                                            <div class="tabs">

                                                                                <ul class="nav nav-tabs ulnav "
                                                                                    id="tabSwitch">
                                                                                    <li class="nav-item">
                                                                                        <a href="#soc"
                                                                                            class="nav-link ">
                                                                                            <span>
                                                                                                <input type="radio"
                                                                                                    name=" typeofvisit"
                                                                                                    value="SOC"
                                                                                                    autocomplete="off"
                                                                                                    checked>
                                                                                                SOC
                                                                                            </span>
                                                                                        </a>
                                                                                    </li>
                                                                                    <li class="nav-item">
                                                                                        <a href="#rrs"
                                                                                            class="nav-link ">
                                                                                            <span>
                                                                                                <input type="radio"
                                                                                                    name=" typeofvisit"
                                                                                                    value="RRS"
                                                                                                    autocomplete="off"
                                                                                                    checked>
                                                                                                RRS
                                                                                            </span>
                                                                                        </a>
                                                                                    </li>
                                                                                    <li class="nav-item">
                                                                                        <a href="#rv"
                                                                                            class="nav-link">
                                                                                            <span>
                                                                                                <input type="radio"
                                                                                                    name=" typeofvisit"
                                                                                                    value="RV"
                                                                                                    autocomplete="off"
                                                                                                    checked>
                                                                                                RV
                                                                                            </span>
                                                                                        </a>
                                                                                    </li>
                                                                                    <li class="nav-item">
                                                                                        <a href="#dco"
                                                                                            class="nav-link">
                                                                                            <span>
                                                                                                <input type="radio"
                                                                                                    name=" typeofvisit"
                                                                                                    value="DCO"
                                                                                                    autocomplete="off"
                                                                                                    checked>
                                                                                                DCO
                                                                                            </span>
                                                                                        </a>
                                                                                    </li>
                                                                                    <li class="nav-item">
                                                                                        <a href="#ndco"
                                                                                            class="nav-link">
                                                                                            <span>
                                                                                                <input type="radio"
                                                                                                    name=" typeofvisit"
                                                                                                    value="NDCO"
                                                                                                    autocomplete="off"
                                                                                                    checked>
                                                                                                NDCO
                                                                                            </span>
                                                                                        </a>
                                                                                    </li>
                                                                                    <li class="nav-item">
                                                                                        <a href="#reimbursement"
                                                                                            class="nav-link text-center">
                                                                                            <span>
                                                                                                <input type="radio"
                                                                                                    name=" typeofvisit"
                                                                                                    value="REIMBURSEMENT"
                                                                                                    autocomplete="off"
                                                                                                    checked>
                                                                                                Reimbursement
                                                                                            </span>
                                                                                        </a>
                                                                                    </li>
                                                                                </ul>

                                                                                <div id="soc"
                                                                                    class="tab active pt-4">

                                                                                    <div class="row">

                                                                                        <div class="col-12 col-md-3 mb-3">
                                                                                            <label
                                                                                                class="form-label">Date</label>
                                                                                            <div
                                                                                                class="input-group input-group-merge mb-3">

                                                                                                <input type="date"
                                                                                                    name="date"
                                                                                                    class="form-control"
                                                                                                    placeholder="__/__/____"
                                                                                                    data-inputmask="'mask': 'MM/DD/YYYY'">
                                                                                                <div class="input-group-text"
                                                                                                    id="inputGroup">

                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div
                                                                                            class="col-12 col-md-3 pt-2 mb-3">
                                                                                            <div class="checkBoxHt">
                                                                                                <div
                                                                                                    class="form-check mr-4">
                                                                                                    <label for="ht">
                                                                                                        HT
                                                                                                    </label>
                                                                                                    <input
                                                                                                        class="form-check-input "
                                                                                                        name="checkht"
                                                                                                        type="checkbox"
                                                                                                        value="ht"
                                                                                                        id="ht">
                                                                                                </div>
                                                                                                <div class="form-check">
                                                                                                    <label for="we">
                                                                                                        WE
                                                                                                    </label>
                                                                                                    <input
                                                                                                        class="form-check-input "
                                                                                                        name="checkwe"
                                                                                                        type="checkbox"
                                                                                                        value="we"
                                                                                                        id="we">
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="col-12 col-md-3 mb-3">
                                                                                            <label
                                                                                                class="form-label">Rate</label>
                                                                                            <select name="rate"
                                                                                                class="form-select mb-3">
                                                                                                <option>Select Rate</option>
                                                                                                <option value="SOC"> SOC
                                                                                                </option>
                                                                                                <option value="RV">RV
                                                                                                </option>
                                                                                            </select>
                                                                                        </div>
                                                                                        <div class="col-12 col-md-3 mb-3">
                                                                                            <label class="form-label">No.
                                                                                                of Visits</label>
                                                                                            <input type="number"
                                                                                                name="visits"
                                                                                                class="form-control "
                                                                                                placeholder="number of visits">
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="row">
                                                                                        <div class="col-12 col-md-3 mb-3">
                                                                                            <label
                                                                                                class="form-label">Miles</label>
                                                                                            <input type="number"
                                                                                                name="numberofmiles"
                                                                                                class="form-control"
                                                                                                placeholder="No. of Miles">
                                                                                        </div>
                                                                                        <div class="col-12 col-md-3 mb-3">
                                                                                            <label class="form-label">$
                                                                                                Total Rate</label>
                                                                                            <input type="number"
                                                                                                name="totalrate"
                                                                                                class="form-control "
                                                                                                placeholder="total rate">
                                                                                        </div>
                                                                                        <div class="col-12 col-md-3 mb-3">
                                                                                            <label class="form-label">$
                                                                                                Miles</label>
                                                                                            <input type="text"
                                                                                                name="miles"
                                                                                                class="form-control "
                                                                                                placeholder="Miles in Dollars">
                                                                                        </div>
                                                                                        <div class="col-12 col-md-3 mb-3">
                                                                                            <label
                                                                                                class="form-label">Comment</label>
                                                                                            <input type="text"
                                                                                                name="comments"
                                                                                                class="form-control "
                                                                                                placeholder="extra comments">

                                                                                        </div>


                                                                                    </div>


                                                                                </div>

                                                                            </div>
                                                                            <div class="row ">
                                                                                <div class="col">
                                                                                    <hr>
                                                                                    <span class="mr-4">Total Visits: 6
                                                                                        Visits </span>
                                                                                    <span class="mr-6">No. of Hours: 2.5
                                                                                        Visits</span>
                                                                                    <span class="mr-4">$170</span>
                                                                                    <span>$52.50</span>
                                                                                    <hr>
                                                                                </div>
                                                                                <div class="col-auto">
                                                                                    <button type="submit"
                                                                                        class="btn btn-primary mt-3 p-2 addemployeModalBtn employeeBtn">
                                                                                        Submit
                                                                                    </button>
                                                                                </div>
                                                                            </div>
                                                                        </form>
                                                                    </div>



                                                                </div>
                                                            </div>
                                                        </div>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        @else
                                            <p> You have no employees</p>
                                        @endif
                                    </table>
                                </div>
                                <div class="card-footer d-flex justify-content-between">

                                    <!-- Pagination (prev) -->
                                    <ul class="list-pagination-prev pagination pagination-tabs card-pagination">
                                        <li class="page-item">
                                            <a class="page-link pl-0 pr-4 border-right" href="#">
                                                <i class="fe fe-arrow-left mr-1"></i> Prev
                                            </a>
                                        </li>
                                    </ul>

                                    <!-- Pagination -->
                                    <ul class="list-pagination pagination pagination-tabs card-pagination">
                                        {!! $registries->links() !!}
                                    </ul>

                                    <!-- Pagination (next) -->
                                    <ul class="list-pagination-next pagination pagination-tabs card-pagination">
                                        <li class="page-item">
                                            <a class="page-link pl-4 pr-0 border-left" href="#">
                                                Next <i class="fe fe-arrow-right ml-1"></i>
                                            </a>
                                        </li>
                                    </ul>

                                    <!-- Alert -->
                                    <div class="list-alert alert alert-dark alert-dismissible border fade" role="alert">

                                        <!-- Content -->
                                        <div class="row align-items-center">
                                            <div class="col">

                                                <!-- Checkbox -->
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox"
                                                        id="cardAlertCheckbox" checked disabled>
                                                    <label class="form-check-label text-white" for="cardAlertCheckbox">
                                                        <span class="list-alert-count">0</span> deal(s)
                                                    </label>
                                                </div>

                                            </div>
                                            <div class="col-auto mr-n3">

                                                <!-- Button -->
                                                <button class="btn btn-sm btn-white-20">
                                                    Edit
                                                </button>

                                                <!-- Button -->
                                                <button class="btn btn-sm btn-white-20">
                                                    Delete
                                                </button>

                                            </div>
                                        </div> <!-- / .row -->

                                        <!-- Close -->
                                        <button type="button" class="list-alert-close close" aria-label="Close">
                                            <span aria-hidden="true">×</span>
                                        </button>

                                    </div>

                                </div>
                            </div>

                        </div>

                    </div>

                </div>
            </div> <!-- / .row -->

        </div>

        <div class="modal fade " id="modalReportSummary" tabindex="0" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg modalReportSummaryLeft" role="document">
                <div class="modal-content modalReportSummary">
                    <div class="card-header">
                        <!-- Title -->
                        <h2 class="card-header-title">
                            Pay Summary Report
                        </h2>
                        <!-- Close -->
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="card-body ">
                        <form action="{{ url('report') }}" method="POST">
                            @csrf
                            <div class="row mb-4">
                                <div class="col">
                                    <span class="registryName">Employee Name: {{ auth()->user()->name }} </span>
                                    <span class="text-center m-8">#Invoice Number</span>
                                </div>
                                <div class="col-auto">
                                    <span
                                        class="registryDate">{{ //current date
                                            $date = date('m/d/Y', time()) }}</span>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12 col-md-3 mb-3">
                                    <label for="start_date" class="form-label">Start Period</label>
                                    <input type="date" name="start_date" id="start_date" class="form-control">
                                </div>
                                <div class="col-12 col-md-3 mb-3">
                                    <label for="end_date" class="form-label">End Period</label>
                                    <input type="date" name="end_date" id="end_date" class="form-control">
                                </div>
                                @php
                                    $employees = \App\Models\addEmployee::where('status', 'active')->get();
                                @endphp
                                <div class="col-12 col-md-3 mb-3">
                                    <label for="employee" class="form-label">Employee</label>
                                    <select name="employee" id="employee" class="form-control">
                                        <option>Select Employee</option>
                                        @foreach ($employees as $employee)
                                            <option value="{{ $employee->id }}">{{ $employee->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-12 col-md-3 mb-3">
                                    <h4>.</h4>
                                    <button class="btn btn-primary ml-2 employeeBtn" type="submit"
                                        id="btn">Search</button>
                                </div>

                            </div>

                            <div class="table-responsive" id="modalTable">
                                <table class="table  table-nowrap card-table">
                                    <thead>
                                        <tr>
                                            <th>
                                                Ref
                                            </th>
                                            <th>
                                                Clinician Name
                                            </th>
                                            <th>
                                                Patient Name
                                            </th>
                                            <th>
                                                Visit Date
                                            </th>
                                            <th>
                                                Visit Type
                                            </th>
                                            <th>
                                                $Total
                                            </th>
                                            <th>
                                                $Miles
                                            </th>
                                            <th>
                                                Comment
                                            </th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody class="list font-size-base">
                                        @if ($pays)
                                            @php
                                                $totalvisits = $pays->count('visit');
                                                $total_patients = $pays->count('patient_name');
                                                $total = $pays->sum('totalrate');
                                                $miles = $pays->sum('milesusd');
                                            @endphp
                                            @foreach ($pays as $pay)
                                                @php
                                                    $employee = \App\Models\addEmployee::where('id', $pay->user_id)->first();
                                                @endphp
                                                <tr>
                                                    <td>
                                                        <!-- Text -->
                                                        <span>1</span>
                                                    </td>
                                                    <td>
                                                        <!-- Text -->
                                                        <span>{{ $employee->name }}</span>
                                                    </td>
                                                    <td>
                                                        <span>{{ $pay->patient_name }}</span>
                                                    </td>
                                                    <td>
                                                        <span>{{ $pay->date }}</span>
                                                    </td>
                                                    <td>
                                                        <span>{{ $pay->typeofvisit }}</span>
                                                    </td>
                                                    <td>
                                                        <span>
                                                            ${{ $pay->totalrate }}
                                                        </span>
                                                    </td>
                                                    <td>
                                                        <span>${{ $pay->milesusd }}</span>
                                                    </td>
                                                    <td>
                                                        <span>{{ $pay->comments }}</span>
                                                    </td>
                                                    <td>
                                                        <span>

                                                            <button type="button" class="editbtn mr-3"
                                                                data-toggle="modal"
                                                                data-target="#editMembers-{{ $pay->id }}"><i
                                                                    class="fe fe-edit-3"></i>
                                                            </button>
                                                            <button type="button" class="editbtn" data-toggle="modal"
                                                                data-target="#editMembers-{{ $pay->id }}"><i
                                                                    class="fe fe-trash"></i>
                                                            </button>

                                                        </span>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @endif
                                    </tbody>
                                </table>
                            </div>

                            <div class="row ">
                                <div class="col col-md-7">
                                    <hr>
                                    <span class="mr-4">Total Visits: {{ $totalvisits }} </span>
                                    <span class="mr-6">No. of Hours: 2.5 Visits</span>
                                    <span class="mr-4">Total: ${{ $total }}</span>
                                    <span>Total $Miles: ${{ $miles }}</span>
                                    <hr>
                                </div>
                                <div class="col-md-2">
                                    <input type="text" class="d-none" value="{{ Session::get('employee') }}"
                                        name="user_id">
                                    <input type="text" class="d-none"
                                        value="{{ Session::get('start_date') . ' to ' . Session::get('end_date') }}"
                                        name="date_range">
                                    <input type="text" class="d-none" value="{{ $total_patients ?? 0 }}"
                                        name="total_patients">
                                    <input type="text" class="d-none" value="{{ $totalvisits ?? 0 }}"
                                        name="total_visits">
                                    <input type="text" class="d-none" value="{{ $total_hours ?? 0 }}"
                                        name="total_hours">
                                    <input type="text" class="d-none" value="{{ $miles ?? 0 }}"
                                        name="total_mileage">
                                    <input type="text" class="d-none" value="{{ $total ?? 0 }}"
                                        name="total_amount">
                                </div>
                                <div class="col-auto">
                                    <button type="submit"
                                        class="btn btn-primary mt-3 p-2 addemployeModalBtn employeeBtn">
                                        Submit
                                    </button>
                                </div>
                            </div>


                        </form>
                    </div>
                </div>
            </div>
        </div>



    </div>

    </div> <!-- / .main-content -->
@endsection
