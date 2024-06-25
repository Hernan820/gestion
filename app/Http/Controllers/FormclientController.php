<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Models\estadoregistro;
use App\Models\bitacora;

class FormclientController extends Controller
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
    public function show()
    {
        $sql = "SELECT  wp_wpforms_db.form_id, wp_wpforms_db.form_value, wp_wpforms_db.form_date,wp_wpforms_db.form_post_id,
        (SELECT COUNT(*) FROM seguimientos WHERE seguimientos.id_fomrscontigo = wp_wpforms_db.form_id   ) as total_seguimiento , 
        estadoregistros.estado
        FROM wp_wpforms_db
        LEFT JOIN seguimientos on seguimientos.id_fomrscontigo = wp_wpforms_db.form_id
        LEFT JOIN estadoregistros on estadoregistros.id_form = wp_wpforms_db.form_id
        WHERE wp_wpforms_db.form_post_id IN(1666)
        GROUP BY wp_wpforms_db.form_id
        ";

        $datosfomr = DB::select($sql);
        return response()->json($datosfomr);
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
    public function EstadoClienteform($id,$estadoreg)
    {
        $mensaje ;
        if ($estadoreg == 0) {
            $mensaje = "Eliminó registro";
        }else if($estadoreg == 4) {
            $mensaje = "Confirmo registro";
        }else if($estadoreg == 5) {
            $mensaje = "No answer registro";
        }else if($estadoreg == 6) {
            $mensaje = "Cancelo registro";
        }

        $registro = estadoregistro::where("estadoregistros.id_form","=",$id)->count();

        if ($registro == 0) {
        $estado = new estadoregistro;
        $estado->estado = $estadoreg;
        $estado->id_form = $id;
        $estado->save();
        }else {
            $estado = estadoregistro::where("estadoregistros.id_form","=",$id)->first();
            $estado->estado = $estadoreg;
            $estado->save();
        }
        date_default_timezone_set("America/New_York");

        $bitacora = new bitacora;
        $bitacora->fecha = date('Y-m-d H:i:s');
        $bitacora->accion = $mensaje;
        $bitacora->nombre_usuario = auth()->user()->name;
        $bitacora->id_usuario  = auth()->user()->id;
        $bitacora->id_registrocliente   = $id;
        $bitacora-> save();
    }
}
