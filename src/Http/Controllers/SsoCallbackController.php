<?php

namespace AlfaQosry\SsoClient\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use AlfaQosry\SsoClient\Services\SsoService;

class SsoCallbackController extends Controller
{
    protected $ssoService;

    public function __construct(SsoService $ssoService)
    {
        $this->ssoService = $ssoService;
    }

    public function handle(Request $request)
    {
        $code = $request->get('code');

        // Tukar code dengan access token
        $tokenResponse = $this->ssoService->getAccessToken($code);

        // Ambil user info dari SSO server
        $userInfo = $this->ssoService->getUserInfo($tokenResponse['access_token']);

        // Simpan atau update user di local database
        $user = User::updateOrCreate(
            ['username' => $userInfo['username']],
            [
                'name'  => $userInfo['name'],
                'email' => $userInfo['email'],
            ]
        );

        // Login ke aplikasi client
        Auth::login($user);

        return redirect()->intended('/dashboard');
    }
}
