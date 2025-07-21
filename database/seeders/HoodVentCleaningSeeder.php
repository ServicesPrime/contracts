<?php


namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Service;
use App\Models\ServiceSpecification;

class HoodVentCleaningSeeder extends Seeder
{
    public function run()
    {
        // Crear el servicio principal
        $hoodVentService = Service::create([
            'service' => 'Hood Vent Cleaning',
            'type' => 'service'
        ]);

        // Crear las especificaciones del servicio
        $specifications = [
            'Complete hood system cleaning to bare metal in accordance with NFPA-96 standards',
            'Filter removal, cleaning, and reinstallation',
            'Ductwork and vertical riser cleaning', 
            'Exhaust fan cleaning and inspection',
            'Special attention to UV systems where applicable',
            'Specialized cleaning for wood burning equipment areas',
            'Ventless hood systems receive comprehensive cleaning of all components',
            'Photo documentation before and after service',
            'Detailed service report provided'
        ];

        foreach ($specifications as $specification) {
            ServiceSpecification::create([
                'service_id' => $hoodVentService->id,
                'description' => $specification
            ]);
        }
    }
}
