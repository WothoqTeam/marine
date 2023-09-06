<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Api\Responses\ListBanners;
use App\Http\Controllers\Api\Responses\ListFaqs;
use App\Http\Controllers\Api\Responses\ListNews;
use App\Http\Requests\Api\ContactUsRequest;
use App\Models\ContactUs;
use App\Models\AdvBanners;
use App\Models\Books;
use App\Models\Cities;
use App\Models\Countries;
use App\Models\Courses;
use App\Models\Faqs;
use App\Models\News;
use App\Models\Pages;
use App\Models\Rates;
use App\Models\Reviews;
use App\Models\Setting;
use App\Models\Teachers;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Mail;
use Validator;
class GeneralApiController extends BaseApiController
{
    public function countries(){
        $countries=Countries::select('id','name_'.$this->language.' as name')->where('status',1)->get()->toArray();
        return $this->generateResponse(true,'Success',$countries);
    }

    public function cities(Request $request){
        if ($request->id){
            $cities=Cities::select('id','name_'.$this->language.' as name')->where('status',1)->where('country_id',$request->id)->get()->toArray();
        }else{
            $cities=Cities::select('id','name_'.$this->language.' as name')->where('status',1)->get()->toArray();
        }
        return $this->generateResponse(true,'Success',$cities);
    }

    public function pages(Request $request){
        if ($request->id){
            $pages=Pages::select('id','name_'.$this->language.' as name','content_'.$this->language.' as content')->findorfail($request->id)->toArray();
        }else{
            $pages=Pages::select('id','name_'.$this->language.' as name','content_'.$this->language.' as content')->where('status',1)->get()->toArray();
        }
        return $this->generateResponse(true,'Success',$pages);
    }

    public function banners(){
        $advBanners=AdvBanners::where('status',1)->get();
        $advBanners = $advBanners->map(function (AdvBanners $banner) {
            return new ListBanners($banner, $this->language);
        })->values();
        return $this->generateResponse(true,'Success',$advBanners);
    }

    public function faqs(){
        $faqs=Faqs::where('status',1)->get();
        $faqs = $faqs->map(function (Faqs $faq) {
            return new ListFaqs($faq, $this->language);
        })->values();
        return $this->generateResponse(true,'Success',$faqs);
    }

    public function contactUs(ContactUsRequest $request){
        $details=$request->only('first_name','last_name','email','phone','message');
        ContactUs::create($details);
        $data=[
            'title_en'=>'New Contact Us Message',
            'title_ar'=>'رسالة جديدة للاتصال بنا',
            'body_en'=>'',
            'body_ar'=>'',
        ];
        $this->sendEmployeesNotifications([1],$data);
        return $this->generateResponse(true,'Success');
    }

    public function settings(){
        $setting=Setting::get();
        return $this->generateResponse(true,'Success',$setting);
    }
}
