<?php

namespace App\Http\Controllers;

use App\Services\PaystackService;
use Illuminate\Http\Request;
use Illuminate\View\View;

class SubscriptionController extends Controller
{
    public function index(PaystackService $paystackService): View
    {
        $response = $paystackService->getAllPlans();

        $response = collect($response)->reject(fn($item) => $item['is_deleted']);

        return view('subscription.index', [
            'data' => $response
        ]);
    }

    public function getPlan(string $planCode, PaystackService $paystackService): View
    {
        $response = $paystackService->getPlan($planCode);

        return view('subscription.plan', [
            'data' => $response
        ]);
    }
}
