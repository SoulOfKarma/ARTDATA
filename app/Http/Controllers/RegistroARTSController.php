<?php

namespace App\Http\Controllers;

use App\registroARTS;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use DB;
use Carbon\Carbon;

class RegistroARTSController extends Controller
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

    public function LRegistroArt(){
        try {
            $get_all = RegistroARTS::select('registroarts.id','registroarts.idTipoMantencion',
                       'registroarts.idART','registroarts.idLicitacion','registroarts.fechaART',
                       'registroarts.fechaFactura',DB::raw('(CASE WHEN registroarts.idSegART IS NULL THEN registroarts.id
                       ELSE registroarts.idSegART END) AS idSegART'),
                       'proveedores.rutProveedor','proveedores.descripcionProveedor','solicitantes.descripcionSolicitante',
                       'ejecutores.descripcionEjecutores','item_presupuestarios.codigoItemPresupuestario',
                       'item_presupuestarios.descripcionItemPresupuestario',
                       'tipo_mantenciones.descripcionTipoMantencion','recursos.descripcionRecursos',
                       'tipo_compras.descripcionTipoCompra','licitaciones.codigoLicitacion','resolucion_llamados.descripcionResLlamados',
                       'resolucion_adjudicaciones.descripcionResAdj','resolucion_contratos.descripcionResContratos',
                       'cdps.descripcionCDPS','orden_compras.descripcionOrdenCompras','resolucion_internas.descripcionResInternas',
                       'memos.descripcionMemo','monto','cuotas','saldo','nfactura',DB::RAW("fnStripTags(detalleART) as detalleART"),'uuid',
                       'registroarts.updated_at')
                       ->join('proveedores','registroarts.idProveedor','=','proveedores.id')
                       ->join('solicitantes','registroarts.idSolicitante','=','solicitantes.id')
                       ->join('ejecutores','registroarts.idEjecutor','=','ejecutores.id')
                       ->join('item_presupuestarios','registroARTS.idItemPresupuestario','=','item_presupuestarios.id')
                       ->join('tipo_mantenciones','registroARTS.idTipoMantencion','=','tipo_mantenciones.id')
                       ->join('recursos','registroARTS.idRecurso','=','recursos.id')
                       ->join('tipo_compras','registroARTS.idTipoCompra','=','tipo_compras.id')
                       ->join('licitaciones','registroARTS.idLicitacion','=','licitaciones.id')
                       ->join('resolucion_llamados','registroARTS.idResLlamado','=','resolucion_llamados.id')
                       ->join('resolucion_adjudicaciones','registroARTS.idResAdjudicacion','=','resolucion_adjudicaciones.id')
                       ->join('resolucion_contratos','registroARTS.idResContrato','=','resolucion_contratos.id')
                       ->join('cdps','registroARTS.idCDP','=','cdps.id')
                       ->join('orden_compras','registroARTS.idOrdenCompra','=','orden_compras.id')
                       ->join('resolucion_internas','registroARTS.idResInterna','=','resolucion_internas.id')
                       ->join('memos','registroARTS.idMemo','=','memos.id')
                       ->get();

                       
                        $data = [];
                        foreach($get_all as $e => $req ){       
                            $data[$e] = ["id" => $req['id'],'idTipoMantencion' => $req['idTipoMantencion'],"idART" => $req['idART'],"idLicitacion" => $req['idLicitacion'],"fechaART" => $req['fechaART'],"fechaFactura" => $req['fechaFactura'],
                                "idSegART" => $req['idSegART'],"rutProveedor" => $req['rutProveedor'],"descripcionProveedor" => $req['descripcionProveedor'],
                                "descripcionSolicitante" => $req['descripcionSolicitante'],"descripcionEjecutores" => $req['descripcionEjecutores'],
                                "codigoItemPresupuestario" => $req['codigoItemPresupuestario'],"descripcionItemPresupuestario" => $req['descripcionItemPresupuestario'],
                                "descripcionTipoMantencion" => $req['descripcionTipoMantencion'],"descripcionRecursos" => $req['descripcionRecursos'],
                                "descripcionTipoCompra" => $req['descripcionTipoCompra'],"codigoLicitacion" => $req['codigoLicitacion'],
                                "descripcionResLlamados" => $req['descripcionResLlamados'],"descripcionResAdj" => $req['descripcionResAdj'],
                                "descripcionResContratos" => $req['descripcionResContratos'],"descripcionCDPS" => $req['descripcionCDPS'],
                                "descripcionOrdenCompras" => $req['descripcionOrdenCompras'],"descripcionResInternas" => $req['descripcionResInternas'],
                                "descripcionMemo" => $req['descripcionMemo'],"monto" => $req['monto'],"cuotas" => $req['cuotas'],
                                "saldo" => $req['saldo'],"nfactura" => $req['nfactura'],"detalleART" => $req['detalleART'],
                                "uuid" => $req['uuid'],
                                "updated_at" => Carbon::createFromFormat('Y-m-d H:i:s', $req['updated_at'])->format('Y-m-d')];
                        }
                    
             return $data;
        } catch (\Throwable $th) {
            log::info($th);
        }
     }

     public function GetListadoOCByTMO(Request $request){
        try {
           $get_all = RegistroARTS::select('registroarts.id','registroarts.monto',
           'registroarts.saldo','registroarts.idSegART','registroarts.ntotalcuotas','registroarts.cuotas',
            DB::RAW('(registroarts.vpresupuesto - registroarts.saldo) AS totaloc')
            ,DB::RAW('MAX(registroarts.id) AS idfinal')
            )
           ->Where('registroarts.id',$request->id)
           ->orwhere('registroarts.idSegART', $request->idSegART)
           ->where('registroarts.idTipoMantencion',$request->idTipoMantencion)
           ->groupBy('registroarts.id')
           ->orderBy('registroarts.id', 'desc')
           ->first();
           return $get_all;
        } catch (\Throwable $th) {
            log::info($th);
        }
    }

    public function DataByOC($id){
       try {
           $get_all = RegistroARTS::select('registroarts.fechaART','registroarts.fechaFactura',
                      'proveedores.rutProveedor','proveedores.descripcionProveedor','solicitantes.descripcionSolicitante',
                      'ejecutores.descripcionEjecutores','item_presupuestarios.codigoItemPresupuestario','item_presupuestarios.descripcionItemPresupuestario',
                      'tipo_mantenciones.descripcionTipoMantencion','recursos.descripcionRecursos',
                      'tipo_compras.descripcionTipoCompra','licitaciones.codigoLicitacion','resolucion_llamados.descripcionResLlamados',
                      'resolucion_adjudicaciones.descripcionResAdj','resolucion_contratos.descripcionResContratos',
                      'cdps.descripcionCDPS','orden_compras.descripcionOrdenCompras','resolucion_internas.descripcionResInternas',
                      'memos.descripcionMemo','monto','cuotas','saldo','nfactura','detalleART','uuid')
                      ->join('proveedores','registroarts.idProveedor','=','proveedores.id')
                      ->join('solicitantes','registroarts.idSolicitante','=','solicitantes.id')
                      ->join('ejecutores','registroarts.idEjecutor','=','ejecutores.id')
                      ->join('item_presupuestarios','registroARTS.idItemPresupuestario','=','item_presupuestarios.id')
                      ->join('tipo_mantenciones','registroARTS.idTipoMantencion','=','tipo_mantenciones.id')
                      ->join('recursos','registroARTS.idRecurso','=','recursos.id')
                      ->join('tipo_compras','registroARTS.idTipoCompra','=','tipo_compras.id')
                      ->join('licitaciones','registroARTS.idLicitacion','=','licitaciones.id')
                      ->join('resolucion_llamados','registroARTS.idResLlamado','=','resolucion_llamados.id')
                      ->join('resolucion_adjudicaciones','registroARTS.idResAdjudicacion','=','resolucion_adjudicaciones.id')
                      ->join('resolucion_contratos','registroARTS.idResContrato','=','resolucion_contratos.id')
                      ->join('cdps','registroARTS.idCDP','=','cdps.id')
                      ->join('orden_compras','registroARTS.idOrdenCompra','=','orden_compras.id')
                      ->join('resolucion_internas','registroARTS.idResInterna','=','resolucion_internas.id')
                      ->join('memos','registroARTS.idMemo','=','memos.id')
                      ->where('orden_compras.descripcionOrdenCompras',$id)
                      ->first();

            return $get_all;
       } catch (\Throwable $th) {
           log::info($th);
       }
    }

    public function ARTDataByID($id){
        try {
            $get_all = RegistroARTS::select('registroarts.*')
                       ->where('registroarts.id',$id)
                       ->first();
 
             return $get_all;
        } catch (\Throwable $th) {
            log::info($th);
        }
     }

     public function GetPBusquedaByArt(Request $request){
         try {
             $get_all = RegistroARTS::select('registroarts.*')
                        ->where('registroarts.idART',$request->idART)
                        ->first();
             return $get_all;
         } catch (\Throwable $th) {
             log::info($th);
             return false;
         }
     }

     public function MRegistroART(Request $request){
         try {
             RegistroARTS::where('registroarts.idART',$request->idART)
             ->update(['fechaART' => $request->fechaART,'fechaFactura' => $request->fechaFactura,'idProveedor' => $request->idProveedor,
             'idSolicitante' => $request->idSolicitante,'idEjecutor' => $request->idEjecutor,'idItemPresupuestario' => $request->idItemPresupuestario,
             'idTipoMantencion' => $request->idTipoMantencion,'idRecurso' => $request->idRecurso,'idTipoCompra' => $request->idTipoCompra,
             'idLicitacion' => $request->idLicitacion,'idResLlamado' => $request->idResLlamado,'idResAdjudicacion' => $request->idResAdjudicacion,
             'idResContrato' => $request->idResContrato,'idCDP' => $request->idCDP,'idOrdenCompra' => $request->idOrdenCompra,
             'idResInterna' => $request->idResInterna,'idMemo' => $request->idMemo,'monto' => $request->monto,
             'cuotas' => $request->cuotas,'saldo' => $request->saldo,'nfactura' => $request->nfactura,
             'detalleART' => $request->detalleART
             ]);
             return true;
         } catch (\Throwable $th) {
             log::info($th);
             return false;
         }
     }

     public function GetConGastoART(Request $request){
        try {
            $get_all = RegistroARTS::select('registroarts.id','registroarts.idTipoMantencion','registroarts.saldo',
                        'registroarts.ntotalcuotas','registroarts.vpresupuesto','orden_compras.descripcionOrdenCompras',
                        'registroarts.fechaART','estados.descripcionEstado','registroarts.nfactura',
                        'registroarts.fechaFactura','registroarts.idART','registroarts.cuotas',
                        'registroarts.monto',DB::RAW("fnStripTags(detalleART) as detalleART"))
                        ->join('orden_compras','registroARTS.idOrdenCompra','=','orden_compras.id')
                        ->join('estados','registroarts.idEstado','=','estados.id')
                        ->where('registroarts.id',$request->id)
                        ->orwhere('registroarts.idSegART', $request->idSegART)
                        ->get();
            return $get_all;
        } catch (\Throwable $th) {
            log::info($th);
            return false;
        }
     }

     public function GetConGastoARTByLicitacion($id){
        try {
            $get_all = RegistroARTS::select('registroarts.id','registroarts.idTipoMantencion','registroarts.saldo',
                        'registroarts.ntotalcuotas','registroarts.vpresupuesto','orden_compras.descripcionOrdenCompras',
                        'registroarts.fechaART','estados.descripcionEstado','registroarts.nfactura','registroarts.fechaFactura',
                        'registroarts.idART','registroarts.cuotas','registroarts.monto',
                        DB::RAW("fnStripTags(detalleART) as detalleART"),'licitaciones.codigoLicitacion')
                        ->join('orden_compras','registroARTS.idOrdenCompra','=','orden_compras.id')
                        ->join('estados','registroarts.idEstado','=','estados.id')
                        ->join('licitaciones','registroarts.idLicitacion','=','licitaciones.id')
                        ->where('registroarts.idLicitacion',$id)
                        ->get();
            return $get_all;
        } catch (\Throwable $th) {
            log::info($th);
            return false;
        }
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
        try {
            RegistroARTS::create($request->all());
            return true;
        } catch (\Throwable $th) {
            log::info($th);
            return false;
        }
    }

    public function RegistroARTAsoc(Request $request){
      try {
          RegistroARTS::create($request->all());
          return true;
      } catch (\Throwable $th) {
          log::info($th);
          return false;
      }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\registroARTS  $registroARTS
     * @return \Illuminate\Http\Response
     */
    public function show(registroARTS $registroARTS)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\registroARTS  $registroARTS
     * @return \Illuminate\Http\Response
     */
    public function edit(registroARTS $registroARTS)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\registroARTS  $registroARTS
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, registroARTS $registroARTS)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\registroARTS  $registroARTS
     * @return \Illuminate\Http\Response
     */
    public function destroy(registroARTS $registroARTS)
    {
        //
    }
}
