@extends('admin.layout.master')

@section('css')
    <link href="{{asset('dash/assets/plugins/custom/datatables/datatables.bundle.rtl.css')}}" rel="stylesheet"
          type="text/css"/>
    <link href="{{asset('dash/assets/plugins/custom/datatables/buttons.bootstrap4.min.css')}}" rel="stylesheet"
          type="text/css"/>
@endsection

@section('style')

@endsection

@section('breadcrumb')
    <div class="d-flex align-items-center" id="kt_header_nav">
        <!--begin::Page title-->
        <div data-kt-swapper="true" data-kt-swapper-mode="prepend"
             data-kt-swapper-parent="{default: '#kt_content_container', 'lg': '#kt_header_nav'}"
             class="page-title d-flex align-items-center flex-wrap me-3 mb-5 mb-lg-0">
            <a href="{{url('/admin')}}">
                <h1 class="d-flex align-items-center text-dark fw-bolder fs-3 my-1">
                    {{transAdmin('Dashboard')}}
                </h1>
            </a>
            <span class="h-20px border-gray-300 border-start mx-4"></span>
            <ul class="breadcrumb breadcrumb-separatorless fw-bold fs-7 my-1">
                <li class="breadcrumb-item text-muted px-2">
                    <a href="{{route('admin.ratings.index')}}"
                       class="text-muted text-hover-primary">{{transAdmin('Ratings')}}</a>
                </li>
                {{-- <li class="breadcrumb-item">
                    <span class="bullet bg-gray-300 w-5px h-2px"></span>
                </li> --}}

            </ul>
        </div>
        <!--end::Page title-->
    </div>
@endsection

@section('content')
    <!--begin::Container-->
    <div id="kt_app_content_container" class="app-container container-fluid">

        <div class="card no-border">
            <!--begin::Card body-->
            <div class="card-body py-4">
                <!--begin::Table-->
                <table class="table align-middle table-rounded table-striped table-row-dashed fs-6"
                       id="kt_datatable_table">
                    <!--begin::Table head-->
                    <thead class="bg-light-dark pe-3">
                    <!--begin::Table row-->
                    <tr class="text-start text-dark fw-bold fs-4 text-uppercase gs-0">
                        <th class="w-10px p-3">
                            <div class="form-check form-check-sm form-check-custom form-check-solid ">
                                <input class="form-check-input" type="checkbox" data-kt-check="true"
                                       data-kt-check-target="#kt_datatable_table .form-check-input" value="1"/>
                            </div>
                        </th>
                        <th class="min-w-125px text-start">{{transAdmin('Customers Name')}}</th>
                        <th class="min-w-125px text-start">{{transAdmin('Stars')}}</th>
                        <th class="min-w-125px text-start">{{transAdmin('Comments')}}</th>
                    </tr>
                    <!--end::Table row-->
                    </thead>
                    <!--end::Table head-->
                    <!--begin::Table body-->
                    <tbody class="text-gray-600 fw-bold">
                    </tbody>
                    <!--end::Table body-->
                </table>
                <!--end::Table-->
            </div>
            <!--end::Card body-->
        </div>
    </div>
    <!--end::Container-->
@endsection

@section('script')
    <script src="{{asset('dash/assets/plugins/custom/datatables/datatables.bundle.js')}}"></script>
    <script src="{{asset('dash/assets/plugins/custom/datatables/dataTables.buttons.min.js')}}"></script>
    <script src="{{asset('dash/assets/plugins/custom/datatables/buttons.print.min.js')}}"></script>

    <script>
        $(function () {

            var table = $('#kt_datatable_table').DataTable({
                processing: false,
                serverSide: true,
                searching: false,
                autoWidth: false,
                responsive: true,
                pageLength: 10,
                sort: false,
                dom: 'Bfrtip',
                buttons: [
                    // {
                    //     extend: 'print',
                    //     className: 'btn btn-primary',
                    //     text: 'طباعه'
                    // },
                    // {extend: 'pdf', className: 'btn btn-raised btn-danger', text: 'PDF'},
                    {
                        extend: 'excel',
                        className: 'btn btn-sm btn-icon btn-success btn-active-dark me-3 p-3',
                        text: '<i class="bi bi-file-earmark-spreadsheet fs-1x"></i>'
                    },
                    //{extend: 'colvis', className: 'btn secondary', text: 'إظهار / إخفاء الأعمدة '}
                ],
                ajax: {
                    url: "{{ route('admin.ratings.index') }}",
                    data: function (d) {}
                },
                columns: [
                    {data: 'checkbox', name: 'checkbox'},
                    {data: 'name', name: 'name'},
                    {data: 'stars', name: 'stars'},
                    {data: 'comments', name: 'comments'},
                ]
            });

            table.buttons().container().appendTo($('.dbuttons'));
        });
    </script>
@endsection
