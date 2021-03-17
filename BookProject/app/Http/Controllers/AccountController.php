<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AccountController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreAccount $request)
    {
        $account = Account::create($request->all());
        if ($account) {
            return response()->json([
                'message' => 'Account created successfully',
                'data' => $account
            ], 200, [], JSON_UNESCAPED_UNICODE);
        } else {
            return response()->json([
                'message' => 'システムエラー。管理者にお問い合わせください。',
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $account = Account::find($id);
        if ($account) {
            return response()->json([
                'message' => 'ok',
                'data' => $account_data
            ], 200, [], JSON_UNESCAPED_UNICODE);
        } else {
            return response()->json([
                'message' => 'システムエラー。管理者にお問い合わせください。',
            ], 500);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $update = [
            'account_name' => $request->account_name,
            'mail_address' => $request->mail_address,
            'manager_flag' => $request->manager_flag
        ];
        $account = Account::where('id', $id)->update($update);
        if ($account) {
            return response()->json([
                'message' => 'Account updated successfully',
            ], 200);
        } else {
            return response()->json([
                'message' => 'システムエラー。管理者にお問い合わせください。',
            ], 500);
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $destroy = [
            'logic_flag' => false
        ];
        $account = Account::where('id', $id)->update($destroy);
        if ($account) {
            return response()->json([
                'message' => 'Account updated successfully',
            ], 200);
        } else {
            return response()->json([
                'message' => 'システムエラー。管理者にお問い合わせください。',
            ], 500);
        }
    }
}
