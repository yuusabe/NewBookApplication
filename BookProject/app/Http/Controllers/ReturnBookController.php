<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Lend;
use App\Http\Requests\ReturnBook;
use Illuminate\Support\Facades\Log;

class ReturnBookController extends Controller
{
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function return(ReturnBook $request)
    {
        // 書籍IDを受け取る
        $id = $request->input('book_number');
        $book = Lend::where('book_number',$id)->where('lend_flag',1)->update(['lend_flag' => 0]);
        // $b_info = Lend::where('book_number',$id)->where('lend_flag',1)->get();
        if ($book == 0) {
            return response()->json([
                'message' => 'システムエラー。管理者にお問い合わせください。',
            ], 500);
        } else {
            return response()->json([
                'message' => 'ok',
                'data' => $book,
            ], 200);
        }
    }
}
