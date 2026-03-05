<?php

namespace App\Repository;

use App\Models\LayoutSheet;

class LayoutSheetRepository
{
    // Repository here
    public function LayoutIsExists($id)
    {
        return LayoutSheet::exists(['laneId'=>$id]);
    }
    public function getLayoutByLaneId($id)
    {
        $layout = LayoutSheet::query()->where('laneId','=',$id)->first();
        if($layout){
            $data = $layout->toArray();
            $data['encrypt_url'] = $layout->getEncryptUrl();
    
            return $data;
        }
    }
    public function getById($id)
    {
        $layout = LayoutSheet::find($id);
        return $layout;
    }

    public function createLayout(array $data)
    {
        $layout = LayoutSheet::create($data);
        return $layout->toArray();
    }

    public function updateLayout($id, array $data)
    {
        $layout = LayoutSheet::find($id);
        $layout->update($data);
        return $layout->toArray();
    }

    public function destroyLayout($id)
    {
        return LayoutSheet::deleteWhere(['lId'=>$id]);
    }
}
