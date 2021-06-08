<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class registroARTS extends Model
{
    protected $table = 'registroarts';

    protected $dates = ['updated_at'];

    protected $fillable = [
        'idART',
        'fechaART',
        'fechaFactura',
        'idProveedor',
        'idSolicitante',
        'idEjecutor',
        'idItemPresupuestario',
        'idTipoMantencion',
        'idRecurso',
        'idTipoCompra',
        'idLicitacion',
        'idResLlamado',
        'idResAdjudicacion',
        'idResContrato',
        'idCDP',
        'idOrdenCompra',
        'idResInterna',
        'idMemo',
        'monto','cuotas','saldo',
        'uuid',
        'nfactura',
        'detalleART',
        'vpresupuesto',
        'ntotalcuotas',
        'idSegART',
        'idEstado'
    ];
}
