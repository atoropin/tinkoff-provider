<?php

namespace TinkoffProvider\Requests;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Exception\ServerException;
use Illuminate\Http\JsonResponse;

class SmRegisterRequest
{
    private Client $client;

    protected string $baseUrl;

    protected string $username;

    protected string $password;

    protected array $parameters;

    /**
     * @param string $baseUrl
     * @param string $username
     * @param string $password
     * @param array $parameters
     */
    public function __construct(
        string $baseUrl,
        string $username,
        string $password,
        array  $parameters
    ) {
        $this->client = new Client();

        $this->baseUrl    = $baseUrl;
        $this->username   = $username;
        $this->password   = $password;
        $this->parameters = $parameters;
    }

    private function getAccessToken()
    {
        return (new SmRegisterTokenRequest($this->baseUrl, $this->username, $this->password))->get();
    }

    public function send()
    {
        try {
            return json_decode(
                (string) $this->client->post(
                    $this->baseUrl . '/register', [
                        'headers' => [
                            'Content-Type' => 'application/json',
                            'Authorization' => "Bearer {$this->getAccessToken()}"
                        ],
                        'body' => json_encode($this->parameters)
                    ]
                )
                    ->getBody()
                    ->getContents()
                , false
            );

        } catch (RequestException $e) {
            if ($e->hasResponse()) {
                return json_decode((string) $e->getResponse()->getBody());
            }
            else
                return json_decode((string) $e->getMessage());
        }
    }
}
