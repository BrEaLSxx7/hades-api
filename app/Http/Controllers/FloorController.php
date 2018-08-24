<?php

namespace App\Http\Controllers;

use App\Floor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Room;

class FloorController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        return response()->json(Floor::all(), 200);
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
            $floor = new Floor();
            $floor->nombre = $request->nombre;
            $floor->saveOrFail();
            return response()->json(['message' => 'Agregado correctamente'], 201);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $ex) {
            return response()->json(['message' => $ex->getMessage()], 500);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Floor  $floor
     * @return \Illuminate\Http\Response
     */
    public function show(Floor $floor) {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Floor  $floor
     * @return \Illuminate\Http\Response
     */
    public function edit(Floor $floor) {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Floor  $floor
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Floor $floor) {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Floor  $floor
     * @return \Illuminate\Http\Response
     */
    public function destroy(Floor $floor) {
        //
    }

    public function get() {
        $floor = Floor::all();
        $total = Floor::all()->count();
        foreach ($floor as $value) {
            $report = DB::table('rooms')->select(DB::raw('count(*) as total'))->groupBy('id_piso')->where('id_piso', $value->id)->get();
            $report2 = DB::table('rooms')->select(DB::raw('count(*) as total'))->groupBy('id_piso')->where('id_piso', $value->id)->where('disponible', true)->get();
            if (count($report) > 0) {
                $value->numero_habitaciones = $report[0]->total;
            } else {
                $value->numero_habitaciones = 0;
            }
            if (count($report2) > 0) {
                $value->numero_habitaciones_disponibles = $report2[0]->total;
            } else {
                $value->numero_habitaciones_disponibles = 0;
            }
        }
        return response()->json(['datos' => $floor, 'total' => $total], 200);
    }

}
