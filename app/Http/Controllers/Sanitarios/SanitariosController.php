<?php

namespace App\Http\Controllers\Sanitarios;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Models\Sanitario;
use Illuminate\Support\Facades\Auth;


class SanitariosController extends Controller
{
    public function __construct()
    {
       // $this->middleware('is_check');
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $sanitarios = Sanitario::all();
        return view('sanitarios.list', ['sanitarios' => $sanitarios]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('sanitarios.profile');
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
        $sanitario = Sanitario::find($id);
        if (!is_null($sanitario)) {
            return "sanitario " . $sanitario;
        } else {
            return "no hay resultados";
        }
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
        try{
            $sanitario = Sanitario::find($id);
            $sanitario->sDni = '28495114t';
            $sanitario->sNombre = $request->sNombre;
            $sanitario->sApellidos = $request->sApellidos;
            $sanitario->sAvatar = $request->sAvatar;
            $sanitario->cGenero = $request->cGenero;
            $sanitario->sEmail = $request->sEmail;
            $sanitario->sTelefono1 = $request->sTelefono1;
            $sanitario->sTelefono2 = $request->sTelefono2;
            $sanitario->sDireccion = $request->sDireccion;
            $sanitario->sCodigoPostal = $request->sCodigoPostal;
            $sanitario->idU = Auth::user()->id;
            $sanitario->dtU = date('Y-m-d H:i:s');
            $sanitario->cActivo = 'Si';
            $sanitario->cBorrado = 'No';


            $sanitario->save();
            return response()->json(['exito' => true], 200);
        } catch (\Exception $e) {
            echo $e->getMessage();
            return response()->json(['exito' => false], 404);
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
        //
    }


    public function postAllSanitario()
    {
        $sanitarios = Sanitario::all();
        return $sanitarios;
    }


    /**
     * Borrar un nuevo, con el método SoftDelete
     * @param $id
     * @return string
     */
    public function deleteSoft($id)
    {
        try {
            $sanitario = Sanitario::find($id);
            $sanitario->cBorrado = 'Si';
            $sanitario->save(); //actualizar el campo borrado
            $sanitario->delete(); //actualiza el timestamp de borrado

            return response()->json(['exito' => true], 200);
        } catch (\Exception $e) {
            //echo $e->getMessage();
            return response()->json(['exito' => false], 404);
        }
    }


}

