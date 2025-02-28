<?php
namespace App\Helper;

use Illuminate\Support\Facades\Validator;

trait TraitSupport {
    public function StoreData($request ,$table ,$rules )
    {
        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return returnData('5001','',$validator->errors(),'Validation failed');
        }
        $table->fill($request->all());
        $table->save();
        // Return success response
        return returnData('2000','','Data has been saved successfully','Success');
    }


    public function dataUpdate($request, $table, $rules )
    {
        $validator =  Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return returnData('5001','',$validator->errors(),'Validation failed');
        }
        $data = $table::find($request->input('id'));

        if ($data) {
            $data->fill($request->all());
            $data->save();
            return returnData('2000','','Data has been saved successfully','Success');
        }
        return returnData('5001','','Data not found for the provided ID','Not found');
    }

    public function deleteData( $table, $id)
    {
        try {
            $data = $table::find($id);

            if ($data) {
                $data->delete();
                return returnData('2000','','Data has been deleted!','Success');
            }
            return returnData('5001','','Data not found for the provided ID','Not found');
        } catch (\Exception $e) {
            return returnData('5001','', $e->getMessage() ,'Something went wrong');
        }
    }


//    public function changeStatus($table, $id)
//    {
//        $record = $table::find($id);
//        if (!$record) {return returnData('5001','','Record not found','not found');}
//        $currentStatus = $record->status;
//        $newStatus = ($currentStatus == 0) ? 1 : 0;
//        $record->status = $newStatus;
//        $record->save();
//        return returnData('2000','','Data has been changed successfully!','Success');
//    }

    public function ValisationMessage($rules , $request)
    {
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return returnData('5001','',$validator->errors(),'Validation failed');
        }
    }

}
