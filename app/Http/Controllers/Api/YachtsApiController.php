<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Api\Responses\ListYachts;
use App\Http\Requests\Api\Yachts\StoreYachtsRequest;
use App\Http\Requests\Api\Yachts\UpdateYachtsRequest;
use App\Http\Requests\Api\Yachts\UpdateYachtsStatusRequest;
use App\Models\Yachts;
use App\Models\YachtsSpecifications;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class YachtsApiController extends BaseApiController
{
    public function list(Request $request){
        $yachts = Yachts::with('city','country','provider','specifications')->orderBy('id','DESC')->where('status',true);
        //Filter By Provider ID
        if (!empty($request->provider_id)){ $yachts->where('provider_id',$request->provider_id); }
        //Filter By Service Type
        if (!empty($request->service_type)){ $yachts->where('service_type',$request->service_type); }
        //Filter By Name
        if (!empty($request->name)){ $yachts->where('name_en','LIKE', '%'.$request->name.'%')->orwhere('name_ar','LIKE', '%'.$request->name.'%'); }
        //Filter By limit
        if (!empty($request->limit)){ $yachts->limit($request->limit); }
        //Filter By sort
        if ($request->sort_by=='desc'){ $yachts ->orderBy('id', 'DESC');}
        elseif ($request->sort_by=='top'){}
        $yachts=$yachts->get();
        $yachts = $yachts->map(function (Yachts $yacht) {
            return new ListYachts($yacht,$this->language,$this->user);
        })->values();
        return $this->generateResponse(true,'Success',$yachts);
    }

    public function details($id){
        $yacht = Yachts::with('city','country','provider','specifications')->where('provider_id',$this->user->id)->findOrFail($id);
        return $this->generateResponse(true,'Success',$yacht);
    }

    public function providerYachts(Request $request){
        $yachts = Yachts::with('city','country','provider','specifications')->where('provider_id',$this->user->id)->orderBy('id','DESC');
        //Filter By Name
        if (!empty($request->name)){ $yachts->where('name_en','LIKE', '%'.$request->name.'%')->orwhere('name_ar','LIKE', '%'.$request->name.'%'); }
        //Filter By limit
        if (!empty($request->limit)){ $yachts->limit($request->limit); }
        //Filter By sort
        if ($request->sort_by=='desc'){ $yachts ->orderBy('id', 'DESC');}
        $yachts=$yachts->get();
        $yachts = $yachts->map(function (Yachts $yacht) {
            return new ListYachts($yacht,$this->language);
        })->values();
        return $this->generateResponse(true,'Success',$yachts);
    }
    public function store(StoreYachtsRequest $request){
        $inputs=$request->only([
            'name_en', 'name_ar', 'description_en', 'description_ar', 'add_info_en', 'add_info_ar',
            'booking_info_en', 'booking_info_ar', 'address_en', 'address_ar', 'price', 'is_discount',
            'discount_value', 'city_id', 'country_id', 'longitude', 'latitude','num_guests',
            'owner_name','id_num','license_num','captain_name','captain_id_num','captain_license_num','service_type'
        ]);
        $inputs['provider_id']=$this->user->id;
        $yacht=Yachts::create($inputs);
        if (is_array($request->images) && count($request->images)>0){
            foreach ($request->images as $image){
                if($image->isFile() && $image->isValid()){
                    $yacht->addMedia($image)->toMediaCollection('cover');
                }
            }
        }
        if($request->hasFile('captain_image') && $request->file('captain_image')->isValid()){
            $yacht->addMedia($request->file('captain_image'))->toMediaCollection('captain_image');
        }
        if (is_array($request->specifications) && count($request->specifications)>0){
            foreach ($request->specifications as $specification){
                if ($specification){
                    YachtsSpecifications::create([
                        'specification_id'=>$specification,
                        'yacht_id'=>$yacht->id,
                    ]);
                }
            }
        }
        return $this->generateResponse(true,'Success');
    }

    public function update($id,UpdateYachtsRequest $request){
        $yacht=Yachts::where('provider_id',$this->user->id)->find($id);
        if($yacht){
            $inputs=$request->only([
                'name_en', 'name_ar', 'description_en', 'description_ar', 'add_info_en', 'add_info_ar',
                'booking_info_en', 'booking_info_ar', 'address_en', 'address_ar', 'price', 'is_discount',
                'discount_value', 'city_id', 'country_id', 'longitude', 'latitude','num_guests',
                'owner_name','id_num','license_num','captain_name','captain_id_num','captain_license_num','service_type'
            ]);
            $yacht->update($inputs);
            if (is_array($request->images) && count($request->images)>0){
                foreach ($request->images as $image){
                    if($image->isFile() && $image->isValid()){
                        $yacht->addMedia($image)->toMediaCollection('cover');
                    }
                }
            }
            if($request->hasFile('captain_image') && $request->file('captain_image')->isValid()){
                Media::where('model_type',Yachts::class)->where('model_id',$id)->where('collection_name','captain_image')->delete();
                $yacht->addMediaFromRequest('captain_image')->toMediaCollection('captain_image');
            }
            return $this->generateResponse(true,'Success');
         }else{
            return $this->generateResponse(false,"User Cannot Take This Action",[],410);
        }
    }

    public function updateStatus($id,UpdateYachtsStatusRequest $request){
        $yacht=Yachts::where('provider_id',$this->user->id)->find($id);
        if($yacht){
            $inputs=$request->only(['status']);
            $yacht->update($inputs);
            return $this->generateResponse(true,'Success');
        }else{
            return $this->generateResponse(false,"User Cannot Take This Action",[],410);
        }
    }
}
