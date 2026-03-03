<?php

namespace App\Repository;

use App\Models\LayoutSheet;

class LayoutSheetRepository
{
    // Repository here
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
