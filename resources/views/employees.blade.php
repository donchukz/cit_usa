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

                                        @if (session('status2'))
                                            <div
                                                class="text-light border border-danger bg-danger my-3 p-4 rounded text-center">
                                                {{ session('status2') }}
                                            </div>
                                            <br>
                                        @endif

                                        @if (session('status'))
                                            <div
                                                class="text-light border border-success bg-success my-3 p-4 rounded text-center">
                                                {{ session('status') }}
                                            </div>
                                            <br>
                                        @endif
                                        <div class="row align-items-center">
                                            <div class="col">
                                                <!-- Title -->
                                                <h1 class="header-title text-truncate ml-2">
                                                    Employee List
                                                </h1>

                                            </div>
                                            <div class="col-auto">


                                                <!-- Buttons -->
                                                <a href="{{ url('add-employee') }}">
                                                    <button type="button" class="btn btn-primary ml-2 employeeBtn">
                                                        + Add employee
                                                    </button>
                                                </a>

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
                                                    <a class="text-muted" href="#">Name</a>
                                                </th>
                                                <th>
                                                    <a class="text-muted">Discipline</a>
                                                </th>
                                                <th>
                                                    <a class="text-muted"> Emp Type</a>
                                                </th>
                                                <th>
                                                    <a class="text-muted">Speciality</a>
                                                </th>
                                                <th>
                                                    <a class="text-muted">Priority 1</a>
                                                </th>
                                                <th>
                                                    <a class="text-muted">Priority 2</a>
                                                </th>
                                                <th>
                                                    <a class="text-muted">Other Priority</a>
                                                </th>
                                                <th>
                                                    <a class="text-muted">Status</a>
                                                </th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody class="list font-size-base">
                                            @if ($employees->count())
                                                @foreach ($employees as $key => $employee)
                                                    <tr>
                                                        <td>
                                                            <!-- Text -->
                                                            <span>{{ $key + 1 }}</span>

                                                        </td>

                                                        <td>
                                                            <span> {{ $employee->name }}</span>
                                                        </td>
                                                        <td>
                                                            <span>{{ $employee->discipline ?? 'N/A' }}</span>
                                                        </td>
                                                        <td>
                                                            <span>{{ $employee->emp_type ?? 'N/A' }}</span>
                                                        </td>
                                                        <td>
                                                            <span>
                                                                @foreach (json_decode($employee->specialty) as $item)
                                                                    {{ $item }},
                                                                @endforeach
                                                            </span>
                                                        </td>
                                                        <td>
                                                            <span>{{ $employee->priority1 ?? 'N/A' }}</span>
                                                        </td>
                                                        <td>
                                                            <span>{{ $employee->priority2 ?? 'N/A' }}</span>
                                                        </td>
                                                        <td>
                                                            <span>{{ $employee->other_area ?? 'N/A' }}</span>
                                                        </td>
                                                        <td>
                                                            <span>
                                                                <button
                                                                    class="btn btn-outline-success">{{ $employee->status }}</button>
                                                            </span>
                                                        </td>
                                                        <td>
                                                            <span>
                                                                <button type="button" class="editbtn" data-toggle="modal"
                                                                    data-target="#editEmp{{ $key }}"><i
                                                                        class="fe fe-edit-3"></i></button>
                                                            </span>
                                                        </td>
                                                        <div class="modal fade " id="editEmp{{ $key }}"
                                                            tabindex="-1" role="dialog" aria-hidden="true">
                                                            <div class="modal-dialog modal-dialog-centered modalMembers"
                                                                role="document">
                                                                <div class="modal-content modalMembers">
                                                                    <div class="card-header">

                                                                        <!-- Title -->
                                                                        <h2 class="card-header-title">
                                                                            Edit Employee
                                                                        </h2>

                                                                        <!-- Close -->
                                                                        <button type="button" class="close"
                                                                            data-dismiss="modal" aria-label="Close">
                                                                            <span aria-hidden="true">&times;</span>
                                                                        </button>

                                                                    </div>
                                                                    <div class="card-body modalMembers">
                                                                        <form
                                                                            action="{{ url('update-employee', $employee->id) }}"
                                                                            method="POST">
                                                                            @csrf
                                                                            <div class="row g-3">
                                                                                <div class="col-12 col-md-4 mb-3">
                                                                                    <label class="form-label">Employee
                                                                                        Name</label>
                                                                                    <input type="text" name="name"
                                                                                        class="form-control  @error('name') border border-danger @enderror"
                                                                                        placeholder="Employee Name"
                                                                                        value="{{ $employee->name }}">
                                                                                    @error('name')
                                                                                        <div class="text-danger">
                                                                                            {{ $message }}
                                                                                        </div>
                                                                                    @enderror
                                                                                </div>
                                                                                <div class="col-12 col-md-4 mb-3">
                                                                                    <label class="form-label">Email</label>
                                                                                    <input type="email" name="email"
                                                                                        class="form-control @error('email') border border-danger @enderror"
                                                                                        placeholder="stephen@gmail.app"
                                                                                        value="{{ $employee->email }}"
                                                                                        required>
                                                                                    @error('email')
                                                                                        <div class="text-danger">
                                                                                            {{ $message }}
                                                                                        </div>
                                                                                    @enderror
                                                                                </div>
                                                                                <div class="col-12 col-md-4 mb-3">
                                                                                    <label
                                                                                        class="form-label">Discipline</label>
                                                                                    <select name="discipline"
                                                                                        class="form-select mb-3  @error('discipline') border border-danger @enderror"
                                                                                        data-choices>
                                                                                        <option
                                                                                            value="{{ $employee->discipline }}">
                                                                                            {{ $employee->discipline }}
                                                                                        </option>
                                                                                        <option value="RN">RN </option>
                                                                                        <option value="LVN">LVN</option>
                                                                                        <option value="PT">PT </option>
                                                                                        <option value="PTA">PTA</option>
                                                                                        <option value="OT">OT </option>
                                                                                        <option value="COTA">COTA
                                                                                        </option>
                                                                                        <option value="MSW">MSW
                                                                                        </option>
                                                                                        <option value="ST">ST</option>
                                                                                        <option value="HHA">HHA
                                                                                        </option>
                                                                                    </select>
                                                                                    @error('discipline')
                                                                                        <div class="text-danger">
                                                                                            {{ $message }}
                                                                                        </div>
                                                                                    @enderror
                                                                                </div>
                                                                                <div class="col-12 col-md-4 mb-3">
                                                                                    <label class="form-label">Type of
                                                                                        Employement</label>
                                                                                    <select name="employment"
                                                                                        class="form-select mb-3  @error('employment') border border-danger @enderror"
                                                                                        data-choices>
                                                                                        <option
                                                                                            value="{{ $employee->emp_type }}"
                                                                                            selected>
                                                                                            {{ $employee->emp_type }}
                                                                                        </option>
                                                                                        <option value="Full Time">Full Time
                                                                                        </option>
                                                                                        <option value="Part Time">Part Time
                                                                                        </option>
                                                                                        <option value="PRB">PRB
                                                                                        </option>
                                                                                        <option value="Contractor">
                                                                                            Contractor</option>
                                                                                        <option value="Registry">Registry
                                                                                        </option>
                                                                                    </select>
                                                                                    @error('employment')
                                                                                        <div class="text-danger">
                                                                                            {{ $message }}
                                                                                        </div>
                                                                                    @enderror
                                                                                </div>

                                                                                <div class="col-12 col-md-4 mb-3">
                                                                                    <label
                                                                                        class="form-label">Specialty</label>
                                                                                    <select name="specialty" multiple
                                                                                        class="form-select mb-3 form-select  @error('specialty') border border-danger @enderror"
                                                                                        data-choices>
                                                                                        @php
                                                                                            $specs = \App\Models\Specialty::get();
                                                                                        @endphp
                                                                                        @foreach (json_decode($employee->specialty) as $item)
                                                                                            <option
                                                                                                value="{{ $item }}"
                                                                                                selected>
                                                                                                {{ $item }}
                                                                                            </option>
                                                                                        @endforeach
                                                                                        @foreach ($specs as $spec)
                                                                                            <option
                                                                                                value="{{ $spec->name }}">
                                                                                                {{ $spec->name }}
                                                                                            </option>
                                                                                        @endforeach
                                                                                    </select>
                                                                                    @error('specialty')
                                                                                        <div class="text-danger">
                                                                                            {{ $message }}
                                                                                        </div>
                                                                                    @enderror
                                                                                </div>
                                                                                <div class="col-12 col-md-4 mb-3"
                                                                                    id="custom-search-input">
                                                                                    <label
                                                                                        class="form-label">Address</label>
                                                                                    <div class="input-group">

                                                                                        <input id="autocomplete_search"
                                                                                            name="address" type="text"
                                                                                            class="form-control  @error('address') border border-danger @enderror"
                                                                                            placeholder="Search"
                                                                                            value="{{ $employee->address }}" />

                                                                                        <input type="hidden"
                                                                                            name="lat">

                                                                                        <input type="hidden"
                                                                                            name="long">
                                                                                        @error('address')
                                                                                            <div class="text-danger">
                                                                                                {{ $message }}
                                                                                            </div>
                                                                                        @enderror
                                                                                    </div>

                                                                                </div>
                                                                                <div class="col-12 col-md-4 mb-3">
                                                                                    <label class="form-label">Priority Area
                                                                                        Coverage 1</label>
                                                                                    <input type="text" name="priority1"
                                                                                        class="form-control  @error('priority1') border border-danger @enderror"
                                                                                        placeholder="Priority Area Coverage 1"
                                                                                        value="{{ $employee->priority1 }}">
                                                                                    @error('priority1')
                                                                                        <div class="text-danger">
                                                                                            {{ $message }}
                                                                                        </div>
                                                                                    @enderror
                                                                                </div>
                                                                                <div class="col-12 col-md-4 mb-3">
                                                                                    <label class="form-label">Priority Area
                                                                                        coverage 2</label>
                                                                                    <input type="text" name="priority2"
                                                                                        class="form-control  @error('priority2') border border-danger @enderror"
                                                                                        placeholder="Priority Area coverage 2"
                                                                                        value="{{ $employee->priority2 }}">
                                                                                    @error('priority2')
                                                                                        <div class="text-danger">
                                                                                            {{ $message }}
                                                                                        </div>
                                                                                    @enderror
                                                                                </div>
                                                                                <div class="col-12 col-md-4 mb-3">
                                                                                    <label class="form-label">Priority Area
                                                                                        Coverage 3</label>
                                                                                    <input type="text" name="priority3"
                                                                                        class="form-control  @error('priority3') border border-danger @enderror"
                                                                                        placeholder="Priority Area Coverage 3"
                                                                                        value="{{ $employee->priority3 }}">
                                                                                    @error('priority3')
                                                                                        <div class="text-danger">
                                                                                            {{ $message }}
                                                                                        </div>
                                                                                    @enderror
                                                                                </div>
                                                                                <div class="col-12 col-md-4 mb-3">
                                                                                    <label class="form-label">Other Coverge
                                                                                        Area</label>
                                                                                    <input type="text"
                                                                                        name="other_area"
                                                                                        class="form-control  @error('other_area') border border-danger @enderror"
                                                                                        placeholder="Other Coverge Area"
                                                                                        value="{{ $employee->other_area }}">
                                                                                    @error('other_area')
                                                                                        <div class="text-danger">
                                                                                            {{ $message }}
                                                                                        </div>
                                                                                    @enderror
                                                                                </div>
                                                                            </div>
                                                                            @php
                                                                                $visits = \App\Models\Rate::get();
                                                                                $times = \App\Models\EmpTime::get();
                                                                            @endphp
                                                                            @foreach (json_decode($employee->emp_availability) as $item)
                                                                                @php
                                                                                    $empDay = \App\Models\EmpAvail::findOrFail($item);
                                                                                    $empTime = \App\Models\EmpTime::findOrFail($empDay->time);
                                                                                @endphp
                                                                                <div class="row g-3 mt-2">
                                                                                    {{-- <div class="wrapper"> --}}
                                                                                    <div
                                                                                        class="d-flex flex-wrap justify-content-between">
                                                                                        <div class="col-md-5">
                                                                                            {{-- <label class="form-label">Rate</label> --}}
                                                                                            <select name="day[]"
                                                                                                class="form-select @error('hourlyrate') border border-danger @enderror"
                                                                                                data-choices>
                                                                                                <option
                                                                                                    value="{{ $empDay->day }}">
                                                                                                    {{ $empDay->day }}
                                                                                                </option>
                                                                                                <option value="Monday">
                                                                                                    Monday
                                                                                                </option>
                                                                                                <option value="Tuesday">
                                                                                                    Tuesday
                                                                                                </option>
                                                                                                <option value="Wednesday">
                                                                                                    Wednesday </option>
                                                                                                <option value="Thursday">
                                                                                                    Thursday</option>
                                                                                                <option value="Friday">
                                                                                                    Friday
                                                                                                </option>
                                                                                                <option value="Saturday">
                                                                                                    Saturday</option>
                                                                                                <option value="Sunday">
                                                                                                    Sunday
                                                                                                </option>
                                                                                                <option
                                                                                                    value="Monday-Friday">
                                                                                                    Monday - Friday
                                                                                                </option>
                                                                                            </select>
                                                                                        </div>
                                                                                        <div class="col-md-5">
                                                                                            {{-- <label class="form-label">Hourly Rate</label> --}}
                                                                                            <select name="time[]"
                                                                                                class="form-select @error('hourlyrate') border border-danger @enderror"
                                                                                                data-choices>
                                                                                                <option
                                                                                                    value="{{ $empTime->from_time }}-{{ $empTime->from_time }}">
                                                                                                    {{ $empTime->from_time }}-{{ $empTime->from_time }}
                                                                                                </option>
                                                                                                <option value="8am-12pm">
                                                                                                    8am-12pm</option>
                                                                                                <option value="2pm-5pm">
                                                                                                    2pm-5pm
                                                                                                </option>
                                                                                                <option value="7pm-11pm">
                                                                                                    7pm-11pm </option>
                                                                                                <option
                                                                                                    value="Not Available">
                                                                                                    Not Available</option>
                                                                                            </select>
                                                                                        </div>
                                                                                        <iconify-icon
                                                                                            icon="ic:baseline-remove-circle"
                                                                                            width="40" height="40"
                                                                                            class="remove_field">
                                                                                        </iconify-icon>
                                                                                    </div>
                                                                                </div>
                                                                            @endforeach
                                                                            <div class="row g-3 time mt-2">
                                                                                <div
                                                                                    class="d-flex flex-wrap justify-content-between">
                                                                                    <div class="col-md-5">
                                                                                        <select name="day[]"
                                                                                            class="form-select @error('hourlyrate') border border-danger @enderror"
                                                                                            data-choices>
                                                                                            <option> Days Available</option>
                                                                                            <option value="Monday">Monday
                                                                                            </option>
                                                                                            <option value="Tuesday">Tuesday
                                                                                            </option>
                                                                                            <option value="Wednesday">
                                                                                                Wednesday </option>
                                                                                            <option value="Thursday">
                                                                                                Thursday</option>
                                                                                            <option value="Friday">Friday
                                                                                            </option>
                                                                                            <option value="Saturday">
                                                                                                Saturday</option>
                                                                                            <option value="Sunday">Sunday
                                                                                            </option>
                                                                                            <option value="Monday-Friday">
                                                                                                Monday - Friday
                                                                                            </option>
                                                                                        </select>
                                                                                    </div>
                                                                                    <div class="col-md-5">
                                                                                        <select name="time[]"
                                                                                            class="form-select @error('hourlyrate') border border-danger @enderror"
                                                                                            data-choices>
                                                                                            <option>Time Available</option>
                                                                                            <option value="8am-12pm">
                                                                                                8am-12pm</option>
                                                                                            <option value="2pm-5pm">2pm-5pm
                                                                                            </option>
                                                                                            <option value="7pm-11pm">
                                                                                                7pm-11pm </option>
                                                                                            <option value="Not Available">
                                                                                                Not Available</option>
                                                                                        </select>
                                                                                    </div>
                                                                                    <iconify-icon
                                                                                        icon="material-symbols:add-circle-rounded"
                                                                                        class="add_time" width="40"
                                                                                        height="40">
                                                                                    </iconify-icon>
                                                                                </div>
                                                                            </div>
                                                                            @foreach (json_decode($employee->visit_rate) as $item)
                                                                                @php
                                                                                    $emp_rate = \App\Models\UserRate::findOrFail($item);
                                                                                    $rate_type = \App\Models\Rate::findOrFail($emp_rate->rate_id);
                                                                                @endphp
                                                                                <div class="row g-3 wrapper mt-3">
                                                                                    {{-- <div class="wrapper"> --}}
                                                                                    <div
                                                                                        class="d-flex flex-wrap justify-content-between">
                                                                                        <div class="col-md-5">
                                                                                            {{-- <label class="form-label">Rate</label> --}}
                                                                                            <select name="rate[]"
                                                                                                class="form-select @error('hourlyrate') border border-danger @enderror"
                                                                                                data-choices>
                                                                                                <option
                                                                                                    value="{{ $rate_type->id }}">
                                                                                                    {{ $rate_type->name }}
                                                                                                </option>
                                                                                                <option value="SOC">SOC
                                                                                                    (Reg
                                                                                                    and Weekend Rate)
                                                                                                </option>
                                                                                                <option value="ROC">ROC
                                                                                                    /
                                                                                                    Recert / SN Eval Rate
                                                                                                </option>
                                                                                                <option value="DC">DC
                                                                                                    Oasis
                                                                                                    Rate </option>
                                                                                                <option
                                                                                                    value="Regular Visit Rate">
                                                                                                    Regular Visit Rate
                                                                                                </option>
                                                                                                <option
                                                                                                    value="Non-Visit DC Oasis Rate">
                                                                                                    Non-Visit DC Oasis Rate
                                                                                                </option>
                                                                                                <option value="Mileage">
                                                                                                    Mileage
                                                                                                </option>
                                                                                                <option
                                                                                                    value="Reimbursement">
                                                                                                    Reimbursement</option>
                                                                                            </select>
                                                                                        </div>
                                                                                        <div class="col-md-5">
                                                                                            {{-- <label class="form-label">Hourly Rate</label> --}}
                                                                                            <input type="text"
                                                                                                class="form-control"
                                                                                                placeholder="Hourly Rate"
                                                                                                name="hourly_rate[]"
                                                                                                value="{{ $emp_rate->amount }}">
                                                                                        </div>
                                                                                        <iconify-icon
                                                                                            icon="material-symbols:add-circle-rounded"
                                                                                            class="add_fields"
                                                                                            width="40" height="40">
                                                                                        </iconify-icon>
                                                                                    </div>
                                                                                </div>
                                                                            @endforeach

                                                                            <div class="row g-3 mt-3">
                                                                                <div class="col-12 col-md-4 mb-3">
                                                                                    <label class="form-label">Hire
                                                                                        Date</label>
                                                                                    <input type="date" name="date"
                                                                                        class="form-control  @error('date') border border-danger @enderror"
                                                                                        placeholder="__/__/____"
                                                                                        value="{{ $employee->date }}">
                                                                                    <!--data-inputmask="'mask': 'MM/DD/YYYY'"-->

                                                                                        @error('date')
                                                                                            <div class="text-danger">
                                                                                                {{ $message }}
                                                                                            </div>
                                                                                        @enderror
                                                                                </div>
                                                                                <div class="col-12 col-md-4 mb-3">
                                                                                    <label
                                                                                        class="form-label">Status</label>
                                                                                    <select name="status"
                                                                                        class="form-select  @error('status') border border-danger @enderror">
                                                                                        <option
                                                                                            value="{{ $employee->status }}"
                                                                                            selected>
                                                                                            {{ $employee->status }}
                                                                                        </option>
                                                                                        <option>Select Status</option>
                                                                                        <option value="Active">Active
                                                                                        </option>
                                                                                        <option value="Inactive">Inactive
                                                                                        </option>
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
                                                                                <button type="submit"
                                                                                    class="btn btn-primary ml-2 addemployeModalBtn employeeBtn">
                                                                                    + Update employee
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
                                                <p class="ml-4"> You have no employees</p>
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
                            <form action="{{ url('dashboard') }}" method="POST">
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
                                        <label class="form-label">Email</label>
                                        <input type="email" name="email"
                                            class="form-control @error('email') border border-danger @enderror"
                                            placeholder="stephen@gmail.app" required>
                                        @error('email')
                                            <div class="text-danger">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="col-12 col-md-4 mb-3">
                                        <label class="form-label">Discipline</label>
                                        <select name="discipline"
                                            class="form-select mb-3  @error('discipline') border border-danger @enderror"
                                            data-choices>
                                            <option>Select Discipline</option>
                                            <option value="RN">RN </option>
                                            <option value="LVN">LVN</option>
                                            <option value="PT">PT </option>
                                            <option value="PTA">PTA</option>
                                            <option value="OT">OT </option>
                                            <option value="COTA">COTA</option>
                                            <option value="MSW">MSW </option>
                                            <option value="ST">ST</option>
                                            <option value="HHA">HHA </option>
                                        </select>
                                        @error('discipline')
                                            <div class="text-danger">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="col-12 col-md-4 mb-3">
                                        <label class="form-label">Type of Employement</label>
                                        <select name="employment"
                                            class="form-select mb-3  @error('employment') border border-danger @enderror"
                                            data-choices>
                                            <option>Select Employment</option>
                                            <option value="Full Time">Full Time </option>
                                            <option value="Part Time">Part Time</option>
                                            <option value="PRB">PRB </option>
                                            <option value="Contractor">Contractor</option>
                                            <option value="Registry">Registry </option>
                                        </select>
                                        @error('employment')
                                            <div class="text-danger">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>

                                    <div class="col-12 col-md-4 mb-3">
                                        <label class="form-label">Specialty</label>
                                        <select name="specialty[]" multiple
                                            class="form-select mb-3 form-select  @error('specialty') border border-danger @enderror"
                                            data-choices>
                                            <option>Select Specialty</option>
                                            <option value="Insulin">Insulin </option>
                                            <option value="Wound Vac">Wound Vac</option>
                                            <option value="Blood Draw">Blood Draw </option>
                                            <option value="Infusion">Infusion</option>
                                        </select>
                                        @error('specialty')
                                            <div class="text-danger">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>

                                    <div class="col-12 col-md-4 mb-3">
                                        <label class="form-label">Address</label>

                                        <input type="text" name="address" id="address-input"
                                            class="form-control  @error('address') border border-danger @enderror"
                                            placeholder="Address" id="">
                                        @error('address')
                                            <div class="text-danger">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                        <input type="hidden" name="address_latitude" id="address-latitude"
                                            value="" required />
                                        <input type="hidden" name="address_longitude" id="address-longitude"
                                            value="" required />
                                    </div>
                                    <div class="col-12 col-md-4 mb-3">
                                        <label class="form-label">Priority Area Coverage 1</label>
                                        <input type="text" name="priority1"
                                            class="form-control  @error('priority1') border border-danger @enderror"
                                            placeholder="Priority Area Coverage 1">
                                        @error('priority1')
                                            <div class="text-danger">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="col-12 col-md-4 mb-3">
                                        <label class="form-label">Priority Area coverage 2</label>
                                        <input type="text" name="priority2"
                                            class="form-control  @error('priority2') border border-danger @enderror"
                                            placeholder="Priority Area coverage 2">
                                        @error('priority2')
                                            <div class="text-danger">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="col-12 col-md-4 mb-3">
                                        <label class="form-label">Priority Area Coverage 3</label>
                                        <input type="text" name="priority3"
                                            class="form-control  @error('priority3') border border-danger @enderror"
                                            placeholder="Priority Area Coverage 3">
                                        @error('priority3')
                                            <div class="text-danger">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="col-12 col-md-4 mb-3">
                                        <label class="form-label">Other Coverge Area</label>
                                        <input type="text" name="other_area"
                                            class="form-control  @error('other_area') border border-danger @enderror"
                                            placeholder="Other Coverge Area">
                                        @error('other_area')
                                            <div class="text-danger">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row g-3 time mt-2">
                                    {{-- <div class="wrapper"> --}}
                                    <div class="d-flex flex-wrap justify-content-between">
                                        <div class="col-md-5">
                                            {{-- <label class="form-label">Rate</label> --}}
                                            <select name="day[]" required
                                                class="form-select @error('hourlyrate') border border-danger @enderror"
                                                data-choices>
                                                <option> Days Available</option>
                                                <option value="Monday">Monday </option>
                                                <option value="Tuesday">Tuesday</option>
                                                <option value="Wednesday">Wednesday </option>
                                                <option value="Thursday">Thursday</option>
                                                <option value="Friday">Friday</option>
                                                <option value="Saturday">Saturday</option>
                                                <option value="Sunday">Sunday</option>
                                            </select>
                                        </div>
                                        <div class="col-md-5">
                                            {{-- <label class="form-label">Hourly Rate</label> --}}
                                            <select name="time[]" required
                                                class="form-select @error('hourlyrate') border border-danger @enderror"
                                                data-choices>
                                                <option>Time Available</option>
                                                <option value="8am-12pm"> 8am-12pm</option>
                                                <option value="2pm-5pm">2pm-5pm</option>
                                                <option value="7pm-11pm">7pm-11pm </option>
                                                <option value="Not Available">Not Available</option>
                                            </select>
                                        </div>
                                        <iconify-icon icon="material-symbols:add-circle-rounded" class="add_time"
                                            width="40" height="40">
                                        </iconify-icon>
                                    </div>
                                </div>

                                <div class="row g-3 wrapper mt-3">
                                    {{-- <div class="wrapper"> --}}
                                    <div class="d-flex flex-wrap justify-content-between">
                                        <div class="col-md-5">
                                            {{-- <label class="form-label">Rate</label> --}}
                                            <select name="rate[]" required
                                                class="form-select @error('hourlyrate') border border-danger @enderror"
                                                data-choices>
                                                <option>Select Rate</option>
                                                <option value="SOC">SOC (Reg and Weekend Rate) </option>
                                                <option value="ROC">ROC / Recert / SN Eval Rate</option>
                                                <option value="DC">DC Oasis Rate </option>
                                                <option value="Regular Visit Rate">Regular Visit Rate</option>
                                                <option value="Non-Visit DC Oasis Rate">Non-Visit DC Oasis Rate
                                                </option>
                                                <option value="Mileage">Mileage</option>
                                                <option value="Reimbursement">Reimbursement</option>
                                            </select>
                                        </div>
                                        <div class="col-md-5">
                                            {{-- <label class="form-label">Hourly Rate</label> --}}
                                            <input type="text" class="form-control" placeholder="Hourly Rate"
                                                name="hourly_rate[]" required>
                                        </div>
                                        <iconify-icon icon="material-symbols:add-circle-rounded" class="add_fields"
                                            width="40" height="40">
                                        </iconify-icon>
                                    </div>
                                </div>
                                <div class="row g-3 mt-3">
                                    <div class="col-12 col-md-4 mb-3">
                                        <label class="form-label">Hire Date</label>
                                        <input type="date" name="date"
                                            class="form-control  @error('date') border border-danger @enderror"
                                            placeholder="__/__/____">
                                        <!--data-inputmask="'mask': 'MM/DD/YYYY'"-->

                                            @error('date')
                                                <div class="text-danger">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                    </div>
                                    <div class="col-12 col-md-4 mb-3">
                                        <label class="form-label">Status</label>
                                        <select name="status"
                                            class="form-select  @error('status') border border-danger @enderror">
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
