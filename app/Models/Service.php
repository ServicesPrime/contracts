<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
  use HasFactory;

  protected $fillable = [
    'service',  // Primero service (como en la migración)
    'type',     // Después type
  ];

  public function specifications()
  {
    return $this->hasMany(ServiceSpecification::class);
  }
}
