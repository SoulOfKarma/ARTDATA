<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RepositorioDocumentaciones extends Model
{
    protected $fillable = [
        'idART','descripcionDocumento', 'nombreDocumento' 
    ];
}
