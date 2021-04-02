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
    public function createUser($email, $password){
        
        $attributes["email"] = $email;
        try {
            // Cognitoの管理者用アカウント登録API
            $response = $this->client->adminCreateUser([
                "DesiredDeliveryMediums"  => ["EMAIL"],
                "UserPoolId" => $this->poolId,
                "TemporaryPassword" => $password,
                "Username" => $email,
                "UserArrtibutes" => [
                    [
                        "Name" => "email_verified",
                        "Value" => "True"
                    ],
                ],
            ]);
        // エラー処理
        } catch (\Exception $e){
            if(empty($e->getAwsErrorCode())){
                $response = [
                    "message" => "正体不明のエラー",
                    "errors" => $e->getMessage()
                ];
            }else{
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
        }

        return $response;
    }

    //属性データ用型整形
    // protected function formatAttributes(array $attributes)
    // {
    //     $userAttributes = [];
    //     foreach ($attributes as $key => $value) {
    //         $userAttributes[] = [
    //             "Name" => $key,
    //             "Value" => $value,
    //         ];
    //     }
    //     return $userAttributes;
    // }

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
            if(empty($e->getAwsErrorCode())){
                $response = [
                    "message" => "正体不明のエラー",
                    "errors" => $e->getMessage()
                ];
            }else{
                switch($e->getAwsErrorCode()){
                    // ユーザー名（アドレス）被り
                    case "NotAuthorizedException":
                        //メールアドレスorパスワードミス
                        if($e->getAwsErrorMessage() == "Incorrect username or password."){
                            $response = [
                                "message" => "ユーザー名かパスワードが間違っています。再度入力してください。",
                                "errors" => $e->getAwsErrorMessage()
                            ];
                        //失敗回数上限超過
                        }else if($e->getAwsErrorMessage() == "Password attempts exceeded"){
                            $response = [
                                "message" => "失敗回数が上限を超えました。しばらく時間をおいてから再度お試しください。",
                                "errors" => $e->getAwsErrorMessage()
                            ];
                        }else{
                            $response = [
                                "message" => "ユーザー名かパスワードが間違っています。再度入力してください。",
                                "errors" => $e->getAwsErrorMessage()
                            ];
                        }
                        break;
                    // その他エラー
                    default:
                    $response = [
                        "message" => $e->getAwsErrorCode(),
                        "errors" => $e->getAwsErrorMessage(),
                    ];
                }
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
            // $this->client->adminUpdateUserAttributes([
            //     "UserPoolId" => $this->poolId,
            //     "UserArrtibutes" => [
            //         [
            //             "Name" => "email_verified",
            //             "Value" => true,
            //         ],
            //     ],
            //     "Username" => $email,
            // ]);
        // エラー処理
        }catch(\Exception $e){
            if(empty($e->getAwsErrorCode())){
                $response = [
                    "message" => "正体不明のエラー",
                    "errors" => $e->getMessage()
                ];
            }else{
                switch($e->getAwsErrorCode()){
                    // ユーザー名（アドレス）被り
                    case "InvalidParameterException":
                        $response = [
                            "message" => "パスワードは８文字以上で英数字込み、大文字小文字を含める必要があります。",
                            "errors" => $e->getAwsErrorMessage()
                        ];
                        break;
                    // パスワードエラー
                    case "InvalidPasswordException":
                        $response = [
                            "message" => "パスワードは８文字以上で英数字込み、大文字小文字を含める必要があります。",
                            "errors" => $e->getAwsErrorMessage()
                        ];
                        break;
                    // その他エラー
                    default:
                        $response = [
                            "message" => $e->getAwsErrorCode(),
                            "errors" => $e->getAwsErrorMessage(),
                        ];
                }
            }
        }
        return $response;
    }

    public function forgotPassword($email)
    {
        try {
            // Cognitoの管理者用ログインAPI(管理者がユーザ作成しているためadminを使用)
            $response = $this->client->forgotPassword([
                "Username" => $email,
                "ClientId" => $this->clientId,
            ]);
        // エラー処理
        } catch (\Exception $e) {
            $response = [
                // "message" => $e->getAwsErrorCode(),
                // "errors" => $e->getAwsErrorMessage(),
                "message" => $e->getCode(),
                "errors" => $e->getMessage(),
            ];
        }
        return $response;
    }

    public function changePassword($previous_password, $proposed_password, $access_token)
    {
        try {
            // パスワード変更API
            $response = $this->client->changePassword([
                "AccessToken" => $access_token,
                "PreviousPassword" => $previous_password,
                "ProposedPassword" => $proposed_password,
            ]);
        // エラー処理
        } catch (\Exception $e) {
            $response = [
                // "message" => $e->getAwsErrorCode(),
                // "errors" => $e->getAwsErrorMessage(),
                "message" => $e->getCode(),
                "errors" => $e->getMessage(),
            ];
        }
        return $response;
    }

    public function deleteUser($email, $id_token)
    {
        try {
            // パスワード変更API
            $response = $this->client->adminDeleteUser([
                "UserPoolId" => $this->poolId,
                "Username" => $email,
            ]);
        // エラー処理
        } catch (\Exception $e) {
            $response = [
                // "message" => $e->getAwsErrorCode(),
                // "errors" => $e->getAwsErrorMessage(),
                "message" => $e->getCode(),
                "errors" => $e->getMessage(),
            ];
        }
        return $response;
    }

}