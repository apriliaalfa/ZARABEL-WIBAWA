<?php

namespace App\Services;

use Exception;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class MidtransService
{
    protected string $serverKey;
    protected string $clientKey;
    protected bool $isProduction;
    protected string $snapUrl;

    public function __construct()
    {
        $this->serverKey = config('services.midtrans.server_key', env('MIDTRANS_SERVER_KEY', ''));
        $this->clientKey = config('services.midtrans.client_key', env('MIDTRANS_CLIENT_KEY', ''));
        $this->isProduction = (bool) config('services.midtrans.is_production', env('MIDTRANS_IS_PRODUCTION', false));
        
        $this->snapUrl = $this->isProduction
            ? 'https://app.midtrans.com/snap/v1/transactions'
            : 'https://app.sandbox.midtrans.com/snap/v1/transactions';
    }

    public function getClientKey(): string
    {
        return $this->clientKey;
    }

    public function getSnapJsUrl(): string
    {
        return $this->isProduction
            ? 'https://app.midtrans.com/snap/snap.js'
            : 'https://app.sandbox.midtrans.com/snap/snap.js';
    }

    /**
     * Create Snap Token from Midtrans API
     */
    public function createSnapToken(array $params): string
    {
        if (empty($this->serverKey)) {
            throw new Exception('Midtrans Server Key belum diatur di file .env');
        }

        $authHeader = 'Basic ' . base64_encode($this->serverKey . ':');

        $response = Http::withHeaders([
            'Content-Type' => 'application/json',
            'Accept' => 'application/json',
            'Authorization' => $authHeader,
        ])->post($this->snapUrl, $params);

        if ($response->successful()) {
            $data = $response->json();
            return $data['token'] ?? '';
        }

        Log::error('Midtrans Snap Error', [
            'status' => $response->status(),
            'body' => $response->body(),
            'params' => $params,
        ]);

        throw new Exception('Midtrans Error: ' . ($response->json('error_messages')[0] ?? $response->body()));
    }

    /**
     * Verify payment status directly with Midtrans
     */
    public function verifyStatus(string $orderId): array
    {
        $statusUrl = $this->isProduction
            ? "https://api.midtrans.com/v2/{$orderId}/status"
            : "https://api.sandbox.midtrans.com/v2/{$orderId}/status";

        $authHeader = 'Basic ' . base64_encode($this->serverKey . ':');

        $response = Http::withHeaders([
            'Content-Type' => 'application/json',
            'Accept' => 'application/json',
            'Authorization' => $authHeader,
        ])->get($statusUrl);

        return $response->json() ?? [];
    }
}
