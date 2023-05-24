@extends('layout.app')

@section('content')
    <!-- MAIN CONTENT -->
    <div class="main-content">
        <div class="container-fluid">
            <div class="card-header">

                <!-- Title -->
                <h2 class="card-header-title">
                    Add Employee
                </h2>

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
                                class="form-select mb-3  @error('discipline') border border-danger @enderror" data-choices>
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
                                class="form-select mb-3  @error('employment') border border-danger @enderror" data-choices>
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
                                @php
                                    $specs = \App\Models\Specialty::get();
                                @endphp
                                <option>Select Specialty</option>
                                @foreach ($specs as $spec)
                                    <option value="{{ $spec->name }}">{{ $spec->name }} </option>
                                @endforeach
                            </select>
                            @error('specialty')
                                <div class="text-danger">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="col-12 mb-3" id="custom-search-input">
                            <label class="form-label">Address</label>
                            <div class="input-group">

                                <input id="autocomplete_search" name="address" type="text"
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
                    @php
                        $visits = \App\Models\Rate::get();
                        $times = \App\Models\EmpTime::get();
                    @endphp
                    <div class="row g-3 time mt-2">
                        {{-- <div class="wrapper"> --}}
                        <div class="d-flex flex-wrap justify-content-between">
                            <div class="col-md-5">
                                {{-- <label class="form-label">Rate</label> --}}
                                <select name="day[]" required
                                    class="form-select @error('day') border border-danger @enderror" data-choices>
                                    <option> Days Available</option>
                                    <option value="Monday">Monday </option>
                                    <option value="Tuesday">Tuesday</option>
                                    <option value="Wednesday">Wednesday </option>
                                    <option value="Thursday">Thursday</option>
                                    <option value="Friday">Friday</option>
                                    <option value="Saturday">Saturday</option>
                                    <option value="Sunday">Sunday</option>
                                    <option value="Monday-Friday">Monday-Friday</option>
                                </select>
                            </div>
                            <div class="col-md-5">
                                {{-- <label class="form-label">Hourly Rate</label> --}}
                                <select name="time[]" required
                                    class="form-select @error('time') border border-danger @enderror" data-choices>
                                    <option>Time Available</option>
                                    @foreach ($times as $time)
                                        <option value="{{ $time->id }}"> {{ $time->from_time }}-{{ $time->to_time }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <iconify-icon icon="material-symbols:add-circle-rounded" class="add_time" width="40"
                                height="40">
                            </iconify-icon>
                        </div>
                    </div>

                    <div class="row g-3 wrapper mt-3">
                        {{-- <div class="wrapper"> --}}
                        <div class="d-flex flex-wrap justify-content-between">
                            <div class="col-md-5">
                                {{-- <label class="form-label">Rate</label> --}}

                                <select name="rate[]" required
                                    class="form-select @error('rate') border border-danger @enderror" data-choices>
                                    <option>Select Rate</option>
                                    @foreach ($visits as $visit)
                                        <option value="{{ $visit->id }}">{{ $visit->name }} </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-5">
                                {{-- <label class="form-label">Hourly Rate</label> --}}
                                <input type="text" class="form-control" placeholder="Hourly Rate"
                                    name="hourly_rate[]" required>
                            </div>
                            <iconify-icon icon="material-symbols:add-circle-rounded" class="add_fields" width="40"
                                height="40">
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
                            <select name="status" class="form-select  @error('status') border border-danger @enderror">
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

    </div> <!-- / .main-content -->
@endsection
<script>
    google.maps.event.addDomListener(window, 'load', initialize);

    function initialize() {

        var input = document.getElementById('autocomplete_search');

        var autocomplete = new google.maps.places.Autocomplete(input);

        autocomplete.addListener('place_changed', function() {

            var place = autocomplete.getPlace();

            // place variable will have all the information you are looking for.

            $('#lat').val(place.geometry['location'].lat());

            $('#long').val(place.geometry['location'].lng());

        });

    }
</script>
