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
                                <div class="pl-3">
                                    <div class="tableHeadr">

                                        <div class="row align-items-center">
                                            <div class="col">
                                                <!-- Title -->
                                                <h1 class="header-title text-truncate ml-3">
                                                    Reports
                                                </h1>

                                            </div>
                                            <div class="col-auto">
                                                <div class="mr-4">
                                                    <select class="form-select" data-choices>
                                                        <option>2022</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div> <!-- / .row -->
                                    </div>
                                </div>
                                <div class="tabs">

                                    <ul class="nav nav-tabs ml-4 mr-4" id="tabSwitch">
                                        <li class="nav-item">
                                            <a href="#Pay" class="nav-link ">
                                                <span>
                                                    Pay period
                                                </span>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="#Employee" class="nav-link ">
                                                <span>
                                                    Employee Total Pay
                                                </span>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="#Patient" class="nav-link">
                                                <span>
                                                    Patient Total Cost
                                                </span>
                                            </a>
                                        </li>

                                    </ul>


                                    <div id="Employee" class="tab pt-2">
                                        <div class="pl-3">
                                            <div class="tableHeadr">

                                                <div class="row align-items-center">
                                                    <div class="col">
                                                        <!-- Title -->
                                                        <div class="d-flex align-items-center ">

                                                            <div class="mr-4 ml-3">
                                                                <select class="form-select " data-choices>
                                                                    <option> Employee/Registry</option>
                                                                </select>
                                                            </div>
                                                            <div>
                                                                <select class="form-select " data-choices>
                                                                    <option>Pay Period</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>

                                                </div> <!-- / .row -->
                                            </div>
                                        </div>
                                        <div class="table-responsive">
                                            <table class="table table-sm  table-nowrap card-table">
                                                <thead>
                                                    <tr>
                                                        <th>
                                                            <a class="text-muted" href="#">Ref</a>
                                                        </th>
                                                        <th>
                                                            <a class="text-muted" href="#">Invoice No.</a>
                                                        </th>
                                                        <th>
                                                            <a class="text-muted">Employee Name</a>
                                                        </th>
                                                        <th>
                                                            <a class="text-muted">No. of Patients</a>
                                                        </th>
                                                        <th>
                                                            <a class="text-muted">No. of Visits</a>
                                                        </th>
                                                        <th>
                                                            <a class="text-muted">Date Range</a>
                                                        </th>
                                                        <th>
                                                            <a class="text-muted">Total Hours</a>
                                                        </th>
                                                        <th>
                                                            <a class="text-muted">$Total</a>
                                                        </th>
                                                        <th>
                                                            <a class="text-muted">$ Mileage</a>
                                                        </th>
                                                        <th>
                                                            <a class="text-muted">Comment</a>
                                                        </th>
                                                        <th>
                                                            <a class="text-muted">Status</a>
                                                        </th>
                                                        <th></th>
                                                    </tr>
                                                </thead>
                                                <tbody class="list font-size-base">
                                                    <tr>
                                                        <td>
                                                            <!-- Text -->
                                                            <span>1</span>

                                                        </td>
                                                        <td>
                                                            <span> #478851</span>
                                                        </td>
                                                        <td>
                                                            <span>Sean Evans</span>
                                                        </td>
                                                        <td>
                                                            <span>15</span>
                                                        </td>
                                                        <td>
                                                            <span>15</span>
                                                        </td>
                                                        <td>
                                                            <span>Monthly</span>
                                                        </td>
                                                        <td>
                                                            <span>5</span>
                                                        </td>
                                                        <td>
                                                            <span>256</span>
                                                        </td>
                                                        <td>
                                                            <span>12.5</span>
                                                        </td>
                                                        <td>
                                                            <span>Supply</span>
                                                        </td>
                                                        <td>
                                                            <span>
                                                                <button class="btn btn-outline-success">Active</button>
                                                            </span>
                                                        </td>
                                                        <td>
                                                            <span>
                                                                <button type="button" class="editbtn" data-toggle="modal"
                                                                    data-target="#editMembers"><i
                                                                        class="fe fe-edit-3"></i></button>
                                                            </span>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <!-- Text -->
                                                            <span>1</span>

                                                        </td>
                                                        <td>
                                                            08/15-08/20
                                                        </td>
                                                        <td>
                                                            <span> #478851</span>
                                                        </td>
                                                        <td>
                                                            <span>Sean Evans</span>
                                                        </td>
                                                        <td>
                                                            <span>15</span>
                                                        </td>
                                                        <td>
                                                            <span>15</span>
                                                        </td>
                                                        <td>
                                                            <span>Monthly</span>
                                                        </td>
                                                        <td>
                                                            <span>5</span>
                                                        </td>
                                                        <td>
                                                            <span>256</span>
                                                        </td>
                                                        <td>
                                                            <span>12.5</span>
                                                        </td>
                                                        <td>
                                                            <span>Supply</span>
                                                        </td>
                                                        <td>
                                                            <span>
                                                                <button class="btn btn-outline-danger">In-Active</button>
                                                            </span>
                                                        </td>
                                                        <td>
                                                            <span>
                                                                <button type="button" class="editbtn" data-toggle="modal"
                                                                    data-target="#editMembers"><i
                                                                        class="fe fe-edit-3"></i></button>
                                                            </span>
                                                        </td>
                                                    </tr>
                                                </tbody>

                                            </table>
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
                                    <div id="Patient" class="tab pt-2">
                                        <div class="pl-3">
                                            <div class="tableHeadr">

                                                <div class="row align-items-center">
                                                    <div class="col">
                                                        <!-- Title -->
                                                        <div class="d-flex align-items-center ">

                                                            <div class="mr-4 ml-3">
                                                                <select class="form-select " data-choices>
                                                                    <option>Patients Name</option>
                                                                </select>
                                                            </div>
                                                            <div>
                                                                <select class="form-select " data-choices>
                                                                    <option>Date Range</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>

                                                </div> <!-- / .row -->
                                            </div>
                                        </div>
                                        <div class="table-responsive">
                                            <table class="table table-sm  table-nowrap card-table">
                                                <thead>
                                                    <tr>
                                                        <th>
                                                            <a class="text-muted" href="#">Ref</a>
                                                        </th>
                                                        <th>
                                                            <a class="text-muted" href="#">Pay Period</a>
                                                        </th>
                                                        <th>
                                                            <a class="text-muted" href="#">Invoice No.</a>
                                                        </th>
                                                        <th>
                                                            <a class="text-muted">Employee Name</a>
                                                        </th>
                                                        <th>
                                                            <a class="text-muted">No. of Patients</a>
                                                        </th>
                                                        <th>
                                                            <a class="text-muted">No. of Visits</a>
                                                        </th>
                                                        <th>
                                                            <a class="text-muted">Total Hours</a>
                                                        </th>
                                                        <th>
                                                            <a class="text-muted">$Total</a>
                                                        </th>
                                                        <th>
                                                            <a class="text-muted">$ Mileage</a>
                                                        </th>
                                                        <th>
                                                            <a class="text-muted">Comment</a>
                                                        </th>
                                                        <th>
                                                            <a class="text-muted">Status</a>
                                                        </th>
                                                        <th></th>
                                                    </tr>
                                                </thead>
                                                <tbody class="list font-size-base">
                                                    <tr>
                                                        <td>
                                                            <!-- Text -->
                                                            <span>1</span>

                                                        </td>
                                                        <td>
                                                            08/15-08/20
                                                        </td>
                                                        <td>
                                                            <span> #478851</span>
                                                        </td>
                                                        <td>
                                                            <span>Sean Evans</span>
                                                        </td>
                                                        <td>
                                                            <span>15</span>
                                                        </td>
                                                        <td>
                                                            <span>15</span>
                                                        </td>
                                                        <td>
                                                            <span>5</span>
                                                        </td>
                                                        <td>
                                                            <span>256</span>
                                                        </td>
                                                        <td>
                                                            <span>12.5</span>
                                                        </td>
                                                        <td>
                                                            <span>Supply</span>
                                                        </td>
                                                        <td>
                                                            <span>
                                                                <button class="btn btn-outline-success">Active</button>
                                                            </span>
                                                        </td>
                                                        <td>
                                                            <span>
                                                                <button type="button" class="editbtn"
                                                                    data-toggle="modal" data-target="#editMembers"><i
                                                                        class="fe fe-edit-3"></i></button>
                                                            </span>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <!-- Text -->
                                                            <span>1</span>

                                                        </td>
                                                        <td>
                                                            08/15-08/20
                                                        </td>
                                                        <td>
                                                            <span> #478851</span>
                                                        </td>
                                                        <td>
                                                            <span>Sean Evans</span>
                                                        </td>
                                                        <td>
                                                            <span>15</span>
                                                        </td>
                                                        <td>
                                                            <span>15</span>
                                                        </td>
                                                        <td>
                                                            <span>5</span>
                                                        </td>
                                                        <td>
                                                            <span>256</span>
                                                        </td>
                                                        <td>
                                                            <span>12.5</span>
                                                        </td>
                                                        <td>
                                                            <span>Supply</span>
                                                        </td>
                                                        <td>
                                                            <span>
                                                                <button class="btn btn-outline-danger">In-Active</button>
                                                            </span>
                                                        </td>
                                                        <td>
                                                            <span>
                                                                <button type="button" class="editbtn"
                                                                    data-toggle="modal" data-target="#editMembers"><i
                                                                        class="fe fe-edit-3"></i></button>
                                                            </span>
                                                        </td>
                                                    </tr>
                                                </tbody>

                                            </table>
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
                                    <div id="Pay" class="tab active pt-2">
                                        <div class="pl-3">
                                            <div class="tableHeadr">

                                                <div class="row align-items-center">
                                                    <div class="col">
                                                        <!-- Title -->
                                                        <div class="d-flex align-items-center ">
                                                            <h1 class="header-title text-truncate ml-3 mr-4">
                                                                Approved
                                                            </h1>
                                                            <div class="mr-4">
                                                                <select class="form-select " data-choices>
                                                                    <option> Pay Period</option>
                                                                </select>
                                                            </div>
                                                            <div>
                                                                <select class="form-select " data-choices>
                                                                    <option>Category</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>

                                                </div> <!-- / .row -->
                                            </div>
                                        </div>
                                        <div class="table-responsive">
                                            <table id="example" class="table table-sm  table-nowrap card-table">
                                                <thead>
                                                    <tr>
                                                        <th>
                                                            <a class=" text-muted" href="#">Ref</a>
                                                        </th>
                                                        <th>
                                                            <a class="text-muted" href="#">Invoice No.</a>
                                                        </th>
                                                        <th>
                                                            <a class="text-muted">Employee Name</a>
                                                        </th>
                                                        <th>
                                                            <a class="text-muted">No. of Patients</a>
                                                        </th>
                                                        <th>
                                                            <a class="text-muted">No. of Visits</a>
                                                        </th>
                                                        <th>
                                                            <a class="text-muted">Date Range</a>
                                                        </th>
                                                        <th>
                                                            <a class="text-muted">Total Hours</a>
                                                        </th>
                                                        <th>
                                                            <a class="text-muted">$Total</a>
                                                        </th>
                                                        <th>
                                                            <a class="text-muted">$ Mileage</a>
                                                        </th>
                                                        <th>
                                                            <a class="text-muted">Comment</a>
                                                        </th>
                                                        <th>
                                                            <a class="text-muted">Status</a>
                                                        </th>
                                                        <th></th>
                                                    </tr>
                                                </thead>
                                                <tbody class="list font-size-base">
                                                    @foreach ($reports->where('status', 'Approved') as $key => $report)
                                                        @php
                                                            $staff = \App\Models\addEmployee::where('id', $report->employee_id)->first();

                                                        @endphp
                                                        <tr>
                                                            <td>
                                                                <!-- Text -->
                                                                <span>{{ $key + 1 }}</span>

                                                            </td>

                                                            <td>
                                                                <span>{{ $report->invoice }}</span>
                                                            </td>
                                                            <td>
                                                                <span>{{ $staff->name }}</span>
                                                            </td>
                                                            <td>
                                                                <span>{{ $report->total_patients }}</span>
                                                            </td>
                                                            <td>
                                                                <span>{{ $report->total_visits }}</span>
                                                            </td>
                                                            <td>
                                                                <span>{{ $report->date_range }}</span>
                                                            </td>
                                                            <td>
                                                                <span>{{ $report->total_hours }}</span>
                                                            </td>
                                                            <td>
                                                                <span>{{ $report->total_amount }}</span>
                                                            </td>
                                                            <td>
                                                                <span>{{ $report->total_mileage }}</span>
                                                            </td>
                                                            <td>
                                                                <span>{{ $report->comments }}</span>
                                                            </td>
                                                            <td>
                                                                <span>
                                                                    <button
                                                                        class="btn btn-outline-success">Approved</button>
                                                                </span>
                                                            </td>
                                                            <td>
                                                                <span>
                                                                    <button type="button" class="editbtn"
                                                                        data-toggle="modal"
                                                                        data-target="#editMembers{{ $key }}"><i
                                                                            class="fe fe-edit-3"></i></button>
                                                                </span>
                                                            </td>
                                                            <div class="modal fade " id="editMembers{{ $key }}"
                                                                tabindex="-1" role="dialog" aria-hidden="true">
                                                                <div class="modal-dialog modal-dialog-centered editMembers"
                                                                    role="document">
                                                                    <div class="modal-content editMembers">
                                                                        <div class="card-header">

                                                                            <!-- Title -->
                                                                            <h2 class="card-header-title">
                                                                                Edit Reports
                                                                            </h2>

                                                                            <!-- Close -->
                                                                            <button type="button" class="close"
                                                                                data-dismiss="modal" aria-label="Close">
                                                                                <span aria-hidden="true">&times;</span>
                                                                            </button>

                                                                        </div>
                                                                        <div class="card-body editMembers">
                                                                            <form
                                                                                action="{{ url('edit-report', $report->id) }}"
                                                                                method="POST">
                                                                                @csrf
                                                                                <div class="row g-3">
                                                                                    <div class="col-12 col-md-6 mb-3">
                                                                                        <label class="form-label">Pay
                                                                                            Period</label>
                                                                                        <input type="text"
                                                                                            class="form-control"
                                                                                            name="date_range"
                                                                                            value="{{ $report->date_range }}"
                                                                                            readonly>

                                                                                    </div>
                                                                                    <div class="col-12 col-md-6 mb-3">
                                                                                        <label class="form-label">Invoice
                                                                                            No</label>
                                                                                        <input type="text"
                                                                                            class="form-control "
                                                                                            placeholder="Invoice No"
                                                                                            name="invoice"
                                                                                            value="{{ $report->invoice }}"
                                                                                            required readonly>

                                                                                    </div>
                                                                                </div>
                                                                                <div class="row g-3">
                                                                                    <div class="col-12 col-md-6 mb-3">
                                                                                        <label class="form-label">Employee
                                                                                            Name</label>
                                                                                        <input type="text"
                                                                                            class="form-control"
                                                                                            placeholder="Employee Name"
                                                                                            value="{{ $staff->name }}"
                                                                                            readonly>

                                                                                    </div>
                                                                                    <div class="col-12 col-md-6 mb-3">
                                                                                        <label class="form-label">No. Of
                                                                                            Patients</label>
                                                                                        <input type="text"
                                                                                            class="form-control "
                                                                                            placeholder="No. Of Patients"
                                                                                            name="total_patients"
                                                                                            value="{{ $report->total_patients }}"
                                                                                            readonly required>

                                                                                    </div>
                                                                                </div>

                                                                                <div class="row g-3">
                                                                                    <div class="col-12 col-md-6 mb-3">
                                                                                        <label class="form-label">No. Of
                                                                                            Visits</label>
                                                                                        <input type="text"
                                                                                            class="form-control"
                                                                                            placeholder="No. Of Visits"
                                                                                            name="total_visits"
                                                                                            value="{{ $report->total_visits }}"
                                                                                            readonly>

                                                                                    </div>
                                                                                    <div class="col-12 col-md-6 mb-3">
                                                                                        <label
                                                                                            class="form-label">Mileage</label>
                                                                                        <input type="text"
                                                                                            class="form-control"
                                                                                            placeholder="Mileage"
                                                                                            name="total_mileage"
                                                                                            value="{{ $report->total_mileage }}"
                                                                                            readonly>
                                                                                    </div>
                                                                                </div>

                                                                                <div class="row g-3">
                                                                                    <div class="col-12 col-md-4 mb-3">
                                                                                        <label class="form-label">Total
                                                                                            Hours</label>
                                                                                        <input type="text"
                                                                                            class="form-control"
                                                                                            placeholder="Total Hours"
                                                                                            name="total_hours"
                                                                                            value="{{ $report->total_hours }}"
                                                                                            readonly>
                                                                                    </div>
                                                                                    <div class="col-12 col-md-4 mb-3">
                                                                                        <label
                                                                                            class="form-label">Total</label>
                                                                                        <input type="text"
                                                                                            class="form-control"
                                                                                            placeholder="Total"
                                                                                            name="total_amount"
                                                                                            value="{{ $report->total_amount }}"
                                                                                            readonly>
                                                                                    </div>
                                                                                    <div class="col-12 col-md-4 mb-3">
                                                                                        <label
                                                                                            class="form-label">Status</label>
                                                                                        <select class="form-select mb-3"
                                                                                            name="status" required>
                                                                                            <option
                                                                                                value=" {{ $report->status }}">
                                                                                                {{ $report->status }}
                                                                                            </option>
                                                                                            <option value="Approved">
                                                                                                Approve
                                                                                            </option>
                                                                                            <option value="Declined">
                                                                                                Decline
                                                                                            </option>
                                                                                            <option value="Pending">Pending
                                                                                            </option>
                                                                                        </select>
                                                                                    </div>
                                                                                </div>

                                                                                <div class="row g-3">

                                                                                    <div class="col-12 col-md-12 mb-3">
                                                                                        <label
                                                                                            class="form-label">Comment</label>
                                                                                        <textarea name="comments" id="" cols="30" rows="10" class="form-control"> {{ $report->comments ?? ' N/A' }}</textarea>
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
                                                        </tr>
                                                    @endforeach


                                                </tbody>

                                            </table>
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

                            <!-- Card -->
                            <div class="card" id="companiesList">
                                <!-- Header -->
                                <div class="p-3">
                                    <div class="tableHeadr">

                                        <div class="row align-items-center">
                                            <div class="col">
                                                <!-- Title -->
                                                <div class="d-flex justify-content-start flex-wrap ">
                                                    <h1 class="header-title text-truncate ml-3 mr-4">
                                                        Declined
                                                    </h1>
                                                    <div class="mr-4">
                                                        <select class="form-select " data-choices>
                                                            <option> Pay Period</option>
                                                        </select>
                                                    </div>
                                                    <div>
                                                        <select class="form-select " data-choices>
                                                            <option>Category</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>

                                        </div> <!-- / .row -->
                                    </div>
                                </div>
                                <div class="table-responsive">
                                    <table id="example" class="table table-sm  table-nowrap card-table">
                                        <thead>
                                            <tr>
                                                <th>
                                                    <a class=" text-muted" href="#">Ref</a>
                                                </th>
                                                <th>
                                                    <a class="text-muted" href="#">Invoice No.</a>
                                                </th>
                                                <th>
                                                    <a class="text-muted">Employee Name</a>
                                                </th>
                                                <th>
                                                    <a class="text-muted">No. of Patients</a>
                                                </th>
                                                <th>
                                                    <a class="text-muted">No. of Visits</a>
                                                </th>
                                                <th>
                                                    <a class="text-muted">Date Range</a>
                                                </th>
                                                <th>
                                                    <a class="text-muted">Total Hours</a>
                                                </th>
                                                <th>
                                                    <a class="text-muted">$Total</a>
                                                </th>
                                                <th>
                                                    <a class="text-muted">$ Mileage</a>
                                                </th>
                                                <th>
                                                    <a class="text-muted">Comment</a>
                                                </th>
                                                <th>
                                                    <a class="text-muted">Status</a>
                                                </th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody class="list font-size-base">
                                            @foreach ($reports->where('status', 'Declined') as $key => $report)
                                                @php
                                                    $staff = \App\Models\addEmployee::where('id', $report->employee_id)->first();

                                                @endphp
                                                <tr>
                                                    <td>
                                                        <!-- Text -->
                                                        <span>{{ $key + 1 }}</span>

                                                    </td>

                                                    <td>
                                                        <span>{{ $report->invoice }}</span>
                                                    </td>
                                                    <td>
                                                        <span>{{ $staff->name }}</span>
                                                    </td>
                                                    <td>
                                                        <span>{{ $report->total_patients }}</span>
                                                    </td>
                                                    <td>
                                                        <span>{{ $report->total_visits }}</span>
                                                    </td>
                                                    <td>
                                                        <span>{{ $report->date_range }}</span>
                                                    </td>
                                                    <td>
                                                        <span>{{ $report->total_hours }}</span>
                                                    </td>
                                                    <td>
                                                        <span>{{ $report->total_amount }}</span>
                                                    </td>
                                                    <td>
                                                        <span>{{ $report->total_mileage }}</span>
                                                    </td>
                                                    <td>
                                                        <span>{{ $report->comments }}</span>
                                                    </td>
                                                    <td>
                                                        <span>
                                                            <button class="btn btn-outline-success">Approved</button>
                                                        </span>
                                                    </td>
                                                    <td>
                                                        <span>
                                                            <button type="button" class="editbtn" data-toggle="modal"
                                                                data-target="#editMembers{{ $key }}"><i
                                                                    class="fe fe-edit-3"></i></button>
                                                        </span>
                                                    </td>
                                                    <div class="modal fade " id="editMembers{{ $key }}"
                                                        tabindex="-1" role="dialog" aria-hidden="true">
                                                        <div class="modal-dialog modal-dialog-centered editMembers"
                                                            role="document">
                                                            <div class="modal-content editMembers">
                                                                <div class="card-header">

                                                                    <!-- Title -->
                                                                    <h2 class="card-header-title">
                                                                        Edit Reports
                                                                    </h2>

                                                                    <!-- Close -->
                                                                    <button type="button" class="close"
                                                                        data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>

                                                                </div>
                                                                <div class="card-body editMembers">
                                                                    <form action="{{ url('edit-report', $report->id) }}"
                                                                        method="POST">
                                                                        @csrf
                                                                        <div class="row g-3">
                                                                            <div class="col-12 col-md-6 mb-3">
                                                                                <label class="form-label">Pay
                                                                                    Period</label>
                                                                                <input type="text" class="form-control"
                                                                                    name="date_range"
                                                                                    value="{{ $report->date_range }}"
                                                                                    readonly>

                                                                            </div>
                                                                            <div class="col-12 col-md-6 mb-3">
                                                                                <label class="form-label">Invoice
                                                                                    No</label>
                                                                                <input type="text"
                                                                                    class="form-control "
                                                                                    placeholder="Invoice No"
                                                                                    name="invoice"
                                                                                    value="{{ $report->invoice }}"
                                                                                    required readonly>

                                                                            </div>
                                                                        </div>
                                                                        <div class="row g-3">
                                                                            <div class="col-12 col-md-6 mb-3">
                                                                                <label class="form-label">Employee
                                                                                    Name</label>
                                                                                <input type="text" class="form-control"
                                                                                    placeholder="Employee Name"
                                                                                    value="{{ $staff->name }}" readonly>

                                                                            </div>
                                                                            <div class="col-12 col-md-6 mb-3">
                                                                                <label class="form-label">No. Of
                                                                                    Patients</label>
                                                                                <input type="text"
                                                                                    class="form-control "
                                                                                    placeholder="No. Of Patients"
                                                                                    name="total_patients"
                                                                                    value="{{ $report->total_patients }}"
                                                                                    readonly required>

                                                                            </div>
                                                                        </div>

                                                                        <div class="row g-3">
                                                                            <div class="col-12 col-md-6 mb-3">
                                                                                <label class="form-label">No. Of
                                                                                    Visits</label>
                                                                                <input type="text" class="form-control"
                                                                                    placeholder="No. Of Visits"
                                                                                    name="total_visits"
                                                                                    value="{{ $report->total_visits }}"
                                                                                    readonly>

                                                                            </div>
                                                                            <div class="col-12 col-md-6 mb-3">
                                                                                <label class="form-label">Mileage</label>
                                                                                <input type="text" class="form-control"
                                                                                    placeholder="Mileage"
                                                                                    name="total_mileage"
                                                                                    value="{{ $report->total_mileage }}"
                                                                                    readonly>
                                                                            </div>
                                                                        </div>

                                                                        <div class="row g-3">
                                                                            <div class="col-12 col-md-4 mb-3">
                                                                                <label class="form-label">Total
                                                                                    Hours</label>
                                                                                <input type="text" class="form-control"
                                                                                    placeholder="Total Hours"
                                                                                    name="total_hours"
                                                                                    value="{{ $report->total_hours }}"
                                                                                    readonly>
                                                                            </div>
                                                                            <div class="col-12 col-md-4 mb-3">
                                                                                <label class="form-label">Total</label>
                                                                                <input type="text" class="form-control"
                                                                                    placeholder="Total"
                                                                                    name="total_amount"
                                                                                    value="{{ $report->total_amount }}"
                                                                                    readonly>
                                                                            </div>
                                                                            <div class="col-12 col-md-4 mb-3">
                                                                                <label class="form-label">Status</label>
                                                                                <select class="form-select mb-3"
                                                                                    name="status" required>
                                                                                    <option
                                                                                        value=" {{ $report->status }}">
                                                                                        {{ $report->status }}
                                                                                    </option>
                                                                                    <option value="Approved">Approve
                                                                                    </option>
                                                                                    <option value="Declined">Decline
                                                                                    </option>
                                                                                    <option value="Pending">Pending
                                                                                    </option>
                                                                                </select>
                                                                            </div>
                                                                        </div>

                                                                        <div class="row g-3">

                                                                            <div class="col-12 col-md-12 mb-3">
                                                                                <label class="form-label">Comment</label>
                                                                                <textarea name="comments" id="" cols="30" rows="10" class="form-control"> {{ $report->comments ?? ' N/A' }}</textarea>
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
                                                </tr>
                                            @endforeach


                                        </tbody>

                                    </table>
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
                                        <ul class="list-pagination pagination pagination-tabs card-pagination"></ul>

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

                            {{-- Calendar --}}
                            <!-- Card -->
                            <div class="card" id="Pending">
                                <!-- Header -->
                                <div class="p-3">
                                    <div class="tableHeadr">

                                        <div class="row align-items-center">
                                            <div class="col">
                                                <!-- Title -->
                                                <div class="d-flex justify-content-start flex-wrap ">
                                                    <h1 class="header-title text-truncate ml-3 mr-4">
                                                        Pending
                                                    </h1>
                                                    <div class="mr-4">
                                                        <select class="form-select " data-choices>
                                                            <option> Pay Period</option>
                                                        </select>
                                                    </div>
                                                    <div>
                                                        <select class="form-select " data-choices>
                                                            <option>Category</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>

                                        </div> <!-- / .row -->
                                    </div>
                                </div>
                                <div class="table-responsive">
                                    <table id="example" class="table table-sm  table-nowrap card-table">
                                        <thead>
                                            <tr>
                                                <th>
                                                    <a class=" text-muted" href="#">Ref</a>
                                                </th>
                                                <th>
                                                    <a class="text-muted" href="#">Invoice No.</a>
                                                </th>
                                                <th>
                                                    <a class="text-muted">Employee Name</a>
                                                </th>
                                                <th>
                                                    <a class="text-muted">No. of Patients</a>
                                                </th>
                                                <th>
                                                    <a class="text-muted">No. of Visits</a>
                                                </th>
                                                <th>
                                                    <a class="text-muted">Date Range</a>
                                                </th>
                                                <th>
                                                    <a class="text-muted">Total Hours</a>
                                                </th>
                                                <th>
                                                    <a class="text-muted">$Total</a>
                                                </th>
                                                <th>
                                                    <a class="text-muted">$ Mileage</a>
                                                </th>
                                                <th>
                                                    <a class="text-muted">Comment</a>
                                                </th>
                                                <th>
                                                    <a class="text-muted">Status</a>
                                                </th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody class="list font-size-base">
                                            @foreach ($reports->where('status', 'Pending') as $key => $report)
                                                @php
                                                    $staff = \App\Models\addEmployee::where('id', $report->employee_id)->first();

                                                @endphp
                                                <tr>
                                                    <td>
                                                        <!-- Text -->
                                                        <span>{{ $key + 1 }}</span>

                                                    </td>

                                                    <td>
                                                        <span>{{ $report->invoice }}</span>
                                                    </td>
                                                    <td>
                                                        <span>{{ $staff->name }}</span>
                                                    </td>
                                                    <td>
                                                        <span>{{ $report->total_patients }}</span>
                                                    </td>
                                                    <td>
                                                        <span>{{ $report->total_visits }}</span>
                                                    </td>
                                                    <td>
                                                        <span>{{ $report->date_range }}</span>
                                                    </td>
                                                    <td>
                                                        <span>{{ $report->total_hours }}</span>
                                                    </td>
                                                    <td>
                                                        <span>{{ $report->total_amount }}</span>
                                                    </td>
                                                    <td>
                                                        <span>{{ $report->total_mileage }}</span>
                                                    </td>
                                                    <td>
                                                        <span>N/A</span>
                                                    </td>
                                                    <td>
                                                        <span>
                                                            <button class="btn btn-outline-warning">Pending</button>
                                                        </span>
                                                    </td>
                                                    <td>
                                                        <span>
                                                            <button type="button" class="editbtn" data-toggle="modal"
                                                                data-target="#editMembers{{ $key }}"><i
                                                                    class="fe fe-edit-3"></i></button>
                                                        </span>
                                                    </td>
                                                    <div class="modal fade " id="editMembers{{ $key }}"
                                                        tabindex="-1" role="dialog" aria-hidden="true">
                                                        <div class="modal-dialog modal-dialog-centered editMembers"
                                                            role="document">
                                                            <div class="modal-content editMembers">
                                                                <div class="card-header">

                                                                    <!-- Title -->
                                                                    <h2 class="card-header-title">
                                                                        Edit Reports
                                                                    </h2>

                                                                    <!-- Close -->
                                                                    <button type="button" class="close"
                                                                        data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>

                                                                </div>
                                                                <div class="card-body editMembers">
                                                                    <form action="{{ url('edit-report', $report->id) }}"
                                                                        method="POST">
                                                                        @csrf
                                                                        <div class="row g-3">
                                                                            <div class="col-12 col-md-6 mb-3">
                                                                                <label class="form-label">Pay
                                                                                    Period</label>
                                                                                <input type="text" class="form-control"
                                                                                    name="date_range"
                                                                                    value="{{ $report->date_range }}"
                                                                                    readonly>

                                                                            </div>
                                                                            <div class="col-12 col-md-6 mb-3">
                                                                                <label class="form-label">Invoice
                                                                                    No</label>
                                                                                <input type="text"
                                                                                    class="form-control "
                                                                                    placeholder="Invoice No"
                                                                                    name="invoice"
                                                                                    value="{{ $report->invoice }}"
                                                                                    required readonly>

                                                                            </div>
                                                                        </div>
                                                                        <div class="row g-3">
                                                                            <div class="col-12 col-md-6 mb-3">
                                                                                <label class="form-label">Employee
                                                                                    Name</label>
                                                                                <input type="text" class="form-control"
                                                                                    placeholder="Employee Name"
                                                                                    value="{{ $staff->name }}" readonly>

                                                                            </div>
                                                                            <div class="col-12 col-md-6 mb-3">
                                                                                <label class="form-label">No. Of
                                                                                    Patients</label>
                                                                                <input type="text"
                                                                                    class="form-control "
                                                                                    placeholder="No. Of Patients"
                                                                                    name="total_patients"
                                                                                    value="{{ $report->total_patients }}"
                                                                                    readonly required>

                                                                            </div>
                                                                        </div>

                                                                        <div class="row g-3">
                                                                            <div class="col-12 col-md-6 mb-3">
                                                                                <label class="form-label">No. Of
                                                                                    Visits</label>
                                                                                <input type="text" class="form-control"
                                                                                    placeholder="No. Of Visits"
                                                                                    name="total_visits"
                                                                                    value="{{ $report->total_visits }}"
                                                                                    readonly>

                                                                            </div>
                                                                            <div class="col-12 col-md-6 mb-3">
                                                                                <label class="form-label">Mileage</label>
                                                                                <input type="text" class="form-control"
                                                                                    placeholder="Mileage"
                                                                                    name="total_mileage"
                                                                                    value="{{ $report->total_mileage }}"
                                                                                    readonly>
                                                                            </div>
                                                                        </div>

                                                                        <div class="row g-3">
                                                                            <div class="col-12 col-md-4 mb-3">
                                                                                <label class="form-label">Total
                                                                                    Hours</label>
                                                                                <input type="text" class="form-control"
                                                                                    placeholder="Total Hours"
                                                                                    name="total_hours"
                                                                                    value="{{ $report->total_hours }}"
                                                                                    readonly>
                                                                            </div>
                                                                            <div class="col-12 col-md-4 mb-3">
                                                                                <label class="form-label">Total</label>
                                                                                <input type="text" class="form-control"
                                                                                    placeholder="Total"
                                                                                    name="total_amount"
                                                                                    value="{{ $report->total_amount }}"
                                                                                    readonly>
                                                                            </div>
                                                                            <div class="col-12 col-md-4 mb-3">
                                                                                <label class="form-label">Status</label>
                                                                                <select class="form-select mb-3"
                                                                                    name="status" required>
                                                                                    <option>Select Status</option>
                                                                                    <option value="Approved">Approve
                                                                                    </option>
                                                                                    <option value="Declined">Decline
                                                                                    </option>
                                                                                    <option value="Pending">Pending
                                                                                    </option>
                                                                                </select>
                                                                            </div>
                                                                        </div>

                                                                        <div class="row g-3">

                                                                            <div class="col-12 col-md-12 mb-3">
                                                                                <label class="form-label">Comment</label>
                                                                                <textarea name="comments" id="" cols="30" rows="10" class="form-control"> {{ $report->comments ?? ' N/A' }}</textarea>
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
                                                </tr>
                                            @endforeach


                                        </tbody>

                                    </table>
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
                                        <ul class="list-pagination pagination pagination-tabs card-pagination"></ul>

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



                        </div>

                    </div>

                </div>
            </div> <!-- / .row -->


        </div>

    </div> <!-- / .main-content -->
@endsection
