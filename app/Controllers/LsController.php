<?php

namespace App\Controllers;

use App\Services\LaneService;
use App\Services\LayoutService;
use Bpjs\Framework\Helpers\BaseController;
use Bpjs\Core\Request;
use Bpjs\Framework\Helpers\Response;
use Bpjs\Framework\Helpers\Validator;
use Bpjs\Framework\Helpers\View;
use Bpjs\Framework\Helpers\CSRFToken;

class LsController extends BaseController
{
    // Controller logic here
    public function __construct(protected LayoutService $layoutService, protected LaneService $laneService){}
    public function index()
    {
        $title = 'Layout Sheet';
        $lane = $this->laneService->all();
        return view('admin/layout_sheet',compact('title','lane'),'layout/app');
    }

    public function getLayoutByLane(Request $request, $laneId, LayoutService $service)
    {
        if(!$request->isAjax()){
            return redirect('');
        }
        $result = $service->getLayoutByLane($laneId);
        return Response::json([
            'status' => $result['status'],
            'message' => $result['message'] ?? 'success',
            'data' => $result['data'] ?? null
        ], $result['status']);
    }

    public function getData(Request $request, LayoutService $service)
    {
        if(!$request->isAjax()){
            return redirect('admin/layout-sheet');
        }
        $service->getData([
            'filters' => $request->input('filters',[]) ?? [],
            'per_page' => $request->per_page ?? 10,
            'page' => $request->page ?? 1,
            'distinct' => $request->distinct ?? null
        ]);
    }

    public function store(Request $request)
    {
        $data = [
            'laneId' => $request->noLane,
            'image' => $request->getClientOriginalName('image')
        ];
        $result = $this->layoutService->create($data,$request->file('image'));
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
            'image' => $request->getClientOriginalName('image') ?? null
        ];
        $result = $this->layoutService->update($id,$data, $request->file('image'));
        return Response::json([
            'status' => $result['status'],
            'message' => $result['message'] ?? 'success',
            'data' => $result['data'] ?? null
        ], $result['status']);
    }

    public function destroy($id)
    {
        $result = $this->layoutService->destroy($id);
        return Response::json([
            'status' => $result['status'],
            'message' => $result['message'] ?? 'success',
            'data' => $result['data'] ?? null
        ], $result['status']);
    }
}
