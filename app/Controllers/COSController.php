<?php

namespace App\Controllers;

use App\Services\CosService;
use App\Services\LaneService;
use Bpjs\Framework\Helpers\BaseController;
use Bpjs\Core\Request;
use Bpjs\Framework\Helpers\Response;
use Bpjs\Framework\Helpers\Validator;
use Bpjs\Framework\Helpers\View;
use Bpjs\Framework\Helpers\CSRFToken;

class COSController extends BaseController
{
    // Controller logic here
    public function index(LaneService $laneService)
    {
        $title = 'Customer Outflow Situation';
        $lane = $laneService->all();
        return view('admin/customer_outflow_situation',compact('title','lane'),'layout/app');
    }

    public function getData(Request $request, CosService $service)
    {
        if(!$request->isAjax()){
            return redirect('admin/cos');
        }
        $service->getData([
            'filters' => $request->input('filters',[]) ?? [],
            'per_page' => $request->per_page ?? 10,
            'page' => $request->page ?? 1,
            'distinct' => $request->distinct ?? null
        ]);
    }

    public function getCosByLane(Request $request, $laneId, CosService $service)
    {
        if(!$request->isAjax()){
            return redirect('');
        }
        $result = $service->getCosByLane($laneId);
        return Response::json([
            'status' => $result['status'],
            'message' => $result['message'] ?? 'success',
            'data' => $result['data'] ?? null
        ], $result['status']);
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
