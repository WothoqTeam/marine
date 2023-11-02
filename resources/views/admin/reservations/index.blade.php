@extends('admin.layout.master')

@section('css')
    <link href="{{asset('dash/assets/plugins/custom/datatables/datatables.bundle.rtl.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('dash/assets/plugins/custom/datatables/buttons.bootstrap4.min.css')}}" rel="stylesheet" type="text/css" />
@endsection

@section('style')

@endsection

@section('breadcrumb')

@endsection

@section('content')
    <!--begin::Container-->
    <!--begin::Content container-->
    <div id="kt_app_content_container" class="app-container container-fluid">
        <!--begin::Products-->
        <div class="card card-flush">
            <!--begin::Card header-->
            <div class="card-header align-items-center py-5 gap-2 gap-md-5">
                <!--begin::Card title-->
                <div class="card-title">
                    <!--begin::Search-->
                    <div class="d-flex align-items-center position-relative my-1">
                        <!--begin::Svg Icon | path: icons/duotune/general/gen021.svg-->
                        <span class="svg-icon svg-icon-1 position-absolute ms-4">
														<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
															<rect opacity="0.5" x="17.0365" y="15.1223" width="8.15546" height="2" rx="1" transform="rotate(45 17.0365 15.1223)" fill="currentColor" />
															<path d="M11 19C6.55556 19 3 15.4444 3 11C3 6.55556 6.55556 3 11 3C15.4444 3 19 6.55556 19 11C19 15.4444 15.4444 19 11 19ZM11 5C7.53333 5 5 7.53333 5 11C5 14.4667 7.53333 17 11 17C14.4667 17 17 14.4667 17 11C17 7.53333 14.4667 5 11 5Z" fill="currentColor" />
														</svg>
													</span>
                        <!--end::Svg Icon-->
                        <input type="text" data-kt-ecommerce-order-filter="search" class="form-control form-control-solid w-250px ps-14" placeholder="{{transAdmin('search')}}" />
                    </div>
                    <!--end::Search-->
                </div>
                <!--end::Card title-->
                <!--begin::Card toolbar-->
                <div class="card-toolbar flex-row-fluid justify-content-end gap-5">
                    <!--begin::Flatpickr-->
                    <div class="input-group w-250px">
                        <input class="form-control form-control-solid rounded rounded-end-0" placeholder="{{transAdmin('Pick Date Range')}}" id="kt_ecommerce_sales_flatpickr" />
                        <button class="btn btn-icon btn-light" id="kt_ecommerce_sales_flatpickr_clear">
                            <!--begin::Svg Icon | path: icons/duotune/arrows/arr088.svg-->
                            <span class="svg-icon svg-icon-2">
															<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
																<rect opacity="0.5" x="7.05025" y="15.5356" width="12" height="2" rx="1" transform="rotate(-45 7.05025 15.5356)" fill="currentColor" />
																<rect x="8.46447" y="7.05029" width="12" height="2" rx="1" transform="rotate(45 8.46447 7.05029)" fill="currentColor" />
															</svg>
														</span>
                            <!--end::Svg Icon-->
                        </button>
                    </div>
                    <!--end::Flatpickr-->
                    <div class="w-100 mw-150px">
                        <!--begin::Select2-->
                        <select class="form-select form-select-solid" data-control="select2" data-hide-search="true" data-placeholder="{{trans('labels.inputs.status')}}" data-kt-ecommerce-order-filter="status">
                            <option></option>
                            <option value="all">{{transAdmin('All')}}</option>
                            <option value="pending">{{transAdmin('pending')}}</option>
                            <option value="in progress">{{transAdmin('in progress')}}</option>
                            <option value="rejected">{{transAdmin('rejected')}}</option>
                            <option value="canceled">{{transAdmin('canceled')}}</option>
                            <option value="completed">{{transAdmin('completed')}}</option>
                        </select>
                        <!--end::Select2-->
                    </div>
                </div>
                <!--end::Card toolbar-->
            </div>
            <!--end::Card header-->
            <!--begin::Card body-->
            <div class="card-body pt-0">
                <!--begin::Table-->
                <table class="table align-middle table-row-dashed fs-6 gy-5" id="kt_ecommerce_sales_table">
                    <!--begin::Table head-->
                    <thead>
                    <!--begin::Table row-->
                    <tr class="text-start text-gray-400 fw-bold fs-7 text-uppercase gs-0">
                        <th class="w-10px pe-2">
                            <div class="form-check form-check-sm form-check-custom form-check-solid me-3">
                                <input class="form-check-input" type="checkbox" data-kt-check="true" data-kt-check-target="#kt_ecommerce_sales_table .form-check-input" value="1" />
                            </div>
                        </th>
                        <th class="min-w-125px text-start">{{transAdmin('id')}}</th>
                        <th class="min-w-100px text-start">{{transAdmin('Users')}}</th>
                        <th class="text-end min-w-70px">{{trans('labels.inputs.status')}}</th>
                        <th class="text-end min-w-100px">{{transAdmin('Total')}}</th>
                        <th class="text-end min-w-100px">{{transAdmin('Date Added')}}</th>
                        <th class="text-end min-w-100px">{{transAdmin('Date Modified')}}</th>
                        <th class="text-end min-w-100px">{{transAdmin('Actions')}}</th>
                    </tr>
                    <!--end::Table row-->
                    </thead>
                    <!--end::Table head-->
                    <!--begin::Table body-->
                    <tbody class="fw-semibold text-gray-600">
                    @foreach($reservations as $reservation)
                        @php
                            $user=\App\Models\User::find($reservation['user_id']);
                        @endphp
                        <tr>
                            <!--begin::Checkbox-->
                            <td>
                                <div class="form-check form-check-sm form-check-custom form-check-solid">
                                    <input class="form-check-input" type="checkbox" value="1" />
                                </div>
                            </td>
                            <!--end::Checkbox-->
                            <!--begin::purchase ID=-->
                            <td data-kt-ecommerce-order-filter="purchase_id">
                                <a href="{{route('admin.reservations.show',$reservation['id'])}}" class="text-gray-800 text-hover-primary fw-bold">{{$reservation['id']}}</a>
                            </td>
                            <!--end::purchase ID=-->
                            <!--begin::Customer=-->
                            <td>
                                <div class="d-flex align-items-center">
                                    @if($user->getMedia('profile')->count())
                                    <!--begin:: Avatar -->
                                    <div class="symbol symbol-circle symbol-50px overflow-hidden me-3">
                                        <a href="{{route('admin.users.show', $reservation['user_id'])}}">
                                            <div class="symbol-label">
                                                <img src="{{$user->getFirstMediaUrl('profile')}}" alt="Sean Bean" class="w-100" />
                                            </div>
                                        </a>
                                    </div>
                                    <!--end::Avatar-->
                                    @else
                                    <!--begin:: Avatar -->
                                    <div class="symbol symbol-circle symbol-50px overflow-hidden me-3">
                                        <a href="{{route('admin.users.show', $reservation['user_id'])}}">
                                            <div class="symbol-label fs-3 bg-light-primary text-primary">{{$reservation['user']['name'][0]}}</div>
                                        </a>
                                    </div>
                                    <!--end::Avatar-->
                                    @endif
                                    <div class="ms-5">
                                        <!--begin::Title-->
                                        <a href="{{route('admin.users.show', $reservation['user_id'])}}" class="text-gray-800 text-hover-primary fs-5 fw-bold">{{$reservation['user']['name']}}</a>
                                        <!--end::Title-->
                                    </div>
                                </div>
                            </td>
                            <!--end::Customer=-->
                            <!--begin::Status=-->
                            <td class="text-end pe-0" data-order="{{$reservation['reservations_status']}}">
                                <!--begin::Badges-->
                                @if($reservation['reservations_status']=='canceled' || $reservation['reservations_status']=='rejected')

                                        <div class="badge badge-light-danger">{{transAdmin(ucfirst($reservation['reservations_status']))}}</div>
                                @elseif($reservation['reservations_status']=='completed')
                                        <div class="badge badge-light-success">{{transAdmin(ucfirst($reservation['reservations_status']))}}</div>
                                @else
                                    <div class="badge badge-light-warning">{{transAdmin(ucfirst($reservation['reservations_status']))}}</div>
                                @endif
                                <!--end::Badges-->
                            </td>
                            <!--end::Status=-->
                            <!--begin::Total=-->
                            <td class="text-end pe-0">
                                <span class="fw-bold">{{$reservation['total']}}</span>
                            </td>
                            <!--end::Total=-->
                            <!--begin::Date Added=-->
                            <td class="text-end" data-order="{{date('Y-m-d', strtotime($reservation['created_at']))}}">
                                <span class="fw-bold">{{date('d/m/Y', strtotime($reservation['created_at']))}}</span>
                            </td>
                            <!--end::Date Added=-->
                            <!--begin::Date Modified=-->
                            <td class="text-end" data-order="{{date('Y-m-d', strtotime($reservation['updated_at']))}}">
                                <span class="fw-bold">{{date('d/m/Y', strtotime($reservation['updated_at']))}}</span>
                            </td>
                            <!--end::Date Modified=-->
                            <!--begin::Action=-->
                            <td class="text-end">
                                <a href="#" class="btn btn-sm btn-light btn-active-light-primary" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">{{transAdmin('Actions')}}
                                    <!--begin::Svg Icon | path: icons/duotune/arrows/arr072.svg-->
                                    <span class="svg-icon svg-icon-5 m-0">
																<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
																	<path d="M11.4343 12.7344L7.25 8.55005C6.83579 8.13583 6.16421 8.13584 5.75 8.55005C5.33579 8.96426 5.33579 9.63583 5.75 10.05L11.2929 15.5929C11.6834 15.9835 12.3166 15.9835 12.7071 15.5929L18.25 10.05C18.6642 9.63584 18.6642 8.96426 18.25 8.55005C17.8358 8.13584 17.1642 8.13584 16.75 8.55005L12.5657 12.7344C12.2533 13.0468 11.7467 13.0468 11.4343 12.7344Z" fill="currentColor" />
																</svg>
															</span>
                                    <!--end::Svg Icon--></a>
                                <!--begin::Menu-->
                                <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-125px py-4" data-kt-menu="true">
                                    <!--begin::Menu item-->
                                    <div class="menu-item px-3">
                                        <a href="{{route('admin.reservations.show',$reservation['id'])}}" class="menu-link px-3">{{transAdmin('View')}}</a>
                                    </div>
                                    <!--end::Menu item-->
                                </div>
                                <!--end::Menu-->
                            </td>
                            <!--end::Action=-->
                        </tr>
                    @endforeach
                    </tbody>
                    <!--end::Table body-->
                </table>
                <!--end::Table-->
            </div>
            <!--end::Card body-->
        </div>
        <!--end::Products-->
    </div>
    <!--end::Content container-->
    <!--end::Container-->
@endsection

@section('script')
<script src="{{asset('dash/assets/plugins/custom/datatables/datatables.bundle.js')}}"></script>
<script src="{{asset('dash/assets/plugins/custom/datatables/dataTables.buttons.min.js')}}"></script>
<script src="{{asset('dash/assets/plugins/custom/datatables/buttons.print.min.js')}}"></script>
<!--begin::Custom Javascript(used for this page only)-->
<script src="{{asset('dash/assets/js/custom/apps/ecommerce/sales/listing.js')}}"></script>
<script src="{{asset('dash/assets/js/widgets.bundle.js')}}"></script>
<script src="{{asset('dash/assets/js/custom/widgets.js')}}"></script>
<script src="{{asset('dash/assets/js/custom/apps/chat/chat.js')}}"></script>
<script src="{{asset('dash/assets/js/custom/utilities/modals/upgrade-plan.js')}}"></script>
<script src="{{asset('dash/assets/js/custom/utilities/modals/create-campaign.js')}}"></script>
<script src="{{asset('dash/assets/js/custom/utilities/modals/users-search.js')}}"></script>
<!--end::Custom Javascript-->
@endsection
