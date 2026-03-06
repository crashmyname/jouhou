<?php

namespace App\Controllers;

use App\Services\CFourMService;
use App\Services\LaneService;
use Bpjs\Framework\Helpers\BaseController;
use Bpjs\Core\Request;
use Bpjs\Framework\Helpers\Response;
use Bpjs\Framework\Helpers\Validator;
use Bpjs\Framework\Helpers\View;
use Bpjs\Framework\Helpers\CSRFToken;

class FourMController extends BaseController
{
    // Controller logic here
    public function __construct(protected CFourMService $c4MService, protected LaneService $laneService){}
    public function index()
    {
        $title = '4M';
        $lane = $this->laneService->all();
        return view('admin/4m',compact('title','lane'),'layout/app');
    }

    public function getData(Request $request)
    {
        if(!$request->isAjax()){
            return redirect('admin/4m');
        }
        $this->c4MService->getData([
            'filters' => $request->input('filters',[]) ?? [],
            'per_page' => $request->per_page ?? 10,
            'page' => $request->page ?? 1,
            'distinct' => $request->distinct ?? null
        ]);
    }

    public function get4mByLane(Request $request, $laneId, CFourMService $service)
    {
        if(!$request->isAjax()){
            return redirect('');
        }
        $result = $service->get4MByLane($laneId);
        return Response::json([
            'status' => $result['status'],
            'message' => $result['message'] ?? 'success',
            'data' => $result['data'] ?? null
        ], $result['status']);
    }

    public function store(Request $request)
    {
        $data = [
            'laneId' => $request->noLane,
            'man' => $request->man,
            'machine' => $request->machine,
            'material' => $request->material,
            'methode' => $request->methode,
        ];
        $result = $this->c4MService->create($data);
        return Response::json([
            'status' => $result['status'],
            'message' => $result['message'] ?? 'success',
            'data' => $result['data'] ?? null
        ], $result['status']);
    }

    public function update($id, Request $request)
    {
        $data = [
            'laneId' => $request->noLane,
            'man' => $request->man,
            'machine' => $request->machine,
            'material' => $request->material,
            'methode' => $request->methode,
        ];
        $result = $this->c4MService->update($id,$data);
        return Response::json([
            'status' => $result['status'],
            'message' => $result['message'] ?? 'success',
            'data' => $result['data'] ?? null
        ], $result['status']);
    }

    public function destroy($id)
    {
        $result = $this->c4MService->destroy($id);
        return Response::json([
            'status' => $result['status'],
            'message' => $result['message'] ?? 'success',
            'data' => $result['data'] ?? null
        ], $result['status']);
    }
}
