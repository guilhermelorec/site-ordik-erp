<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Lead extends Model
{
    public const SEGMENTS = ['Loja ou varejo', 'Oficina ou assistência técnica', 'Distribuidora ou atacado', 'Outro segmento'];

    public const BRANCHES = ['1 unidade', '2 a 5 unidades', '6 a 10 unidades', 'Mais de 10 unidades'];

    // Mesmo ciclo de lead do CRM do Ordik.
    public const STATUSES = [
        'novo' => 'Novo',
        'contatado' => 'Contatado',
        'qualificado' => 'Qualificado',
        'convertido' => 'Convertido',
        'descartado' => 'Descartado',
    ];

    protected $fillable = ['name', 'company', 'email', 'whatsapp', 'segment', 'branches', 'message', 'source', 'status'];

    protected $attributes = ['status' => 'novo'];
}
