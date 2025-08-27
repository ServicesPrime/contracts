<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class BladeViewController extends Controller
{
    public function getPortada()
    {
        Log::info('BladeViewController::getPortada called');
        
        $filePath = resource_path('views/contracts/portada.blade.php');
        Log::info('File path: ' . $filePath);
        
        if (!file_exists($filePath)) {
            Log::error('File does not exist: ' . $filePath);
            return response()->json(['error' => 'Template not found'], 404);
        }
        
        Log::info('File exists, reading content...');
        $content = file_get_contents($filePath);
        Log::info('Content length: ' . strlen($content));
        
        return response()->json([
            'content' => $content,
            'file' => 'portada.blade.php'
        ]);
    }
}