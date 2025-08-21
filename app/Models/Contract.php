<?php

// app/Models/Contract.php
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
        'date',
        'start_date',
        'end_date'
    ];

    protected $casts = [
        'date' => 'date',
        'start_date' => 'date',
        'end_date' => 'date'
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

    /**
     * Relación directa con ContractService para acceso completo a la tabla pivote
     */
    public function contractServices()
    {
        return $this->hasMany(ContractService::class);
    }

    /**
     * Relación con ContractSchool (solo para contratos tipo School)
     */
    public function contractSchool()
    {
        return $this->hasOne(ContractSchool::class);
    }

    /**
     * Accessor para obtener el tipo de contrato
     */
    public function getContractTypeAttribute()
    {
        return $this->contractSchool ? 'school' : 'jwo';
    }

    /**
     * Accessor para calcular el total automáticamente (solo para JWO)
     */
    public function getTotalAmountAttribute()
    {
        if ($this->contract_type === 'school') {
            return $this->contractSchool ? 
                ($this->contractSchool->labor_cost + $this->contractSchool->chemical_cost) : 0;
        }

        return $this->contractServices()->get()->sum(function($contractService) {
            return ($contractService->quantity ?? 0) * ($contractService->unit_price ?? 0);
        });
    }

    /**
     * Método para recalcular el total del contrato
     */
    public function calculateTotal()
    {
        return $this->total_amount;
    }

    /**
     * Método helper para agregar un servicio al contrato (solo JWO)
     */
    public function addService($serviceId, $quantity = 1, $unitPrice = 0)
    {
        if ($this->contract_type === 'school') {
            throw new \Exception('Cannot add services to school contracts');
        }

        return ContractService::create([
            'contract_id' => $this->id,
            'service_id' => $serviceId,
            'quantity' => $quantity,
            'unit_price' => $unitPrice
        ]);
    }

    /**
     * Método helper para quitar un servicio del contrato (solo JWO)
     */
    public function removeService($serviceId)
    {
        return $this->contractServices()
             ->where('service_id', $serviceId)
             ->delete();
    }

    /**
     * Scopes para filtrar por tipo de contrato
     */
    public function scopeSchoolContracts($query)
    {
        return $query->whereHas('contractSchool');
    }

    public function scopeJwoContracts($query)
    {
        return $query->whereDoesntHave('contractSchool');
    }

    /**
     * Método helper para determinar si es un contrato de escuela
     */
    public function isSchoolContract()
    {
        return $this->contractSchool !== null;
    }

    /**
     * Método helper para determinar si es un contrato JWO
     */
    public function isJwoContract()
    {
        return $this->contractSchool === null;
    }

    /**
     * Método para obtener la descripción del contrato
     */
    public function getDescriptionAttribute()
    {
        if ($this->isSchoolContract()) {
            return "School Contract - {$this->contractSchool->frequency}";
        }

        $serviceCount = $this->contractServices()->count();
        return "JWO Contract - {$serviceCount} service(s)";
    }

    /**
     * Método para obtener la duración del contrato
     */
    public function getDurationAttribute()
    {
        if ($this->start_date && $this->end_date) {
            $start = $this->start_date;
            $end = $this->end_date;
            $days = $start->diffInDays($end);
            
            if ($days == 0) {
                return 'Single day';
            } elseif ($days < 30) {
                return "{$days} days";
            } elseif ($days < 365) {
                $months = round($days / 30);
                return "{$months} month(s)";
            } else {
                $years = round($days / 365, 1);
                return "{$years} year(s)";
            }
        }

        return 'N/A';
    }
}
