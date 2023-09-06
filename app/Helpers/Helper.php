<?php
namespace App\Helpers;

use App\Models\Setting;
use \Carbon\Carbon;

class Helper
{
    public static function settings()
    {
        $settings = Setting::find(1);
        return $settings;
    }
    
}