@extends('layout.app')

@section('content')
    <div class="container">
        <div class="row">

            <div class="col-md-6">



                <div class="card">

                    <div class="card-header">Pay Summary</div>
                    <div class="alert alert-danger print-error-msg" style="display:none">
                        <ul></ul>
                    </div>
                    @if (session('status'))
                        <div class="text-light border border-success bg-success p-3 text-center">
                            {{ session('status') }}
                        </div>
                        <br>
                    @elseif(session('error'))
                        <div class="text-light border border-danger bg-danger p-3 text-center">
                            {{ session('error') }}
                        </div>
                        <br>
                    @endif
                    <div class="card-body">
                        <div class="row mb-4">
                            <div class="col">
                                <span class="registryName">Registry Name: {{ auth()->user()->name }} </span>
                            </div>
                            <div class="col-auto">
                                <span class="registryDate">{{ $employee->date }} </span>
                            </div>
                        </div>

                        <form action="{{ url('daily-pay') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-4">
                                    <label for="">Pay period</label>
                                    <select name="period" class="form-select mb-3" id="period" class="" required>
                                        <option value="">Select Pay Period</option>
                                        @foreach ($periods as $period)
                                            <option value="{{ $period->id }}" {{ $period->id == $pp ? 'selected' : '' }}>
                                                {{ $period->period }}
                                            </option>
                                        @endforeach

                                    </select>
                                    <span class="text-danger error-text period_err"></span>
                                </div>
                            </div>
                            <div class="period">
                                <div>
                                    <div class="row">
                                        <div class="col-12 col-md-4 mb-3">
                                            <label for="form-label">Patient </label>
                                            <select class="form-select mb-3" data-choices id="patient" name="patient"
                                                required>
                                                <option value="">Select Patient</option>
                                                @foreach ($patients as $patient)
                                                    <option value="{{ $patient->id }}">{{ $patient->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            <span class="text-danger error-text patient_err"></span>
                                        </div>
                                        @php
                                            $visits = \App\Models\UserRate::with('rate')
                                                ->where('emp_id', $employee->id)
                                                ->get();
                                        @endphp
                                        <div class="col-12 col-md-4 mb-3">
                                            <label for="form-label">Visit Type </label>
                                            <select class="form-select mb-3 select" data-choices name="visit_type"
                                                id="visit_type" required>
                                                <option value="">Select Visit Type</option>
                                                @foreach ($visits as $visit)
                                                    <option value="{{ $visit->id }}" data-price="{{ $visit->amount }}">
                                                        {{ $visit->rate->name }} </option>
                                                @endforeach
                                            </select>
                                            <span class="text-danger error-text visit_type_err"></span>
                                        </div>
                                        <div class="col-12 col-md-4 mb-3">
                                            <label for="form-label">Visit Rate </label>
                                            <input type="text" name="visit_rate" class="form-control" id="visitRate"
                                                readonly>

                                        </div>
                                    </div>

                                    <input type="text" name="employee" class="d-none" value="{{ $employee->id }}"
                                        id="employee">
                                    <div class="row">
                                        <div class="col-12 col-md-4 mb-3">
                                            <label class="form-label">Date</label>
                                            <input type="date" class="form-control" name="date" id="date"
                                                required>
                                            <span class="text-danger error-text date_err"></span>
                                        </div>
                                        <div class="col-12 col-md-4 mb-3">
                                            <label class="form-label">Time</label>
                                            <div class="input-group input-group-merge mb-3">
                                                <input type="time" class="form-control" name="time" id="time"
                                                    required>
                                                <span class="text-danger error-text time_err"></span>
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-4 mb-3">
                                            <label class="form-label">Comment</label>
                                            <input type="text" class="form-control " placeholder="" name="comment"
                                                id="comment">

                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-12 col-md-6 mb-3">
                                            <label class="form-label">Patient Signature</label>
                                            <input type="file" class="form-control " placeholder="" name="file"
                                                accept="image/jpeg,image/jpg,image/png,application/pdf">
                                            <span class="text-danger error-text signature_err"></span>
                                        </div>
                                        <div class="col-12 col-md-6 my-5 form-check">
                                            <input type="checkbox" class="form-check-input " placeholder="" id="sign"
                                                name="sign">
                                            <label class="form-check-label">If Patient Signed Digitally</label>
                                            <span class="text-danger error-text sign_err"></span>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12 col-md-12 mb-3">
                                    <div class="d-flex justify-content-between">
                                        <div class="col-12 col-md-3">

                                            <button type="submit" class="btn btn-primary add_period">Submit</button>
                                        </div>
                                        <div class="col-auto">
                                            <a class="btn btn-secondary" href="/employee" id="continue">
                                                Back
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">Summary Preview</div>

                    @if ($invoices == null)
                        <script>
                            window.location = "/employee/enter-pay";
                        </script>
                    @else
                        @if ($invoices->count() > 0)
                        <div class="row">
                            <div class="col">Total Appr. Patients: {{ $app_pat }}<br>
                                $Total Appr. Rate: ${{ $app_rates }}<br>
                                $Total Appr. Service: ${{ round($app_miles, 2) }}</div>

                            <div class="col">Total Pending Patients: {{ $pen_pat }}<br>
                                $Total Pending Rate: ${{ $pen_rates }}<br>
                                $Total Pending Service: ${{ round($pen_miles, 2) }}</div>


                            <div class="col">Overall Patients: {{ $pay->no_patients }}<br>
                                Overall Visits: {{ $pay->no_visits }}<br>
                                $Overall Service: ${{ round($pay->total_amount, 2) }}</div>
                        </div>
                        @endif
                    @endif
                    <hr>
                    <div class="card-body" id="summaryPreviewContent">
                        @include('refreshPayPreviewSummary')
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
