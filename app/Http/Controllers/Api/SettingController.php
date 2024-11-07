<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\SettingResource;
use App\Models\RelatedNewsSite;
use App\Models\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function getSettings()
    {
        $setting = Setting::first();
        $relatd_site = $this->relatedSites();

        if(!$setting){
            return apiResponse(404 , 'Setting is empty');
        }

        $data = [
            'relatd_site' => $this->relatedSites(),
            'setting' => new SettingResource($setting)
        ];
        return apiResponse(200 , 'This is site Setting' , $data);
    }
    public function relatedSites()
    {
        $relatd_site = RelatedNewsSite::select('name' , 'url')->get();
        if(!$relatd_site){
            return apiResponse(404 , 'There are not related sites');
        }
        return $relatd_site;
    }
}
