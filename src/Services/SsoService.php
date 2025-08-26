<?php

namespace AlfaQosry\SsoClient\Services;

use Illuminate\Support\Facades\Http;

class SsoService
{
    protected $baseUrl;
    protected $clientId;
    protected $clientSecret;
    protected $redirectUri;

    public function __construct()
    {
        $this->baseUrl = config('services.sso.base_url');
        $this->clientId = config('services.sso.client_id');
        $this->clientSecret = config('services.sso.client_secret');
        $this->redirectUri = config('services.sso.redirect');
    }

    public function getAccessToken($code)
    {
        $response = Http::asForm()->post($this->baseUrl . '/oauth/token', [
            'grant_type'    => 'authorization_code',
            'client_id'     => $this->clientId,
            'client_secret' => $this->clientSecret,
            'redirect_uri'  => $this->redirectUri,
            'code'          => $code,
        ]);

        return $response->json();
    }

    public function getUserInfo($token)
    {
        $response = Http::withToken($token)->get($this->baseUrl . '/api/user');

        return $response->json();
    }
}
