<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Lend;
use App\Http\Requests\LendBook;
use Illuminate\Support\Facades\Log;

class LendBookController extends Controller
{
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function lend(LendBook $request)
    {
        try {
            $lend = Lend::create($request->all());
            // データを挿入できた時
            return response()->json([
                'message' => 'ok',
                'data' => $lend
            ], 200, [], JSON_UNESCAPED_UNICODE);  
        } catch(\Throwable $e) {
            // データを挿入できなかった時
            return response()->json([
            'message' => 'システムエラー。管理者にお問い合わせください。',
            ], 500);
        }
    }
}
