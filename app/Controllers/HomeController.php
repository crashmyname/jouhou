<?php

namespace App\Controllers;

use App\Services\LaneService;
use Bpjs\Framework\Helpers\BaseController;
use Bpjs\Core\Request;
use Bpjs\Framework\Helpers\Validator;
use Bpjs\Framework\Helpers\View;
use Bpjs\Framework\Helpers\CSRFToken;

class HomeController extends BaseController
{
    // Controller logic here
    public function __construct(protected LaneService $laneService){}
    public function index()
    {
        $title = 'JOUHOU BOARD';
        $lane = $this->laneService->all();
        return view('home/home',compact('title','lane'));
    }
}
