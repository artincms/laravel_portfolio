<?php

return [

    /* Important Settings */
    'backend_lpm_middlewares'   => explode(',', env('BACKEND_MIDDLEWARES', 'web')),
    'frontend_lpm_middlewares'  => explode(',', env('LPM_FRONTEND_MIDDLEWARES', 'web')),
    // you can change default route from sms-admin to anything you want
    'backend_lpm_route_prefix'  => env('LPM_BACKEND_ROUTE_PERFIX', 'LPM'),
    'frontend_lpm_route_prefix' => env('LPM_FRONTEND_ROUTE_PERFIX', 'LPM'),
    // ======================================================================
    //allow user to upload private file in filemanager
    'user_model'                => env('LPM_USER_MODEL', 'App\User'),
    'guest_can_vote'            => env('LPM_GUEST_CAN_VOTE', true),
    'multi_lang'                => env('LPM_MULTI_LANG', 'LPM_SampleLang'),
    'header_back_color'         => env('LPM_HEADER_BACK_COLOR', '#00394d'),
    'header_font_color'         => env('LPM_HEADER_FONT_COLOR', '#ffffff'),
    'show_action_button'        => env('LPM_SHOW_ACTION_BUTTON', true),
];