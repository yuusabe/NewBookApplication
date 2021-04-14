<?php

namespace App\Services;

/**
 * SPAでAPIサーバーからの返却値を整形するためのクラス
 */
class ApiResponseFormatter
{
  /** APIレスポンスの定型フォーマット */
    protected $format = array(
        '200' => array('code' => 200, 'message' => '', 'data' => ''),     // 200 OK 
        '201' => array('code' => 201, 'message' => '', 'data' => ''),     // 201 OK
        '400' => array('code' => 400, 'message' => '', 'errors' => ''),   // 400 Bad Request 
        '401' => array('code' => 401, 'message' => '', 'errors' => ''),   // 401 Unauthorized
        '403' => array('code' => 403, 'message' => '', 'errors' => ''),   // 403 Forbidden - 認証はされているが認可されていない
        '404' => array('code' => 404, 'message' => '', 'errors' => ''),   // 404 Not Found 
        '410' => array('code' => 410, 'message' => '', 'errors' => ''),   // 410 Gone - 今は存在しないリソース（廃止されたAPIなど）
        '422' => array('code' => 422, 'message' => '', 'errors' => ''),   // 422 Unprocessable Entity - バリデーションエラー
        '429' => array('code' => 429, 'message' => '', 'errors' => ''),   // 429 Too Many Requests - 回数制限をオーバー
        '500' => array('code' => 500, 'message' => '', 'errors' => ''),   // 500 Application Error - 処理エラー
    );
    
    /** APIレスポンス用の配列 */
    protected $response_array = null;

    /**
    * コンストラクタ
    */
    public function __construct($_code, $_message, $_contents)
    {
        $this->toFormatArray($_code);
        $this->setMessage($_message);
        $this->setContents($_contents);
    }
    
    //入力されたパラメータを元にAPIレスポンス用の配列にフォーマットをセットする
    public function toFormatArray($_code){
        if (array_key_exists($_code, $this->format)) {
        $this->response_array = $this->format[$_code];
        return true;
        }

        return false;
    }

    // APIレスポンス用配列にメッセージをセットする
    public function setMessage($_message){
        if (array_key_exists('message', $this->response_array)) {
        $this->response_array['message'] = $_message;
        return true;
        }

        return false;
    }

    // APIレスポンス用配列にメインコンテンツをセットする
    public function setContents($_contents){
        if (array_key_exists('data', $this->response_array)) {
        $this->response_array['data'] = $_contents;
        } elseif (array_key_exists('errors', $this->response_array)) {
        $this->response_array['errors'] = $_contents;    
        }
    }

    // APIレスポンス用配列を返す
    public function getResponseArray(){
        // production環境の場合は、errorレスポンスの「debug」プロパティを除去
        $response_array = $this->response_array;
        if(env('APP_ENV') == 'production' && array_key_exists('errors', $response_array)) {
        $replace_errors = [];
        foreach ($response_array['errors'] as $error) {
            unset($error['debug']);
            $replace_errors[] = $error;
        }
        $response_array['errors'] = $replace_errors;
        }
        
        return $response_array;
    }

}