@extends('admin.layout.master')

@section('css')

@endsection

@section('style')

@endsection

@section('breadcrumb')
    <div class="page-title d-flex flex-column justify-content-center gap-1 me-3 pt-6">
        <!--begin::Title-->
        <h1 class="page-heading d-flex flex-column justify-content-center text-dark fw-bold fs-3 m-0">{{transAdmin('Marasi Reservations')}} </h1>
        <!--end::Title-->
        <!--begin::Breadcrumb-->
        <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0">
            <!--begin::Item-->
            <li class="breadcrumb-item text-muted">
                <a href="{{route('admin.mReservations.index')}}"
                   class="text-muted text-hover-primary">{{transAdmin('Marasi Reservations')}} </a>
            </li>
            <!--end::Item-->
            <!--begin::Item-->
            <li class="breadcrumb-item">
                <span class="bullet bg-gray-400 w-5px h-2px"></span>
            </li>
            <!--end::Item-->
            <!--begin::Item-->
            <li class="breadcrumb-item text-muted">{{transAdmin('Reservation')}} </li>
            <!--end::Item-->
        </ul>
        <!--end::Breadcrumb-->
    </div>
@endsection

@section('content')

    <!--begin::Content container-->
    <div id="kt_app_content_container" class="app-container container-fluid">
        <!--begin::Order details page-->
        <div class="d-flex flex-column gap-7 gap-lg-10">
            <div class="d-flex flex-wrap flex-stack gap-5 gap-lg-10">
                <!--begin:::Tabs-->
                <ul class="nav nav-custom nav-tabs nav-line-tabs nav-line-tabs-2x border-0 fs-4 fw-semibold mb-lg-n2 me-auto">
                    <!--begin:::Tab item-->
                    <li class="nav-item">
                        <a class="nav-link text-active-primary pb-4 active" data-bs-toggle="tab"
                           href="#kt_ecommerce_sales_order_summary">{{transAdmin('Reservation Summary')}}</a>
                    </li>
                    <!--end:::Tab item-->
                </ul>
                <!--end:::Tabs-->
            </div>
            <!--begin::Order summary-->
            <div class="d-flex flex-column flex-xl-row gap-7 gap-lg-10">
                <!--begin::Order details-->
                <div class="card card-flush py-4 flex-row-fluid">
                    <!--begin::Card header-->
                    <div class="card-header">
                        <div class="card-title">
                            <h2>{{transAdmin('Reservation Details')}} (#{{$data['id']}})</h2>
                        </div>
                    </div>
                    <!--end::Card header-->
                    <!--begin::Card body-->
                    <div class="card-body pt-0">
                        <div class="table-responsive">
                            <!--begin::Table-->
                            <table class="table align-middle table-row-bordered mb-0 fs-6 gy-5 min-w-300px">
                                <!--begin::Table body-->
                                <tbody class="fw-semibold text-gray-600">
                                <!--begin::Date-->
                                <tr>
                                    <td class="text-muted">
                                        <div class="d-flex align-items-center">
                                            <!--begin::Svg Icon | path: icons/duotune/files/fil002.svg-->
                                            <span class="svg-icon svg-icon-2 me-2">
                                                <svg width="20" height="21"
                                                     viewBox="0 0 20 21" fill="none"
                                                     xmlns="http://www.w3.org/2000/svg">
                                                    <path opacity="0.3"
                                                          d="M19 3.40002C18.4 3.40002 18 3.80002 18 4.40002V8.40002H14V4.40002C14 3.80002 13.6 3.40002 13 3.40002C12.4 3.40002 12 3.80002 12 4.40002V8.40002H8V4.40002C8 3.80002 7.6 3.40002 7 3.40002C6.4 3.40002 6 3.80002 6 4.40002V8.40002H2V4.40002C2 3.80002 1.6 3.40002 1 3.40002C0.4 3.40002 0 3.80002 0 4.40002V19.4C0 20 0.4 20.4 1 20.4H19C19.6 20.4 20 20 20 19.4V4.40002C20 3.80002 19.6 3.40002 19 3.40002ZM18 10.4V13.4H14V10.4H18ZM12 10.4V13.4H8V10.4H12ZM12 15.4V18.4H8V15.4H12ZM6 10.4V13.4H2V10.4H6ZM2 15.4H6V18.4H2V15.4ZM14 18.4V15.4H18V18.4H14Z"
                                                          fill="currentColor"/>
                                                    <path
                                                        d="M19 0.400024H1C0.4 0.400024 0 0.800024 0 1.40002V4.40002C0 5.00002 0.4 5.40002 1 5.40002H19C19.6 5.40002 20 5.00002 20 4.40002V1.40002C20 0.800024 19.6 0.400024 19 0.400024Z"
                                                        fill="currentColor"/>
                                                </svg>
                                            </span>
                                            <!--end::Svg Icon-->{{transAdmin('Date Added')}}</div>
                                    </td>
                                    <td class="fw-bold text-end">{{date('Y-m-d H:i:s', strtotime($data['created_at']))}}</td>
                                </tr>
                                <!--end::Date-->
                                <!--begin::Payment method-->
                                <tr>
                                    <td class="text-muted">
                                        <div class="d-flex align-items-center">
                                            <!--begin::Svg Icon | path: icons/duotune/finance/fin008.svg-->
                                            <span class="svg-icon svg-icon-2 me-2">
                                                    <svg width="24" height="24"
                                                         viewBox="0 0 24 24" fill="none"
                                                         xmlns="http://www.w3.org/2000/svg">
                                                        <path opacity="0.3"
                                                              d="M3.20001 5.91897L16.9 3.01895C17.4 2.91895 18 3.219 18.1 3.819L19.2 9.01895L3.20001 5.91897Z"
                                                              fill="currentColor"/>
                                                        <path opacity="0.3"
                                                              d="M13 13.9189C13 12.2189 14.3 10.9189 16 10.9189H21C21.6 10.9189 22 11.3189 22 11.9189V15.9189C22 16.5189 21.6 16.9189 21 16.9189H16C14.3 16.9189 13 15.6189 13 13.9189ZM16 12.4189C15.2 12.4189 14.5 13.1189 14.5 13.9189C14.5 14.7189 15.2 15.4189 16 15.4189C16.8 15.4189 17.5 14.7189 17.5 13.9189C17.5 13.1189 16.8 12.4189 16 12.4189Z"
                                                              fill="currentColor"/>
                                                        <path
                                                            d="M13 13.9189C13 12.2189 14.3 10.9189 16 10.9189H21V7.91895C21 6.81895 20.1 5.91895 19 5.91895H3C2.4 5.91895 2 6.31895 2 6.91895V20.9189C2 21.5189 2.4 21.9189 3 21.9189H19C20.1 21.9189 21 21.0189 21 19.9189V16.9189H16C14.3 16.9189 13 15.6189 13 13.9189Z"
                                                            fill="currentColor"/>
                                                    </svg>
                                                </span>
                                            <!--end::Svg Icon-->{{transAdmin('Payment Method')}}
                                        </div>
                                    </td>
                                    <td class="fw-bold text-end">{{$data['payment_method']}}</td>
                                </tr>
                                <!--end::Payment method-->

                                <!--begin::Payment status-->
                                <tr>
                                    <td class="text-muted">
                                        <div class="d-flex align-items-center">
                                            <!--begin::Svg Icon | path: icons/duotune/finance/fin008.svg-->
                                            <span class="svg-icon svg-icon-2 me-2">
                                                    <svg width="24" height="24"
                                                         viewBox="0 0 24 24" fill="none"
                                                         xmlns="http://www.w3.org/2000/svg">
                                                        <path opacity="0.3"
                                                              d="M3.20001 5.91897L16.9 3.01895C17.4 2.91895 18 3.219 18.1 3.819L19.2 9.01895L3.20001 5.91897Z"
                                                              fill="currentColor"/>
                                                        <path opacity="0.3"
                                                              d="M13 13.9189C13 12.2189 14.3 10.9189 16 10.9189H21C21.6 10.9189 22 11.3189 22 11.9189V15.9189C22 16.5189 21.6 16.9189 21 16.9189H16C14.3 16.9189 13 15.6189 13 13.9189ZM16 12.4189C15.2 12.4189 14.5 13.1189 14.5 13.9189C14.5 14.7189 15.2 15.4189 16 15.4189C16.8 15.4189 17.5 14.7189 17.5 13.9189C17.5 13.1189 16.8 12.4189 16 12.4189Z"
                                                              fill="currentColor"/>
                                                        <path
                                                            d="M13 13.9189C13 12.2189 14.3 10.9189 16 10.9189H21V7.91895C21 6.81895 20.1 5.91895 19 5.91895H3C2.4 5.91895 2 6.31895 2 6.91895V20.9189C2 21.5189 2.4 21.9189 3 21.9189H19C20.1 21.9189 21 21.0189 21 19.9189V16.9189H16C14.3 16.9189 13 15.6189 13 13.9189Z"
                                                            fill="currentColor"/>
                                                    </svg>
                                                </span>
                                            <!--end::Svg Icon-->{{transAdmin('Reservations Status')}}
                                        </div>
                                    </td>
                                    <td class="fw-bold text-end">
                                        {{transAdmin(ucfirst($data['reservations_status']))}}
                                    </td>
                                </tr>
                                <!--end::Payment status-->
                                @if($data['reservations_status']=='canceled')
                                <!--begin::Cancel Reason-->
                                <tr>
                                    <td class="text-muted">
                                        <div class="d-flex align-items-center">
                                            <!--begin::Svg Icon | path: icons/duotune/finance/fin008.svg-->
                                            <span class="svg-icon svg-icon-2 me-2">
                                                    <svg width="24" height="24"
                                                         viewBox="0 0 24 24" fill="none"
                                                         xmlns="http://www.w3.org/2000/svg">
                                                        <path opacity="0.3"
                                                              d="M3.20001 5.91897L16.9 3.01895C17.4 2.91895 18 3.219 18.1 3.819L19.2 9.01895L3.20001 5.91897Z"
                                                              fill="currentColor"/>
                                                        <path opacity="0.3"
                                                              d="M13 13.9189C13 12.2189 14.3 10.9189 16 10.9189H21C21.6 10.9189 22 11.3189 22 11.9189V15.9189C22 16.5189 21.6 16.9189 21 16.9189H16C14.3 16.9189 13 15.6189 13 13.9189ZM16 12.4189C15.2 12.4189 14.5 13.1189 14.5 13.9189C14.5 14.7189 15.2 15.4189 16 15.4189C16.8 15.4189 17.5 14.7189 17.5 13.9189C17.5 13.1189 16.8 12.4189 16 12.4189Z"
                                                              fill="currentColor"/>
                                                        <path
                                                            d="M13 13.9189C13 12.2189 14.3 10.9189 16 10.9189H21V7.91895C21 6.81895 20.1 5.91895 19 5.91895H3C2.4 5.91895 2 6.31895 2 6.91895V20.9189C2 21.5189 2.4 21.9189 3 21.9189H19C20.1 21.9189 21 21.0189 21 19.9189V16.9189H16C14.3 16.9189 13 15.6189 13 13.9189Z"
                                                            fill="currentColor"/>
                                                    </svg>
                                                </span>
                                            <!--end::Svg Icon-->{{transAdmin('Cancel Reason')}}
                                        </div>
                                    </td>
                                    <td class="fw-bold text-end">
                                        {{$data['canceled_reason']}}
                                    </td>
                                </tr>
                                <!--end::Cancel Reason-->
                                @endif
                                </tbody>
                                <!--end::Table body-->
                            </table>
                            <!--end::Table-->
                        </div>
                    </div>
                    <!--end::Card body-->
                </div>
                <!--end::Order details-->
                <!--begin::Customer details-->
                <div class="card card-flush py-4 flex-row-fluid">
                    <!--begin::Card header-->
                    <div class="card-header">
                        <div class="card-title">
                            <h2>{{transAdmin('Provider Details')}}</h2>
                        </div>
                    </div>
                    <!--end::Card header-->
                    <!--begin::Card body-->
                    <div class="card-body pt-0">
                        <div class="table-responsive">
                            <!--begin::Table-->
                            <table class="table align-middle table-row-bordered mb-0 fs-6 gy-5 min-w-300px">
                                <!--begin::Table body-->
                                <tbody class="fw-semibold text-gray-600">
                                <!--begin::Customer name-->
                                <tr>
                                    <td class="text-muted">
                                        <div class="d-flex align-items-center">
                                            <!--begin::Svg Icon | path: icons/duotune/communication/com006.svg-->
                                            <span class="svg-icon svg-icon-2 me-2">
                                                <svg width="18" height="18"
                                                     viewBox="0 0 18 18" fill="none"
                                                     xmlns="http://www.w3.org/2000/svg">
                                                    <path opacity="0.3"
                                                          d="M16.5 9C16.5 13.125 13.125 16.5 9 16.5C4.875 16.5 1.5 13.125 1.5 9C1.5 4.875 4.875 1.5 9 1.5C13.125 1.5 16.5 4.875 16.5 9Z"
                                                          fill="currentColor"/>
                                                    <path
                                                        d="M9 16.5C10.95 16.5 12.75 15.75 14.025 14.55C13.425 12.675 11.4 11.25 9 11.25C6.6 11.25 4.57499 12.675 3.97499 14.55C5.24999 15.75 7.05 16.5 9 16.5Z"
                                                        fill="currentColor"/>
                                                    <rect x="7" y="6" width="4" height="4"
                                                          rx="2" fill="currentColor"/>
                                                </svg>
                                            </span>
                                            <!--end::Svg Icon-->{{transAdmin('Provider Name')}}
                                        </div>
                                    </td>
                                    <td class="fw-bold text-end">
                                        <div class="d-flex align-items-center justify-content-end">
                                            <!--begin::Name-->
                                            <a href="{{route('admin.providers.show', $data['provider_id'])}}"
                                               class="text-gray-600 text-hover-primary">{{$data['provider']['name']}}</a>
                                            <!--end::Name-->
                                        </div>
                                    </td>
                                </tr>
                                <!--end::Customer name-->
                                <!--begin::Customer email-->
                                <tr>
                                    <td class="text-muted">
                                        <div class="d-flex align-items-center">
                                            <!--begin::Svg Icon | path: icons/duotune/communication/com011.svg-->
                                            <span class="svg-icon svg-icon-2 me-2">
                                                <svg width="24" height="24"
                                                     viewBox="0 0 24 24" fill="none"
                                                     xmlns="http://www.w3.org/2000/svg">
                                                    <path opacity="0.3"
                                                          d="M21 19H3C2.4 19 2 18.6 2 18V6C2 5.4 2.4 5 3 5H21C21.6 5 22 5.4 22 6V18C22 18.6 21.6 19 21 19Z"
                                                          fill="currentColor"/>
                                                    <path
                                                        d="M21 5H2.99999C2.69999 5 2.49999 5.10005 2.29999 5.30005L11.2 13.3C11.7 13.7 12.4 13.7 12.8 13.3L21.7 5.30005C21.5 5.10005 21.3 5 21 5Z"
                                                        fill="currentColor"/>
                                                </svg>
                                            </span>
                                            <!--end::Svg Icon-->{{trans('labels.inputs.email')}}
                                        </div>
                                    </td>
                                    <td class="fw-bold text-end">
                                        <a href="{{route('admin.providers.show', $data['provider_id'])}}"
                                           class="text-gray-600 text-hover-primary">{{$data['provider']['email']}}</a>
                                    </td>
                                </tr>
                                <!--end::Payment method-->
                                <!--begin::Date-->
                                <tr>
                                    <td class="text-muted">
                                        <div class="d-flex align-items-center">
                                            <!--begin::Svg Icon | path: icons/duotune/electronics/elc003.svg-->
                                            <span class="svg-icon svg-icon-2 me-2">
                                                <svg width="24" height="24"
                                                     viewBox="0 0 24 24" fill="none"
                                                     xmlns="http://www.w3.org/2000/svg">
                                                    <path
                                                        d="M5 20H19V21C19 21.6 18.6 22 18 22H6C5.4 22 5 21.6 5 21V20ZM19 3C19 2.4 18.6 2 18 2H6C5.4 2 5 2.4 5 3V4H19V3Z"
                                                        fill="currentColor"/>
                                                    <path opacity="0.3" d="M19 4H5V20H19V4Z"
                                                          fill="currentColor"/>
                                                </svg>
                                            </span>
                                            <!--end::Svg Icon-->{{trans('labels.inputs.phone')}}
                                        </div>
                                    </td>
                                    <td class="fw-bold text-end">{{$data['provider']['phone']}}</td>
                                </tr>
                                <!--end::Date-->
                                </tbody>
                                <!--end::Table body-->
                            </table>
                            <!--end::Table-->
                        </div>
                    </div>
                    <!--end::Card body-->
                </div>
                <!--end::Customer details-->

            </div>
            <!--end::Order summary-->
            <!--begin::Tab content-->
            <div class="tab-content">
                <!--begin::Tab pane-->
                <div class="tab-pane fade show active" id="kt_ecommerce_sales_order_summary" role="tab-panel">
                    <!--begin::Orders-->
                    <div class="d-flex flex-column gap-7 gap-lg-10">
                        <!--begin::Product List-->
                        <div class="card card-flush py-4 flex-row-fluid overflow-hidden">
                            <!--begin::Card header-->
                            <div class="card-header">
                                <div class="card-title">
                                    <h2>{{transAdmin('Reservation')}} #{{$data['id']}}</h2>
                                </div>
                            </div>
                            <!--end::Card header-->
                            <!--begin::Card body-->
                            <div class="card-body pt-0">
                                <div class="table-responsive">
                                    <!--begin::Table-->
                                    <table class="table align-middle table-row-dashed fs-6 gy-5 mb-0">
                                        <!--begin::Table head-->
                                        <thead>
                                        <tr class="text-start text-gray-400 fw-bold fs-7 text-uppercase gs-0">
                                            <th class="min-w-175px">{{transAdmin('Marasi')}}</th>
                                            <th class="min-w-175px">{{transAdmin('Services')}}</th>
                                            <th class="min-w-175px">{{transAdmin('Number Meters')}}</th>
                                            <th class="min-w-100px text-end">{{transAdmin('Total')}}</th>
                                        </tr>
                                        </thead>
                                        <!--end::Table head-->
                                        <!--begin::Table body-->
                                        <tbody class="fw-semibold text-gray-600">
                                        <!--begin::Products-->
                                        <tr>
                                            <!--begin::Product-->
                                            <td>
                                                @php
                                                    $data['marasi']=\App\Models\Marasi::find($data['marasi']['id']);
                                                @endphp
                                                <div class="d-flex align-items-center">
                                                    <!--begin::Thumbnail-->
                                                    <a href="{{route('admin.marasi.show', $data['marasi']['id'])}}"
                                                       class="symbol symbol-50px">
                                                        @if ($data['marasi']->getMedia('covers')->count())
                                                            <span class="symbol-label"
                                                                  style="background-image:url({{$data['marasi']->getFirstMediaUrl('covers')}});"></span>
                                                        @else
                                                            <span class="symbol-label"
                                                                  style="background-image:url(assets/media/svg/avatars/blank.svg);"></span>
                                                        @endif
                                                    </a>
                                                    <!--end::Thumbnail-->
                                                    <!--begin::Title-->
                                                    <div class="ms-5">
                                                        <a href="{{route('admin.marasi.show', $data['marasi']['id'])}}"
                                                           class="fw-bold text-gray-600 text-hover-primary">
                                                            @if (\Illuminate\Support\Facades\App::getLocale() == 'en')
                                                                {{$data['marasi']['name_en']}}
                                                            @else
                                                                {{$data['marasi']['name_ar']}}
                                                            @endif
                                                        </a>
                                                    </div>
                                                    <!--end::Title-->
                                                </div>
                                            </td>
                                            <!--end::Product-->
                                            <!--begin::Services-->
                                            <td>
                                                <ul class="list-unstyled">
                                                    @foreach($services as $service)
                                                        <li>
                                                            <a href="{{route('admin.Services.show', $service->services->id)}}"
                                                               class="fw-bold text-gray-600 text-hover-primary">
                                                                @if (\Illuminate\Support\Facades\App::getLocale() == 'en')
                                                                    {{ $service->services->name_en }}
                                                                @else
                                                                    {{ $service->services->name_ar }}
                                                                @endif
                                                            </a>
                                                        </li>
                                                    @endforeach
                                                </ul>
                                            </td>
                                            <!--end::Services-->
                                            <!--begin::Sub Total-->
                                            <td class="list-unstyled">{{$data['num_meters']}}</td>
                                            <!--end::Sub Total-->
                                            <!--begin::Sub Total-->
                                            <td class="text-end">{{$data['sub_total']}}</td>
                                            <!--end::Sub Total-->
                                        </tr>
                                        <!--end::Products-->
                                        <!--begin::Subtotal-->
                                        <tr>
                                            <td colspan="4" class="text-end">{{transAdmin('Subtotal')}}</td>
                                            <td class="text-end">{{$data['sub_total']}}</td>
                                        </tr>
                                        <!--end::Subtotal-->
                                        <!--begin::VAT-->
                                        <tr>
                                            <td colspan="4" class="text-end">{{transAdmin('Vat')}}</td>
                                            <td class="text-end">{{$data['vat']}}</td>
                                        </tr>
                                        <!--end::VAT-->
                                        <!--begin::Shipping-->
                                        <tr>
                                            <td colspan="4" class="text-end">{{transAdmin('Service Fee')}}</td>
                                            <td class="text-end">{{$data['service_fee']}}</td>
                                        </tr>
                                        {{--                                        <!--end::Shipping-->--}}
                                        {{--                                        <!--begin::Grand total-->--}}
                                        {{--                                        <tr>--}}
                                        <td colspan="4" class="fs-3 text-dark text-end">{{transAdmin('Total')}}</td>
                                        <td class="text-dark fs-3 fw-bolder text-end">{{$data['total']}} {{transAdmin('Sar')}}</td>
                                        </tr>
                                        <!--end::Grand total-->
                                        </tbody>
                                        <!--end::Table head-->
                                    </table>
                                    <!--end::Table-->
                                </div>
                                <div class="my-1 me-5">
                                    @if(Auth::guard('admin')->user()->role_id==2)
                                        @if($data['reservations_status']=='pending')
                                            <!-- begin::Accept-->
                                            <button href="" type="button" class="btn btn-success my-1 me-12"
                                                    onclick="updateReservationsStatus('in progress')">{{transAdmin('Accept')}}</button>
                                            <!-- end::Accept-->

                                            <!-- begin::Rejected-->
                                            <button type="button" class="btn btn-danger my-1 me-12"
                                                    onclick="updateReservationsStatus('rejected')">{{transAdmin('Rejected')}}</button>
                                            <!-- end::Rejected-->
                                            <br/>
                                            <!-- begin::Canceled-->
                                            <button type="button" class="btn btn-danger my-1 me-12"
                                                    onclick="updateReservationsStatus('canceled')">{{transAdmin('canceled')}}</button>
                                            <!-- end::Canceled-->

                                        @elseif($data['reservations_status']=='in progress')
                                            <!-- begin::Canceled-->
                                            <button type="button" class="btn btn-danger my-1 me-12"
                                                    onclick="updateReservationsStatus('canceled')">{{transAdmin('canceled')}}</button>
                                            <!-- end::Canceled-->

                                            <!-- begin::Completed-->
                                            <button type="button" class="btn btn-success my-1 me-12"
                                                    onclick="updateReservationsStatus('completed')">{{transAdmin('Completed')}}</button>
                                            <!-- end::Completed-->
                                        @endif
                                    @endif
                                    <!-- begin::Pint-->
                                    <a type="button" class="btn btn-success my-1 me-12"
                                       href="{{route('admin.mReservations.print',$data['id'])}}"
                                       target="_blank">{{transAdmin('Print Invoice')}}</a>
                                    <!-- end::Pint-->
                                    <!-- Cancellation Reason Textarea -->
                                    <div id="cancelReasonContainer" style="display: none; margin-top: 10px;">
                                        <textarea id="cancelReason" class="form-control"
                                                  placeholder="{{ transAdmin('Enter Cancellation Reason') }}"></textarea>
                                        <button type="button" class="btn btn-primary my-2"
                                                onclick="submitCancellation()">{{ transAdmin('Submit Cancellation') }}
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <!--end::Card body-->
                        </div>
                        <!--end::Product List-->
                    </div>
                    <!--end::Orders-->
                </div>
                <!--end::Tab pane-->
            </div>
            <!--end::Tab content-->
        </div>
        <!--end::Order details page-->
    </div>
    <!--end::Content container-->

@endsection

@section('script')
    <script>
        function updateReservationsStatus(status) {
            if (status === 'canceled') {
                document.getElementById('cancelReasonContainer').style.display = 'block';
            } else {
                submitStatusUpdate(status, null);
            }
        }

        function submitCancellation() {
            const reason = document.getElementById('cancelReason').value;
            if (reason.trim() === '') {
                toastr.error("Please enter a reason for cancellation.");
                return;
            }
            submitStatusUpdate('canceled', reason);
        }

        function submitStatusUpdate(status, reason) {
            $.ajax(
                {
                    url: "{{route('admin.mReservations.update')}}",
                    type: 'post',
                    dataType: "JSON",
                    data: {
                        "id": '{{$data['id']}}',
                        "status": status,
                        "canceled_reason": reason, // Add the reason to the data payload
                        "marasi_id": {{$data['marasi']['id']}},
                        "employee_id": {{Auth::guard('admin')->user()->id}},
                        "_method": 'post',
                        "_token": '{{ csrf_token() }}',
                    },
                    success: function (data) {
                        if (data.message == "success") {
                            toastr.success("", "تم التعديل بنجاح");
                            window.location.reload();
                        } else {
                            toastr.success("", "عفوا لم التعديل ");
                        }
                    },
                    fail: function (xhrerrorThrown) {
                        toastr.success("", "عفوا لم يتم التعديل");
                    }
                });
        }
    </script>
@endsection
