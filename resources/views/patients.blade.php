@extends('layout.app')
<style>
    .pac-container {
        z-index: 10000 !important;
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

                            <!-- Card -->
                            <div class="card" id="companiesList">
                                <!-- Header -->
                                <div class="p-3">
                                    <div class="tableHeadr">

                                        <div class="row align-items-center">
                                            <div class="col">


                                                @if (session('status2'))
                                                    <div class="text-light border border-danger bg-danger p-3 text-center">
                                                        {{ session('status2') }}
                                                    </div>
                                                    <br>
                                                @endif

                                                @if (session('status'))
                                                    <div
                                                        class="text-light border border-success bg-success p-3 text-center">
                                                        {{ session('status') }}
                                                    </div>
                                                    <br>
                                                @endif
                                                <div class="p-3">
                                                    <div class="tableHeadr">

                                                        <div class="row align-items-center">
                                                            <div class="col">


                                                                <!-- Title -->
                                                                <h1 class="header-title text-truncate ml-2">
                                                                    Patients
                                                                </h1>

                                                            </div>
                                                            <div class="col-auto">

                                                                <button type="button" class="btn btn-primary"
                                                                    data-toggle="modal" data-target="#addPatient">Add
                                                                    Patient</button>


                                                            </div>
                                                        </div> <!-- / .row -->
                                                    </div>
                                                </div>

                                                <!-- Title -->
                                                <div class="d-flex flex-wrap justify-content-start">
                                                    <div class="mx-3 my-1">
                                                        <input type="text" name="name"
                                                            class="form-control  @error('name') border border-danger @enderror"
                                                            placeholder="Patient Name">
                                                    </div>
                                                    <div class="mx-3 my-1">
                                                        <input type="text" name="name"
                                                            class="form-control  @error('name') border border-danger @enderror"
                                                            placeholder="Patient Zip Code">
                                                    </div>
                                                    <div class="mx-3 my-1">

                                                        <select name="position"
                                                            class="form-select mb-3  @error('position') border border-danger @enderror"
                                                            data-choices>
                                                            <option>Specialty</option>
                                                            <option value="position 1">Position 1 </option>
                                                            <option value="position 2">Position 2</option>
                                                        </select>
                                                    </div>
                                                    <div class="mx-3 my-1">
                                                        <input type="date" name="name"
                                                            class="form-control  @error('name') border border-danger @enderror"
                                                            placeholder="Date/Time">
                                                    </div>
                                                    <div class="mx-3 my-1">
                                                        <button type="button" class="btn btn-primary ml-2 employeeBtn">
                                                            Search
                                                        </button>
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
                                                    <a class="text-muted" href="#"> Name</a>
                                                </th>
                                                <th>
                                                    <a class="text-muted">Address</a>
                                                </th>
                                                <th>
                                                    <a class="text-muted">Status</a>
                                                </th>
                                                <th></th>

                                            </tr>
                                        </thead>
                                        <tbody class="list font-size-base">
                                            @if ($patients->count() > 0)
                                                @foreach ($patients as $key => $patient)
                                                    <tr>
                                                        <td>
                                                            <!-- Text -->
                                                            <span>{{ $key + 1 }}</span>

                                                        </td>
                                                        <td>
                                                            <span>{{ $patient->name }}</span>
                                                        </td>
                                                        <td>
                                                            <span>{{ $patient->address }}</span>
                                                        </td>
                                                        <td>
                                                            <span>{{ $patient->status }}</span>
                                                        </td>
                                                        <td>
                                                            <span>
                                                                <button type="button" class="editbtn" data-toggle="modal"
                                                                    data-target="#editPatient{{ $key }}"><i
                                                                        class="fe fe-edit-3"></i></button>
                                                            </span>
                                                        </td>
                                                        <div class="modal fade " id="editPatient{{ $key }}"
                                                            tabindex="-1" role="dialog" aria-hidden="true">
                                                            <div class="modal-dialog modal-dialog-centered editMembers"
                                                                role="document">
                                                                <div class="modal-content editMembers">
                                                                    <div class="card-header">

                                                                        <!-- Title -->
                                                                        <h2 class="card-header-title">
                                                                            Edit Patient
                                                                        </h2>

                                                                        <!-- Close -->
                                                                        <button type="button" class="close"
                                                                            data-dismiss="modal" aria-label="Close">
                                                                            <span aria-hidden="true">&times;</span>
                                                                        </button>

                                                                    </div>
                                                                    <div class="card-body editMembers">
                                                                        <form method="POST"
                                                                            action="{{ url('update-patient', $patient->id) }}">
                                                                            @csrf
                                                                            <div class="row g-3">
                                                                                <div class="col-12 col-md-6 mb-3">
                                                                                    <label class="form-label">Patient
                                                                                        Name</label>
                                                                                    <input type="text"
                                                                                        class="form-control" name="name"
                                                                                        value="{{ $patient->name }}">

                                                                                </div>
                                                                                <div class="col-12 col-md-6 mb-3"
                                                                                    id="customs-search-inputs">
                                                                                    <label
                                                                                        class="form-label">Address</label>
                                                                                    <div class="input-group">
                                                                                        @php
                                                                                            $key = Str::random(2);
                                                                                        @endphp
                                                                                        <input id="autocompleted_searches"
                                                                                            name="address" type="text"
                                                                                            class="form-control  @error('address') border border-danger @enderror"
                                                                                            placeholder="Search"
                                                                                            value="{{ $patient->address }}" />

                                                                                        <input type="hidden"
                                                                                            id="key"
                                                                                            value="{{ $key }}">

                                                                                        <input type="hidden"
                                                                                            name="long">
                                                                                        @error('address')
                                                                                            <div class="text-danger">
                                                                                                {{ $message }}
                                                                                            </div>
                                                                                        @enderror
                                                                                    </div>

                                                                                </div>
                                                                            </div>
                                                                            <div class="row g-3">

                                                                                <div class="col-12 col-md-6 mb-3">
                                                                                    <label
                                                                                        class="form-label">Status</label>
                                                                                    <select name="status"
                                                                                        class="form-select"
                                                                                        id="">
                                                                                        <option
                                                                                            value="{{ $patient->status }}">
                                                                                            {{ $patient->status }}</option>
                                                                                        @if ($patient->status == 'Active')
                                                                                            <option value="Inactive">
                                                                                                Inactive</option>
                                                                                        @else
                                                                                            <option value="Active">Active
                                                                                            </option>
                                                                                        @endif
                                                                                    </select>

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
                                            @else
                                                <h3>No Data Available</h3>
                                            @endif



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
            <div class="modal fade " id="addPatient" tabindex="-1" role="dialog" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modalMembers" role="document">
                    <div class="modal-content modalMembers">
                        <div class="card-header">

                            <!-- Title -->
                            <h2 class="card-header-title">
                                Add Patient
                            </h2>

                            <!-- Close -->
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>

                        </div>
                        <div class="card-body modalMembers">
                            <form action="{{ url('add-patient') }}" method="post">
                                @csrf
                                <div class="row g-3">
                                    <div class="col-12 col-md-4 mb-3">
                                        <label class="form-label">Patient Name</label>
                                        <input type="text" name="name"
                                            class="form-control  @error('name') border border-danger @enderror"
                                            placeholder="Patient Name">
                                        @error('name')
                                            <div class="text-danger">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="col-12 col-md-4 mb-3" id="customs-search-input">
                                        <label class="form-label">Address</label>
                                        <div class="input-group">

                                            <input id="autocompleted_search" name="address" type="text"
                                                class="form-control  @error('address') border border-danger @enderror"
                                                placeholder="Search" />

                                            <input type="hidden" name="lat">

                                            <input type="hidden" name="long">
                                            @error('address')
                                                <div class="text-danger">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>

                                    </div>
                                    <div class="col-12 col-md-4 mb-3">
                                        <label class="form-label">Status</label>
                                        <select name="status"
                                            class="form-select mb-3  @error('status') border border-danger @enderror"
                                            data-choices>
                                            <option>Select Status</option>
                                            <option value="Active">Active </option>
                                            <option value="Inactive">Inactive</option>
                                        </select>
                                        @error('status')
                                            <div class="text-danger">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>

                                </div>


                                <div class="col-auto">
                                    <!-- Button -->
                                    <button type="submit" class="btn btn-primary ml-2 addemployeModalBtn employeeBtn">
                                        Submit
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
