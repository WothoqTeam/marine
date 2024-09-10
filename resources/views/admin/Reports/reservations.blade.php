@extends('admin.layout.master')

@section('css')
@endsection

@section('style')
    <style>
        .results-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        .results-table th, .results-table td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: center;
        }
        .results-table th {
            background-color: #f2f2f2;
            font-weight: bold;
        }
        .card-title {
            font-size: 1.5rem;
            font-weight: bold;
            text-align: center;
            margin-bottom: 20px;
        }
    </style>
@endsection

@section('breadcrumb')
    <div class="page-title d-flex flex-column justify-content-center gap-1 me-3 pt-6">
        <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0">
            <li class="breadcrumb-item text-muted">
                <a href="{{route('admin.reports.reservations')}}" class="text-muted text-hover-primary">{{trans('admin.reports')}}</a>
            </li>
            <li class="breadcrumb-item">
                <span class="bullet bg-gray-400 w-5px h-2px"></span>
            </li>
            <li class="breadcrumb-item text-muted">
                <a class="text-muted text-hover-primary">{{trans('admin.Reservation')}}</a>
            </li>
        </ul>
    </div>
@endsection

@section('content')

    <div id="kt_app_content_container" class="app-container container-fluid">
        <div class="card mb-5 mb-xl-10">
            <div id="kt_account_settings_profile_details" class="collapse show">
                <form id="dynamicForm">
                    <!-- Form fields -->
                    <div class="mb-3">
                        <label for="dropdown" class="form-label">{{trans('admin.userType')}}</label>
                        <select id="user_type" class="form-select" name="user_type">
                            <option value="1">{{trans('admin.Marasi Owners')}}</option>
                            <option value="2">{{trans('admin.Providers')}}</option>
                        </select>
                    </div>

                    <div class="mb-3" id="status_input" style="display:none;">
                        <label for="conditionalField" class="form-label">{{trans('admin.Reservations Status')}}</label>
                        <select id="status_name" class="form-select" name="status_name">
                            <option value="">{{trans('admin.All')}}</option>
                            <option value="pending">{{trans('admin.pending')}}</option>
                            <option value="in progress">{{trans('admin.in progress')}}</option>
                            <option value="rejected">{{trans('admin.rejected')}}</option>
                            <option value="canceled">{{trans('admin.canceled')}}</option>
                            <option value="completed">{{trans('admin.completed')}}</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="startDate" class="form-label">{{trans('admin.date_from')}}</label>
                        <input type="date" id="startDate" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label for="endDate" class="form-label">{{trans('admin.date_to')}}</label>
                        <input type="date" id="endDate" class="form-control" required>
                    </div>

                    <button type="submit" class="btn btn-primary">{{trans('admin.search')}}</button>
                </form>

                <div id="results" class="mt-5" style="display:none;">
                    <div class="card-title">{{transAdmin('Results')}}</div>
                    <table class="results-table">
                        <thead>
                        <tr>
                            <th>{{transAdmin('Name')}}</th>
                            <th>{{transAdmin('Total Reservations Amount')}}</th>
                            <th>{{transAdmin('Total Platform Ratio')}}</th>
                            <th>{{transAdmin('Date From')}}</th>
                            <th>{{transAdmin('Date To')}}</th>
                        </tr>
                        </thead>
                        <tbody id="resultsBody">
                        </tbody>
                    </table>
                    <!-- Add the export button -->
                    <form id="exportForm" method="POST" action="{{ route('admin.reports.export') }}" style="display: none;">
                        @csrf
                        <input type="hidden" name="user_type" id="exportUserType">
                        <input type="hidden" name="status_name" id="exportStatusName">
                        <input type="hidden" name="startDate" id="exportStartDate">
                        <input type="hidden" name="endDate" id="exportEndDate">
                    </form>

                    <button id="exportButton" class="btn btn-success mt-3">{{transAdmin('Export to Excel')}}</button>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('script')
    <script>
        $(document).ready(function() {
            $('#user_type').change(function() {
                if ($(this).val() === '2') {
                    $('#status_input').show();
                } else {
                    $('#status_input').hide();
                }
            });

            $('#dynamicForm').submit(function(event) {
                event.preventDefault();

                var formData = {
                    user_type: $('#user_type').val(),
                    status_name: $('#status_name').val(),
                    startDate: $('#startDate').val(),
                    endDate: $('#endDate').val(),
                    "_token": "{{ csrf_token() }}",
                };

                $.ajax({
                    url: '/admin/reports/search',
                    type: 'POST',
                    contentType: 'application/json',
                    data: JSON.stringify(formData),
                    success: function(response) {
                        var resultsBody = $('#resultsBody');
                        resultsBody.empty(); // Clear any existing data

                        response.data.forEach(function(item) {
                            var row = `<tr>
                                <td>${item.name}</td>
                                <td>{{transAdmin('SAR')}} ${item.totalReservationsAmount}</td>
                                <td>{{transAdmin('SAR')}} ${item.totalPlatformRatio}</td>
                                <td>${item.date_from}</td>
                                <td>${item.date_to}</td>
                            </tr>`;
                            resultsBody.append(row);
                        });

                        $('#results').show();
                    },
                    error: function(error) {
                        console.error('Error:', error);
                    }
                });
            });

            {{--$('#exportButton').click(function() {--}}
            {{--    var formData = {--}}
            {{--        user_type: $('#user_type').val(),--}}
            {{--        status_name: $('#status_name').val(),--}}
            {{--        startDate: $('#startDate').val(),--}}
            {{--        endDate: $('#endDate').val(),--}}
            {{--        "_token": "{{ csrf_token() }}",--}}
            {{--    };--}}

            {{--    $.ajax({--}}
            {{--        url: '/admin/reports/export',--}}
            {{--        type: 'POST',--}}
            {{--        contentType: 'application/json',--}}
            {{--        data: JSON.stringify(formData),--}}
            {{--        success: function(response) {--}}
            {{--            window.location.href = response.file_url;--}}
            {{--        },--}}
            {{--        error: function(error) {--}}
            {{--            console.error('Error:', error);--}}
            {{--        }--}}
            {{--    });--}}
            {{--});--}}

            $('#exportButton').click(function() {
                // Populate the form fields
                $('#exportUserType').val($('#user_type').val());
                $('#exportStatusName').val($('#status_name').val());
                $('#exportStartDate').val($('#startDate').val());
                $('#exportEndDate').val($('#endDate').val());

                // Submit the form to trigger the download
                $('#exportForm').submit();
            });
        });
    </script>
@endsection
