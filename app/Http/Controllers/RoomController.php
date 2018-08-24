<?php

namespace App\Http\Controllers;

use App\Room;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RoomController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        return response()->json(Room::where('disponible', true)->get(), 200);
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
        try {
            if ($request->hasFile('foto')) {
                $nameImagen = time() . $request->file('foto')->getClientOriginalName();
                $request->file('foto')->move('./../files/', $nameImagen);
                $room = new Room();
                $room->foto = $nameImagen;
                $room->descripcion = $request->descripcion;
                $room->numero_habitacion = $request->numero_habitacion;
                $room->id_categoria = $request->id_categoria;
                $room->id_piso = $request->id_piso;
                $room->disponible = true;
                $room->saveOrFail();
                return response()->json(['message' => 'Agregado correctamente'], 201);
            }
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $ex) {
            return response()->json(['message' => $ex->getMessage()], 500);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Room  $room
     * @return \Illuminate\Http\Response
     */
    public function show(Room $room) {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Room  $room
     * @return \Illuminate\Http\Response
     */
    public function edit(Room $room) {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Room  $room
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Room $room) {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Room  $room
     * @return \Illuminate\Http\Response
     */
    public function destroy(Room $room) {
        //
    }

    public function get() {
        $total = Room::all()->count();
        $room = DB::table('rooms')->join('floors', 'floors.id', '=', 'rooms.id_piso')->join('categories', 'categories.id', '=', 'rooms.id_categoria')->select('rooms.numero_habitacion as nombre', 'rooms.foto', 'rooms.descripcion', 'rooms.disponible', 'floors.nombre as piso', 'categories.nombre as categoria')->get();
        return response()->json(['datos' => $room, 'total' => $total], 200);
    }

}
