<?php

namespace TinkoffProvider\Requests;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Arr;

class SmRegisterTokenRequest
{
    private Client $client;

    private ?string $accessToken = null;

    protected string $baseUrl;

    protected string $username;

    protected string $password;

    public function __construct(
        string $baseUrl,
        string $username,
        string $password
    )
    {
        $this->client = new Client();

        $this->baseUrl  = $baseUrl;
        $this->username = $username;
        $this->password = $password;
    }

    public function get(): ?string
    {
        if ($this->accessToken === null) {
            $this->accessToken = Arr::get($this->send(), 'access_token');
        }

        return $this->accessToken;
    }

    /**
     * Refresh access token.
     *
     * @return string
     */
    public function send()
    {
        return json_decode(
            (string) $this->client->post(
                $this->baseUrl . '/oauth/token', [
                    'auth' => [
                        'partner',
                        'partner'
                    ],
                    'form_params' => [
                        'grant_type' => 'password',
                        'username' => $this->username,
                        'password' => $this->password
                    ]
                ]
            )
                ->getBody()
                ->getContents()
            , true
        );
    }
}
