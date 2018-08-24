<?php

namespace App\Http\Controllers;

use App\Authorization;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

class AuthorizationController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Authorization  $authorization
     * @return \Illuminate\Http\Response
     */
    public function show(Authorization $authorization) {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Authorization  $authorization
     * @return \Illuminate\Http\Response
     */
    public function edit(Authorization $authorization) {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Authorization  $authorization
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Authorization $authorization) {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Authorization  $authorization
     * @return \Illuminate\Http\Response
     */
    public function destroy(Authorization $authorization) {
        //
    }

    public function auth(Request $request) {
        try {
            $auth = Authorization::where('usuario', $request->usuario)->firstOrFail();
            if (Hash::check($request->contrasena, $auth->contrasena)) {
                unset($auth->contrasena);
                return response()->json(['message' => 'Sesión iniciada', 'datos' => $auth]);
            } else {
                return response()->json(['message' => 'Datos incorrectos'], 401);
            }
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $ex) {
            return response()->json(['message' => $ex->getMessage()], 500);
        }
    }

}
