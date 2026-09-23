<?php

namespace App\Http\Controllers;

use App\Services\DevService;

class DevController extends Controller
{
    protected DevService $devService;

    public function __construct(DevService $devService)
    {
        $this->devService = $devService;
    }

    public function clearCache()
    {
        $result = $this->devService->clearApplicationCaches();

        return response()->json([
            'success' => $result['success'],
            'message' => $result['message'],
            'results' => $result['results'],
        ], $result['success'] ? 200 : 500);
    }
}
