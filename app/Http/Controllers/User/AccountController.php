<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Account;
use Illuminate\Http\Request;
use Auth;

class AccountController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Get data
        $account = Account::where('user_id', Auth::user()->id)
                          ->get();
        // Response
        return response()->json([
            'message' => '查詢成功',
            'account' => $account,
        ], 200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validation
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'type' => 'required|numeric',
            'amount' => 'required|numeric',
            'remark' => 'nullable|string|max:255',
            'hidden' => 'nullable|boolean',
        ]);
        // Format data
        $data = [];
        $data['user_id'] = Auth::user()->id;
        $data['name'] = $request['name'];
        $data['type'] = $request['type'];
        $data['balance'] = $request['amount'];
        $data['amount'] = $request['amount'];
        $data['remark'] = $request['remark'];
        $data['hidden'] = !!$request['hidden'];
        // Create
        $accountId = Account::create($data)->id;
        // Response
        $account = Account::where('id', $accountId)
                          ->first();
        return response()->json([
            'message' => '新增成功',
            'account' => $account,
        ], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        // Validation
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'type' => 'required|numeric',
            'amount' => 'required|numeric',
            'remark' => 'nullable|string|max:255',
            'hidden' => 'nullable|boolean',
        ]);
        // Check Owner
        $account = Account::where('id', $id)
                          ->first();
        if($account['user_id'] !== Auth::user()->id) {
            return response()->json([
                'message' => '不合法的操作',
            ], 403);
        }
        // Calculate Balance
        $balance = $request['amount'] - $account['amount'];
        // Update 
        $account['name'] = $request['name'];
        $account['type'] = $request['type'];
        $account['balance'] += $balance;
        $account['amount'] = $request['amount'];
        $account['remark'] = $request['remark'];
        $account['hidden'] = !!$request['hidden'];
        $account->save();
        // Response
        $account = Account::where('id', $account['id'])
                          ->first();
        return response()->json([
            'message' => '更新成功',
            'account' => $account,
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // Check Owner
        $account = Account::where('id', $id)
                          ->first();
        if($account['user_id'] !== Auth::user()->id) {
            return response()->json([
                'message' => '不合法的操作',
            ], 403);
        }
        // Delete
        $account->delete();
        // Response
        return response()->json([
            'message' => '刪除成功',
        ], 204);
    }
}
