<?php

namespace App\Services;
use App\Repository\CosRepository;
use Bpjs\Framework\Helpers\Validator;

class CosService
{
    // Service logic here
    public function __construct(protected CosRepository $cosRepo){}
    public function getData()
    {

    }

    public function create(array $data)
    {
        $cos = $this->cosRepo->createCos($data);
        if($cos){
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
