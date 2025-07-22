<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContractService extends Model
{
    use HasFactory;

    // SOLO los campos que EXISTEN en tu migración
    protected $fillable = [
        'contract_id',
        'service_id',
        'quantity', 
        'unit_price'
        // NO incluir 'subtotal' porque no existe en la tabla
    ];

    protected $casts = [
        'quantity' => 'integer',
        'unit_price' => 'decimal:2'
    ];

    public function contract()
    {
        return $this->belongsTo(Contract::class);
    }

    public function service()
    {
        return $this->belongsTo(Service::class);
    }

    // SOLO accessor para calcular subtotal dinámicamente (no mutator)
    public function getSubtotalAttribute()
    {
        return $this->quantity * $this->unit_price;
    }

    // NO tengas ningún mutator setSubtotalAttribute() 
    // NO tengas ningún boot() method que modifique subtotal
}