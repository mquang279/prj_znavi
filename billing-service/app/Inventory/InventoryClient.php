<?php

namespace App\Inventory;

use App\Exceptions\InventoryException;
use Carbon\Carbon;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7\HttpFactory;
use Illuminate\Support\Str;
class InventoryClient
{
    private Client $client;
    public function __construct(){
        $this->client = new Client(
            [
//                'base_uri'=> config('services.inventory.base_uri'),
                'base_uri'=>'http://inventory-service',
                'timeout'=>10,
            ]
        );
    }
    public function reserve(array $payload, string $requestId)
    {
        try {
            if (!Str::isUuid($requestId)) {
                $requestId = (string) Str::uuid();
            }
            $response= $this->client->post('/api/reservations/reserve', [
                'headers' => [
                    'x-request-id' => $requestId,
                    'Content-Type' => 'application/json',
                ],
                'json' => $payload,
            ]);
            return json_decode($response->getBody()->getContents());
        } catch (RequestException $e) {
            throw new InventoryException(
                'INVENTORY_SERVICE_ERROR',
                'Inventory service not available',
                [
                    'message' => $e->getMessage(),
                    'response' => optional($e->getResponse())->getBody()?->getContents(),
                ]
            );
        }
    }

    public function commit(string $requestId){
        return [
          'requestId' => $requestId,
          'billId' => 'billId',
          'status' => 'CONFIRMED',
        ];
    }
}
