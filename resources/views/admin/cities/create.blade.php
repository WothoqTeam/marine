@extends('admin.layout.master')

@section('css')
@endsection

@section('style')

@endsection

@section('breadcrumb')
<div class="page-title d-flex flex-column justify-content-center gap-1 me-3 pt-6">
    <!--begin::Title-->
    <h1 class="page-heading d-flex flex-column justify-content-center text-dark fw-bold fs-3 m-0">{{trans('labels.labels.add_new')}}</h1>
    <!--end::Title-->
    <!--begin::Breadcrumb-->
    <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0">
        <!--begin::Item-->
        <li class="breadcrumb-item text-muted">
            <a href="{{route('admin.cities.index')}}" class="text-muted text-hover-primary">{{trans('labels.settings.cities_tap')}}</a>
        </li>
        <!--end::Item-->
        <!--begin::Item-->
        <li class="breadcrumb-item">
            <span class="bullet bg-gray-400 w-5px h-2px"></span>
        </li>
        <!--end::Item-->
        <!--begin::Item-->
        <li class="breadcrumb-item text-muted">{{trans('labels.labels.add_new')}}</li>
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
                <!--begin::Form-->
                <form action="{{route('admin.cities.store')}}" method="POST" enctype="multipart/form-data" id="kt_account_profile_details_form" class="form">
                    @csrf
                    <!--begin::Card body-->
                    <div class="card-body border-top p-9">

                        <div class="row mb-6">
                            <label class="col-lg-2 col-form-label required fw-semibold fs-6">{{trans('labels.inputs.name')}} EN</label>
                            <div class="col-lg-8 fv-row">
                                <input type="text" name="name_en" placeholder="{{trans('labels.inputs.name')}} EN" value="{{old('name_en')}}" class="form-control form-control-lg form-control-solid mb-3 mb-lg-0" />
                            </div>
                        </div>
                        <div class="row mb-6">
                            <label class="col-lg-2 col-form-label required fw-semibold fs-6">{{trans('labels.inputs.name')}} AR</label>
                            <div class="col-lg-8 fv-row">
                                <input type="text" name="name_ar" placeholder="{{trans('labels.inputs.name')}} AR" value="{{old('name_ar')}}" class="form-control form-control-lg form-control-solid mb-3 mb-lg-0" />
                            </div>
                        </div>
                        <div class="row mb-6">
                            <label class="col-lg-2 col-form-label fw-semibold fs-6">
                                <span class="required">{{trans('labels.inputs.country')}}</span>
                            </label>
                            <div class="col-lg-8 fv-row">
                                <select name="country_id" aria-label="{{trans('labels.inputs.select')}} {{trans('labels.inputs.country')}}" data-control="select2" data-placeholder="{{trans('labels.inputs.select')}} {{trans('labels.inputs.country')}}..." class="form-select form-select-solid form-select-lg fw-semibold">
                                    <option value="">{{trans('labels.inputs.select')}}</option>
                                    @foreach($data['countries'] as $country)
                                        <option value="{{$country->id}}">{{$country->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="row mb-0">
                            <label class="col-lg-2 col-form-label fw-semibold fs-6"> {{trans('labels.inputs.status')}}</label>
                            <div class="col-lg-8 d-flex align-items-center">
                                <div class="form-check form-check-solid form-switch form-check-custom fv-row">
                                    <input class="form-check-input w-45px h-30px" type="checkbox" name="status" value="1" id="allowmarketing" checked="checked" />
                                    <label class="form-check-label" for="allowmarketing"></label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card-footer d-flex justify-content-end py-6 px-9">
                        <button type="submit" class="btn btn-primary" id="kt_account_profile_details_submit">{{trans('labels.inputs.save')}}</button>
                    </div>
                    <!--end::Actions-->
                </form>
                <!--end::Form-->
            </div>
            <!--end::Content-->
        </div>
    </div>

@endsection

@section('script')
@endsection
