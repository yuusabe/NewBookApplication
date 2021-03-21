<?php

namespace App\Cognito;

// SDKの中から使うクラス
use Aws\CognitoIdentityProvider\CognitoIdentityProviderClient;
use Aws\CognitoIdentityProvider\Exception\CognitoIdentityProviderException;

class CognitoClient
{
    protected $client;
    protected $clientId;
    protected $poolId;

    public function __construct()
    {
        $config = [
            "region" => config("cognito.region"),
            "version" => config("cognito.version"),
            "credentials" => [
                "key" => config("cognito.key"),
                "secret" => config("cognito.secret")
            ]
        ];
        $this->client = new CognitoIdentityProviderClient($config);
        $this->clientId = config("cognito.clientId");
        $this->poolId = config("cognito.poolId");
    }

    // アカウント登録
    public function cognitoAdd($email, $password, array $attributes = []){
        
        $attributes["email"] = $email;
        try {
            // Cognitoの管理者用アカウント登録API
            $response = $this->client->adminCreateUser([
                "UserPoolId" => $this->poolId,
                "TemporaryPassword" => $password,
                "UserArrtibutes" => $this->formatAttributes($attributes),
                "Username" => $email,
            ]);
        // エラー処理
        } catch (\Exception $e){
            switch($e->getAwsErrorCode()){
                // ユーザー名（アドレス）被り
                case "UsernameExistsException":
                    $response = [
                        "message" => "登録済みのメールアドレスです",
                        "errors" => $e->getAwsErrorMessage()
                    ];
                    break;
                // パスワード要件
                case "InvalidPasswordException":
                    $response = [
                        "message" => "パスワードは８文字以上で英数字込み、大文字小文字を含める必要があります。",
                        "errors" => $e->getAwsErrorMessage()
                    ];
                    break;
                // 必須属性チェック
                case "InvalidParameterException":
                    $response = [
                        "message" => "メールアドレスかパスワードが不正です",
                        "errors" => $e->getAwsErrorMessage()
                    ];
                    break;
                default:
                $response = [
                    "message" => $e->getAwsErrorCode(),
                    "errors" => $e->getAwsErrorMessage(),
                ];
            }
        }

        return $response;
    }

    //属性データ用型整形
    protected function formatAttributes(array $attributes)
    {
        $userAttributes = [];
        foreach ($attributes as $key => $value) {
            $userAttributes[] = [
                "Name" => $key,
                "Value" => $value,
            ];
        }
        return $userAttributes;
    }

    // ログイン処理
    public function login($email, $password)
    {
        try {
            // Cognitoの管理者用ログインAPI(管理者がユーザ作成しているため、管理者用で良い)
            $response = $this->client->adminInitiateAuth([
                    "AuthFlow" => "ADMIN_USER_PASSWORD_AUTH",
                    "AuthParameters" => [
                        "USERNAME" => $email,
                        "PASSWORD" => $password,
                    ],
                    "ClientId" => $this->clientId,
                    "UserPoolId" => $this->poolId,
            ]);
        // エラー処理
        } catch (\Exception $e) {
            switch($e->getAwsErrorCode()){
                // ユーザー名（アドレス）被り
                case "NotAuthorizedException":
                    $response = [
                        "message" => "ユーザー名かパスワードが間違っています。",
                        "errors" => $e->getAwsErrorMessage()
                    ];
                    break;
                default:
                $response = [
                    "message" => $e->getAwsErrorCode(),
                    "errors" => $e->getAwsErrorMessage(),
                ];
            }
        }

        return $response;
    }

    // 初回ログイン
    public function firstLogin($email, $password, $session)
    {
        try{
            // Cognitoの初回ログイン時パスワード変更API
            $response = $this->client->adminRespondToAuthChallenge([
                "ChallengeName" => "NEW_PASSWORD_REQUIRED",
                "ChallengeResponses" => [
                    "NEW_PASSWORD" => $password,
                    "USERNAME" => $email
                ],
                "ClientId" => $this->clientId,
                "UserPoolId" => $this->poolId,
                "Session" => $session
            ]);
        // エラー処理
        }catch(\Exception $e){
            if(empty($e->getAwsErrorCode())){
                $response = [
                    "message" => "正体不明のエラー",
                    "errors" => $e->getMessage()
                ];
            }
            switch($e->getAwsErrorCode()){
                // ユーザー名（アドレス）被り
                case "InvalidParameterException":
                    $response = [
                        "message" => "パスワードは８文字以上で英数字込み、大文字小文字を含める必要があります。",
                        "errors" => $e->getAwsErrorMessage()
                    ];
                    break;
                case "InvalidPasswordException":
                    $response = [
                        "message" => "パスワードは８文字以上で英数字込み、大文字小文字を含める必要があります。",
                        "errors" => $e->getAwsErrorMessage()
                    ];
                    break;
                default:
                    $response = [
                        "message" => $e->getAwsErrorCode(),
                        "errors" => $e->getAwsErrorMessage(),
                    ];
            }
        }
        return $response;
    }
}