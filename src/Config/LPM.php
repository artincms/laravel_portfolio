<?php

return [

    /* Important Settings */
    'backend_lpm_middlewares' => ['web'],
    'frontend_lpm_middlewares' => ['web'],
    // you can change default route from sms-admin to anything you want
    'backend_lpm_route_prefix' => 'LPM',
    'frontend_lpm_route_prefix' => 'LPM',
    // SMS.ir Api Key
    'api-key' => env('SMSIR-API-KEY','Your api key'),
    // ======================================================================
    //allow user to upload private file in filemanager
    'userModel'=>'App\User',
    'guestCanVote'=>true,
    'multiLang'=>'faq_sampleLang'

];