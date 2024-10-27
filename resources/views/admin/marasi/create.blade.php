@extends('admin.layout.master')

@section('css')
@endsection

@section('style')
    <style>
        .hidden {
            display: none;
        }
    </style>
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
                <a href="{{route('admin.marasi.index')}}"
                   class="text-muted text-hover-primary">{{transAdmin('Marasi')}}</a>
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
                <form action="{{route('admin.marasi.store')}}" method="POST" enctype="multipart/form-data"
                      id="kt_account_profile_details_form" class="form">
                    @csrf
                    <!--begin::Card body-->
                    <div class="card-body border-top p-9">

                        <div class="row mb-6">
                            <label
                                class="col-lg-2 col-form-label fw-semibold fs-6">{{trans('labels.inputs.image')}}</label>
                            <div class="col-lg-8">
                                <div class="image-input image-input-outline" data-kt-image-input="true"
                                     style="background-image: url('assets/media/svg/avatars/blank.svg')">
                                    <div class="image-input-wrapper w-125px h-125px"
                                         style="background-image: url({{asset('dash/assets/media/avatars/blank.png')}})"></div>
                                    <label
                                        class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow"
                                        data-kt-image-input-action="change" data-bs-toggle="tooltip"
                                        title="Change avatar">
                                        <i class="bi bi-pencil-fill fs-7"></i>
                                        <input type="file" name="photo" accept=".png, .jpg, .jpeg"/>
                                        <input type="hidden" name="avatar_remove"/>
                                    </label>
                                    <span
                                        class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow"
                                        data-kt-image-input-action="cancel" data-bs-toggle="tooltip"
                                        title="Cancel avatar">
                                        <i class="bi bi-x fs-2"></i>
                                    </span>
                                    <span
                                        class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow"
                                        data-kt-image-input-action="remove" data-bs-toggle="tooltip"
                                        title="Remove avatar">
                                        <i class="bi bi-x fs-2"></i>
                                    </span>
                                </div>

                                <div class="form-text">Allowed file types: png, jpg, jpeg.</div>
                            </div>
                        </div>
                        @if (Auth::guard('admin')->user()->role_id == 1)
                            <div class="row mb-6">
                                <label class="col-lg-2 col-form-label fw-semibold fs-6">
                                    <span class="required">{{transAdmin('Owner')}}</span>
                                </label>
                                <div class="col-lg-8 fv-row">
                                    <select name="employee_id"
                                            aria-label="{{trans('labels.inputs.select')}} {{transAdmin('Owner')}}"
                                            data-control="select2"
                                            data-placeholder="{{trans('labels.inputs.select')}} {{transAdmin('Owner')}}..."
                                            class="form-select form-select-solid form-select-lg fw-semibold">
                                        <option value="">{{trans('labels.inputs.select')}}</option>
                                        @foreach($data['owner'] as $owner)
                                            <option value="{{$owner->id}}">{{$owner->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        @else
                            <input type="hidden" name="employee_id" value="{{Auth::guard('admin')->user()->id}}">
                        @endif
                        <div class="row mb-6">
                            <label
                                class="col-lg-2 col-form-label required fw-semibold fs-6">{{trans('labels.inputs.name')}}
                                EN</label>
                            <div class="col-lg-8 fv-row">
                                <input type="text" name="name_en" placeholder="{{trans('labels.inputs.name')}} EN"
                                       value="{{old('name_en')}}"
                                       class="form-control form-control-lg form-control-solid mb-3 mb-lg-0"/>
                            </div>
                        </div>
                        <div class="row mb-6">
                            <label
                                class="col-lg-2 col-form-label required fw-semibold fs-6">{{trans('labels.inputs.name')}}
                                AR</label>
                            <div class="col-lg-8 fv-row">
                                <input type="text" name="name_ar" placeholder="{{trans('labels.inputs.name')}} AR"
                                       value="{{old('name_ar')}}"
                                       class="form-control form-control-lg form-control-solid mb-3 mb-lg-0"/>
                            </div>
                        </div>

                        <div class="row mb-6">
                            <label class="col-lg-2 col-form-label fw-semibold fs-6">
                                <span class="required">{{trans('labels.inputs.country')}}</span>
                            </label>
                            <div class="col-lg-8 fv-row">
                                <select name="country_id"
                                        aria-label="{{trans('labels.inputs.select')}} {{trans('labels.inputs.country')}}"
                                        data-control="select2"
                                        data-placeholder="{{trans('labels.inputs.select')}} {{trans('labels.inputs.country')}}..."
                                        class="form-select form-select-solid form-select-lg fw-semibold">
                                    <option value="">{{trans('labels.inputs.select')}}</option>
                                    @foreach($data['countries'] as $country)
                                        <option value="{{$country->id}}">{{$country->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="row mb-6">
                            <label class="col-lg-2 col-form-label fw-semibold fs-6">
                                <span class="required">{{trans('labels.inputs.city')}}</span>
                            </label>
                            <div class="col-lg-8 fv-row">
                                <select name="city_id"
                                        aria-label="{{trans('labels.inputs.select')}} {{trans('labels.inputs.country')}}"
                                        data-control="select2"
                                        data-placeholder="{{trans('labels.inputs.select')}} {{trans('labels.inputs.country')}}..."
                                        class="form-select form-select-solid form-select-lg fw-semibold">
                                    <option value="">{{trans('labels.inputs.select')}}</option>
                                    @foreach($data['cities'] as $city)
                                        <option value="{{$city->id}}">{{$city->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="row mb-6">
                            <label
                                class="col-lg-2 col-form-label required fw-semibold fs-6">{{trans('labels.inputs.description')}}
                                EN</label>
                            <div class="col-lg-8 fv-row">
                                <textarea name="description_en" placeholder="{{trans('labels.inputs.description')}} EN"
                                          class="form-control form-control-lg form-control-solid mb-3 mb-lg-0">{{old('description_en')}}</textarea>
                            </div>
                        </div>
                        <div class="row mb-6">
                            <label
                                class="col-lg-2 col-form-label required fw-semibold fs-6">{{trans('labels.inputs.description')}}
                                AR</label>
                            <div class="col-lg-8 fv-row">
                                <textarea name="description_ar" placeholder="{{trans('labels.inputs.description')}} AR"
                                          class="form-control form-control-lg form-control-solid mb-3 mb-lg-0">{{old('description_ar')}}</textarea>
                            </div>
                        </div>

                        <div class="row mb-6">
                            <label
                                class="col-lg-2 col-form-label required fw-semibold fs-6">{{trans('labels.inputs.address')}}
                                EN</label>
                            <div class="col-lg-8 fv-row">
                                <textarea name="address_en" placeholder="{{trans('labels.inputs.address')}} EN"
                                          class="form-control form-control-lg form-control-solid mb-3 mb-lg-0">{{old('address_en')}}</textarea>
                            </div>
                        </div>
                        <div class="row mb-6">
                            <label
                                class="col-lg-2 col-form-label required fw-semibold fs-6">{{trans('labels.inputs.address')}}
                                AR</label>
                            <div class="col-lg-8 fv-row">
                                <textarea name="address_ar" placeholder="{{trans('labels.inputs.address')}} AR"
                                          class="form-control form-control-lg form-control-solid mb-3 mb-lg-0">{{old('address_ar')}}</textarea>
                            </div>
                        </div>
                        <div class="row mb-6">
                            <label class="col-lg-2 col-form-label fw-semibold fs-6">
                                <span class="required">{{transAdmin('marasiServices')}}</span>
                            </label>
                            <div class="col-lg-8 fv-row">
                                <select name="services[]"
                                        aria-label="{{transAdmin('marasiServices')}}"
                                        data-control="select2"
                                        data-placeholder="{{transAdmin('marasiServices')}}..."
                                        class="form-select form-select-solid form-select-lg fw-semibold" multiple>
                                    <option value="">{{trans('labels.inputs.select')}}</option>
                                    @foreach($data['services'] as $services)
                                        <option value="{{$services->id}}">{{$services->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="row mb-6">
                            <label
                                class="col-lg-2 col-form-label required fw-semibold fs-6">{{trans('labels.inputs.metrePrice')}}</label>
                            <div class="col-lg-8 fv-row">
                                <input type="number" step=0.01 name="price"
                                       placeholder="{{trans('labels.inputs.metrePrice')}}" value="{{old('price')}}"
                                       class="form-control form-control-lg form-control-solid mb-3 mb-lg-0"/>
                            </div>
                        </div>

                        <div class="row mb-0">
                            <label
                                class="col-lg-2 col-form-label fw-semibold fs-6"> {{transAdmin('Is Discount ?')}}</label>
                            <div class="col-lg-8 d-flex align-items-center">
                                <div class="form-check form-check-solid form-switch form-check-custom fv-row">
                                    <input class="form-check-input w-45px h-30px" type="checkbox" name="is_discount"
                                           id="myCheckbox" onchange="toggleInput('myCheckbox','myInput')"/>
                                    <label class="form-check-label" for="myCheckbox"></label>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-6 hidden" id="myInput">
                            <label
                                class="col-lg-2 col-form-label required fw-semibold fs-6">{{trans('labels.inputs.discount')}}</label>
                            <div class="col-lg-8 fv-row">
                                <input type="text" name="discount" placeholder="{{trans('labels.inputs.discount')}}"
                                       value="{{old('discount')}}"
                                       class="form-control form-control-lg form-control-solid mb-3 mb-lg-0"/>
                            </div>
                        </div>

                        <div class="fv-row mb-6">
                            <div id="map" style="height: 300px;"></div>
                        </div>
                        <input type="hidden" name="latitude" id="lat" placeholder="LAT" value="{{old('latitude')}}"
                               class="form-control form-control-lg form-control-solid mb-3 mb-lg-0"/>
                        <input type="hidden" name="longitude" id="lng" placeholder="LNG" value="{{old('longitude')}}"
                               class="form-control form-control-lg form-control-solid mb-3 mb-lg-0"/>

                        <div class="row mb-6">
                            <label
                                class="col-lg-2 col-form-label required fw-semibold fs-6">{{transAdmin('Cover Images')}}</label>
                            <div class="col-lg-8 fv-row">
                                <input type="file" name="covers[]" placeholder="{{transAdmin('Cover Images')}}"
                                       accept=".png, .jpg, .jpeg"
                                       class="form-control form-control-lg form-control-solid mb-3 mb-lg-0"
                                       multiple="multiple"/>
                            </div>
                        </div>

                        <div class="row mb-0">
                            <label
                                class="col-lg-2 col-form-label fw-semibold fs-6"> {{trans('labels.inputs.status')}}</label>
                            <div class="col-lg-8 d-flex align-items-center">
                                <div class="form-check form-check-solid form-switch form-check-custom fv-row">
                                    <input class="form-check-input w-45px h-30px" type="checkbox" name="status"
                                           value="1" id="allowmarketing" checked="checked"/>
                                    <label class="form-check-label" for="allowmarketing"></label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card-footer d-flex justify-content-end py-6 px-9">
                        <button type="submit" class="btn btn-primary"
                                id="kt_account_profile_details_submit">{{trans('labels.inputs.save')}}</button>
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
        function toggleInput($x, $y) {
            var checkbox = document.getElementById($x);
            var divElement = document.getElementById($y);

            if (checkbox.checked) {
                divElement.classList.remove("hidden");
            } else {
                divElement.classList.add("hidden");
            }
        }
    </script>
    <script
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAsoJSU4k6RgH8tO2gM1WLZBjOFwUF4TcY&callback=initMap&v=weekly&language=ar"
        defer
    ></script>
    <script>
        function initMap() {
            const myLatlng = {lat: 26.0879164, lng: 43.9878523};
            const map = new google.maps.Map(document.getElementById("map"), {
                zoom: 13.3,
                center: myLatlng,
            });
            // Create the initial InfoWindow.
            let infoWindow = new google.maps.InfoWindow({
                content: "حدد المكان على الخريطة",
                position: myLatlng,
            });

            infoWindow.open(map);
            // Configure the click listener.
            map.addListener("click", (mapsMouseEvent) => {
                // Close the current InfoWindow.
                infoWindow.close();
                // Create a new InfoWindow.
                infoWindow = new google.maps.InfoWindow({
                    position: mapsMouseEvent.latLng,
                });
                infoWindow.setContent(
                    // JSON.stringify(mapsMouseEvent.latLng.toJSON(), null, 2),
                    JSON.stringify('تم تحديد الموقع', null, 2),
                );
                $('#lat').val(mapsMouseEvent.latLng.toJSON().lat);
                $('#lng').val(mapsMouseEvent.latLng.toJSON().lng);
                infoWindow.open(map);
            });
        }

        window.initMap = initMap;
    </script>
@endsection
