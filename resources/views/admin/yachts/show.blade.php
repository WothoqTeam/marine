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
                <a href="{{route('admin.yachts.index')}}"
                   class="text-muted text-hover-primary">{{transAdmin('Yachts')}}</a>
            </li>
            <!--end::Item-->
            <!--begin::Item-->
            <li class="breadcrumb-item">
                <span class="bullet bg-gray-400 w-5px h-2px"></span>
            </li>
            <!--end::Item-->
            <!--begin::Item-->
            <li class="breadcrumb-item text-muted">{{trans('labels.labels.profile')}}</li>
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
                    <div class="col-xl-3">
                        <div class="symbol symbol-100px">
                            @if ($data->getMedia('cover')->count())
                                @foreach($data->getMedia('cover') as $image)
                                    <img src="{{$image->getFullUrl()}}">
                                @endforeach
                            @else
                                <img src="assets/media/svg/avatars/blank.svg">
                            @endif
                        </div>
                    </div>
                    <div class="col-lg-8">

                    </div>
                </div>
                <div class="row mb-8">
                    <div class="col-xl-2">
                        <div class="fs-6 fw-semibold">{{transAdmin('Provider Name')}}</div>
                    </div>
                    <div class="col-lg-9">
                        <div class="fw-bold fs-5"><a
                                href="{{route('admin.providers.show',$data->provider->id)}}">{{$data->provider->name}}</a>
                        </div>
                    </div>
                </div>

                <div class="row mb-8">
                    <div class="col-xl-2">
                        <div class="fs-6 fw-semibold">{{trans('labels.labels.type')}}</div>
                    </div>
                    <div class="col-lg-9">
                        <div class="fw-bold fs-5">{{trans('labels.labels.'.$data->service_type)}}</div>
                    </div>
                </div>

                <div class="row mb-8">
                    <div class="col-xl-2">
                        <div class="fs-6 fw-semibold">{{trans('labels.inputs.name')}} ( AR )</div>
                    </div>
                    <div class="col-lg-9">
                        <div class="fw-bold fs-5">{{$data->name_ar}}</div>
                    </div>
                </div>

                <div class="row mb-8">
                    <div class="col-xl-2">
                        <div class="fs-6 fw-semibold">{{trans('labels.inputs.name')}} ( En )</div>
                    </div>
                    <div class="col-lg-9">
                        <div class="fw-bold fs-5">{{$data->name_en}}</div>
                    </div>
                </div>

                <div class="row mb-8">
                    <div class="col-xl-2">
                        <div class="fs-6 fw-semibold">{{trans('labels.inputs.description')}} ( AR )</div>
                    </div>
                    <div class="col-lg-9">
                        <div class="fw-bold fs-5">{{$data->description_ar}}</div>
                    </div>
                </div>

                <div class="row mb-8">
                    <div class="col-xl-2">
                        <div class="fs-6 fw-semibold">{{trans('labels.inputs.description')}} ( En )</div>
                    </div>
                    <div class="col-lg-9">
                        <div class="fw-bold fs-5">{{$data->description_en}}</div>
                    </div>
                </div>

                <div class="row mb-8">
                    <div class="col-xl-2">
                        <div class="fs-6 fw-semibold">{{trans('labels.inputs.add_info')}} ( AR )</div>
                    </div>
                    <div class="col-lg-9">
                        <div class="fw-bold fs-5">{{$data->add_info_ar}}</div>
                    </div>
                </div>

                <div class="row mb-8">
                    <div class="col-xl-2">
                        <div class="fs-6 fw-semibold">{{trans('labels.inputs.add_info')}} ( En )</div>
                    </div>
                    <div class="col-lg-9">
                        <div class="fw-bold fs-5">{{$data->add_info_en}}</div>
                    </div>
                </div>

                <div class="row mb-8">
                    <div class="col-xl-2">
                        <div class="fs-6 fw-semibold">{{trans('labels.inputs.booking_info')}} ( AR )</div>
                    </div>
                    <div class="col-lg-9">
                        <div class="fw-bold fs-5">{{$data->booking_info_ar}}</div>
                    </div>
                </div>

                <div class="row mb-8">
                    <div class="col-xl-2">
                        <div class="fs-6 fw-semibold">{{trans('labels.inputs.booking_info')}} ( En )</div>
                    </div>
                    <div class="col-lg-9">
                        <div class="fw-bold fs-5">{{$data->booking_info_en}}</div>
                    </div>
                </div>

                <div class="row mb-8">
                    <div class="col-xl-2">
                        <div class="fs-6 fw-semibold">{{trans('labels.inputs.address')}} ( AR )</div>
                    </div>
                    <div class="col-lg-9">
                        <div class="fw-bold fs-5">{{$data->address_ar}}</div>
                    </div>
                </div>

                <div class="row mb-8">
                    <div class="col-xl-2">
                        <div class="fs-6 fw-semibold">{{trans('labels.inputs.address')}} ( En )</div>
                    </div>
                    <div class="col-lg-9">
                        <div class="fw-bold fs-5">{{$data->address_en}}</div>
                    </div>
                </div>

                <div class="row mb-8">
                    <div class="col-xl-2">
                        <div class="fs-6 fw-semibold">{{trans('labels.inputs.price')}}</div>
                    </div>
                    <div class="col-lg-9">
                        <div class="fw-bold fs-5">{{$data->price}}</div>
                    </div>
                </div>

                <div class="row mb-8">
                    <div class="col-xl-2">
                        <div class="fs-6 fw-semibold">{{trans('labels.inputs.discount')}}</div>
                    </div>
                    <div class="col-lg-9">
                        <div class="fw-bold fs-5">{{$data->discount_value}}</div>
                    </div>
                </div>
                @php
                    if (\Illuminate\Support\Facades\App::getLocale()=='en'){
                        $name_lang='name_en';
                    }else{
                        $name_lang='name_ar';
                    }
                @endphp
                <div class="row mb-8">
                    <div class="col-xl-2">
                        <div class="fs-6 fw-semibold">{{trans('labels.inputs.country')}}</div>
                    </div>
                    <div class="col-lg-9">
                        <div class="fw-bold fs-5">{{$data->country?$data->country->$name_lang:''}}</div>
                    </div>
                </div>
                <div class="row mb-8">
                    <div class="col-xl-2">
                        <div class="fs-6 fw-semibold">{{trans('labels.inputs.city')}}</div>
                    </div>
                    <div class="col-lg-9">
                        <div class="fw-bold fs-5">{{$data->city?$data->city->$name_lang:''}}</div>
                    </div>
                </div>

                <div class="row mb-8">
                    <div class="col-xl-2">
                        <div class="fs-6 fw-semibold">{{trans('labels.inputs.longitude')}}</div>
                    </div>
                    <div class="col-lg-9">
                        <div class="fw-bold fs-5">{{$data->longitude}}</div>
                    </div>
                </div>

                <div class="row mb-8">
                    <div class="col-xl-2">
                        <div class="fs-6 fw-semibold">{{trans('labels.inputs.latitude')}}</div>
                    </div>
                    <div class="col-lg-9">
                        <div class="fw-bold fs-5">{{$data->latitude}}</div>
                    </div>
                </div>

                <div class="row mb-8">
                    <div class="col-xl-2">
                        <div class="fs-6 fw-semibold">{{trans('labels.inputs.num_guests')}}</div>
                    </div>
                    <div class="col-lg-9">
                        <div class="fw-bold fs-5">{{$data->num_guests}}</div>
                    </div>
                </div>

                <div class="row mb-8">
                    <div class="col-xl-2">
                        <div class="fs-6 fw-semibold">{{trans('labels.inputs.owner_name')}}</div>
                    </div>
                    <div class="col-lg-9">
                        <div class="fw-bold fs-5">{{$data->owner_name}}</div>
                    </div>
                </div>

                <div class="row mb-8">
                    <div class="col-xl-2">
                        <div class="fs-6 fw-semibold">{{trans('labels.inputs.id_num')}}</div>
                    </div>
                    <div class="col-lg-9">
                        <div class="fw-bold fs-5">{{$data->id_num}}</div>
                    </div>
                </div>

                <div class="row mb-8">
                    <div class="col-xl-2">
                        <div class="fs-6 fw-semibold">{{trans('labels.inputs.license_num')}}</div>
                    </div>
                    <div class="col-lg-9">
                        <div class="fw-bold fs-5">{{$data->license_num}}</div>
                    </div>
                </div>

                <div class="row mb-8">
                    <div class="col-xl-2">
                        <div class="fs-6 fw-semibold">{{trans('labels.inputs.captain_name')}}</div>
                    </div>
                    <div class="col-lg-9">
                        <div class="fw-bold fs-5">{{$data->captain_name}}</div>
                    </div>
                </div>

                <div class="row mb-8">
                    <div class="col-xl-2">
                        <div class="fs-6 fw-semibold">{{trans('labels.inputs.captain_id_num')}}</div>
                    </div>
                    <div class="col-lg-9">
                        <div class="fw-bold fs-5">{{$data->captain_id_num}}</div>
                    </div>
                </div>

                <div class="row mb-8">
                    <div class="col-xl-2">
                        <div class="fs-6 fw-semibold">{{trans('labels.inputs.captain_license_num')}}</div>
                    </div>
                    <div class="col-lg-9">
                        <div class="fw-bold fs-5">{{$data->captain_license_num}}</div>
                    </div>
                </div>

                <div class="row mb-8">
                    <div class="col-xl-2">
                        <div class="fs-6 fw-semibold">{{trans('labels.labels.specifications')}}</div>
                    </div>
                    <div class="col-lg-9">
                        <div class="fw-bold fs-5">
                            <ul>
                                @foreach($data->specifications as $specification)
                                    <li>{{$specification->$name_lang}}</li>
                                @endforeach
                            </ul>
                        </div>
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

        </div>
    </div>

@endsection

@section('script')
@endsection
