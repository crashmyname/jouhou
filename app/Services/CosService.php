<?php

namespace App\Services;
use App\Repository\CosRepository;
use Bpjs\Framework\Helpers\TablePlus;
use Bpjs\Framework\Helpers\Validator;

class CosService
{
    // Service logic here
    public function __construct(protected CosRepository $cosRepo, protected UtilService $utilService){}
    public function getData(array $data)
    {
        return TablePlus::of('c_o_situation')
                        ->select('noLane','description','cosId','noMcLane','date','typeModel','zeroClaim','lasClaim','c_o_situation.laneId')
                        ->leftJoin('lane','lane.laneId','=','c_o_situation.laneId')
                        ->searchable(['noLane','description','noMcLane','date','typeModel','zeroClaim','lasClaim'])
                        ->filters($data['filters'] ?? [])
                        ->orderBy('cosId','ASC')
                        ->paginate($data['per_page'] ?? 10, $data['page'] ?? 1)
                        ->handleDistinct($data['distinct'] ?? null)
                        ->make();
    }

    public function getCosByLane($id)
    {
        $cos = $this->cosRepo->getCosByLaneId($id);
        if($cos){
            return [
                'success' => true,
                'status' => 200,
                'message' => 'success get data',
                'data' => $cos
            ];
        }
    }

    public function create(array $data)
    {
        if($this->cosRepo->cosIsExists($data['laneId'])){
            return [
                'success' => false,
                'status' => 422,
                'message' => 'Customer Outflow already exist'
            ];
        }
        $cos = $this->cosRepo->createCos($data);
        if($cos){
            $this->utilService->sendRealtimeUpdate([
                'type' => 'cos-update',
                'laneId' => $data['laneId'],
                'noMcLane' => $data['noMcLane'],
                'date' => $data['date'],
                'typeModel' => $data['typeModel'],
                'zeroClaim' => $data['zeroClaim'],
                'lasClaim' => $data['lasClaim']
            ]);
            return [
                'success' => true,
                'status' => 200,
                'message' => 'success create',
                'data' => $cos
            ];
        }
    }

    public function update($id, array $data)
    {
        $cos = $this->cosRepo->updateCos($id,$data);
        if($cos){
            $this->utilService->sendRealtimeUpdate([
                'type' => 'cos-update',
                'laneId' => $data['laneId'],
                'noMcLane' => $data['noMcLane'],
                'date' => $data['date'],
                'typeModel' => $data['typeModel'],
                'zeroClaim' => $data['zeroClaim'],
                'lasClaim' => $data['lasClaim']
            ]);
            return [
                'success' => true,
                'status' => 200,
                'message' => 'success update',
                'data' => $cos
            ];
        }
    }

    public function destroy($id)
    {
        $cos = $this->cosRepo->deleteCos($id);
        if($cos){
            return [
                'success' => true,
                'status' => 200,
                'message' => 'success delete',
                'data' => $cos
            ];
        }
    }
}
