<?php

namespace App\Http\Controllers;

use App\Reservation;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Client;
use Illuminate\Support\Facades\DB;
use App\Room;
use App\Category;

class ReservationController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        return response()->json(Reservation::all(), 200);
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
            $message = "Agregado Correctamente";
            $llegada = new Carbon($request->llegada);
            $salida = new Carbon($request->salida);
            $user = new Client();
            $user->nombre = $request->nombre;
            $user->telefono = $request->telefono;
            $user->id_tipoDocumento = $request->tipo_documento;
            $user->numero_documento = $request->numero_documento;
            $user->correo = $request->correo;
            $user->id_rol = 3;
            $user->saveOrFail();
            $array = [];
            do {
                $reser = new Reservation();
                $reser->inicio = $llegada;
                $reser->fin = $salida;
                $reser->id_usuario = $user->id;
                $tmp = true;
                $room = DB::table('rooms')->join('reservations', 'reservations.id_habitacion', '=', 'rooms.id')
                        ->select('reservations.id_habitacion')
                        ->where("inicio", ">=", $llegada)
                        ->where("fin", "<=", $salida)
                        ->get();
                if (count($room) < 0) {
                    $ro = Room::where('id_categoria', $request->categoria)->get();
                    if (count($ro) > 0) {
                        $reser->id_habitacion = $ro[0]->id;
                        $cat = Category::where('id', $request->categoria)->get();
                        $reser->precioT = ($request->numero_personas > 0) ? $cat->precio : $cat->precio * 1.75;
                    } else {
                        $message = "No hay habitaciones";
                    }
                } else {
                    $rooms = Room::all();
                    foreach ($room as $value) {
                        foreach ($rooms as $value2) {
                            if ($value->id_habitacion == $value2->id) {
                                unset($value2);
                            }
                        }
                    }
                    if (count($rooms) > 0) {
                        foreach ($rooms as $values) {
                            if ($values->id_categoria == $request->categoria) {
                                $reser->id_habitacion = $values->id;
                                $cat = Category::where('id', $request->categoria)->firstOrFail();
                                $reser->precioT = ($request->numero_personas > 0) ? $cat->precio : $cat->precio * 1.75;
                                $tmp = false;
                                break;
                            }
                        }
                    }
                }
                if ($tmp) {
                    $message = 'No hay mas habitaciones';
                }
                $reser->saveOrFail();
                array_push($array, $reser);
                $request->numero_personas -= 2;
            } while ($request->numero_personas > 0);
            return response()->json(['message' => $message, 'habitaciones' => $array, 'usuario' => $user], 200);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $ex) {
            return response()->json(['message' => $ex->getMessage()], 500);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Reservation  $reservation
     * @return \Illuminate\Http\Response
     */
    public function show(Reservation $reservation) {
//
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Reservation  $reservation
     * @return \Illuminate\Http\Response
     */
    public function edit(Reservation $reservation) {
//
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Reservation  $reservation
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Reservation $reservation) {
//
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Reservation  $reservation
     * @return \Illuminate\Http\Response
     */
    public function destroy(Reservation $reservation) {
//
    }

    public function reportes() {
        $meses = [];
        $total = 0;
        for ($i = 1; $i <= 12; $i++) {
            $app = Reservation::whereMonth('created_at', $i)->get()->count();
            $total += $app;
            array_push($meses, $app);
        }
        return response()->json(['meses' => $meses, 'total' => $total], 200);
    }

}
