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
                                @if (session('status2'))
                                    <div class="text-light border border-danger bg-danger p-3 text-center">
                                        {{ session('status2') }}
                                    </div>
                                    <br>
                                @endif

                                @if (session('status'))
                                    <div class="text-light border border-success bg-success p-3 text-center">
                                        {{ session('status') }}
                                    </div>
                                    <br>
                                @endif
                                <div class="p-3">
                                    <div class="tableHeadr">

                                        <div class="row align-items-center">
                                            <div class="col">


                                                <!-- Title -->
                                                <h1 class="header-title text-truncate ml-3">
                                                    Pending
                                                </h1>

                                            </div>
                                            <div class="col-auto">
                                                <div class="col-auto">
                                                    <form action="" method="GET">
                                                        @csrf
                                                        <div class="d-flex my-3">

                                                            <div class="mx-3">
                                                                <select class="form-select mb-3" data-choices
                                                                    name="period">
                                                                    <option>Pay Period</option>
                                                                    @php
                                                                        $periods = \App\Models\PayPeriod::get();
                                                                    @endphp
                                                                    @foreach ($periods as $item)
                                                                        <option value="{{ $item->id }}"
                                                                            {{ $item->id == $payperiod ? 'selected' : '' }}>
                                                                            {{ $item->period }}
                                                                        </option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                            <div class="mx-3">
                                                                @php
                                                                    $years = \App\Models\PayReport::select('year')
                                                                        ->distinct()
                                                                        ->get();
                                                                @endphp
                                                                <select class="form-select mb-3" name="year"
                                                                    data-choices>
                                                                    <option
                                                                        value="{{ \Carbon\Carbon::now()->format('Y') }}">
                                                                        {{ \Carbon\Carbon::now()->format('Y') }}</option>
                                                                    @foreach ($years as $item)
                                                                        @if ($item->year != \Carbon\Carbon::now()->format('Y'))
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
                                        </div> <!-- / .row -->
                                    </div>
                                </div>
                                <div class="table-responsive">
                                    <table class="table table-sm  table-nowrap card-table">
                                        <thead>
                                            <tr>
                                                <th>
                                                    <a class="text-muted" href="#">Invoice No.</a>
                                                </th>
                                                <th>
                                                    <a class="text-muted" href="#">Date</a>
                                                </th>
                                                <th>
                                                    <a class="text-muted" href="#">Year</a>
                                                </th>
                                                <th>
                                                    <a class="text-muted" href="#">Pay Period</a>
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
                                                    <a class="text-muted">$Total Service</a>
                                                </th>
                                                <th>
                                                    <a class="text-muted">Total Mileage</a>
                                                </th>
                                                <th>
                                                    <a class="text-muted">Status</a>
                                                </th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody class="list font-size-base">
                                            @if ($paysummaries->count())
                                                @foreach ($paysummaries as $paysummary)
                                                    @if ($paysummary->status == 'Pending')
                                                        <tr>
                                                            <td>
                                                                <!-- Text -->
                                                                <span>{{ $paysummary->invoice }}</span>
                                                            </td>
                                                            <td>
                                                                <span>{{ $paysummary->date }}</span>
                                                            </td>
                                                            <td>
                                                                <span>{{ $paysummary->year }}</span>
                                                            </td>
                                                            <td>
                                                                <span> {{ $paysummary->payperiod->period }}</span>
                                                            </td>
                                                            <td>
                                                                <span> {{ $paysummary->employee->name }}</span>
                                                            </td>

                                                            <td>
                                                                <span>{{ $paysummary->no_patients }}
                                                                </span>
                                                            </td>
                                                            <td>
                                                                <span>{{ $paysummary->no_visits }}</span>
                                                            </td>
                                                            <td>
                                                                <span>${{ round($paysummary->total_amount, 2) }}</span>
                                                            </td>
                                                            <td>
                                                                <span>{{ round($paysummary->total_miles, 2) }} miles</span>
                                                            </td>

                                                            {{-- <td>
                                                                <span>{{ $paysummary->comments }}</span>
                                                            </td> --}}
                                                            <td>
                                                                <span>

                                                                    <div class="btn-group">
                                                                        <button
                                                                            class="btn btn-outline-warning dropdown-toggle"
                                                                            type="button" id="defaultDropdown"
                                                                            data-bs-toggle="dropdown"
                                                                            data-bs-auto-close="true" aria-expanded="false">
                                                                            {{ $paysummary->status }}
                                                                        </button>
                                                                        <ul class="dropdown-menu"
                                                                            aria-labelledby="defaultDropdown">
                                                                            <li><a class="dropdown-item"
                                                                                    href="{{ url('approve-invoice', $paysummary->id) }}">Approved</a>
                                                                            </li>
                                                                            <li><a class="dropdown-item"
                                                                                    href="{{ url('return-invoice', $paysummary->id) }}">Returned</a>
                                                                            </li>
                                                                        </ul>
                                                                    </div>
                                                                </span>
                                                            </td>
                                                            <td>
                                                                {{-- <form action="{{ url('invoice') }}" method="POST">
                                                                    @csrf
                                                                    <input type="text" class="d-none"
                                                                        value="{{ $paysummary->id }}" name="id">
                                                                    <button type="submit" class="editbtn"><i
                                                                            class="fe fe-eye"></i></button>
                                                                </form> --}}
                                                                <a href="{{ url('invoice', $paysummary->id) }}">
                                                                    <i class="fe fe-eye"></i></a>

                                                            </td>
                                                            {{-- <td><a href="{{ url('delete-invoice', $paysummary->id) }}">
                                                                    <i class="fe fe-trash"></i></a>
                                                            </td> --}}
                                                        </tr>
                                                    @endif
                                                @endforeach
                                            @endif

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

                            <!-- Card -->
                            <div class="card" id="companiesList">
                                <!-- Header -->
                                <div class="p-3">
                                    <div class="tableHeadr">

                                        <div class="row align-items-center">
                                            <div class="col">


                                                <!-- Title -->
                                                <h1 class="header-title text-truncate ml-3">
                                                    Approved
                                                </h1>

                                            </div>
                                        </div> <!-- / .row -->
                                    </div>
                                </div>
                                <div class="table-responsive">
                                    <table class="table table-sm  table-nowrap card-table">
                                        <thead>
                                            <tr>
                                                <th>
                                                    <a class="text-muted" href="#">Invoice No.</a>
                                                </th>
                                                <th>
                                                    <a class="text-muted" href="#">Date</a>
                                                </th>
                                                <th>
                                                    <a class="text-muted" href="#">Year</a>
                                                </th>
                                                <th>
                                                    <a class="text-muted" href="#">Pay Period</a>
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
                                                    <a class="text-muted">$Total Service</a>
                                                </th>
                                                <th>
                                                    <a class="text-muted">Total Mileage</a>
                                                    {{-- </th>
                                                <th>
                                                    <a class="text-muted">Comment</a>
                                                </th> --}}
                                                <th>
                                                    <a class="text-muted">Status</a>
                                                </th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody class="list font-size-base">
                                            @if ($paysummaries->count())
                                                @foreach ($paysummaries as $paysummary)
                                                    @if ($paysummary->status == 'Approved')
                                                        <tr>
                                                            <td>
                                                                <span>{{ $paysummary->invoice }}</span>

                                                            </td>
                                                            <td>
                                                                <span>{{ $paysummary->date }}</span>
                                                            </td>
                                                            <td>
                                                                <span>{{ $paysummary->year }}</span>
                                                            </td>
                                                            <td>
                                                                <span> {{ $paysummary->payperiod->period }}</span>
                                                            </td>
                                                            <td>
                                                                <span> {{ $paysummary->employee->name }}</span>
                                                            </td>

                                                            <td>
                                                                <span>{{ $paysummary->no_patients }}
                                                                </span>
                                                            </td>
                                                            <td>
                                                                <span>{{ $paysummary->no_visits }}</span>
                                                            </td>
                                                            <td>
                                                                <span>${{ round($paysummary->total_amount, 2) }}</span>
                                                            </td>
                                                            <td>
                                                                <span>{{ round($paysummary->total_miles, 2) }} miles</span>
                                                            </td>

                                                            <td>
                                                                <span>
                                                                    <button
                                                                        class="btn btn-outline-success">{{ $paysummary->status }}</button>
                                                                </span>
                                                            </td>
                                                            <td>
                                                                <a href="{{ url('invoice', $paysummary->id) }}">
                                                                    <i class="fe fe-eye"></i></a>
                                                            </td>
                                                        </tr>
                                                    @endif
                                                @endforeach
                                            @endif

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

                            <!-- Card -->
                            <div class="card" id="companiesList">
                                <!-- Header -->
                                <div class="p-3">
                                    <div class="tableHeadr">

                                        <div class="row align-items-center">
                                            <div class="col">


                                                <!-- Title -->
                                                <h1 class="header-title text-truncate ml-3">
                                                    Returned
                                                </h1>

                                            </div>
                                        </div> <!-- / .row -->
                                    </div>
                                </div>
                                <div class="table-responsive">
                                    <table class="table table-sm  table-nowrap card-table">
                                        <thead>
                                            <tr>
                                                <th>
                                                    <a class="text-muted" href="#">Invoice No.</a>
                                                </th>
                                                <th>
                                                    <a class="text-muted" href="#">Date</a>
                                                </th>
                                                <th>
                                                    <a class="text-muted" href="#">Year</a>
                                                </th>
                                                <th>
                                                    <a class="text-muted" href="#">Pay Period</a>
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
                                                    <a class="text-muted">$Total Service</a>
                                                </th>
                                                <th>
                                                    <a class="text-muted">Total Mileage</a>
                                                    {{-- </th>
                                                <th>
                                                    <a class="text-muted">Comment</a>
                                                </th> --}}
                                                <th>
                                                    <a class="text-muted">Status</a>
                                                </th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody class="list font-size-base">
                                            @if ($paysummaries->count())
                                                @foreach ($paysummaries as $paysummary)
                                                    @if ($paysummary->status == 'Returned')
                                                        <tr>
                                                            <td>
                                                                <span>{{ $paysummary->invoice }}</span>
                                                            </td>
                                                            <td>
                                                                <span>{{ $paysummary->date }}</span>
                                                            </td>
                                                            <td>
                                                                <span>{{ $paysummary->year }}</span>
                                                            </td>
                                                            <td>
                                                                <span> {{ $paysummary->payperiod->period }}</span>
                                                            </td>
                                                            <td>
                                                                <span> {{ $paysummary->employee->name }}</span>
                                                            </td>

                                                            <td>
                                                                <span>{{ $paysummary->no_patients }}
                                                                </span>
                                                            </td>
                                                            <td>
                                                                <span>{{ $paysummary->no_visits }}</span>
                                                            </td>
                                                            <td>
                                                                <span>${{ round($paysummary->total_amount, 2) }}</span>
                                                            </td>
                                                            <td>
                                                                <span>{{ round($paysummary->total_miles, 2) }} miles</span>
                                                            </td>
                                                            <td>
                                                                <span>
                                                                    <button
                                                                        class="btn btn-outline-danger">{{ $paysummary->status }}</button>
                                                                </span>
                                                            </td>
                                                            <td>
                                                                <a href="{{ url('invoice', $paysummary->id) }}">
                                                                    <i class="fe fe-eye"></i></a>
                                                            </td>
                                                        </tr>
                                                    @endif
                                                @endforeach
                                            @endif

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

            <div class="modal fade " id="editMembers" tabindex="-1" role="dialog" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered bd-example-modal-lg" role="document">
                    <div class="modal-content editMembers">
                        <div class="card-header">

                            <!-- Title -->
                            <h2 class="card-header-title">
                                Edit Reports
                            </h2>

                            <!-- Close -->
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>

                        </div>
                        <div class="card-body editMembers">
                            <form>

                                <div class="row g-3">
                                    <div class="col-12 col-md-6 mb-3">
                                        <label class="form-label">Pay Period</label>
                                        <input type="text" class="form-control" placeholder="__/__/____"
                                            data-inputmask="'mask': 'MM/DD/YYYY'">

                                    </div>
                                    <div class="col-12 col-md-6 mb-3">
                                        <label class="form-label">Invoice No</label>
                                        <input type="text" class="form-control " placeholder="Invoice No" required>

                                    </div>
                                </div>
                                <div class="row g-3">
                                    <div class="col-12 col-md-6 mb-3">
                                        <label class="form-label">Employee Name</label>
                                        <input type="text" class="form-control" placeholder="Employee Name">

                                    </div>
                                    <div class="col-12 col-md-6 mb-3">
                                        <label class="form-label">No. Of Patients</label>
                                        <input type="text" class="form-control " placeholder="No. Of Patients"
                                            required>

                                    </div>
                                </div>

                                <div class="row g-3">
                                    <div class="col-12 col-md-6 mb-3">
                                        <label class="form-label">No. Of Visits</label>
                                        <input type="text" class="form-control" placeholder="No. Of Visits">

                                    </div>
                                    <div class="col-12 col-md-6 mb-3">
                                        <label class="form-label">Date Range</label>
                                        <input type="date" class="form-control " placeholder="Date Range" required>

                                    </div>
                                </div>

                                <div class="row g-3">
                                    <div class="col-12 col-md-6 mb-3">
                                        <label class="form-label">Total Hours</label>
                                        <input type="text" class="form-control" placeholder="Total Hours">
                                    </div>
                                    <div class="col-12 col-md-6 mb-3">
                                        <label class="form-label">Total</label>
                                        <input type="text" class="form-control" placeholder="Total">
                                    </div>
                                </div>

                                <div class="row g-3">
                                    <div class="col-12 col-md-12 mb-3">
                                        <label class="form-label">Mileage</label>
                                        <input type="text" class="form-control" placeholder="Mileage">
                                    </div>
                                    <div class="col-12 col-md-12 mb-3">
                                        <label class="form-label">Comment</label>
                                        <div data-quill='{"placeholder": "Comment"}'></div>
                                    </div>
                                </div>

                                <div class="col-auto">
                                    <!-- Button -->
                                    <button type="button" class="btn btn-primary ml-2 addemployeModalBtn employeeBtn">
                                        Save
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
<script type="text/javascript">
    function submitForm() {

        var selectButton = document.getElementById('filter');

        selectButton.click();

    }
</script>
