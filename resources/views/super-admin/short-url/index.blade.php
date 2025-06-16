@extends('layout.admin')
@section('title','Short URLs')
@section('content')
<div class="pcoded-content">

    <div class="pcoded-inner-content">
        <!-- Main-body start -->
        <div class="main-body">
            <div class="page-wrapper">
                <!-- Page-body start -->
                <div class="page-body">
                    <div class="row">
                        <div class="col-sm-12">
                            <!-- Default ordering table start -->
                            <div class="card">
                                <div class="card-header">
                                    <div class="row w-100 align-items-center gy-2">
                                        <div class="col-md-6 col-sm-12">
                                            <div class="d-flex flex-wrap align-items-center gap-2">
                                                <h5 class="mb-0 me-3">Short URLs</h5>
                                                @if(in_array(auth()->user()?->role,['admin','member']))<a href="{{route(auth()->user()?->role.'.short-url.create')}}" class="btn btn-success btn-round waves-effect waves-light btn-sm">Create Short URL</a>@endif
                                            </div>
                                        </div>

                                        <!-- Date Filter -->
                                        <div class="col-md-3 col-sm-6">
                                            <select id="date-filter" class="form-select form-select-sm w-100">
                                                <option value="">Select Range</option>
                                                <option value="this_month">This Month</option>
                                                <option value="last_month">Last Month</option>
                                                <option value="last_week">Last Week</option>
                                                <option value="today">Today</option>
                                            </select>
                                        </div>

                                        <!-- Download Button -->
                                        <div class="col-md-3 col-sm-12 text-md-end text-sm-start">
                                            <button id="download" class="btn btn-primary btn-sm w-100">Download</button>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-block">
                                    <div class="dt-responsive table-responsive">
                                        <table id="admins" class="table table-striped table-bordered nowrap">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Short URL</th>
                                                    <th>Original URL</th>
                                                    <th>Hits</th>
                                                    <th>User</th>
                                                    <th>CreatedAt</th>
                                                </tr>
                                            </thead>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <!-- Default ordering table end -->
                        </div>
                    </div>
                </div>
                <!-- Page-body end -->
            </div>
        </div>
    </div>
</div>
@php($role = auth()->user()?->role)
@endsection()
@push('after-scripts')
<script>
    $(function () {
        var table = $('#admins').DataTable({
            processing: true,
            serverSide: true,
            order: [ [1, 'DESC'] ],
            ajax: {
                url: "{{ route($role.'.short-url.list') }}",
                data: function (d) {
                    d.date_range = $('#date-filter').val(); // Send the selected range to the server
                }
            },
            buttons: ['excelHtml5'],
            columns: [
                {data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false},
                {data: 'short_code', name: 'short_code'},
                {data: 'original_url', name: 'original_url'},                
                {data: 'hits', name: 'hits'},
                {data: 'user_id', name: 'user_id', orderable: false, searchable: false},
                {data: 'created_at', name: 'created_at', orderable: false, searchable: false},
            ]
        });
        // Trigger redraw when filter is selected
        $('#date-filter').on('change', function () {
            table.draw();
        });

        // Download button (optional: trigger Excel download)
        $('#download').on('click', function () {
            table.button('.buttons-excel').trigger();
        });
    });
</script>
@endpush