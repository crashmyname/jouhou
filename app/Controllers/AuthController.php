<?php

namespace App\Controllers;

use App\Services\AuthService;
use Bpjs\Framework\Helpers\BaseController;
use Bpjs\Core\Request;
use Bpjs\Framework\Helpers\Response;
use Bpjs\Framework\Helpers\Validator;
use Bpjs\Framework\Helpers\View;
use Bpjs\Framework\Helpers\CSRFToken;

class AuthController extends BaseController
{
    // Controller logic here
    public function index()
    {
        $title = 'Login';
        return view('auth/login',compact('title'));
    }

    public function login(Request $request,AuthService $authService)
    {
        $results = $authService->onLogin($request->all());
        return Response::json([
            'status' => $results['status'],
            'message' => $results['message'] ?? 'success',
            'data' => $results['data'] ?? null
        ],$results['status']);
    }

    public function logout(AuthService $authService)
    {
        $authService->logout();
    }
}
