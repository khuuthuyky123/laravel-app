<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class UserController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // Log::info($user->id); // 1 (correct id)
        // Log::info(Auth::user()); // 2 (correct id)
        if (strval(Auth::user()->role_id) == "4") {
            if (($request->searchKey == "" or !$request->searchKey) and ($request->filterKey == [] or !$request->filterKey))
                $user = DB::table('users')->join('user_roles', 'users.role_id', '=', 'user_roles.id')->select(['users.name', 'users.email', 'user_roles.role']);
            else {
                $user = DB::table('users')->join('user_roles', 'users.role_id', '=', 'user_roles.id')->select(['users.name', 'users.email', 'user_roles.role'])->where('users.name', 'like', '%' . $request->searchKey . '%');
                if ($request->filterKey)
                    $user = $user->whereIn('role', explode(',', $request->filterKey));
            }
            if ($request->sort)
                if ($request->sort['name'] == "inc")
                    $user->orderBy('name');
                else if ($request->sort['email'] == "inc")
                    $user->orderBy('email');
                else if ($request->sort['name']  == "desc")
                    $user->orderByDesc('name');
                else if ($request->sort['email'] == "desc")
                    $user->orderByDesc('email');
            return response(['users' => $user->paginate(10)], 200);
        } else
            return response(['permission' => false], 403);
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
