@extends('admin.layout.master')

@section('css')
@endsection

@section('style')

@endsection

@section('breadcrumb')
<div class="page-title d-flex flex-column justify-content-center gap-1 me-3 pt-6">
    <!--begin::Title-->
    <h1 class="page-heading d-flex flex-column justify-content-center text-dark fw-bold fs-3 m-0">{{trans('labels.notifications_tap')}}</h1>
    <!--end::Title-->
</div>
@endsection

@section('content')

    <div id="kt_app_content_container" class="app-container container-fluid">
        <div class="card mb-5 mb-xl-10">
            <!--begin::Content-->
            <div id="kt_account_settings_profile_details" class="collapse show">
                <!--begin::Form-->
                <form action="{{route('admin.notifications.store')}}" method="POST" enctype="multipart/form-data" id="kt_account_profile_details_form" class="form">
                    @csrf
                    <!--begin::Card body-->
                    <div class="card-body border-top p-9">

                        <div class="row mb-6">
                            <label class="col-lg-2 col-form-label required fw-semibold fs-6">{{trans('labels.inputs.title')}} EN</label>
                            <div class="col-lg-8 fv-row">
                                <input type="text" name="title_en" placeholder="{{trans('labels.inputs.title')}} EN" value="{{old('title_en')}}" class="form-control form-control-lg form-control-solid mb-3 mb-lg-0" />
                            </div>
                        </div>
                        <div class="row mb-6">
                            <label class="col-lg-2 col-form-label required fw-semibold fs-6">{{trans('labels.inputs.title')}} AR</label>
                            <div class="col-lg-8 fv-row">
                                <input type="text" name="title_ar" placeholder="{{trans('labels.inputs.title')}} AR" value="{{old('title_ar')}}" class="form-control form-control-lg form-control-solid mb-3 mb-lg-0" />
                            </div>
                        </div>
                        <div class="row mb-6">
                            <label class="col-lg-2 col-form-label required fw-semibold fs-6">{{trans('labels.inputs.body')}} EN</label>
                            <div class="col-lg-8 fv-row">
                                <textarea name="body_en" placeholder="{{trans('labels.inputs.body')}} EN" class="form-control form-control-lg form-control-solid mb-3 mb-lg-0" >{{old('body_en')}}</textarea>
                            </div>
                        </div>
                        <div class="row mb-6">
                            <label class="col-lg-2 col-form-label required fw-semibold fs-6">{{trans('labels.inputs.body')}} AR</label>
                            <div class="col-lg-8 fv-row">
                                <textarea name="body_ar" placeholder="{{trans('labels.inputs.body')}} AR" class="form-control form-control-lg form-control-solid mb-3 mb-lg-0" >{{old('body_ar')}}</textarea>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-6">
                        <label class="col-lg-2 col-form-label fw-semibold fs-6">
                            <span class="required">{{trans('users.users')}}</span>
                        </label>
                        <div class="col-lg-8 fv-row">
                            <select name="user_id" aria-label="{{trans('labels.inputs.select')}} {{trans('users.user')}}" data-control="select2" data-placeholder="{{trans('labels.inputs.select')}} {{trans('users.user')}}..." class="form-select form-select-solid form-select-lg fw-semibold">
                                <option value="0">{{trans('labels.labels.all')}}</option>
                                @foreach($data['users'] as $user)
                                    <option value="{{$user->id}}">{{$user->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="card-footer d-flex justify-content-end py-6 px-9">
                        <button type="submit" class="btn btn-primary" id="kt_account_profile_details_submit">{{trans('labels.inputs.send')}}</button>
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
