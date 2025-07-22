<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contract extends Model
{
    use HasFactory;

    protected $fillable = [
        'contract_number',
        'client_id',
        'department',
        'date'
    ];

    protected $casts = [
        'date' => 'date'
    ];

    /**
     * Relación con Client
     */
    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    /**
     * Relación muchos a muchos con Service a través de la tabla pivote
     */
    public function services()
    {
        return $this->belongsToMany(Service::class, 'contract_services')
                    ->withPivot('quantity', 'unit_price', 'created_at', 'updated_at')
                    ->withTimestamps();
    }

    public function service()
{
    return $this->services()->first();
}
    /**
     * Relación directa con ContractService para acceso completo a la tabla pivote
     */
    public function contractServices()
    {
        return $this->hasMany(ContractService::class);
    }

    /**
     * Accessor para calcular el total automáticamente
     */
    public function getTotalAmountAttribute()
    {
        return $this->contractServices()->get()->sum(function($contractService) {
            return $contractService->quantity * $contractService->unit_price;
        });
    }

    /**
     * Método para recalcular el total del contrato
     */
    public function calculateTotal()
    {
        return $this->contractServices()->get()->sum(function($contractService) {
            return $contractService->quantity * $contractService->unit_price;
        });
    }

    /**
     * Método helper para agregar un servicio al contrato
     */
    public function addService($serviceId, $quantity = 1, $unitPrice = 0)
    {
        return ContractService::create([
            'contract_id' => $this->id,
            'service_id' => $serviceId,
            'quantity' => $quantity,
            'unit_price' => $unitPrice
        ]);
    }

    /**
     * Método helper para quitar un servicio del contrato
     */
    public function removeService($serviceId)
    {
        return $this->contractServices()
             ->where('service_id', $serviceId)
             ->delete();
    }

    /**
     * Boot method para cargar relaciones necesarias
     */
            // protected static function booted()
            // {
            //     static::addGlobalScope('with-relations', function ($query) {
            //         $query->with(['client.address', 'contractServices.service']);
            //     });
            // }
}