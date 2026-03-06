<?php

namespace App\Controllers;

use App\Services\LaneService;
use App\Services\PointService;
use Bpjs\Framework\Helpers\BaseController;
use Bpjs\Core\Request;
use Bpjs\Framework\Helpers\Response;
use Bpjs\Framework\Helpers\Validator;
use Bpjs\Framework\Helpers\View;
use Bpjs\Framework\Helpers\CSRFToken;

class PointSkillController extends BaseController
{
    // Controller logic here
    public function __construct(protected PointService $pointService, protected LaneService $laneService){}
    public function index()
    {
        $title = 'Point Skill';
        $lane = $this->laneService->all();
        return view('admin/point-skill',compact('title','lane'),'layout/app');
    }

    public function getData(Request $request)
    {
        if(!$request->isAjax()){
            return redirect('admin/point-skill');
        }
        $this->pointService->getData([
            'filters' => $request->input('filters',[]) ?? [],
            'per_page' => $request->per_page ?? 10,
            'page' => $request->page ?? 1,
            'distinct' => $request->distinct ?? null
        ]);
    }

    public function getPointByLane(Request $request, $laneId)
    {
        if(!$request->isAjax()){
            return redirect('');
        }
        $result = $this->pointService->getPointByLane($laneId);
        return Response::json([
            'status' => $result['status'],
            'message' => $result['message'] ?? 'success',
            'data' => $result['data'] ?? null
        ], $result['status']);
    }

    public function store(Request $request)
    {
        // vd($request->all());
        $data = [
            'laneId' => $request->noLane,
            'empName' => $request->empName,
            'empNik' => $request->empNik,
            'profil' => $request->getClientOriginalName('profil'),
            'pointSkill' => $request->pointSkill,
            'pointSkill2' => $request->pointSkill2,
        ];
        $result = $this->pointService->create(
            $data,
            $request->file('profil'),
            $request->photo_url);
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
            'empName' => $request->empName,
            'empNik' => $request->empNik,
            'profil' => $request->getClientOriginalName('profil'),
            'pointSkill' => $request->pointSkill,
            'pointSkill2' => $request->pointSkill2,
        ];
        $result = $this->pointService->update($id,$data,$request->file('profil'));
        return Response::json([
            'status' => $result['status'],
            'message' => $result['message'] ?? 'success',
            'data' => $result['data'] ?? null
        ], $result['status']);
    }

    public function destroy($id)
    {
        $result = $this->pointService->destroy($id);
        return Response::json([
            'status' => $result['status'],
            'message' => $result['message'] ?? 'success',
            'data' => $result['data'] ?? null
        ], $result['status']);
    }
}
