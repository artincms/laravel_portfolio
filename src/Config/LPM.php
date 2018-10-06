<?php

return [

    /* Important Settings */
    'backend_lpm_middlewares' => ['web'],
    'frontend_lpm_middlewares' => ['web'],
    // you can change default route from sms-admin to anything you want
    'backend_lpm_route_prefix' => 'LPM',
    'frontend_lpm_route_prefix' => 'LPM',
    // ======================================================================
    //allow user to upload private file in filemanager
    'user_model'=>'App\User',
    'guestCanVote'=>true,
    'multiLang'=> env('LPM_MULTILANG', 'faq_sampleLang'),
    'header_back_color'         => '#00394d',
    'header_font_color'         => '#ffffff',
    'show_action_button'         => true,

];