<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Authentication Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines are used during authentication for various
    | messages that we need to display to the user. You are free to modify
    | these language lines according to your application's requirements.
    |
    */

    'failed' => 'These credentials do not match our records.',
    'throttle' => 'Too many login attempts. Please try again in :seconds seconds.',

    'oauth_not_supported' => 'The :service service is not supported',
    'oauth_data_err' => 'Error requesting data from :service. Please try again',
    'oauth_data_invalid' => 'Wrong data recevied from :service. Please try again',
    'oauth_data_unknown' => 'Unknown error while requesting dara from :service',
    'oauth_already_used' => 'This account is already been used by another user',
    'oauth_mail_in_use' => 'This mail address is already in use. Please log in and reconnect this account afterwards',
    'oauth_mail_in_use_acc' => 'This mail address is already used by a :existing_service. Please log in with your :existing_service account and reconnect the :new_service account again',
    'oauth_mismatch_config' => 'Missmatching authorization config from :service',
];
