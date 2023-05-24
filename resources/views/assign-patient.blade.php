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


                                                @if (session('status'))
                                                    <center class="text-light border border-danger bg-danger my-3">
                                                        {{ session('status2') }}
                                                    </center>
                                                    <br>
                                                @endif

                                                @if (session('status'))
                                                    <center class="text-light border border-success bg-success my-3">
                                                        {{ session('status') }}
                                                    </center>
                                                    <br>
                                                @endif

                                                <!-- Title -->
                                                <div class="d-flex flex-wrap justify-content-between align-items-end">
                                                    <div class=" my-1">
                                                        <label for="">Find Employee</label>
                                                        <input type="text" name="name"
                                                            class="form-control  @error('name') border border-danger @enderror"
                                                            placeholder="Patient Name">
                                                    </div>

                                                    <div class=" my-1">
                                                        <button type="button" class="btn btn-primary">
                                                            Search
                                                        </button>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-8">
                                                        <div class="d-flex flex-wrap justify-content-between mt-5">
                                                            <div class="mr-1">
                                                                <h4 class="header-pretitle ml-3">
                                                                    Employee Name
                                                                </h4>
                                                                <h3 class="header-title text-truncate ml-3">
                                                                    Joseph Emma
                                                                </h3>
                                                            </div>
                                                            <div class="mr-1">
                                                                <h4 class="header-pretitle ml-3">
                                                                    Disciple
                                                                </h4>
                                                                <h3 class="header-title text-truncate ml-3">
                                                                    RN
                                                                </h3>
                                                            </div>
                                                            <div class="mr-1">
                                                                <h4 class="header-pretitle ml-3">
                                                                    Address
                                                                </h4>
                                                                <h3 class="header-title text-truncate ml-3">
                                                                    St. Mambi Jo
                                                                </h3>
                                                            </div>
                                                            <div class="mr-1">
                                                                <h4 class="header-pretitle ml-3">
                                                                    Coverage Area
                                                                </h4>
                                                                <h3 class="header-title text-truncate ml-3">
                                                                    Los Angeles
                                                                </h3>
                                                            </div>
                                                        </div>
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
                                                    <a class=" text-muted" href="#">Ref</a>
                                                </th>
                                                <th>
                                                    <a class="text-muted" href="#">Employee Name</a>
                                                </th>
                                                <th>
                                                    <a class="text-muted">Discipline</a>
                                                </th>
                                                <th>
                                                    <a class="text-muted">No. of Active Patients</a>
                                                </th>
                                                </th>
                                                <th>
                                                    <a class="text-muted">Priority 1</a>
                                                </th>
                                                <th>
                                                    <a class="text-muted">Priority 2</a>
                                                </th>
                                                <th>
                                                    <a class="text-muted">Priority 3</a>
                                                </th>
                                                <th>
                                                    <a class="text-muted">Other Priority</a>
                                                </th>
                                                <th>
                                                    <a class="text-muted">Time Availability</a>
                                                </th>
                                                <th>
                                                    <a class="text-muted">2wks Pt Distance</a>
                                                </th>
                                                <th>
                                                    <a class="text-muted">Assign</a>
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
                                                    <span>Sean Evans</span>
                                                </td>
                                                <td>
                                                    <span>RN</span>
                                                </td>
                                                <td>
                                                    <span>15</span>
                                                </td>
                                                <td>
                                                    <span>Sann Fransisco</span>
                                                </td>
                                                <td>
                                                    <span>San Jose</span>
                                                </td>
                                                <td>
                                                    <span>Los Angeles</span>
                                                </td>
                                                <td>
                                                    <span>Los Angeles</span>
                                                </td>
                                                <td>
                                                    <span>Active</span>
                                                </td>
                                                <td>
                                                    <span>10 miles</span>
                                                </td>
                                                <td>
                                                    <span>
                                                        <button type="button" class="editbtn" data-toggle="modal"
                                                            data-target="#editMembers"><i
                                                                class="fe fe-check-square"></i></button>
                                                    </span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <!-- Text -->
                                                    <span>1</span>

                                                </td>
                                                <td>
                                                    <span>Sean Evans</span>
                                                </td>
                                                <td>
                                                    <span>RN</span>
                                                </td>
                                                <td>
                                                    <span>15</span>
                                                </td>
                                                <td>
                                                    <span>Sann Fransisco</span>
                                                </td>
                                                <td>
                                                    <span>San Jose</span>
                                                </td>
                                                <td>
                                                    <span>Los Angeles</span>
                                                </td>
                                                <td>
                                                    <span>Los Angeles</span>
                                                </td>
                                                <td>
                                                    <span>Active</span>
                                                </td>
                                                <td>
                                                    <span>10 miles</span>
                                                </td>
                                                <td>
                                                    <span>
                                                        <button type="button" class="editbtn" data-toggle="modal"
                                                            data-target="#editMembers"><i
                                                                class="fe fe-check-square"></i></button>
                                                    </span>
                                                </td>
                                            </tr>


                                        </tbody>

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
                                    <ul class="list-pagination pagination pagination-tabs card-pagination"></ul>

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
                                                    <input class="form-check-input" type="checkbox" id="cardAlertCheckbox"
                                                        checked disabled>
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
                            <div class="card" id="companiesList">
                                <!-- Header -->
                                <div class="p-3">
                                    <div class="tableHeadr">

                                        <div class="row align-items-center">
                                            <div class="col">
                                                <!-- Title -->
                                                <div class="d-flex justify-content-start flex-wrap ">
                                                    <h2 class="header-title text-truncate ml-3 mr-4">
                                                        Availability
                                                    </h2>
                                                    <div class="mr-4">
                                                        <select class="form-select " data-choices>
                                                            <option> 2 Months</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>

                                        </div> <!-- / .row -->
                                    </div>
                                </div>
                                <div class="table-responsive mx-3">
                                    <div class="row">
                                        <div class="col-md-7">
                                            <div id="calendar-week"></div>
                                        </div>
                                        <div class="col-md-5">
                                            <div id="calendar"></div>
                                            <div class="d-flex justify-content-between flex-wrap mt-3">
                                                <div>
                                                    <button class="square available"></button> Available
                                                </div>
                                                <div>
                                                    <button class="square vacation"></button> Vacation
                                                </div>
                                                <div>
                                                    <button class="square maybe"></button> Maybe
                                                </div>
                                                <div>
                                                    <button class="square unavailable"></button> Unvailable
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>

                            </div>

                        </div>

                    </div>

                </div>
            </div> <!-- / .row -->
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
                                                    Current Cases
                                                </h1>

                                            </div>
                                        </div> <!-- / .row -->
                                    </div>
                                </div>
                                <div class="tabs">

                                    <ul class="nav nav-tabs ml-4 mr-4" id="tabSwitch">
                                        <li class="nav-item">
                                            <a href="#Pay" class="nav-link ">
                                                <span>
                                                    Active
                                                </span>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="#Employee" class="nav-link ">
                                                <span>
                                                    Inactive
                                                </span>
                                            </a>
                                        </li>
                                    </ul>

                                    <div id="Pay" class="tab active pt-2">
                                        <div class="pl-3">
                                            <div class="tableHeadr">

                                                <div class="row align-items-center">
                                                    <div class="col">
                                                        <!-- Title -->
                                                        <div class="d-flex align-items-center ">
                                                            <div class="mr-4">
                                                                <select class="form-select " data-choices>
                                                                    <option> 2 Weeks </option>
                                                                </select>
                                                            </div>
                                                            <h4 class="header-title text-truncate ml-3 mr-4">
                                                                2 Patients
                                                            </h4>
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
                                                            <a class=" text-muted" href="#">Ref</a>
                                                        </th>
                                                        <th>
                                                            <a class="text-muted" href="#">Patient Name</a>
                                                        </th>
                                                        <th>
                                                            <a class="text-muted">Zip Code</a>
                                                        </th>
                                                        <th>
                                                            <a class="text-muted">Active Date</a>
                                                        </th>
                                                        <th>
                                                            <a class="text-muted">Status</a>
                                                        </th>
                                                        <th>

                                                        </th>
                                                        <th>

                                                        </th>
                                                    </tr>
                                                </thead>
                                                <tbody class="list font-size-base">
                                                    <tr>
                                                        <td>
                                                            <!-- Text -->
                                                            <span>1</span>

                                                        </td>

                                                        <td>
                                                            <span> John Doe</span>
                                                        </td>
                                                        <td>
                                                            <span>12989</span>
                                                        </td>
                                                        <td>
                                                            <span>19/09/22</span>
                                                        </td>
                                                        <td>
                                                            <span>
                                                                <button class="btn btn-outline-success">Active</button>
                                                            </span>
                                                        </td>

                                                        <td>
                                                            <a href="#"><span>View Map</span></a>
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
                                                            <span> John Doe</span>
                                                        </td>
                                                        <td>
                                                            <span>12989</span>
                                                        </td>
                                                        <td>
                                                            <span>19/09/22</span>
                                                        </td>
                                                        <td>
                                                            <span>
                                                                <button class="btn btn-outline-success">Active</button>
                                                            </span>
                                                        </td>

                                                        <td>
                                                            <a href="#"><span>View Map</span></a>
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
                                </div>

                            </div>





                        </div>

                    </div>

                </div>
            </div> <!-- / .row -->
            <div class="modal fade " id="modalMembers" tabindex="-1" role="dialog" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modalMembers" role="document">
                    <div class="modal-content modalMembers">
                        <div class="card-header">

                            <!-- Title -->
                            <h2 class="card-header-title">
                                Add Employee
                            </h2>

                            <!-- Close -->
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>

                        </div>
                        <div class="card-body modalMembers">
                            <form action="#" method="post">
                                @csrf
                                <div class="row g-3">
                                    <div class="col-12 col-md-4 mb-3">
                                        <label class="form-label">Employee Name</label>
                                        <input type="text" name="name"
                                            class="form-control  @error('name') border border-danger @enderror"
                                            placeholder="Employee Name">
                                        @error('name')
                                            <div class="text-danger">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="col-12 col-md-4 mb-3">
                                        <label class="form-label">Discipline</label>
                                        <select name="position"
                                            class="form-select mb-3  @error('position') border border-danger @enderror"
                                            data-choices>
                                            <option>Select Discipline</option>
                                            <option value="position 1">Position 1 </option>
                                            <option value="position 2">Position 2</option>
                                        </select>
                                        @error('position')
                                            <div class="text-danger">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="col-12 col-md-4 mb-3">
                                        <label class="form-label">Type of Employement</label>
                                        <select name="position"
                                            class="form-select mb-3  @error('position') border border-danger @enderror"
                                            data-choices>
                                            <option>Select Employment</option>
                                            <option value="position 1">Position 1 </option>
                                            <option value="position 2">Position 2</option>
                                        </select>
                                        @error('position')
                                            <div class="text-danger">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="col-12 col-md-4 mb-3">
                                        <label class="form-label">Priority Clinician</label>
                                        <select name="position"
                                            class="form-select mb-3  @error('position') border border-danger @enderror"
                                            data-choices>
                                            <option>Select Priority</option>
                                            <option value="position 1">Position 1 </option>
                                            <option value="position 2">Position 2</option>
                                        </select>
                                        @error('position')
                                            <div class="text-danger">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="col-12 col-md-4 mb-3">
                                        <label class="form-label">Specialty</label>
                                        <select name="position"
                                            class="form-select mb-3  @error('position') border border-danger @enderror"
                                            data-choices>
                                            <option>Select Specialty</option>
                                            <option value="position 1">Position 1 </option>
                                            <option value="position 2">Position 2</option>
                                        </select>
                                        @error('position')
                                            <div class="text-danger">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="col-12 col-md-4 mb-3">
                                        <label class="form-label">Address</label>
                                        <input type="text" name="name"
                                            class="form-control  @error('name') border border-danger @enderror"
                                            placeholder="Address">
                                        @error('name')
                                            <div class="text-danger">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="col-12 col-md-4 mb-3">
                                        <label class="form-label">Priority Area Coverage 1</label>
                                        <input type="text" name="name"
                                            class="form-control  @error('name') border border-danger @enderror"
                                            placeholder="Priority Area Coverage 1">
                                        @error('name')
                                            <div class="text-danger">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="col-12 col-md-4 mb-3">
                                        <label class="form-label">Priority Area coverage 2</label>
                                        <input type="text" name="name"
                                            class="form-control  @error('name') border border-danger @enderror"
                                            placeholder="Priority Area coverage 2">
                                        @error('name')
                                            <div class="text-danger">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="col-12 col-md-4 mb-3">
                                        <label class="form-label">Priority Area Coverage 3</label>
                                        <input type="text" name="name"
                                            class="form-control  @error('name') border border-danger @enderror"
                                            placeholder="Priority Area Coverage 3">
                                        @error('name')
                                            <div class="text-danger">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="col-12 col-md-4 mb-3">
                                        <label class="form-label">Other Coverge Area</label>
                                        <input type="text" name="name"
                                            class="form-control  @error('name') border border-danger @enderror"
                                            placeholder="Other Coverge Area">
                                        @error('name')
                                            <div class="text-danger">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="col-12 col-md-4 mb-3">
                                        <label class="form-label">Time Available</label>
                                        <input type="text" name="name"
                                            class="form-control  @error('name') border border-danger @enderror"
                                            placeholder="Time Available">
                                        @error('name')
                                            <div class="text-danger">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="col-12 col-md-4 mb-3">
                                        <label class="form-label">Status</label>
                                        <select name="position"
                                            class="form-select mb-3  @error('position') border border-danger @enderror"
                                            data-choices>
                                            <option>Select Status</option>
                                            <option value="position 1">Position 1 </option>
                                            <option value="position 2">Position 2</option>
                                        </select>
                                        @error('position')
                                            <div class="text-danger">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>


                                <div class="col-auto">
                                    <!-- Button -->
                                    <button type="submit" class="btn btn-primary ml-2 addemployeModalBtn employeeBtn">
                                        + Add employee
                                    </button>
                                </div>


                            </form>
                        </div>
                    </div>
                </div>
            </div>


        </div>

    </div> <!-- / .main-content -->
@endsection
