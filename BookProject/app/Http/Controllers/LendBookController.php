<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Lend;

class LendBookController extends Controller
{
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function lend(Request $request)
    {
        $lend = Lend::create($request->all());
        return response()->json([
            'message' => 'ok',
            'data' => $lend
        ], 200, [], JSON_UNESCAPED_UNICODE);
    }


}
