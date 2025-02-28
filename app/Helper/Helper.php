<?php
namespace App\Helper;
trait Helper {
    public $model = null;
    public $childModel = null;


    public function status()
    {
        try {
            $data = $this->model->where('id', request()->input('id'))->first();

            if (!$data) {
                return returnData(5000, null, 'Data Not found');
            }
            if ($data->status == 1) {
                $data->status = 0;
                $data->save();
                return returnData(2000, 'warning', "Successfully InActivated");
            } else {
                $data->status = 1;
                $data->save();
                return returnData(2000, 'success', "Successfully Activated");
            }

        } catch (\Exception $exception) {
            return returnData(5000, $exception->getMessage(), 'Not Updated');
        }
    }

    public function genRandNum($start = '', $end = '', $min = 100, $max = 99 ,$chItem ='')
    {
        do {
            $number = $start . time() . rand($min, $max) . $end;
        } while ($this->model->where($chItem, $number)->exists());
        return $number;
    }

    public function genSerNum($SrItem)
    {
        $lastNum = $this->model->orderBy($SrItem, 'desc')->first();

        // ডাইনামিক কলাম ভ্যালুকে ইন্টিজারে কনভার্ট করা
        $newNum = $lastNum ? intval($lastNum->$SrItem) + 1 : 1001;

        return $newNum;
    }






}
