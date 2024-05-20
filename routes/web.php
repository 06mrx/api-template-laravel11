<?php

use Illuminate\Support\Facades\Route;
use DeviceDetector\ClientHints;
use DeviceDetector\DeviceDetector;
use DeviceDetector\Parser\Device\AbstractDeviceParser;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|

*/

function getIPAddress() {  
    //whether ip is from the share internet  
     if(!empty($_SERVER['HTTP_CLIENT_IP'])) {  
                $ip = $_SERVER['HTTP_CLIENT_IP'];  
        }  
    //whether ip is from the proxy  
    elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {  
                $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];  
     }  
//whether ip is from the remote address  
    else{  
             $ip = $_SERVER['REMOTE_ADDR'];  
     }  
     return $ip;  
}  

Route::get('/', function () {
    // echo 'Hello ' . get_current_user();
    AbstractDeviceParser::setVersionTruncation(AbstractDeviceParser::VERSION_TRUNCATION_NONE);

    $userAgent = $_SERVER['HTTP_USER_AGENT']; // change this to the useragent you want to parse
    $clientHints = ClientHints::factory($_SERVER); // client hints are optional

    $dd = new DeviceDetector($userAgent, $clientHints);
    $dd->parse();
    $clientInfo = $dd->getClient(); // holds information about browser, feed reader, media player, ...
    $osInfo = $dd->getOs();
    $device = $dd->getDeviceName();
    $brand = $dd->getBrandName();
    $model = $dd->getModel();
    $ip = getIPAddress();
    
    // if ($dd->isBot()) {
    //     // handle bots,spiders,crawlers,...
    //     echo $botInfo = $dd->getBot();
    // } else {
    //     $clientInfo = $dd->getClient(); // holds information about browser, feed reader, media player, ...
    //     $osInfo = $dd->getOs();
    //     $device = $dd->getDeviceName();
    //     $brand = $dd->getBrandName();
    //     $model = $dd->getModel();
    //     dump($clientInfo);
    //     dump($osInfo);
    //     dump($device);
    //     dump($brand);
    //     dump($model);
    // }
    return view('welcome', compact('clientInfo', 'osInfo', 'device', 'brand', 'model', 'ip'));
});
