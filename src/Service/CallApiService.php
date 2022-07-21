<?php

namespace App\Service;

use Symfony\Contracts\HttpClient\HttpClientInterface;

class CallApiService
{
    private $apiCard;

    public function __construct(HttpClientInterface $apiCard)
    {
        $this->apiCard = $apiCard;
    }

    public function getCardData():array
    {
        $response = $this->apiCard->request(
            'GET',
            'https://api.magicthegathering.io/v1/cards'
        );

        return $response->toArray();
    }
}