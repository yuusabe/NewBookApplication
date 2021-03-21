<?php

return [
    "region" => env("AWS_DEFAULT_REGION", "ap-northeast-1"),
    "version" => env("AWS_COGNITO_VERSION", "2016-04-18"),
    "key" => env("AWS_ACCESS_KEY_ID"),
    "secret" => env("AWS_SECRET_ACCESS_KEY"),
    "clientId" => env("AWS_COGNITO_APP_CLIENT_ID"),
    "poolId" => env("AWS_COGNITO_USER_POOL_ID"),
];