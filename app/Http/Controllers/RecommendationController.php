<?php

namespace App\Http\Controllers;

use App\Service\Recommendation;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

class RecommendationController extends Controller
{
    private Recommendation $recommendService;

    public function __construct(Recommendation $recommendService)
    {
        $this->recommendService = $recommendService;
    }

    /**
     * Show the profile for a given user.
     */
    public function list(string $productId): JsonResponse
    {
        $products = $this->recommendService->getByProductId($productId);
        return response()->json(['products' => $products]);
    }
}
