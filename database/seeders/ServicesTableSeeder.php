<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ServicesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $now = Carbon::now();

        // === Servicio 1: Daily Classroom Cleaning Process ===================
        $service1Id = DB::table('services')->insertGetId([
            'service'    => 'Daily Classroom Cleaning Process',
            'type'       => 'school',
            'created_at' => $now,
            'updated_at' => $now,
        ]);

        DB::table('service_specifications')->insert([
            ['description' => 'Trash Removal: Empty bins, replace liners, and disinfect.', 'area' => null, 'service_id' => $service1Id, 'created_at' => $now, 'updated_at' => $now],
            ['description' => 'High-Touch Surfaces: Disinfect desks, chairs, handles, and switches.', 'area' => null, 'service_id' => $service1Id, 'created_at' => $now, 'updated_at' => $now],
            ['description' => 'Board/Surfaces: Clean whiteboards and shared equipment.', 'area' => null, 'service_id' => $service1Id, 'created_at' => $now, 'updated_at' => $now],
            ['description' => 'Carpeted Areas: Vacuum and spot-clean stains.', 'area' => null, 'service_id' => $service1Id, 'created_at' => $now, 'updated_at' => $now],
            ['description' => 'BCT/Vinyl Floors: Sweep and damp mop with neutral cleaner.', 'area' => null, 'service_id' => $service1Id, 'created_at' => $now, 'updated_at' => $now],
            ['description' => 'Final Check: Ensure room is orderly, clean, and ready for use.', 'area' => null, 'service_id' => $service1Id, 'created_at' => $now, 'updated_at' => $now],
        ]);

        // === Servicio 2: Daily School Restroom Cleaning Process =============
        $service2Id = DB::table('services')->insertGetId([
            'service'    => 'Daily School Restroom Cleaning Process',
            'type'       => 'school',
            'created_at' => $now,
            'updated_at' => $now,
        ]);

        DB::table('service_specifications')->insert([
            ['description' => 'Trash Removal: Empty bins, replace liners, and disinfect receptacles.', 'area' => null, 'service_id' => $service2Id, 'created_at' => $now, 'updated_at' => $now],
            ['description' => 'High-Touch Surfaces: Disinfect handles, switches, dispensers, and faucets.', 'area' => null, 'service_id' => $service2Id, 'created_at' => $now, 'updated_at' => $now],
            ['description' => 'Toilets & Urinals: Clean and disinfect bowls, seats, and exterior surfaces.', 'area' => null, 'service_id' => $service2Id, 'created_at' => $now, 'updated_at' => $now],
            ['description' => 'Sinks & Counters: Clean and disinfect sinks, faucets, and counters.', 'area' => null, 'service_id' => $service2Id, 'created_at' => $now, 'updated_at' => $now],
            ['description' => 'Mirrors & Glass: Clean to remove spots and streaks.', 'area' => null, 'service_id' => $service2Id, 'created_at' => $now, 'updated_at' => $now],
            ['description' => 'Restocking: Refill soap, paper towels, and toilet paper. (Customer Provided)', 'area' => null, 'service_id' => $service2Id, 'created_at' => $now, 'updated_at' => $now],
            ['description' => 'Floors: Sweep and mop with disinfectant.', 'area' => null, 'service_id' => $service2Id, 'created_at' => $now, 'updated_at' => $now],
            ['description' => 'Final Check: Ensure restroom is clean, dry, and ready for use.', 'area' => null, 'service_id' => $service2Id, 'created_at' => $now, 'updated_at' => $now],
        ]);

        // === Servicio 3: Daily School Gymnasium Cleaning Process ============
        $service3Id = DB::table('services')->insertGetId([
            'service'    => 'Daily School Gymnasium Cleaning Process',
            'type'       => 'school',
            'created_at' => $now,
            'updated_at' => $now,
        ]);

        DB::table('service_specifications')->insert([
            ['description' => 'Trash Removal: Empty bins, replace liners, and disinfect receptacles.', 'area' => null, 'service_id' => $service3Id, 'created_at' => $now, 'updated_at' => $now],
            ['description' => 'High-Touch Surfaces: Disinfect door handles, railings, bleachers, and shared surfaces.', 'area' => null, 'service_id' => $service3Id, 'created_at' => $now, 'updated_at' => $now],
            ['description' => 'Sports Floors: Dust mop or sweep to remove debris; spot-clean spills; damp mop with neutral cleaner if needed.', 'area' => null, 'service_id' => $service3Id, 'created_at' => $now, 'updated_at' => $now],
            ['description' => 'Locker Rooms / Restrooms: Clean and disinfect toilets, urinals, sinks, benches, and showers; restock supplies; sweep and mop floors with disinfectant.', 'area' => null, 'service_id' => $service3Id, 'created_at' => $now, 'updated_at' => $now],
            ['description' => 'Final Check: Ensure gym and locker areas are clean, dry, and safe for use.', 'area' => null, 'service_id' => $service3Id, 'created_at' => $now, 'updated_at' => $now],
        ]);
    }
}
