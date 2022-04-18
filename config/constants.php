<?php

return [
    "UPLOAD_PATH"           =>"storage\app\public",
    'HttpStatus' => [
        'OK' => 200,
        'CREATED' => 201,
        'BAD_REQUEST' => 400,
        'UNAUTHORIZED' => 401,
        'VALIDATION_EXCEPTION' => 422,
        'FORBIDDEN' => 403
    ],
    'TeamImagePath' => [
        'ORIGNAL' => 'team',
        'THUMBNAIL' => 'team/thumbnail',
    ],
    'PlayerImagePath' => [
        'ORIGNAL' => 'player',
        'THUMBNAIL' => 'player/thumbnail',
    ],
    
    'Regex' =>[
        'EMAIL' => '/^([a-zA-Z0-9_\-\.\+]+)@([a-zA-Z0-9_\-\.]+)\.([a-zA-Z]{2,5})$/i',
        'PASSWORD' => '/^(?=.*?[a-zA-Z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{6,}$/',
        'NAME' => '/^[a-zA-Z0-9\s@(*&^%$#]+$/m',
        'ALPHA_NUM' => '/^[a-zA-Z0-9]+$/m',
        'ALPHA_NUM_WITH_SPACE' => '/^[a-zA-Z0-9\s]+$/m',
        'SOCIAL_LINK' => '/(https?):\/\/([\w_-]+(?:(?:\.[\w_-]+)+))([\w.,@?^=%&:\/~+#-]*[\w@?^=%&\/~+#-])?/m',
    ],
];
