<?php

namespace App\Services;
use App\Repository\LaneRepository;
use Bpjs\Framework\Helpers\TablePlus;
use Bpjs\Framework\Helpers\Validator;

class LaneService
{
    // Service logic here
    public function __construct(protected LaneRepository $repo){}

    public function all()
    {
        return $this->repo->all();
    }

    public function getData(array $data)
    {
        return TablePlus::of('lane')
                        ->select('noLane','description','laneId')
                        ->searchable(['noLane','description'])
                        ->filters($data['filters'] ?? [])
                        ->orderBy('laneId','ASC')
                        ->paginate($data['per_page'] ?? 10, $data['page'] ?? 1)
                        ->handleDistinct($data['distinct'] ?? null)
                        ->make();
    }

    public function create(array $data)
    {
        $lane = $this->repo->createLane($data);
        if($lane){
            return [
                'success' => true,
                'status' => 200,
                'message' => 'success create lane',
                'data' => $data
            ];
        }
    }

    public function update($id, array $data)
    {
        $lane = $this->repo->updateLane($id, $data);
        if($lane){
            return [
                'success' => true,
                'status' => 200,
                'message' => 'success update lane',
                'data' => $data
            ];
        }
    }

    public function destroy($id)
    {
        $lane = $this->repo->destroyLane($id);
        if($lane){
            return [
                'success' => true,
                'status' => 200,
                'message' => 'success delete lane'
            ];
        }
    }
}
