<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class PaystackService
{
    protected string $baseUrl;

    protected string $privateKey;

    public function __construct()
    {
        $this->baseUrl();
        $this->privateKey();
    }

    public function getAllPlans(): array
    {
        $response = Http::acceptJson()
            ->withToken($this->privateKey)
            ->get("{$this->baseUrl}/plan");

        return $response->json()['data'];
    }

    public function getPlan(string $planId): array
    {
        $response = Http::acceptJson()
            ->withToken($this->privateKey)
            ->get("{$this->baseUrl}/plan/{$planId}");

        return $response->json()['data'];
    }

    private function baseUrl(): void
    {
        $this->baseUrl = 'https://api.paystack.co';
    }

    private function privateKey(): void
    {
        $this->privateKey = config('services.paystack.secret_key');
    }
}