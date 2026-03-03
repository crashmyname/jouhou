<?php

namespace App\Controllers;

use App\Services\CosService;
use Bpjs\Framework\Helpers\BaseController;
use Bpjs\Core\Request;
use Bpjs\Framework\Helpers\Response;
use Bpjs\Framework\Helpers\Validator;
use Bpjs\Framework\Helpers\View;
use Bpjs\Framework\Helpers\CSRFToken;

class COSController extends BaseController
{
    // Controller logic here
    public function index()
    {
        $title = 'Customer Outflow Situation';
        return view('admin/customer_outflow_situation',compact('title'),'layout/app');
    }

    public function getData()
    {

    }

    public function store(Request $request, CosService $service)
    {
        $data = [
            'laneId' => $request->noLane,
            'noMcLane' => $request->noMcLane,
            'date' => $request->date,
            'typeModel' => $request->typeModel,
            'zeroClaim' => $request->zeroClaim,
            'lasClaim' => $request->lasClaim,
        ];
        $result = $service->create($data);
        return Response::json([
            'status' => $result['status'],
            'message' => $result['message'] ?? 'success',
            'data' => $result['data'] ?? null
        ], $result['status']);
    }

    public function update($id, Request $request, CosService $service)
    {
        $data = [
            'laneId' => $request->noLane,
            'noMcLane' => $request->noMcLane,
            'date' => $request->date,
            'typeModel' => $request->typeModel,
            'zeroClaim' => $request->zeroClaim,
            'lasClaim' => $request->lasClaim,
        ];
        $result = $service->update($id,$data);
        return Response::json([
            'status' => $result['status'],
            'message' => $result['message'] ?? 'success',
            'data' => $result['data'] ?? null
        ], $result['status']);
    }

    public function destroy($id, CosService $service)
    {
        $result = $service->destroy($id);
        return Response::json([
            'status' => $result['status'],
            'message' => $result['message'] ?? 'success',
            'data' => $result['data'] ?? null
        ], $result['status']);
    }
}
