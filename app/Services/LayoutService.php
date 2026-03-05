<?php

namespace App\Services;
use App\Repository\LayoutSheetRepository;
use Bpjs\Framework\Helpers\TablePlus;
use Bpjs\Framework\Helpers\Validator;

class LayoutService
{
    // Service logic here
    public function __construct(protected LayoutSheetRepository $layoutRepository, protected UtilService $utilService){}
    public function getData(array $data)
    {
        return TablePlus::of('l_sheet')
                        ->select('noLane','description','lId','image','l_sheet.laneId')
                        ->leftJoin('lane','lane.laneId','=','l_sheet.laneId')
                        ->searchable(['noLane','description','image'])
                        ->addColumn('image_url', function($row){
                            return storage_secure('attachment/LayoutSheet/'.$row['image'],3600);
                        })
                        ->filters($data['filters'] ?? [])
                        ->orderBy('lId','ASC')
                        ->paginate($data['per_page'] ?? 10, $data['page'] ?? 1)
                        ->handleDistinct($data['distinct'] ?? null)
                        ->make();
    }

    public function getLayoutByLane($id)
    {
        $layout = $this->layoutRepository->getLayoutByLaneId($id);
        if($layout){
            return [
                'success' => true,
                'status' => 200,
                'message' => 'success get data',
                'data' => $layout
            ];
        } else {
            return [
                'success' => false,
                'status' => 404,
                'message' => 'data not found',
                'data' => 'data not found'
            ];
        }
    }
    public function create(array $data,$file)
    {
        if($this->layoutRepository->LayoutIsExists($data['laneId'])){
            return [
                'success' => false,
                'status' => 422,
                'message' => 'Layout Sheet already exist'
            ];
        }
        $layout = $this->layoutRepository->createLayout($data);
        if($layout){
            $this->utilService->upload($file,'LayoutSheet');
            return [
                'success' => true,
                'status' => 200,
                'message' => 'Layout Sheet success create',
                'data' => $layout
            ];
        }
    }

    public function update($id, array $data, $file)
    {
        $oldLayout = $this->layoutRepository->getById($id);
        $fileName = $oldLayout->image;
        if(isset($file) && !empty($file['name'])){
            $fileName = $file['name'];
            $this->utilService->upload($file,'LayoutSheet');
            if($oldLayout->image){
                $oldPath = storage_path('attachment/LayoutSheet/'.$oldLayout->image);
                if(file_exists($oldPath)){
                    unlink($oldPath);
                }
            }
        }
        $data['image'] = $fileName;
        $layout = $this->layoutRepository->updateLayout($id,$data);
        if($layout){
            return [
                'success' => true,
                'status' => 200,
                'message' => 'Layout Sheet success update',
                'data' => $layout
            ];
        }
    }

    public function destroy($id)
    {
        $oldLayout = $this->layoutRepository->getById($id);
        if($oldLayout->image){
            $oldPath = storage_path('attachment/LayoutSheet/'.$oldLayout->image);
            if(file_exists($oldPath)){
                unlink($oldPath);
            }
        }
        $layout = $this->layoutRepository->destroyLayout($id);
        if($layout){
            return [
                'success' => true,
                'status' => 200,
                'message' => 'Layout Sheet success delete'
            ];
        }
    }
}
