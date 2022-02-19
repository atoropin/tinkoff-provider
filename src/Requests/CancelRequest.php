<?php

namespace TinkoffProvider\Requests;

use GuzzleHttp\Client;

class CancelRequest
{
    private Client $client;

    protected string $baseUrl;

    protected array $parameters;

    /**
     * @param string $baseUrl
     * @param array $parameters
     */
    public function __construct(
        string $baseUrl,
        array  $parameters
    ) {
        $this->client = new Client();

        $this->baseUrl    = $baseUrl;
        $this->parameters = $parameters;
    }

    public function send()
    {
        return json_decode(
            (string)$this->client->post(
                $this->baseUrl . '/Cancel', [
                    'headers' => [
                        'Content-Type' => 'application/json'
                    ],
                    'body' => json_encode($this->parameters)
                ]
            )
                ->getBody()
                ->getContents()
            , false
        );
    }
}
