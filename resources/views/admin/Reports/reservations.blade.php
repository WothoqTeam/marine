@extends('admin.layout.master')

@section('css')
@endsection

@section('style')
    <style>
        .statistics-card {
            text-align: center;
            padding: 20px;
            margin: 10px 0;
            border-radius: 10px;
            color: white;
            transition: transform 0.3s ease;
        }
        .statistics-card:hover {
            transform: scale(1.05);
        }
        .statistics-card .value {
            font-size: 2.5rem;
            font-weight: bold;
        }
        .statistics-card .label {
            font-size: 1.2rem;
            font-weight: 500;
        }
        .profit-card {
            background-color: #28a745; /* Bootstrap success color */
        }
        .vat-card {
            background-color: #17a2b8; /* Bootstrap info color */
        }
        .results-container {
            display: flex;
            justify-content: space-around;
            align-items: center;
            margin-top: 20px;
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
        <!--begin::Breadcrumb-->
        <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0">
            <!--begin::Item-->
            <li class="breadcrumb-item text-muted">
                <a href="{{route('admin.reports.reservations')}}" class="text-muted text-hover-primary">{{trans('admin.reports')}}</a>
            </li>
            <!--end::Item-->
            <!--begin::Item-->
            <li class="breadcrumb-item">
                <span class="bullet bg-gray-400 w-5px h-2px"></span>
            </li>
            <!--end::Item-->
            <!--begin::Item-->
            <li class="breadcrumb-item text-muted">
                <a class="text-muted text-hover-primary">{{trans('admin.Reservation')}}</a>
            </li>
            <!--end::Item-->
        </ul>
        <!--end::Breadcrumb-->
    </div>
@endsection

@section('content')

    <div id="kt_app_content_container" class="app-container container-fluid">
        <div class="card mb-5 mb-xl-10">
            <!--begin::Content-->
            <div id="kt_account_settings_profile_details" class="collapse show">
                <form id="dynamicForm">
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
                    <div class="card-title">{{trans('admin.Results')}}</div>
                    <div class="results-container">
                        <div class="card statistics-card profit-card">
                            <div class="value" id="totalReservationsAmount"></div>
                            <div class="label">{{trans('admin.Total amount for reservations')}}</div>
                        </div>
                        <div class="card statistics-card vat-card">
                            <div class="value" id="totalPlatformRatio"></div>
                            <div class="label">{{trans('admin.Total platform ratio')}}</div>
                        </div>
                    </div>
                </div>
            </div>
            <!--end::Content-->
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
                        $('#totalReservationsAmount').text('{{trans('admin.sar')}} ' + response.totalReservationsAmount);
                        $('#totalPlatformRatio').text('{{trans('admin.sar')}} ' + response.totalPlatformRatio);
                        $('#results').show();
                    },
                    error: function(error) {
                        console.error('Error:', error);
                    }
                });
            });
        });
    </script>
@endsection
