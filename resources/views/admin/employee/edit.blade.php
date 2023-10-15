@extends('admin.layout.master')

@section('css')
@endsection

@section('style')

@endsection

@section('breadcrumb')
<div class="d-flex align-items-center" id="kt_header_nav">
    <!--begin::Page title-->
    <div data-kt-swapper="true" data-kt-swapper-mode="prepend" data-kt-swapper-parent="{default: '#kt_content_container', 'lg': '#kt_header_nav'}" class="page-title d-flex align-items-center flex-wrap me-3 mb-5 mb-lg-0">
        <a  href="{{url('/admin')}}">
            <h1 class="d-flex align-items-center text-dark fw-bolder fs-3 my-1">
                {{transAdmin('Dashboard')}}
            </h1>
        </a>
        <span class="h-20px border-gray-300 border-start mx-4"></span>
        <ul class="breadcrumb breadcrumb-separatorless fw-bold fs-7 my-1">
            <li class="breadcrumb-item text-muted px-2">
                <a  href="{{route('admin.employees.index')}}" class="text-muted text-hover-primary">{{transAdmin('Employees')}}</a>
            </li>
            <li class="breadcrumb-item">
                <span class="bullet bg-gray-300 w-5px h-2px"></span>
            </li>
            <li class="breadcrumb-item text-muted px-2">
                {{trans('labels.labels.edit')}}
            </li>
        </ul>
    </div>
    <!--end::Page title-->
</div>
@endsection

@section('content')

    <div id="kt_app_content_container" class="app-container container-fluid">
        <div class="card mb-5 mb-xl-10">
            <!--begin::Content-->
            <div id="kt_account_settings_profile_details" class="collapse show">
                <!--begin::Form-->
                <form action="{{route('admin.employees.update')}}" method="POST" enctype="multipart/form-data" id="kt_account_profile_details_form" class="form">
                    @csrf
                    <input type="hidden" name="id" value="{{$data->id}}" />
                    <!--begin::Card body-->
                    <div class="card-body border-top p-9">

                        <div class="row mb-6">
                            <label class="col-lg-2 col-form-label fw-semibold fs-6">صورة الموظف</label>
                            <div class="col-lg-8">
                                <div class="image-input image-input-outline" data-kt-image-input="true" style="background-image: url('assets/media/svg/avatars/blank.svg')">
                                    @if ($data->getMedia('profile')->count())
                                    <div class="image-input-wrapper w-125px h-125px" style="background-image: url({{$data->getFirstMediaUrl('profile', 'thumb')}})"></div>
                                    @else
                                    <div class="image-input-wrapper w-125px h-125px" style="background-image: url({{asset('dash/assets/media/avatars/blank.png')}})"></div>
                                    @endif
                                    <label class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="change" data-bs-toggle="tooltip" title="Change avatar">
                                        <i class="bi bi-pencil-fill fs-7"></i>
                                        <input type="file" name="photo" accept=".png, .jpg, .jpeg" />
                                        <input type="hidden" name="avatar_remove" />
                                    </label>
                                    <span class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="cancel" data-bs-toggle="tooltip" title="Cancel avatar">
                                        <i class="bi bi-x fs-2"></i>
                                    </span>
                                    <span class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="remove" data-bs-toggle="tooltip" title="Remove avatar">
                                        <i class="bi bi-x fs-2"></i>
                                    </span>
                                </div>

                                <div class="form-text">Allowed file types: png, jpg, jpeg.</div>
                            </div>
                        </div>

                        <div class="row mb-6">
                            <label class="col-lg-2 col-form-label required fw-semibold fs-6">{{trans('labels.inputs.name')}}</label>
                            <div class="col-lg-8 fv-row">
                                <input type="text" name="name_ar" placeholder="First name" value="{{$data->name_ar}}" class="form-control form-control-lg form-control-solid mb-3 mb-lg-0" />
                            </div>
                        </div>
                        <div class="row mb-6">
                            <label class="col-lg-2 col-form-label required fw-semibold fs-6"> {{trans('labels.inputs.email')}}</label>
                            <div class="col-lg-8 fv-row">
                                <input type="text" name="email" placeholder="{{trans('labels.inputs.email')}}" value="{{$data->email}}" class="form-control form-control-lg form-control-solid" />
                            </div>
                        </div>
                        <div class="row mb-6">
                            <label class="col-lg-2 col-form-label fw-semibold fs-6">
                                <span class="required">{{trans('labels.inputs.phone')}}</span>
                            </label>
                            <div class="col-lg-8 fv-row">
                                <input type="tel" name="phone" placeholder="{{trans('labels.inputs.phone')}}" value="{{$data->phone}}" class="form-control form-control-lg form-control-solid" />
                            </div>
                        </div>
                        <div class="row mb-6">
                            <label class="col-lg-2 col-form-label fw-semibold fs-6">
                                {{trans('labels.inputs.password')}}
                                <i class="fas fa-exclamation-circle ms-1 fs-7" data-bs-toggle="tooltip" title="Min 6 characters"></i>
                            </label>
                            <div class="col-lg-8 fv-row">
                                <input type="password" name="password" placeholder="{{trans('labels.inputs.password')}}" value="" class="form-control form-control-lg form-control-solid" />
                            </div>
                        </div>
                        <div class="row mb-0">
                            <label class="col-lg-2 col-form-label fw-semibold fs-6"> is_active</label>
                            <div class="col-lg-8 d-flex align-items-center">
                                <div class="form-check form-check-solid form-switch form-check-custom fv-row">
                                    <input class="form-check-input w-45px h-30px" type="checkbox" name="is_active" value="1" id="allowmarketing" @if($data->is_active == 1) checked="checked" @endif />
                                    <label class="form-check-label" for="allowmarketing"></label>
                                </div>
                            </div>
                        </div>
                        @if($data->id!=1)
                            <hr>
                            <div class="row mb-6">
                                <h1><center><u>{{ucwords(transAdmin('permissions',[],'permissions'))}}</u></center></h1>
                            </div>
                            @foreach($permissions_arr as $key=>$values)
                                <div class="row mb-6">
                                    <h3>{{ucwords(transAdmin($key,[],'permissions'))}}</h3>
                                    <div class="col-2">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="{{$key}}.all" onchange="handlePermissionChange('{{$key}}')">
                                            <label for="{{$key}}.all">
                                                {{ucwords(transAdmin('all',[],'permissions'))}}
                                            </label>
                                        </div>
                                    </div>
                                    @php $i=0; @endphp
                                    @foreach($values as $value)
                                        <div class="col-2">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="permissions[]" value="{{$key}}.{{$value['name']}}" id="{{$key}}.{{$value['name']}}" @if($value['checked']) checked @endif>
                                                <label for="{{$key}}.{{$value['name']}}">
                                                    {{ucwords(transAdmin($value['name'],[],'permissions'))}}
                                                </label>
                                            </div>
                                        </div>
                                        @php if($value['checked']){ $i++; }  @endphp
                                    @endforeach
                                    @if(count($values) == $i) <script>document.getElementById('{{$key}}.all').checked = true</script> @endif
                                </div>
                                <hr>
                            @endforeach
                        @endif
                    </div>

                    <div class="card-footer d-flex justify-content-end py-6 px-9">
                        <button type="submit" class="btn btn-primary" id="kt_account_profile_details_submit">Save</button>
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
    <script>
        function handlePermissionChange(model) {
            var allCheckbox = document.getElementById(model+'.all');
            var createCheckbox = document.getElementById(model+'.index');
            var readCheckbox = document.getElementById(model+'.create');
            var updateCheckbox = document.getElementById(model+'.update');
            var deleteCheckbox = document.getElementById(model+'.delete');

            if (allCheckbox.checked) {
                createCheckbox?createCheckbox.checked = true:'';
                readCheckbox?readCheckbox.checked = true:'';
                updateCheckbox?updateCheckbox.checked = true:'';
                deleteCheckbox?deleteCheckbox.checked = true:'';
            } else {
                createCheckbox?createCheckbox.checked = false:'';
                readCheckbox?readCheckbox.checked = false:'';
                updateCheckbox?updateCheckbox.checked = false:'';
                deleteCheckbox?deleteCheckbox.checked = false:'';
            }
        }
    </script>
@endsection
