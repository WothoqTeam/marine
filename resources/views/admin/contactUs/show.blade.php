@extends('admin.layout.master')

@section('css')

@endsection

@section('style')

@endsection

@section('breadcrumb')
<div class="page-title d-flex flex-column justify-content-center gap-1 me-3 pt-6">
    <!--begin::Title-->
    <h1 class="page-heading d-flex flex-column justify-content-center text-dark fw-bold fs-3 m-0">{{trans('labels.labels.profile')}} </h1>
    <!--end::Title-->
    <!--begin::Breadcrumb-->
    <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0">
        <!--begin::Item-->
        <li class="breadcrumb-item text-muted">
            <a href="{{route('admin.faqs.index')}}" class="text-muted text-hover-primary">{{trans('labels.settings.faq_tap')}} </a>
        </li>
        <!--end::Item-->
        <!--begin::Item-->
        <li class="breadcrumb-item">
            <span class="bullet bg-gray-400 w-5px h-2px"></span>
        </li>
        <!--end::Item-->
        <!--begin::Item-->
        <li class="breadcrumb-item text-muted">{{trans('labels.labels.profile')}} </li>
        <!--end::Item-->
    </ul>
    <!--end::Breadcrumb-->
</div>
@endsection

@section('content')

<div id="kt_app_content_container" class="app-container container-fluid">
    <div class="card">


            <div class="card-body p-9">

                <div class="row mb-8">
                    <div class="col-xl-2">
                        <div class="fs-6 fw-semibold">{{trans('labels.inputs.name')}}</div>
                    </div>
                    <div class="col-lg-9">
                        <div class="fw-bold fs-5">{{$data->first_name.' '.$data->last_name}}</div>
                    </div>
                </div>

                <div class="row mb-8">
                    <div class="col-xl-2">
                        <div class="fs-6 fw-semibold">{{trans('labels.inputs.email')}}</div>
                    </div>
                    <div class="col-lg-9">
                        <div class="fw-bold fs-5">{{$data->email}}</div>
                    </div>
                </div>

                <div class="row mb-8">
                    <div class="col-xl-2">
                        <div class="fs-6 fw-semibold">{{trans('labels.inputs.phone')}} EN</div>
                    </div>
                    <div class="col-lg-9">
                        <div class="fw-bold fs-5">{{$data->phone}}</div>
                    </div>
                </div>

                <div class="row mb-8">
                    <div class="col-xl-2">
                        <div class="fs-6 fw-semibold">{{trans('labels.inputs.body')}}</div>
                    </div>
                    <div class="col-lg-9">
                        <div class="fw-bold fs-5">{{$data->message}}</div>
                    </div>
                </div>


                <div class="row mb-8">
                    <div class="col-xl-2">
                        <div class="fs-6 fw-semibold">{{trans('labels.inputs.created_at')}}</div>
                    </div>
                    <div class="col-lg-9">
                        <div class="fw-bold fs-5">{{$data->created_at}}</div>
                    </div>
                </div>

            </div>
        <div class="card-footer d-flex justify-content-end py-6 px-9 center">
            <a class="btn btn-primary center" href="mailto:{{$data->email}}?&subject=Mail from Manasat Admin&body=Some body text here">{{trans('labels.labels.reply_mail')}}</a>
        </div>
    </div>
</div>

@endsection

@section('script')
@endsection
