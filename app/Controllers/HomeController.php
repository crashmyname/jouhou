<?php

namespace App\Controllers;

use App\Services\CFourMService;
use App\Services\CosService;
use App\Services\LaneService;
use App\Services\LayoutService;
use App\Services\PointService;
use Bpjs\Framework\Helpers\BaseController;
use Bpjs\Core\Request;
use Bpjs\Framework\Helpers\Response;
use Bpjs\Framework\Helpers\Validator;
use Bpjs\Framework\Helpers\View;
use Bpjs\Framework\Helpers\CSRFToken;

class HomeController extends BaseController
{
    // Controller logic here
    public function __construct(protected LaneService $laneService, protected CFourMService $fourmService, protected LayoutService $layoutService, protected CosService $cosService, protected PointService $pointService){}
    public function index()
    {
        $title = 'JOUHOU BOARD';
        $lane = $this->laneService->all();
        return view('home/home',compact('title','lane'));
    }

    public function dashboard(Request $request,$laneId)
    {
        if(!$request->isAjax()){
            return redirect('');
        }
        $fourm = $this->fourmService->get4MByLane($laneId);
        $cos = $this->cosService->getCosByLane($laneId);
        $layout = $this->layoutService->getLayoutByLane($laneId);
        $point = $this->pointService->getPointByLane($laneId);
        return Response::json([
            'status' => 200,
            'message' => 'success',
            'data' => [
                'cos' => $cos['data'] ?? null,
                'layout' => $layout['data'] ?? null,
                'fourm' => $fourm['data'] ?? null,
                'point' => $point['data'] ?? null,
            ]
        ], 200);
    }
}
