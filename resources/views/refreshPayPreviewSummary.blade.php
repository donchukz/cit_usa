<div class="table-responsive">
    <table class="table table-sm  table-nowrap card-table">
        <thead>
            <tr>
                <th>
                    <a href="#" class="text-muted">Visit Date</a>
                </th>
                <th>
                    <a class="text-muted">Patient</a>
                </th>
                <th>
                    <a class="text-muted">Visit Type</a>
                </th>
                <th>
                    <a class="text-muted">Rate</a>
                </th>
                <th>
                    <a class="text-muted">Signature</a>
                </th>
                <th>
                    <a class="text-muted">Comment</a>
                </th>
            </tr>
        </thead>
        <tbody class="list font-size-base">
            @if ($invoices == null)
                <script>
                    window.location = "/employee/enter-pay";
                </script>
            @else
                @if ($invoices->count() == 0)
                    <h3>No data available </h3>
                @else
                    @foreach ($invoices as $key => $paid)
                        <tr>
                            <td>
                                <!-- Text -->
                                <span>{{ $paid->visit_date }}</span>

                            </td>

                            <td>
                                <span>{{ $paid->patient->name }}</span>
                            </td>
                            <td>
                                <span>{{ $paid->userRate->rate->name }}</span>
                            </td>
                            <td>

                                <span>${{ $paid->userRate->amount }}</span>
                            </td>
                            <td>
                                <span>{{ $paid->signature ? 'Uploaded' : 'Digital' }}</span>
                            </td>
                            <td>
                                <span>{{ $paid->comment }}</span>
                            </td>

                        </tr>
                    @endforeach
                @endif
            @endif
        </tbody>
    </table>
</div>
