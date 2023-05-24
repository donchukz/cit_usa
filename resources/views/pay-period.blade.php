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

                                                <!-- Title -->
                                                <h1 class="header-title text-truncate ml-2">
                                                    Pay Periods
                                                </h1>

                                            </div>
                                            <div class="col-auto">


                                                <!-- Buttons -->

                                                <button type="button" class="btn btn-primary ml-2 employeeBtn"
                                                    data-toggle="modal" data-target="#modalPayPeriod">
                                                    + Add Pay Period
                                                </button>

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
                                                    <a class="text-muted" href="#">Period</a>
                                                </th>
                                                <th>
                                                    <a class="text-muted">From Date</a>
                                                </th>
                                                <th>
                                                    <a class="text-muted"> To Date</a>
                                                </th>

                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody class="list font-size-base">
                                            @if ($payperiods->count())
                                                @foreach ($payperiods as $key => $payperiod)
                                                    <tr>
                                                        <td>
                                                            <!-- Text -->
                                                            <span>{{ $key + 1 }}</span>

                                                        </td>

                                                        <td>
                                                            <span> {{ $payperiod->period }}</span>
                                                        </td>
                                                        <td>
                                                            <span>{{ $payperiod->from_date ?? 'N/A' }}</span>
                                                        </td>
                                                        <td>
                                                            <span>{{ $payperiod->to_date ?? 'N/A' }}</span>
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
                                                                            Edit Pay Period
                                                                        </h2>

                                                                        <!-- Close -->
                                                                        <button type="button" class="close"
                                                                            data-dismiss="modal" aria-label="Close">
                                                                            <span aria-hidden="true">&times;</span>
                                                                        </button>

                                                                    </div>
                                                                    <div class="card-body modalMembers">
                                                                        <form
                                                                            action="{{ url('update-pay-period', $payperiod->id) }}"
                                                                            method="POST">
                                                                            @csrf
                                                                            <div class="row g-3">
                                                                                <div class="col-12 col-md-4 mb-3">
                                                                                    <label class="form-label">Period</label>
                                                                                    <input type="text" name="period"
                                                                                        class="form-control  @error('period') border border-danger @enderror"
                                                                                        placeholder="Pay Period"
                                                                                        value="{{ $payperiod->period }}">
                                                                                    @error('name')
                                                                                        <div class="text-danger">
                                                                                            {{ $message }}
                                                                                        </div>
                                                                                    @enderror
                                                                                </div>
                                                                                <div class="col-12 col-md-4 mb-3">
                                                                                    <label class="form-label">From
                                                                                        Date</label>
                                                                                    <input type="date" name="from_date"
                                                                                        class="form-control @error('from_date') border border-danger @enderror"
                                                                                        placeholder=""
                                                                                        value="{{ $payperiod->from_date }}"
                                                                                        required>
                                                                                    @error('from_date')
                                                                                        <div class="text-danger">
                                                                                            {{ $message }}
                                                                                        </div>
                                                                                    @enderror
                                                                                </div>
                                                                                <div class="col-12 col-md-4 mb-3">
                                                                                    <label class="form-label">to
                                                                                        Date</label>
                                                                                    <input type="date" name="to_date"
                                                                                        class="form-control @error('to_date') border border-danger @enderror"
                                                                                        placeholder=""
                                                                                        value="{{ $payperiod->to_date }}"
                                                                                        required>
                                                                                    @error('to_date')
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
                                                                                    Update
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
                                                <p class="ml-4"> You have no Pay Period</p>
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
            <div class="modal fade " id="modalPayPeriod" tabindex="-1" role="dialog" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modalMembers" role="document">
                    <div class="modal-content modalMembers">
                        <div class="card-header">

                            <!-- Title -->
                            <h2 class="card-header-title">
                                Add Pay Period
                            </h2>

                            <!-- Close -->
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>

                        </div>
                        <div class="card-body modalMembers">
                            <form action="{{ url('add-pay-period') }}" method="POST">
                                @csrf
                                <div class="row g-3">
                                    <div class="col-12 col-md-4 mb-3">
                                        <label class="form-label">Period</label>
                                        <input type="text" name="period"
                                            class="form-control  @error('period') border border-danger @enderror"
                                            placeholder="Pay Period">
                                        @error('period')
                                            <div class="text-danger">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="col-12 col-md-4 mb-3">
                                        <label class="form-label">From Date</label>
                                        <input type="date" name="from_date"
                                            class="form-control @error('from_date') border border-danger @enderror"
                                            placeholder="Date" required>
                                        @error('from_date')
                                            <div class="text-danger">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="col-12 col-md-4 mb-3">
                                        <label class="form-label">To Date</label>
                                        <input type="date" name="to_date"
                                            class="form-control @error('to_date') border border-danger @enderror"
                                            placeholder="Date" required>
                                        @error('to_date')
                                            <div class="text-danger">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>

                                </div>


                                <div class="col-auto">
                                    <!-- Button -->
                                    <button type="submit" class="btn btn-primary ml-2 addemployeModalBtn employeeBtn">
                                        + Add Period
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
