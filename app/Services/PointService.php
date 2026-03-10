<?php

namespace App\Services;
use App\Repository\PointSkillRepository;
use Bpjs\Framework\Helpers\TablePlus;
use Bpjs\Framework\Helpers\Validator;

class PointService
{
    // Service logic here
    public function __construct(protected PointSkillRepository $pointRepository, protected UtilService $utilService){}
    public function getData(array $data)
    {
        return TablePlus::of('p_skill')
                        ->select('noLane','description','psId','empName','empNik','profil','pointSkill','p_skill.laneId','pointSkill2')
                        ->leftJoin('lane','lane.laneId','=','p_skill.laneId')
                        ->searchable(['noLane','description','empName','empNik','profil','pointSkill'])
                        ->addColumn('profil_url', function($row){
                            return storage_secure('attachment/PointSkill/'.$row['profil'],3600);
                        })
                        ->filters($data['filters'] ?? [])
                        ->orderBy('psId','ASC')
                        ->paginate($data['per_page'] ?? 10, $data['page'] ?? 1)
                        ->handleDistinct($data['distinct'] ?? null)
                        ->make();
    }

    public function getPointByLane($id)
    {
        $point = $this->pointRepository->getPointByLaneId($id);
        if($point){
            return [
                'success' => true,
                'status' => 200,
                'message' => 'success get data',
                'data' => $point
            ];
        }
    }
    public function create(array $data, $file, $photoUrl = null): array
    {
        if($this->pointRepository->PointExists($data['laneId']) > 2){
            return [
                'success' => false,
                'status' => 422,
                'message' => 'Point skill already exist'
            ];
        }
        $path = storage_path('attachment/PointSkill/');

        if (!is_dir($path)) {
            mkdir($path, 0777, true);
        }

        if ($photoUrl && (!$file || (is_array($file) && $file['error'] == 4))) {

            $photoContent = @file_get_contents($photoUrl);

            if ($photoContent) {

                $filename = $data['empNik'] . '.jpg';

                file_put_contents($path . $filename, $photoContent);

                $data['profil'] = $filename;
            }
        }

        if ($file && !(is_array($file) && $file['error'] == 4)) {

            $extension = is_array($file)
                ? pathinfo($file['name'], PATHINFO_EXTENSION)
                : pathinfo($file->getClientOriginalName(), PATHINFO_EXTENSION);

            $filename = $data['empNik'] . '.' . $extension;

            if (is_array($file)) {
                move_uploaded_file($file['tmp_name'], $path . $filename);
            } else {
                $file->move($path, $filename);
            }

            $data['profil'] = $filename;
        }

        if (!isset($data['profil'])) {

            $data['profil'] = 'default.png';
        }
        $point = $this->pointRepository->createPoint($data);
        if($point){
            $points = $this->pointRepository->getPointByLaneId($data['laneId']);
            $this->utilService->sendRealtimeUpdate([
                'type' => 'pointskill-update',
                'laneId' => $data['laneId'],
                'point' => $points,
            ]);
            return [
                'success' => true,
                'status' => 200,
                'message' => 'Point Skill success create',
                'data' => $point
            ];
        }
        return [
            'success' => false,
            'status' => 500,
            'message' => 'Failed to create Point Skill'
        ];
    }

    public function update($id, array $data, $file)
    {
        $oldProfil = $this->pointRepository->getById($id);
        $fileName = $oldProfil->profil;
        if(isset($file) && !empty($file['name'])){
            $fileName = $file['name'];
            $this->utilService->upload($file,'PointSkill');
            if($oldProfil->profil){
                $oldPath = storage_path('attachment/PointSkill/'.$oldProfil->profil);
                if(file_exists($oldPath)){
                    unlink($oldPath);
                }
            }
        }
        $data['profil'] = $fileName;
        $point = $this->pointRepository->updatePoint($id,$data);
        if($point){
            $points = $this->pointRepository->getPointByLaneId($data['laneId']);
            $this->utilService->sendRealtimeUpdate([
                'type' => 'pointskill-update',
                'laneId' => $data['laneId'],
                'point' => $points,
            ]);
            return [
                'success' => true,
                'status' => 200,
                'message' => 'Point Skill success update',
                'data' => $point
            ];
        }
        return [
            'success' => false,
            'status' => 500,
            'message' => 'Failed to Change Point Skill'
        ];
    }

    public function destroy($id)
    {
        $point = $this->pointRepository->destroyPoint($id);
        if($point){
            return [
                'success' => true,
                'status' => 200,
                'message' => 'Point Skill success delete'
            ];
        }
    }
}
