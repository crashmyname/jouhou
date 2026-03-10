<?php

namespace App\Services;
use Bpjs\Framework\Helpers\Validator;

class UtilService
{
    // Service logic here
    public function sendRealtimeUpdate($data)
    {
        $ch = curl_init(env('APP_NODE_SERVER')."/broadcast");

        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Content-Type: application/json'
        ]);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        curl_exec($ch);
        if(curl_errno($ch)){
            error_log("Realtime Error: " . curl_error($ch));
        }
        curl_close($ch);
    }

    public function upload($file,$name)
    {
        $path = storage_path('attachment/'.$name.'/');
        if(!is_dir($path)){
            mkdir($path,0777,true);
        }
        return uploadFile($file,$path);
    }
}
