<?php

namespace App\Controllers;

use App\Services\UserService;
use Bpjs\Framework\Helpers\BaseController;
use Bpjs\Core\Request;
use Bpjs\Framework\Helpers\Response;
use Bpjs\Framework\Helpers\Validator;
use Bpjs\Framework\Helpers\View;
use Bpjs\Framework\Helpers\CSRFToken;

class UserController extends BaseController
{
    // Controller logic here
    public function index()
    {
        $title = 'Management User';
        return view('admin/user',compact('title'),'layout/app');
    }

    public function getData(Request $request, UserService $userService)
    {
        if(!$request->isAjax()){
            return redirect('users');
        }
        $userService->getData([
            'filters' => $request->input('filters',[]) ?? [],
            'per_page' => $request->per_page ?? 10,
            'page' => $request->page ?? 1,
            'distinct' => $request->distinct ?? null
        ]);
    }

    public function store(Request $request,UserService $userService)
    {
        $result = $userService->create($request->all());
        return Response::json([
            'status' => $result['status'],
            'message' => $result['message'] ?? 'success',
            'data' => $result['data'] ?? null
        ], $result['status']);
    }

    public function update($id, Request $request, UserService $userService)
    {
        vd($request->all());
        $result = $userService->update($id,$request->all());
        return Response::json([
            'status' => $result['status'],
            'message' => $result['message'] ?? 'success',
            'data' => $result['data'] ?? null
        ], $result['status']);
    }

    public function destroy($id, UserService $userService)
    {
        $result = $userService->destroy($id);
        return Response::json([
            'status' => $result['status'],
            'message' => $result['message'] ?? 'success',
            'data' => $result['data'] ?? null
        ], $result['status']);
    }
}
