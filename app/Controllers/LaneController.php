<?php

namespace App\Controllers;

use App\Services\LaneService;
use Bpjs\Framework\Helpers\BaseController;
use Bpjs\Core\Request;
use Bpjs\Framework\Helpers\Response;
use Bpjs\Framework\Helpers\Validator;
use Bpjs\Framework\Helpers\View;
use Bpjs\Framework\Helpers\CSRFToken;

class LaneController extends BaseController
{
    // Controller logic here
    public function __construct(protected LaneService $service){}
    public function index()
    {
        $title = 'Management Lane';
        return view('admin/lane',compact('title'),'layout/app');
    }
    public function getData(Request $request)
    {
        if(!$request->isAjax()){
            return redirect('admin/lane');
        }
        $this->service->getData([
            'filters' => $request->input('filters',[]) ?? [],
            'per_page' => $request->per_page ?? 10,
            'page' => $request->page ?? 1,
            'distinct' => $request->distinct ?? null
        ]);
    }
    public function store(Request $request)
    {
        $data = [
            'noLane' => $request->noLane,
            'description' => $request->description,
        ];
        $result = $this->service->create($data);
        return Response::json([
            'status' => $result['status'],
            'message' => $result['message'] ?? 'success',
            'data' => $result['data'] ?? null
        ], $result['status']);
    }

    public function update($id, Request $request)
    {
        $data = [
            'noLane' => $request->noLane,
            'description' => $request->description
        ];
        $result = $this->service->update($id, $data);
        return Response::json([
            'status' => $result['status'],
            'message' => $result['message'] ?? 'success',
            'data' => $result['data'] ?? null
        ], $result['status']);
    }

    public function destroy($id)
    {
        $result = $this->service->destroy($id);
        return Response::json([
            'status' => $result['status'],
            'message' => $result['message'] ?? 'success',
            'data' => $result['data'] ?? null
        ], $result['status']);
    }
}
