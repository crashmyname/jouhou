<?php

namespace App\Services;
use App\Repository\CFourMRepository;
use Bpjs\Framework\Helpers\TablePlus;
use Bpjs\Framework\Helpers\Validator;

class CFourMService
{
    // Service logic here
    public function __construct(protected CFourMRepository $c4mRepository, protected UtilService $utilService){}
    public function getData(array $data)
    {
        return TablePlus::of('c_4m')
                        ->select('noLane','description','c4mId','man','machine','material','methode','c_4m.laneId')
                        ->leftJoin('lane','lane.laneId','=','c_4m.laneId')
                        ->searchable(['noLane','description','man','machine','material','methode'])
                        ->filters($data['filters'] ?? [])
                        ->orderBy('c4mId','ASC')
                        ->paginate($data['per_page'] ?? 10, $data['page'] ?? 1)
                        ->handleDistinct($data['distinct'] ?? null)
                        ->make();
    }

    public function get4MByLane($id)
    {
        $fourm = $this->c4mRepository->get4MByLaneId($id);
        if($fourm){
            return [
                'success' => true,
                'status' => 200,
                'message' => 'success get data',
                'data' => $fourm
            ];
        }
    }
    public function create(array $data): array
    {
        if($this->c4mRepository->C4MisExists($data['laneId'])){
            return [
                'success' => false,
                'status' => 422,
                'message' => 'Change 4M already exist'
            ];
        }
        $c4m = $this->c4mRepository->create4M($data);
        if($c4m){
            return [
                'success' => true,
                'status' => 200,
                'message' => 'Change 4M success create',
                'data' => $c4m
            ];
        }
        return [
            'success' => false,
            'status' => 500,
            'message' => 'Failed to create Change 4M'
        ];
    }

    public function update($id, array $data): array
    {
        $fourm = $this->c4mRepository->update4M($id,$data);
        if($fourm){
            return [
                'success' => true,
                'status' => 200,
                'message' => 'Change 4M success update',
                'data' => $fourm
            ];
        }
        return [
            'success' => false,
            'status' => 500,
            'message' => 'Failed to Change 4M'
        ];
    }

    public function destroy($id)
    {
        $fourm = $this->c4mRepository->destroy4M($id);
        if($fourm){
            return [
                'success' => true,
                'status' => 200,
                'message' => 'Change 4M success delete'
            ];
        }
    }
}
