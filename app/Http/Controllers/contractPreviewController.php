<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\ContractPreviewService;

class ContractPreviewController extends Controller
{
    private ContractPreviewService $previewService;

    public function __construct(ContractPreviewService $previewService)
    {

        $this->previewService = $previewService;
    }

    public function preview(Request $request)
    {
        //dump($request);
        try {
            $html = $this->previewService->generatePreview($request->all());
            
            return $html;
            
        } catch (\Exception $e) {
            dump($e->getMessage());
            return response()->json([
                'error' => $e->getMessage()
            ], 500);
        }
    }
}