<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContractSchool extends Model
{
    use HasFactory;

    protected $fillable = [
        'contract_id',
        'percentage',
        'work_days',
        'labor_cost',
        'chemical_cost',
        'frequency'
    ];

    protected $casts = [
        'percentage' => 'decimal:2',
        'labor_cost' => 'decimal:2',
        'chemical_cost' => 'decimal:2'
    ];

    /**
     * Relación con Contract
     */
    public function contract()
    {
        return $this->belongsTo(Contract::class);
    }

    /**
     * Accessor para calcular el total de costos
     */
    public function getTotalCostAttribute()
    {
        return $this->labor_cost + $this->chemical_cost;
    }

    /**
     * Accessor para formatear el porcentaje
     */
    public function getFormattedPercentageAttribute()
    {
        return number_format($this->percentage, 2) . '%';
    }

    /**
     * Accessor para formatear el costo de labor
     */
    public function getFormattedLaborCostAttribute()
    {
        return '$' . number_format($this->labor_cost, 2);
    }

    /**
     * Accessor para formatear el costo de químicos
     */
    public function getFormattedChemicalCostAttribute()
    {
        return '$' . number_format($this->chemical_cost, 2);
    }

    /**
     * Accessor para formatear el costo total
     */
    public function getFormattedTotalCostAttribute()
    {
        return '$' . number_format($this->total_cost, 2);
    }

    /**
     * Método para calcular el costo mensual estimado
     */
    public function calculateMonthlyCost()
    {
        // Lógica para calcular basado en la frecuencia
        // Esto dependerá de cómo interpretes el campo frequency
        
        if (str_contains(strtolower($this->frequency), 'monthly')) {
            return $this->total_cost;
        }
        
        // Puedes agregar más lógica aquí según tus necesidades
        return $this->total_cost;
    }

    /**
     * Scope para filtrar por rango de costos
     */
    public function scopeByLaborCostRange($query, $min, $max)
    {
        return $query->whereBetween('labor_cost', [$min, $max]);
    }

    public function scopeByChemicalCostRange($query, $min, $max)
    {
        return $query->whereBetween('chemical_cost', [$min, $max]);
    }

    public function scopeByTotalCostRange($query, $min, $max)
    {
        return $query->whereRaw('(labor_cost + chemical_cost) BETWEEN ? AND ?', [$min, $max]);
    }

    /**
     * Scope para filtrar por días de trabajo
     */
    public function scopeByWorkDays($query, $workDays)
    {
        return $query->where('work_days', 'like', "%{$workDays}%");
    }

    /**
     * Boot method para validaciones adicionales
     */
    protected static function booted()
    {
        static::creating(function ($contractSchool) {
            // Validar que el porcentaje esté entre 0 y 100
            if ($contractSchool->percentage < 0 || $contractSchool->percentage > 100) {
                throw new \Exception('Percentage must be between 0 and 100');
            }

            // Validar que los costos sean positivos
            if ($contractSchool->labor_cost < 0 || $contractSchool->chemical_cost < 0) {
                throw new \Exception('Costs must be positive values');
            }
        });

        static::updating(function ($contractSchool) {
            // Mismas validaciones para updates
            if ($contractSchool->percentage < 0 || $contractSchool->percentage > 100) {
                throw new \Exception('Percentage must be between 0 and 100');
            }

            if ($contractSchool->labor_cost < 0 || $contractSchool->chemical_cost < 0) {
                throw new \Exception('Costs must be positive values');
            }
        });
    }
}