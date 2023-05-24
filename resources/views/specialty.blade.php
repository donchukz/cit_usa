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
                            @if (session('status'))
                                <div class="text-light border border-success bg-success p-3 text-center">
                                    {{ session('status') }}
                                </div>
                                <br>
                            @endif

                            <!-- Card -->
                            <div class="card" id="Pending">
                                <!-- Header -->
                                <div class="p-3">
                                    <div class="tableHeadr">

                                        <div class="row align-items-center">
                                            <div class="col">
                                                <!-- Title -->
                                                <div class="d-flex justify-content-between flex-wrap ">
                                                    <h1 class="header-title text-truncate ml-3 mr-4">
                                                        Specialty
                                                    </h1>
                                                    <div class="d-flex justify-content-end">


                                                        <!-- Buttons -->
                                                        <button type="button" data-toggle="modal" data-target="#modalAdd"
                                                            class="btn btn-primary ml-2 employeeBtn">
                                                            + Add Speciialty
                                                        </button>

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
                                                    <a class="text-muted" href="#">Specialty</a>
                                                </th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody class="list font-size-base">
                                            @foreach ($specialties as $key => $specialty)
                                                <tr>
                                                    <td>
                                                        <!-- Text -->
                                                        <span>{{ $key + 1 }}</span>

                                                    </td>

                                                    <td>
                                                        <span>{{ $specialty->name }}</span>
                                                    </td>
                                                    <td>
                                                        <span>
                                                            <button type="button" class="editbtn" data-toggle="modal"
                                                                data-target="#editSettings{{ $key }}"><i
                                                                    class="fe fe-edit-3"></i></button>
                                                        </span>
                                                    </td>
                                                    <div class="modal fade " id="editSettings{{ $key }}"
                                                        tabindex="-1" role="dialog" aria-hidden="true">
                                                        <div class="modal-dialog modal-dialog-centered editMembers"
                                                            role="document">
                                                            <div class="modal-content editMembers">
                                                                <div class="card-header">

                                                                    <!-- Title -->
                                                                    <h2 class="card-header-title">
                                                                        Edit Specialty
                                                                    </h2>

                                                                    <!-- Close -->
                                                                    <button type="button" class="close"
                                                                        data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>

                                                                </div>
                                                                <div class="card-body editMembers">
                                                                    <form
                                                                        action="{{ url('edit-specialty', $specialty->id) }}"
                                                                        method="POST">
                                                                        @csrf
                                                                        <div class="row g-3">
                                                                            <div class="col-12 col-md-6 mb-3">
                                                                                <label class="form-label">Visit type</label>
                                                                                <input type="text" class="form-control"
                                                                                    name="name"
                                                                                    value="{{ $specialty->name }}">

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
                            <div class="modal fade " id="modalAdd" tabindex="-1" role="dialog" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered editMembers" role="document">
                                    <div class="modal-content editMembers">
                                        <div class="card-header">

                                            <!-- Title -->
                                            <h2 class="card-header-title">
                                                Add Specialty
                                            </h2>

                                            <!-- Close -->
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>

                                        </div>
                                        <div class="card-body editMembers">
                                            <form action="{{ url('add-specialty') }}" method="POST">
                                                @csrf
                                                <div class="row g-3">
                                                    <div class="col-12 col-md-6 mb-3">
                                                        <label class="form-label">Specialty</label>
                                                        <input type="text" class="form-control" name="name">

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


                        </div>

                    </div>

                </div>
            </div> <!-- / .row -->


        </div>

    </div> <!-- / .main-content -->
@endsection
